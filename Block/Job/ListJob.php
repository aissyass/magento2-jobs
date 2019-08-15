<?php
/**
 * created: 2019
 *
 * @category  XXXXXXX
 * @package   Ayaline
 * @author    aYaline Magento <support.magento-shop@ayaline.com>
 * @copyright 2019 - aYaline Magento
 * @license   aYaline - http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 * @link      http://shop.ayaline.com/magento/fr/conditions-generales-de-vente.html
 */

namespace PHPAISS\Jobs\Block\Job;

use Magento\Framework\View\Element\Template;
use PHPAISS\Jobs\Api\Data\JobInterface;
use PHPAISS\Jobs\Model\ResourceModel\Department as ResourceDepartment;
use PHPAISS\Jobs\Model\ResourceModel\Job\CollectionFactory;

class ListJob extends Template
{
    /**
     * @var \PHPAISS\Jobs\Model\Job
     */
    private $job;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ResourceDepartment
     */
    private $resourceDepartment;

    /**
     * @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection
     */
    private $jobCollection;

    /**
     * ListJob constructor.
     *
     * @param Template\Context   $context
     * @param JobInterface       $job
     * @param CollectionFactory  $collectionFactory
     * @param ResourceDepartment $resourceDepartment
     * @param array              $data
     * @param array|null         $jobCollection
     */
    public function __construct(
        Template\Context $context,
        JobInterface $job,
        CollectionFactory $collectionFactory,
        ResourceDepartment $resourceDepartment,
        array $data = [],
        array $jobCollection = null
    )
    {
        parent::__construct($context, $data);
        $this->job = $job;
        $this->collectionFactory = $collectionFactory;
        $this->resourceDepartment = $resourceDepartment;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // You can put these informations editable on BO
        $title = __('We are hiring');
        $description = __('Look at the jobs we have got for you');
        $keywords = __('job,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'jobs',
                [
                    'label' => $title,
                    'title' => $title,
                    'link' => false // No link for the last element
                ]
            );
        }

        $this->pageConfig->getTitle()->set($title);
        $this->pageConfig->setDescription($description);
        $this->pageConfig->setKeywords($keywords);

        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($title);
        }

        return $this;
    }

    /**
     * Retrieve filtred collection
     *
     * @return null|\PHPAISS\Jobs\Model\ResourceModel\Job\Collection
     */
    public function getLoadedJobCollection()
    {
        return $this->_getJobCollection();
    }

    /**
     * @param $job
     * @return string
     */
    public function getJobUrl($job){
        /** @var \PHPAISS\Jobs\Model\Job $job */
        if(!$job->getId()){
            return '#';
        }

        return $this->getUrl('jobs/job/view', ['id' => $job->getId()]);
    }

    /**
     * @param JobInterface $job
     * @return string
     */
    public function getDepartmentUrl($job){
        /** @var \PHPAISS\Jobs\Model\Job $job */
        if(!$job->getDepartmentId()){
            return '#';
        }

        return $this->getUrl('jobs/department/view', ['id' => $job->getDepartmentId()]);
    }

    /**
     * @return null|\PHPAISS\Jobs\Model\ResourceModel\Job\Collection
     */
    protected function _getJobCollection()
    {
        if (!$this->jobCollection) {
            /** @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection $jobCollection */
            $this->jobCollection = $this->collectionFactory->create();
            $this->jobCollection->addFieldToSelect('*')
                                ->addFieldToFilter('main_table.is_active', $this->job->getEnableStatus());
        }
        
        return $this->jobCollection;
    }

    /**
     * Prepare Job's Type.
     *
     * @param $type
     * @return string
     */
    public function prepareJobType($type)
    {
        return $type == 0 ? 'CDI' : 'CDD';
    }
}

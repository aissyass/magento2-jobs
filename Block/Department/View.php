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

namespace PHPAISS\Jobs\Block\Department;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use PHPAISS\Jobs\Api\DepartmentRepositoryInterface;
use PHPAISS\Jobs\Api\JobRepositoryInterface;
use PHPAISS\Jobs\Helper\Data;
use PHPAISS\Jobs\Model\Department;
use PHPAISS\Jobs\Model\Job;
use PHPAISS\Jobs\Model\ResourceModel\Job\CollectionFactory;

class View extends Template
{
    const LIST_JOBS_ENABLED = 'jobs/department/view_list';

    /**
     * @var Job
     */
    private $job;

    /**
     * @var Department
     */
    private $department;

    /**
     * @var DepartmentRepositoryInterface
     */
    private $departmentRepository;

    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;

    /**
     * @var CollectionFactory
     */
    private $jobCollectionFactory;

    /**
     * Collection Job
     * @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection|null
     */
    private $jobCollection = null;
    /**
     * @var Data
     */
    private $helper;

    /**
     * View constructor.
     *
     * @param Template\Context              $context
     * @param Job                           $job
     * @param Department                    $department
     * @param DepartmentRepositoryInterface $departmentRepository
     * @param JobRepositoryInterface        $jobRepository
     * @param CollectionFactory             $jobCollectionFactory
     * @param Data     $helper
     * @param array                         $data
     */
    public function __construct(
        Template\Context $context,
        Job $job,
        Department $department,
        DepartmentRepositoryInterface $departmentRepository,
        JobRepositoryInterface $jobRepository,
        CollectionFactory $jobCollectionFactory,
        Data $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->job = $job;
        $this->department = $department;
        $this->departmentRepository = $departmentRepository;
        $this->jobRepository = $jobRepository;
        $this->jobCollectionFactory = $jobCollectionFactory;
        $this->helper = $helper;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // Get department
        $department = $this->getLoadedDepartment();

        // Title is department's name
        $title = $department->getName();
        $description = __('Look at the jobs we have got for you');
        $keywords = __('job,hiring');

        $this->getLayout()->createBlock('Magento\Catalog\Block\Breadcrumbs');

        if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbsBlock->addCrumb(
                'jobs',
                [
                    'label' => __('We are hiring'),
                    'title' => __('We are hiring'),
                    'link' => $this->getListJobUrl() // No link for the last element
                ]
            );
            $breadcrumbsBlock->addCrumb(
                'job',
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

    protected function _getDepartment()
    {
        if (!$this->department->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->department = $this->departmentRepository->getById($entityId);
        }
        return $this->department;
    }

    public function getLoadedDepartment()
    {
        return $this->_getDepartment();
    }

    public function getListJobUrl(){
        return $this->getUrl('jobs/job');
    }

    protected function _getJobsCollection(){
        if($this->jobCollection === null && $this->department->getId()){
            /** @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection $jobCollection */
            $jobCollection = $this->jobCollectionFactory->create();
            $this->jobCollection = $jobCollection->addFieldToFilter('department_id', $this->department->getId())
                                                 ->addFieldToFilter('main_table.is_active', $this->job->getEnableStatus());
        }
        return $this->jobCollection;
    }

    public function getLoadedJobsCollection()
    {
        return $this->_getJobsCollection();
    }

    public function getJobUrl(Job $job){
        if(!$job->getId()){
            return '#';
        }

        return $this->getUrl('jobs/job/view', ['id' => $job->getId()]);
    }

    public function getConfigListJobs() {
        $this->helper->getListJobEnabled();
    }
}

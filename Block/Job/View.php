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
use PHPAISS\Jobs\Api\DepartmentRepositoryInterface;
use PHPAISS\Jobs\Api\JobRepositoryInterface;
use PHPAISS\Jobs\Model\Department;
use PHPAISS\Jobs\Model\Job;

class View extends Template
{
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
     * View constructor.
     *
     * @param Template\Context              $context
     * @param Job                           $job
     * @param Department                    $department
     * @param DepartmentRepositoryInterface $departmentRepository
     * @param JobRepositoryInterface        $jobRepository
     * @param array                         $data
     */
    public function __construct(
        Template\Context $context,
        Job $job,
        Department $department,
        DepartmentRepositoryInterface $departmentRepository,
        JobRepositoryInterface $jobRepository,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->job = $job;
        $this->department = $department;
        $this->departmentRepository = $departmentRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // Get job and department
        $job = $this->getLoadedJob();
        $department = $this->getLoadedDepartment();

        // Title is job's title and department's name
        $title = $job->getTitle() .' - '.$department->getName();
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

    /**
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface|Job
     */
    public function getLoadedJob()
    {
        return $this->_getJob();
    }

    /**
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface|Department
     */
    public function getLoadedDepartment()
    {
        return $this->_getDepartment();
    }

    /**
     * @return string
     */
    public function getListJobUrl(){
        return $this->getUrl('jobs/job');
    }

    /**
     * @param Job $job
     * @return string
     */
    public function getDepartmentUrl(Job $job){
        if(!$job->getDepartmentId()){
            return '#';
        }
        return $this->getUrl('jobs/department/view', ['id' => $job->getDepartmentId()]);
    }

    /**
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface|Job
     */
    protected function _getJob()
    {
        if (!$this->job->getId()) {
            // our model is already set in the construct
            // but I put this method to load in case the model is not loaded
            $entityId = $this->_request->getParam('id');
            $this->job = $this->jobRepository->getById($entityId);
        }
        return $this->job;
    }

    /**
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface|Department
     */
    protected function _getDepartment()
    {
        if (!$this->department->getId()) {
            // Get the job to retrieve department_id
            $job = $this->getLoadedJob();
            // Load department with id
            $this->department = $this->departmentRepository->getById($job->getDepartmentId());
        }
        return $this->department;
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

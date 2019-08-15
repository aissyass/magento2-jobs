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

namespace PHPAISS\Jobs\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Ui\Component\MassAction\Filter;
use PHPAISS\Jobs\Api\DepartmentRepositoryInterface;
use PHPAISS\Jobs\Model\DepartmentFactory;
use PHPAISS\Jobs\Model\ResourceModel\Department\CollectionFactory;

abstract class Department extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'PHPAISS_Jobs::department';

    /**
     * @var DepartmentRepositoryInterface
     */
    protected $departmentRepository;
    /**
     * @var PageFactory
     */
    protected $pageFactory;
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var \PHPAISS\Jobs\Model\Department
     */
    protected $departmentFactory;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * Department constructor.
     *
     * @param Action\Context                              $context
     * @param PageFactory                                 $pageFactory
     * @param ForwardFactory                              $resultForwardFactory
     * @param DepartmentRepositoryInterface               $departmentRepository
     * @param DepartmentFactory                           $departmentFactory
     * @param CollectionFactory                           $collectionFactory
     * @param DataPersistorInterface                      $dataPersistor
     * @param JsonFactory                                 $jsonFactory
     * @param Filter                                      $filter
     * @param DateTime $dateTime
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        ForwardFactory $resultForwardFactory,
        DepartmentRepositoryInterface $departmentRepository,
        DepartmentFactory $departmentFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        JsonFactory $jsonFactory,
        Filter $filter,
        DateTime $dateTime
    )
    {
        parent::__construct($context);
        $this->departmentRepository = $departmentRepository;
        $this->pageFactory = $pageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->dataPersistor = $dataPersistor;
        $this->departmentFactory = $departmentFactory;
        $this->jsonFactory = $jsonFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->dateTime = $dateTime;
    }

    /**
     * @param Page $resultPage
     * @return Page
     */
    public function initDepartment($resultPage)
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage->setActiveMenu('PHPAISS_Jobs::department')
                    ->addBreadcrumb(__('Jobs'), __('Jobs'))
                    ->addBreadcrumb(__('Manage Departments'), __('Manage Departments'))
                    ->getConfig()->getTitle()->prepend(__('Departments'));
        return $resultPage;
    }
}

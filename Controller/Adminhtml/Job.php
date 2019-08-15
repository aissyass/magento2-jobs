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
use PHPAISS\Jobs\Api\JobRepositoryInterface;
use PHPAISS\Jobs\Model\Job\FileInfo;
use PHPAISS\Jobs\Model\Job\ImageUploader;
use PHPAISS\Jobs\Model\JobFactory;
use PHPAISS\Jobs\Model\ResourceModel\Job\CollectionFactory;

abstract class Job extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'PHPAISS_Jobs::job';

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
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var JobRepositoryInterface
     */
    protected $repository;

    /**
     * @var JobFactory
     */
    protected $jobFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @var FileInfo
     */
    protected $fileInfo;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * Job constructor.
     *
     * @param Action\Context         $context
     * @param PageFactory            $pageFactory
     * @param ForwardFactory         $resultForwardFactory
     * @param DataPersistorInterface $dataPersistor
     * @param JsonFactory            $jsonFactory
     * @param Filter                 $filter
     * @param JobRepositoryInterface $repository
     * @param JobFactory             $jobFactory
     * @param CollectionFactory      $collectionFactory
     * @param ImageUploader          $imageUploader
     * @param FileInfo               $fileInfo
     * @param DateTime               $dateTime
     */
    public function __construct(
        Action\Context $context,
        PageFactory $pageFactory,
        ForwardFactory $resultForwardFactory,
        DataPersistorInterface $dataPersistor,
        JsonFactory $jsonFactory,
        Filter $filter,
        JobRepositoryInterface $repository,
        JobFactory $jobFactory,
        CollectionFactory $collectionFactory,
        ImageUploader $imageUploader,
        FileInfo $fileInfo,
        DateTime $dateTime
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->dataPersistor = $dataPersistor;
        $this->jsonFactory = $jsonFactory;
        $this->filter = $filter;
        $this->repository = $repository;
        $this->jobFactory = $jobFactory;
        $this->collectionFactory = $collectionFactory;
        $this->imageUploader = $imageUploader;
        $this->fileInfo = $fileInfo;
        $this->dateTime = $dateTime;
    }

    /**
     * @param Page $resultPage
     * @return Page
     */
    public function initJob($resultPage)
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage->setActiveMenu('PHPAISS_Jobs::job')
                    ->addBreadcrumb(__('Jobs'), __('Jobs'))
                    ->addBreadcrumb(__('Manage Jobs'), __('Manage Jobs'))
                    ->getConfig()->getTitle()->prepend(__('Jobs'));
        return $resultPage;
    }
}

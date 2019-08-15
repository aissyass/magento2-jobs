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

namespace PHPAISS\Jobs\Controller\Department;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use PHPAISS\Jobs\Model\DepartmentRepository;

class View extends Action
{
    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * View constructor.
     *
     * @param Context                                    $context
     * @param DepartmentRepository                       $departmentRepository
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        DepartmentRepository $departmentRepository,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->departmentRepository = $departmentRepository;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // Get param id
        $id = $this->getRequest()->getParam('id');

        // No id, redirect
        if(empty($id)){
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        $department = $this->departmentRepository->getById($id);
        // Model not exists with this id, redirect
        if (!$department->getId()) {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}

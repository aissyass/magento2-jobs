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

namespace PHPAISS\Jobs\Controller\Adminhtml\Department;

use PHPAISS\Jobs\Controller\Adminhtml\Department;

class Edit extends Department
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'PHPAISS_Jobs::department_save';

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
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        /** @var \PHPAISS\Jobs\Model\Department $department */
        $department = null;

        // 2. Initial checking
        // If you have got an id, it's edition
        if ($id) {
            $department = $this->departmentRepository->getById($id);
            if (!$department->getId()) {
                $this->messageManager->addErrorMessage(__('This department no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $this->initDepartment($resultPage);
        $resultPage->addBreadcrumb(
            $id ? __('Edit Department') : __('New Department'),
            $id ? __('Edit Department') : __('New Department')
        );
        $resultPage->getConfig()->getTitle()->prepend($id ? $department->getName() : __('New Department'));

        return $resultPage;
    }
}

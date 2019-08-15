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

namespace PHPAISS\Jobs\Controller\Adminhtml\Job;

use PHPAISS\Jobs\Controller\Adminhtml\Job;

class Edit extends Job
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'PHPAISS_Jobs::job_save';

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
        /** @var \PHPAISS\Jobs\Model\Job $job */
        $job = null;

        // 2. Initial checking
        // If you have got an id, it's edition
        if ($id) {
            $job = $this->repository->getById($id);
            if (!$job->getId()) {
                $this->messageManager->addErrorMessage(__('This job no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $this->initJob($resultPage);
        $resultPage->addBreadcrumb(
            $id ? __('Edit Job') : __('New Job'),
            $id ? __('Edit Job') : __('New Job')
        );
        $resultPage->getConfig()->getTitle()->prepend($id ? $job->getTitle() : __('New Job'));

        return $resultPage;
    }
}

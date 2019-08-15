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

use Magento\Framework\Exception\LocalizedException;
use PHPAISS\Jobs\Controller\Adminhtml\Job;

class Save extends Job
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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = \PHPAISS\Jobs\Model\Job::STATUS_ENABLED;
            }
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var \PHPAISS\Jobs\Model\Job $model */
            $model = $this->jobFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->repository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This job no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            // Check if image uploaded
            if(array_key_exists('image', $data) && $data['image']) {
                // Set only image name with extension to attribute 'image'
                $data['image'] = $data['image'][0]['name'];
            } else {
                $data['image'] = null;
            }

            $model->setData($data);

            // Update 'update_time' attribut in database when editing
            $model->setUpdateTime($this->dateTime->gmtDate());

            $this->_eventManager->dispatch(
                'jobs_job_prepare_save',
                ['job' => $model, 'request' => $this->getRequest()]
            );

            try {
                // Check if array has key 'image'
                if(array_key_exists('image', $data) && $data['image']) {
                    // Check if image exist in tmp path before move to upload directory
                    $imageTmpPath = '/' . $this->fileInfo->getEntityMediaTmpPath() . '/' . ltrim($data['image'], '/');
                    $imageTmpPath = $this->fileInfo->getMediaDirectory()->getAbsolutePath($imageTmpPath);

                    if($this->fileInfo->getMediaDirectory()->isExist($imageTmpPath)) {
                        // Move file from tmp directory to upload directory before save object
                        $this->imageUploader->moveFileFromTmp($data['image']);
                    }
                }
                // Save object
                $this->repository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the job.'));
                $this->dataPersistor->clear('jobs_job');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the job.'));
            }

            $this->dataPersistor->set('jobs_job', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

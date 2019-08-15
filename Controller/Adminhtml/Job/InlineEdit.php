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

class InlineEdit extends Job
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
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $jobId) {
                    /** @var \PHPAISS\Jobs\Model\Job $job */
                    $job = $this->repository->getById($jobId);
                    try {
                        $job->setData(array_merge($job->getData(), $postItems[$jobId]));
                        $this->repository->save($job);
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithJobId(
                            $job,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add job title to error message
     *
     * @param \PHPAISS\Jobs\Model\Job $job
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithJobId($job, $errorText)
    {
        return '[Job ID: ' . $job->getId() . '] ' . $errorText;
    }
}

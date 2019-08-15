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

namespace PHPAISS\Jobs\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPAISS\Jobs\Api\Data;
use PHPAISS\Jobs\Api\JobRepositoryInterface;
use PHPAISS\Jobs\Model\JobFactory;
use \PHPAISS\Jobs\Model\ResourceModel\Job as ResourceJob;
use PHPAISS\Jobs\Model\DepartmentFactory;

class JobRepository implements JobRepositoryInterface
{
    /**
     * @var JobFactory
     */
    private $jobFactory;
    /**
     * @var ResourceJob
     */
    private $resource;

    /**
     * JobRepository constructor.
     *
     * @param JobFactory   $jobFactory
     * @param ResourceJob  $resource
     */
    function __construct(
        JobFactory $jobFactory,
        ResourceJob $resource
    )
    {
        $this->jobFactory = $jobFactory;
        $this->resource = $resource;
    }

    /**
     * Save job.
     *
     * @param \PHPAISS\Jobs\Api\Data\JobInterface $job
     * @return \PHPAISS\Jobs\Api\Data\JobInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\JobInterface $job)
    {
        try {
            /** @var \PHPAISS\Jobs\Model\Job $job */
            $this->resource->save($job);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $job;
    }

    /**
     * Retrieve job.
     *
     * @param int $jobId
     * @return \PHPAISS\Jobs\Api\Data\JobInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($jobId)
    {
        /** @var \PHPAISS\Jobs\Model\Job $job */
        $job = $this->jobFactory->create();
        $this->resource->load($job, $jobId);
        if (!$job->getId()) {
            throw new NoSuchEntityException(__('JOBS Job with id "%1" does not exist.', $jobId));
        }
        return $job;
    }

    /**
     * Delete job.
     *
     * @param \PHPAISS\Jobs\Api\Data\JobInterface $job
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\JobInterface $job)
    {
        try {
            /** @var \PHPAISS\Jobs\Model\Job $job */
            $this->resource->delete($job);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete job by ID.
     *
     * @param int $jobId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($jobId)
    {
        return $this->delete($this->getById($jobId));
    }
}

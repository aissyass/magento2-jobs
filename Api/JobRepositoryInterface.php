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

namespace PHPAISS\Jobs\Api;

/**
 * JOBS job CRUD interface.
 * @api
 * @since 100.0.2
 */
interface JobRepositoryInterface
{
    /**
     * Save job.
     *
     * @param \PHPAISS\Jobs\Api\Data\JobInterface $job
     * @return \PHPAISS\Jobs\Api\Data\JobInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\JobInterface $job);

    /**
     * Retrieve job.
     *
     * @param int $jobId
     * @return \PHPAISS\Jobs\Api\Data\JobInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($jobId);

    /**
     * Delete job.
     *
     * @param \PHPAISS\Jobs\Api\Data\JobInterface $job
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\JobInterface $job);

    /**
     * Delete job by ID.
     *
     * @param int $jobId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($jobId);
}

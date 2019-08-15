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

namespace PHPAISS\Jobs\Cron;

use Magento\Cron\Model\Schedule;
use PHPAISS\Jobs\Model\JobRepository;
use PHPAISS\Jobs\Model\ResourceModel\Job\CollectionFactory;

class DisableJobs
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * DisableJobs constructor.
     *
     * @param CollectionFactory                 $collectionFactory
     * @param JobRepository $jobRepository
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        JobRepository $jobRepository
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Disable jobs which date is less than the current date
     *
     * @param Schedule $schedule
     * @return void
     */
    public function execute(Schedule $schedule)
    {
        $dateNow = date('Y-m-d');
        /** @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection $jobsCollection */
        $jobsCollection = $this->collectionFactory->create();
        $jobsCollection->addFieldToFilter('date', ['lt' => $dateNow]);

        foreach($jobsCollection AS $job) {
            /** @var \PHPAISS\Jobs\Model\Job $job */
            $job->setIsActive($job->getDisableStatus());
            $this->jobRepository->save($job);
        }
    }
}

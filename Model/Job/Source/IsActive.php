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

namespace PHPAISS\Jobs\Model\Job\Source;

use Magento\Framework\Data\OptionSourceInterface;
use PHPAISS\Jobs\Model\Job;

class IsActive implements OptionSourceInterface
{
    /**
     * @var Job
     */
    private $job;


    /**
     * IsActive constructor.
     *
     * @param Job $job
     */
    function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->job->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}

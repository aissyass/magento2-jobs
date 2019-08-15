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

namespace PHPAISS\Jobs\Model\Department\Source;

use Magento\Framework\Data\OptionSourceInterface;
use PHPAISS\Jobs\Model\Department;

class IsActive implements OptionSourceInterface
{
    /**
     * @var Department
     */
    private $department;

    /**
     * IsActive constructor.
     *
     * @param Department $department
     */
    function __construct(
        Department $department
    )
    {
        $this->department = $department;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->department->getAvailableStatuses();
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

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
use PHPAISS\Jobs\Model\ResourceModel\Department\CollectionFactory;

class LinkedDepartment implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * LinkedDepartment constructor.
     *
     * @param CollectionFactory $collectionFactory
     */
    function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => ''];
        /** @var \PHPAISS\Jobs\Model\ResourceModel\Department\Collection $departmentCollection */
        $departmentCollection = $this->collectionFactory->create();
        $departmentCollection->addFieldToSelect('entity_id')
                             ->addFieldToSelect('name');
        foreach ($departmentCollection as $department) {
            /** @var \PHPAISS\Jobs\Model\Department $department */
            $options[] = [
                'label' => $department->getName(),
                'value' => $department->getId(),
            ];
        }
        return $options;
    }
}

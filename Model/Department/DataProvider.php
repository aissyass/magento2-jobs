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

namespace PHPAISS\Jobs\Model\Department;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use PHPAISS\Jobs\Model\ResourceModel\Department\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \PHPAISS\Jobs\Model\ResourceModel\Department\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $departmentCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $departmentCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $departmentCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \PHPAISS\Jobs\Model\Department $department */
        foreach ($items as $department) {
            $this->loadedData[$department->getId()] = $department->getData();
        }

        $data = $this->dataPersistor->get('jobs_department');
        if (!empty($data)) {
            $department = $this->collection->getNewEmptyItem();
            $department->setData($data);
            $this->loadedData[$department->getId()] = $department->getData();
            $this->dataPersistor->clear('jobs_department');
        }

        return $this->loadedData;
    }
}

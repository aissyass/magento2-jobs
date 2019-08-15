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

namespace PHPAISS\Jobs\Model\Job;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use PHPAISS\Jobs\Helper\Data;
use PHPAISS\Jobs\Model\ResourceModel\Job\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \PHPAISS\Jobs\Model\ResourceModel\Job\Collection
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
     * @var FileInfo
     */
    private $fileInfo;
    /**
     * @var Data
     */
    private $helper;

    /**
     * DataProvider constructor.
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $collectionFactory
     * @param FileInfo               $fileInfo
     * @param Data                   $helper
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        FileInfo $fileInfo,
        Data $helper,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->fileInfo = $fileInfo;
        $this->helper = $helper;
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
        /** @var \PHPAISS\Jobs\Model\Job $job */
        foreach ($items as $job) {
            $this->loadedData[$job->getId()] = $job->getData();
        }

        $data = $this->dataPersistor->get('jobs_job');
        if (!empty($data)) {
            $job = $this->collection->getNewEmptyItem();
            $job->setData($data);
            $this->loadedData[$job->getId()] = $job->getData();
            $this->dataPersistor->clear('jobs_job');
        }

        if($this->loadedData) {
            // Get first key of array 'loadedData'
            $key = array_keys($this->loadedData)[0];

            // Check if array has key 'image' AND loadData not null
            if($this->loadedData[$key]['image'] && array_key_exists('image', $this->loadedData[$key])) {
                // Keep image name and unset the image
                $imageName = $this->loadedData[$key]['image'];
                unset($this->loadedData[$key]['image']);

                // Check if this image name exist
                if ($this->fileInfo->isExist($imageName)) {
                    // Load stat (to get size) and mimeType of the image
                    $stat = $this->fileInfo->getStat($imageName);
                    $mime = $this->fileInfo->getMimeType($imageName);
                    $url  = $this->helper->getUrlJobImage($imageName);

                    // Set again image key for display
                    $this->loadedData[$key]['image'][0]['url']  = $url;
                    $this->loadedData[$key]['image'][0]['name'] = $imageName;
                    $this->loadedData[$key]['image'][0]['size'] = isset($stat) ? $stat['size'] : 0;
                    $this->loadedData[$key]['image'][0]['type'] = $mime;
                }
            }
        }

        return $this->loadedData;
    }
}

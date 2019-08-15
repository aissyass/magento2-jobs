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

namespace PHPAISS\Jobs\Ui\Component\Listing\Column\Jobs;

use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Asset\Repository;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use PHPAISS\Jobs\Helper\Data;

class Thumbnail extends Column
{
    /**
     * Column name in job listing grid
     */
    const NAME = 'thumbnail';

    /**
     * Alt image
     */
    const ALT_FIELD = 'title';

    /**
     * @var UrlInterface
     */
    private $urlBuilder;
    /**
     * @var Data
     */
    private $helper;
    /**
     * @var Repository
     */
    private $assetRepo;

    /**
     * Thumbnail constructor.
     *
     * @param ContextInterface                         $context
     * @param UiComponentFactory                       $uiComponentFactory
     * @param UrlInterface                             $urlBuilder
     * @param Repository $assetRepo
     * @param Data                                     $helper
     * @param array                                    $components
     * @param array                                    $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Repository $assetRepo,
        Data $helper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->helper = $helper;
        $this->assetRepo = $assetRepo;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = self::NAME;

            foreach ($dataSource['data']['items'] as & $item) {
                /** @var \PHPAISS\Jobs\Model\Job $job */
                $job = new DataObject($item);

                // Set default thumbnail as thumbnail in product listing grid
                $urlImage = $job->getImage() ?
                    $this->helper->getUrlJobImage($job->getImage()) :
                    $this->assetRepo->getUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg');

                $item[$fieldName . '_src'] = $urlImage;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'jobs/job/edit',
                    ['id' => $job->getEntityId(), 'store' => $this->context->getRequestParam('store')]
                );
                $item[$fieldName . '_orig_src'] = $urlImage;
            }
        }

        return parent::prepareDataSource($dataSource);
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}

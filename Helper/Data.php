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

namespace PHPAISS\Jobs\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use PHPAISS\Jobs\Model\Job\FileInfo;

class Data extends AbstractHelper
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Data constructor.
     *
     * @param Context               $context
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    const LIST_JOBS_ENABLED = 'jobs/department/view_list';

    /**
     * @return mixed
     */
    public function getListJobEnabled() {
        return $this->scopeConfig->getValue(
            self::LIST_JOBS_ENABLED
        );
    }

    /**
     * Get Url Job Image
     *
     * @param $imageName
     * @return bool|string
     * @throws LocalizedException
     */
    public function getUrlJobImage($imageName)
    {
        $url = false;
        if ($imageName) {
            if (is_string($imageName)) {
                $url = $this->storeManager->getStore()->getBaseUrl(
                        UrlInterface::URL_TYPE_MEDIA
                    ) . FileInfo::ENTITY_MEDIA_PATH . '/' . $imageName;
            } else {
                throw new LocalizedException(
                    __('Something went wrong while getting the image url.')
                );
            }
        }
        return $url;
    }
}

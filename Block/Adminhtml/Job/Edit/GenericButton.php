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

namespace PHPAISS\Jobs\Block\Adminhtml\Job\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPAISS\Jobs\Model\JobRepository;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * @param Context       $context
     * @param JobRepository $jobRepository
     */
    public function __construct(
        Context $context,
        JobRepository $jobRepository
    ) {
        $this->context = $context;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Return JOBS job ID
     *
     * @return int|null
     */
    public function getJobId()
    {
        try {
            return $this->jobRepository->getById(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

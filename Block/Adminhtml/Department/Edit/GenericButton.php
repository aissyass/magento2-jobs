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

namespace PHPAISS\Jobs\Block\Adminhtml\Department\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPAISS\Jobs\Model\DepartmentRepository;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @param Context              $context
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        Context $context,
        DepartmentRepository $departmentRepository
    ) {
        $this->context = $context;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Return JOBS department ID
     *
     * @return int|null
     */
    public function getDepartmentId()
    {
        try {
            return $this->departmentRepository->getById(
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

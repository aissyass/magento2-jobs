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

namespace PHPAISS\Jobs\Api;

/**
 * JOBS department CRUD interface.
 * @api
 * @since 100.0.2
 */
interface DepartmentRepositoryInterface
{
    /**
     * Save department.
     *
     * @param \PHPAISS\Jobs\Api\Data\DepartmentInterface $department
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\DepartmentInterface $department);

    /**
     * Retrieve department.
     *
     * @param int $departmentId
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($departmentId);

    /**
     * Delete department.
     *
     * @param \PHPAISS\Jobs\Api\Data\DepartmentInterface $department
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\DepartmentInterface $department);

    /**
     * Delete department by ID.
     *
     * @param int $departmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($departmentId);
}

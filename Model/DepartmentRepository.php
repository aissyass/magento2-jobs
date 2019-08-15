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

namespace PHPAISS\Jobs\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use PHPAISS\Jobs\Api\Data;
use PHPAISS\Jobs\Api\DepartmentRepositoryInterface;
use PHPAISS\Jobs\Model\DepartmentFactory;
use PHPAISS\Jobs\Model\ResourceModel\Department as ResourceDepartment;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * @var ResourceDepartment
     */
    private $resource;

    /**
     * @var DepartmentFactory
     */
    private $departmentFactory;

    /**
     * DepartmentRepository constructor.
     *
     * @param DepartmentFactory    $departmentFactory
     * @param ResourceDepartment   $resource
     */
    function __construct(
        DepartmentFactory $departmentFactory,
        ResourceDepartment $resource
    )
    {
        $this->resource = $resource;
        $this->departmentFactory = $departmentFactory;
    }

    /**
     * Save department.
     *
     * @param \PHPAISS\Jobs\Api\Data\DepartmentInterface $department
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\DepartmentInterface $department)
    {
        try {
            /** @var \PHPAISS\Jobs\Model\Department $department */
            $this->resource->save($department);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $department;
    }

    /**
     * Retrieve department.
     *
     * @param int $departmentId
     * @return \PHPAISS\Jobs\Api\Data\DepartmentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($departmentId)
    {
        /** @var \PHPAISS\Jobs\Model\Department $department */
        $department = $this->departmentFactory->create();
        $this->resource->load($department, $departmentId);
        if (!$department->getId()) {
            throw new NoSuchEntityException(__('JOBS Department with id "%1" does not exist.', $departmentId));
        }
        return $department;
    }

    /**
     * Delete department.
     *
     * @param \PHPAISS\Jobs\Api\Data\DepartmentInterface $department
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\DepartmentInterface $department)
    {
        try {
            /** @var \PHPAISS\Jobs\Model\Department $department */
            $this->resource->delete($department);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete department by ID.
     *
     * @param int $departmentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($departmentId)
    {
        return $this->delete($this->getById($departmentId));
    }
}

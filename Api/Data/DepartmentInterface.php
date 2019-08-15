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

namespace PHPAISS\Jobs\Api\Data;

interface DepartmentInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const DEPARTMENT_ID = 'entity_id';
    const NAME          = 'name';
    const DESCRIPTION   = 'description';
    const IS_ACTIVE     = 'is_active';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME   = 'update_time';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Get is active
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime();

    /**
     * Set ID
     *
     * @param int $id
     * @return DepartmentInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return DepartmentInterface
     */
    public function setName($name);

    /**
     * Set description
     *
     * @param string $description
     * @return DepartmentInterface
     */
    public function setDescription($description);

    /**
     * Set is active
     *
     * @param string $isActive
     * @return DepartmentInterface
     */
    public function setIsActive($isActive);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return DepartmentInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return DepartmentInterface
     */
    public function setUpdateTime($updateTime);
}

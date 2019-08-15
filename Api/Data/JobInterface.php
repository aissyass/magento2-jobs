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

interface JobInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const JOB_ID        = 'entity_id';
    const TITLE         = 'title';
    const TYPE          = 'type';
    const LOCATION      = 'location';
    const DATE          = 'date';
    const DESCRIPTION   = 'description';
    const IS_ACTIVE     = 'is_active';
    const IMAGE         = 'image';
    const DEPARTMENT_ID = 'department_id';
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
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation();

    /**
     * Get date
     *
     * @return string
     */
    public function getDate();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get is active
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Get department ID
     *
     * @return int
     */
    public function getDepartmentId();

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
     * @return JobInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param int $title
     * @return JobInterface
     */
    public function setTitle($title);

    /**
     * Set type
     *
     * @param int $type
     * @return JobInterface
     */
    public function setType($type);

    /**
     * Set location
     *
     * @param int $location
     * @return JobInterface
     */
    public function setLocation($location);

    /**
     * Set date
     *
     * @param int $date
     * @return JobInterface
     */
    public function setDate($date);

    /**
     * Set description
     *
     * @param int $description
     * @return JobInterface
     */
    public function setDescription($description);

    /**
     * Set is active
     *
     * @param string $isActive
     * @return JobInterface
     */
    public function setIsActive($isActive);

    /**
     * Set image
     *
     * @param string $image
     * @return JobInterface
     */
    public function setImage($image);

    /**
     * Set department id
     *
     * @param int $departmentId
     * @return JobInterface
     */
    public function setDepartmentId($departmentId);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return JobInterface
     */
    public function setCreationTime($creationTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return JobInterface
     */
    public function setUpdateTime($updateTime);
}

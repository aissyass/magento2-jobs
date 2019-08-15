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

use Magento\Framework\Model\AbstractModel;
use PHPAISS\Jobs\Api\Data\JobInterface;

class Job extends AbstractModel implements JobInterface
{
    /**#@+
     * Job's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Name of object id field
     * @var string
     */
    protected $_idFieldName = self::JOB_ID;

    /**
     * Initialize resource model
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('PHPAISS\Jobs\Model\ResourceModel\Job');
    }

    /**
     * Retrieve entity id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::JOB_ID);
    }

    /**
     * Retrieve title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Retrieve type
     *
     * @return string
     */
    public function getType()
    {
        return $this->getData(self::TYPE);
    }

    /**
     * Retrieve location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    /**
     * Retrieve date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->getData(self::DATE);
    }

    /**
     * Retrieve description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Retrieve is active
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Retrieve image
     *
     * @return int
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Retrieve department ID
     *
     * @return int
     */
    public function getDepartmentId()
    {
        return $this->getData(self::DEPARTMENT_ID);
    }

    /**
     * Retrieve creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Retrieve update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return JobInterface
     */
    public function setId($id)
    {
        return $this->setData(self::JOB_ID, $id);
    }

    /**
     * Set title
     *
     * @param int $title
     * @return JobInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set type
     *
     * @param int $type
     * @return JobInterface
     */
    public function setType($type)
    {
        return $this->setData(self::TYPE, $type);
    }

    /**
     * Set location
     *
     * @param int $location
     * @return JobInterface
     */
    public function setLocation($location)
    {
        return $this->setData(self::LOCATION, $location);
    }

    /**
     * Set date
     *
     * @param int $date
     * @return JobInterface
     */
    public function setDate($date)
    {
        return $this->setData(self::DATE, $date);
    }

    /**
     * Set description
     *
     * @param int $description
     * @return JobInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Set is active
     *
     * @param string $isActive
     * @return JobInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set image
     *
     * @param string $image
     * @return JobInterface
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Set department id
     *
     * @param int $departmentId
     * @return JobInterface
     */
    public function setDepartmentId($departmentId)
    {
        return $this->setData(self::DEPARTMENT_ID, $departmentId);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return JobInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return JobInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled'),
            self::STATUS_DISABLED => __('Disabled')
        ];
    }

    /**
     * @return int
     */
    public function getEnableStatus()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getDisableStatus()
    {
        return 0;
    }
}

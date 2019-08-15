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
use PHPAISS\Jobs\Api\Data\DepartmentInterface;

class Department extends AbstractModel implements DepartmentInterface
{
    /**#@+
     * Department's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * Name of object id field
     * @var string
     */
    protected $_idFieldName = self::DEPARTMENT_ID;

    /**
     * Initialize resource model
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('PHPAISS\Jobs\Model\ResourceModel\Department');
    }

    /**
     * Retrieve entity id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::DEPARTMENT_ID);
    }

    /**
     * Retrieve name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Retrieve description
     *
     * @return string|null
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
     * @param string $id
     * @return DepartmentInterface
     */
    public function setId($id)
    {
        return $this->setData(self::DEPARTMENT_ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DepartmentInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return DepartmentInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Set is active
     *
     * @param string $isActive
     * @return DepartmentInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return DepartmentInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return DepartmentInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Prepare department's statuses.
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

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

namespace PHPAISS\Jobs\Model\ResourceModel\Job;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use PHPAISS\Jobs\Api\Data\JobInterface;

class Collection extends AbstractCollection
{
    protected $_idFieldName = JobInterface::JOB_ID;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('PHPAISS\Jobs\Model\Job', 'PHPAISS\Jobs\Model\ResourceModel\Job');
    }

    /**
     * Add attribute Department Name to collection
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        // Conflict with PK_Job (entity_id) and PK_Department (entity_id)
        $this->addFilterToMap('entity_id', 'main_table.entity_id');

        // Get Department Name
        $this->getSelect()->join(
            ['department' => $this->getTable('phpaiss_jobs_departments')],
            'main_table.department_id = department.entity_id',

            [
                'department_name'    => 'department.name'
            ]
        );
    }

}

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

namespace PHPAISS\Jobs\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use PHPAISS\Jobs\Model\Job;
use PHPAISS\Jobs\Model\Department;

class InstallData implements InstallDataInterface
{
    protected $_department;
    protected $_job;

    /**
     * InstallData constructor.
     *
     * @param Department $department
     * @param Job        $job
     */
    public function __construct(Department $department, Job $job){
        $this->_department = $department;
        $this->_job = $job;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $departments = [
            [
                'name' => 'Marketing',
                'description' => 'Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea,
                aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed
                siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in
                hoc causarum titulo dissimilem sui.'
            ],
            [
                'name' => 'Technical Support',
                'description' => 'Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et
                venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque
                nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita
                priscis.'
            ],
            [
                'name' => 'Human Resource',
                'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.'
            ]
        ];

        /**
         * Insert departments
         */
        $departmentsIds = [];
        foreach ($departments as $data) {
            $department = $this->_department->setData($data)->save();
            $departmentsIds[] = $department->getId();
        }

        $jobs = [
            [
                'title' => 'Sample Marketing Job 1',
                'type' => 'CDI',
                'location' => 'Paris, France',
                'date'  => '2016-01-05',
                'is_active' => $this->_job->getEnableStatus(),
                'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                'department_id' => $departmentsIds[0]
            ],
            [
                'title' => 'Sample Marketing Job 2',
                'type' => 'CDI',
                'location' => 'Paris, France',
                'date'  => '2016-01-10',
                'is_active' => $this->_job->getDisableStatus(),
                'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                'department_id' => $departmentsIds[0]
            ],
            [
                'title' => 'Sample Technical Support Job 1',
                'type' => 'CDD',
                'location' => 'Lille, France',
                'date'  => '2016-02-01',
                'is_active' => $this->_job->getEnableStatus(),
                'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                'department_id' => $departmentsIds[1]
            ],
            [
                'title' => 'Sample Human Resource Job 1',
                'type' => 'CDI',
                'location' => 'Paris, France',
                'date'  => '2016-01-01',
                'status' => $this->_job->getEnableStatus(),
                'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.',
                'department_id' => $departmentsIds[2]
            ]
        ];

        /**
         * Insert jobs
         */
        foreach ($jobs as $data) {
            $this->_job->setData($data)->save();
        }
    }
}

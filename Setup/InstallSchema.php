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

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        /**
         * Create table 'phpaiss_jobs_departments'
         */

        $tableName = $installer->getTable('phpaiss_jobs_departments');
        $tableComment = 'Department management for jobs module';
        $columns = [
            'entity_id' => [
                'type' => Table::TYPE_INTEGER,
                'size' => null,
                'options' => ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'comment' => 'Department Id',
            ],
            'name' => [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'options' => ['nullable' => false, 'default' => ''],
                'comment' => 'Department name',
            ],
            'description' => [
                'type' => Table::TYPE_TEXT,
                'size' => 2048,
                'options' => ['nullable' => false, 'default' => ''],
                'comment' => 'Department description',
            ],
            'is_active' => [
                'type' => Table::TYPE_BOOLEAN,
                'size' => null,
                'options' => ['nullable' => false, 'default' => 1],
                'comment' => 'Department is active',
            ],
            'creation_time' => [
                'type' => Table::TYPE_TIMESTAMP,
                'size' => null,
                'options' => ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'comment' => 'Creation time',
            ],
            'update_time' => [
                'type' => Table::TYPE_TIMESTAMP,
                'size' => null,
                'options' => ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'comment' => 'Update time',
            ],
        ];

        $indexes = [
            'name',
        ];

        $foreignKeys = [
            // No foreign keys for this table
        ];

        /**
         *  We can use the parameters above to create our table
         */

        // Table creation
        $table = $installer->getConnection()->newTable($tableName);

        // Columns creation
        foreach($columns AS $name => $values) {
            $table->addColumn(
                $name,
                $values['type'],
                $values['size'],
                $values['options'],
                $values['comment']
            );
        }

        // Indexes creation
        foreach($indexes AS $index) {
            $table->addIndex(
                $installer->getIdxName($tableName, [$index]),
                [$index]
            );
        }

        // Foreign keys creation
        foreach($foreignKeys AS $column => $foreignKey) {
            $table->addForeignKey(
                $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                $column,
                $foreignKey['ref_table'],
                $foreignKey['ref_column'],
                $foreignKey['on_delete']
            );
        }

        // Table comment
        $table->setComment($tableComment);

        // Execute SQL to create the table
        $installer->getConnection()->createTable($table);


        /**
         * Create table 'phpaiss_jobs_jobs'
         */

        $tableName = $installer->getTable('phpaiss_jobs_jobs');
        $tableComment = 'Job management on Magento 2';
        $columns = [
            'entity_id' => [
                'type' => Table::TYPE_INTEGER,
                'size' => null,
                'options' => ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'comment' => 'Job Id',
            ],
            'title' => [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'options' => ['nullable' => false, 'default' => ''],
                'comment' => 'Job Title',
            ],
            'type' => [
                'type' => Table::TYPE_SMALLINT,
                'size' => null,
                // [0 => 'CDI', 1 => 'CDD']
                'options' => ['nullable' => false, 'default' => 0],
                'comment' => 'Job Type (CDI, CDD)',
            ],
            'location' => [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'options' => ['nullable' => false, 'default' => ''],
                'comment' => 'Job Location',
            ],
            'date' => [
                'type' => Table::TYPE_DATE,
                'size' => null,
                'options' => ['nullable' => false],
                'comment' => 'Job date begin',
            ],
            'image' => [
                'type' => Table::TYPE_TEXT,
                'size' => 1024,
                'options' => ['nullable' => true],
                'comment' => 'Job Image',
            ],
            'description' => [
                'type' => Table::TYPE_TEXT,
                'size' => 2048,
                'options' => ['nullable' => false, 'default' => ''],
                'comment' => 'Job description',
            ],
            'is_active' => [
                'type' => Table::TYPE_BOOLEAN,
                'size' => null,
                'options' => ['nullable' => false, 'default' => 0],
                'comment' => 'Job is active',
            ],
            'department_id' => [
                'type' => Table::TYPE_INTEGER,
                'size' => null,
                'options' => ['unsigned' => true, 'nullable' => false],
                'comment' => 'Department linked to the job',
            ],
            'creation_time' => [
                'type' => Table::TYPE_TIMESTAMP,
                'size' => null,
                'options' => ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'comment' => 'Creation time',
            ],
            'update_time' => [
                'type' => Table::TYPE_TIMESTAMP,
                'size' => null,
                'options' => ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'comment' => 'Update time',
            ],
        ];

        $indexes =  [
            'title',
            'type',
            'location',
        ];

        $foreignKeys = [
            'department_id' => [
                'ref_table' => 'phpaiss_jobs_departments',
                'ref_column' => 'entity_id',
                'on_delete' => Table::ACTION_CASCADE,
            ]
        ];

        /**
         *  We can use the parameters above to create our table
         */

        // Table creation
        $table = $installer->getConnection()->newTable($tableName);

        // Columns creation
        foreach($columns AS $name => $values){
            $table->addColumn(
                $name,
                $values['type'],
                $values['size'],
                $values['options'],
                $values['comment']
            );
        }

        // Indexes creation
        foreach($indexes AS $index){
            $table->addIndex(
                $installer->getIdxName($tableName, [$index]),
                [$index]
            );
        }

        // Foreign keys creation
        foreach($foreignKeys AS $column => $foreignKey){
            $table->addForeignKey(
                $installer->getFkName($tableName, $column, $foreignKey['ref_table'], $foreignKey['ref_column']),
                $column,
                $foreignKey['ref_table'],
                $foreignKey['ref_column'],
                $foreignKey['on_delete']
            );
        }

        // Table comment
        $table->setComment($tableComment);

        // Execute SQL to create the table
        $installer->getConnection()->createTable($table);

        // End Setup
        $installer->endSetup();
    }
}
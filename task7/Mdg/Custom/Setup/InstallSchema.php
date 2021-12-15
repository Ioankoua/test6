<?php

namespace Mdg\Custom\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('mdg_job')) {
            $tableName = $installer->getTable('mdg_job');
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'job_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Job Id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => true,
                        'default' => null
                    ],
                    'Name'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_SMALLINT,
                    null,
                    [
                        'nullable' => true,
                        'default' => null
                    ],
                    'Status'
                )
                ->addIndex(
                    $installer->getIdxName('mdg_job', ['job_id']),
                    ['job_id']
                )
                ->setComment('Mdg Custom')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}

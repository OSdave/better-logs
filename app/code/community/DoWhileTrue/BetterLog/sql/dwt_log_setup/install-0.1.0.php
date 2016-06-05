<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$installer->getConnection()->dropTable($installer->getTable('dwt_log/log'));
$table = $installer->getConnection()
    ->newTable($installer->getTable('dwt_log/log'))
    ->addColumn('log_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 10, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        'auto_increment' => true
    ))
    ->addColumn('file', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array())
    ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, null, array())
    ->addColumn('level', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array())
    ->addColumn('stacktrace', Varien_Db_Ddl_Table::TYPE_TEXT, null, array())
    ->addColumn('origin', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('date', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array())
    ->setComment('Better Logs');
$installer->getConnection()->createTable($table);

$installer->endSetup();

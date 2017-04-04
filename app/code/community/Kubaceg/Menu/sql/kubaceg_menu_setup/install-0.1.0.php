<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_Menu as MENU;

$installer = $this;

$table = $installer->getConnection()
    ->newTable($installer->getTable(MENU::TABLE_ALIAS))
    ->addColumn(MENU::ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn(MENU::NAME_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Name')
    ->addColumn(MENU::IDENTIFIER_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Identifier')
    ->addColumn(MENU::IS_ACTIVE_COLUMN, Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
        'default' => 0,
    ), 'Is active')
    ->addColumn(MENU::STORE_ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => false,
        'unsigned' => true,
    ), 'Store id')
    ->addForeignKey($installer->getFkName(MENU::TABLE_ALIAS, MENU::STORE_ID_COLUMN, 'core/store', 'store_id'),
        MENU::STORE_ID_COLUMN, $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);

$installer->getConnection()->createTable($table);
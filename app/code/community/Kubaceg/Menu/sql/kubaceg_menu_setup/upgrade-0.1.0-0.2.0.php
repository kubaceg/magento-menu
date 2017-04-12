<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuItem as MenuItem;
use Kubaceg_Menu_Model_Resource_Menu as Menu;

$installer = $this;

$table = $installer->getConnection()
    ->newTable($installer->getTable(MenuItem::TABLE_ALIAS))
    ->addColumn(MenuItem::ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn(MenuItem::TITLE_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Title')
    ->addColumn(MenuItem::TARGET_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Target')
    ->addColumn(MenuItem::PARENT_ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
    ), 'Parent')
    ->addColumn(MenuItem::POSITION_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Position')
    ->addColumn(MenuItem::MENU_ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Menu id')
    ->addForeignKey($installer->getFkName(MenuItem::TABLE_ALIAS, MenuItem::PARENT_ID_COLUMN,
        MenuItem::TABLE_ALIAS, MenuItem::ID_COLUMN),
        MenuItem::PARENT_ID_COLUMN, $installer->getTable(MenuItem::TABLE_ALIAS), MenuItem::ID_COLUMN,
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName(MenuItem::TABLE_ALIAS, MenuItem::MENU_ID_COLUMN,
        Menu::TABLE_ALIAS, Menu::ID_COLUMN),
        MenuItem::MENU_ID_COLUMN, $installer->getTable(Menu::TABLE_ALIAS), Menu::ID_COLUMN,
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);

$installer->getConnection()->createTable($table);
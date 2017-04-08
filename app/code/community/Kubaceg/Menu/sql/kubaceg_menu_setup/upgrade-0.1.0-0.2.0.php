<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuPosition as MenuPosition;

$installer = $this;

$table = $installer->getConnection()
    ->newTable($installer->getTable(MenuPosition::TABLE_ALIAS))
    ->addColumn(MenuPosition::ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn(MenuPosition::TITLE_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Title')
    ->addColumn(MenuPosition::TARGET_COLUMN, Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => false,
    ), 'Target')
    ->addColumn(MenuPosition::PARENT_ID_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
    ), 'Parent')
    ->addColumn(MenuPosition::POSITION_COLUMN, Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable' => true,
    ), 'Position')
    ->addForeignKey($installer->getFkName(MenuPosition::TABLE_ALIAS, MenuPosition::TARGET_COLUMN,
        MenuPosition::TABLE_ALIAS, MenuPosition::ID_COLUMN),
        MenuPosition::PARENT_ID_COLUMN, $installer->getTable(MenuPosition::TABLE_ALIAS), MenuPosition::ID_COLUMN,
        Varien_Db_Ddl_Table::ACTION_NO_ACTION, Varien_Db_Ddl_Table::ACTION_NO_ACTION);

$installer->getConnection()->createTable($table);
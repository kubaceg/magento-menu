<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_Resource_MenuItem extends Mage_Core_Model_Resource_Db_Abstract
{
    const TABLE_ALIAS = 'kubaceg_menu/menu_item';

    const ID_COLUMN = 'menu_item_id';
    const NAME_COLUMN = 'name';
    const TITLE_COLUMN = 'title';
    const TARGET_COLUMN = 'target';
    const PARENT_ID_COLUMN = 'parent_id';
    const POSITION_COLUMN = 'position';
    const MENU_ID_COLUMN = 'menu_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_ALIAS, self::ID_COLUMN);
    }
}
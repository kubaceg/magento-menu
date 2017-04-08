<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_Resource_MenuPosition extends Mage_Core_Model_Resource_Db_Abstract
{
    const TABLE_ALIAS = 'kubaceg_menu/menu_position';

    const ID_COLUMN = 'menu_position_id';
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
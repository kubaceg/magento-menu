<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_Resource_Menu extends Mage_Core_Model_Resource_Db_Abstract
{
    const TABLE_ALIAS = 'kubaceg_menu/menu';

    const ID_COLUMN = 'menu_id';
    const NAME_COLUMN = 'name';
    const IDENTIFIER_COLUMN = 'identifier';
    const IS_ACTIVE_COLUMN = 'is_active';
    const STORE_ID_COLUMN = 'store_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_ALIAS, self::ID_COLUMN);
    }

}
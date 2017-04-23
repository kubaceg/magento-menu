<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuItem as Resource;

class Kubaceg_Menu_Model_Resource_MenuItem_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('kubaceg_menu/menuItem');
    }

    public function sortItems()
    {
        $this->getSelect()
            ->order(array('isnull('.Resource::POSITION_COLUMN.'), '.Resource::POSITION_COLUMN.' asc, '.Resource::ID_COLUMN.' asc'));

        return $this;
    }
}
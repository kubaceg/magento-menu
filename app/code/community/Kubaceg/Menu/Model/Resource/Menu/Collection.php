<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_Resource_Menu_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('kubaceg_menu/menu');
    }

}
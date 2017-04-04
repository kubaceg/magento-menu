<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_Menu extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('kubaceg_menu/menu');
    }

}
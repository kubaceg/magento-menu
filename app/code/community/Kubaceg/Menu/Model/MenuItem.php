<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */ 
class Kubaceg_Menu_Model_MenuItem extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('kubaceg_menu/menuItem');
    }

    public function _beforeSave()
    {
        parent::_beforeSave();

        if($this->getParentId() == 0) {
            $this->setParentId(null);
        }
    }
}
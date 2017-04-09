<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

class Kubaceg_Menu_Block_Adminhtml_MenuItem_MenuItemList extends Kubaceg_Menu_Block_Adminhtml_MenuItem_MenuItemLevel
{
    /**
     * @return mixed
     */
    public function getMenuModel()
    {
        return Mage::registry('menu_model');
    }

    public function getMenuItemsArray()
    {
        return Mage::helper('kubaceg_menu/menuItems')->getMenuItemsArray($this->getMenuModel()->getId());
    }

    public function getNewUrl()
    {
        return $this->getUrl('adminhtml/menuItem/new/', ['menuId' => $this->getMenuModel()->getId()]);
    }
}
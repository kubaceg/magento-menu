<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_Menu as Menu;

class Kubaceg_Menu_Block_Menu extends Mage_Core_Block_Template
{
    protected $menu = null;

    protected function _construct()
    {
        $this->addData(array(
            'cache_lifetime' => false,
            'cache_tags'     => array(Mage_Cms_Model_Block::CACHE_TAG),
        ));
    }

    public function getMenu()
    {
        if (empty($this->menu)) {
            $this->menu = Mage::getModel('kubaceg_menu/menu')
                ->getCollection()
                ->addFieldToFilter(Menu::STORE_ID_COLUMN, Mage::app()->getStore()->getId())
                ->addFieldToFilter(Menu::IS_ACTIVE_COLUMN, 1)
                ->addFieldToFilter(Menu::IDENTIFIER_COLUMN, $this->getMenuCode())
                ->getFirstItem();
        }

        return $this->menu;
    }

    public function getMenuLevelHtml()
    {
        $menuArray = Mage::helper('kubaceg_menu/menuItems')->getMenuItemsArray($this->getMenu()->getId());

        return $this->getLayout()
            ->getBlock($this->getMenuItemBlockName())
            ->setData('items', $menuArray)
            ->toHtml();
    }
}
<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuItem as MenuItem;

class Kubaceg_Menu_Block_Adminhtml_MenuItem_MenuItemLevel extends Mage_Adminhtml_Block_Abstract
{
    /**
     * @param array $items
     */
    public function getMenuLevelHtml($items)
    {
        return $this->getLayout()
            ->createBlock('kubaceg_menu/adminhtml_menuItem_menuItemLevel')
            ->setTemplate('kubaceg_menu/menu_level.phtml')
            ->setData('items', $items)
            ->toHtml();
    }

    /**
     * @param array $item
     * @return string
     */
    public function getEditUrl($item)
    {
        return $this->getUrl('adminhtml/menuItem/edit/', ['id' => $item[MenuItem::ID_COLUMN]]);
    }

    /**
     * @param array $item
     * @return string
     */
    public function getDeleteUrl($item)
    {
        return $this->getUrl('adminhtml/menuItem/delete/', ['id' => $item[MenuItem::ID_COLUMN]]);
    }
}
<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuPosition as MenuPosition;

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
        return $this->getUrl('admin/menuItem/edit/', ['id' => $item[MenuPosition::ID_COLUMN]]);
    }

    /**
     * @param array $item
     * @return string
     */
    public function getDeleteUrl($item)
    {
        return $this->getUrl('admin/menuItem/delete/', ['id' => $item[MenuPosition::ID_COLUMN]]);
    }
}
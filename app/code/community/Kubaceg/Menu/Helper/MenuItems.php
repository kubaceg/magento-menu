<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuItem as MenuItem;

class Kubaceg_Menu_Helper_MenuItems extends Mage_Core_Helper_Abstract
{
    /**
     * @param int $menuId
     * @return array
     */
    public function getMenuItemsArray($menuId)
    {
        $menuItems = $this->getMenuItems($menuId);
        $array = [];
        foreach ($menuItems as $menuItem) {
            $array[$menuItem->getId()] = $menuItem->getData();
        }

        return $this->buildMenuTree($array);
    }

    protected function getMenuItems($menuId)
    {
        $menuPositions = Mage::getModel('kubaceg_menu/menuItem')
            ->getCollection()
            ->addFieldToFilter(MenuItem::MENU_ID_COLUMN, $menuId)
            ->setOrder(MenuItem::PARENT_ID_COLUMN, 'ASC');

        return $menuPositions;
    }

    /**
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    protected function buildMenuTree(array $elements, $parentId = 0)
    {
        $tree = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildMenuTree($elements, $element['menu_item_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $tree[] = $element;
            }
        }

        return $tree;
    }
}
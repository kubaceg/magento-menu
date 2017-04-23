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
        $position = 1;
        $array = [];
        foreach ($menuItems as $menuItem) {
            $array[$position++] = $menuItem->getData();
        }
        ksort($array);

        return $this->buildMenuTree($array);
    }

    /**
     * @param $menuId
     * @return array
     */
    protected function getMenuItems($menuId)
    {
        $menuPositions = Mage::getModel('kubaceg_menu/menuItem')
            ->getCollection()
            ->addFieldToFilter(MenuItem::MENU_ID_COLUMN, $menuId)
            ->sortItems();


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
            if ($element[MenuItem::PARENT_ID_COLUMN] == $parentId) {
                $children = $this->buildMenuTree($elements, $element[MenuItem::ID_COLUMN]);
                if ($children) {
                    $element['children'] = $children;
                }
                $tree[] = $element;
            }
        }

        return $tree;
    }
}
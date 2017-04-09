<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuPosition as MenuPosition;

class Kubaceg_Menu_Block_Adminhtml_MenuItem_MenuItemList extends Kubaceg_Menu_Block_Adminhtml_MenuItem_MenuItemLevel
{
    /**
     * @return mixed
     */
    public function getMenuModel()
    {
        return Mage::registry('menu_model');
    }

    public function getMenuItems()
    {
        $menuId = $this->getMenuModel()->getId();

        $menuPositions = Mage::getModel('kubaceg_menu/menuPosition')
            ->getCollection()
            ->addFieldToFilter(MenuPosition::MENU_ID_COLUMN, $menuId)
            ->setOrder(MenuPosition::PARENT_ID_COLUMN, 'ASC');

        return $menuPositions;
    }

    /**
     * @return array
     */
    public function getMenuItemsArray()
    {
        $menuItems = $this->getMenuItems();
        $array = [];
        foreach ($menuItems as $menuItem) {
            $array[$menuItem->getId()] = $menuItem->getData();
        }

        return $this->buildMenuTree($array);
    }

    /**
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    function buildMenuTree(array $elements, $parentId = 0)
    {
        $tree = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildMenuTree($elements, $element['menu_position_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $tree[] = $element;
            }
        }

        return $tree;
    }

    /**
     * @param array $menuItems
     * @param string $html
     * @return string
     */
    protected function buildMenuHtml($menuItems, $html = '')
    {
        $html .= '<ul>';
        foreach ($menuItems as $item) {
            $html .= '<li>';
            $html .= $item['title'];
            $html .= sprintf(' <a href="%s">Edit</a> <a href="%s">Delete</a></li>', $this->getEditUrl($item), $this->getDeleteUrl($item));

            if (!empty($item['children'])) {
                $html = $this->buildMenuHtml($item['children'], $html);
            }
        }
        $html .= '</ul>';

        return $html;
    }
}
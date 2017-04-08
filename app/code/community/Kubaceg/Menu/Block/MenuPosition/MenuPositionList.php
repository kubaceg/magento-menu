<?php
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuPosition as MenuPosition;

class Kubaceg_Menu_Block_MenuPosition_MenuPositionList extends Mage_Adminhtml_Block_Abstract
{
    public function getMenuPositions()
    {
        $menuId = Mage::registry('menu_model')->getId();

        $menuPositions = Mage::getModel('kubaceg_menu/menuPosition')
            ->getCollection()
            ->addFieldToFilter(MenuPosition::MENU_ID_COLUMN, $menuId)
            ->setOrder(MenuPosition::PARENT_ID_COLUMN, 'ASC');

        return $menuPositions;
    }

    public function getMenuPositionsArray()
    {
        $menuPositions = $this->getMenuPositions();
        $array = [];
        foreach ($menuPositions as $menuPosition) {
            $array[$menuPosition->getId()] = $menuPosition->getData();
        }

        return $this->buildTree($array);
    }

    function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['menu_position_id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    protected function buildMenu($array, $html = '')
    {
        $html .= '<ul>';
        foreach ($array as $item) {
            $html .= '<li>';
            $html .= $item['title'];
            $html .= ' <a href="edit">Edit</a> <a href="delete">Delete</a></li>';

            if (!empty($item['children'])) {
                $html = $this->buildMenu($item['children'], $html);
            }
        }
        $html .= '<li><a href="addnew">Add new</a></li>';
        $html .= '</ul>';

        return $html;
    }

    public function _toHtml()
    {
        return $this->buildMenu($this->getMenuPositionsArray());
    }
}
<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_MenuItem as MenuItem;

class Kubaceg_Menu_Block_Adminhtml_MenuItem_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel()
    {
        return Mage::registry('menu_item_model');
    }

    protected function _getHelper()
    {
        return Mage::helper('kubaceg_menu');
    }

    protected function _getModelTitle()
    {
        return 'Menu item';
    }

    protected function _prepareForm()
    {
        $model = $this->_getModel();

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save'),
            'method' => 'post',
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => $this->_getHelper()->__("Menu item information"),
            'class' => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

        $fieldset->addField(MenuItem::TITLE_COLUMN, 'text', array(
            'name' => MenuItem::TITLE_COLUMN,
            'label' => $this->_getHelper()->__('Title'),
            'title' => $this->_getHelper()->__('Title'),
            'required' => true,
        ));

        $fieldset->addField(MenuItem::TARGET_COLUMN, 'text', array(
            'name' => MenuItem::TARGET_COLUMN,
            'label' => $this->_getHelper()->__('Target URL'),
            'title' => $this->_getHelper()->__('Target URL'),
            'required' => true,
        ));

        $fieldset->addField(MenuItem::PARENT_ID_COLUMN, 'select', array(
            'name' => MenuItem::PARENT_ID_COLUMN,
            'label' => $this->_getHelper()->__('Parent item'),
            'title' => $this->_getHelper()->__('Parent item'),
            'options' => $this->getParentIds(),
            'required' => true,
        ));

        $fieldset->addField(MenuItem::MENU_ID_COLUMN, 'hidden', array(
            'name' => MenuItem::MENU_ID_COLUMN,
            'value' => $this->getMenuId()
        ));

        if ($model) {
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * @return int
     */
    protected function getMenuId()
    {
        $model = $this->_getModel();

        if($model) {
            return $model->getMenuId();
        }

        return $this->getRequest()->getParam('menuId');
    }

    /**
     * @return array
     */
    protected function getParentIds()
    {
        $items = Mage::helper('kubaceg_menu/menuItems')->getMenuItemsArray($this->getMenuId());

        return $this->formattedItems($items, 0, []);
    }

    /**
     * @param $items
     * @param int $level
     * @param array $itemsArray
     * @return array
     */
    protected function formattedItems($items, $level = 0, $itemsArray = [])
    {
        $itemsArray[0] = $this->_getHelper()->__('No parent menu item');
        foreach ($items as $item) {
            $itemsArray[$item[MenuItem::ID_COLUMN]] = str_repeat('-', $level) . $item[MenuItem::TITLE_COLUMN];
            if(!empty($item['children'])) {
                $itemsArray = $this->formattedItems($item['children'], $level + 1, $itemsArray);
            }
        }

        return $itemsArray;
    }
}

<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_Menu as Menu;

class Kubaceg_Menu_Block_Adminhtml_Menu_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel()
    {
        return Mage::registry('menu_model');
    }

    protected function _getHelper()
    {
        return Mage::helper('kubaceg_menu');
    }

    protected function _getModelTitle()
    {
        return 'Menus';
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
            'legend' => $this->_getHelper()->__("Menu Information"),
            'class' => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

        $fieldset->addField(Menu::NAME_COLUMN, 'text', array(
            'name' => Menu::NAME_COLUMN,
            'label' => $this->_getHelper()->__('Name'),
            'title' => $this->_getHelper()->__('Name'),
            'required' => true,
        ));

        $fieldset->addField(Menu::IDENTIFIER_COLUMN, 'text', array(
            'name' => Menu::IDENTIFIER_COLUMN,
            'label' => $this->_getHelper()->__('Identifier'),
            'title' => $this->_getHelper()->__('Identifier'),
            'required' => true,
        ));

        $fieldset->addField(Menu::IS_ACTIVE_COLUMN, 'select', array(
            'name' => Menu::IS_ACTIVE_COLUMN,
            'label' => $this->_getHelper()->__('Active'),
            'title' => $this->_getHelper()->__('Active'),
            'values' => [0 => 'No', 1 => 'Yes'],
            'required' => true,
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $field = $fieldset->addField(Menu::STORE_ID_COLUMN, 'select', array(
                'name' => Menu::STORE_ID_COLUMN,
                'label' => $this->_getHelper()->__('Store View'),
                'title' => $this->_getHelper()->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
            $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
            $field->setRenderer($renderer);
        } else {
            $fieldset->addField(Menu::STORE_ID_COLUMN, 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId(),
            ));
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }

        if ($model) {
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}

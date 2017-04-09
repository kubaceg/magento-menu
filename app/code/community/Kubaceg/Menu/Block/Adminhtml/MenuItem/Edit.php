<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Block_Adminhtml_MenuItem_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'kubaceg_menu';
        $this->_controller = 'adminhtml_menuItem';
        $this->_mode = 'edit';
        $modelTitle = $this->_getModelTitle();
        $this->_updateButton('save', 'label', $this->_getHelper()->__("Save $modelTitle"));
    }

    protected function _getHelper()
    {
        return Mage::helper('kubaceg_menu');
    }

    protected function _getModel()
    {
        return Mage::registry('menu_item_model');
    }

    protected function _getModelTitle()
    {
        return 'Menu item';
    }

    public function getHeaderText()
    {
        $model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        if ($model && $model->getId()) {
            return $this->_getHelper()->__("Edit $modelTitle (ID: {$model->getId()})");
        } else {
            return $this->_getHelper()->__("New $modelTitle");
        }
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }

    /**
     * Get form save URL
     *
     * @deprecated
     * @see getFormActionUrl()
     * @return string
     */
    public function getSaveUrl()
    {
        $this->setData('form_action_url', 'save');

        return $this->getFormActionUrl();
    }


}

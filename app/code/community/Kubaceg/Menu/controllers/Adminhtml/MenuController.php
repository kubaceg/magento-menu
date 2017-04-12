<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('kubaceg_menu/menu_grid')->toHtml()
        );
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($id) {
            Mage::register('menu_model', Mage::getModel('kubaceg_menu/menu')->load($id));
        }

        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('kubaceg_menu/menu');
            $model->setData($postData);

            try {
                $model->save();

                $this->_getSession()->addSuccess($this->__('The menu has been saved.'));
                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError($this->__('An error occurred while saving this menu.'));
            }

            $this->_redirectReferer();
        }
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if($id) {
            try {
                $menuItem = Mage::getModel('kubaceg_menu/menu')->load($id);
                $menuItem->delete();
                $this->_getSession()->addSuccess($this->__('The menu has been deleted.'));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }
}
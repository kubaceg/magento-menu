<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Adminhtml_MenuController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Cms'))->_title($this->__('Menus'));
        $this->loadLayout();
        $this->_setActiveMenu('cms/kubaceg_menu');
        $this->_addContent($this->getLayout()->createBlock('kubaceg_menu/menu'));
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
        $this->_addContent($this->getLayout()
            ->createBlock('kubaceg_menu/menu_edit'));

        if ($id) {
            $this->_addContent(
                $this->getLayout()
                    ->createBlock('kubaceg_menu/menuPosition_menuPositionList')
            );
        }

        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('kubaceg_menu/menu');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The menu has been saved.'));
                $this->_redirect('*/*/');

                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this menu.'));
            }

            $this->_redirectReferer();
        }
    }
}
<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Adminhtml_MenuItemController extends Mage_Adminhtml_Controller_Action
{
    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            Mage::register('menu_item_model', Mage::getModel('kubaceg_menu/menuItem')->load($id));
        }

        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('kubaceg_menu/menuItem');
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The menu item has been saved.'));
                $this->_redirect('adminhtml/menu/edit', ['id' => $postData['menu_id']]);

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }

            $this->_redirectReferer();
        }
    }
}
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
        $this->loadLayout();
        $this->_addContent($this->getLayout()
            ->createBlock('kuba_ceg'))
            ->_addLeft($this->getLayout()
                ->createBlock('pfay_films/adminhtml_films_edit_tabs');
        $this->renderLayout();
    }
}
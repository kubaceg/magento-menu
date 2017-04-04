<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */
class Kubaceg_Menu_Block_Menu extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'kubaceg_menu';
        $this->_controller = 'menu';
        $this->_headerText = $this->__('Menus');
        $this->_addButtonLabel = $this->__('Add menu');

        parent::__construct();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/new');
    }

}


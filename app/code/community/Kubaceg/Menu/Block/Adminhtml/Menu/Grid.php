<?php

/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

use Kubaceg_Menu_Model_Resource_Menu as MENU;

class Kubaceg_Menu_Block_Adminhtml_Menu_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('grid_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('kubaceg_menu/menu')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $helper = Mage::helper('kubaceg_menu');

        $this->addColumn(MENU::ID_COLUMN,
            array(
                'header' => $this->__('ID'),
                'width' => '50px',
                'index' => MENU::ID_COLUMN,
            )
        );
        $this->addColumn(MENU::NAME_COLUMN,
            array(
                'header' => $this->__('Name'),
                'index' => MENU::NAME_COLUMN,
            )
        );
        $this->addColumn(MENU::IDENTIFIER_COLUMN,
            array(
                'header' => $this->__('Identifier'),
                'index' => MENU::IDENTIFIER_COLUMN,
            )
        );
        $this->addColumn(MENU::IS_ACTIVE_COLUMN,
            array(
                'header' => $this->__('Is active'),
                'index' => MENU::IS_ACTIVE_COLUMN,
                'type'=>'options',
                'options'   => Mage::getSingleton('adminhtml/system_config_source_yesno')->toArray(),
            )
        );
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn(MENU::STORE_ID_COLUMN, array(
                'header'        => $helper->__('Store View'),
                'index'         => MENU::STORE_ID_COLUMN,
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                => array($this, '_filterStoreCondition'),
            ));
        }

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('kubaceg_menu/menu')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
        ));

        return $this;
    }
}

<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Logs_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('adminhtmlDoWhileTrueBetterLogsGrid');
        $this->setDefaultSort('date');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dwt_log/log')->getCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('log_id', array(
            'header' => Mage::helper('dwt_log')->__('Log ID'),
            'width'  => '50px',
            'index'  => 'log_id',
        ));

        $this->addColumn('file', array(
            'header'  => Mage::helper('dwt_log')->__('File'),
            'width'   => '50px',
            'type'    => 'options',
            'options' => Mage::getSingleton('dwt_log/system_config_source_logfiles')->toArray(),
            'index'   => 'file'
        ));

        $this->addColumn('message', array(
            'header'   => Mage::helper('dwt_log')->__('Message'),
            'index'    => 'message',
            'renderer' => 'dwt_log/adminhtml_renderer_message',
        ));

        $this->addColumn('date', array(
            'header' => Mage::helper('dwt_log')->__('Date Created'),
            'width'  => '150px',
            'type'   => 'datetime',
            'index'  => 'date'
        ));

        $this->addColumn('action', array(
            'header'    =>  Mage::helper('dwt_log')->__('Action'),
            'type'      => 'action',
            'getter'    => 'getId',
            'actions'   => array(
                array(
                    'caption'   => Mage::helper('dwt_log')->__('View'),
                    'url'       => array('base'=> '*/*/detail'),
                    'field'     => 'id'
                )
            ),
            'filter'    => false,
            'sortable'  => false,
            'is_system' => true
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/detail', array('id' => $row->getId()));
    }

}

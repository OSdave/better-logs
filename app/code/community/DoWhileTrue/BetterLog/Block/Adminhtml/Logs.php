<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Logs extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_logs';
        $this->_blockGroup = 'dwt_log';
        $this->_headerText = Mage::helper('dwt_log')->__('Logs Analyzer');
        $this->_removeButton('add');
        parent::__construct();
    }

}

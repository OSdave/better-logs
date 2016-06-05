<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Logs_Detail extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();

        $this->_controller = 'adminhtml_logs';
        $this->_blockGroup = 'dwt_log';
        $this->_mode = 'detail';

        $this->_removeButton('save');
        $this->_removeButton('delete');
    }

    public function getHeaderText()
    {
        return Mage::helper('dwt_log')->__('View Log');
    }

}

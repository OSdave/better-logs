<?php

class DoWhileTrue_BetterLog_Model_Adminhtml_System_Config_Source_Active
{

    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('newsletter')->__('No')),
            array('value' => 1, 'label'=>Mage::helper('newsletter')->__('Yes, no loggin in file')),
            array('value' => 2, 'label'=>Mage::helper('newsletter')->__('Yes, alongsides loggin in file'))
        );
    }

}

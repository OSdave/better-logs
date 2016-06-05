<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Logs_Detail_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $logData = Mage::registry('dwt_log');
        $form    = new Varien_Data_Form(array('id' => 'edit_form'));
        $form->setUseContainer(true);

        /** var $fieldset Varien_Data_Form_Element_Fieldset **/
        $fieldset = $form->addFieldset('edit_form', array('legend' => Mage::helper('dwt_log')->__('Log information')));
        $fieldset->addField('log_id', 'text', array(
            'label' => Mage::helper('dwt_log')->__('Log ID'),
            'name'  => 'log_id'
        ));
        $fieldset->addField('date', 'text', array(
            'label' => Mage::helper('dwt_log')->__('Date'),
            'name'  => 'date'
        ));
        $fieldset->addField('file', 'text', array(
            'label' => Mage::helper('dwt_log')->__('File'),
            'name'  => 'file'
        ));
        $fieldset->addField('message', 'textarea', array(
            'label' => Mage::helper('dwt_log')->__('Message'),
            'name'  => 'message',
            'style' => 'width:500px'
        ));
        $fieldset->addType('stacktrace', 'DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Stacktrace');
        $fieldset->addField('stacktrace', 'stacktrace', array(
            'label'    => Mage::helper('dwt_log')->__('Stacktrace'),
            'name'     => 'stacktrace',
            'style'    => 'width:700px'
        ));
        $fieldset->addType('origin', 'DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Origin');
        $fieldset->addField('origin', 'origin', array(
            'label' => Mage::helper('dwt_log')->__('Origin'),
            'name'  => 'origin'
        ));
        $fieldset->addType('level', 'DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Level');
        $fieldset->addField('level', 'level', array(
            'label' => Mage::helper('dwt_log')->__('Level'),
            'name'  => 'level'
        ));

        $form->setValues($logData);

        $this->setForm($form);
        return parent::_prepareForm();
    }

}

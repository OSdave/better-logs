<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Level extends Varien_Data_Form_Element_Text
{

    public function getElementHtml()
    {
        $zendLog    = new Zend_Log();
        $reflected  = new ReflectionClass($zendLog);
        $priorities = array_flip($reflected->getConstants());

        $value = $this->getValue();
        if (isset($priorities[$value])) {
            return $priorities[$value];
        } else {
            return $value;
        }
    }

}

<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Origin extends Varien_Data_Form_Element_Abstract
{

    public function getElementHtml()
    {
        $value = $this->getValue();

        $html = '<span id="'.$this->getHtmlId().'" name="'.$this->getName().'" '.$this->serialize($this->getHtmlAttributes()).' >';

        $pattern = '|(.+)::([0-9]+)|';
        $html .= Mage::helper('dwt_log')->IDELink($value, $pattern);

        $html .= "</span>";
        $html .= $this->getAfterElementHtml();
        return $html;
    }

}

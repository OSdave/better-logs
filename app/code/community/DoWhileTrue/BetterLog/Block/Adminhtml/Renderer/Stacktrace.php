<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Stacktrace extends Varien_Data_Form_Element_Abstract
{

    public function getElementHtml()
    {
        $value = $this->getValue();
        $unserialized = unserialize($value);

        $html = '<span id="'.$this->getHtmlId().'" name="'.$this->getName().'" '.$this->serialize($this->getHtmlAttributes()).' >';

        $pattern = '|(.+) line ([0-9]+) calls|';
        foreach ($unserialized as $line) {
            $html .= Mage::helper('dwt_log')->IDELink($line, $pattern);
        }
        $html .= "</span>";
        $html .= $this->getAfterElementHtml();
        return $html;
    }

}

<?php

class DoWhileTrue_BetterLog_Block_Adminhtml_Renderer_Message extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
        $result = parent::render($row);
        return substr($result, 0, 150) . ((strlen($result) > 150) ? '...' : '');
    }

}

<?php

class DoWhileTrue_BetterLog_Model_Resource_Log extends Mage_Core_Model_Resource_Db_Abstract
{

    protected function _construct()
    {
        $this->_init('dwt_log/log', 'log_id');
    }

}

<?php

class DoWhileTrue_BetterLog_Model_System_Config_Source_Logfiles
{

    public function toArray()
    {
        $logs = Mage::getModel('dwt_log/log')->getCollection();
        $logs->getSelect()->group('file');
        $files = array();

        foreach ($logs as $log) {
            $files[$log->getFile()] = $log->getFile();
        }

        return $files;
    }

}

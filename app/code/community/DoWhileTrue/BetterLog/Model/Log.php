<?php

class DoWhileTrue_BetterLog_Model_Log extends Mage_Core_Model_Abstract
{

    protected $_eventPrefix = 'dwt_log';
    protected $_eventObject = 'dwt_log';
    protected $_logOrigin;

    protected function _construct()
    {
        $this->_init('dwt_log/log');
    }

    public function create($message, $level = null, $file = '')
    {
        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }
        $stacktrace = $this->_getStacktrace();
        $this->setMessage($message)
                ->setLevel($level)
                ->setFile($file)
                ->setStacktrace(serialize($stacktrace))
                ->setOrigin($this->_logOrigin)
                ->setDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'))
                ->save();
    }

    private function _getStacktrace()
    {
        $dt = debug_backtrace();
        $cs = array();
        foreach ($dt as $t) {
            $cs[] = ((isset($t['file']) ? $t['file'] : 'no file set')) .
                    ' line ' . ((isset($t['line']) ? $t['line'] : 'no line set')) .
                    ' calls ' . ((isset($t['function']) ? $t['function'] . "()" : 'no function set'));
            if (isset($t['class']) && ($t['class'] == 'DoWhileTrue_BetterLog_Helper_Data') && isset($t['type']) && ($t['type'] == '->')) {
                $this->_logOrigin = $t['file'] . '::' . $t['line'];
            }
        }

        return $cs;
    }

}

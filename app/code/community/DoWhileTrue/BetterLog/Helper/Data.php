<?php

class DoWhileTrue_BetterLog_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_CONFIG_PATH_ACTIVE = 'dev/log/dwt_log_active';

    private $_stacktraceAsLink = false;
    private $_stacktraceLink;
    private $_localBasePath;
    private $_serverBasePath;

    protected $_model;

    public function __construct()
    {
        $this->_model = Mage::getSingleton('dwt_log/log');

        if (Mage::getStoreConfigFlag('dev/log/stacktrace_as_link') && Mage::getStoreConfig('dev/log/local_base_path') && Mage::getStoreConfig('dev/log/stacktrace_link')) {
            $this->_stacktraceAsLink = true;
            $this->_stacktraceLink   = Mage::getStoreConfig('dev/log/stacktrace_link');
            $this->_localBasePath    = Mage::getStoreConfig('dev/log/local_base_path');
            $this->_serverBasePath   = Mage::getBaseDir();
        }
    }

    public function log($message, $level = null, $file = '', $forceLog = false)
    {
        $isActive = Mage::getStoreConfig(self::XML_CONFIG_PATH_ACTIVE);
        if ($isActive) {
            if (is_null($level)) {
                $level = Zend_Log::DEBUG;
            }
            if (empty($file)) {
                $file = 'default.log';
            }
            $this->_model->create($message, $level, $file);
        }

        if (!$isActive || ($isActive == 2)) {
            Mage::log($message, $level, $file, $forceLog);
        }
    }

    public function IDELink($line, $pattern)
    {
        if (!$this->_stacktraceAsLink) {
            return $line;
        } else {
            $matches = array();
            preg_match($pattern, $line, $matches, PREG_OFFSET_CAPTURE);

            if (isset($matches[1]) && isset($matches[1][0])) {
                $exploded = explode('/', $matches[1][0]);
                foreach ($exploded as $index => $part) {
                    if ($part != 'app') {
                        unset($exploded[$index]);
                    } else {
                        break;
                    }
                }
                $baseLink =  implode('/', $exploded);
                $link = '<a href="' . $this->_stacktraceLink . $this->_localBasePath . DS .  $baseLink;
                if (isset($matches[2]) && isset($matches[2][0])) {
                    $link .= '?line=' . $matches[2][0];
                } else {
                    $link .= '?line=1';
                }
                $link .= '">' . $line . '</a>';

                return $link;
            } else {
                return $line;
            }
        }
    }


}

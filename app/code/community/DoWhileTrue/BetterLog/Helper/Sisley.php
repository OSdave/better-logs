<?php

class DoWhileTrue_BetterLog_Helper_Sisley extends Mage_Core_Helper_Abstract
{

    public function extractLogsFromFiles()
    {
        Mage::log(date('Ymd H:i:s'), null, 'file', TRUE);
        $this->_extractSelligentPointsEstimations();
        $this->_extractSelligentOrdersToSim();
        $this->_extractNewsletterProspects();
        $this->_extractAccountData('CREATE_MEMBER');
        $this->_extractAccountData('UPDATE_MEMBER');
        Mage::log(date('Ymd H:i:s'), null, 'file', TRUE);
    }

    private function _extractAccountData($stringToLookFor)
    {
        $files = glob(Mage::getBaseDir('var') . DS . 'log' . DS . 'selligent' . DS . 'customer_data*.log');
        foreach ($files as $filename) {
            $busy = false;
            $message = '';
            $date = '';
            $lookForResult = false;
            $handle = fopen($filename, "r");
            while (($line = fgets($handle)) !== false) {
                if ($busy) {
                    if (strstr($line, 'GateName')) {
                        if (!strstr($line, $stringToLookFor)) {
                            $busy = false;
                            $logData = array();
                            $message = '';
                            $lookForResult = false;
                            continue;
                        } else {
                            preg_match('#\[GateName\] => (.*)#', $line, $gatename);
                            $logData['file'] = strtolower($gatename[1]) . '.log';
                        }
                    }
                    $message .= $line;
                    if ($line === ')' . PHP_EOL) {
                        if (!$lookForResult) {
                            $lookForResult = true;
                        } else {
                            $logData['message'] = $message;
                            $this->_model->setData($logData)->save();
                            $busy = false;
                            $logData = array();
                            $message = '';
                            $lookForResult = false;
                        }
                    }
                } else {
                    if (strstr($line, 'TriggerCampaign client args: Array')) {
                        $busy = true;
                        $date = str_replace('T', ' ', substr($line, 0, 19));
                        preg_match('#DEBUG \((.*?)\)#', $line, $match);
                        $logData = array(
                            'level' => $match[1],
                            'date'  => $date,
                        );
                        $message = $line;
                    }
                }
            }
        }
    }

    private function _extractNewsletterProspects()
    {
        $files = glob(Mage::getBaseDir('var') . DS . 'log' . DS . 'selligent' . DS . 'customer_data*.log');
        foreach ($files as $filename) {
            $busy = false;
            $message = '';
            $date = '';
            $lookForResult = false;
            $handle = fopen($filename, "r");
            while (($line = fgets($handle)) !== false) {
                if ($busy) {
                    $message .= $line;
                    if ($line === ')' . PHP_EOL) {
                        if (!$lookForResult) {
                            $lookForResult = true;
                        } else {
                            $logData['message'] = $message;
                            $this->_model->setData($logData)->save();
                            $busy = false;
                            $logData = array();
                            $message = '';
                            $lookForResult = false;
                        }
                    }
                } else {
                    if (strstr($line, 'TriggerCampaign prospect args: Array')) {
                        $busy = true;
                        $date = str_replace('T', ' ', substr($line, 0, 19));
                        preg_match('#DEBUG \((.*?)\)#', $line, $match);
                        $logData = array(
                            'level' => $match[1],
                            'date'  => $date,
                            'file'  => 'newsletter_subscription.log'
                        );
                        $message = $line;
                    }
                }
            }
        }
    }

    private function _extractSelligentOrdersToSim()
    {
        $selligentCallsFiles = glob(Mage::getBaseDir('var') . DS . 'log' . DS . 'club' . DS . 'selligent_call*.log');
        foreach ($selligentCallsFiles as $filename) {
            $busy = false;
            $message = '';
            $date = '';
            $lookForResult = false;
            $handle = fopen($filename, "r");
            while (($line = fgets($handle)) !== false) {
                if ($busy) {
                    $message .= $line;
                    if (strstr($line, 'call type:')) {
                        if (!strstr($line, 'ECOM_CREATE_ACHAT')) {
                            $busy = false;
                            $logData = array();
                            $message = '';
                            continue;
                        } else {
                            $lookForResult = true;
                        }
                    }

                    if ($lookForResult) {
                        if (strstr($line, 'result:')) {
                            $logData['message'] = $message;
                            $this->_model->setData($logData)->save();
                            $busy = false;
                            $logData = array();
                            $message = '';
                            $lookForResult = false;
                        }
                    }
                } else {
                    if (strstr($line, 'data sent: Array')) {
                        $busy = true;
                        $date = str_replace('T', ' ', substr($line, 0, 19));
                        preg_match('#DEBUG \((.*?)\)#', $line, $match);
                        $logData = array(
                            'level' => $match[1],
                            'date'  => $date,
                            'file'  => 'orders_to_sim.log'
                        );
                        $message = $line;
                    }
                }
            }
        }
    }

    private function _extractSelligentPointsEstimations()
    {
        $selligentCallsFiles = glob(Mage::getBaseDir('var') . DS . 'log' . DS . 'club' . DS . 'selligent_call*.log');
        foreach ($selligentCallsFiles as $filename) {
            $busy = false;
            $message = '';
            $date = '';
            $handle = fopen($filename, "r");
            while (($line = fgets($handle)) !== false) {
                if ($busy) {
                    $message .= $line;
                    if ($line === ')' . PHP_EOL) {
                        $busy = false;
                        $logData['message'] = $message;
                        $this->_model->setData($logData)->save();
                        $logData = array();
                    }
                } else {
                    if (strstr($line, 'url appelée:')) {
                        $busy = true;
                        $date = str_replace('T', ' ', substr($line, 0, 19));
                        preg_match('#DEBUG \((.*?)\)#', $line, $match);
                        $logData = array(
                            'level' => $match[1],
                            'date'  => $date,
                            'file'  => 'points_estimation.log'
                        );
                        $message = $line;
                    }
                }
            }
        }
    }

}

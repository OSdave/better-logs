<?php

class DoWhileTrue_BetterLog_Adminhtml_LogsController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/tools/dwt_better_logs');
    }

    public function indexAction()
    {
        $this->_title($this->__('System'))->_title($this->__('Tools'))->_title($this->__('Logs Analyzer'));

        $this->loadLayout();
        $this->_setActiveMenu('system/tools/dwt_better_logs');
        $this->_addBreadcrumb(Mage::helper('dwt_log')->__('Logs Analyzer'), Mage::helper('dwt_log')->__('Logs Analyzer'));

        $this->_addContent($this->getLayout()->createBlock('dwt_log/adminhtml_logs'));
        $this->renderLayout();
    }

    public function detailAction()
    {
        $logId= $this->getRequest()->getParam('id');
        $log = Mage::getModel('dwt_log/log')->load($logId);
        if ($log->getId()) {
            Mage::register('dwt_log', $log);
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('dwt_log')->__('The log does not exist.'));
            $this->_redirect('*/*/');
        }

        $this->_title($this->__('System'))->_title($this->__('Tools'))->_title($this->__('Logs Analyzer'));

        $this->loadLayout();
        $this->_setActiveMenu('system/tools/dwt_better_logs');
        $this->_addBreadcrumb(Mage::helper('dwt_log')->__('Logs Analyzer'), Mage::helper('dwt_log')->__('Logs Analyzer'));

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('dwt_log/adminhtml_logs_detail'));
        $this->renderLayout();
    }

}

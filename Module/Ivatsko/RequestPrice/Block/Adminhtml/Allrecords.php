<?php
namespace Ivatsko\RequestPrice\Block\Adminhtml;

class Allrecords extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_allrecords';
        $this->_blockGroup = 'Ivatsko_RequestPrice';
        $this->_headerText = __('Manage Records');

        parent::_construct();

        if ($this->_isAllowedAction('Ivatsko_RequestPrice::save')) {
            $this->buttonList->update('add', 'label', __('Add new Records'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
?>

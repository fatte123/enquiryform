<?php
/**
 * Adminhtml requestinfo list block
 *
 */
namespace Digital\Requestinfo\Block\Adminhtml;

class Requestinfo extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_requestinfo';
        $this->_blockGroup = 'Digital_Requestinfo';
        $this->_headerText = __('Requestinfo');
        $this->_addButtonLabel = __('Add New Requestinfo');
        parent::_construct();
        $this->buttonList->remove('add');
        if ($this->_isAllowedAction('Digital_Requestinfo::save')) {
            $this->buttonList->update('add', 'label', __('Add New Requestinfo'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}

<?php

namespace Digital\Requestinfo\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Digital_Requestinfo::requestinfo_manage');
    }

    /**
     * Requestinfo List action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Digital_Requestinfo::requestinfo_manage'
        )->addBreadcrumb(
            __('Request Info'),
            __('Request Info')
        )->addBreadcrumb(
            __('Manage Request Info'),
            __('Manage Request Info')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Request Info'));
        return $resultPage;
    }
}

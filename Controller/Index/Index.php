<?php

namespace Digital\Requestinfo\Controller\Index;

use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;
	
	/**
     * @param \Magento\Framework\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    protected $_session; 

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\App\Http\Context $httpContext,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_customerSession = $session;
        $this->httpContext = $httpContext;
        parent::__construct($context);
    }
	
    /**
     * Default Requestinfo Index page
     *
     * @return void
     */
    public function execute()
    {
        if(!$this->_customerSession->isLoggedIn()){
            
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account/login/');
            return $resultRedirect;    
        }
        $this->_view->loadLayout();
		$this->_view->getPage()->getConfig()->getTitle()->set(__('Complete the below application and submit your details.'));       
        
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}

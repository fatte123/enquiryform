<?php

namespace Digital\Requestinfo\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Digital\Requestinfo\Controller\AbstractController\RequestinfoLoaderInterface
     */
    protected $requestinfoLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, RequestinfoLoaderInterface $requestinfoLoader, PageFactory $resultPageFactory)
    {
        $this->requestinfoLoader = $requestinfoLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Requestinfo view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->requestinfoLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}

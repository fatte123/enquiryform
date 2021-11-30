<?php

namespace Digital\Requestinfo\Block;

/**
 * Requestinfo content block
 */
class Requestinfo extends \Magento\Framework\View\Element\Template
{
    /**
     * Requestinfo collection
     *
     * @var Digital\Requestinfo\Model\ResourceModel\Requestinfo\Collection
     */
    protected $_requestinfoCollection = null;
    
    /**
     * Requestinfo factory
     *
     * @var \Digital\Requestinfo\Model\RequestinfoFactory
     */
    protected $_requestinfoCollectionFactory;
    
    /** @var \Digital\Requestinfo\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Digital\Requestinfo\Model\ResourceModel\Requestinfo\CollectionFactory $requestinfoCollectionFactory
     * @param array $data
     */
    protected $session;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Digital\Requestinfo\Model\ResourceModel\Requestinfo\CollectionFactory $requestinfoCollectionFactory,
        \Magento\Customer\Model\Session $session,
        \Digital\Requestinfo\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_requestinfoCollectionFactory = $requestinfoCollectionFactory;
        $this->_customerSession = $session;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve requestinfo collection
     *
     * @return Digital\Requestinfo\Model\ResourceModel\Requestinfo\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_requestinfoCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared requestinfo collection
     *
     * @return Digital\Requestinfo\Model\ResourceModel\Requestinfo\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_requestinfoCollection)) {
            $this->_requestinfoCollection = $this->_getCollection();
            $this->_requestinfoCollection->setCurPage($this->getCurrentPage());
            $this->_requestinfoCollection->setPageSize($this->_dataHelper->getRequestinfoPerPage());
            $this->_requestinfoCollection->setOrder('published_at','asc');
        }

        return $this->_requestinfoCollection;
    }
    
    /**
     * Fetch the current page for the requestinfo list
     *
     * @return int
     */
    public function getCustomerId()
    { 
        if($this->_customerSession->isLoggedIn()){
          return $this->_customerSession->getCustomer()->getId();
        }  
    }
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Digital\Requestinfo\Model\Requestinfo $requestinfoItem
     * @return string
     */
    public function getItemUrl($requestinfoItem)
    {
        return $this->getUrl('*/*/view', array('id' => $requestinfoItem->getId()));
    }
    
    /**
     * Return URL for resized Requestinfo Item image
     *
     * @param Digital\Requestinfo\Model\Requestinfo $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('requestinfo_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $requestinfoPerPage = $this->_dataHelper->getRequestinfoPerPage();

            $pager->setAvailableLimit([$requestinfoPerPage => $requestinfoPerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}

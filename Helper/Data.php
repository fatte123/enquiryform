<?php
namespace Digital\Requestinfo\Helper;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    private $dataPersistor;
	private $postData = null;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
		\Magento\Customer\Model\Session $customerSession
        
    ) {
        $this->_scopeConfig = $context->getScopeConfig();        
        parent::__construct($context);
    }
	private function getDataPersistor()
    {
        if ($this->dataPersistor === null) {
            $this->dataPersistor = ObjectManager::getInstance()
                ->get(DataPersistorInterface::class);
        }
        return $this->dataPersistor;
    }
	public function getPostValue($key)
    {
        if (null === $this->postData) {
            $this->postData = (array) $this->getDataPersistor()->get('requestinfo_captcha');
            //$this->getDataPersistor()->clear('requestinfo_captcha');
        }
        if (isset($this->postData[$key])) {
            return (string) $this->postData[$key];
        }
        return '';
    }
}

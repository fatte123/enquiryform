<?php

namespace Digital\Requestinfo\Controller\Index;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\StoreManagerInterface; 


class Post extends \Magento\Framework\App\Action\Action
{

  
    protected $storeManager;
 
    public function __construct(
    StoreManagerInterface $storeManager,	
	DataPersistorInterface $dataPersistor,
    \Magento\Framework\App\Action\Context  $context
    )
    {
        $this->storeManager = $storeManager;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->inlineTranslation = $objectManager->get('Magento\Framework\Translate\Inline\StateInterface');
        $this->storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $this->_transportBuilder = $objectManager->get('Magento\Framework\Mail\Template\TransportBuilder');
        $this->scopeConfig = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface');
        
        $post = $this->getRequest()->getPostValue();   

        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }
        try
        {
             $postObject = new \Magento\Framework\DataObject();
             $postObject->setData($post);
              $error = false;

            if (!\Zend_Validate::is(trim($post['name']), 'NotEmpty')) {
                $error = true;
            }  
            if (!\Zend_Validate::is(trim($post['phone']), 'NotEmpty')) {
                $error = true;
            } 
            if (!\Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                $error = true;
            } 
            /*if (!\Zend_Validate::is(trim($post['sapcustomerid']), 'NotEmpty')){
                $error = true;
            }*/ 
            if (!\Zend_Validate::is(trim($post['detailsofchangesrequired']), 'NotEmpty')) {
                $error = true;
            }
            if ($error) {
                throw new \Exception();
            }  

           $sentToEmail = $this->scopeConfig ->getValue('trans_email/ident_general/email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
             
            $sentToName = $this->scopeConfig ->getValue('trans_email/ident_general/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);


           /* Email To Admin*/
           $setFrom = [
                    'name' =>  $sentToName,
                    'email' => $sentToEmail,
                ];

            $templateOptions = array('area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId());
           $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
                  

            $transport = $this->_transportBuilder
                ->setTemplateIdentifier('requestinfo_email_thankyouemail_template1')
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars(['data' => $postObject])
                ->setFrom($setFrom)
                ->addTo($sentToEmail,$sentToName)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
                    
            /* Email To User */         
            $storeScope1 = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $transport1 = $this->_transportBuilder  
                ->setTemplateIdentifier('requestinfo_email_thankyouemail_template')
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars(['data' => $postObject])
                ->setFrom($setFrom)
                ->addTo($post['email'])
                ->getTransport();
            $transport1->sendMessage();

            $model = $this->_objectManager->create('Digital\Requestinfo\Model\Requestinfo');
            $model->setData($post);
            $model->save();
            

            $this->messageManager->addSuccess(
                __('Thank you for your enquiry. It has been received, and we will be in contact with you shortly.')
            );
          $this->dataPersistor->clear('requestinfo_captcha');
          $this->dataPersistor->clear('requestinfo');
          $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;

        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
        }
        catch(\Exception $e){          
         
            //$this->inlineTranslation->resume();
            $this->messageManager->addError(
                __('We can\'t process your request right now. Sorry, that\'s all we know.')
            );
            $this->dataPersistor->set('requestinfo_captcha', $this->getRequest()->getPostValue());
            $this->getDataPersistor()->set('requestinfo', $post);
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        // Your code
	
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
        }
    }   
}

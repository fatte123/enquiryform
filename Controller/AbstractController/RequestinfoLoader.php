<?php

namespace Digital\Requestinfo\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class RequestinfoLoader implements RequestinfoLoaderInterface
{
    /**
     * @var \Digital\Requestinfo\Model\RequestinfoFactory
     */
    protected $requestinfoFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Digital\Requestinfo\Model\RequestinfoFactory $requestinfoFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Digital\Requestinfo\Model\RequestinfoFactory $requestinfoFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->requestinfoFactory = $requestinfoFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $requestinfo = $this->requestinfoFactory->create()->load($id);
        $this->registry->register('current_requestinfo', $requestinfo);
        return true;
    }
}

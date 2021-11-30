<?php

namespace Digital\Requestinfo\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface RequestinfoLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Digital\Requestinfo\Model\Requestinfo
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}

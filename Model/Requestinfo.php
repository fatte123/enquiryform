<?php

namespace Digital\Requestinfo\Model;

/**
 * Requestinfo Model
 *
 * @method \Digital\Requestinfo\Model\Resource\Page _getResource()
 * @method \Digital\Requestinfo\Model\Resource\Page getResource()
 */
class Requestinfo extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Requestinfo\Model\ResourceModel\Requestinfo');
    }

}

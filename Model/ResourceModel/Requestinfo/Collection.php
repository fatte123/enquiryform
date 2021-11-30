<?php

/**
 * Requestinfo Resource Collection
 */
namespace Digital\Requestinfo\Model\ResourceModel\Requestinfo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Digital\Requestinfo\Model\Requestinfo', 'Digital\Requestinfo\Model\ResourceModel\Requestinfo');
    }
}

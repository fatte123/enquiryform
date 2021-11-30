<?php

namespace Digital\Requestinfo\Model\ResourceModel;

/**
 * Requestinfo Resource Model
 */
class Requestinfo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('digital_requestinfo', 'requestinfo_id');
    }
}

<?php

namespace Custom\CustomModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomTable extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_table', 'id_custom');
    }
}
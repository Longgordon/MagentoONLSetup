<?php

namespace Custom\CustomModule\Model\ResourceModel\CustomTable;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id_custom';

    protected function _construct()
    {
        $this->_init(
            \Custom\CustomModule\Model\CustomTable::class,
            \Custom\CustomModule\Model\ResourceModel\CustomTable::class
        );
    }
}
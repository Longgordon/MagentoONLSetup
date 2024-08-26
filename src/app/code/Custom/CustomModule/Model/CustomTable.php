<?php

namespace Custom\CustomModule\Model;

use Magento\Framework\Model\AbstractModel;

class CustomTable extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Custom\CustomModule\Model\ResourceModel\CustomTable::class);
    }
}

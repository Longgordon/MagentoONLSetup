<?php

namespace Custom\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Custom\CustomModule\Model\CustomTableFactory;
use Magento\Framework\App\Action\Context;
use \Custom\CustomModule\Model\CustomTable;

class Index extends Action
{
    protected $_customTableFactory;

    public function __construct(Context $context, CustomTableFactory $customTableFactory)
    {
        $this->_customTableFactory = $customTableFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $connection = $this->_objectManager->get('Magento\Framework\App\ResourceConnection')->getConnection();
        $sql = "SELECT * FROM custom_table WHERE name_custom = :name_custom";
        $binds = ['name_custom' => 'long'];
        $data = $connection->fetchAll($sql);

        print_r($data);
        exit;

        $model = $this->_customTableFactory->create();
        $collection = $model->getCollection();
        $data = $collection->getData();
        print_r($data);
        exit;

        $model = $this->_objectManager->create(CustomTable::class);
        $data1 = $model->getData();

        $collection = $model->getCollection();

        $collection->addFieldToFilter('name_custom', 'long');

        foreach ($collection as $item) {
            $item->setNameCustom('long');
            $item->save();
        }

        echo 'Data updated and saved successfully';
        exit;
    }
}

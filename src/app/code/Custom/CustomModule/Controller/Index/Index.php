<?php

namespace Custom\CustomModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    public function execute()
    {
        $collection = $this->_objectManager->create('Custom\CustomModule\Model\ResourceModel\CustomTable\Collection');

        $collection->addFieldToFilter('name_custom', 'test');

        foreach ($collection as $item) {
            $item->setNameCustom('test1');
            $item->save();
        }

        $data1 = $collection->getData();

        echo '<pre>';
        print_r($data1);
        echo '</pre>';
        echo 'Data updated and saved successfully';
        exit;
    }
}

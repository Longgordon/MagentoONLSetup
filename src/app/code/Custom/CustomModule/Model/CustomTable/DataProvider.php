<?php

namespace Custom\CustomModule\Model\CustomTable;

use Custom\CustomModule\Model\ResourceModel\CustomTable\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;
    protected $dataPersistor;
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $customTableCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $customTableCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     */
    public function getData()
    {
        // Get items
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $customTable) {
            $this->loadedData[$customTable->getId()] = $customTable->getData();
        }

        $data = $this->dataPersistor->get('custom_table');
        if (!empty($data)) {
            $_t= $this->collection->getNewEmptyItem();
            $customTable->setData($data);
            $this->loadedData[$customTable->getId()] = $customTable->getData();
            $this->dataPersistor->clear('custom_table');
        }

        return $this->loadedData;
    }
}
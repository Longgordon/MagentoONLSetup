<?php

namespace Custom\CustomModule\Controller\Hello;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ActionInterface;

class World implements ActionInterface
{
    protected $_pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}

<?php

namespace Custom\CustomModule\Block;

use Magento\Framework\View\Element\Template;

class HelloWorld extends Template
{
    public function getHelloWorldTxt()
    {
        return 'Hello world of M2';
    }

    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}

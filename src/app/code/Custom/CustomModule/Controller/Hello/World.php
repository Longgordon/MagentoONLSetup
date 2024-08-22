<?php

namespace Custom\CustomModule\Controller\Hello;

class World implements \Magento\Framework\App\ActionInterface
{
    public function execute()
    {
        echo 'Hello World';
        exit;
    }
}

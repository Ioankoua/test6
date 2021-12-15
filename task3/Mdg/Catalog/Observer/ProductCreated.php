<?php

namespace Mdg\Catalog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductCreated implements ObserverInterface
{
    public $prefix_new = 'NEW';

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();

        if (!$product->getId()) {
            $prodName = $product->getName();
            $prefixName = $this->prefix_new.' '.$prodName;
            $product->setName($prefixName);;
        }
    }
}

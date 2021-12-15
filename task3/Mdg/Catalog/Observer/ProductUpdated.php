<?php

declare(strict_types=1);

namespace Mdg\Catalog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ProductUpdated implements ObserverInterface
{
    public $prefixNEW = 'NEW';
    public $prefixED = 'EDITED';

    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();

        if ($product->getId()) {
            $prodName = $product->getName();
            $issetPrefNew = substr($prodName, 0, 3);
            $issetPrefEd = substr($prodName, 0, 6);

            if ($issetPrefNew === $this->prefixNEW) {
                $prefixName = str_replace($this->prefixNEW, $this->prefixED, $prodName);
                $product->setName($prefixName);
            }

            if ($issetPrefNew != $this->prefixNEW && $issetPrefEd != $this->prefixED){
                $prefixName = $this->prefixED.' '.$prodName;
                $product->setName($prefixName);
            }
        }
    }

}


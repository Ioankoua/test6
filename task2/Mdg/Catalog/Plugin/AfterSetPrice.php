<?php

namespace Mdg\Catalog\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Mdg\Catalog\Model\GetConfigPrice;

class AfterSetPrice
{
    public $configPrice;

    public function __construct(GetConfigPrice $configPrice)
    {
        $this->configPrice = $configPrice;
    }

    public function afterGetPrice(ProductInterface $subject, $result)
    {
        return $result + $this->configPrice->getValue('');
    }
}

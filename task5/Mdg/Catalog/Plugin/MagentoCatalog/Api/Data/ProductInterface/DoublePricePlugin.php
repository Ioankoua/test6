<?php

declare(strict_types=1);

namespace Mdg\Catalog\Plugin\MagentoCatalog\Api\Data\ProductInterface;

use Magento\Catalog\Api\Data\ProductInterface;

class DoublePricePlugin
{
    public function afterGetPrice(ProductInterface $product, $price)
    {
        $doublePrice = $price * 2;

        return $doublePrice;
    }
}

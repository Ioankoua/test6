<?php

declare(strict_types=1);

namespace Mdg\Catalog\Plugin\MagentoCatalog\Api\Data\ProductInterface;

use Magento\Catalog\Api\Data\ProductInterface;


class NameCustomize
{
    public $lastword = ' CUSTOMIZED';

    public function beforeSetName(ProductInterface $subject, $name): string
    {
        $len = strlen($this->lastword);
        $lastpart = substr($name, -$len, $len);

        if ($this->lastword != $lastpart) {
            $name.= $this->lastword;
        }
        return $name;
    }

}

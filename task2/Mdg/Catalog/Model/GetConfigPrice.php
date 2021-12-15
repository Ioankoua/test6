<?php

namespace Mdg\Catalog\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class GetConfigPrice
{
    public $path = 'mdg_catalog_section/group_product/add_to_price';

    public $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;

        $this->scopeConfig->getValue('dev/debug/template_hints',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getValue($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null)
    {
        $configPrice = $this->scopeConfig->getValue($this->path, $scopeType, $scopeCode);

        return $configPrice;
    }

}

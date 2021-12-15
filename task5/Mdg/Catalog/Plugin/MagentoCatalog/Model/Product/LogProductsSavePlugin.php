<?php

declare(strict_types=1);

namespace Mdg\Catalog\Plugin\MagentoCatalog\Model\Product;

use Magento\Catalog\Model\Product;
use Psr\Log\LoggerInterface;

class LogProductsSavePlugin
{
    private LoggerInterface $logger;

    public $price = 100;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function aroundSave(Product $subject, callable $proceed): Product
    {
        if (!$subject->getId()) {
            $this->logger->info("SKU: {$subject->getSku()} is NEW.");
        }

        $result = $proceed();

        if ($result->getPrice() < $this->price) {
            $this->logger->info("SKU: {$result->getSku()} price is lower then 100!");
        }

        return $result;
    }
}

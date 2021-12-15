<?php

namespace Mdg\Custom\Observer;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Exception;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

/**
 * Class MyObserver
 */
class LoggerError implements ObserverInterface
{
    /**
     * @var PsrLoggerInterface
     */
    private $logger;

    /**
     * MyObserver constructor.
     *
     * @param PsrLoggerInterface $logger
     */
    public function __construct(
        PsrLoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        try {
            return true;
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}

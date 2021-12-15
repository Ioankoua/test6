<?php

namespace Mdg\Custom\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::ERROR;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/custom.log';
}

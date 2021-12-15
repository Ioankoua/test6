<?php

namespace Mdg\Custom\Cron;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Mdg\Custom\Model\Bestelers;


class Test
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * @var Bestelers
     */
    private $bestelrs;

    public function __construct(
        Filesystem $filesystem,
        DirectoryList $directoryList,
        Bestelers $bestelrs
    ) {
        $this->directoryList = $directoryList;
        $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $this->bestelrs = $bestelrs;
    }

    /**
     * Returns csv file path media/export/day_bestseller.csv
     *
     * @return void
     */
    public function execute()
    {
        $filepath = 'media/export/day_bestseller.csv';
        $this->directory->create('export');
        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();

        $header = ['Id', 'Sku', 'Name', 'Price', 'Date'];
        $stream->writeCsv($header);
        $x = 0;
        $printItems = $this->bestelrs->execute();
        foreach ($printItems as $item) {
            $itemData = [];
            $itemData[] = $item->getId();
            $itemData[] = $item->getSku();
            $itemData[] = $item->getName();
            $itemData[] = $item->getPrice();
            $itemData[] =  $item->getCreatedAt();
            $stream->writeCsv($itemData);
        }
    }

}


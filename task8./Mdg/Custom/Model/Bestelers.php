<?php

namespace Mdg\Custom\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;


class Bestelers
{
    private const COUNT_BESTELERS = 5;

    /**
     * @var ProductRepositoryInterface
     */
    private $product;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $search;


    public function __construct(

        ProductRepositoryInterface $product,
        DateTime $dateTime,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $search
    ) {
        $this->product = $product;
        $this->dateTime = $dateTime;
        $this->orderRepository = $orderRepository;
        $this->search = $search;
    }

    /**
     * Returns 5 most popular products of yesterday
     *
     * @return array
     */
    public function execute()
    {
        $orders = $this->yesterdayOrders();

        $productStock = $this->yesterdaySold($orders);

        $bestelrs = $this->yesterdayBestelers($productStock);

        return  $bestelrs;
    }

    private function yesterdayOrders()
    {
        $yesterday = $this->dateTime->gmtDate('Y.m.d', strtotime("-1 days"));

        $startDay = "$yesterday" . " " . "00:00:00";
        $endDay = "$yesterday" . " " . "23:59:59";

        $searchCriteria = $this->search
            ->addFilter('created_at', $startDay, 'gteq')
            ->addFilter('created_at', $endDay, 'lteq')
            ->create();

        return $orders = $this->orderRepository->getList($searchCriteria)->getItems();
    }

    private function yesterdaySold($orders)
    {
        foreach ($orders as $order) {
            $items = $order->getItems();
            foreach ($items as $item) {
                $productStock[] = $item->getSku();
            }
        }
        if (!empty($productStock)){

            return $productStock;
        }else{
            return false;
        }
    }

    private function yesterdayBestelers($productStock)
    {
        $buyTime = array_count_values($productStock);
        array_multisort($buyTime, SORT_DESC);

        $bestelers = array_slice($buyTime, 0, 5);
        $count = 0;

        while ($count < self::COUNT_BESTELERS) {
            $printItems[] = $this->product->get(key($bestelers));
            next($bestelers);
            $count++;
        }
        if (count($printItems) == 5){
            return $printItems;
        }else{
            return false;
        }
    }

}

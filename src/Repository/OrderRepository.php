<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findLatestOrders(int $limit = 5): array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getOrderTotals(): array
    {
        return $this->createQueryBuilder('o')
            ->select('o.id, o.createdAt, SUM(oi.productPrice * oi.quantity) as orderTotal')
            ->join('o.orderItem', 'oi')
            ->groupBy('o.id')
            ->orderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getMonthlySalesData(): array
    {
        return $this->createQueryBuilder('o')
            ->select('SUBSTRING(o.createdAt, 1, 7) as month, SUM(oi.productPrice * oi.quantity) as totalSales')
            ->join('o.orderItem', 'oi')
            ->groupBy('month')
            ->orderBy('month', 'DESC')
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();
    }
}

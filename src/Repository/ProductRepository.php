<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public const PRODUCT_ID = 'COUNT(p.id)';
    public const STATUS_CONDITION = 'p.status = :status';
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllProducts()
    {
        return $this->createQueryBuilder('p')
            ->select('p, c, i')
            ->join('p.category', 'c')
            ->leftJoin('p.image', 'i')
            ->getQuery()
            ->getResult();
    }

    public function getProductAvailabilityRatios(): array
    {
        $totalProducts = $this->createQueryBuilder('p')
            ->select(self::PRODUCT_ID)
            ->getQuery()
            ->getSingleScalarResult();

        $inStock = $this->createQueryBuilder('p')
            ->select(self::PRODUCT_ID)
            ->where(self::STATUS_CONDITION)
            ->setParameter('status', 'Available')
            ->getQuery()
            ->getSingleScalarResult();

        $outOfStock = $this->createQueryBuilder('p')
            ->select(self::PRODUCT_ID)
            ->where(self::STATUS_CONDITION)
            ->setParameter('status', 'Out')
            ->getQuery()
            ->getSingleScalarResult();

        $preOrder = $this->createQueryBuilder('p')
            ->select(self::PRODUCT_ID)
            ->where(self::STATUS_CONDITION)
            ->setParameter('status', 'Preorder')
            ->getQuery()
            ->getSingleScalarResult();

        return [
            'inStock' => $inStock / $totalProducts * 100,
            'outOfStock' => $outOfStock / $totalProducts * 100,
            'preOrder' => $preOrder / $totalProducts * 100,
        ];
    }
}

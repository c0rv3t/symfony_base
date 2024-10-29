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
}

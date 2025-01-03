<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product, bool $flush = false): void
    {
        $entityManager = $this->getEntityManager(); // Use getEntityManager() to access the EntityManager
        $entityManager->persist($product);
        if ($flush) {
            $entityManager->flush();
        }
    }

    public function remove(Product $product, bool $flush = false): void
    {
        $entityManager = $this->getEntityManager(); // Use getEntityManager() to access the EntityManager
        $entityManager->remove($product);
        if ($flush) {
            $entityManager->flush();
        }
    }
}

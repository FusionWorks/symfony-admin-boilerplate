<?php

namespace App\Repository;

use App\Entity\Seller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Seller|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seller|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seller[]    findAll()
 * @method Seller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SellerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Seller::class);
    }
}

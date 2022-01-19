<?php

namespace App\Repository;

use App\Entity\ProductScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductScore[]    findAll()
 * @method ProductScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductScore::class);
    }

    // /**
    //  * @return ProductScore[] Returns an array of ProductScore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductScore
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

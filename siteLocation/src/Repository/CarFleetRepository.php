<?php

namespace App\Repository;

use App\Entity\CarFleet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CarFleet|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarFleet|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarFleet[]    findAll()
 * @method CarFleet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarFleetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarFleet::class);
    }

    // /**
    //  * @return CarFleet[] Returns an array of CarFleet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarFleet
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

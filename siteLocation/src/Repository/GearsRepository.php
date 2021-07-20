<?php

namespace App\Repository;

use App\Entity\Gears;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gears|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gears|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gears[]    findAll()
 * @method Gears[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GearsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gears::class);
    }

    // /**
    //  * @return Gears[] Returns an array of Gears objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gears
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

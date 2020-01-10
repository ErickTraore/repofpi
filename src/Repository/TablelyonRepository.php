<?php

namespace App\Repository;

use App\Entity\Tablelyon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tablelyon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tablelyon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tablelyon[]    findAll()
 * @method Tablelyon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TablelyonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tablelyon::class);
    }

    // /**
    //  * @return Tablelyon[] Returns an array of Tablelyon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tablelyon
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\FrenchSango;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FrenchSango|null find($id, $lockMode = null, $lockVersion = null)
 * @method FrenchSango|null findOneBy(array $criteria, array $orderBy = null)
 * @method FrenchSango[]    findAll()
 * @method FrenchSango[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrenchSangoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FrenchSango::class);
    }

    // /**
    //  * @return FrenchSango[] Returns an array of FrenchSango objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FrenchSango
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

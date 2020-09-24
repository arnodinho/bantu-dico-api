<?php

namespace App\Repository;

use App\Entity\Lingala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lingala|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lingala|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lingala[]    findAll()
 * @method Lingala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @codeCoverageIgnore
 */
class LingalaRepository extends ServiceEntityRepository implements StorableRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lingala::class);
    }

    // /**
    //  * @return Lingala[] Returns an array of Lingala objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lingala
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

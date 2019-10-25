<?php

namespace App\Repository;

use App\Entity\Protest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Protest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Protest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Protest[]    findAll()
 * @method Protest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProtestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Protest::class);
    }

    // /**
    //  * @return Protest[] Returns an array of Protest objects
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
    public function findOneBySomeField($value): ?Protest
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

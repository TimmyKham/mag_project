<?php

namespace App\Repository;

use App\Entity\Magazines;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Magazines|null find($id, $lockMode = null, $lockVersion = null)
 * @method Magazines|null findOneBy(array $criteria, array $orderBy = null)
 * @method Magazines[]    findAll()
 * @method Magazines[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MagazinesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Magazines::class);
    }

    // /**
    //  * @return Magazines[] Returns an array of Magazines objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Magazines
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }
}

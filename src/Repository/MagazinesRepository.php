<?php

namespace App\Repository;

use App\Entity\Magazines;
use App\Entity\MagazinesSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use PhpParser\Builder\Property;

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

    /**
     * @return Query
     */
    public function findAllVisibleQuery(MagazinesSearch $search):Query{
        $query = $this->findVisibleQuery();
        if ($search ->getMaxPrice()) {
            $query = $query
                ->andWhere('p.price <= :maxprice')
                ->setParameter('maxprice', $search->getMaxPrice());
        }
            return $query -> getQuery();
    }

    /**
     * @return Property[]
     */
    public function findLatest(): array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }
    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p');
    }


}

<?php

namespace App\Repository;

use App\Entity\Pneumatiques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pneumatiques|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pneumatiques|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pneumatiques[]    findAll()
 * @method Pneumatiques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PneumatiquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pneumatiques::class);
    }

    // /**
    //  * @return Pneumatiques[] Returns an array of Pneumatiques objects
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
    public function findOneBySomeField($value): ?Pneumatiques
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

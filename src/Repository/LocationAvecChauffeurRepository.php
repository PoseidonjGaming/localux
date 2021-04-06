<?php

namespace App\Repository;

use App\Entity\LocationAvecChauffeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationAvecChauffeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationAvecChauffeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationAvecChauffeur[]    findAll()
 * @method LocationAvecChauffeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationAvecChauffeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocationAvecChauffeur::class);
    }

    // /**
    //  * @return LocationAvecChauffeur[] Returns an array of LocationAvecChauffeur objects
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
    public function findOneBySomeField($value): ?LocationAvecChauffeur
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

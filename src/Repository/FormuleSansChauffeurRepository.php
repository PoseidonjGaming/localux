<?php

namespace App\Repository;

use App\Entity\FormuleSansChauffeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormuleSansChauffeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormuleSansChauffeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormuleSansChauffeur[]    findAll()
 * @method FormuleSansChauffeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormuleSansChauffeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormuleSansChauffeur::class);
    }

    // /**
    //  * @return FormuleSansChauffeur[] Returns an array of FormuleSansChauffeur objects
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
    public function findOneBySomeField($value): ?FormuleSansChauffeur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findWhere($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.duree = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

<?php

namespace App\Repository;

use App\Entity\Tarification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tarification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarification[]    findAll()
 * @method Tarification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarification::class);
    }

    // /**
    //  * @return Tarification[] Returns an array of Tarification objects
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
    public function findOneBySomeField($value): ?Tarification
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findWhere($value, $formule)
    {
        return $this->createQueryBuilder('t')->Join('t.laFormuleSC','f')
            ->Where('t.leModele = :val')
            ->andWhere('f.libelle= :formule')
            ->setParameter('val', $value)
            ->setParameter('formule', $formule)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

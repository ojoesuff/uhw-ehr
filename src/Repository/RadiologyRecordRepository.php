<?php

namespace App\Repository;

use App\Entity\RadiologyRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RadiologyRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method RadiologyRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method RadiologyRecord[]    findAll()
 * @method RadiologyRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RadiologyRecordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RadiologyRecord::class);
    }

    // /**
    //  * @return RadiologyRecord[] Returns an array of RadiologyRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RadiologyRecord
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

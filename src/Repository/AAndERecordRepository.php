<?php

namespace App\Repository;

use App\Entity\AAndERecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AAndERecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method AAndERecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method AAndERecord[]    findAll()
 * @method AAndERecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AAndERecordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AAndERecord::class);
    }

    // /**
    //  * @return AAndERecord[] Returns an array of AAndERecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AAndERecord
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

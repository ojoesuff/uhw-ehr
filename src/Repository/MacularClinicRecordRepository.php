<?php

namespace App\Repository;

use App\Entity\MacularClinicRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MacularClinicRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method MacularClinicRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method MacularClinicRecord[]    findAll()
 * @method MacularClinicRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MacularClinicRecordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MacularClinicRecord::class);
    }

    // /**
    //  * @return MacularClinicRecord[] Returns an array of MacularClinicRecord objects
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
    public function findOneBySomeField($value): ?MacularClinicRecord
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

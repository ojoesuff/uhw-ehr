<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    // /**
    //  * @return Patient[] Returns an array of Patient objects
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
    public function findOneBySomeField($value): ?Patient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findPatientsByName($name) {

        return $this->createQueryBuilder('p')
            ->andWhere('p.firstName LIKE :name OR p.lastName LIKE :name')
            ->setParameter('name', $name.'%')
            ->orderBy('p.firstName', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

    }

    public function findPatientsAdvanced($firstName,  $middleNames, $lastName, 
    $email, $addressLine1, $addressLine2, $addressLine3, $dob) {

        $dobDefault = create_date("1000-01-01");

        //starts query builder
        $queryBuilder = $this->createQueryBuilder('p');
        //only add query parameters if fields are not empty or default
        if(!empty($firstName)) {
            $queryBuilder
                ->andWhere('p.firstName LIKE :firstName')
                ->setParameter('firstName', '%'.$firstName.'%');
        }
        if(!$dob === $dobDefault) {
            $queryBuilder
                ->andWhere('p.dateOfBirth >= :date_start')
                ->andWhere('p.dateOfBirth <= :date_end')
                ->setParameter('date_start', $dobDefault->format('Y-m-d 00:00:00'))
                ->setParameter('date_end',   $dobDefault->format('Y-m-d 23:59:59'));
        }

        return $queryBuilder
            ->getQuery()
            ->getResult();

    }
}

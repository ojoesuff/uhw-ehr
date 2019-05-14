<?php

namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Appointment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appointment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appointment[]    findAll()
 * @method Appointment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

    // /**
    //  * @return Appointment[] Returns an array of Appointment objects
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
    public function findOneBySomeField($value): ?Appointment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getFiveMostRecentOutstandingApp($patientId) { 
        return $this->createQueryBuilder('p')
        ->andWhere("p.patient = $patientId")
        ->andWhere('p.complete = 0')
        ->orderBy('p.date', 'ASC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult();
    }
    public function getThreeCompletedApps($patientId) { 
        return $this->createQueryBuilder('p')
        ->andWhere("p.patient = $patientId")
        ->andWhere('p.complete = 1')
        ->orderBy('p.date', 'ASC')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
    }

    public function getAppointmentsByDate($patientId, $date) {
        return $this->createQueryBuilder('app')        
        ->andWhere('app.date >= :date_start')
        ->andWhere('app.date <= :date_end')
        ->andWhere('app.complete = 0')
        // found at https://stackoverflow.com/questions/11553183/select-entries-between-dates-in-doctrine-2
        ->setParameter('date_start', $date->format('Y-m-d 00:00:00'))
        ->setParameter('date_end',   $date->format('Y-m-d 23:59:59'))
        ->orderBy('app.date', 'ASC')
        ->getQuery()
        ->getResult();
    }

    public function getAllPreviousAppoint($patientId) { 
        return $this->createQueryBuilder('app')
        ->andWhere("app.patient = $patientId")
        ->andWhere('app.complete = 1')
        ->orderBy('app.date', 'ASC')
        ->getQuery()
        ->getResult();
    }
}

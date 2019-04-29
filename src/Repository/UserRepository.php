<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findStaffAdvanced($firstName, $lastName, 
    $username, $staffType) {

        //starts query builder
        $queryBuilder = $this->createQueryBuilder('s');
        //only add query parameters if fields are not empty or default
        if(!empty($firstName)) {
            $queryBuilder
                ->andWhere('s.firstName LIKE :firstName')
                ->setParameter('firstName', '%'.$firstName.'%');
        }
        if(!empty($lastName)) {
            $queryBuilder
                ->andWhere('s.lastName LIKE :lastName')
                ->setParameter('lastName', '%'.$lastName.'%');
        }
        if(!empty($username)) {
            $queryBuilder
                ->andWhere('s.username = :username')
                ->setParameter('username', $username);
        }
        if(!empty($staffType)) {
            $queryBuilder
                ->andWhere('s.roles LIKE :staffType')
                ->setParameter('staffType', '%'.$staffType.'%');
        }
        
        return $queryBuilder
            ->getQuery()
            ->getResult();

    } //end findStaffAdvanced

    //return user that matches the username but not id
    public function findOneByNotId($username, $staffId) {

        return $this->createQueryBuilder('s')
            ->andWhere('s.username = :username')
            ->setParameter('username', $username)
            ->andWhere('s.id != :staffId')
            ->setParameter('staffId', $staffId)
            ->getQuery()
            ->getResult();
    }

    //get all staff names for select input on edit appointment
    public function getAllMedicalStaffNames() {
        return $this->createQueryBuilder('s')
        ->select("s.lastName" , "s.firstName", "s.id")
        ->andWhere('s.roles LIKE :doctor')
        ->setParameter('doctor', "%ROLE_DOCTOR%")
        ->orWhere('s.roles LIKE :nurse')
        ->setParameter('nurse', "%ROLE_NURSE%")
        ->addOrderBy('s.lastName', 'ASC')        
        ->getQuery()
        ->getResult();
    }
}

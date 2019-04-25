<?php

namespace App\Repository;

use App\Entity\UserStaff;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserStaff|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStaff|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStaff[]    findAll()
 * @method UserStaff[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStaffRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserStaff::class);
    }

    // /**
    //  * @return UserStaff[] Returns an array of UserStaff objects
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
    public function findOneBySomeField($value): ?UserStaff
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
                ->andWhere('s.staffType = :staffType')
                ->setParameter('staffType', $staffType);
        }
        
        return $queryBuilder
            ->getQuery()
            ->getResult();

    } //end findStaffAdvanced
}

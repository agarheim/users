<?php

namespace App\Repository;

use App\Entity\UsersPhones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersPhones|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersPhones|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersPhones[]    findAll()
 * @method UsersPhones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersPhonesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersPhones::class);
    }

    // /**
    //  * @return UsersPhones[] Returns an array of UsersPhones objects
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
    public function findOneBySomeField($value): ?UsersPhones
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

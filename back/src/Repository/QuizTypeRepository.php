<?php

namespace App\Repository;

use App\Entity\QuizType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuizType|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizType|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizType[]    findAll()
 * @method QuizType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizType::class);
    }

    // /**
    //  * @return QuizType[] Returns an array of QuizType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizType
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

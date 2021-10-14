<?php

namespace App\Repository;

use App\Entity\QuizModuleComposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuizModuleComposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizModuleComposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizModuleComposition[]    findAll()
 * @method QuizModuleComposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizModuleCompositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizModuleComposition::class);
    }

    // /**
    //  * @return QuizModuleComposition[] Returns an array of QuizModuleComposition objects
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
    public function findOneBySomeField($value): ?QuizModuleComposition
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

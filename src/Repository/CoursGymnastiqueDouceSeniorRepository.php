<?php

namespace App\Repository;

use App\Entity\CoursGymnastiqueDouceSenior;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CoursGymnastiqueDouceSenior>
 *
 * @method CoursGymnastiqueDouceSenior|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoursGymnastiqueDouceSenior|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoursGymnastiqueDouceSenior[]    findAll()
 * @method CoursGymnastiqueDouceSenior[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursGymnastiqueDouceSeniorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoursGymnastiqueDouceSenior::class);
    }

    //    /**
    //     * @return CoursGymnastiqueDouceSenior[] Returns an array of CoursGymnastiqueDouceSenior objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CoursGymnastiqueDouceSenior
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

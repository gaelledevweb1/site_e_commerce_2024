<?php

namespace App\Repository;

use App\Entity\CommentsBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentsBlog>
 *
 * @method CommentsBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentsBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentsBlog[]    findAll()
 * @method CommentsBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentsBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentsBlog::class);
    }

//    /**
//     * @return CommentsBlog[] Returns an array of CommentsBlog objects
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

//    public function findOneBySomeField($value): ?CommentsBlog
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

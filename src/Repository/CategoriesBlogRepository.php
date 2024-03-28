<?php

namespace App\Repository;

use App\Entity\CategoriesBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriesBlog>
 *
 * @method CategoriesBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesBlog[]    findAll()
 * @method CategoriesBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesBlog::class);
    }

//    /**
//     * @return CategoriesBlog[] Returns an array of CategoriesBlog objects
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

//    public function findOneBySomeField($value): ?CategoriesBlog
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

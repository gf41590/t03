<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }





    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Article[]
     */
    public function findAllByTerm($term): array
    {

    $qb = $this->createQueryBuilder('a');

    $terms = explode(" ", $term); 


        $qb->andWhere($qb->expr()->orX(
            $qb->expr()->in('a.id', ":term"),
            $qb->expr()->in('a.title', ":term"),
            $qb->expr()->in('a.author', ":term"),
            $qb->expr()->in('a.participation', ":term"),
            $qb->expr()->in('a.contributors', ":term"),
            $qb->expr()->in('a.participations_contributors', ":term"),
            $qb->expr()->in('a.ministerial_points', ":term"),
            $qb->expr()->in('a.journal', ":term"),
            $qb->expr()->in('a.conference ', ":term"),
            $qb->expr()->in('a.doi', ":term"),
            $qb->expr()->in('a.date_of_publication', ":term"),
        ))->setParameter('term', $terms);



        return $qb->getQuery()->execute();
    }
}

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
            $qb->expr()->in('a.participationsContributors', ":term"),
            $qb->expr()->in('a.ministerialPoints', ":term"),
            $qb->expr()->in('a.journal', ":term"),
            $qb->expr()->in('a.conference ', ":term"),
            $qb->expr()->in('a.doi', ":term"),
            $qb->expr()->in('a.date', ":term"),
        ))->setParameter('term', $terms);



        return $qb->getQuery()->execute();
    }

    /**
    *@param string $query
    *@return mixed
    */
    public function findArticleByName(string $query) 
    {
        $qb = $this->createQueryBuilder('a');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('a.id', ':query'),
                        $qb->expr()->like('a.title', ':query'),
                        $qb->expr()->like('a.author', ':query'),
                        $qb->expr()->like('a.participation', ':query'),
                        $qb->expr()->like('a.contributors', ':query'),
                        $qb->expr()->like('a.participationsContributors', ':query'),
                        $qb->expr()->like('a.ministerialPoints', ':query'),
                        $qb->expr()->like('a.journal', ':query'),
                        $qb->expr()->like('a.conference', ':query'),
                        $qb->expr()->like('a.doi', ':query'),
                        $qb->expr()->like('a.date', ':query')
                    ),
                   


                )
            )
            ->setParameter('query', '%'  . $query  . '%');
        return $qb
        ->getQuery()
        ->getResult();
    }


    


}

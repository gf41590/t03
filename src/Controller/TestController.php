<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;


class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function ind()
    {
      return $this->render('test/index.html.twig', [
           'controller_name' => 'TestController',
        ]);
    }

    // public function indexAction()
    // {   
    //     // Start setup logger
    //     $doctrine = $this->getDoctrine();
    //     $doctrineConnection = $doctrine->getConnection();
    //     $stack = new \Doctrine\DBAL\Logging\DebugStack();
    //     $doctrineConnection->getConfiguration()->setSQLLogger($stack);
    //     $em = $doctrine->getManager();
    //     // End setup logger

    //     /**
    //      * Execute here all your queries
    //      * $em->getRepository()->findAll()
    //      */

    //         $qb->select('u')
    //         ->from('Article', 'u')
    //         ->where('u.id = :id')
    //         ->setParameter('id', 1);
         
    //     return $this->render('test/index.html.twig',array(
    //         'stack' => $stack
    //     ));
    // }

    public function findAllOrdered($id)
    {
        $qb = $this->createQueryBuilder('article')
            ->addOrderBy('article.title', 'ASC');
            $query = $qb->getQuery();
            var_dump($query->getDQL());die;
            return $query->execute();

            return $this->render('test/index.html.twig',array(
                'id' => $id
            ));
    }

    /**
    *@Route("/tests" , name="tests")
    *@Route ArticleRepository $articleRepository
    *@Route |Symfony|Component|HttpFoundation|Response
    */
    public function article(ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findAll();

        return $this->render('test/index.html.twig',array(
            'article' => $article
        ));
    }

    /**
    * @var ArticleRepository
    */
    private $repository;

    public function _construct(ArticleRepository $articleRepository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
    * @Route("/biens" , name="article.index")
    * @return Response
    */
    public function index(): Response
    {
        $article = $this->repository->findAll();
        dump($article);
        $this->em->flush();
        return $this->render('test/index.html.twig',array(
            'article' => $article
        ));
    }
}


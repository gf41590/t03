<?php

declare(strict_types=1);

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;


class Test2Controller extends AbstractController
{
   
    /**
     * @var ArticleRepository
     */
    public $articleRepository;

    /**
     * @var PaginatorInterface
     */
    public $paginator;

    /**
     * @param ArticleRepository  $articleRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator
    ) {
        $this->articleRepository = $articleRepository;
        $this->paginator = $paginator;
    }

    // const PAGE_LIMIT = 5;
    /**
     * @Route("/list/{page}", methods={"POST","GET"})
     */
    public function list(int $page): Response
    {
        
        $article = $this->articleRepository->findAll();
        $article = $this->paginator->paginate($article, $page);

        return $this->render(
            'article/list.html.twig',
            ['article' => $article]
        );
    }

}

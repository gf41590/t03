<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArticleRepository;


class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search",methods={"GET","POST"})
     */
    public function searchBar()
    {
        $form = $this->createFormBuilder(null)
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class)
            ->add('search', SubmitType::class ,[
            'attr' => [
                'class' =>'btn btn-primary'
            ]

        ])
        ->getForm();

        return $this->render('search/search.html.twig', [
            'form' => $form ->createView()
        ]);
    }

    /**
     * @Route("/handleSearch", name="handleSearch")
     */
    public function handleSearch(Request $request, ArticleRepository $articleRepository)
    {
        $query = $request->request->get('form')['query'];
        if ($query){
            $article = $articleRepository ->findArticleByName($query);

        }else{
            throw $this->createNotFoundException(
                'No record  found' 
            );
        }

        return $this->render('search/result.html.twig', [
            'article' => $article
            
        ]);
    }
}

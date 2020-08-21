<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query\ResultSetMapping;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;



class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index", methods={"GET", "POST","HEAD"})
     */
    public function index(Request $request, ArticleRepository $articleRepository, UserRepository $userRepository)
    {
        $session = $this->get('session');
            if(!$session) {
                $session = new Session();
                $session->start();
            }



            $users = $userRepository->findAll();
            $email = $session->get('email');


            return $this->render('index/index.html.twig', [
                
            ]);
    }


}





<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{

    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index($id, $email, ArticleRepository $articleRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'article' => $articleRepository->findAll(),
            'id' => $id,
            'email' => $email,
        ]);
    }

    /**
     * @Route("/art", name="art")
     */
    public function indexAction()
    {
        $article = $this->getDoctrine()
            ->getRepository($articleRepository)
            ->findAll();

            return $this->render('index/index.html.twig', array (               
                'article' => $article
            ));
    }

     /**
     * @Route("/{id}", name="article_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Article $article): Response
    {
        return $this->render('index/index.html.twig', [
            'article' => $article,
        ]);
    }


    /**
     * @Route("/article", name="article")
     */
    public function article(Request $request)
    {
        $form = $this->createFormBuilder()
        ->add('title', TextType::class)
        ->add('author', TextType::class)
        ->add('contributors', IntegerType::class)
        ->add('participation', TextType::class)
        ->add('participations_contributors', IntegerType::class)
        ->add('ministerial_points', IntegerType::class)
        ->add('journal', TextType::class)
        ->add('conference', TextType::class)
        ->add('doi')
        ->add('date_of_publication', DateType::class)
        ->add('article', SubmitType::class, [ 
            'attr' => [
                'class' => 'btn btn-success'
            ]
            ])
        ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $data = $form->getData();

            $article = new Article();
            $article->setTitle($data['title']);
            $article->setAuthor($data['author']);
            $article->setParticipation($data['participation']);
            $article->setContributors($data['contributors']);
            $article->setParticipationsContributors($data['participations_contributors']);
            $article->setMinisterialPoints($data['ministerial_points']);
            $article->setJournal($data['journal']);
            $article->setConference($data['conference']);
            $article->setDoi($data['doi']);
            $article->setDateOfPublication($data['date_of_publication']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('index'));
        }
    

    
        return $this->render('article/index.html.twig', [ 
            'form' => $form->createView()
        ]);
    }


}

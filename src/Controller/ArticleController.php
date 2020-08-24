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
     * @Route("/", name="article_index", methods={"GET","HEAD"})
     */
    public function index( ArticleRepository $articleRepository): Response
    {
        
        return $this->render('index/index.html.twig', [
            "article" => $articleRepository->findAll(),
            
        ]);
    }

    

    // /**
    //  * @Route("/art", name="art", methods={"GET"})
    //  */
    // public function view(Article $article): Response
    // {
    //     return $this->render('test/index.html.twig', [
    //         'article' => $article,
    //     ]);
    // }

    // /**
    //  * @Route("/qwe", name="qwe", methods={"GET"})
    //  */
    // public function test(ArticleRepository $articleRepository,Article $article): Response
    // {
    //     $articleRepository = $entityManager->getRepository('Article::class');
    //     $article = $artilceRepository->findAll();

    //     foreach ($article as $article) {
    //     echo sprintf("-%s\n", $article->getName());
    //     }

    //     return $this->render('test/index.html.twig', [
    //         'article' => $article,
    //     ]);

    // }

    // /**
    //  * @Route("/nope", methods={"GET"})
    //  */
    // public function listAction(Article $article)
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $article = $em->getRepository('Article::class')
    //         ->findAll();
    //         dump($article);die;

    //         return $this->render('test/index.html.twig', ['article'=>$article]);
    // }

    /**
     * @Route("/art", name="art", methods={"GET"})

     */
    // public function indexAction(ArticleRepository $articleRepository,Article $article)
    
    // {
       

    //         $article = $this->getDoctrine()
    //         ->getRepository($articleRepository)
    //         ->findAll();

    //         return $this->render('test/index.html.twig', array (               
    //             'article' => $article
    //         ));
        
    // }

     /**
     * @Route("/{id}", name="article_show", methods={"GET","HEAD"}, requirements={"id":"\d+"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    public function sho(Article $article,ArticleRepository $articleRepository): Response
    {
    $article = $articleRepository->findAll();

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
        ->add('date', DateType::class)
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
            $article->setDate($data['date']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('index'));
        }
    

    
        return $this->render('article/index.html.twig', [ 
            'form' => $form->createView()
        ]);
    }

    // /**
    //  * @Route("/{id}/art", name="art", methods={"GET"})
    //  */
    // public function show02(Article $article,ArticleRepository $articleRepository): Response
    // {
    //     $repository = $entityManager->getRepository(Article::class);
    //     $article = $repository->findAll();
    //     dd($article);

    //     return $this->render('index/index.html.twig', [
    //         'article' => $article,
    //     ]);
    // }



    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function qwe($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

            if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        

        return $this->render('test/index.html.twig', ['article' => $article]);

    }


    /**
     * @Route("/art", name="art_show")
     */
    public function asd()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);

        $article = $repository->findAll();

        return $this->render('test/index.html.twig', ['article' => $article]);
    }


    /** 
    * @Route("/{id}/edit", name="article_edit" ,methods={"GET","POST"})
    */
   public function update($id,Request $request, Article $article): Response
   {
       $entityManager = $this->getDoctrine()->getManager();
       $article = $entityManager->getRepository(Article::class)->find($id);
   
       if (!$article) {
           throw $this->createNotFoundException(
               'No article found for id '.$id
           );
       }
   
       $article = $this->createForm(ArticleType::class, $article);
       $article->handleRequest($request);

       if ($article->isSubmitted() && $article->isValid()) {
           $this->getDoctrine()->getManager()->flush();
           return $this->redirectToRoute('index');
       }

    //    $article->setTitle('qwe!');
    //     $entityManager->flush();

       return $this->render('article/edit.html.twig', [
        'article' => $article,
        'form' => $article->createView(),
    ]);
   }
}

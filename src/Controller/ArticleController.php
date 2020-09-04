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
use App\Entity\User;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints\DateTime;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Exception\Exception;
use Symfony\Component\PropertyAccess\PropertyAccess;


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
     * @Route("/article", name="article",methods={"GET","POST"})
     */
    public function article(Request $request)
    {
        
        $user = $this->getUser();
         //return new Response('Well hi there '.$user->getId());
        $userId = $this->getUser()->getId();
        //return new Response('Well hi there '.$userId);

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
            $article->setUsername($user = $this->getUser()->getUsername());
            

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
                'No article found for id '.$id
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


   

//    public function getEntityManager() 
//     {
//         return $this->container->get('doctrine')->getEntityManager();
//     }

//     /**
//      * @Route("/pgn", name="pgn_show")
//      */
//    public function listAction(PaginatorInterface $paginator, Request $request)
//    {
//        $dql   = "SELECT a FROM article:Article a";
//        $query->createQuery($dql);
   
//        $pagination = $paginator->paginate(
//            $query, /* query NOT result */
//            $request->query->getInt('page', 1), /*page number*/
//            5 /*limit per page*/
//        );
   
//        // parameters to template
//        return $this->render('article/list.html.twig', ['pagination' => $pagination]);
//    }


     /**
     * @Route("/export", name="article_export", methods={"POST","GET"})
     */
    public function export(Request $request, ArticleRepository $articleRepository): Response
    {

        // $repository = $this->getDoctrine()->getRepository(Article::class);
         

        // $article = $repository->findAll();


        $request = Request::createFromGlobals();

        // $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
        // ->enableExceptionOnInvalidIndex()
        // ->getPropertyAccessor();


        // $i = 0;
        // $ids = [];
        // while (isset($request->get('form')[$i])) {
        //     $ids[$i] = ($request->get('form')[$i]);
        //     $i = $i + 1;
            
        // }
        
        $all = true;
        $columns = '';
        //$request->get('field')

        dump($id = $request->request->get('form'));
        //dump($request->query=('SELECT partial a.{id} FROM article'));
        // dump($article = $this->getDoctrine()->getRepository(Article::class)->find($id));

        // dump($value = $propertyAccessor->getValue($article , ['id']));

        if(!empty($id = $request->query->get('form'))) {
            $columns = $id;
        }
        if(!empty($request->get('title'))) {
            $columns = 'a.title,';
        }
        if(!empty($request->get('author'))) {
            $columns = 'a.author,';
        }
        if(!empty($request->get('participation'))) {
            $columns = 'a.participation,';
        }
        if(!empty($request->get('contributors'))) {
            $columns = 'a.contributors,';
        }
        if(!empty($request->get('participationsContributors'))) {
            $columns = 'a.participationsContributors,';
        }
        if(!empty($request->get('ministerialPoints'))) {
            $columns = 'a.ministerialPoints,';
        }
        if(!empty($request->get('journal'))) {
            $columns = 'a.journal,';
        }
        if(!empty($request->get('conference'))) {
            $columns = 'a.conference,';
        }
        if(!empty($request->get('doi'))) {
            $columns = 'a.doi,';
        }
        if(!empty($request->get('date'))) {
            $columns = 'a.date,';
        }
        if(empty($columns)) {
            $columns = 'a';
        } else {
            $all = false;
            $columns = rtrim($columns, ',');
        }

        $ids = '';
        for ($i = 1; $i <= 11; $i++) {
            if(null !== $request->get("row_".$i)) {
            if($i > 11) $ids = $i;
            $ids = ' '.$ids.''.$i.',';
        }

        }
        if(empty($ids)) {
            $rows = '';
        } else {
            $rows = rtrim($ids, ',');
        }

        $article = $articleRepository->createQueryBuilder('a')
        ->select($columns);

        if(!empty($rows)) {
        $article = $article->where("a.id IN (".$rows.")");
        }

        $article = $article->getQuery()
        ->getResult();

        $art = [];
        foreach($article as $article) {
            $isEmpty = true;
            foreach($article as $field ) {
                if ($field instanceof \DateTime) {
                    $article['date'] = $field->format('Y-m-d');
                }
                if($field) $isEmpty = false;
            }
            if(!$isEmpty) array_push($art, $article);
        }
        if($columns !== 'a') {
        $columns = str_replace('a.', '', $columns);
        $columns = explode(',', $columns);
        }else {

            $columns=['id', 'title', 'author', 'participation', 'contributors', 'participationsContributors', 'ministerialPoints', 'journal', 'conference', 'doi', 'date'];
           
        }

        if($columns) {

            // Instantiate Dompdf with our options
            $phpWord = new phpWord();
            
            $twig = $this->get('twig');
            /** @var \Twig_Template $template */
            $template = $twig->load('article/preview.html.twig');
    
            // Retrieve the HTML generated in our twig file
            $html = $template->renderBlock('body',[
                'article' => $art,
                'columns' => $columns,
            ]);
        
            $section = $phpWord->addSection();
    
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
            // Saving the document as OOXML file...

            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            header("Content-Disposition: attachment; filename=export.docx");
            $objWriter->save("php://output");

            return $this->render('article/preview.html.twig', [
                'article' => $art,
                'columns' => $columns,
            ]);

        }





    }





}

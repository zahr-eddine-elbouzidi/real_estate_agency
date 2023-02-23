<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

//declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Model\Categorie;
use Application\Model\CategorieTable;
use Application\Model\Candidat;
use Application\Model\CandidatTable;
use Application\Form\PostForm;
use Application\Form\CandidatForm; 

class IndexController extends AbstractActionController
{

    protected $categoryTable;

    protected $candidatTable;

    private $form;

    private $candidatForm;

 

    // Add this constructor:
    public function __construct(CategorieTable $categorieTable, PostForm $form,CandidatTable $candidatTable, CandidatForm $candidatForm)
    {
        $this->categoryTable = $categorieTable;
        $this->form = $form;
        $this->candidatTable = $candidatTable;
        $this->candidatForm = $candidatForm;
    }

    public function indexAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }

        /**
         * get posts for revolution slider
         */
        $postsRevolution = $this->categoryTable->getPosts();
        $dataPostRevolution = [];
        foreach($postsRevolution as $post_revolution){
            $dataPostRevolution[] = $post_revolution;
        }

        /**
         * get posts with type = Article
         */
        $postsArticles = $this->categoryTable->getPostsArticles();
        $dataPostArticle = [];
        foreach($postsArticles as $post_article){
            $dataPostArticle[] = $post_article;
        }

    

        /**
         * get posts with type = Annonces
         */
        $postsAnnonces = $this->categoryTable->getPostsAnnonces();
        $dataPostAnnonce = [];
        foreach($postsAnnonces as $post_annonce){
            $dataPostAnnonce[] = $post_annonce;
        }

         /**
         * get posts with type = Blog
         */
        $postsBlogs = $this->categoryTable->getPostsBlogs();
        $dataPostBlogs = [];
        foreach($postsBlogs as $post_blog){
            $dataPostBlogs[] = $post_blog;
        }

     

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);


        $message = $this->params()->fromRoute('message');
        if($message == 'success'){
            $this->flashMessenger()->addInfoMessage('zahreddine elbouzidi');
        }



        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'postsRevolution' => $dataPostArticle, 
                              'postsArticles' => $dataPostArticle, 
                              'postsAnnonces' => $dataPostAnnonce, 
                              'postsBlogs' => $dataPostBlogs,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm
                                ]);
    }


    public function faqAction(){

        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);

        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm
                               
                                ]);
    }

  
}

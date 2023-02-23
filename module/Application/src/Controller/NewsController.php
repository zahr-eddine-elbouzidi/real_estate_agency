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
use Application\Form\PostForm;
use Application\Form\CandidatForm;

class NewsController extends AbstractActionController
{

    protected $categoryTable;

    private $form;

    private $candidatForm;

    // Add this constructor:
    public function __construct(CategorieTable $categorieTable, PostForm $form,CandidatForm $candidatForm)
    {
        $this->categoryTable = $categorieTable;
        $this->form = $form;
        $this->candidatForm = $candidatForm;
    }

    public function postAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }
 

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);

        $post_slug = $this->params()->fromRoute('post_name');

        $articleExists = $this->categoryTable->getArticleBySlug($post_slug);

        if(!$articleExists){
            return $this->redirect()->toRoute('nf');
        }

        $sub_category_slug = $this->params()->fromRoute('sub_category_name');
        
        $subcatObj = $this->categoryTable->getSubCategoryBySlug($sub_category_slug);

        if(!$subcatObj){
            return $this->redirect()->toRoute('nf');
        }

        $category_slug = $this->params()->fromRoute('category_name');

        $catgoryObject = $this->categoryTable->getCategoryBySlug($category_slug);

        if(!$catgoryObject){
            return $this->redirect()->toRoute('nf');
        }

        $postSelected = $this->categoryTable->getPostsBySlug($post_slug);

        $postSelected = current($postSelected);
      
        $prefixe_letter = $this->getPrefixeAction($postSelected['content']);


        //get recents posts without current post selected 
        $recentPosts = $this->categoryTable->getRecentsPost($post_slug);


        
    

        //get related posts without current post selected
        $relatedPosts = (isset($postSelected)) ? 
                        $this->categoryTable->getRelatedPosts($post_slug , $postSelected['type']) : 
                        $this->categoryTable->getRelatedPosts($post_slug , 'Article');

       
         
        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'postSelected' => $postSelected,
                              'prefix_letter' => $prefixe_letter['prefix_letter'],
                              'recentPosts' => $recentPosts,
                              'relatedPosts' => $relatedPosts,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm
                                ]);

    }

    public function nfAction(){
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

    public function blogAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }
 

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);

        $post_slug = $this->params()->fromRoute('post_name');

        $blogArticles = $this->categoryTable->getBlogs();

        $categoriesByPostCounts = $this->categoryTable->getCountPostByCategories('Blog');

        $recentBlogs = $this->categoryTable->getRecentsBlog();

         
        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'blogArticles' => $blogArticles,
                              'categoriesByPostCounts' => $categoriesByPostCounts,
                              'recentBlogs' => $recentBlogs,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm
                             
                                ]);

    }


    public function categoryAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }
 

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);

        $sub_cat_slug = $this->params()->fromRoute('category_name');

        $articles = $this->categoryTable->getPostsBySubCatSlug($sub_cat_slug);

        $categoriesByPostCounts = $this->categoryTable->getCountPostByCategories('all');

        $sub_cat_title = $this->categoryTable->getMenuTitlesBySlug($sub_cat_slug);

        $sub_cat_title = current($sub_cat_title);
         
        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'articles' => $articles,
                              'categoriesByPostCounts' => $categoriesByPostCounts,
                              'sub_cat_title' => $sub_cat_title,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm
                         
                             
                                ]);

    }


    public function faqsAction()
    {
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




    public function detailsAction(){
        return new ViewModel();
    }
    

    public function getPrefixeAction($content)
    {
       
        if($content != null && $content != ' '){

             //convert to array 
            $g = strip_tags($content);
    
            $g = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", $g);
            
            $t = str_split($g);

            return ['prefix_letter' => $t[0]];
        }

        return null;

    }

    
}

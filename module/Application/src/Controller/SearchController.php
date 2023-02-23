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

class SearchController extends AbstractActionController
{

    protected $categoryTable;

    private $form;

 

    // Add this constructor:
    public function __construct(CategorieTable $categorieTable, PostForm $form,CandidatForm $candidatForm)
    {
        $this->categoryTable = $categorieTable;
        $this->form = $form;
        $this->candidatForm = $candidatForm;
    }

    public function qAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }
 
        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);



        $request = $this->getRequest();
        //verify is that the bad request forwarded by client
        if (! $request->isGet()) {
            return $this->redirect()->toRoute('home');
        }

        $search_string = $request->getQuery('search');
        $key_words = [];
        $array_key_words = explode(" ",$search_string);
        if(sizeof($array_key_words) === 1){
            $key_words[] = $array_key_words[0];
        }else{

            foreach($array_key_words as $keys){
                if($keys != "" && strlen($keys) > 3){
                    $key_words[] = $keys;
                }
            } 
        }
      
        $paginator = null;
       
        //var_dump($array_key_words);
        if($search_string != null){
            $paginator = $this->categoryTable->fetchAllSearch(true,$key_words);
            $page = (int) $this->params()->fromQuery('page', 1);
            $page = ($page < 1) ? 1 : $page;
            $paginator->setCurrentPageNumber($page);
            // Set the number of items per page to 10:
            $paginator->setItemCountPerPage(4);
        }

        
       
        //var_dump($paginator);
        $searchSize = $paginator->getTotalItemCount();
         //foreach($paginator as $p){
            //var_dump($p);
          //  $searchSize++;
           // echo "Object ".$i."<br />";
        //} 
         //die();

 




        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'form' => $this->form,
                              'paginator' => $paginator,
                              'search' => $search_string,
                              'searchSize' => $searchSize,
                              'candidatForm' => $this->candidatForm
                                ]);

                      
    }

    
}

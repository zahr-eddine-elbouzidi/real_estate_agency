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

class ServicesController extends AbstractActionController
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

    public function indexAction()
    {
        $categories  = $this->categoryTable->fetchAll();
        $data_category = [];
        foreach($categories as $category){
            $data_category[] = $category;
        }

        //get web development object from DB
        $devwebObject  = $this->categoryTable->getArticleBySubCategory('Développement Web');
        $dataDevWebArray = [];
        foreach($devwebObject as $devweb){
            $dataDevWebArray[] = $devweb;
        }

        //get mobile development frop DB
        $devmobileObject  = $this->categoryTable->getArticleBySubCategory('Développement Mobile');
        $dataDevMobileArray = [];
        foreach($devmobileObject as $devmob){
            $dataDevMobileArray[] = $devmob;
        }

        //get ui/ux development frop DB
        $devuxObject  = $this->categoryTable->getArticleBySubCategory('Web Design UI/UX');
        $dataDevUxArray = [];
        foreach($devuxObject as $uiux){
            $dataDevUxArray[] = $uiux;
        }

        //get IA development frop DB
        $aiObject  = $this->categoryTable->getArticleBySubCategory('Intélligence Artificielle');
        $dataAiArray = [];
        foreach($aiObject as $ai){
            $dataAiArray[] = $ai;
        }

        //get SEO development frop DB
        $seoObject  = $this->categoryTable->getArticleBySubCategory('SEO - Référencement Naturel');
        $dataSeoArray = [];
        foreach($seoObject as $seo){
            $dataSeoArray[] = $seo;
        }

        //get Data engineering development frop DB
        $deObject  = $this->categoryTable->getArticleBySubCategory('Ingénierie de données');
        $dataDeArray = [];
        foreach($deObject as $de){
            $dataDeArray[] = $de;
        }
 
 
 
 
 
 
 

        $sub_categories = $this->categoryTable->getSubCategories();
        $contact = $this->categoryTable->getContact();
        $contact = current($contact);

        return new ViewModel(['categories' => $data_category,
                              'subcats' => $sub_categories,
                              'contact' => $contact,
                              'form' => $this->form,
                              'candidatForm' => $this->candidatForm,
                              'devweb' => $dataDevWebArray,
                              'devmob' => $dataDevMobileArray,
                              'uiux' => $dataDevUxArray,
                              'ai' => $dataAiArray,
                              'seo' => $dataSeoArray,
                              'de' => $dataDeArray
                                ]);
    }

    
}

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

class ContactsController extends AbstractActionController
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

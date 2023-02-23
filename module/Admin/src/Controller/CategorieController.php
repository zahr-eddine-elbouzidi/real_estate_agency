<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\CategorieForm;
use Admin\Model\Categorie;
use Admin\Model\CategorieTable;
use Admin\Model\UsersTable;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Hydrator;

   

/**
 * CategorieController
 *
 * @author
 *
 * @version
 *
 */
class CategorieController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject category table 
    */
    private $categoryTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;

    // Add this constructor:
    public function __construct(CategorieTable $categorieTable , UsersTable $userTable)
    {
        $this->categoryTable = $categorieTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $categories_objects = $this->categoryTable->fetchAll();
        return new JsonModel([
                "data" => $categories_objects , 
                "status" => $this->response->getStatusCode()
                ]);
        
    }

    /**
     * get config salt 
     */
    public function getConfigSalt(){
        return ['static_salt' => 'aFGQ475SDsdfsaf2342'];
    }


    /**
     * get category by id param
     * @param category_id
     */
    public function getCategoryAction(){

        $category_id = $this->params()->fromRoute('id', 0);  

        $category = $this->categoryTable->getCategory($category_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($category)]
        );
    }

    /**
      * add action
      * @param name_fr
      * @param name_eng
      * @param name_ar
      * @param level_cat
      * @param enabled
      */
    public function addAction()
    {
 

               $drap = false; 

               //GET JSON DATA FORM ANGULARJS
        
               $data = json_decode(file_get_contents("php://input"));

               $staticSalt = $this->getConfigSalt()['static_salt'];

               $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
               
               $user =$this->userTable->getUserByToken($created_by);

               $mustUpload = true;

               if(!$this->categoryTable->getRecordByName($data->name_fr)){

                     $categorie = new Categorie();
                     
                     //GET CATEGORY FORM

                     $categoryForm = new CategorieForm();
                     
                     $dataPosts['id'] = 0;
                     
                     $dataPosts['name_fr'] = $data->name_fr;

                     $dataPosts['name_eng'] = $data->name_eng;

                     $dataPosts['name_ar'] = $data->name_ar;
                     
                     $dataPosts['level_cat'] = (isset($data->level_cat)) ? $data->level_cat : 0;

                     $dataPosts['enabled'] = (isset($data->enabled) && $data->enabled == true) ? 1 : 0;
                     
                     $dataPosts['created_by'] = $user->getEmail();
                     

                     // SET INPUT FILTER 
                      
                     $categoryForm->setInputFilter($categorie->getInputFilter());
                     
                     // SET DATA FORM
                     $categoryForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($categoryForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $categorie->exchangeArray($categoryForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->categoryTable->saveCategorie($categorie);

                         $drap=true;
 
                         
                     }else {

                         $drap=false;
                        
                          
                     }
                     

              }else{

                      $drap = false; 
              }


             return new JsonModel(array('drap' => $drap , 'mustUpload' => $mustUpload ));

               
     }


     /**
      * edit action
      * @param name_fr
      * @param name_eng
      * @param name_ar
      * @param level_cat
      * @param enabled
      */
     public function editAction()
     {
 

                $drap = false; 

                $mustUpload = false;


                $categoryExists = false;


                //GET CATEGORY ID
                $category_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = $this->getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET CATEGORY
                $category = $this->categoryTable->getCategory($category_id);
                     
                $old_category_name = $category->getNameFr();


                if(isset($data->name_fr)){

                  if($data->name_fr != $category->getNameFr()){

                    
                         //IF CATEGORY NOT EXISTS
                    if($this->categoryTable->getElementByName($data->name_fr) === 0 ){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
                $dataPosts['id'] = $category_id;
                     
                $dataPosts['name_fr'] = (isset($data->name_fr)) ? $data->name_fr :  $category->getNameFr();

                $dataPosts['name_eng'] = (isset($data->name_eng)) ? $data->name_eng :  $category->getNameEng();
               
                $dataPosts['name_ar'] = (isset($data->name_ar)) ? $data->name_ar :  $category->getNameAr();
                     
                $dataPosts['level_cat'] = (isset($data->level_cat)) ? $data->level_cat :  $category->getLevelCat();
                
                $dataPosts['enabled'] = (isset($data->enabled)) ? $data->enabled :  $category->getEnabled();
                     
                $dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $category->getCreatedBy();

 
                
                if($categoryExists) {  //IF CATEGORY EXISTS 

                  
                }else{ //CATEGORY NOT EXISTS

                    //GET CATEGORY FORM
                    $categoryForm = new CategorieForm();

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                    $categoryForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $categoryForm->setInputFilter($category->getInputFilter());


                     //CATEGORY FORM IS
                     if ($categoryForm->isValid()) {

                         //INIT CATEGORY DATA
                         $category->exchangeArray($categoryForm->getData());

                         $this->categoryTable->saveCategorie($category);

                       
                    }else{

                    } 
                }

             return new JsonModel(array('drap' => $categoryExists , 'mustUpload' => $mustUpload ));       
     }


     /**
      * delete action
      * @param id from url params
      */
     public function deleteAction()
     {
  
            $id = (int) $this->params()->fromRoute('id', 0);
            $created_by = $this->params()->fromRoute('name');
            $staticSalt = $this->getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->userTable->getUserByToken($created_by);
            $category = $this->categoryTable->getCategory($id);
            $this->categoryTable->deleteCategorie($category->getId());
            return true;
      }
    
    
}
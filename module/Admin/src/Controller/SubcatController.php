<?php 

 

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Subcat;         
use Admin\Model\SubcatTable;         
use Admin\Model\UsersTable;         
use Admin\Model\CategorieTable;         
use Admin\Form\SubcatForm;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class SubcatController extends AbstractRestfulController
{
  
 /**
  * properties
  */
 private  $subcatTable;
 private  $usersTable; 
 private $hydrator;


 // Add this constructor:
 public function __construct(SubcatTable $subcatTable , UsersTable $usersTable)
 {
     $this->subcatTable = $subcatTable;
     $this->usersTable = $usersTable;
     $this->hydrator  = new Hydrator\ArraySerializableHydrator();
      
 }






    public function getListAction()
    { 
    
        $created_by = $this->params()->fromRoute('id', 0); // get created by property

       /* $sessionManager = new \Laminas\Session\SessionManager();
        $sessionManager->start();
        $auth = new AuthenticationService();
        $session = new \Laminas\Session\Container('token');
        
        if ($auth->hasIdentity() && $session->offsetExists('token')) {
            if($created_by != $session->offsetGet('token')){
                                    //echo "Access Token is failed !";
            return new JsonModel(array(
                'data' => null)
            );
            exit;
            }
        }else{
        return new JsonModel(array(
            'data' => null)
        );
        exit;
        }*/

        $staticSalt = Slug::getConfigSalt()['static_salt'];
        $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
        $user =$this->usersTable->getUserByToken($created_by);
        $users = $this->subcatTable->getUsersByCreatedby($user->getEmail());


     
        $types = null;

        $types = $this->subcatTable->fetchAll();

        $data = array();
        foreach ($types as $result) {
            $data[] = $result;
        }

        return new JsonModel(array(
        'data' => $data)
        );


    }


public function addAction()
{
 

        $drap = false; 

        
                    //GET JSON DATA FORM ANGULARJS
        
        $data = json_decode(file_get_contents("php://input"));
      
        $staticSalt = Slug::getConfigSalt()['static_salt'];
        $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
        $user =$this->usersTable->getUserByToken($created_by);
        $mustUpload = false;

        if(!$this->subcatTable->getRecordByName($data->sub_name_fr,$user->getEmail() , $data->sub_category_id)){

        $type = new Subcat();
        
                            //GET CATEGORY FORM
        $typeForm = new SubcatForm();
        
        $dataPosts['id_subcat'] = 0;

        $dataPosts['sub_name_fr'] = $data->sub_name_fr;

        $dataPosts['sub_name_eng'] = $data->sub_name_eng;

        $dataPosts['sub_name_ar'] = $data->sub_name_ar;
        
        $dataPosts['sub_level'] = $data->sub_level;
        
        $dataPosts['sub_created_by'] = $user->getEmail();

        $dataPosts['sub_category_id'] = $data->sub_category_id;
        
        $dataPosts['sub_enabled'] = $data->sub_enabled;;

                            // SET INPUT FILTER 
        
        $typeForm->setInputFilter($type->getInputFilter());
        
                            // SET DATA FORM
        $typeForm->setData($dataPosts);
        
        
        
        $id = 0;
        
        //CHECK IS VALID FORM
      
        if ($typeForm->isValid()) {
        
        //INIT CATEGORY DATA
        $type->exchangeArray($typeForm->getData());

        // INSERT AND GET CATEGORY ID

        $id = $this->subcatTable->saveSubcat($type);

        $drap=true;

        /*$this->getHireTable()->saveHistory(

            $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
            $this->getRequest()->getServer()->get('HTTP_HOST'),
            'Insert',
            'Sous Catégorie',
            NULL,
            $type->nom,
            $user->usr_email,
            $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
            $this->getRequest()->getServer()->get('SERVER_NAME'), 
            $this->getRequest()->getServer()->get('SERVER_ADDR'),
            $this->getRequest()->getServer()->get('SERVER_PORT')

        );*/
        
        }else {

             $drap=false;
                                //  print_r($categoryForm->getMessages());
        
        }
        

        }else{

            $drap = false; 
        }










        return new JsonModel(array('drap' => $drap ));


}


public function editAction()
{
 

  $drap = false; 


 
  $categoryExists = false;


                //GET CATEGORY ID
  $sub_cat_id = $this->params()->fromRoute('id', 0);  

  
                //GET JSON DATA 
  $data = json_decode(file_get_contents("php://input"));



 $staticSalt = Slug::getConfigSalt()['static_salt'];
 $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
 $user =$this->usersTable->getUserByToken($created_by);


                //GET CATEGORY
 $subCategory_Object = $this->subcatTable->getSubCategory($sub_cat_id);
 
 $type_old_name = $subCategory_Object->getSub_name_fr();


 if(isset($data->sub_name_fr)){

  if($data->sub_name_fr !=  $subCategory_Object->getSub_name_fr()){
                         //IF CATEGORY NOT EXISTS
    if(!$this->subcatTable->getRecordByNameOnly($data->sub_name_fr)){

      
      $categoryExists = false;


    }else{

     $categoryExists = true;

   }
 }else{
  $categoryExists = false;
}

}
  


$dataPosts['id_subcat'] = $subCategory_Object->getId_subcat();

$dataPosts['sub_name_fr'] = (isset($data->sub_name_fr)) ? $data->sub_name_fr :  $subCategory_Object->getSub_name_fr();

$dataPosts['sub_name_eng'] = (isset($data->sub_name_eng)) ? $data->sub_name_eng :  $subCategory_Object->getSub_name_eng();

$dataPosts['sub_name_ar'] = (isset($data->sub_name_ar)) ? $data->sub_name_ar :  $subCategory_Object->getSub_name_ar();

$dataPosts['sub_level'] = (isset($data->sub_level)) ? $data->sub_level :  $subCategory_Object->getSub_level();

$dataPosts['sub_created_by'] = (isset($data->sub_created_by)) ? $user->getEmail() :  $subCategory_Object->getSub_created_by();

$dataPosts['sub_enabled'] = (isset($data->sub_enabled)) ? $data->sub_enabled :  $subCategory_Object->getSub_enabled();

$dataPosts['sub_category_id'] = (isset($data->sub_category_id)) ? $data->sub_category_id :  $subCategory_Object->getSub_category_id();




                if($categoryExists) {  //IF CATEGORY EXISTS 

                  

                }else{ //CATEGORY NOT EXISTS


                    //GET CATEGORY FORM
                  $typeForm = new SubcatForm();

                  

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                  $typeForm->setData($dataPosts);


                    //INIT INPUT FILTER
                  
                  $typeForm->setInputFilter($subCategory_Object->getInputFilter());


                     //CATEGORY FORM IS
                  if ($typeForm->isValid()) {

                         //INIT CATEGORY DATA
                   $subCategory_Object->exchangeArray($typeForm->getData());

                   $this->subcatTable->saveSubcat($subCategory_Object);

                   /*  $this->getHireTable()->saveHistory(

                  $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
                    $this->getRequest()->getServer()->get('HTTP_HOST'),
                    'Update',
                    'Sous Catégorie',
                    $type_old_name,
                    $type->nom,
                    $user->usr_email,
                    $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
                    $this->getRequest()->getServer()->get('SERVER_NAME'), 
                    $this->getRequest()->getServer()->get('SERVER_ADDR'),
                    $this->getRequest()->getServer()->get('SERVER_PORT')

                  );*/


                 }else{


                 } 

               }


               return new JsonModel(array('drap' => $categoryExists  ));

               
             }

    /**
     * create delete function
     * @param param from url 
     * @param user_email 
     */
    public function deleteAction()
    {

            $sub_category_id = (int) $this->params()->fromRoute('id', 0);
   
            $created_by = $this->params()->fromRoute('name');

            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->usersTable->getUserByToken($created_by);
            $subcategory_object = $this->subcatTable->getSubCategory($sub_category_id);
            $this->subcatTable->deleteSubCategory($subcategory_object->getId_subcat());
            /* $this->getHireTable()->saveHistory(

              $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
              $this->getRequest()->getServer()->get('HTTP_HOST'),
              'Delete',
              'Sous Catégorie',
              $type->nom,
              NULL,
              $user->usr_email,
              $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
              $this->getRequest()->getServer()->get('SERVER_NAME'), 
              $this->getRequest()->getServer()->get('SERVER_ADDR'),
              $this->getRequest()->getServer()->get('SERVER_PORT')

            );*/

             
             return true;
           }

           
    /**
     * create a new sub category action
     * @param from route url 
     */
    public function getSubCategoryAction()
    {
            $subcategory_id = $this->params()->fromRoute('id', 0);  

            $subcategory_object = $this->subcatTable->getSubCategory($subcategory_id);

            return new JsonModel([
              
              'data' => $this->hydrator->extract($subcategory_object)]
          ); 
    }



         
 
 
    
       


     }






     ?>
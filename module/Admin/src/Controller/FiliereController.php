<?php 

 

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Filiere;         
use Admin\Model\FiliereTable;         
use Admin\Model\UsersTable;         
use Admin\Model\CategorieTable;         
use Admin\Form\FiliereForm;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class FiliereController extends AbstractRestfulController
{
  
 /**
  * properties
  */
 private  $filiereTable;
 private  $usersTable; 
 private $hydrator;


 // Add this constructor:
 public function __construct(FiliereTable $filiereTable , UsersTable $usersTable)
 {
     $this->filiereTable = $filiereTable;
     $this->usersTable = $usersTable;
     $this->hydrator  = new Hydrator\ArraySerializableHydrator();
      
 }






    public function getListAction()
    { 
    
        $created_by = $this->params()->fromRoute('id', 0); // get created by property

        $filieres = null;

        $filieres = $this->filiereTable->fetchAll();

        $data = array();
        foreach ($filieres as $result) {
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

        if(!$this->filiereTable->getRecordByName($data->nom_filiere, $data->etablissement_id)){

        $filiere = new Filiere();
        
                            //GET FILIERE FORM
        $filiereForm = new FiliereForm();
        
        $dataPosts['id_filiere'] = 0;

        $dataPosts['nom_filiere'] = $data->nom_filiere;
        
        $dataPosts['created_by'] = $user->getEmail();

        $dataPosts['etablissement_id'] = $data->etablissement_id;
        

                            // SET INPUT FILTER 
        
        $filiereForm->setInputFilter($filiere->getInputFilter());
        
                            // SET DATA FORM
        $filiereForm->setData($dataPosts);
        
        
        
        $id = 0;
        
        //CHECK IS VALID FORM
      
        if ($filiereForm->isValid()) {
        
        //INIT CATEGORY DATA
        $filiere->exchangeArray($filiereForm->getData());

        // INSERT AND GET CATEGORY ID

        $id = $this->filiereTable->saveFiliere($filiere);

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


                //GET Filiere ID
  $filiere_id = $this->params()->fromRoute('id', 0);  

  
                //GET JSON DATA 
  $data = json_decode(file_get_contents("php://input"));



 $staticSalt = Slug::getConfigSalt()['static_salt'];
 $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
 $user =$this->usersTable->getUserByToken($created_by);
 


                //GET Filiere
 $filiere_object = $this->filiereTable->getFiliere($filiere_id);
 
 $filiere_old_name = $filiere_object->getNom_filiere();


 if(isset($data->nom_filiere)){

  if($data->nom_filiere !=  $filiere_object->getNom_filiere()){
                         //IF FILIERE NOT EXISTS
    if(!$this->filiereTable->getRecordByNameOnly($data->nom_filiere)){

      
      $categoryExists = false;


    }else{

     $categoryExists = true;

   }
 }else{
  $categoryExists = false;
}

}
  


$dataPosts['id_filiere'] = $filiere_object->getId_filiere();

$dataPosts['nom_filiere'] = (isset($data->nom_filiere)) ? $data->nom_filiere :  $filiere_object->getNom_filiere();

$dataPosts['etablissement_id'] = (isset($data->etablissement_id)) ? $data->etablissement_id :  $filiere_object->getEtablissement_id();

$dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $filiere_object->getCreated_by();



                if($categoryExists) {  //IF Filiere EXISTS 

                  

                }else{ //Filiere NOT EXISTS


                    //GET filiere FORM
                  $filiereForm = new FiliereForm();

                  

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                  $filiereForm->setData($dataPosts);


                    //INIT INPUT FILTER
                  
                  $filiereForm->setInputFilter($filiere_object->getInputFilter());


                     //CATEGORY FORM IS
                  if ($filiereForm->isValid()) {

                         //INIT CATEGORY DATA
                   $filiere_object->exchangeArray($filiereForm->getData());

                   $this->filiereTable->saveFiliere($filiere_object);

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

            $filiere_id = (int) $this->params()->fromRoute('id', 0);
   
            $created_by = $this->params()->fromRoute('name');

            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->usersTable->getUserByToken($created_by);
            $filiere_object = $this->filiereTable->getFiliere($filiere_id);
            $this->filiereTable->deleteFiliere($filiere_object->getId_filiere());
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
    public function getFiliereAction()
    {
            $filiere_id = $this->params()->fromRoute('id', 0);  

            $filiere_object = $this->filiereTable->getFiliere($filiere_id);

            return new JsonModel([
              
              'data' => $this->hydrator->extract($filiere_object)]
          ); 
    }


    public function getFiliereEtabAction()
    {
            $filiere_id = $this->params()->fromRoute('id', 0);  

            $filieres = $this->filiereTable->getFiliereEtab($filiere_id);

            $data = array();
            foreach ($filieres as $result) {
                $data[] = $result;
            }

            return new JsonModel(array(
              'data' => $data)
            );
    }




         
 
 
    
       


     }






     ?>
<?php 

 

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Calendrier;         
use Admin\Model\CalendrierTable;         
use Admin\Model\UsersTable;         
use Admin\Model\CategorieTable;         
use Admin\Form\CalendrierForm;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class CalendrierController extends AbstractRestfulController
{
  
 /**
  * properties
  */
 private  $calendrierTable; //calendrierTable => session filièere table
 private  $usersTable; 
 private  $hydrator;


 // Add this constructor:
 public function __construct(CalendrierTable $calendrierTable , UsersTable $usersTable)
 {
     $this->calendrierTable = $calendrierTable;
     $this->usersTable = $usersTable;
     $this->hydrator  = new Hydrator\ArraySerializableHydrator();
      
 }

    public function getListAction()
    { 
    
        $created_by = $this->params()->fromRoute('id', 0); // get created by property
        $filiere_id = $this->params()->fromRoute('name', 0); // get created by property

        $sessions_filieres = null;

        $sessions_filieres = $this->calendrierTable->fetchAllByFiliere($filiere_id);

        $data = array();
        foreach ($sessions_filieres as $result) {
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

        $date_debut = $data->date_debut;
        
        $date_fin = $data->date_fin;

        if(!$this->calendrierTable->getRecordByName($data->session_id, $data->filiere_id , $date_debut)){

        $calendrier = new Calendrier();
        
                            //GET FILIERE FORM
        $calendrierForm = new CalendrierForm();
        
        $dataPosts['id_session_filiere'] = 0;

        $dataPosts['date_debut'] = $date_debut;

        $dataPosts['date_fin'] = $date_fin;

        $dataPosts['created_by'] = $user->getEmail();

        $dataPosts['filiere_id'] = $data->filiere_id;

        $dataPosts['session_id'] = $data->session_id;
        

                            // SET INPUT FILTER 
        
        $calendrierForm->setInputFilter($calendrier->getInputFilter());
        
                            // SET DATA FORM
        $calendrierForm->setData($dataPosts);
        
        
        
        $id = 0;
        
        //CHECK IS VALID FORM
      
        if ($calendrierForm->isValid()) {
        
        //INIT CATEGORY DATA
        $calendrier->exchangeArray($calendrierForm->getData());

        // INSERT AND GET CATEGORY ID

        $id = $this->calendrierTable->saveCalendrier($calendrier);

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
  $calendrier_id = $this->params()->fromRoute('id', 0);  

  
                //GET JSON DATA 
  $data = json_decode(file_get_contents("php://input"));



 $staticSalt = Slug::getConfigSalt()['static_salt'];
 $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
 $user =$this->usersTable->getUserByToken($created_by);
 


                //GET Filiere
 $calendrier = $this->calendrierTable->getCalendrier($calendrier_id);
 
 $date_debut = $data->date_debut;

 $date_fin = $data->date_fin;
 

$dataPosts['id_session_filiere'] = $calendrier->getId_session_filiere();

$dataPosts['date_debut'] = (isset($date_debut)) ? $date_debut :  $calendrier->getDate_debut();

$dataPosts['date_fin'] = (isset($date_fin)) ? $date_fin :  $calendrier->getDate_fin();

$dataPosts['filiere_id'] = (isset($data->filiere_id)) ? $data->filiere_id :  $calendrier->getFiliere_id();

$dataPosts['session_id'] = (isset($data->candidat_id)) ? $data->candidat_id :  $calendrier->getSession_id();

$dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $calendrier->getCreated_by();



                if($categoryExists) {  //IF Filiere EXISTS 

                  

                }else{ //Filiere NOT EXISTS


                    //GET filiere FORM
                  $calendrierForm = new CalendrierForm();

                  

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                  $calendrierForm->setData($dataPosts);


                    //INIT INPUT FILTER
                  
                  $calendrierForm->setInputFilter($calendrier->getInputFilter());


                     //CATEGORY FORM IS
                  if ($calendrierForm->isValid()) {

                         //INIT CATEGORY DATA
                   $calendrier->exchangeArray($calendrierForm->getData());

                   $this->calendrierTable->saveCalendrier($calendrier);

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

            $calendrier_id = (int) $this->params()->fromRoute('id', 0);
   
            $created_by = $this->params()->fromRoute('name');

            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->usersTable->getUserByToken($created_by);
            $calendrier = $this->calendrierTable->getCalendrier($calendrier_id);
            $this->calendrierTable->deleteCalendrier($calendrier->getId_session_filiere());
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

            $filiere_object = $this->calendrierTable->getFiliere($filiere_id);

            return new JsonModel([
              
              'data' => $this->hydrator->extract($filiere_object)]
          ); 
    }



         
 
 
    
       


     }






     ?>
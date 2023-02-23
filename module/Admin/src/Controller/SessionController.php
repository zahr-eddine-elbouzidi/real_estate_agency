<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\SessionForm;
use Admin\Model\Session;
use Admin\Model\SessionTable;
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
class SessionController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject etablissement table 
    */
    private $sessionTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;

    // Add this constructor:
    public function __construct(SessionTable $sessionTable , UsersTable $userTable)
    {
        $this->sessionTable = $sessionTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $sessions_objects = $this->sessionTable->fetchAll();
        return new JsonModel([
                "data" => $sessions_objects , 
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
     * get etab by id param
     * @param etablissement_id
     */
    public function getSessionAction(){

        $session_id = $this->params()->fromRoute('id', 0);  

        $session = $this->sessionTable->getSession($session_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($session)]
        );
    }

   /**
    * @param nom_session

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

               if(!$this->sessionTable->getRecordByName($data->nom_session)){

                     $session = new Session();
                     
                     //GET Session FORM

                     $sessionForm = new SessionForm();
                     
                     $dataPosts['id_session'] = 0;
                     
                     $dataPosts['nom_session'] = $data->nom_session;
                   
                     $dataPosts['created_by'] = $user->getEmail();
                     

                     // SET INPUT FILTER 
                      
                     $sessionForm->setInputFilter($session->getInputFilter());
                     
                     // SET DATA FORM
                     $sessionForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($sessionForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $session->exchangeArray($sessionForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->sessionTable->saveSession($session);

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
      * @param nom_session
      */
     public function editAction()
     {
 

                $drap = false; 

                $mustUpload = false;


                $categoryExists = false;


                //GET SESSION ID
                $session_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = $this->getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET SESSION
                $session = $this->sessionTable->getSession($session_id);
                     
                $old_session_name = $session->getNom_session();


                if(isset($data->nom_session)){

                  if($data->nom_session != $session->getNom_session()){

                    
                         //IF SESSION NOT EXISTS
                    if(!$this->sessionTable->getRecordByName($data->nom_session)  ){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
                $dataPosts['id_session'] = $session_id;
                     
                $dataPosts['nom_session'] = (isset($data->nom_session)) ? $data->nom_session :  $session->getNom_session();
                     
                $dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $session->getCreated_by();

 
                
                if($categoryExists) {  //IF ETAB EXISTS 

                  
                }else{ //SESS NOT EXISTS

                    //GET SESS FORM
                    $sessionForm = new SessionForm();

                    //BINGING FORM WITH THE SESS OBJECT 
                    $sessionForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $sessionForm->setInputFilter($session->getInputFilter());


                     //SESS FORM IS
                     if ($sessionForm->isValid()) {

                         //INIT CATEGORY DATA
                         $session->exchangeArray($sessionForm->getData());

                         $this->sessionTable->saveSession($session);

                       
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
            $session = $this->sessionTable->getSession($id);
            $this->sessionTable->deleteSession($session->getId_session());
            return true;
      }
    
    
}
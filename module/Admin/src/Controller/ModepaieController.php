<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\ModeForm;
use Admin\Model\Mode;
use Admin\Model\ModeTable;
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
class ModepaieController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject etablissement table 
    */
    private $modeTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;

    // Add this constructor:
    public function __construct(ModeTable $modeTable , UsersTable $userTable)
    {
        $this->modeTable = $modeTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $modes_objects = $this->modeTable->fetchAll();
        return new JsonModel([
                "data" => $modes_objects , 
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
    public function getModeAction(){

        $mode_id = $this->params()->fromRoute('id', 0);  

        $mode = $this->modeTable->getMode($mode_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($mode)]
        );
    }

   /**
    * @param nom_mode

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

               if(!$this->modeTable->getRecordByName($data->nom_mode)){

                     $mode = new Mode();
                     
                     //GET MODE FORM

                     $modeForm = new ModeForm();
                     
                     $dataPosts['id_mode'] = 0;
                     
                     $dataPosts['nom_mode'] = $data->nom_mode;
                   
                     $dataPosts['created_by'] = $user->getEmail();
                     

                     // SET INPUT FILTER 
                      
                     $modeForm->setInputFilter($mode->getInputFilter());
                     
                     // SET DATA FORM
                     $modeForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($modeForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $mode->exchangeArray($modeForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->modeTable->saveMode($mode);

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
      * @param nom_mode
      */
     public function editAction()
     {
 

                $drap = false; 

                $mustUpload = false;


                $categoryExists = false;


                //GET MODE ID
                $mode_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = $this->getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET MODE
                $mode = $this->modeTable->getMode($mode_id);
                     
                $old_mode_name = $mode->getNom_mode();


                if(isset($data->nom_session)){

                  if($data->nom_mode != $mode->getNom_mode()){

                    
                         //IF MODE NOT EXISTS
                    if(!$this->modeTable->getRecordByName($data->nom_mode)  ){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
                $dataPosts['id_mode'] = $mode_id;
                     
                $dataPosts['nom_mode'] = (isset($data->nom_mode)) ? $data->nom_mode :  $mode->getNom_mode();
                     
                $dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $mode->getCreated_by();

 
                
                if($categoryExists) {  //IF ETAB EXISTS 

                  
                }else{ //MODE NOT EXISTS

                    //GET MODE FORM
                    $modeForm = new ModeForm();

                    //BINGING FORM WITH THE MODE OBJECT 
                    $modeForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $modeForm->setInputFilter($mode->getInputFilter());


                     //MODE FORM IS
                     if ($modeForm->isValid()) {

                         //INIT MODE DATA
                         $mode->exchangeArray($modeForm->getData());

                         $this->modeTable->saveMode($mode);

                       
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
            $mode = $this->modeTable->getMode($id);
            $this->modeTable->deleteMode($mode->getId_mode());
            return true;
      }
    
    
}
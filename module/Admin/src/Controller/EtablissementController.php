<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\EtablissementForm;
use Admin\Model\Etablissement;
use Admin\Model\EtablissementTable;
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
class EtablissementController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject etablissement table 
    */
    private $etablissementTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;

    // Add this constructor:
    public function __construct(EtablissementTable $etablissementTable , UsersTable $userTable)
    {
        $this->etablissementTable = $etablissementTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $etablissement_objects = $this->etablissementTable->fetchAll();
        return new JsonModel([
                "data" => $etablissement_objects , 
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
    public function getEtablissementAction(){

        $etablissement_id = $this->params()->fromRoute('id', 0);  

        $etablissement = $this->etablissementTable->getEtablissement($etablissement_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($etablissement)]
        );
    }

   /**
    * @param nom_etablissement
    * @param type_etablissement
    * @param pays_etablissement
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

               if(!$this->etablissementTable->getRecordByName($data->nom_etablissement)){

                     $etablissement = new Etablissement();
                     
                     //GET Etab FORM

                     $etabForm = new EtablissementForm();
                     
                     $dataPosts['id_etablissement'] = 0;
                     
                     $dataPosts['nom_etablissement'] = $data->nom_etablissement;

                     $dataPosts['type_etablissement'] = $data->type_etablissement;

                     $dataPosts['pays_etablissement'] = $data->pays_etablissement;
                   
                     $dataPosts['created_by'] = $user->getEmail();
                     

                     // SET INPUT FILTER 
                      
                     $etabForm->setInputFilter($etablissement->getInputFilter());
                     
                     // SET DATA FORM
                     $etabForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($etabForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $etablissement->exchangeArray($etabForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->etablissementTable->saveEtablissement($etablissement);

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
      * @param nom_etablissement
      * @param type_etablissement
      * @param pays_etablissement
      */
     public function editAction()
     {
 

                $drap = false; 

                $mustUpload = false;


                $categoryExists = false;


                //GET ETAB ID
                $etablissement_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = $this->getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET Etablissement
                $etablissement = $this->etablissementTable->getEtablissement($etablissement_id);
                     
                $old_etab_name = $etablissement->getNom_etablissement();


                if(isset($data->nom_etablissement)){

                  if($data->nom_etablissement != $etablissement->getNom_etablissement()){

                    
                         //IF ETAB NOT EXISTS
                    if(!$this->etablissementTable->getRecordByName($data->nom_etablissement)){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
                $dataPosts['id_etablissement'] = $etablissement_id;
                     
                $dataPosts['nom_etablissement'] = (isset($data->nom_etablissement)) ? $data->nom_etablissement :  $etablissement->getNom_etablissement();

                $dataPosts['type_etablissement'] = (isset($data->type_etablissement)) ? $data->type_etablissement :  $etablissement->getType_etablissement();
               
                $dataPosts['pays_etablissement'] = (isset($data->pays_etablissement)) ? $data->pays_etablissement :  $etablissement->getPays_etablissement();
                     
                $dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $etablissement->getCreated_by();

 
                
                if($categoryExists) {  //IF ETAB EXISTS 

                  
                }else{ //ETAB NOT EXISTS

                    //GET ETAB FORM
                    $etabForm = new EtablissementForm();

                    //BINGING FORM WITH THE Etab OBJECT 
                    $etabForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $etabForm->setInputFilter($etablissement->getInputFilter());


                     //Etab FORM IS
                     if ($etabForm->isValid()) {

                         //INIT CATEGORY DATA
                         $etablissement->exchangeArray($etabForm->getData());

                         $this->etablissementTable->saveEtablissement($etablissement);

                       
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
            $etablissement = $this->etablissementTable->getEtablissement($id);
            $this->etablissementTable->deleteEtablissement($etablissement->getId_etablissement());
            return true;
      }
    
    
}
<?php 

 

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Inscription;         
use Admin\Model\InscriptionTable;         
use Admin\Model\UsersTable;         
use Admin\Model\CategorieTable;         
use Admin\Form\InscriptionForm;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class InscriptionsController extends AbstractRestfulController
{
  
 /**
  * properties
  */
 private  $inscriptionTable;
 private  $usersTable; 
 private $hydrator;


 // Add this constructor:
 public function __construct(InscriptionTable $inscriptionTable , UsersTable $usersTable)
 {
     $this->inscriptionTable = $inscriptionTable;
     $this->usersTable = $usersTable;
     $this->hydrator  = new Hydrator\ArraySerializableHydrator();
      
 }

    public function getListAction()
    { 
    
        $created_by = $this->params()->fromRoute('id', 0); // get created by property

        $candidat_id = $this->params()->fromRoute('name', 0); // get created by property

        $inscriptions = null;

        $inscriptions = $this->inscriptionTable->fetchAllByCandidat($candidat_id);

        $data = array();
        foreach ($inscriptions as $result) {
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
        $date_inscription = $data->date_inscription;
        if(!$this->inscriptionTable->getRecordByName($data->candidat_id , $date_inscription)){

        $inscription = new Inscription();
        
                            //GET FILIERE FORM
        $inscriptionForm = new InscriptionForm();
        
        $dataPosts['id_inscription'] = 0;

        $dataPosts['date_inscription'] = $date_inscription;

        $dataPosts['mt_paye_trait_dossier'] = $data->mt_paye_trait_dossier;

        $dataPosts['mt_reste_trait_dossier'] = $data->mt_reste_trait_dossier;
        
        $dataPosts['created_by'] = $user->getEmail();

        $dataPosts['filiere_id'] = $data->filiere_id;

        $dataPosts['candidat_id'] = $data->candidat_id;
        

                            // SET INPUT FILTER 
        
        $inscriptionForm->setInputFilter($inscription->getInputFilter());
        
                            // SET DATA FORM
        $inscriptionForm->setData($dataPosts);
        
        
        
        $id = 0;
        
        //CHECK IS VALID FORM
      
        if ($inscriptionForm->isValid()) {
        
        //INIT CATEGORY DATA
        $inscription->exchangeArray($inscriptionForm->getData());

        // INSERT AND GET CATEGORY ID

        $id = $this->inscriptionTable->saveInscription($inscription);

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
  $inscription_id = $this->params()->fromRoute('id', 0);  

  
                //GET JSON DATA 
  $data = json_decode(file_get_contents("php://input"));



 $staticSalt = Slug::getConfigSalt()['static_salt'];
 $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
 $user =$this->usersTable->getUserByToken($created_by);
 


                //GET Filiere
 $inscription = $this->inscriptionTable->getInscription($inscription_id);
 
 $date_inscription = $data->date_inscription;
 

 
  


$dataPosts['id_inscription'] = $inscription->getId_inscription();

$dataPosts['date_inscription'] = (isset($date_inscription)) ? $date_inscription :  $inscription->getDate_inscription();

$dataPosts['mt_paye_trait_dossier'] = (isset($data->mt_paye_trait_dossier)) ? $data->mt_paye_trait_dossier :  $inscription->getMt_paye_trait_dossier();

$dataPosts['mt_reste_trait_dossier'] = (isset($data->mt_reste_trait_dossier)) ? $data->mt_reste_trait_dossier :  $inscription->getMt_reste_trait_dossier();

$dataPosts['filiere_id'] = (isset($data->filiere_id)) ? $data->filiere_id :  $inscription->getFiliere_id();

$dataPosts['candidat_id'] = (isset($data->candidat_id)) ? $data->candidat_id :  $inscription->getCandidat_id();

$dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $filiere_object->getCreated_by();



                if($categoryExists) {  //IF Filiere EXISTS 

                  

                }else{ //Filiere NOT EXISTS


                    //GET filiere FORM
                  $inscriptionForm = new InscriptionForm();

                  

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                  $inscriptionForm->setData($dataPosts);


                    //INIT INPUT FILTER
                  
                  $inscriptionForm->setInputFilter($inscription->getInputFilter());


                     //CATEGORY FORM IS
                  if ($inscriptionForm->isValid()) {

                         //INIT CATEGORY DATA
                   $inscription->exchangeArray($inscriptionForm->getData());

                   $this->inscriptionTable->saveInscription($inscription);

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

            $inscription_id = (int) $this->params()->fromRoute('id', 0);
   
            $created_by = $this->params()->fromRoute('name');

            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->usersTable->getUserByToken($created_by);
            $inscription = $this->inscriptionTable->getInscription($inscription_id);
            $this->inscriptionTable->deleteInscription($inscription->getId_inscription());
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

            $filiere_object = $this->inscriptionTable->getFiliere($filiere_id);

            return new JsonModel([
              
              'data' => $this->hydrator->extract($filiere_object)]
          ); 
    }


    public function getPartenaireByFiliereAction(Type $var = null)
    {
       $filiere_id = $this->params()->fromRoute('id', 0);
       $partenaires = $this->inscriptionTable->getPartenaireByFiliere($filiere_id);
       $data = array();
       foreach ($partenaires as $result) {
           $data[] = $result;
       }
       $data = current($data);
       return new JsonModel([  
         'data' => $data]
      ); 
    }



         
 
 
    
       


     }






     ?>
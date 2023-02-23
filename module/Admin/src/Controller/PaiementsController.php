<?php 

 

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Paiements;         
use Admin\Model\PaiementsTable;         
use Admin\Model\UsersTable;         
use Admin\Model\CategorieTable;         
use Admin\Form\PaiementsForm;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class PaiementsController extends AbstractRestfulController
{
  
 /**
  * properties
  */
 private  $paiementsTable; //paiementsTable
 private  $usersTable; 
 private  $hydrator;


 // Add this constructor:
 public function __construct(PaiementsTable $paiementsTable , UsersTable $usersTable)
 {
     $this->paiementsTable = $paiementsTable;
     $this->usersTable = $usersTable;
     $this->hydrator  = new Hydrator\ArraySerializableHydrator();
      
 }

    public function getListAction()
    { 
    
        $created_by = $this->params()->fromRoute('id', 0); // get created by property

        $inscription_id = $this->params()->fromRoute('name', 0); // get created by property

        $paiements = null;

        $paiements = $this->paiementsTable->fetchAllByInscription($inscription_id);

        $data = array();
        foreach ($paiements as $result) {
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

        $date_paiement = $data->date_paiement;
        
 
        $paiements = new Paiements();
        
                            //GET FILIERE FORM
        $paiementsForm = new PaiementsForm();
        
        $dataPosts['id_paiement'] = 0;

        $dataPosts['date_paiement'] = $date_paiement;

        $dataPosts['remise'] = $data->remise;

        $dataPosts['mt_paye'] = $data->mt_paye;

        $dataPosts['type_paie'] = $data->type_paie;

        $dataPosts['created_by'] = $user->getEmail();

        $dataPosts['mode_id'] = $data->mode_id;

        $dataPosts['inscription_id'] = $data->inscription_id;
        

                            // SET INPUT FILTER 
        
        $paiementsForm->setInputFilter($paiements->getInputFilter());
        
                            // SET DATA FORM
        $paiementsForm->setData($dataPosts);

        $inscription = $this->paiementsTable->getInscriptionByID($data->inscription_id);

        $inscription = current($inscription);

        if($data->mt_paye > $inscription->mt_reste_trait_dossier){
          return new JsonModel(array('drap' => false ,
                                      'reste' => $inscription->mt_reste_trait_dossier ));
        }
        
       //var_dump($inscription->mt_reste_trait_dossier);
       //var_dump($inscription->mt_paye_trait_dossier);
       //die();
        
        $id = 0;
        
        //CHECK IS VALID FORM
      
        if ($paiementsForm->isValid()) {
        
        //INIT CATEGORY DATA
        $paiements->exchangeArray($paiementsForm->getData());

        // INSERT AND GET CATEGORY ID

        $id = $this->paiementsTable->savePaiement($paiements);

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
 $calendrier = $this->paiementsTable->getCalendrier($calendrier_id);
 
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

                   $this->paiementsTable->saveCalendrier($calendrier);

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

            $paiement_id = (int) $this->params()->fromRoute('id', 0);
   
            $created_by = $this->params()->fromRoute('name');

            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->usersTable->getUserByToken($created_by);
            $paiement = $this->paiementsTable->getPaiement($paiement_id);
            $this->paiementsTable->deletePaiement($paiement->getId_paiement());
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

            $filiere_object = $this->paiementsTable->getFiliere($filiere_id);

            return new JsonModel([
              
              'data' => $this->hydrator->extract($filiere_object)]
          ); 
    }



         
 
 
    
       


     }






     ?>
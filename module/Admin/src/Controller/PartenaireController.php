<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Admin\Form\PartenaireForm;
use Admin\Model\Partenaire;
use Admin\Model\PartenaireTable;
use Admin\Model\UsersTable;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Hydrator;
use Admin\Model\Directory;
use Admin\Model\Upload;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;  

/**
 * CategorieController
 *
 * @author
 *
 * @version
 *
 */
class PartenaireController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject partenaire table 
    */
    private $partenaireTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;


    protected $upload;

 	 
    protected $directoryObject;

    // Add this constructor:
    public function __construct(PartenaireTable $partenaireTable , UsersTable $userTable)
    {
        $this->partenaireTable = $partenaireTable;
        $this->userTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
        $this->upload  =  new Upload();
 	      $this->directoryObject = new Directory();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $categories_objects = $this->partenaireTable->fetchAll();
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
     * @param partenaire_id
     */
    public function getPartenaireAction(){

        $partenaire_id = $this->params()->fromRoute('id', 0);  

        $partenaire = $this->partenaireTable->getPartenaire($partenaire_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($partenaire)]
        );
    }

    /**
      * add action
      * @param etablissement
      * @param domaine
      * @param cycle
      * @param site_web
      * @param tel
      * @param email
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

               if(!$this->partenaireTable->getRecordByName($data->etablissement)){

                     $partenaire = new Partenaire();
                     
                     //GET CATEGORY FORM

                     $partenaireForm = new PartenaireForm();
                     
                     $dataPosts['id'] = 0;
                     
                     $dataPosts['etablissement'] = $data->etablissement;

                     $dataPosts['domaine'] = $data->domaine;

                     $dataPosts['cycle'] = $data->cycle;
                     
                     $dataPosts['site_web'] = $data->site_web;

                     $dataPosts['tel'] = $data->tel;

                     $dataPosts['email'] = $data->email;

                     $dataPosts['criteres'] = $data->criteres;
                     
                     $dataPosts['filiere_etude'] = $data->filiere_etude;
                     
                     $dataPosts['coordonateur'] = $data->coordonateur;
                     
                     $dataPosts['pays'] = $data->pays;
                     
                     $dataPosts['frais_inscription_annuel'] = $data->frais_inscription_annuel;
                     
                     $dataPosts['frais_traitement_dossier'] = $data->frais_traitement_dossier;

                     $dataPosts['created_by'] = $user->getEmail();
                     

                     // SET INPUT FILTER 
                      
                     $partenaireForm->setInputFilter($partenaire->getInputFilter());
                     
                     // SET DATA FORM
                     $partenaireForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($partenaireForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $partenaire->exchangeArray($partenaireForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->partenaireTable->savePartenaire($partenaire);

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
                $partenaire_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = $this->getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET partenaire
                $partenaire = $this->partenaireTable->getPartenaire($partenaire_id);
                     
                $old_category_name = $partenaire->getEtablissement();


                if(isset($data->etablissement)){

                  if($data->etablissement != $partenaire->getEtablissement()){

                    
                         //IF CATEGORY NOT EXISTS
                    if($this->partenaireTable->getElementByName($data->etablissement) === 0 ){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
                $dataPosts['id'] = $partenaire_id;
                     
                $dataPosts['etablissement'] = (isset($data->etablissement)) ? $data->etablissement :  $partenaire->getEtablissement();

                $dataPosts['domaine'] = (isset($data->domaine)) ? $data->domaine :  $partenaire->getDomaine();
               
                $dataPosts['cycle'] = (isset($data->cycle)) ? $data->cycle :  $partenaire->getCycle();
                     
                $dataPosts['site_web'] = (isset($data->site_web)) ? $data->site_web :  $partenaire->getSiteWeb();
                
                $dataPosts['tel'] = (isset($data->tel)) ? $data->tel :  $partenaire->getTel();

                $dataPosts['email'] = (isset($data->email)) ? $data->email :  $partenaire->getEmail();

                $dataPosts['criteres'] = (isset($data->criteres)) ? $data->criteres :  $partenaire->getCriteres();
               
                $dataPosts['filiere_etude'] = (isset($data->filiere_etude)) ? $data->filiere_etude :  $partenaire->getFiliereEtude();
               
                $dataPosts['coordonateur'] = (isset($data->coordonateur)) ? $data->coordonateur :  $partenaire->getCoordonateur();
               
                $dataPosts['pays'] = (isset($data->pays)) ? $data->pays :  $partenaire->getPays();
               
                $dataPosts['frais_inscription_annuel'] = (isset($data->frais_inscription_annuel)) ? $data->frais_inscription_annuel :  $partenaire->getFraisInscription();
               
                $dataPosts['frais_traitement_dossier'] = (isset($data->frais_traitement_dossier)) ? $data->frais_traitement_dossier :  $partenaire->getFraisTraitement();
     
                $dataPosts['created_by'] = (isset($user->usr_email)) ? $user->usr_email :  $partenaire->getCreatedBy();

 
                
                if($categoryExists) {  //IF CATEGORY EXISTS 

                  
                }else{ //CATEGORY NOT EXISTS

                    //GET CATEGORY FORM
                    $partenaireForm = new PartenaireForm();

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                    $partenaireForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $partenaireForm->setInputFilter($partenaire->getInputFilter());


                     //CATEGORY FORM IS
                     if ($partenaireForm->isValid()) {

                         //INIT CATEGORY DATA
                         $partenaire->exchangeArray($partenaireForm->getData());

                         $this->partenaireTable->savePartenaire($partenaire);

                       
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
            $partenaire = $this->partenaireTable->getPartenaire($id);
            $this->partenaireTable->deletePartenaire($partenaire->getId());
            return true;
      }
    

          /**
     * check image upload 
     *
     *
     **/
    public function checkUploadAction(){
            
      //BEGIN DECLARATION

      $isImage = -1;
      $filename = null;

      //END DECLARATION
  

      //GET CREATED BY PARAM FROM URL
      $created_by = $this->params()->fromRoute('id', 0);
      $title =  $this->params()->fromRoute('name');

      
      if(!empty($_FILES)){
          
    
          //CREATE NEW DIRECTORY IF NOT EXISTS.  
      $this->directoryObject->createDirectory($created_by , 'partenaires');

      $isImage = $this->upload->checkValidateFileType($_FILES);
      
              
              
      }

      //END CHECK ETABLISSEMENT SELECTED
  
      //Cateogory ID for increment ID Image importer 
      $post_id = 0;

      if($isImage == 0 ){
          

        
          
          //format du fichier importer 
          //Renomer le fichier avant d'importation
      
          $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ] , 
              $_FILES[ 'file' ][ 'tmp_name' ],"excel-"."partenaires");


      
      


      }
      
  //END TRAITEMENT
  
  return new JsonModel(array(
      
      'messagefileImage' => $isImage,
      'filename'       => $filename
      
  ));
  
  
}

public function uploadAction(){

  //BEGIN DECLARATION

  $isImage = -1;
  $filename = null;

  //END DECLARATION


  $title = (isset($_REQUEST['title']) && $_REQUEST['title'] != 'undefined') ?  $_REQUEST['title'] : null;
 //GET CREATED BY PARAM FROM URL
  $created_by = $this->params()->fromRoute('id', 0);

  if(!empty($_FILES)){
      
  
      
  //CREATE NEW DIRECTORY IF NOT EXISTS.  
  $this->directoryObject->createDirectory($created_by , 'partenaires');
          
      

  
  $isImage = $this->upload->checkValidateFileType($_FILES);
  

          
      
  }

//END CHECK ETABLISSEMENT SELECTED

  //Cateogory ID for increment ID Image importer 
  $post_id = 0;
  if($isImage == 0 ){
      
     
      
      //format du fichier importer 
      //Renomer le fichier avant d'importation
      
      $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ], 
          $_FILES[ 'file' ][ 'tmp_name' ],time()."-"."partenaires");

      if($this->upload->moveUploadFile($filename , 
          $_FILES[ 'file' ][ 'tmp_name' ],$created_by,'partenaires')){




            //begin read file upload 

 

            //end file upload 


            $file = $filename;
            $spreadsheet = IOFactory::load('public/uploadsFiles/partenaires/'.$file);
            $sheetCount = $spreadsheet->getSheetCount(); 
           // echo $sheetCount;
        
            //for ($i = 0; $i < $sheetCount; $i++) 
            //{
              $spreadsheett = null;
              $spreadsheett = $spreadsheet->getActiveSheet();
              $data_array =  $spreadsheett->toArray();
              $j = 0;
              foreach($data_array as $data){
                $j++;
                //echo '<pre>';
                if($j > 2){
                   $this->saveDataIntoPartenaireTable($data , 'Administrateur' );
                }
               // echo '</pre>';
              }
             //}
      
          //  die();







      }



  }
  
//END TRAITEMENT

return new JsonModel(array(
  
  'messagefileImage' => $isImage,
  'filename'       => $filename
  
));


}



public function saveDataIntoPartenaireTable($data , $user){

  $drap_exists = false;
  $drap_error = false;
  if(!$this->partenaireTable->getRecordByName($data[0])){ //check exists establishment
    $drap_exists = false;
    $partenaire = new Partenaire();
    //GET CATEGORY FORM
    $partenaireForm = new PartenaireForm();
    $dataPosts['id'] = 0;
    $dataPosts['etablissement'] = $data[0];
    $dataPosts['domaine'] = $data[1];
    $dataPosts['cycle'] = $data[2];
    $dataPosts['site_web'] = $data[3];
    $dataPosts['tel'] = $data[4];
    $dataPosts['email'] = $data[5];
    $dataPosts['created_by'] = $user;
    // SET INPUT FILTER 
    $partenaireForm->setInputFilter($partenaire->getInputFilter());
    // SET DATA FORM
    $partenaireForm->setData($dataPosts);
    $id = 0;
    //CHECK IS VALID FORM
    if ($partenaireForm->isValid()) {
        //INIT CATEGORY DATA
        $partenaire->exchangeArray($partenaireForm->getData());
        // INSERT AND GET CATEGORY ID
        $id = $this->partenaireTable->savePartenaire($partenaire);
        $drap_error=true;
    }else {
        $drap_error=false;
    }
}else{
     $drap_exists = true; 
}

  return ['exists' => $drap_exists , 'error' => $drap_error];

}






    
}
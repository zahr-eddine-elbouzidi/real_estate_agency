<?php

namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Hydrator;
use Admin\Form\FileForm;
use Admin\Model\File;
use Admin\Model\Slug;
use Admin\Model\FileTable;
use Admin\Model\UsersTable;
use Admin\Model\Directory;
use Admin\Model\Upload;


/**
 * FileController
 *
 * @author
 *
 * @version
 *
 */
class FileController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject category table 
    */
    private $fileTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;


    protected $upload;

 	 
    protected $directoryObject;

    // Add this constructor:
    public function __construct(FileTable $fileTable , UsersTable $usersTable)
    {
        $this->fileTable = $fileTable;
        $this->userTable = $usersTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
        $this->upload  =  new Upload();
 	    $this->directoryObject = new Directory();
    }
    /**
     * Action get List of categories
     */
    public function getListAction()
    {
        $created_by = $this->params()->fromRoute('id', 0);  
        $files = $this->fileTable->fetchAll();
        return new JsonModel([
                "data" => $posts , 
                "status" => $this->response->getStatusCode()
        ]);
        
    }


    /**
     * Action get List of images by post ID
     */
    public function getListByPostAction()
    {
        $post_id = $this->params()->fromRoute('id', 0);  

        $files = $this->fileTable->getFilesByPost($post_id);

        return new JsonModel([
                "data" => $files , 
                "status" => $this->response->getStatusCode()
        ]);
        
    }
  
 

    public function addAction()
    {
 

               $drap = false; 

               //GET JSON DATA FORM ANGULARJS
        
               $data = json_decode(file_get_contents("php://input"));

               $staticSalt = Slug::getConfigSalt()['static_salt'];

               $created_by = substr($data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
               
               $user =$this->userTable->getUserByToken($created_by);

               $mustUpload = true;

 
                     $file = new File();
                     
                     //GET POST FORM

                     
                     $fileForm = new FileForm();
                     
                     $dataPosts['id_file'] = 0;
                     
                     $dataPosts['filename'] = (isset($data->filename) && $data->filename != null) ?  $data->filename : null;
                     
                     $dataPosts['created_by'] = $user->getEmail();

                     $dataPosts['post_id'] = (isset($data->post_id)) ? $data->post_id :  null;

                     // SET INPUT FILTER 
                      
                     $fileForm->setInputFilter($file->getInputFilter());
                     
                     // SET DATA FORM
                     $fileForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($fileForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $file->exchangeArray($fileForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->fileTable->saveFile($file);

                         $drap=true;
 
                         
                     }else {

                         $drap=false;
                        
                          
                     }
                     

          


             return new JsonModel(array('drap' => $drap , 'mustUpload' => $mustUpload ));

               
     }

  

     /**
      * delete action
      * @param id from url params
      */
     public function deleteAction()
     {
  
            $id = (int) $this->params()->fromRoute('id', 0);
            $created_by = $this->params()->fromRoute('name');
            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->userTable->getUserByToken($created_by);
            if($user){
                $file = $this->fileTable->getFile($id);
                $this->fileTable->deleteFile($file->getIdFile());
            }
           
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
        $this->directoryObject->createDirectory($created_by , 'files');

        $isImage = $this->upload->checkValidateImageType($_FILES);
        
                
                
        }

        //END CHECK ETABLISSEMENT SELECTED
        
            //Cateogory ID for increment ID Image importer 
        $post_id = 0;

            if($isImage == 0 ){
                
                $lastCategory = $this->fileTable->getLastFileId();
                
              
                    
                $post_id = $lastCategory['max_of_files'];
                $post_id = ($post_id == null) ? 0 : $post_id;
                $post_id = (int) $post_id + 1;
                
                //format du fichier importer 
                //Renomer le fichier avant d'importation
            
                $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ] , 
                    $_FILES[ 'file' ][ 'tmp_name' ],$title,$post_id."-"."files");


            
            


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
        $this->directoryObject->createDirectory($created_by , 'files');
                
            
    
        
        $isImage = $this->upload->checkValidateImageType($_FILES);
        

                
            
        }

    //END CHECK ETABLISSEMENT SELECTED
    
        //Cateogory ID for increment ID Image importer 
        $post_id = 0;
        if($isImage == 0 ){
            
            $lastCategory = $this->fileTable->getLastFileId();
                
              
                    
                $post_id = $lastCategory['max_of_files'];
                $post_id = ($post_id == null) ? 0 : $post_id;
                $post_id = (int) $post_id + 1;
            
            //format du fichier importer 
            //Renomer le fichier avant d'importation
            
            $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ], 
                $_FILES[ 'file' ][ 'tmp_name' ],$title,$post_id."-"."files");

            if($this->upload->moveUploadFile($filename , 
                $_FILES[ 'file' ][ 'tmp_name' ],$created_by,'files')){

            }



        }
        
    //END TRAITEMENT
    
    return new JsonModel(array(
        
        'messagefileImage' => $isImage,
        'filename'       => $filename
        
    ));
    
 
}

    
}
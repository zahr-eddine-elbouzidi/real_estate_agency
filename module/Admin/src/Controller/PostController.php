<?php
namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\Hydrator;
use Admin\Form\PostForm;
use Admin\Model\Post;
use Admin\Model\Slug;
use Admin\Model\PostTable;
use Admin\Model\UsersTable;
use Admin\Model\Directory;
use Admin\Model\Upload;


/**
 * PostController
 *
 * @author
 *
 * @version
 *
 */
class PostController extends AbstractRestfulController 
{
   // Add this property:
   /**
    * inject category table 
    */
    private $postTable; 

    /**
     * inject user table
     */
    private $userTable;


    private $hydrator;


    protected $upload;

 	 
    protected $directoryObject;

    // Add this constructor:
    public function __construct(PostTable $postTable , UsersTable $usersTable)
    {
        $this->postTable = $postTable;
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
        $posts = $this->postTable->fetchAll();
        return new JsonModel([
                "data" => $posts , 
                "status" => $this->response->getStatusCode()
        ]);
        
    }
  

    /**
     * get post by id param
     * @param post_id
     */
    public function getPostAction(){

        $post_id = $this->params()->fromRoute('id', 0);  

        $post = $this->postTable->getPost($post_id);
  
        return new JsonModel(
            ['data' => $this->hydrator->extract($post)]
        );
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

               if(!$this->postTable->getPostByTitle($data->title)){

                     $post = new Post();
                     
                     //GET POST FORM

                     
                     $postForm = new PostForm();
                     
                     $dataPosts['id_post'] = 0;
                     
                     $dataPosts['title'] = $data->title;

                     $dataPosts['type'] = $data->type;

                     $dataPosts['content'] = $data->content;

                     $dataPosts['subcategory_id'] = $data->subcategory_id;

                    $dataPosts['level'] = (isset($data->level)) ? $data->level :  null;

                    $dataPosts['important_msg'] = (isset($data->important_msg)) ? $data->important_msg : null;
                
                     $dataPosts['enabled'] = (isset($data->enabled) && $data->enabled == true) ? 1 : 0;

                     $dataPosts['filename'] = (isset($data->filename) && $data->filename != null) ?  $data->filename : null;
                     
                     $dataPosts['created_by'] = $user->getEmail();

                     $dataPosts['address'] = (isset($data->address)) ? $data->address :  null;

                     $dataPosts['bedrooms'] = (isset($data->bedrooms)) ? $data->bedrooms :  null;

                     $dataPosts['bathrooms'] = (isset($data->bathrooms)) ? $data->bathrooms :  null;

                     $dataPosts['halls'] = (isset($data->halls)) ? $data->halls :  null;

                     $dataPosts['surface'] = (isset($data->surface)) ? $data->surface :  null;

                     $dataPosts['garage'] = (isset($data->garage)) ? $data->garage :  null;

                     $dataPosts['pays'] = (isset($data->pays)) ? $data->pays :  null;

                     $dataPosts['ville'] = (isset($data->ville)) ? $data->ville :  null;

                     $dataPosts['prix'] = (isset($data->prix)) ? $data->prix :  null;
                     

                     // SET INPUT FILTER 
                      
                     $postForm->setInputFilter($post->getInputFilter());
                     
                     // SET DATA FORM
                     $postForm->setData($dataPosts);
                     
                    
                     
                     $id = 0;
                     
                     //CHECK IS VALID FORM

                     if ($postForm->isValid()) {
                         
                         //INIT CATEGORY DATA
                         $post->exchangeArray($postForm->getData());
                          

                         // INSERT AND GET CATEGORY ID

                         $id = $this->postTable->savePost($post);

                         $drap=true;
 
                         
                     }else {

                         $drap=false;
                        
                          
                     }
                     

              }else{

                      $drap = false; 
              }


             return new JsonModel(array('drap' => $drap , 'mustUpload' => $mustUpload ));

               
     }

 
     public function editAction()
     {
 

                $drap = false; 

                $mustUpload = false;


                $categoryExists = false;


                //GET CATEGORY ID
                $post_id = (int)$this->params()->fromRoute('id', 0);  

 
                //GET JSON DATA 
                $data = json_decode(file_get_contents("php://input"));

                 
                $staticSalt = Slug::getConfigSalt()['static_salt'];
                $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
                $user =$this->userTable->getUserByToken($created_by);


                //GET CATEGORY
                $post = $this->postTable->getPost($post_id);
                     
                $old_post_name = $post->getTitle();


                if(isset($data->title)){

                  if($data->title !=  $post->getTitle()){
                         //IF CATEGORY NOT EXISTS
                    if(!$this->postTable->getPostByTitle($data->title)){

                      
                      $categoryExists = false;


                    }else{

                       $categoryExists = true;

                    }
                  }else{
                    $categoryExists = false;
                  }

                }
               
          
                $dataPosts['id_post'] = $post_id;
                     
                $dataPosts['title'] = (isset($data->title)) ? $data->title :  $post->getTitle();

                $dataPosts['type'] = (isset($data->type)) ? $data->type :  $post->getType();
               
                $dataPosts['content'] = (isset($data->content)) ? $data->content :  $post->getContent();
                                     
                $dataPosts['enabled'] = (isset($data->enabled)) ? $data->enabled :  $post->getEnabled();

                $dataPosts['level'] = (isset($data->level)) ? $data->level :  $post->getLevel();

                $dataPosts['important_msg'] = (isset($data->important_msg)) ? $data->important_msg :  $post->getImportant_msg();
                
                $dataPosts['subcategory_id'] = (isset($data->subcategory_id)) ? $data->subcategory_id :  $post->getSubcategory_id();
                
                $dataPosts['filename'] = (isset($data->filename)) ? $data->filename :  $post->getFilename();
                     
                $dataPosts['created_by'] =  $user->getEmail() ;

                $dataPosts['address'] = (isset($data->address)) ? $data->address :  $post->getAddress();

                $dataPosts['bedrooms'] = (isset($data->bedrooms)) ? $data->bedrooms :   $post->getBedrooms();

                $dataPosts['bathrooms'] = (isset($data->bathrooms)) ? $data->bathrooms :   $post->getBathrooms();

                $dataPosts['halls'] = (isset($data->halls)) ? $data->halls :   $post->getHalls();

                $dataPosts['surface'] = (isset($data->surface)) ? $data->surface :   $post->getSurface();

                $dataPosts['garage'] = (isset($data->garage)) ? $data->garage :   $post->getGarage();

                $dataPosts['pays'] = (isset($data->pays)) ? $data->pays :  $post->getPays();

                $dataPosts['ville'] = (isset($data->ville)) ? $data->ville :  $post->getVille();

                $dataPosts['prix'] = (isset($data->prix)) ? $data->prix :  $post->getPrix();
                
 
 
                
                if($categoryExists) {  //IF CATEGORY EXISTS 

                  
                }else{ //post NOT EXISTS

                    //GET post FORM
                    $postForm = new PostForm();

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                    $postForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $postForm->setInputFilter($post->getInputFilter());


                     //Post FORM IS
                     if ($postForm->isValid()) {

                         //INIT post DATA
                         $post->exchangeArray($postForm->getData());

                         $this->postTable->savePost($post);

                       
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
            $staticSalt = Slug::getConfigSalt()['static_salt'];
            $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
            $user =$this->userTable->getUserByToken($created_by);
            $post = $this->postTable->getPost($id);
            $this->postTable->deletePost($post->getId_post());
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
        $this->directoryObject->createDirectory($created_by , 'posts');

        $isImage = $this->upload->checkValidateImageType($_FILES);
        
                
                
        }

        //END CHECK ETABLISSEMENT SELECTED
        
            //Cateogory ID for increment ID Image importer 
        $post_id = 0;

            if($isImage == 0 ){
                
                $lastCategory = $this->postTable->getLastPostId();
                
              
                    
                $post_id = $lastCategory['max_of_posts'];
                $post_id = ($post_id == null) ? 0 : $post_id;
                $post_id = (int) $post_id + 1;
                
                //format du fichier importer 
                //Renomer le fichier avant d'importation
            
                $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ] , 
                    $_FILES[ 'file' ][ 'tmp_name' ],$title,$post_id."-"."posts");


            
            


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
        $this->directoryObject->createDirectory($created_by , 'posts');
                
            
    
        
        $isImage = $this->upload->checkValidateImageType($_FILES);
        

                
            
        }

    //END CHECK ETABLISSEMENT SELECTED
    
        //Cateogory ID for increment ID Image importer 
        $post_id = 0;
        if($isImage == 0 ){
            
            $lastCategory = $this->postTable->getLastPostId();
                
              
                    
                $post_id = $lastCategory['max_of_posts'];
                $post_id = ($post_id == null) ? 0 : $post_id;
                $post_id = (int) $post_id + 1;
            
            //format du fichier importer 
            //Renomer le fichier avant d'importation
            
            $filename = $this->upload->getNewFileName($_FILES[ 'file' ][ 'name' ], 
                $_FILES[ 'file' ][ 'tmp_name' ],$title,$post_id."-"."posts");

            if($this->upload->moveUploadFile($filename , 
                $_FILES[ 'file' ][ 'tmp_name' ],$created_by,'posts')){

            }



        }
        
    //END TRAITEMENT
    
    return new JsonModel(array(
        
        'messagefileImage' => $isImage,
        'filename'       => $filename
        
    ));
    
 
}

    
}
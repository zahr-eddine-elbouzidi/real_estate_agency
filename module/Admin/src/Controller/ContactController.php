<?php 

/**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


namespace Admin\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Admin\Model\Contact;         
use Admin\Form\ContactForm;      
use Admin\Model\UsersTable;              
use Admin\Model\ContactTable;              
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Admin\Model\Slug;
use Laminas\Hydrator;

class ContactController extends AbstractRestfulController
{
  
   /**
    * 
    * vars
    * 
    * */	
   private $contactTable; 
   private $usersTable; 
   private $hydrator;

   
    // Add this constructor:
    public function __construct(ContactTable $contactTable ,
                                UsersTable $userTable)
    {
        $this->contactTable = $contactTable;
        $this->usersTable = $userTable;
        $this->hydrator  = new Hydrator\ArraySerializableHydrator();
    }

	 /**
	 * 
	 * get contact list function  
	 * 
	 * */
    public function getListAction()
    {

        $created_by = $this->params()->fromRoute('id', 0);  
        $staticSalt = Slug::getConfigSalt()['static_salt'];
        $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
        $user =$this->usersTable->getUserByToken($created_by);
        $contacts = $this->contactTable->fetchAll(); // get One row
        if($contacts == NULL) return new JsonModel(['data' => null]);
        return new JsonModel(['data' => $this->hydrator->extract($contacts)]);
}


/**
 * get contact object
 */
public function getContactAction()
{
    $contact_id = $this->params()->fromRoute('id', 0);  
    $contact = $this->conatctTable->getContact($contact_id);
    return new JsonModel(['data' => $this->hydrator->extact($contact)]);
}









	/**
	 * 
	 * add contact function  
	 * 
	 * */
    public function addAction()
    {
       

       $drap = false; 

             //GET JSON DATA FORM ANGULARJS
       
       $data = json_decode(file_get_contents("php://input"));


      


  
   $staticSalt = Slug::getConfigSalt()['static_salt'];
   $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
   $user =$this->usersTable->getUserByToken($created_by);
   $contactsCount = ($this->contactTable->fetchAll() != NULL) ? $this->hydrator->extract($this->contactTable->fetchAll()) : null;
   $sizeOfObject = $this->contactTable->getSizeOfContact();
   $dataD = array();
   $mustUpload = true;

   if($sizeOfObject == 0){

       $contact = new Contact();
       
       
        //GET CATEGORY FORM
       $contactForm = new ContactForm();
       
       $dataPosts['id_contact'] = 0;
       
       $dataPosts['name'] = $data->name; 
       
       $dataPosts['tel'] = $data->tel;               
       
       $dataPosts['gsm'] = $data->gsm;               		
       
       $dataPosts['email'] = $data->email;               		
       
       $dataPosts['address'] = $data->address;

       $dataPosts['website'] = $data->website;

       $dataPosts['facebook_url'] = $data->facebook_url;

       $dataPosts['instagram_url'] = $data->instagram_url;

       $dataPosts['linkedin_url'] = $data->linkedin_url;

       $dataPosts['tiktok_url'] = $data->tiktok_url;

       $dataPosts['created_by'] = $user->getEmail();
       
                     // SET INPUT FILTER 
       
       $contactForm->setInputFilter($contact->getInputFilter());
       
                     // SET DATA FORM
       $contactForm->setData($dataPosts);
       
       
       
       $id = 0;
       
                     //CHECK IS VALID FORM
                     //
       
       if ($contactForm->isValid()) {
           
                         //INIT CATEGORY DATA
           $contact->exchangeArray($contactForm->getData());
           

            // INSERT AND GET CATEGORY ID

           $id = $this->contactTable->saveContact($contact);

           $drap=true;

                       //  $addr = $this->getRequest()->getServer();

                        // \Zend\Debug\Debug::dump($addr); die();

          /* $this->getHireTable()->saveHistory(

            $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
            $this->getRequest()->getServer()->get('HTTP_HOST'),
            'Insert',
            'Contact',
            NULL,
            $contact->name,
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

  /*  foreach ($contactsCount as $result) {
       $dataD[] = $result;
   }*/
   
   //$dataD = current($dataD);       
 
     
   $contact_object = $this->contactTable->getContact($contactsCount["id_contact"]);

   $old_category_name = $contact_object->getName();

   $dataPosts = array();

   $dataPosts['id_contact'] = $contact_object->getId_contact();
   
   $dataPosts['name'] = (isset($data->name)) ? $data->name :  $contact_object->getName();
   
   $dataPosts['tel'] = (isset($data->tel)) ? $data->tel :  $contact_object->getTel();               
   
   $dataPosts['gsm'] = (isset($data->gsm)) ? $data->gsm :  $contact_object->getGsm();   
   			
   $dataPosts['website'] = (isset($data->website)) ? $data->website :  $contact_object->getWebsite();     			
   
   $dataPosts['facebook_url'] = (isset($data->facebook_url)) ? $data->facebook_url :  $contact_object->getFacebook_url();

   $dataPosts['instagram_url'] = (isset($data->instagram_url)) ? $data->instagram_url :  $contact_object->getInstagram_url();     

   $dataPosts['linkedin_url'] = (isset($data->linkedin_url)) ? $data->linkedin_url :  $contact_object->getLinkedin_url();     			
  
   $dataPosts['tiktok_url'] = (isset($data->tiktok_url)) ? $data->tiktok_url :  $contact_object->getTiktok_url();     			
   
   $dataPosts['email'] = (isset($data->email)) ? $data->email :  $contact_object->getEmail();
   
   $dataPosts['address'] = (isset($data->address)) ? $data->address :  $contact_object->getAddress();
   
   $dataPosts['created_by'] = $user->getEmail();

   

                    //GET CATEGORY FORM
   $contactezForm = new ContactForm();

                    //BINGING FORM WITH THE CATEGORY OBJECT 
   $contactezForm->setData($dataPosts);

                    //INIT INPUT FILTER
   $contactezForm->setInputFilter($contact_object->getInputFilter());


                     //CATEGORY FORM IS
   if ($contactezForm->isValid()) {

                         //INIT CATEGORY DATA
       $contact_object->exchangeArray($contactezForm->getData());

       $this->contactTable->saveContact($contact_object);

      /* $this->getHireTable()->saveHistory(

        $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
        $this->getRequest()->getServer()->get('HTTP_HOST'),
        'Update',
        'Contact',
        $old_category_name,
        $category->name,
        $user->usr_email,
        $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
        $this->getRequest()->getServer()->get('SERVER_NAME'), 
        $this->getRequest()->getServer()->get('SERVER_ADDR'),
        $this->getRequest()->getServer()->get('SERVER_PORT')
    );*/
   }else{

   } 
   
   
   
   
}

return new JsonModel(array('drap' => $drap , 'mustUpload' => $mustUpload ));


}




	/**
	 * 
	 * edit contact function  
	 * 
	 * */
   public function editAction()
   {
       

    $drap = false; 


    
    $mustUpload = false;


    $categoryExists = false;


                //GET CATEGORY ID
    $category_id = (int)$this->params()->fromRoute('id', 0);  

    
                //GET JSON DATA 
    $data = json_decode(file_get_contents("php://input"));

    $sessionManager = new \Zend\Session\SessionManager();
    $sessionManager->start();
    $auth = new AuthenticationService();
    $session = new \Zend\Session\Container('token');
    
    if ($auth->hasIdentity() && $session->offsetExists('token')) {
        if($data->created_by != $session->offsetGet('token')){
                               //echo "Access Token is failed !";
            return new JsonModel(array(
                'data' => null)
        );
            exit;
        }
    }else{
       return new JsonModel(array(
        'data' => null)
   );
       exit;
   }

   $sm = $this->getServiceLocator();
   $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
   $config = $this->getServiceLocator()->get('Config');
   $staticSalt = $config['static_salt'];
   $created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
   $user =$this->getUsersTable()->getUserByToken($created_by);


                //GET CATEGORY
   $category = $this->getContactTable()->getContact($category_id);
   
   $old_category_name = $category->name;


   if(isset($data->name)){

      if($data->name != $category->name){
                         //IF CATEGORY NOT EXISTS
        if(!$this->getContactTable()->getContactByName($data->name,$user->usr_email)){

          
          $categoryExists = false;


      }else{

         $categoryExists = true;

     }
 }else{
    $categoryExists = false;
}

}

$dataPosts['id'] = $category_id;

$dataPosts['name'] = (isset($data->name)) ? $data->name :  $category->name;

$dataPosts['tel'] = (isset($data->tel)) ? $data->tel :  $category->tel;               

$dataPosts['gsm'] = (isset($data->gsm)) ? $data->gsm :  $category->gsm;     			

$dataPosts['email'] = (isset($data->email)) ? $data->email :  $category->email;

$dataPosts['adresse'] = (isset($data->adresse)) ? $data->adresse :  $category->adresse;



                if($categoryExists) {  //IF CATEGORY EXISTS 

                  
                }else{ //CATEGORY NOT EXISTS

                    //GET CATEGORY FORM
                    $categoryForm = new ContactForm();

                    //BINGING FORM WITH THE CATEGORY OBJECT 
                    $categoryForm->setData($dataPosts);

                    //INIT INPUT FILTER
                    $categoryForm->setInputFilter($category->getInputFilter());


                     //CATEGORY FORM IS
                    if ($categoryForm->isValid()) {

                         //INIT CATEGORY DATA
                       $category->exchangeArray($categoryForm->getData());

                       $this->getCategorieTable()->saveCategorie($category);

                       $this->getHireTable()->saveHistory(

                        $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
                        $this->getRequest()->getServer()->get('HTTP_HOST'),
                        'Update',
                        'Contact',
                        $old_category_name,
                        $category->name,
                        $user->usr_email,
                        $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
                        $this->getRequest()->getServer()->get('SERVER_NAME'), 
                        $this->getRequest()->getServer()->get('SERVER_ADDR'),
                        $this->getRequest()->getServer()->get('SERVER_PORT')
                    );
                   }else{

                   } 
               }

               return new JsonModel(array('drap' => $categoryExists , 'mustUpload' => $mustUpload ));       
           }

           

    /**
     * delete action
     * @return boolean
     */
    public function deleteAction()
    {
      
        $id = (int) $this->params()->fromRoute('id', 0);

        $created_by = $this->params()->fromRoute('name');

        $sessionManager = new \Zend\Session\SessionManager();
        $sessionManager->start();
        $auth = new AuthenticationService();
        $session = new \Zend\Session\Container('token');
        
        if ($auth->hasIdentity() && $session->offsetExists('token')) {
            if($created_by != $session->offsetGet('token')){
                               //echo "Access Token is failed !";
                return new JsonModel(array(
                    'data' => null)
            );
                exit;
            }
        }else{
           return new JsonModel(array(
            'data' => null)
       );
           exit;
       }


       $sm = $this->getServiceLocator();
       $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
       $config = $this->getServiceLocator()->get('Config');
       $staticSalt = $config['static_salt'];
       $created_by = substr( $created_by, 0, strlen($created_by)-strlen($staticSalt));
       $user =$this->getUsersTable()->getUserByToken($created_by);

       
       $categorie = $this->getCategorieTable()->getCategorie($id);

       $this->getCategorieTable()->deleteCategorie($id);

       $this->getHireTable()->saveHistory(

        $this->getRequest()->getServer()->get('REMOTE_ADDR'), 
        $this->getRequest()->getServer()->get('HTTP_HOST'),
        'Delete',
        'Catégorie',
        $categorie->nom,
        NULL,
        $user->usr_email,
        $this->getRequest()->getServer()->get('HTTP_USER_AGENT'),
        $this->getRequest()->getServer()->get('SERVER_NAME'), 
        $this->getRequest()->getServer()->get('SERVER_ADDR'),
        $this->getRequest()->getServer()->get('SERVER_PORT')

    );
       
       
       return true;
   }

    /**
     * getCategorieTable function
     * @return data table instance
     */
    public function getContactTable()
    {
       if (!$this->contactTable) {
           $sm = $this->getServiceLocator();
           $this->contactTable = $sm->get('Admin\Model\ContactTable');
       }
       return $this->contactTable;
   }


	/**
	 * 
	 * get user table for DI
	 * 
	 * */
  public function getUsersTable()
  {
    if (!$this->usersTable) {
        $sm = $this->getServiceLocator();
        $this->usersTable = $sm->get('Admin\Model\UsersTable');
    }
    return $this->usersTable;
}

	/**
	 * 
	 * get hire table for DI
	 * 
	 * */
	public function getHireTable()
   {
       if (!$this->hireTable) {
           $sm = $this->getServiceLocator();
           $this->hireTable = $sm->get('Admin\Model\Hires\Posts\HireTable');
       }
       return $this->hireTable;
   }

   

   
}






?>
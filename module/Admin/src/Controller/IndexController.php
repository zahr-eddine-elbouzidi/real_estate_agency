<?php
namespace Admin\Controller;


use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Authentication\Result;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Admin\Model\User;
use Admin\Model\UsersTable;
use Admin\Form\UserForm;
use Laminas\View\Model\JsonModel;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Mime\Message as MimeMessage; 
use Laminas\Mime\Part as MimePart;
use Laminas\Hydrator;

class IndexController extends AbstractRestfulController
{
    /**
     * default property
     */
	private $usersTable;	
    private $hydrator;

      // Add this constructor:
      public function __construct(UsersTable $usersTable)
      {
          $this->usersTable = $usersTable;
          $this->hydrator  = new Hydrator\ArraySerializableHydrator();

          if(!ini_get('date.timezone') )
          {
            date_default_timezone_set('GMT');
          }
      }

 
 

 
	/**
	*
	*	la suppression d'un utilisateur
	* 	
	**/
    public function deleteAction()
     {
  
            $id = (int) $this->params()->fromRoute('id', 0);
            $this->usersTable->deleteUser($id);
            return true;
      }

    public function getUserAction()
    {
        $user_id = $this->params()->fromRoute('id', 0);  
        
        $user =$this->usersTable->getUser($user_id); 
        return new JsonModel(['data' => $this->hydrator->extract($user)]);
    }


	public function getAlllAction()
	{
		  $created_by = $this->params()->fromRoute('id', 0);  

	      $users = $this->usersTable->fetchAllByCreatedBy($created_by);
	        return new JsonModel(array(
	            'data' => $users)
	        );
	}

	public function getAllAction()
	{
		  $created_by = $this->params()->fromRoute('id', 0);  

	      $users = $this->usersTable->fetchAll($created_by);

	        return new JsonModel(array(
	            'data' => $users)
	        );
	}


 	
	 public function logAction()
    {

                $isRedirectTo = false;

                //$config = $this->getServiceLocator()->get('Config');

                $staticSalt = 'aFGQ475SDsdfsaf2342';

                $messages = null;

                $data = json_decode(file_get_contents("php://input"));

                $userObject = $this->usersTable->getUserByEmail($data->usr_email);
 				
     			/*$passHash = null;

                if($userObject){
        
                
                 $passHash =  md5(($staticSalt."rH".$userObject->prenom."".$userObject->usr_question."@!".$userObject->usr_password_salt));

             		if($userObject->usr_email == $data->usr_email && $userObject->usr_password ==$passHash  && $userObject->usr_active == false){

                   		$isRedirectTo = true;
                	}
                }
              
                if(md5($staticSalt.$data->usr_password.$userObject->getUsr_password_salt()) == $userObject->getPassword()){
                    echo 1;
                }else{
                    echo 0;
                }*/

               /* $hash_password =  password_hash($staticSalt."zahr123" , PASSWORD_BCRYPT ,array('cost' => 11));
                var_dump($hash_password);
                if (password_verify($data->usr_password, $userObject->getPassword())) {
                    var_dump("ok");
                }else{
                    var_dump("incorrect !");
                }

                die();*/

                

              //  if($isRedirectTo == false){

                $config = [
                    "driver" => "Pdo_Mysql",
                    "database" => "iew",
                    "username" => "zahr",
                    "password" => ""
                ];

                $dbAdapter = new DbAdapter($config);

               

                $data->usr_email = str_replace("+", "", $data->usr_email);

				 $data->usr_email = trim($data->usr_email);

       
                //var_dump($authAdapter);
                //die();
                $user = $this->identity();
              
     
                
                $authAdapter = new AuthAdapter($dbAdapter,
                                           'users', // there is a method setTableName to do the same
                                           'usr_email', // there is a method setIdentityColumn to do the same
                                           'usr_password', // there is a method setCredentialColumn to do the same
                                           "MD5(CONCAT('$staticSalt', ?, usr_password_salt)) AND usr_active = 1" // setCredentialTreatment(parametrized string) 'MD5(?)'
                                          );

               

                
              $authAdapter->setIdentity($data->usr_email)->setCredential($data->usr_password);

               $auth = new AuthenticationService();

               $result = $auth->authenticate($authAdapter);            
             
                $drapeau = 0;

                switch ($result->getCode()) {

                    case Result::FAILURE_IDENTITY_NOT_FOUND:

                        $drapeau=-1;
                      
                        // do stuff for nonexistent identity
                        break;

                    case Result::FAILURE_CREDENTIAL_INVALID:
                    
                        $drapeau=-2;

                        break;

                    case Result::SUCCESS:

                        $drapeau=1;

                        //return $this->redirect()->toRoute('categorie', array( 'action' => 'index'));
                        break;
                    default:

                        $drapeau=0;
                        // do stuff for other failure
                        break;
                }    

                   $isConnected = false;
                   $user = null;
                   $user_id = null;
                   $user_token = null;
                   $usr_active = null;
                   $user_admin = null;
                   $user_fullname = null;
                   $usr_answer = null;
                   $type = null;


                    if($this->usersTable->getUserByEmail($data->usr_email)){
                        
                        $userLocal = $this->usersTable->getUserByEmail($data->usr_email);


                        $user_id =$userLocal->getId();
                        $user_token =$userLocal->getUsr_registration_token();
                        $usr_active = $userLocal->getUsr_active();
                        $user_admin = $userLocal->getUsr_isSuper();
                        $user_fullname = $userLocal->getFirstname(). " ".$userLocal->getLastname();
                        $usr_answer = $userLocal->getUsr_answer();
                        $type = $userLocal->getType();
                        if($usr_active == 0){
                            $messages = "Veuillez activer votre compte.";
                        }
                        
                    }



                    if($drapeau == 1){

                         $isConnected = true;
                         $messages= "Bienvenu.";

             
                         if ($auth->hasIdentity()) {
                             $user = $auth->getIdentity();
                         }   


                     

                          $session = new \Zend\Session\Container('token');
                          $session->offsetSet('token', $user_token.$staticSalt);

                          /*
                          $cookie = new \Zend\Http\Header\SetCookie();
                          $cookie->setName('foo')
                              ->setValue($user_token.$staticSalt)
                              ->setDomain('localhost')
                              ->setPath('/')
                              ->setHttponly(true);

                          /** @var \Zend\Http\Response $response 
                          $response = $this->getResponse();
                          $response->getHeaders()->addHeader($cookie);*/
                     

                       
                       // $time = 1209600;

                        //var_dump($_SESSION);
                        //die();
              

                       // if ($data->rememberme) {
                       //     $sessionManager = new \Zend\Session\SessionManager();
                       //     $sessionManager->rememberMe($time);
                        //}

                }elseif($drapeau == -1){
                    $isConnected = false;
                    $messages= "L'utilisateur avec l'identité fournie n'a pu être trouvée";

                }elseif($drapeau == -2){
                    $isConnected = false;
                    $messages= "L'utilisateur avec le mot de passe fournie est invalide .";

                }else{
                    $isConnected = false;
                    $messages= "Aucun information";

                }

            
         

             

             return new JsonModel(
                array(
                  'isConnected' => $isConnected,
                  'messages'    => $messages,
                  'user'        => $user,
                  'user_id'     => $user_id,
                  'user_token'  => $user_token,
                  'staticSalt'  =>$staticSalt,
                  'usr_active'  => $usr_active,
                  'user_admin'  => $user_admin,
                  'user_fullname' => $user_fullname,
                  'usr_answer'  => $usr_answer,
                  'type'        => $type
                  )
              ); 
           //   return $messages;
               /* }else{
                    return new JsonModel(
                              array(
                                'usr_email' => $userObject->usr_email,
                                'isRedirectTo'    => $isRedirectTo,
                          
                                )
                            ); 
                }*/


    }

 
	
	public function logoutAction()
	{
	 $auth = new AuthenticationService();

		
		if ($auth->hasIdentity()) {

		    $session = new \Zend\Session\Container('token');
 			$session->offsetUnset('token');
                           
			 $auth->clearIdentity();
			
			 $usersessin = new \Zend\Session\Container('token');
             $usersessin->item = null;
 			 //$auth->getStorage()->session->getManager()->forgetMe(); // no way to get the sessionmanager from storage
         //session_destroy();
        	  return new JsonModel(
                array(
                  'drap' => true
                  
                  )
              ); 
		}			
	}	
}
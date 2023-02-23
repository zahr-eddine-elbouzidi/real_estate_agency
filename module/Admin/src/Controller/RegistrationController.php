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
use Admin\Model\User;
use Admin\Model\Modulesappuser;
use Admin\Form\RegistrationForm;
use Admin\Form\UsersForm;
use Admin\Model\UsersTable;
use Admin\Form\RegistrationFilter;
use Admin\Form\ForgottenPasswordForm;
use Admin\Form\ForgottenPasswordFilter;
use CsnBase\Laminas\Validator\ConfirmPassword;
use Laminas\Mail\Message;
use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Mime\Part as MimePart;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\Session as SessionStorage;
use Laminas\Db\Adapter\Adapter as DbAdapter;
use Laminas\Authentication\Adapter\DbTable as AuthAdapter;
use Admin\Model\Slug;
use Laminas\Hydrator;


/**
*
* RegistrationController class
*
**/
class RegistrationController extends AbstractRestfulController
{
	/**
	* usersTable 
	**/
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
	 



  public function getUserAction(){

      $usr_name = $this->params()->fromRoute('id', 0);
 	  
  	  $sessionManager = new \Laminas\Session\SessionManager();          
      $sessionManager->start();
      $auth = new AuthenticationService();
      $session = new \Laminas\Session\Container('token');
      if ($auth->hasIdentity() && $session->offsetExists('token')) {
        if($usr_name != $session->offsetGet('token')){
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


  	


  	$staticSalt = "aFGQ475SDsdfsaf2342";
  	$usr_name = substr( $usr_name, 0, strlen($usr_name)-strlen($staticSalt));
  	$user =$this->usersTable->getUserByToken($usr_name);
  	if($user){
  		return new JsonModel(

  			array(
  				
  				'usr_id' => $user->getId(),
  				'usr_name' => $user->getUsername(),
  				'usr_email' => $user->getEmail(),
  				'usr_nom' => $user->getFirstname(),
  				'usr_prenom' => $user->getLastname(),
  				'usr_picture' => $user->getUsr_picture(),
  				'usr_country' => $user->getUsr_country(),
  				'usr_city' => $user->getUsr_city(),
  				'usr_isSuper' => $user->getUsr_isSuper(),
  				'nom' => $user->getFirstname(),
  				'prenom' => $user->getLastname(),
  				'user_fullname' => ($user->getFirstname(). " ".$user->getLastname()),
  				'type' =>  $user->getType()

  			));
  	}else{
  		return new JsonModel(
  			
  		);
  	}

  }


  public function addRoleAction(){

	 $usr_id = (int) $this->params()->fromRoute('id', 0);
	 $data = json_decode(file_get_contents("php://input"));		  	
	 $user =$this->usersTable->getUser($usr_id);
	 if(isset($data->type)){

		 $role = $this->usersTable->getRoleById($data->type);


		 $role = current($role);

	 
		 if($data->checked == true){
			 if(isset($role)){
				 $this->usersTable->addRole($user->getId() , $role['id_rule']);
			 }	
		 }else{
			 $this->usersTable->deleteRole($user->getId() , $role['id_rule']);
		 }
							 
	 }
	 return true;
}


  public function getUserByIdAction(){

      $id = $this->params()->fromRoute('id', 0);
 	   
      $user =$this->usersTable->getUser($id);
 
  	if($user){
  		return new JsonModel(

  			[
  				'usr_id' => $user->getId(),
  				'usr_name' => $user->getUsername(),
  				'usr_email' => $user->getEmail(),
  				'usr_nom' => $user->getFirstname(),
  				'usr_prenom' => $user->getLastname(),
  				'usr_picture' => $user->getUsr_picture(),
  				'usr_country' => $user->getUsr_country(),
  				'usr_city' => $user->getUsr_city(),
  				'usr_isSuper' => $user->getUsr_isSuper(),
  				'nom' => $user->getFirstname(),
  				'prenom' => $user->getLastname(),
  				'user_fullname' => ($user->getFirstname(). " ".$user->getLastname()),
  				'type' =>  $user->getType()

			  ]);
  	}else{
  		return new JsonModel(
  			
  		);
  	}

  }


  public function getRolesAction()
  {

	

    $roles = $this->usersTable->getRoles();
	 
	$data = array();
	foreach ($roles as $result) {
		$data[] = $result;
	}

	return new JsonModel(['data' =>  $data]
	);
   
   }


  public function getUserRoleAction(){

		  $usr_name = $this->params()->fromRoute('id', 0);


		  $staticSalt = "aFGQ475SDsdfsaf2342";
		  $usr_name = substr( $usr_name, 0, strlen($usr_name)-strlen($staticSalt));
		  $user =$this->usersTable->getUserByToken($usr_name);
		  $roles = $this->usersTable->getRoleD1User($user->getId());
		 // var_dump($roles);
		 // die();
		  if($user){
		  	 return new JsonModel(


				[
					'usr_id' => $user->getId(),
					'usr_name' => $user->getUsername(),
					'usr_email' => $user->getEmail(),
					'usr_nom' => $user->getFirstname(),
					'usr_prenom' => $user->getLastname(),
					'usr_picture' => $user->getUsr_picture(),
					'usr_country' => $user->getUsr_country(),
					'usr_city' => $user->getUsr_city(),
					'usr_isSuper' => $user->getUsr_isSuper(),
					'nom' => $user->getFirstname(),
					'prenom' => $user->getLastname(),
					'user_fullname' => ($user->getFirstname(). " ".$user->getLastname()),
					'type' =>  $user->getType(),
					'roles' => $roles
  
				]


			 );
		  	}else{
		  		return new JsonModel(
		  			
			    );
		  	}

	}


	 public function getDroitsUserAction(){

		  $id = $this->params()->fromRoute('id', 0);


		  
		  $user =$this->usersTable->getUser($id);
		  $roles = $this->usersTable->getRoleD1User($user->getId());
		 // var_dump($roles);
		 // die();
		  if($user){
		  	 return new JsonModel(

				[
					'usr_id' => $user->getId(),
					'usr_name' => $user->getUsername(),
					'usr_email' => $user->getEmail(),
					'usr_nom' => $user->getFirstname(),
					'usr_prenom' => $user->getLastname(),
					'usr_picture' => $user->getUsr_picture(),
					'usr_country' => $user->getUsr_country(),
					'usr_city' => $user->getUsr_city(),
					'usr_isSuper' => $user->getUsr_isSuper(),
					'nom' => $user->getFirstname(),
					'prenom' => $user->getLastname(),
					'user_fullname' => ($user->getFirstname(). " ".$user->getLastname()),
					'type' =>  $user->getType(),
					'roles' => $roles
  
				]);
		  	}else{
		  		return new JsonModel(
		  			
			    );
		  	}

	}


	public function generateDynamicCode()
	{
		$dynamicCode= mt_rand(10000, 99999);
		
		return $dynamicCode;
	}

 
	/**
	 * [generateMsgConfirmation description]
	 * @return [type] [description]
	 */
	public function generateMsgConfirmation()
	{
		$gereratedCode=$this->generateDynamicCode(); // Generate confirmation code.

		$messageAPP = '<div style="border-radius:2px;box-shadow: 5px 10px">
        
        <table cellspacing="0" cellpadding="0" border="0">
        
        <tbody>
 
            <tr>
                <td style="padding:15px; background:#fff; border-radius:0 0 4px 4px;font-size:12px">
                    Bonjour,<br>
                    Votre code de confirmation est le suivant : <b>'.$gereratedCode.',</b> <br>
                    </b>Veuillez activer votre compte.</b>.<br><br>
                    Direction des ressources humaines, <br>
                    Département de l\'enseignement supérieur, <br>
                    DRH-ENSSUP.<br><br>
                    <div style="border-top:3px solid #eee;color:#999;font-size:11px;line-height:1.2">
                        <br>Développé par <a href="https://econcours.enssup.gov.ma" target="_blank" style="color: #005399;text-decoration: none;">DRH-ENSSUP</a>. Tout droits reservés.<br>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
        </div>';
		return array('messageAPP' => $messageAPP , 'gereratedCode' => $gereratedCode);
	}


	/**
	 * [sendMailing description]
	 * @param  [type] $to   [description]
	 * @param  [type] $body [description]
	 * @return [type]       [description]
	 */
	public function sendMailing($to = null , $body = null){

		set_time_limit(0);
		$hasError = false;

		$sm = $this->getServiceLocator();
		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		$config = $this->getServiceLocator()->get('Config');
		$mailConfig = $config['mail'];

		try{

			$html = new MimePart( $body);
			$html->type = "text/html";
			$body = new MimeMessage($body);
			$body->addPart($html);
			$message = new Message();
			$message->addTo($to)
			->addFrom($mailConfig['transport']['options']['connection_config']['username'])
			->setSubject("Code de confirmation au Plateforme E-Concours")
			->setBody($body);
				// Setup SMTP transport using LOGIN authentication
			$transport = new SmtpTransport();
			$options   = new SmtpOptions($mailConfig['transport']['options']);
			$transport->setOptions($options);
			$transport->send($message);
			$hasError = true;


		}catch(Exception $e){
			$hasError = false;
		}


		return $hasError;
	}
	

	public function generateDynamicSalt()
	{
		$dynamicSalt = '';
		for ($i = 0; $i < 50; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		}
		return $dynamicSalt;
	}

	public function encriptPassword($staticSalt, $password, $dynamicSalt)
	{
		return $password = md5($staticSalt . $password . $dynamicSalt);
	}

	public function editUserAction()
	{
		$data = json_decode(file_get_contents("php://input"));
   
		$auth = $this->usersTable->getUser($data->usr_id);
    
		
	  $auth->setUsername((isset($data->usr_email) && $data->usr_email != $auth->getEmail()) ? $data->usr_email :  $auth->getEmail());
	  $auth->setEmail((isset($data->usr_email) && $data->usr_email != $auth->getEmail()) ? $data->usr_email :  $auth->getEmail()); 
	  $auth->setFirstname((isset($data->first_name) && $data->first_name != $auth->getFirstname()) ? $data->first_name :  $auth->getFirstname());
	  $auth->setLastname((isset($data->first_name) && $data->first_name != $auth->getFirstname()) ? $data->first_name :  $auth->getFirstname());
	  $auth->setType((isset($data->type) && $data->type != $auth->getType()) ? $data->type :  $auth->getType());
	   //code 
	  $auth->setUsr_question($auth->getUsr_question());
	  $auth->setUsr_active($auth->getUsr_active());
  	  $auth->setUsr_registration_token(md5(uniqid(mt_rand(), true)));
	  $auth->setUsr_password_salt($this->generateDynamicSalt());	
   
	  $password = (isset($data->usr_password) && $data->usr_password != null ) ? $data->usr_password :  null;	
	  
	  if($password != null){

		  $auth->setPassword($this->encriptPassword(
			  Slug::getConfigSalt()['static_salt'], 
			  $data->usr_password, 
			  $auth->getUsr_password_salt()
		  ));
	  }			
		 $this->usersTable->saveEditUser($auth);
  
   
   
		return new JsonModel(
  
			array(
				
				'drap' => true
				 
  
			));
	}

	/**
	 * activate account 
	 */
	public function activercompteAction()
	{

		$data = json_decode(file_get_contents("php://input"));
		$usr_active = null;
		$usr_email_confirmed = null;
		$message =null;
		$Error_message =null;

		if($this->usersTable->getUser($data->user_id)){

			
			if($data->value == 0){

				$this->usersTable->DesactivateUser($data->user_id);

			}else{

				$this->usersTable->activateUser($data->user_id);
				
			}
			

				//get user 
			$user = $this->usersTable->getUser($data->user_id);
			$usr_active= $user->getUsr_active();
			$usr_email_confirmed= $user->getUsr_email_confirmed();

			if($usr_active==1 && $usr_email_confirmed == 1){
				$message="Merci , Votre compte est actif. ";
			}else{
				$Error_message="Désolé, votre compte n'a pas été activé. ";
			}
			

			
		}else{
			$Error_message="Utilisateur n'existe pas.";
		}


		return new JsonModel(
			array(
				'usr_email_confirmed' => $usr_email_confirmed,
				'message' => $message,
				'Error_message' => $Error_message,
				'usr_active'				=> $usr_active
			)
		); 
	}
  

	public function saveAction()
	{
			$usr_email_confirmed = null;
			$message_user_exists=null;
			$usr_identity = null;
			$token=null;
			$messageSMS = "";
			$data = json_decode(file_get_contents("php://input"));
			$data->usr_email = str_replace("+", "", $data->usr_email);
			$data->usr_email = trim($data->usr_email);
	 
		$gereratedCode=$this->generateDynamicCode(); // Generate confirmation code.
		
		
		if($this->usersTable->getUserByEmail($data->usr_email)){

			$message_user_exists = "Utilisateur exists déjà";
			
		}else{

				/**
				*	BEGIN
				**/
				$auth = new User();
				
				$auth->setUsername($data->usr_email);
				$auth->setEmail($data->usr_email);
				$auth->setFirstname($data->first_name);
				$auth->setLastname($data->last_name);
				$auth->setType($data->usr_type);

				$staticSalt = "aFGQ475SDsdfsaf2342";
				$created_by = substr( $data->created_by, 0, strlen($data->created_by)-strlen($staticSalt));
				$userToken =$this->usersTable->getUserByToken($created_by);


				$auth->setCreated_by($userToken->getEmail());
					//code 
				$auth->setUsr_question("NONE");
				$auth->setUsr_answer("NONE");
				$usersTable = $this->usersTable;
				$allusers=$usersTable->fetchAll();

				$auth->setUsr_active(0);
				$auth->setUsr_password_salt($this->generateDynamicSalt());				
				$auth->setPassword($this->encriptPassword(
					Slug::getConfigSalt()['static_salt'], 
					$data->usr_password, 
					$auth->getUsr_password_salt()
				));
				if($usersTable->Nombre_d_enregistrement()==0){

					$auth->setUsrl_id(1);
				}else{
					
					$auth->setUsrl_id(0);

				}
			
				$auth->setLng_id(1);
				$date = new \DateTime();
				$auth->setUsr_registration_date($date->format('Y-m-d H:i:s'));
				$auth->setUsr_registration_token(md5(uniqid(mt_rand(), true))); // $this->generateDynamicSalt();
				$auth->setUsr_email_confirmed(1);
				$auth->setUsr_isSuper(1);
				

 			 
				
 				
				 
				
				$lastInsertValue = $this->usersTable->saveUser($auth);
			 

				$usr_email_confirmed= $auth->getUsr_email_confirmed();
				$token= $auth->getUsr_registration_token();
				$user = $this->usersTable->getUserByToken($token);
				$usr_identity = $user->getId();
				
			}
			
			return new JsonModel(
				array(
					'message_user_exists' => $message_user_exists
					
				)
			); 
		}
 
}
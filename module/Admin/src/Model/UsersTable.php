<?php
namespace Admin\Model;


use Laminas\Db\TableGateway\TableGateway;
use Admin\Model\Slug;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Adapter\Driver\ResultInterface;


class UsersTable
{
    protected $tableGateway;
    private   $driver;
    private   $connection;
  
  

  public function __construct(TableGateway $tableGateway)
  {
   $this->tableGateway = $tableGateway;
   $this->driver=$this->tableGateway->getAdapter()->driver;
   $this->connection=$this->driver->getConnection();
   
 }


     
    
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet->toArray();
    }
      public function fetchAllByCreatedBy($created_by)
    {
        $resultSet = $this->tableGateway->select(array('created_by' => $created_by));
        return $resultSet->toArray();
    }


    public function getLastUsers()
    {
        return count( $this -> fetchAll($this->tableGateway->select()));
    }
 
 
    public function getUser($usr_id)
    {
        $usr_id  = (int) $usr_id;
        $rowset = $this->tableGateway->select(array('usr_id' => $usr_id));
        $row = $rowset->current();
 
        if (!$row) {
            //throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getUserByFirstName($first_name)
    {
        $rowset = $this->tableGateway->select(array('first_name' => $first_name));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $id");
        }
        return $row;
    }


    public function getUserByToken($token)
    {
        $rowset = $this->tableGateway->select(array('usr_registration_token' => $token));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }

     public function getUserByCode($code,$user_id)
    {
        $rowset = $this->tableGateway->select(array('usr_question' => $code , 'usr_id' => $user_id));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }

  public function getUserByCodePw($code,$user_id)
    {
        $rowset = $this->tableGateway->select(array('usr_answer' => $code , 'usr_id' => $user_id));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }
    
    public function activateUser($usr_id)
    {
        $data['usr_active'] = 1;
        $data['usr_email_confirmed'] = 1;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    }   

    public function activateUserComplet($usr_id , $confirmation_code)
    {
        $data['usr_active'] = 1;
        $data['usr_email_confirmed'] = 1;
        $data['usr_answer'] = $confirmation_code;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    }

     public function DesactivateUser($usr_id)
    {
        $data['usr_active'] = 0;
        $data['usr_email_confirmed'] = 1;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    }   

     public function initializeEmail($usr_id , $usr_email)
    {
        $data['usr_email'] = $usr_email;
        $data['usr_name'] = $usr_email;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    }   

     public function initializeCodePassword($usr_id,$code)
    {
        $data['usr_answer'] = $code;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    } 


    public function getUserByEmail($usr_email)
    {
        $rowset = $this->tableGateway->select(array('usr_email' => $usr_email));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $usr_email");
        }
        return $row;
    }

    public function getUserByCIN($cin)
    {
        $rowset = $this->tableGateway->select(array('cin' => $cin));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $usr_email");
        }
        return $row;
    }

     public function getUserByName($usr_name)
    {
        $rowset = $this->tableGateway->select(array('usr_name' => $usr_name));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $usr_email");
        }
        return $row;
    }

    public function getUserById($usr_id)
    {
        $rowset = $this->tableGateway->select(array('usr_id' => $usr_id));
        $row = $rowset->current();
        if (!$row) {
        }
        return $row;
    }

    public function getUserByNom_complet($nom_complet)
    {
        $rowset = $this->tableGateway->select(array('nom' => $nom_complet));
        $row = $rowset->current();
        if (!$row) {
        }
        return $row;
    }


    public function getRoles(){
        $SQL = "SELECT * FROM role;";

        $result = $this->driver->getConnection()->execute(
            $SQL
        );

        $data = [];
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result); 
            foreach($resultSet as $r){
            $data[] = $r;
            }
        }
        return $data;
    }

    public function getRoleD1User($usr_id)
    {
        $SQL ="select users.usr_email,role.*,role_user.* 
               from users,role,role_user where users.usr_id = role_user.user_id 
               and role.id_rule  = role_user.rule_id 
               and users.usr_id=:usr_id";
       
        $data = array('usr_id' => $usr_id);
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);

   
           if($result instanceof ResultInterface && $result->isQueryResult()){
               $resultSet = new resultSet();
               $resultSet->initialize($result);
             }

             $table  = array();

             foreach($resultSet as $value){

               $table[] = $value;
             }
        

        return $table;
    }


    public function getUserRole($usr_id , $rule_id)
    {
        $SQL ="select users.*,role.*,role_user.*
               from users,role,role_user 
               where users.usr_id = role_user.user_id 
               and role.id = role_user.rule_id 
               and users.usr_id=:usr_id
               and role.id_rule =:rule_id";
       
        $data = array('usr_id' => $usr_id , 'rule_id' => $rule_id);
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);

   
           if($result instanceof ResultInterface && $result->isQueryResult()){
               $resultSet = new resultSet();
               $resultSet->initialize($result);
             }

             $table  = array();

             foreach($resultSet as $value){

               $table[] = $value;
             }
        

        return $table;
    }


    public function getRoleById($rule_code)
    {
        $SQL ="SELECT * FROM role WHERE rule_code=:rule_code;";
       
        $data = array('rule_code' => $rule_code);
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);

   
           if($result instanceof ResultInterface && $result->isQueryResult()){
               $resultSet = new resultSet();
               $resultSet->initialize($result);
             }

             $table  = array();

             foreach($resultSet as $value){

               $table[] = $value;
             }
        

        return $table;
    }


    public function addRole($user_id , $rule_id)
    {

        $SQL = "INSERT INTO `role_user` (`id_user_role`, `user_id`, `rule_id`, `created_at`) 
        VALUES (NULL, ".$user_id." , ".$rule_id." , CURRENT_TIMESTAMP);";

         $this->tableGateway->getAdapter()->driver->getConnection()->execute(

               $SQL

           );

 

    }


    public function deleteRole($user_id , $id_role)
    {

        $SQL = "DELETE FROM `role_user` WHERE user_id = ".$user_id."  AND rule_id =".$id_role.";";

         $this->tableGateway->getAdapter()->driver->getConnection()->execute(

               $SQL

           );



    }


     
      public function setAffectation($type , $usr_id){

        $usr_id= (int) $usr_id;
        $data['type'] = $type;
        $this->tableGateway->update($data, array('usr_id' => $usr_id));

      }    

    public function changePassword($usr_id, $password)
    {
        $data['password'] = $password;
        $this->tableGateway->update($data, array('usr_id' => (int)$usr_id));
    }

     public function saveEditUser(User $auth)
    {
        // for Zend\Db\TableGateway\TableGateway we need the data in array not object
        $data = array(
            'usr_name'              => $auth->getUsername(),
            'usr_email'             => $auth->getEmail(),
            'first_name'            => $auth->getFirstname(),
            'last_name'             => $auth->getLastname(),
            'usr_picture'           => $auth->getUsr_picture(),
            'usr_country'           => $auth->getUsr_country(),
            'usr_city'              => $auth->getUsr_city()
        );
        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $auth->getArrayCopy();
        $usr_id = (int)$auth->getId();
        if ($usr_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($usr_id)) {
                $this->tableGateway->update($data, array('usr_id' => $usr_id));
            } else {
               // throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function saveUser(User $auth)
    {
        // for Zend\Db\TableGateway\TableGateway we need the data in array not object
        $data = array(
            'usr_name'              => $auth->getUsername(),
            'usr_password'          => $auth->getPassword(),
            'usr_email'             => $auth->getEmail(),
            'usrl_id'               => $auth->getUsrl_id(),
            'first_name'            => $auth->getFirstname(),
            'last_name'             => $auth->getLastname(),
            'lng_id'                => $auth->getLng_id(),
            'usr_active'            => $auth->getUsr_active(),
            'usr_question'          => $auth->getUsr_question(),
            'usr_answer'            => $auth->getUsr_answer(),
            'usr_picture'           => $auth->getUsr_picture(),
            'usr_password_salt'     => $auth->getUsr_password_salt(),
            'usr_registration_date' => $auth->getUsr_registration_date(),
            'usr_registration_token'=> $auth->getUsr_registration_token(),
            'usr_email_confirmed'   => $auth->getUsr_email_confirmed(),
            'usr_country'           => $auth->getUsr_country(),
            'usr_city'              => $auth->getUsr_city(),
            'created_by'            => $auth->getCreated_by(),
            'type'                  => $auth->getType(),
            'usr_isSuper'           => $auth->getUsr_isSuper()
        );
        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $auth->getArrayCopy();
        $usr_id = (int)$auth->getId();
        if ($usr_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($usr_id)) {
                $this->tableGateway->update($data, array('usr_id' => $usr_id));
            } else {
               // throw new \Exception('Form id does not exist');
            }
        }

        return $this->tableGateway->lastInsertValue;
    }
    
    public function deleteUser($id)
    {
        $this->tableGateway->delete(array('usr_id' => $id));
    }   

    function Nombre_d_enregistrement()
    {
        return count( $this -> fetchAll($this->tableGateway->select()));
    }
}
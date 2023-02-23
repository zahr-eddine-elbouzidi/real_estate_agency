<?php
/**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Model;

use Laminas\Db\TableGateway\TableGateway;
use Admin\Model\Slug;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;


class ContactTable  
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
    $rowset = $this->tableGateway->select();
    $row = $rowset->current();
    if (!$row) {
            //throw new \Exception("Could not find row $token");
    }
    return $row;
}


public function getSizeOfContact()
{
    $rowset = $this->tableGateway->select();
    return $rowset->count();
}







public function getContactByName($name)
{
    $rowset = $this->tableGateway->select(array('name' => $name));
    $row = $rowset->current();
    if (!$row) {
            //throw new \Exception("Could not find row $token");
    }
    return $row;
}






public function getContact($id)
{
   $rowset = $this->tableGateway->select(array('id_contact' => $id));
   $row = $rowset->current();
   if (!$row) {
             //throw new \Exception("Could not find row ");
   }
   return $row;
}

     /**
      * la creation d'une 
      * @param Categorie $categorie
      * @throws \Exception
      */
     public function saveContact(Contact $contact)
     {

       

                    // for Zend\Db\TableGateway\TableGateway we need the data in array not object
       $data = array(
           'name'              => $contact->getName(),
           'tel'               => $contact->getTel(),
           'gsm'               => $contact->getGsm(),
           'email'             => $contact->getEmail(),
           'address'           => $contact->getAddress(),
           'website'           => $contact->getWebsite(),
           'facebook_url'      => $contact->getFacebook_url(),
           'instagram_url'     => $contact->getInstagram_url(),
           'linkedin_url'      => $contact->getLinkedin_url(),
           'tiktok_url'        => $contact->getTiktok_url(),
           'created_by'        => $contact->getCreated_by()
           
           
       );
       
       
         // If there is a method getArrayCopy() defined in Auth you can simply call it.
         // $data = $categorie->getArrayCopy();
       
       $id_contact = (int)$contact->getId_contact();
       
     	//var_dump($id_contact);
     	//die();
       
       if ($id_contact == 0) {

        $this->tableGateway->insert($data);

    } else {


       if ($this->getContact($id_contact)) {

           $this->tableGateway->update($data, array('id_contact' => $id_contact));

       } else {

        throw new \Exception('Form id does not exist');

    }
}

}
      /**
     *  @param $id
     *  pas de valeur retourner  
     **/
      public function deleteContact($id)
      {
       $this->tableGateway->delete(array('id_contact' => $id));
   }

   
}

?>
<?php
/**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Model;

use Laminas\Db\TableGateway\TableGateway;
 use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;


class CandidatTable  
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







public function getCandidatByFullname($name)
{
    $rowset = $this->tableGateway->select(array('fullname' => $name));
    $row = $rowset->current();
    if (!$row) {
            //throw new \Exception("Could not find row $token");
    }
    return $row;
}






public function getCandidat($id)
{
   $rowset = $this->tableGateway->select(array('id_candidat' => $id));
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
     public function saveCandidat(Candidat $candidat , $geo_array , $search_engine ,$device_engine, $forward_link)
     {

       

        // for Zend\Db\TableGateway\TableGateway we need the data in array not object
       $data = array(
           'fullname'                  => $candidat->getFullname(),
           'tel'                       => $candidat->getTel(),
           'subject'                   => $candidat->getSubject(),
           'email'                     => $candidat->getEmail(),
           'message'                   => $candidat->getMessage(),
           'search_engine'             => $search_engine,
           'device_engine'             => $device_engine,
           'forward_link_engine'       => $forward_link,
           'country_engine'            => $geo_array->country,
           'country_code_engine'       => $geo_array->countryCode,
           'region_code_engine'        => $geo_array->region,
           'region_name_engine'        => $geo_array->regionName,
           'city_engine'               => $geo_array->city,
           'zip_engine'                => $geo_array->zip,
           'lat_engine'                => $geo_array->lat,
           'lon_engine'                => $geo_array->lon,
           'timezone_engine'           => $geo_array->timezone,
           'isp_modem_internet_engine' => $geo_array->isp,
           'org_modem_engine'          => $geo_array->org,
           'as_modem_engine'           => $geo_array->as,
           'ip_address_engine'         => $geo_array->query,
           'diplome_obtenu'            => $candidat->getDiplomeObtenu(),
           'niveau_etude'              => $candidat->getNiveauEtude(),
           'filiere'                   => $candidat->getFiliere(),
           'ville'                     => $candidat->getVille(),
           'pays_destination'          => $candidat->getPaysDestination(),
           'diplome_langue'            => $candidat->getDiplomeLangue(),
           'langue_etude'              => $candidat->getLangueEtude()

       );
    
         // If there is a method getArrayCopy() defined in Auth you can simply call it.
         // $data = $categorie->getArrayCopy();
       
       $id_candidat = (int)$candidat->getId_candidat();
       
     	//var_dump($id_candidat);
     	//die();
       
       if ($id_candidat == 0) {

        $this->tableGateway->insert($data);

    } else {


       if ($this->getCandidat($id_candidat)) {

           $this->tableGateway->update($data, array('id_candidat' => $id_candidat));

       } else {

        throw new \Exception('Form id does not exist');

    }
}

}
      /**
     *  @param $id
     *  pas de valeur retourner  
     **/
      public function deleteCandidat($id)
      {
       $this->tableGateway->delete(array('id_candidat' => $id));
   }

   
}

?>
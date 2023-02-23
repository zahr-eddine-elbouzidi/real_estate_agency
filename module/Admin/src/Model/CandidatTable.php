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
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Adapter\Driver\ResultInterface;

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
        $SQL = "SELECT * FROM candidat ORDER BY created_at DESC;";
        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
          $SQL
        );
      
        $results = new HydratingResultSet(
      
          new Hydrator\ArraySerializableHydrator(),
      
          new \Admin\Model\Candidat()
        );
        
        $results->initialize($result);
      
        return $results->toArray();
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
     public function saveCandidat(Candidat $candidat)
     {

       

        // for Zend\Db\TableGateway\TableGateway we need the data in array not object
       $data = array(
           'fullname'          => $candidat->getFullname(),
           'tel'               => $candidat->getTel(),
           'subject'           => $candidat->getSubject(),
           'email'             => $candidat->getEmail(),
           'message'           => $candidat->getMessage(),

           'cin_candidat' => $candidat->getCin_candidat(),
           'nom_candidat' => $candidat->getNom_candidat(),
           'prenom_candidat' => $candidat->getPrenom_candidat(),
           'date_naiss_candidat' => $candidat->getDate_naiss_candidat(),
           'lieu_naiss_candidat' => $candidat->getLieu_naiss_candidat(),
           'nationalite_candidat' => $candidat->getNationalite_candidat(),
           'sexe_candidat' => $candidat->getSexe_candidat(),
           'civilite_candidat' => $candidat->getCivilite_candidat(),
           'tel_candidat' => $candidat->getTel_candidat(),
           'adresse_candidat' => $candidat->getAdresse_candidat(),
           'ville_candidat' => $candidat->getVille_candidat(),
           'code_postal_candidat' => $candidat->getCode_postal_candidat(),
           'pays_candidat' => $candidat->getPays_candidat(),
           'email_candidat' => $candidat->getEmail_candidat(),
           'num_passport' => $candidat->getNum_passport(),
           'date_delivrance_passport' => $candidat->getDate_delivrance_passport(),
           'date_dexpiration_passport' => $candidat->getDate_dexpiration_passport(),
           'lieu_delivrance_passport' => $candidat->getLieu_delivrance_passport(),


           'diplome_obtenu' => $candidat->getDiplome_obtenu(),
           'option_diplome_candidat' => $candidat->getOption_diplome_candidat(),
           'annee_obtention_diplome_candidat' => $candidat->getAnnee_obtention_diplome_candidat(),
           'etab_delivre_diplome_candidat' => $candidat->getEtab_delivre_diplome_candidat(),
           'niveau_etude' => $candidat->getNiveau_etude(),
           'diplome_langue' => $candidat->getDiplome_langue(),
           'langue_etude' => $candidat->getLangue_etude(),


           'pays_demande' => $candidat->getPays_demande(),
           'ville_demande' => $candidat->getVille_demande(),
           'etablissement_demande' => $candidat->getEtablissement_demande(),
           'discipline_demande' => $candidat->getDiscipline_demande(),
           'specialite_demande' => $candidat->getSpecialite_demande(),
           'qualification_demande' => $candidat->getQualification_demande(),
           'langue_etude_demande' => $candidat->getLangue_etude_demande(),
           'niveau_linguistique_demande' => $candidat->getNiveau_linguistique_demande(),
           'langue_etude_demande' => $candidat->getLangue_etude_demande(),
           'diplome_langue_demande' => $candidat->getDiplome_langue_demande(),

      
           'type_pere' => $candidat->getType_pere(),
           'nom_pere' => $candidat->getNom_pere(),
           'prenom_pere' => $candidat->getPrenom_pere(),
           'date_naiss_pere' => $candidat->getDate_naiss_pere(),
           'nationalite_pere' => $candidat->getNationalite_pere(),
           'lieu_naiss_pere' => $candidat->getLieu_naiss_pere(),
           'cin_pere' => $candidat->getCin_pere(),
           'tel_pere' => $candidat->getTel_pere(),
           'code_postal_pere' => $candidat->getCode_postal_pere(),
           'adresse_pere' => $candidat->getAdresse_pere(),
           'ville_pere' => $candidat->getVille_pere(),
           'pays_pere' => $candidat->getPays_pere(),
           'email_pere' => $candidat->getEmail_pere(),
           'profession_pere' => $candidat->getProfession_pere(),


           'type_mere' => $candidat->getType_mere(),
           'nom_mere' => $candidat->getNom_mere(),
           'prenom_mere' => $candidat->getPrenom_mere(),
           'date_naiss_mere' => $candidat->getDate_naiss_mere(),
           'nationalite_mere' => $candidat->getNationalite_mere(),
           'lieu_naiss_mere' => $candidat->getLieu_naiss_mere(),
           'cin_mere' => $candidat->getCin_mere(),
           'tel_mere' => $candidat->getTel_mere(),
           'code_postal_mere' => $candidat->getCode_postal_mere(),
           'adresse_mere' => $candidat->getAdresse_mere(),
           'ville_mere' => $candidat->getVille_mere(),
           'pays_mere' => $candidat->getPays_mere(),
           'email_mere' => $candidat->getEmail_mere(),
           'profession_mere' => $candidat->getProfession_mere(),

            
           
           
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




   //Statistique query begin

       
  public function candidatsBymonth($annee){

        $SQL = "SELECT DISTINCT MONTH(candidat.created_at) as label,COUNT(candidat.id_candidat) as data 
              FROM candidat
              WHERE YEAR(candidat.created_at) = :annee
              GROUP  BY MONTH(candidat.created_at)";
        $data = array('annee' => $annee );
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);
        $dataMonths = array();

        if($result instanceof ResultInterface && $result->isQueryResult()){
            $resultSet = new resultSet();
            $resultSet->initialize($result);

 

            foreach($resultSet as $value){

              $arry = array();
              $arry[0] = $value->label;
              $arry[1] = $value->data;
              $dataMonths[] = $arry;

            } 
        }
 
        return $dataMonths;
  }

 public function candidatsInscrits($annee){
   $SQL = "SELECT DISTINCT  COUNT(candidat.id_candidat) as data 
              FROM candidat
              WHERE YEAR(candidat.created_at) = :annee ";
        $data = array('annee' => $annee );
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);
        $dataCandidats = array();

        if($result instanceof ResultInterface && $result->isQueryResult()){
            $resultSet = new resultSet();
            $resultSet->initialize($result); 

            foreach($resultSet as $value){

              $dataCandidats[] = $value->data;

            } 
        }
        $dataCandidats = current($dataCandidats);
        return $dataCandidats;

 }

 public function candidatsInscritsBySearchOrg($annee){

        $SQL = "SELECT candidat.search_engine as label , COUNT(*) as data 
                FROM `candidat` 
                WHERE candidat.search_engine IS NOT null 
                AND YEAR(candidat.created_at) = :annee 
                GROUP BY candidat.search_engine";

      $data = array('annee' => $annee );
      $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
      $stmt->prepare($SQL);
      $result = $stmt->execute($data);
      $dataCandidats = array();

      if($result instanceof ResultInterface && $result->isQueryResult()){
        $resultSet = new resultSet();
        $resultSet->initialize($result); 

      foreach($resultSet as $value){

         $dataCandidats[] = $value;

        } 
      }
       return $dataCandidats;
 }


 public function candidatsInscritsByDevice($annee){

      $SQL = "SELECT candidat.device_engine as label , COUNT(*) as data 
              FROM `candidat` 
              WHERE candidat.device_engine IS NOT null 
              AND YEAR(candidat.created_at) = :annee 
              GROUP BY candidat.device_engine";

    $data = array('annee' => $annee );
    $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
    $stmt->prepare($SQL);
    $result = $stmt->execute($data);
    $dataCandidats = array();

    if($result instanceof ResultInterface && $result->isQueryResult()){
      $resultSet = new resultSet();
      $resultSet->initialize($result); 

    foreach($resultSet as $value){

      $dataCandidats[] = $value;

      } 
    }
    return $dataCandidats;
}


public function candidatsInscritsByCountry($annee){
  $SQL = "SELECT candidat.country_engine as label , COUNT(*) as data 
              FROM `candidat` 
              WHERE candidat.country_engine IS NOT null 
              AND YEAR(candidat.created_at) = :annee 
              GROUP BY candidat.country_engine";

    $data = array('annee' => $annee );
    $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
    $stmt->prepare($SQL);
    $result = $stmt->execute($data);
    $dataCandidats = array();

    if($result instanceof ResultInterface && $result->isQueryResult()){
      $resultSet = new resultSet();
      $resultSet->initialize($result); 

    foreach($resultSet as $value){

      $dataCandidats[] = $value;

      } 
    }
    return $dataCandidats;
}



public function candidatsInscritsGlobal($annee){
  $SQL = "
  
      select candidat.search_engine as label, count(candidat.search_engine) as data
      from candidat
      where candidat.search_engine is not null 
      AND YEAR(candidat.created_at) = :annee 
      group by candidat.search_engine

      union all 

      select candidat.device_engine as label, count(candidat.device_engine) as data
      from candidat
      where candidat.device_engine is not null
      AND YEAR(candidat.created_at) = :annee 
      group by candidat.device_engine


      union all 

      select candidat.country_engine as label, count(candidat.country_engine) as data
      from candidat
      where candidat.country_engine is not null 
      AND YEAR(candidat.created_at) = :annee 
      group by candidat.country_engine


      union all 

      select candidat.city_engine as label, count(candidat.city_engine) as data
      from candidat
      where candidat.city_engine is not null 
      AND YEAR(candidat.created_at) = :annee 
      group by candidat.city_engine

      union all 

      select CONCAT('BackLink : ',candidat.forward_link_engine) as label, count(candidat.forward_link_engine) as data
      from candidat
      where candidat.forward_link_engine is not null 
      AND YEAR(candidat.created_at) = :annee 
      group by candidat.forward_link_engine
  
    ";

    $data = array('annee' => $annee );
    $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
    $stmt->prepare($SQL);
    $result = $stmt->execute($data);
    $dataCandidats = array();

    if($result instanceof ResultInterface && $result->isQueryResult()){
      $resultSet = new resultSet();
      $resultSet->initialize($result); 

    foreach($resultSet as $value){

      $dataCandidats[] = $value;

      } 
    }
    return $dataCandidats;
}

   //Statistique query end

   
}

?>
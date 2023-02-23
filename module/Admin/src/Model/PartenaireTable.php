<?php
namespace Admin\Model;

use Laminas\Db\TableGateway\TableGateway;
use Admin\Model\Slug;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;

class PartenaireTable
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

   
    /**
     * 
     * get all records from  partenaires table
     *  */   
    public function fetchAll()
    {
        $SQL = "SELECT * FROM partenaires ORDER BY created_at asc;";
        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
          $SQL
        );
      
        $results = new HydratingResultSet(
      
          new Hydrator\ArraySerializableHydrator(),
      
          new \Admin\Model\Partenaire()
        );
        
        $results->initialize($result);
      
        return $results->toArray();
    }
    
    /**
     * get record by name
     * @param $etablssement_name 
     */
    public function getRecordByName($etablissement_name)
    {
       $rowset =$this->tableGateway->select(array('etablissement'=>$etablissement_name));
       $row = $rowset->current();
       if(!$row){
           return false;
       }
      return true;
    }


    public function getElementByName($name_fr)
    {
        $SQL = "SELECT * FROM partenaires WHERE etablissement = BINARY :name_fr ";
        /*$result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
          $SQL
        );*/

        $data = array('name_fr' => $name_fr);
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($data);
      
        $data = array();
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
          $resultSet = new ResultSet;
          $resultSet->initialize($result);
          foreach($resultSet as $value){
              $data[] = $value;
          }
        }
        return  sizeof($data);
    }

    /**
     * get category by id
     */
    public function getPartenaire($id)
    {
       $id = (int)  $id;
       $rowset =$this->tableGateway->select(array('id_partenaire'=>$id));
       $row = $rowset->current();
       if(!$row){
           throw new \Exception("could not find partenaire $id");
       }
      return $row;
    }
    
    public function savePartenaire(Partenaire $partenaire)
    {
        //extraire les donn�es de mon objet Todo dans le tableau $data
      $data = array(
          'cycle'=> $partenaire->getCycle(),
          'site_web'=> $partenaire->getSite_web(),
          'tel'=> $partenaire->getTel(),
          'email'=> $partenaire->getEmail(),
          'criteres'=> $partenaire->getCriteres(),
          'langue_etude'=> $partenaire->getLangue_etude(),
          'coordonateur'=> $partenaire->getCoordonateur(),
          'frais_inscription_annuel'=> $partenaire->getFrais_inscription_annuel(),
          'frais_traitement_dossier'=> $partenaire->getFrais_traitement_dossier(),
          'created_by'=> $partenaire->getCreated_by(),
      ) ;
      //r�cuperer l'id de ma tache et je test en num�rique
      $id = (int) $partenaire->getId_partenaire();
      //je test la valeur de ma var id
      //si mon id =0 donc mon objet Todo n'a pas d'idet donc par 
      //cons�quent c'est une nouvelle tache je vais donc je l'inserer 
      //on lui donnant la table $data(ses donn�es)
      if($id == 0){
          $this->tableGateway->insert($data);
          // si la tache exist donc l'id contient une valeur
      }else{
          // si elle est existante je v�rifie si elle existe en bdd
          if($this->getPartenaire($id)){
              //je met a jour la tache ses donn�es et son id
              $this->tableGateway->update($data, array('id_partenaire'=> $id));
              //et si ma tache n'existe pas en bdd je declenche une exception
          }else{
              throw new \Exception('Partenaire id does not exist');
          }
      }
    }
    
    public function deletePartenaire($id)
    {
       $this->tableGateway->delete(array('id_partenaire'=>(int) $id));
    }
}
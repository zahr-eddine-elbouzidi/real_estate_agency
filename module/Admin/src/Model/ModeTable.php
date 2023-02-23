<?php
namespace Admin\Model;

use Laminas\Db\TableGateway\TableGateway;
use Admin\Model\Slug;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;

class ModeTable
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
        $SQL = "SELECT * FROM mode_paiement ORDER BY created_at asc;";
        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
          $SQL
        );
      
        $results = new HydratingResultSet(
      
          new Hydrator\ArraySerializableHydrator(),
      
          new \Admin\Model\Mode()
        );
        
        $results->initialize($result);
      
        return $results->toArray();
    }
    
    /**
     * get record by name
     * @param $name_fr 
     */
    public function getRecordByName($name)
    {
       $rowset =$this->tableGateway->select(array('nom_mode'=>$name));
       $row = $rowset->current();

       if(!$row){
           return false;
       }
      return true;
    }


    public function getElementByName($name_fr)
    {
        $SQL = "SELECT * FROM mode_paiement WHERE nom_mode = BINARY :name_fr ";
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
     * get Mode by id
     */
    public function getMode($id)
    {
       $id = (int)  $id;
       $rowset =$this->tableGateway->select(array('id_mode'=>$id));
       $row = $rowset->current();
       if(!$row){
           throw new \Exception("could not find Mode $id");
       }
      return $row;
    }
    
    public function saveMode(Mode $mode)
    {
        //extraire les donn�es de mon objet Todo dans le tableau $data
      $data = array(
          'nom_mode'=> $mode->getNom_mode(),
          'created_by'=> $mode->getCreated_by(),
      ) ;
      //r�cuperer l'id de ma tache et je test en num�rique
      $id = (int) $mode->getId_mode();
      //je test la valeur de ma var id
      //si mon id =0 donc mon objet Todo n'a pas d'idet donc par 
      //cons�quent c'est une nouvelle tache je vais donc je l'inserer 
      //on lui donnant la table $data(ses donn�es)
      if($id == 0){
          $this->tableGateway->insert($data);
          // si la tache exist donc l'id contient une valeur
      }else{
          // si elle est existante je v�rifie si elle existe en bdd
          if($this->getMode($id)){
              //je met a jour la tache ses donn�es et son id
              $this->tableGateway->update($data, array('id_mode'=> $id));
              //et si ma tache n'existe pas en bdd je declenche une exception
          }else{
              throw new \Exception('Mode id does not exist');
          }
      }
    }
    
    public function deleteMode($id)
    {
       $this->tableGateway->delete(array('id_mode'=>(int) $id));
    }
}
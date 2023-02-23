<?php
namespace Admin\Model;

use Laminas\Db\TableGateway\TableGateway;
use Admin\Model\Slug;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;

class CategorieTable
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
        $SQL = "SELECT * FROM category ORDER BY level_cat asc;";
        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
          $SQL
        );
      
        $results = new HydratingResultSet(
      
          new Hydrator\ArraySerializableHydrator(),
      
          new \Admin\Model\Categorie()
        );
        
        $results->initialize($result);
      
        return $results->toArray();
    }
    
    /**
     * get record by name
     * @param $name_fr 
     */
    public function getRecordByName($name_fr)
    {
       $rowset =$this->tableGateway->select(array('name_fr'=>$name_fr));
       $row = $rowset->current();
       var_dump($row);
       if(!$row){
           return false;
       }
      return true;
    }


    public function getElementByName($name_fr)
    {
        $SQL = "SELECT * FROM category WHERE name_fr = BINARY :name_fr ";
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
    public function getCategory($id)
    {
       $id = (int)  $id;
       $rowset =$this->tableGateway->select(array('id'=>$id));
       $row = $rowset->current();
       if(!$row){
           throw new \Exception("could not find category $id");
       }
      return $row;
    }
    
    public function saveCategorie(Categorie $category)
    {
        //extraire les donn�es de mon objet Todo dans le tableau $data
      $data = array(
          'name_fr'=> $category->getNameFr(),
          'name_eng'=> $category->getNameEng(),
          'name_ar'=> $category->getNameAr(),
          'level_cat'=> $category->getLevelCat(),
          'enabled'=> $category->getEnabled(),
          'slug'=> Slug::create_slug($category->getNameFr()),
          'created_by'=> $category->getCreatedBy(),
      ) ;
      //r�cuperer l'id de ma tache et je test en num�rique
      $id = (int) $category->getId();
      //je test la valeur de ma var id
      //si mon id =0 donc mon objet Todo n'a pas d'idet donc par 
      //cons�quent c'est une nouvelle tache je vais donc je l'inserer 
      //on lui donnant la table $data(ses donn�es)
      if($id == 0){
          $this->tableGateway->insert($data);
          // si la tache exist donc l'id contient une valeur
      }else{
          // si elle est existante je v�rifie si elle existe en bdd
          if($this->getCategory($id)){
              //je met a jour la tache ses donn�es et son id
              $this->tableGateway->update($data, array('id'=> $id));
              //et si ma tache n'existe pas en bdd je declenche une exception
          }else{
              throw new \Exception('Categorie id does not exist');
          }
      }
    }
    
    public function deleteCategorie($id)
    {
       $this->tableGateway->delete(array('id'=>(int) $id));
    }
}
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


class FiliereTable
{

    protected $tableGateway;
    private $driver;
    private $connection;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->driver = $this->tableGateway->getAdapter()->driver;
        $this->connection = $this->driver->getConnection();

    }
    /**
     * get record by name
     * @param sub_name_fr
     */
    public function getRecordByName($name_fr  , $etab_id)
    {
        $rowset = $this->tableGateway->select(array('nom_filiere' => $name_fr , 'etablissement_id' => $etab_id));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }

    public function getRecordByNameOnly($name_fr)
    {
        $rowset = $this->tableGateway->select(array('nom_filiere' => $name_fr));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }
    /**
     * get all users by created by 
     */
    public function getUsersByCreatedby($created_by)
    {

        $SQL = "SELECT * FROM users WHERE  created_by  
                in(SELECT usr_email FROM users WHERE usr_isSuper=1)";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
            $SQL
        );
        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\User()
        );
        $results->initialize($result);
        $return = array();
        $lengthResult = $results->count();
        for ($i = 0; $i < $lengthResult; $i++) {
            $return[] = $results->current();
            $results->next();
        }

        return $return;

    }

    /**
     * get all data from sub category table
     */
    public function fetchAll()
    {
        $SQL = "SELECT filieres.*,etablissements.* 
                FROM filieres,etablissements 
                WHERE filieres.etablissement_id = etablissements.id_etablissement 
               ;";
       
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


    public function getFiliereEtab($filiere_id)
    {
        $SQL = "SELECT filieres.*,etablissements.* 
                FROM filieres,etablissements 
                WHERE filieres.etablissement_id = etablissements.id_etablissement 
                AND filieres.id_filiere=:filiere_id 
               ;";
       
       $datas = array('filiere_id' => $filiere_id);
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute($datas);
        
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

  

    /**
     *  @param $type_id;
     *  get own sub category
     *  get one sub category by id
     *  @return sub category object
     *
     ***/

    public function getFiliere($id)
    {
        $rowset = $this->tableGateway->select(array('id_filiere' => $id));
        $row = $rowset->current();
        if (!$row) {
          //  throw new \Exception("Could not find row ");
        }
        return $row;
    }

    public function getFiliereByEtablissement($etablissement_id)
    {

        $rowset = $this->tableGateway->select(array('etablissement_id' => $etablissement_id));
        $row = $rowset->current();
        if (!$row) {
            return null;
        }
        return $row;
    }

    /**
     *
     *  get Last sub category
     *
     **/

    public function getLastIdFiliere()
    {

        $SQL = "SELECT * FROM filieres ORDER BY id_filiere DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\Filiere()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Sub category $type object
     * @throws \Exception
     */
    public function saveFiliere(Filiere $filiere)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'nom_filiere' => $filiere->getNom_filiere(),
                'etablissement_id' => $filiere->getEtablissement_id(),
                'created_by' => $filiere->getCreated_by()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $filiere_id = (int) $filiere->getId_filiere();

        if ($filiere_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getFiliere($filiere_id)) {

                $this->tableGateway->update($data, array('id_filiere' => $filiere_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retourner
     **/
    public function deleteFiliere($id_filiere)
    {
        $this->tableGateway->delete(array('id_filiere' => $id_filiere));
    }

}

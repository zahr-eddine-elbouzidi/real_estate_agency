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


class CalendrierTable
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
    public function getRecordByName($session_id  , $filiere_id , $date_debut)
    {
        $rowset = $this->tableGateway->select(array('session_id' => $session_id , 'filiere_id' => $filiere_id ,
                                                    'date_debut' => $date_debut));
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
        $SQL = "SELECT filieres.*,sessions.*,session_filiere.*
                FROM filieres,sessions,session_filiere 
                WHERE filieres.id_filiere = session_filiere.filiere_id 
                AND sessions.id_session = session_filiere.session_id  
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

    public function fetchAllByFiliere($filiere_id)
    {

        $SQL = "SELECT filieres.*,sessions.*,session_filiere.*
                FROM filieres,sessions,session_filiere 
                WHERE filieres.id_filiere = session_filiere.filiere_id 
                AND sessions.id_session = session_filiere.session_id  
                AND filieres.id_filiere = :filiere_id
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

    public function getCalendrier($id)
    {
        $rowset = $this->tableGateway->select(array('id_session_filiere' => $id));
        $row = $rowset->current();
        if (!$row) {
          //  throw new \Exception("Could not find row ");
        }
        return $row;
    }

   
    /**
     *
     *  get Last sub category
     *
     **/

    public function getLastIdCalendrier()
    {

        $SQL = "SELECT * FROM session_filiere ORDER BY id_session_filiere DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\Calendrier()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Inscription object
     * @throws \Exception
     */
    public function saveCalendrier(Calendrier $calendrier)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'date_debut' => $calendrier->getDate_debut(),
                'date_fin' => $calendrier->getDate_fin(),
                'session_id' => $calendrier->getSession_id(),
                'filiere_id' => $calendrier->getFiliere_id(),
                'created_by' => $calendrier->getCreated_by()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $calendrier_id = (int) $calendrier->getId_session_filiere();

        if ($calendrier_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getCalendrier($calendrier_id)) {

                $this->tableGateway->update($data, array('id_session_filiere' => $calendrier_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retourner
     **/
    public function deleteCalendrier($calendrier_id)
    {
        $this->tableGateway->delete(array('id_session_filiere' => $calendrier_id));
    }

}

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


class PaiementsTable
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

    public function fetchAllByInscription($inscription_id)
    {

        $SQL = "SELECT filieres.*,inscriptions.*,paiements.*, mode_paiement.* 
                FROM filieres, inscriptions, paiements ,candidat, mode_paiement 
                WHERE filieres.id_filiere = inscriptions.filiere_id 
                AND candidat.id_candidat = inscriptions.candidat_id 
                AND inscriptions.id_inscription = paiements.inscription_id 
                AND paiements.mode_id = mode_paiement.id_mode  
                AND inscriptions.id_inscription = :inscription_id 
               ;";
       
        $datas = array('inscription_id' => $inscription_id);
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


    public function getInscriptionByID($inscription_id)
    {

        $SQL = "SELECT  inscriptions.*
                FROM inscriptions
                WHERE inscriptions.id_inscription = :inscription_id 
               ;";
       
        $datas = array('inscription_id' => $inscription_id);
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

    public function getPaiement($id)
    {
        $rowset = $this->tableGateway->select(array('id_paiement' => $id));
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

    public function getLastIdPaiement()
    {

        $SQL = "SELECT * FROM paiements ORDER BY id_paiement DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\Paiements()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Inscription object
     * @throws \Exception
     */
    public function savePaiement(Paiements $paiement)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'date_paiement' => $paiement->getDate_paiement(),
                'mt_paye' => $paiement->getMt_paye(),
                'type_paie' => $paiement->getType_paie(),
                'remise' => $paiement->getRemise(),
                'inscription_id' => $paiement->getInscription_id(),
                'mode_id' => $paiement->getMode_id(),
                'created_by' => $paiement->getCreated_by()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $paiement_id = (int) $paiement->getId_paiement();

        if ($paiement_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getPaiement($paiement_id)) {

                $this->tableGateway->update($data, array('id_paiement' => $paiement_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retourner
     **/
    public function deletePaiement($paiement_id)
    {
        $this->tableGateway->delete(array('id_paiement' => $paiement_id));
    }

}

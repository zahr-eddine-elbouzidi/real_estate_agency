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


class InscriptionTable
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
    public function getRecordByName($candidat_id , $date)
    {
        $rowset = $this->tableGateway->select(array('candidat_id' => $candidat_id ,
                                                    'date_inscription' => $date));
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
        $SQL = "SELECT filieres.*,candidat.*,inscriptions.*
                FROM filieres,candidat,inscriptions 
                WHERE filieres.id_filiere = inscriptions.filiere_id 
                AND candidat.id_candidat = inscriptions.candidat_id  
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


    public function fetchAllByCandidat($candidat_id)
    {
        $SQL = "SELECT filieres.*,candidat.*,inscriptions.*,etablissements.* 
                FROM filieres,candidat,inscriptions,etablissements
                WHERE filieres.id_filiere = inscriptions.filiere_id 
                AND candidat.id_candidat = inscriptions.candidat_id  
                AND filieres.etablissement_id = etablissements.id_etablissement 
                AND candidat.id_candidat =:candidat_id 
               ;";
       
        $datas = array('candidat_id' => $candidat_id);
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
   
    public function getPartenaireByFiliere($filiere_id)
    {
        $SQL = "select partenaires.* 
                from partenaires , filieres 
                where partenaires.filiere_id = filieres.id_filiere 
                and filieres.id_filiere = :filiere_id;" ;

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

    public function getInscription($id)
    {
        $rowset = $this->tableGateway->select(array('id_inscription' => $id));
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

    public function getLastIdInscription()
    {

        $SQL = "SELECT * FROM inscriptions ORDER BY id_inscription DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\Inscription()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Inscription object
     * @throws \Exception
     */
    public function saveInscription(Inscription $inscription)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'date_inscription' => $inscription->getDate_inscription(),
                'filiere_id' => $inscription->getFiliere_id(),
                'candidat_id' => $inscription->getCandidat_id(),
                'mt_paye_trait_dossier' => $inscription->getMt_paye_trait_dossier(),
                'mt_reste_trait_dossier' => $inscription->getMt_reste_trait_dossier(),
                'created_by' => $inscription->getCreated_by()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $inscription_id = (int) $inscription->getId_inscription();

        if ($inscription_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getInscription($inscription_id)) {

                $this->tableGateway->update($data, array('id_inscription' => $inscription_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retourner
     **/
    public function deleteInscription($id_inscription)
    {
        $this->tableGateway->delete(array('id_inscription' => $id_inscription));
    }

}

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


class FileTable
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
        $SQL = "SELECT posts.*,files.* 
                FROM posts,files 
                WHERE files.post_id = posts.id_post 
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

    public function getLastFileId(){

        $SQL = "SELECT max(files.id_file) as max_of_files FROM files";     
        $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
        $result = $stmt->execute();
  
        $data = array();
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
          $resultSet = new ResultSet;
          $resultSet->initialize($result);
            foreach($resultSet as $value){
            $data[] = $value;
            }
        }
  
        $data = current( $data);
        return  $data;
   }
  
    public function getFilesByPost($post_id)
    {
        $SQL = "SELECT files.* 
                FROM posts,files 
                WHERE files.post_id = posts.id_post
                AND files.post_id=:post_id 
               ;";
       
       $datas = array('post_id' => $post_id);
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

    public function getFile($id)
    {
        $rowset = $this->tableGateway->select(array('id_file' => $id));
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

    public function getLastIdFile()
    {

        $SQL = "SELECT * FROM files ORDER BY id_file DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\File()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Sub category $type object
     * @throws \Exception
     */
    public function saveFile(File $file)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'filename' => $file->getFilename(),
                'post_id' => $file->getPostId(),
                'created_by' => $file->getCreatedBy()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $file_id = (int) $file->getIdFile();

        if ($file_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getFile($file_id)) {

                $this->tableGateway->update($data, array('id_file' => $file_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retournée
     **/
    public function deleteFile($file_id)
    {
        $this->tableGateway->delete(array('id_file' => $file_id));
    }

}

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


class SubcatTable
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
    public function getRecordByName($name_fr  , $category_id)
    {
        $rowset = $this->tableGateway->select(array('sub_name_fr' => $name_fr , 'sub_category_id' => $category_id));
        $row = $rowset->current();
        if (!$row) {
            //throw new \Exception("Could not find row $token");
        }
        return $row;
    }

    public function getRecordByNameOnly($name_fr)
    {
        $rowset = $this->tableGateway->select(array('sub_name_fr' => $name_fr));
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
        $SQL = "SELECT category.*,subcat.* 
                FROM category,subcat 
                WHERE category.id = subcat.sub_category_id 
                AND subcat.sub_created_by IN(SELECT users.usr_email FROM users WHERE users.usr_isSuper = 1);";
       
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

  

    /**
     *  @param $type_id;
     *  get own sub category
     *  get one sub category by id
     *  @return sub category object
     *
     ***/

    public function getSubCategory($id)
    {
        $rowset = $this->tableGateway->select(array('id_subcat' => $id));
        $row = $rowset->current();
        if (!$row) {
          //  throw new \Exception("Could not find row ");
        }
        return $row;
    }

    public function getSubCategoryByCategory($category_id)
    {

        $rowset = $this->tableGateway->select(array('sub_category_id' => $category_id));
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

    public function getLastIdSubCategory()
    {

        $SQL = "SELECT * FROM subcat ORDER BY id_subcat DESC LIMIT 1";

        $result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(

            $SQL

        );

        $results = new HydratingResultSet(
            new Hydrator\ArraySerializableHydrator(),
            new \Admin\Model\Subcat()
        );
        $results->initialize($result);
        return $results;
    }

    /**
     * la creation d'une
     * @param Sub category $type object
     * @throws \Exception
     */
    public function saveSubcat(Subcat $subcat)
    {

            // for Zend\Db\TableGateway\TableGateway we need the data in array not object
            $data = array(
                'sub_name_fr' => $subcat->getSub_name_fr(),
                'sub_name_eng' => $subcat->getSub_name_eng(),
                'sub_name_ar' => $subcat->getSub_name_ar(),
                'sub_level' => $subcat->getSub_level(),
                'sub_slug' => Slug::create_slug($subcat->getSub_name_fr()),
                'sub_enabled' => $subcat->getSub_enabled(),
                'sub_created_by' => $subcat->getSub_created_by(),
                'sub_category_id' => $subcat->getSub_category_id()
            );
 

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $categorie->getArrayCopy();

        $sub_cat_id = (int) $subcat->getId_subcat();

        if ($sub_cat_id == 0) {

            $this->tableGateway->insert($data);

        } else {

            if ($this->getSubCategory($sub_cat_id)) {

                $this->tableGateway->update($data, array('id_subcat' => $sub_cat_id));

            } else {

                throw new \Exception('Form id does not exist');

            }
        }

    }

    /**
     *  @param $id
     *  pas de valeur retourner
     **/
    public function deleteSubCategory($id_subcat)
    {
        $this->tableGateway->delete(array('id_subcat' => $id_subcat));
    }

}

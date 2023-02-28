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

class PostTable
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
  * get all posts 
  */
 public function fetchAll()
 {
    $SQL = "SELECT posts.*,subcat.*,category.*,posts.enabled as post_enabled
            FROM posts , subcat,category
            WHERE category.id = subcat.sub_category_id
            AND subcat.id_subcat = posts.subcategory_id
            ORDER BY posts.created_at DESC";

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
      return  $data;
 }


 /**
  * get posts by type 
  */
 public function getPostsByType($post_type)
 {
    $SQL = "SELECT posts.*,subcat.*,category.*
            FROM posts , subcat,category
            WHERE category.id = subcat.sub_category_id
            AND subcat.id_subcat = posts.subcategory_id
            AND posts.enabled = 1 
            AND posts.type =:post_type 
            ORDER BY posts.created_at DESC";
                   
     $data = array('post_type' => $post_type);
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
   return  $data;
 }

 /**
  * get single post by type
  */
 public function getPostByType($type)
 {
    $rowset = $this->tableGateway->select(array('type' => $type));
    $row = $rowset->current();
    if (!$row) {
                //throw new \Exception("Could not find row $token");
    }
    return $row;
 }

 public function getLastPostId(){

      $SQL = "SELECT max(posts.id_post) as max_of_posts FROM posts";     
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


 /**
  * get single post by title
  */
  public function getPostByTitle($title)
  {
     $rowset = $this->tableGateway->select(array('title' => $title));
     $row = $rowset->current();
     if (!$row) {
                 //throw new \Exception("Could not find row $token");
     }
     return $row;
 }

 /**
  * get single post by id
  */
  public function getPost($post_id)
  {
     $rowset = $this->tableGateway->select(array('id_post' => $post_id));
     $row = $rowset->current();
     if (!$row) {
                 //throw new \Exception("Could not find row $token");
     }
     return $row;
 }

 /**
  * save Post object
  */
 public function savePost(Post $post)
 {

    $date = new \DateTime();
    
  // for Zend\Db\TableGateway\TableGateway we need the data in array not object
   $data = array(
       'title'              => $post->getTitle(),
       'type'               => $post->getType(),
       'content'            => $post->getContent(),
       'enabled'            => $post->getEnabled(),
       'level'              => $post->getLevel(),
       'important_msg'      => $post->getImportant_msg(),
       'slug'               => Slug::create_slug($post->getTitle()),
       'filename'           => $post->getFilename(),
       'subcategory_id'     => $post->getSubcategory_id(),
       'address'            => $post->getAddress(),
       'bedrooms'           => $post->getBedrooms(),
       'bathrooms'          => $post->getBathrooms(),
       'halls'              => $post->getHalls(),
       'surface'            => $post->getSurface(),
       'garage'             => $post->getGarage(),
       'pays'               => $post->getPays(),
       'ville'              => $post->getVille(),
       'prix'               => $post->getPrix(),
       'created_by'         => $post->getCreated_by(),
       'updated_at'         => $date->format('Y-m-d H:i:s'),
   );
   
   
     // If there is a method getArrayCopy() defined in Auth you can simply call it.
     // $data = $categorie->getArrayCopy();
   
   $post_id = (int)$post->getId_post();
   
 
   
   if ($post_id == 0) {

    $this->tableGateway->insert($data);

} else {


   if ($this->getPost($post_id)) {

       $this->tableGateway->update($data, array('id_post' => $post_id));

   } else {

    throw new \Exception('Form id does not exist');

}
}

}
  /**
 *  @param $id
 *  pas de valeur retourner  
 **/
  public function deletePost($post_id)
  {
   $this->tableGateway->delete(array('id_post' => $post_id));
}






}
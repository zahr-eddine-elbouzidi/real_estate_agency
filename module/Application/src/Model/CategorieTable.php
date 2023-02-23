<?php
namespace Application\Model;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator;
use Laminas\Db\Adapter\Adapter; 
use Laminas\Stdlib\Hydrator\Reflection as ReflectionHydrator;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;
use Laminas\Db\Sql\Select;

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

   
 public function getContact()
 {
     $SQL = "SELECT * FROM contact ;";
     /*$result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
       $SQL
     );*/

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


  public function getSubCategories()
  {
      $SQL = "SELECT subcat.*,category.* FROM category,subcat 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.sub_enabled = 1 ";
      /*$result = $this->tableGateway->getAdapter()->driver->getConnection()->execute(
        $SQL
      );*/

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


  public function getPosts()
  {
 
      $SQL = "SELECT subcat.*,category.*,posts.* FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 ";
     
 
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


  public function getPostsArticles()
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug' 
              
              FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.type in('Article','Slider') LIMIT 6";
     

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

  public function getPostsAnnonces()
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
                posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
                posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.type='Annonce' LIMIT 6";
     

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


  public function getPostsBlogs()
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.type='Blog' LIMIT 6";
     

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

  
  public function getBlogs()
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.type='Blog'";
     

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


  public function getCountPostByCategories($type)
  {

      $SQL = null;
      
      if($type != 'all'){

        $SQL = "SELECT category.name_fr,count(posts.id_post) as nbre_posts 
                FROM category,subcat,posts
                WHERE category.id = subcat.sub_category_id
                AND subcat.id_subcat = posts.subcategory_id
                AND posts.type=:type
                GROUP BY category.name_fr ";
      }else{

        $SQL = "SELECT category.name_fr,count(posts.id_post) as nbre_posts 
                FROM category,subcat,posts
                WHERE category.id = subcat.sub_category_id
                AND subcat.id_subcat = posts.subcategory_id
                AND posts.type <>:type
                GROUP BY category.name_fr ";
      }


       
     
      $data = array('type' => $type);
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

  public function getPostsBySubCatSlug($slug)
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug' 
               FROM category,subcat,posts 
               WHERE category.id = subcat.sub_category_id 
               AND subcat.id_subcat = posts.subcategory_id
               AND posts.enabled = 1 
               AND subcat.sub_slug=:slug
               ORDER BY posts.created_at DESC
                ";
     
      $dataIn = ['slug' => $slug];
      $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
      $stmt->prepare($SQL);
     
      $result = $stmt->execute($dataIn);
    
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



  //recents Blogs
  
  public function getRecentsBlog()
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug' 
               FROM category,subcat,posts 
               WHERE category.id = subcat.sub_category_id 
               AND subcat.id_subcat = posts.subcategory_id
               AND posts.enabled = 1 
               AND posts.type = 'Blog' 
               ORDER BY posts.created_at DESC
               LIMIT 3 ";
     
    
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


  public function getMenuTitlesBySlug($slug)
  {
       $SQL = "SELECT subcat.*,category.* 
               FROM category,subcat 
               WHERE category.id = subcat.sub_category_id 
               AND category.enabled = 1 
               AND subcat.sub_enabled = 1
               AND subcat.sub_slug =:slug ";
     
      $dataIn = ['slug' => $slug];
      $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
      $stmt->prepare($SQL);
      $result = $stmt->execute($dataIn);
    
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



  public function getPostsBySlug($slug)
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 AND posts.slug=:slug ";
     
      $data = array('slug' => $slug);
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


  public function getRecentsPost($slug)
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.slug <> :slug 
              ORDER BY posts.created_at DESC
              LIMIT 3 ";
     
      $data = array('slug' => $slug);
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


  public function getRelatedPosts($slug , $type)
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.slug <> :slug 
              AND posts.type = :type 
              ORDER BY posts.created_at DESC
              LIMIT 2 ";
     
      $data = array('slug' => $slug , 'type' => $type);
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

  public function getPostsByType($type , $limit_rows)
  {
       $SQL = "SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
       posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
       posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  FROM category,subcat,posts 
              WHERE category.id = subcat.sub_category_id 
              AND subcat.id_subcat = posts.subcategory_id
              AND posts.enabled = 1 
              AND posts.type=:post_type LIMIT :limit_rows";
     

      $data = array('post_type' => $type , 'limit_rows' => $limit_rows);
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
   * get post by slug
   */
    public function getArticleBySlug($slug){

      $SQL = "SELECT * FROM posts WHERE posts.slug=:slug";
      $data = array('slug' => $slug);
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
      $data = current($data);
      return  $data;
    }    

    /**
   * get post by slug
   */
  public function getArticleBySubCategory($cat_name){

    $SQL = "SELECT posts.*, subcat.*
            FROM posts , subcat 
            WHERE posts.subcategory_id = subcat.id_subcat 
            AND subcat.sub_enabled=1 
            AND subcat.sub_name_fr =:cat_name";

    $data = array('cat_name' => $cat_name);
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
    $data = current($data);
    return  $data;
  }    

    /**
     * get category by slug
     */
    public function getCategoryBySlug($slug){
      
      $SQL = "SELECT * FROM category WHERE category.slug=:slug";
      $data = array('slug' => $slug);
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
      $data = current($data);
      return  $data;
    }    

      /**
     * get category by slug
     */
    public function getSubCategoryBySlug($slug){
      
      $SQL = "SELECT * FROM subcat WHERE subcat.sub_slug=:slug";
      $data = array('slug' => $slug);
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
      $data = current($data);
      return  $data;
    }  


    public function fetchAll()
    {
        $SQL = "SELECT * FROM category WHERE category.enabled = 1 ORDER BY level_cat asc;";
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


    public function fetchAllSearch($paginated = false , $key_words)
    {
        if ($paginated) {
            return $this->getPostSearch($key_words);
        }

        return $this->tableGateway->select();
    }

    public function getPostSearch($key_words)
    {
       /* $AND_STATEMENT = "";
         $SQL = "
                SELECT subcat.*,category.*,posts.id_post,posts.type,posts.title,posts.content,posts.enabled,
                posts.level,posts.important_msg,posts.filename,posts.subcategory_id,
                posts.created_by,posts.created_at,posts.updated_at,posts.slug as 'post_slug'  
                FROM category,subcat,posts 
                WHERE category.id = subcat.sub_category_id 
                AND subcat.id_subcat = posts.subcategory_id
                AND posts.enabled = 1 AND  
                ";
       
        foreach($key_words as $keys){
          $AND_STATEMENT .= " posts.title LIKE '%".$keys."%' OR";
        }
        $AND_STATEMENT = substr($AND_STATEMENT ,0 , strlen($AND_STATEMENT)-3);
        $SQL .= $AND_STATEMENT;*/
       /* var_dump($SQL);
        die();*/
  
       /* $stmt = $this->tableGateway->getAdapter()->driver->createStatement($SQL);
        $stmt->prepare($SQL);
       
        $result = $stmt->execute();
      
        $data = array();
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
          $resultSet = new ResultSet;
          $resultSet->initialize($result);
          
        }*/

        $select =  $this->getallAlbum($key_words);

        
         

      /*  $select->where->nest()  
        ->like('p.title', '%s%')
        ->or
        ->like('p.title', '%teste%')
        ->unnest();*/
        
        //$select->where->equalTo('enabled', '1');
      //   print_r($select->getSqlString($this->tableGateway->getAdapter()->getPlatform()));
      //die();
      $resultSetPrototype = new ResultSet();
        $paginatorAdapter = new DbSelect(
          // our configured select object:
          $select
          ,
          // the adapter to run it against:
          $this->tableGateway->getAdapter(),
          // the result set to hydrate:
          $resultSetPrototype
      ); 

      $paginator = new Paginator($paginatorAdapter);
      return $paginator;



       // return  $data;
    }
    

    function getallAlbum($key_words){
      $sql = new Select();
      $sql->from('category')->columns(array('id', 'name_fr','slug'))
      ->join('subcat', 'category.id = subcat.sub_category_id', array('sub_name_fr' => 'sub_name_fr','sub_slug' => 'sub_slug'), Select::JOIN_INNER)
      ->join('posts', 'posts.subcategory_id = subcat.id_subcat', array('title' => 'title','created_at' => 'created_at','post_slug' =>'slug'), Select::JOIN_INNER)
      ->where(array("posts.enabled" => "1"));

      

      if(sizeof($key_words) > 1){
        
          $sql->where->nest()->addPredicates(function ($where) use ($key_words) {
            foreach($key_words as $keys){
                $where->or->like('posts.title', '%'.$keys.'%');
            }
           })->unnest();
      
      }elseif(sizeof($key_words) == 1){
       
        $sql->where->like('posts.title', '%'.$key_words[0].'%');
      }
    
       return $sql; 
    }
    
    /**
     * get record by name
     * @param $name_fr 
     */
    public function getRecordByName($name_fr)
    {
       $rowset =$this->tableGateway->select(array('name_fr'=>$name_fr));
       $row = $rowset->current();
       if(!$row){
           return false;
       }
      return true;
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
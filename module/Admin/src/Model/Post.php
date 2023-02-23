<?php 
 

namespace Admin\Model;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
 
class Post 
{
   private $id_post;
   private $type;
   private $title;
   private $content;
   private $enabled;
   private $slug;
   private $level;
   private $important_msg;
   private $filename;
   private $subcategory_id;
   private $created_by;
   private $updated_at;


   protected $inputFilter;   
   
   public function exchangeArray($data)
   {
       $this->id_post     = (!empty($data['id_post'])) ? $data['id_post'] : null;
       $this->type     = (!empty($data['type'])) ? $data['type'] : null;
       $this->title     = (!empty($data['title'])) ? $data['title'] : null;
       $this->content     = (!empty($data['content'])) ? $data['content'] : null;
       $this->enabled     = (!empty($data['enabled'])) ? $data['enabled'] : 0;
       $this->slug     = (!empty($data['slug'])) ? $data['slug'] : null;
       $this->level     = (!empty($data['level'])) ? $data['level'] : null;
       $this->important_msg     = (!empty($data['important_msg'])) ? $data['important_msg'] : null;
       $this->filename     = (!empty($data['filename'])) ? $data['filename'] : null;
       $this->subcategory_id     = (!empty($data['subcategory_id'])) ? $data['subcategory_id'] : null;
       $this->created_by     = (!empty($data['created_by'])) ? $data['created_by'] : null;
       $this->updated_at     = (!empty($data['updated_at'])) ? $data['updated_at'] : null;
   }

   public function getArrayCopy()
   {
       return get_object_vars($this);
   }

   

   public function setInputFilter(InputFilterInterface $inputFilter)
   {
       throw new \Exception("Not used");
   }

     public function getInputFilter()
   {
       if (!$this->inputFilter) {
           $inputFilter = new InputFilter();

           $inputFilter->add(array(
               'name'     => 'id_post',
               'required' => true,
               'filters'  => array(
                   array('name' => 'Int'),
               ),
           ));
           
  

        $inputFilter->add(array(
            'name'     => 'type',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'title',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'content',
            'required' => false,
            'filters'  => array(
                //array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                     ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'enabled',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));
        
        $inputFilter->add(array(
            'name'     => 'slug',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'filename',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));


        $inputFilter->add(array(
            'name'     => 'level',
            'required' => false,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));


        $inputFilter->add(array(
            'name'     => 'important_msg',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));
        

        $inputFilter->add(array(
            'name'     => 'subcategory_id',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));

        $inputFilter->add(array(
            'name'     => 'created_by',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        )); 

        $inputFilter->add(array(
            'name'     => 'created_at',
            'required' => false,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
        
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        )); 

         
            
           
           
           
           
           
           $this->inputFilter = $inputFilter;
       }

       return $this->inputFilter;
   }

   /**
    * Get the value of post_id
    */ 
   public function getId_post()
   {
      return $this->id_post;
   }

   /**
    * Set the value of post_id
    *
    * @return  self
    */ 
   public function setId_post($post_id)
   {
      $this->post_id = $id_post;

      return $this;
   }

   /**
    * Get the value of type
    */ 
   public function getType()
   {
      return $this->type;
   }

   /**
    * Set the value of type
    *
    * @return  self
    */ 
   public function setType($type)
   {
      $this->type = $type;

      return $this;
   }

   /**
    * Get the value of title
    */ 
   public function getTitle()
   {
      return $this->title;
   }

   /**
    * Set the value of title
    *
    * @return  self
    */ 
   public function setTitle($title)
   {
      $this->title = $title;

      return $this;
   }

   /**
    * Get the value of content
    */ 
   public function getContent()
   {
      return $this->content;
   }

   /**
    * Set the value of content
    *
    * @return  self
    */ 
   public function setContent($content)
   {
      $this->content = $content;

      return $this;
   }

   /**
    * Get the value of enabled
    */ 
   public function getEnabled()
   {
      return $this->enabled;
   }

   /**
    * Set the value of enabled
    *
    * @return  self
    */ 
   public function setEnabled($enabled)
   {
      $this->enabled = $enabled;

      return $this;
   }

   /**
    * Get the value of slug
    */ 
   public function getSlug()
   {
      return $this->slug;
   }

   /**
    * Set the value of slug
    *
    * @return  self
    */ 
   public function setSlug($slug)
   {
      $this->slug = $slug;

      return $this;
   }


   /**
    * Get the value of level
    */ 
    public function getLevel()
    {
       return $this->level;
    }
 
    /**
     * Set the value of level
     *
     * @return  self
     */ 
    public function setLevel($level)
    {
       $this->level = $level;
 
       return $this;
    }


    /**
    * Get the value of important msg
    */ 
    public function getImportant_msg()
    {
       return $this->important_msg;
    }
 
    /**
     * Set the value of important_msg
     *
     * @return  self
     */ 
    public function setImportant_msg($important_msg)
    {
       $this->important_msg = $important_msg;
 
       return $this;
    }


    /**
    * Get the value of filename
    */ 
    public function getFilename()
    {
       return $this->filename;
    }
 
    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setFilename($filename)
    {
       $this->filename = $filename;
 
       return $this;
    }


   /**
    * Get the value of subcategory_id
    */ 
   public function getSubcategory_id()
   {
      return $this->subcategory_id;
   }

   /**
    * Set the value of subcategory_id
    *
    * @return  self
    */ 
   public function setSubcategory_id($subcategory_id)
   {
      $this->subcategory_id = $subcategory_id;

      return $this;
   }

   /**
    * Get the value of created_by
    */ 
   public function getCreated_by()
   {
      return $this->created_by;
   }

   /**
    * Set the value of created_by
    *
    * @return  self
    */ 
   public function setCreated_by($created_by)
   {
      $this->created_by = $created_by;

      return $this;
   }

   /**
    * Get the value of updated_at
    */ 
   public function getUpdated_at()
   {
      return $this->updated_at;
   }

   /**
    * Set the value of updated_at
    *
    * @return  self
    */ 
   public function setUpdated_at($updated_at)
   {
      $this->updated_at = $updated_at;

      return $this;
   }
}





?>
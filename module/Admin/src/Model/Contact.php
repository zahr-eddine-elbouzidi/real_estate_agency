<?php 
/**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Model;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;

class Contact 
{
   private $id_contact;
   private $name;
   private $tel;
   private $gsm;
   private $website;
   private $facebook_url;
   private $instagram_url;
   private $linkedin_url;
   private $tiktok_url;
   private $address;
   private $email;
   private $created_by;
   

   
   
   
     //objet

   protected $inputFilter;   
   
   public function exchangeArray($data)
   {
       $this->id_contact     = (!empty($data['id_contact'])) ? $data['id_contact'] : null;
       $this->name     = (!empty($data['name'])) ? $data['name'] : null;
       $this->tel     = (!empty($data['tel'])) ? $data['tel'] : null;
       $this->gsm     = (!empty($data['gsm'])) ? $data['gsm'] : null;
       $this->email     = (!empty($data['email'])) ? $data['email'] : null;
       $this->address     = (!empty($data['address'])) ? $data['address'] : null;
       $this->website     = (!empty($data['website'])) ? $data['website'] : null;
       $this->facebook_url     = (!empty($data['facebook_url'])) ? $data['facebook_url'] : null;
       $this->instagram_url     = (!empty($data['instagram_url'])) ? $data['instagram_url'] : null;
       $this->linkedin_url     = (!empty($data['linkedin_url'])) ? $data['linkedin_url'] : null;
       $this->tiktok_url     = (!empty($data['tiktok_url'])) ? $data['tiktok_url'] : null;
       $this->created_by     = (!empty($data['created_by'])) ? $data['created_by'] : null;
       
       
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
               'name'     => 'id_contact',
               'required' => false,
               'filters'  => array(
                   array('name' => 'Int'),
               ),
           ));


           
           
           
           $inputFilter->add(array(
               'name'     => 'name',
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
               'name'     => 'tel',
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
               'name'     => 'gsm',
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
               'name'     => 'email',
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
               'name'     => 'adresse',
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
            'name'     => 'website',
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
            'name'     => 'facebook_url',
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
            'name'     => 'instagram_url',
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
            'name'     => 'linkedin_url',
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
            'name'     => 'tiktok_url',
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

           
           
           
           

           
           $this->inputFilter = $inputFilter;
       }

       return $this->inputFilter;
   }

   /**
    * Get the value of id_contact
    */ 
   public function getId_contact()
   {
      return $this->id_contact;
   }

   /**
    * Set the value of id_contact
    *
    * @return  self
    */ 
   public function setId_contact($id_contact)
   {
      $this->id_contact = $id_contact;

      return $this;
   }

   /**
    * Get the value of name
    */ 
   public function getName()
   {
      return $this->name;
   }

   /**
    * Set the value of name
    *
    * @return  self
    */ 
   public function setName($name)
   {
      $this->name = $name;

      return $this;
   }

   /**
    * Get the value of tel
    */ 
   public function getTel()
   {
      return $this->tel;
   }

   /**
    * Set the value of tel
    *
    * @return  self
    */ 
   public function setTel($tel)
   {
      $this->tel = $tel;

      return $this;
   }

   /**
    * Get the value of gsm
    */ 
   public function getGsm()
   {
      return $this->gsm;
   }

   /**
    * Set the value of gsm
    *
    * @return  self
    */ 
   public function setGsm($gsm)
   {
      $this->gsm = $gsm;

      return $this;
   }

   /**
    * Get the value of website
    */ 
   public function getWebsite()
   {
      return $this->website;
   }

   /**
    * Set the value of website
    *
    * @return  self
    */ 
   public function setWebsite($website)
   {
      $this->website = $website;

      return $this;
   }

   /**
    * Get the value of facebook_url
    */ 
   public function getFacebook_url()
   {
      return $this->facebook_url;
   }

   /**
    * Set the value of facebook_url
    *
    * @return  self
    */ 
   public function setFacebook_url($facebook_url)
   {
      $this->facebook_url = $facebook_url;

      return $this;
   }

   /**
    * Get the value of instagram_url
    */ 
   public function getInstagram_url()
   {
      return $this->instagram_url;
   }

   /**
    * Set the value of instagram_url
    *
    * @return  self
    */ 
   public function setInstagram_url($instagram_url)
   {
      $this->instagram_url = $instagram_url;

      return $this;
   }

   /**
    * Get the value of linkedin_url
    */ 
   public function getLinkedin_url()
   {
      return $this->linkedin_url;
   }

   /**
    * Set the value of linkedin_url
    *
    * @return  self
    */ 
   public function setLinkedin_url($linkedin_url)
   {
      $this->linkedin_url = $linkedin_url;

      return $this;
   }

   /**
    * Get the value of tiktok_url
    */ 
   public function getTiktok_url()
   {
      return $this->tiktok_url;
   }

   /**
    * Set the value of tiktok_url
    *
    * @return  self
    */ 
   public function setTiktok_url($tiktok_url)
   {
      $this->tiktok_url = $tiktok_url;

      return $this;
   }

   /**
    * Get the value of address
    */ 
   public function getAddress()
   {
      return $this->address;
   }

   /**
    * Set the value of address
    *
    * @return  self
    */ 
   public function setAddress($address)
   {
      $this->address = $address;

      return $this;
   }

   /**
    * Get the value of email
    */ 
   public function getEmail()
   {
      return $this->email;
   }

   /**
    * Set the value of email
    *
    * @return  self
    */ 
   public function setEmail($email)
   {
      $this->email = $email;

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
}





?>
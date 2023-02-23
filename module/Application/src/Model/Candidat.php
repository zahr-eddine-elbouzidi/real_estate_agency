<?php 
/**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Model;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\Validator\StringLength;

class Candidat
{
   private $id_candidat;
   private $fullname;
   private $tel;
   private $email;
   private $subject;
   private $message;
   private $search_engine;
   private $device_engine;
   private $forward_link_engine;
   private $country_engine;
   private $country_code_engine;
   private $region_code_engine;
   private $region_name_engine;
   private $city_engine;
   private $zip_engine;
   private $lat_engine;
   private $lon_engine;
   private $timezone_engine;
   private $isp_modem_internet_engine;
   private $org_modem_engine;
   private $as_modem_engine;
   private $ip_address_engine;

   private $diplome_obtenu;
   private $niveau_etude;
   private $ville;
   private $pays_destination;
   private $filiere;
   private $diplome_langue;
   private $langue_etude;
    
   
     //objet

   protected $inputFilter;   
   
   public function exchangeArray($data)
   {
       $this->id_candidat     = (!empty($data['id_candidat'])) ? $data['id_candidat'] : null;
       $this->fullname     = (!empty($data['fullname'])) ? $data['fullname'] : null;
       $this->tel     = (!empty($data['tel'])) ? $data['tel'] : null;
       $this->email     = (!empty($data['email'])) ? $data['email'] : null;
       $this->subject     = (!empty($data['subject'])) ? $data['subject'] : null;
       $this->message     = (!empty($data['message'])) ? $data['message'] : null;

       $this->diplome_obtenu = (!empty($data['diplome_obtenu'])) ? $data['diplome_obtenu'] : null;
       $this->niveau_etude     = (!empty($data['niveau_etude'])) ? $data['niveau_etude'] : null;
       $this->ville     = (!empty($data['ville'])) ? $data['ville'] : null;
       $this->pays_destination = (!empty($data['pays_destination'])) ? $data['pays_destination'] : null;
       $this->filiere     = (!empty($data['filiere'])) ? $data['filiere'] : null;
       $this->diplome_langue     = (!empty($data['diplome_langue'])) ? $data['diplome_langue'] : null;
       $this->langue_etude     = (!empty($data['langue_etude'])) ? $data['langue_etude'] : null;
       
       $this->search_engine     = (!empty($data['search_engine'])) ? $data['search_engine'] : null;
       $this->device_engine     = (!empty($data['device_engine'])) ? $data['device_engine'] : null;
       $this->forward_link_engine     = (!empty($data['forward_link_engine'])) ? $data['forward_link_engine'] : null;
       $this->country_engine     = (!empty($data['country_engine'])) ? $data['country_engine'] : null;
       $this->country_code_engine     = (!empty($data['country_code_engine'])) ? $data['country_code_engine'] : null;
       $this->region_code_engine     = (!empty($data['region_code_engine'])) ? $data['region_code_engine'] : null;
       $this->region_name_engine     = (!empty($data['region_name_engine'])) ? $data['region_name_engine'] : null;
       $this->city_engine     = (!empty($data['city_engine'])) ? $data['city_engine'] : null;
       $this->zip_engine     = (!empty($data['zip_engine'])) ? $data['zip_engine'] : null;
       $this->lat_engine     = (!empty($data['lat_engine'])) ? $data['lat_engine'] : null;
       $this->lon_engine     = (!empty($data['lon_engine'])) ? $data['lon_engine'] : null;
       $this->timezone_engine     = (!empty($data['timezone_engine'])) ? $data['timezone_engine'] : null;
       $this->isp_modem_internet_engine     = (!empty($data['isp_modem_internet_engine'])) ? $data['isp_modem_internet_engine'] : null;
       $this->org_modem_engine     = (!empty($data['org_modem_engine'])) ? $data['org_modem_engine'] : null;
       $this->as_modem_engine     = (!empty($data['as_modem_engine'])) ? $data['as_modem_engine'] : null;
       $this->ip_address_engine     = (!empty($data['ip_address_engine'])) ? $data['ip_address_engine'] : null;
        
       
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

        
           $inputFilter->add([
            'name' => 'id_candidat',
            'required' => false,
            'filters' => [
                ['name' => ToInt::class],
            ],
         ]);

           $inputFilter->add([
            'name' => 'fullname',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'tel',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'subject',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
         'name' => 'diplome_obtenu',
         'required' => true,
         'filters' => [
             ['name' => StripTags::class],
             ['name' => StringTrim::class],
         ],
         'validators' => [
             [
                 'name' => StringLength::class,
                 'options' => [
                     'encoding' => 'UTF-8',
                     'min' => 1,
                     'max' => 255,
                 ],
             ],
            ],
         ]);

         $inputFilter->add([
            'name' => 'niveau_etude',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                    ],
                ],
               ],
            ]);


            $inputFilter->add([
               'name' => 'filiere',
               'required' => true,
               'filters' => [
                   ['name' => StripTags::class],
                   ['name' => StringTrim::class],
               ],
               'validators' => [
                   [
                       'name' => StringLength::class,
                       'options' => [
                           'encoding' => 'UTF-8',
                           'min' => 1,
                           'max' => 255,
                       ],
                   ],
                  ],
               ]);


            $inputFilter->add([
                  'name' => 'ville',
                  'required' => true,
                  'filters' => [
                      ['name' => StripTags::class],
                      ['name' => StringTrim::class],
                  ],
                  'validators' => [
                      [
                          'name' => StringLength::class,
                          'options' => [
                              'encoding' => 'UTF-8',
                              'min' => 1,
                              'max' => 255,
                          ],
                      ],
                     ],
            ]);

            $inputFilter->add([
               'name' => 'pays_destination',
               'required' => true,
               'filters' => [
                   ['name' => StripTags::class],
                   ['name' => StringTrim::class],
               ],
               'validators' => [
                   [
                       'name' => StringLength::class,
                       'options' => [
                           'encoding' => 'UTF-8',
                           'min' => 1,
                           'max' => 255,
                       ],
                   ],
                  ],
               ]);

               $inputFilter->add([
                  'name' => 'diplome_langue',
                  'required' => true,
                  'filters' => [
                      ['name' => StripTags::class],
                      ['name' => StringTrim::class],
                  ],
                  'validators' => [
                      [
                          'name' => StringLength::class,
                          'options' => [
                              'encoding' => 'UTF-8',
                              'min' => 1,
                              'max' => 255,
                          ],
                      ],
                     ],
                  ]);


                  $inputFilter->add([
                     'name' => 'langue_etude',
                     'required' => true,
                     'filters' => [
                         ['name' => StripTags::class],
                         ['name' => StringTrim::class],
                     ],
                     'validators' => [
                         [
                             'name' => StringLength::class,
                             'options' => [
                                 'encoding' => 'UTF-8',
                                 'min' => 1,
                                 'max' => 255,
                             ],
                         ],
                        ],
                     ]);

        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'message',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                    ],
                ],
            ],
        ]);
           
           
         
           
           
        
           
            
 
           

           $this->inputFilter = $inputFilter;
       }

       return $this->inputFilter;
   }

   /**
    * Get the value of id_candidat
    */ 
   public function getId_candidat()
   {
      return $this->id_candidat;
   }

   /**
    * Set the value of id_candidat
    *
    * @return  self
    */ 
   public function setId_candidat($id_candidat)
   {
      $this->id_candidat = $id_candidat;

      return $this;
   }

   /**
    * Get the value of fullname
    */ 
   public function getFullname()
   {
      return $this->fullname;
   }

   /**
    * Set the value of fullname
    *
    * @return  self
    */ 
   public function setFullname($name)
   {
      $this->fullname = $name;

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
    * Get the value of subject
    */ 
   public function getSubject()
   {
      return $this->subject;
   }

   /**
    * Set the value of subject
    *
    * @return  self
    */ 
   public function setSubject($subject)
   {
      $this->subject = $subject;

      return $this;
   }

  

    
 
   

   /**
    * Get the value of message
    */ 
   public function getMessage()
   {
      return $this->message;
   }

   /**
    * Set the value of message
    *
    * @return  self
    */ 
   public function setMessage($message)
   {
      $this->message = $message;

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
    * Get the value of search_engine
    */ 
    public function getSearch_engine()
    {
       return $this->search_engine;
    }
 
    /**
     * Set the value of search_engine
     *
     * @return  self
     */ 
    public function setSearch_engine($search_engine)
    {
       $this->search_engine = $search_engine;
 
       return $this;
    }


       /**
    * Get the value of device_engine
    */ 
    public function getDevice_engine()
    {
       return $this->device_engine;
    }
 
    /**
     * Set the value of device_engine
     *
     * @return  self
     */ 
    public function setDevice_engine($device_engine)
    {
       $this->device_engine = $device_engine;
 
       return $this;
    }


        /**
    * Get the value of forward_link_engine
    */ 
    public function getForward_link_engine()
    {
       return $this->forward_link_engine;
    }
 
    /**
     * Set the value of forward_link_engine
     *
     * @return  self
     */ 
    public function setForward_link_engine($forward_link_engine)
    {
       $this->forward_link_engine = $forward_link_engine;
 
       return $this;
    }
 

        /**
    * Get the value of country_engine
    */ 
    public function getCountry_engine()
    {
       return $this->country_engine;
    }
 
    /**
     * Set the value of country_engine
     *
     * @return  self
     */ 
    public function setCountry_engine($country_engine)
    {
       $this->country_engine = $country_engine;
 
       return $this;
    }


         /**
    * Get the value of country_code_engine
    */ 
    public function getCountry_code_engine()
    {
       return $this->country_code_engine;
    }
 
    /**
     * Set the value of country_code_engine
     *
     * @return  self
     */ 
    public function setCountry_code_engine($country_code_engine)
    {
       $this->country_code_engine = $country_code_engine;
 
       return $this;
    }


           /**
    * Get the value of region_code_engine
    */ 
    public function getRegion_code_engine()
    {
       return $this->region_code_engine;
    }
 
    /**
     * Set the value of region_code_engine
     *
     * @return  self
     */ 
    public function setRegion_code_engine($region_code_engine)
    {
       $this->region_code_engine = $region_code_engine;
 
       return $this;
    }


           /**
    * Get the value of region_name_engine
    */ 
    public function getRegion_name_engine()
    {
       return $this->region_name_engine;
    }
 
    /**
     * Set the value of region_name_engine
     *
     * @return  self
     */ 
    public function setRegion_name_engine($region_name_engine)
    {
       $this->region_name_engine = $region_name_engine;
 
       return $this;
    }


            /**
    * Get the value of city_engine
    */ 
    public function getCity_engine()
    {
       return $this->city_engine;
    }
 
    /**
     * Set the value of city_engine
     *
     * @return  self
     */ 
    public function setCity_engine($city_engine)
    {
       $this->city_engine = $city_engine;
 
       return $this;
    }


            /**
    * Get the value of zip_engine
    */ 
    public function getZip_engine()
    {
       return $this->zip_engine;
    }
 
    /**
     * Set the value of zip_engine
     *
     * @return  self
     */ 
    public function setZip_engine($zip_engine)
    {
       $this->zip_engine = $zip_engine;
 
       return $this;
    }


              /**
    * Get the value of lat_engine
    */ 
    public function getLat_engine()
    {
       return $this->lat_engine;
    }
 
    /**
     * Set the value of lat_engine
     *
     * @return  self
     */ 
    public function setLat_engine($lat_engine)
    {
       $this->lat_engine = $lat_engine;
 
       return $this;
    }


              /**
    * Get the value of lon_engine
    */ 
    public function getLon_engine()
    {
       return $this->lon_engine;
    }
 
    /**
     * Set the value of lon_engine
     *
     * @return  self
     */ 
    public function setLon_engine($lon_engine)
    {
       $this->lon_engine = $lon_engine;
 
       return $this;
    }


                 /**
    * Get the value of timezone_engine
    */ 
    public function getTimezone_engine()
    {
       return $this->timezone_engine;
    }
 
    /**
     * Set the value of timezone_engine
     *
     * @return  self
     */ 
    public function setTimezone_engine($timezone_engine)
    {
       $this->timezone_engine = $timezone_engine;
 
       return $this;
    }



                   /**
    * Get the value of isp_modem_internet_engine
    */ 
    public function getIsp_modem_internet_engine()
    {
       return $this->isp_modem_internet_engine;
    }
 
    /**
     * Set the value of isp_modem_internet_engine
     *
     * @return  self
     */ 
    public function setIsp_modem_internet_engine($isp_modem_internet_engine)
    {
       $this->isp_modem_internet_engine = $isp_modem_internet_engine;
 
       return $this;
    }


    /**
    * Get the value of org_modem_engine
    */ 
    public function getOrg_modem_engine()
    {
       return $this->org_modem_engine;
    }
 
    /**
     * Set the value of org_modem_engine
     *
     * @return  self
     */ 
    public function setOrg_modem_engine($org_modem_engine)
    {
       $this->org_modem_engine = $org_modem_engine;
 
       return $this;
    }



       /**
    * Get the value of as_modem_engine
    */ 
    public function getAs_modem_engine()
    {
       return $this->as_modem_engine;
    }
 
    /**
     * Set the value of as_modem_engine
     *
     * @return  self
     */ 
    public function setAs_modem_engine($as_modem_engine)
    {
       $this->as_modem_engine = $as_modem_engine;
 
       return $this;
    }



           /**
    * Get the value of ip_address_engine
    */ 
    public function getIp_address_engine()
    {
       return $this->ip_address_engine;
    }
 
    /**
     * Set the value of ip_address_engine
     *
     * @return  self
     */ 
    public function setIp_address_engine($ip_address_engine)
    {
       $this->ip_address_engine = $ip_address_engine;
 
       return $this;
    }

   /**
    * Get the value of diplome_obtenu
    */ 
    public function getDiplomeObtenu()
    {
       return $this->diplome_obtenu;
    }
 
    /**
     * Set the value of diplome_obtenu
     *
     * @return  self
     */ 
    public function setDiplomeObtenu($value)
    {
       $this->diplome_obtenu = $value;
 
       return $this;
    }

    /**
    * Get the value of niveau_etude
    */ 
    public function getNiveauEtude()
    {
       return $this->niveau_etude;
    }
 
    /**
     * Set the value of niveau_etude
     *
     * @return  self
     */ 
    public function setNiveauEtude($value)
    {
       $this->niveau_etude = $value;
 
       return $this;
    }
 
 
    /**
    * Get the value of ville
    */ 
    public function getVille()
    {
       return $this->ville;
    }
 
    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($value)
    {
       $this->ville = $value;
 
       return $this;
    }


    /**
    * Get the value of pays_destination
    */ 
    public function getPaysDestination()
    {
       return $this->pays_destination;
    }
 
    /**
     * Set the value of pays_destination
     *
     * @return  self
     */ 
    public function setPaysDestination($value)
    {
       $this->pays_destination = $value;
 
       return $this;
    }
 

    /**
    * Get the value of filiere
    */ 
    public function getFiliere()
    {
       return $this->filiere;
    }
 
    /**
     * Set the value of filiere
     *
     * @return  self
     */ 
    public function setFiliere($value)
    {
       $this->filiere = $value;
 
       return $this;
    }


        /**
    * Get the value of diplome_langue
    */ 
    public function getDiplomeLangue()
    {
       return $this->diplome_langue;
    }
 
    /**
     * Set the value of diplome_langue
     *
     * @return  self
     */ 
    public function setDiplomeLangue($value)
    {
       $this->diplome_langue = $value;
 
       return $this;
    }
   
    /**
    * Get the value of langue_etude
    */ 
    public function getLangueEtude()
    {
       return $this->langue_etude;
    }
 
    /**
     * Set the value of langue_etude
     *
     * @return  self
     */ 
    public function setLangueEtude($value)
    {
       $this->langue_etude = $value;
 
       return $this;
    }
 
 
 
 
 
 
 
 
 
}





?>
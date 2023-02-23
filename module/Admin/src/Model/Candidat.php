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
   private $created_at;
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




   private $cin_candidat;
   private $nom_candidat;
   private $prenom_candidat;
   private $date_naiss_candidat; 
   private $lieu_naiss_candidat;
   private $nationalite_candidat;
   private $sexe_candidat;
   private $civilite_candidat;
   private $tel_candidat;
   private $adresse_candidat;
   private $ville_candidat;
   private $code_postal_candidat;
   private $pays_candidat;
   private $email_candidat;
   private $num_passport;
   private $date_delivrance_passport;
   private $date_dexpiration_passport;
   private $lieu_delivrance_passport;

   /**
    * parcours actuel
    */
   private $diplome_obtenu;
   private $option_diplome_candidat;
   private $annee_obtention_diplome_candidat;
   private $etab_delivre_diplome_candidat;

   private $niveau_etude;
   private $diplome_langue;
   private $langue_etude;

   /**
    * programme demandé
    */
   private $pays_demande;
   private $ville_demande;
   private $etablissement_demande;
   private $discipline_demande;
   private $specialite_demande;
   private $qualification_demande;
   private $langue_etude_demande;
   private $niveau_linguistique_demande;
   private $diplome_langue_demande;



  /**
   * père
   */
   private $type_pere;
   private $nom_pere;
   private $prenom_pere;
   private $date_naiss_pere;
   private $nationalite_pere;
   private $lieu_naiss_pere;
   private $cin_pere;
   private $tel_pere;
   private $code_postal_pere;
   private $adresse_pere;
   private $ville_pere;
   private $pays_pere;
   private $email_pere;
   private $profession_pere;

   /**
    * mère
    */
   private $type_mere;
   private $nom_mere;
   private $prenom_mere;
   private $date_naiss_mere;
   private $nationalite_mere;
   private $lieu_naiss_mere;
   private $cin_mere;
   private $tel_mere;
   private $code_postal_mere;
   private $adresse_mere;
   private $ville_mere;
   private $pays_mere;
   private $email_mere;
   private $profession_mere;
    
   
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
       $this->created_at     = (!empty($data['created_at'])) ? $data['created_at'] : null;

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
  
       
      /**
       * les informations personnelles du candidat
       *  */     
       $this->cin_candidat     = (!empty($data['cin_candidat'])) ? $data['cin_candidat'] : null;
       $this->nom_candidat     = (!empty($data['nom_candidat'])) ? $data['nom_candidat'] : null;
       $this->prenom_candidat     = (!empty($data['prenom_candidat'])) ? $data['prenom_candidat'] : null;
       $this->date_naiss_candidat     = (!empty($data['date_naiss_candidat'])) ? $data['date_naiss_candidat'] : null;
       $this->lieu_naiss_candidat     = (!empty($data['lieu_naiss_candidat'])) ? $data['lieu_naiss_candidat'] : null;
       $this->nationalite_candidat     = (!empty($data['nationalite_candidat'])) ? $data['nationalite_candidat'] : null;
       $this->sexe_candidat     = (!empty($data['sexe_candidat'])) ? $data['sexe_candidat'] : null;
       $this->civilite_candidat     = (!empty($data['civilite_candidat'])) ? $data['civilite_candidat'] : null;
       $this->tel_candidat     = (!empty($data['tel_candidat'])) ? $data['tel_candidat'] : null;
       $this->adresse_candidat     = (!empty($data['adresse_candidat'])) ? $data['adresse_candidat'] : null;
       $this->ville_candidat     = (!empty($data['ville_candidat'])) ? $data['ville_candidat'] : null;
       $this->code_postal_candidat     = (!empty($data['code_postal_candidat'])) ? $data['code_postal_candidat'] : null;
       $this->pays_candidat     = (!empty($data['pays_candidat'])) ? $data['pays_candidat'] : null;
       $this->email_candidat     = (!empty($data['email_candidat'])) ? $data['email_candidat'] : null;
       $this->num_passport     = (!empty($data['num_passport'])) ? $data['num_passport'] : null;
       $this->date_delivrance_passport     = (!empty($data['date_delivrance_passport'])) ? $data['date_delivrance_passport'] : null;
       $this->date_dexpiration_passport     = (!empty($data['date_dexpiration_passport'])) ? $data['date_dexpiration_passport'] : null;
       $this->lieu_delivrance_passport     = (!empty($data['lieu_delivrance_passport'])) ? $data['lieu_delivrance_passport'] : null;
       
       /**
        * diplome et parcours
        */

       $this->diplome_obtenu     = (!empty($data['diplome_obtenu'])) ? $data['diplome_obtenu'] : null;
       $this->option_diplome_candidat     = (!empty($data['option_diplome_candidat'])) ? $data['option_diplome_candidat'] : null;
       $this->annee_obtention_diplome_candidat     = (!empty($data['annee_obtention_diplome_candidat'])) ? $data['annee_obtention_diplome_candidat'] : null;
       $this->etab_delivre_diplome_candidat     = (!empty($data['etab_delivre_diplome_candidat'])) ? $data['etab_delivre_diplome_candidat'] : null;
       


       $this->niveau_etude     = (!empty($data['niveau_etude'])) ? $data['niveau_etude'] : null;
       $this->diplome_langue     = (!empty($data['diplome_langue'])) ? $data['diplome_langue'] : null;
       $this->langue_etude     = (!empty($data['langue_etude'])) ? $data['langue_etude'] : null;

       /**
        * programme demandé
        */
       $this->pays_demande     = (!empty($data['pays_demande'])) ? $data['pays_demande'] : null;
       $this->ville_demande     = (!empty($data['ville_demande'])) ? $data['ville_demande'] : null;
       $this->etablissement_demande     = (!empty($data['etablissement_demande'])) ? $data['etablissement_demande'] : null;
       $this->discipline_demande     = (!empty($data['discipline_demande'])) ? $data['discipline_demande'] : null;
       $this->specialite_demande     = (!empty($data['specialite_demande'])) ? $data['specialite_demande'] : null;
       $this->qualification_demande     = (!empty($data['qualification_demande'])) ? $data['qualification_demande'] : null;
       $this->langue_etude_demande     = (!empty($data['langue_etude_demande'])) ? $data['langue_etude_demande'] : null;
       $this->niveau_linguistique_demande     = (!empty($data['niveau_linguistique_demande'])) ? $data['niveau_linguistique_demande'] : null;
       $this->diplome_langue_demande     = (!empty($data['diplome_langue_demande'])) ? $data['diplome_langue_demande'] : null;

      /**
       * identification du père
       */

      $this->type_pere     = (!empty($data['type_pere'])) ? $data['type_pere'] : null;
      $this->nom_pere     = (!empty($data['nom_pere'])) ? $data['nom_pere'] : null;
      $this->prenom_pere     = (!empty($data['prenom_pere'])) ? $data['prenom_pere'] : null;
      $this->date_naiss_pere     = (!empty($data['date_naiss_pere'])) ? $data['date_naiss_pere'] : null;
      $this->nationalite_pere     = (!empty($data['nationalite_pere'])) ? $data['nationalite_pere'] : null;
      $this->lieu_naiss_pere     = (!empty($data['lieu_naiss_pere'])) ? $data['lieu_naiss_pere'] : null;
      $this->cin_pere     = (!empty($data['cin_pere'])) ? $data['cin_pere'] : null;
      $this->tel_pere     = (!empty($data['tel_pere'])) ? $data['tel_pere'] : null;
      $this->code_postal_pere     = (!empty($data['code_postal_pere'])) ? $data['code_postal_pere'] : null;
      $this->adresse_pere     = (!empty($data['adresse_pere'])) ? $data['adresse_pere'] : null;
      $this->ville_pere     = (!empty($data['ville_pere'])) ? $data['ville_pere'] : null;
      $this->pays_pere     = (!empty($data['pays_pere'])) ? $data['pays_pere'] : null;
      $this->email_pere     = (!empty($data['email_pere'])) ? $data['email_pere'] : null;
      $this->profession_pere     = (!empty($data['profession_pere'])) ? $data['profession_pere'] : null;


      /**
       * identification de la mère
       */
       
      $this->type_mere     = (!empty($data['type_mere'])) ? $data['type_mere'] : null;
      $this->nom_mere     = (!empty($data['nom_mere'])) ? $data['nom_mere'] : null;
      $this->prenom_mere     = (!empty($data['prenom_mere'])) ? $data['prenom_mere'] : null;
      $this->date_naiss_mere     = (!empty($data['date_naiss_mere'])) ? $data['date_naiss_mere'] : null;
      $this->nationalite_mere     = (!empty($data['nationalite_mere'])) ? $data['nationalite_mere'] : null;
      $this->lieu_naiss_mere     = (!empty($data['lieu_naiss_mere'])) ? $data['lieu_naiss_mere'] : null;
      $this->cin_mere     = (!empty($data['cin_mere'])) ? $data['cin_mere'] : null;
      $this->tel_mere     = (!empty($data['tel_mere'])) ? $data['tel_mere'] : null;
      $this->code_postal_mere     = (!empty($data['code_postal_mere'])) ? $data['code_postal_mere'] : null;
      $this->adresse_mere     = (!empty($data['adresse_mere'])) ? $data['adresse_mere'] : null;
      $this->ville_mere     = (!empty($data['ville_mere'])) ? $data['ville_mere'] : null;
      $this->pays_mere     = (!empty($data['pays_mere'])) ? $data['pays_mere'] : null;
      $this->email_mere     = (!empty($data['email_mere'])) ? $data['email_mere'] : null;
      $this->profession_mere     = (!empty($data['profession_mere'])) ? $data['profession_mere'] : null;
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
            'required' => false,
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
            'required' => false,
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
            'required' => false,
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
            'name' => 'email',
            'required' => false,
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
            'required' => false,
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
         'name' => 'diplome_obtenu',
         'required' => false,
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
            'required' => false,
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
               'required' => false,
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
               'required' => false,
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
                        'name' => 'cin_candidat',
                        'required' => false,
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
                           'name' => 'nom_candidat',
                           'required' => false,
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
                        'name' => 'prenom_candidat',
                        'required' => false,
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
                           'name' => 'date_naiss_candidat',
                           'required' => false,
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
                              'name' => 'lieu_naiss_candidat',
                              'required' => false,
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
                                 'name' => 'nationalite_candidat',
                                 'required' => false,
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
                                    'name' => 'sexe_candidat',
                                    'required' => false,
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
                                       'name' => 'civilite_candidat',
                                       'required' => false,
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
                                          'name' => 'tel_candidat',
                                          'required' => false,
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
                                             'name' => 'adresse_candidat',
                                             'required' => false,
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
                                                'name' => 'ville_candidat',
                                                'required' => false,
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
                                                   'name' => 'code_postal_candidat',
                                                   'required' => false,
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
                                                      'name' => 'pays_candidat',
                                                      'required' => false,
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
                                                         'name' => 'email_candidat',
                                                         'required' => false,
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
                                                            'name' => 'num_passport',
                                                            'required' => false,
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
            'name' => 'date_delivrance_passport',
            'required' => false,
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
               'name' => 'date_dexpiration_passport',
               'required' => false,
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
                  'name' => 'lieu_delivrance_passport',
                  'required' => false,
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
                  'name' => 'option_diplome_candidat',
                  'required' => false,
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
                  'name' => 'annee_obtention_diplome_candidat',
                  'required' => false,
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
                  'name' => 'etab_delivre_diplome_candidat',
                  'required' => false,
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
                  'name' => 'pays_demande',
                  'required' => false,
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
                  'name' => 'ville_demande',
                  'required' => false,
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
                  'name' => 'etablissement_demande',
                  'required' => false,
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
                  'name' => 'discipline_demande',
                  'required' => false,
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
                  'name' => 'specialite_demande',
                  'required' => false,
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
                  'name' => 'qualification_demande',
                  'required' => false,
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
                  'name' => 'langue_etude_demande',
                  'required' => false,
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
                  'name' => 'niveau_linguistique_demande',
                  'required' => false,
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
                  'name' => 'diplome_langue_demande',
                  'required' => false,
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
                  'name' => 'type_pere',
                  'required' => false,
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
                  'name' => 'nom_pere',
                  'required' => false,
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
                  'name' => 'prenom_pere',
                  'required' => false,
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
                  'name' => 'date_naiss_pere',
                  'required' => false,
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
                  'name' => 'nationalite_pere',
                  'required' => false,
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
                  'name' => 'lieu_naiss_pere',
                  'required' => false,
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
                  'name' => 'cin_pere',
                  'required' => false,
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
                  'name' => 'tel_pere',
                  'required' => false,
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
                  'name' => 'code_postal_pere',
                  'required' => false,
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
                  'name' => 'adresse_pere',
                  'required' => false,
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
                  'name' => 'ville_pere',
                  'required' => false,
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
                  'name' => 'pays_pere',
                  'required' => false,
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
                  'name' => 'email_pere',
                  'required' => false,
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
                  'name' => 'profession_pere',
                  'required' => false,
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

                   /**
                    * mère
                    */

                  $inputFilter->add([
                  'name' => 'type_mere',
                  'required' => false,
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
                  'name' => 'nom_mere',
                  'required' => false,
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
                  'name' => 'prenom_mere',
                  'required' => false,
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
                  'name' => 'date_naiss_mere',
                  'required' => false,
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
                  'name' => 'nationalite_mere',
                  'required' => false,
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
                  'name' => 'lieu_naiss_mere',
                  'required' => false,
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
                  'name' => 'cin_mere',
                  'required' => false,
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
                  'name' => 'tel_mere',
                  'required' => false,
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
                  'name' => 'code_postal_mere',
                  'required' => false,
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
                  'name' => 'adresse_mere',
                  'required' => false,
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
                  'name' => 'ville_mere',
                  'required' => false,
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
                  'name' => 'pays_mere',
                  'required' => false,
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
                  'name' => 'email_mere',
                  'required' => false,
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
                  'name' => 'profession_mere',
                  'required' => false,
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
    * Get the value of created at
    */ 
    public function getCreated_at()
    {
       return $this->created_at;
    }
 
    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
       $this->created_at = $create_at;
 
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
    * Get the value of cin_candidat
    */ 
   public function getCin_candidat()
   {
      return $this->cin_candidat;
   }

   /**
    * Set the value of cin_candidat
    *
    * @return  self
    */ 
   public function setCin_candidat($cin_candidat)
   {
      $this->cin_candidat = $cin_candidat;

      return $this;
   }

   /**
    * Get the value of nom_candidat
    */ 
   public function getNom_candidat()
   {
      return $this->nom_candidat;
   }

   /**
    * Set the value of nom_candidat
    *
    * @return  self
    */ 
   public function setNom_candidat($nom_candidat)
   {
      $this->nom_candidat = $nom_candidat;

      return $this;
   }

   /**
    * Get the value of prenom_candidat
    */ 
   public function getPrenom_candidat()
   {
      return $this->prenom_candidat;
   }

   /**
    * Set the value of prenom_candidat
    *
    * @return  self
    */ 
   public function setPrenom_candidat($prenom_candidat)
   {
      $this->prenom_candidat = $prenom_candidat;

      return $this;
   }

   /**
    * Get the value of lieu_naiss_candidat
    */ 
   public function getLieu_naiss_candidat()
   {
      return $this->lieu_naiss_candidat;
   }

   /**
    * Set the value of lieu_naiss_candidat
    *
    * @return  self
    */ 
   public function setLieu_naiss_candidat($lieu_naiss_candidat)
   {
      $this->lieu_naiss_candidat = $lieu_naiss_candidat;

      return $this;
   }

   /**
    * Get the value of date_naiss_candidat
    */ 
   public function getDate_naiss_candidat()
   {
      return $this->date_naiss_candidat;
   }

   /**
    * Set the value of date_naiss_candidat
    *
    * @return  self
    */ 
   public function setDate_naiss_candidat($date_naiss_candidat)
   {
      $this->date_naiss_candidat = $date_naiss_candidat;

      return $this;
   }

   /**
    * Get the value of nationalite_candidat
    */ 
   public function getNationalite_candidat()
   {
      return $this->nationalite_candidat;
   }

   /**
    * Set the value of nationalite_candidat
    *
    * @return  self
    */ 
   public function setNationalite_candidat($nationalite_candidat)
   {
      $this->nationalite_candidat = $nationalite_candidat;

      return $this;
   }

   /**
    * Get the value of sexe_candidat
    */ 
   public function getSexe_candidat()
   {
      return $this->sexe_candidat;
   }

   /**
    * Set the value of sexe_candidat
    *
    * @return  self
    */ 
   public function setSexe_candidat($sexe_candidat)
   {
      $this->sexe_candidat = $sexe_candidat;

      return $this;
   }

   /**
    * Get the value of civilite_candidat
    */ 
   public function getCivilite_candidat()
   {
      return $this->civilite_candidat;
   }

   /**
    * Set the value of civilite_candidat
    *
    * @return  self
    */ 
   public function setCivilite_candidat($civilite_candidat)
   {
      $this->civilite_candidat = $civilite_candidat;

      return $this;
   }

   /**
    * Get the value of tel_candidat
    */ 
   public function getTel_candidat()
   {
      return $this->tel_candidat;
   }

   /**
    * Set the value of tel_candidat
    *
    * @return  self
    */ 
   public function setTel_candidat($tel_candidat)
   {
      $this->tel_candidat = $tel_candidat;

      return $this;
   }

   /**
    * Get the value of adresse_candidat
    */ 
   public function getAdresse_candidat()
   {
      return $this->adresse_candidat;
   }

   /**
    * Set the value of adresse_candidat
    *
    * @return  self
    */ 
   public function setAdresse_candidat($adresse_candidat)
   {
      $this->adresse_candidat = $adresse_candidat;

      return $this;
   }

   /**
    * Get the value of ville_candidat
    */ 
   public function getVille_candidat()
   {
      return $this->ville_candidat;
   }

   /**
    * Set the value of ville_candidat
    *
    * @return  self
    */ 
   public function setVille_candidat($ville_candidat)
   {
      $this->ville_candidat = $ville_candidat;

      return $this;
   }

   /**
    * Get the value of code_postal_candidat
    */ 
   public function getCode_postal_candidat()
   {
      return $this->code_postal_candidat;
   }

   /**
    * Set the value of code_postal_candidat
    *
    * @return  self
    */ 
   public function setCode_postal_candidat($code_postal_candidat)
   {
      $this->code_postal_candidat = $code_postal_candidat;

      return $this;
   }

   /**
    * Get the value of pays_candidat
    */ 
   public function getPays_candidat()
   {
      return $this->pays_candidat;
   }

   /**
    * Set the value of pays_candidat
    *
    * @return  self
    */ 
   public function setPays_candidat($pays_candidat)
   {
      $this->pays_candidat = $pays_candidat;

      return $this;
   }

   /**
    * Get the value of email_candidat
    */ 
   public function getEmail_candidat()
   {
      return $this->email_candidat;
   }

   /**
    * Set the value of email_candidat
    *
    * @return  self
    */ 
   public function setEmail_candidat($email_candidat)
   {
      $this->email_candidat = $email_candidat;

      return $this;
   }

   /**
    * Get the value of num_passport
    */ 
   public function getNum_passport()
   {
      return $this->num_passport;
   }

   /**
    * Set the value of num_passport
    *
    * @return  self
    */ 
   public function setNum_passport($num_passport)
   {
      $this->num_passport = $num_passport;

      return $this;
   }

   /**
    * Get the value of date_delivrance_passport
    */ 
   public function getDate_delivrance_passport()
   {
      return $this->date_delivrance_passport;
   }

   /**
    * Set the value of date_delivrance_passport
    *
    * @return  self
    */ 
   public function setDate_delivrance_passport($date_delivrance_passport)
   {
      $this->date_delivrance_passport = $date_delivrance_passport;

      return $this;
   }

   /**
    * Get the value of date_dexpiration_passport
    */ 
   public function getDate_dexpiration_passport()
   {
      return $this->date_dexpiration_passport;
   }

   /**
    * Set the value of date_dexpiration_passport
    *
    * @return  self
    */ 
   public function setDate_dexpiration_passport($date_dexpiration_passport)
   {
      $this->date_dexpiration_passport = $date_dexpiration_passport;

      return $this;
   }

   /**
    * Get the value of lieu_delivrance_passport
    */ 
   public function getLieu_delivrance_passport()
   {
      return $this->lieu_delivrance_passport;
   }

   /**
    * Set the value of lieu_delivrance_passport
    *
    * @return  self
    */ 
   public function setLieu_delivrance_passport($lieu_delivrance_passport)
   {
      $this->lieu_delivrance_passport = $lieu_delivrance_passport;

      return $this;
   }

   /**
    * Get parcours actuel
    */ 
   public function getDiplome_obtenu()
   {
      return $this->diplome_obtenu;
   }

   /**
    * Set parcours actuel
    *
    * @return  self
    */ 
   public function setDiplome_obtenu($diplome_obtenu)
   {
      $this->diplome_obtenu = $diplome_obtenu;

      return $this;
   }

   /**
    * Get the value of option_diplome_candidat
    */ 
   public function getOption_diplome_candidat()
   {
      return $this->option_diplome_candidat;
   }

   /**
    * Set the value of option_diplome_candidat
    *
    * @return  self
    */ 
   public function setOption_diplome_candidat($option_diplome_candidat)
   {
      $this->option_diplome_candidat = $option_diplome_candidat;

      return $this;
   }

   /**
    * Get the value of annee_obtention_diplome_candidat
    */ 
   public function getAnnee_obtention_diplome_candidat()
   {
      return $this->annee_obtention_diplome_candidat;
   }

   /**
    * Set the value of annee_obtention_diplome_candidat
    *
    * @return  self
    */ 
   public function setAnnee_obtention_diplome_candidat($annee_obtention_diplome_candidat)
   {
      $this->annee_obtention_diplome_candidat = $annee_obtention_diplome_candidat;

      return $this;
   }

   /**
    * Get the value of etab_delivre_diplome_candidat
    */ 
   public function getEtab_delivre_diplome_candidat()
   {
      return $this->etab_delivre_diplome_candidat;
   }

   /**
    * Set the value of etab_delivre_diplome_candidat
    *
    * @return  self
    */ 
   public function setEtab_delivre_diplome_candidat($etab_delivre_diplome_candidat)
   {
      $this->etab_delivre_diplome_candidat = $etab_delivre_diplome_candidat;

      return $this;
   }

   /**
    * Get programme demandé
    */ 
   public function getPays_demande()
   {
      return $this->pays_demande;
   }

   /**
    * Set programme demandé
    *
    * @return  self
    */ 
   public function setPays_demande($pays_demande)
   {
      $this->pays_demande = $pays_demande;

      return $this;
   }

   /**
    * Get the value of ville_demande
    */ 
   public function getVille_demande()
   {
      return $this->ville_demande;
   }

   /**
    * Set the value of ville_demande
    *
    * @return  self
    */ 
   public function setVille_demande($ville_demande)
   {
      $this->ville_demande = $ville_demande;

      return $this;
   }

   /**
    * Get the value of etablissement_demande
    */ 
   public function getEtablissement_demande()
   {
      return $this->etablissement_demande;
   }

   /**
    * Set the value of etablissement_demande
    *
    * @return  self
    */ 
   public function setEtablissement_demande($etablissement_demande)
   {
      $this->etablissement_demande = $etablissement_demande;

      return $this;
   }

   /**
    * Get the value of discipline_demande
    */ 
   public function getDiscipline_demande()
   {
      return $this->discipline_demande;
   }

   /**
    * Set the value of discipline_demande
    *
    * @return  self
    */ 
   public function setDiscipline_demande($discipline_demande)
   {
      $this->discipline_demande = $discipline_demande;

      return $this;
   }

   /**
    * Get the value of specialite_demande
    */ 
   public function getSpecialite_demande()
   {
      return $this->specialite_demande;
   }

   /**
    * Set the value of specialite_demande
    *
    * @return  self
    */ 
   public function setSpecialite_demande($specialite_demande)
   {
      $this->specialite_demande = $specialite_demande;

      return $this;
   }

   /**
    * Get the value of qualification_demande
    */ 
   public function getQualification_demande()
   {
      return $this->qualification_demande;
   }

   /**
    * Set the value of qualification_demande
    *
    * @return  self
    */ 
   public function setQualification_demande($qualification_demande)
   {
      $this->qualification_demande = $qualification_demande;

      return $this;
   }

   /**
    * Get the value of langue_etude_demande
    */ 
   public function getLangue_etude_demande()
   {
      return $this->langue_etude_demande;
   }

   /**
    * Set the value of langue_etude_demande
    *
    * @return  self
    */ 
   public function setLangue_etude_demande($langue_etude_demande)
   {
      $this->langue_etude_demande = $langue_etude_demande;

      return $this;
   }

   /**
    * Get the value of niveau_linguistique_demande
    */ 
   public function getNiveau_linguistique_demande()
   {
      return $this->niveau_linguistique_demande;
   }

   /**
    * Set the value of niveau_linguistique_demande
    *
    * @return  self
    */ 
   public function setNiveau_linguistique_demande($niveau_linguistique_demande)
   {
      $this->niveau_linguistique_demande = $niveau_linguistique_demande;

      return $this;
   }

   /**
    * Get the value of diplome_langue_demande
    */ 
   public function getDiplome_langue_demande()
   {
      return $this->diplome_langue_demande;
   }

   /**
    * Set the value of diplome_langue_demande
    *
    * @return  self
    */ 
   public function setDiplome_langue_demande($diplome_langue_demande)
   {
      $this->diplome_langue_demande = $diplome_langue_demande;

      return $this;
   }

   /**
    * Get père
    */ 
   public function getType_pere()
   {
      return $this->type_pere;
   }

   /**
    * Set père
    *
    * @return  self
    */ 
   public function setType_pere($type_pere)
   {
      $this->type_pere = $type_pere;

      return $this;
   }

   /**
    * Get the value of nom_pere
    */ 
   public function getNom_pere()
   {
      return $this->nom_pere;
   }

   /**
    * Set the value of nom_pere
    *
    * @return  self
    */ 
   public function setNom_pere($nom_pere)
   {
      $this->nom_pere = $nom_pere;

      return $this;
   }

   /**
    * Get the value of prenom_pere
    */ 
   public function getPrenom_pere()
   {
      return $this->prenom_pere;
   }

   /**
    * Set the value of prenom_pere
    *
    * @return  self
    */ 
   public function setPrenom_pere($prenom_pere)
   {
      $this->prenom_pere = $prenom_pere;

      return $this;
   }

   /**
    * Get the value of date_naiss_pere
    */ 
   public function getDate_naiss_pere()
   {
      return $this->date_naiss_pere;
   }

   /**
    * Set the value of date_naiss_pere
    *
    * @return  self
    */ 
   public function setDate_naiss_pere($date_naiss_pere)
   {
      $this->date_naiss_pere = $date_naiss_pere;

      return $this;
   }

   /**
    * Get the value of nationalite_pere
    */ 
   public function getNationalite_pere()
   {
      return $this->nationalite_pere;
   }

   /**
    * Set the value of nationalite_pere
    *
    * @return  self
    */ 
   public function setNationalite_pere($nationalite_pere)
   {
      $this->nationalite_pere = $nationalite_pere;

      return $this;
   }

   /**
    * Get the value of lieu_naiss_pere
    */ 
   public function getLieu_naiss_pere()
   {
      return $this->lieu_naiss_pere;
   }

   /**
    * Set the value of lieu_naiss_pere
    *
    * @return  self
    */ 
   public function setLieu_naiss_pere($lieu_naiss_pere)
   {
      $this->lieu_naiss_pere = $lieu_naiss_pere;

      return $this;
   }

   /**
    * Get the value of cin_pere
    */ 
   public function getCin_pere()
   {
      return $this->cin_pere;
   }

   /**
    * Set the value of cin_pere
    *
    * @return  self
    */ 
   public function setCin_pere($cin_pere)
   {
      $this->cin_pere = $cin_pere;

      return $this;
   }

   /**
    * Get the value of tel_pere
    */ 
   public function getTel_pere()
   {
      return $this->tel_pere;
   }

   /**
    * Set the value of tel_pere
    *
    * @return  self
    */ 
   public function setTel_pere($tel_pere)
   {
      $this->tel_pere = $tel_pere;

      return $this;
   }

   /**
    * Get the value of code_postal_pere
    */ 
   public function getCode_postal_pere()
   {
      return $this->code_postal_pere;
   }

   /**
    * Set the value of code_postal_pere
    *
    * @return  self
    */ 
   public function setCode_postal_pere($code_postal_pere)
   {
      $this->code_postal_pere = $code_postal_pere;

      return $this;
   }

   /**
    * Get the value of adresse_pere
    */ 
   public function getAdresse_pere()
   {
      return $this->adresse_pere;
   }

   /**
    * Set the value of adresse_pere
    *
    * @return  self
    */ 
   public function setAdresse_pere($adresse_pere)
   {
      $this->adresse_pere = $adresse_pere;

      return $this;
   }

   /**
    * Get the value of ville_pere
    */ 
   public function getVille_pere()
   {
      return $this->ville_pere;
   }

   /**
    * Set the value of ville_pere
    *
    * @return  self
    */ 
   public function setVille_pere($ville_pere)
   {
      $this->ville_pere = $ville_pere;

      return $this;
   }

   /**
    * Get the value of pays_pere
    */ 
   public function getPays_pere()
   {
      return $this->pays_pere;
   }

   /**
    * Set the value of pays_pere
    *
    * @return  self
    */ 
   public function setPays_pere($pays_pere)
   {
      $this->pays_pere = $pays_pere;

      return $this;
   }

   /**
    * Get the value of email_pere
    */ 
   public function getEmail_pere()
   {
      return $this->email_pere;
   }

   /**
    * Set the value of email_pere
    *
    * @return  self
    */ 
   public function setEmail_pere($email_pere)
   {
      $this->email_pere = $email_pere;

      return $this;
   }

   /**
    * Get the value of profession_pere
    */ 
   public function getProfession_pere()
   {
      return $this->profession_pere;
   }

   /**
    * Set the value of profession_pere
    *
    * @return  self
    */ 
   public function setProfession_pere($profession_pere)
   {
      $this->profession_pere = $profession_pere;

      return $this;
   }

   /**
    * Get mère
    */ 
   public function getType_mere()
   {
      return $this->type_mere;
   }

   /**
    * Set mère
    *
    * @return  self
    */ 
   public function setType_mere($type_mere)
   {
      $this->type_mere = $type_mere;

      return $this;
   }

   /**
    * Get the value of nom_mere
    */ 
   public function getNom_mere()
   {
      return $this->nom_mere;
   }

   /**
    * Set the value of nom_mere
    *
    * @return  self
    */ 
   public function setNom_mere($nom_mere)
   {
      $this->nom_mere = $nom_mere;

      return $this;
   }

   /**
    * Get the value of prenom_mere
    */ 
   public function getPrenom_mere()
   {
      return $this->prenom_mere;
   }

   /**
    * Set the value of prenom_mere
    *
    * @return  self
    */ 
   public function setPrenom_mere($prenom_mere)
   {
      $this->prenom_mere = $prenom_mere;

      return $this;
   }

   /**
    * Get the value of date_naiss_mere
    */ 
   public function getDate_naiss_mere()
   {
      return $this->date_naiss_mere;
   }

   /**
    * Set the value of date_naiss_mere
    *
    * @return  self
    */ 
   public function setDate_naiss_mere($date_naiss_mere)
   {
      $this->date_naiss_mere = $date_naiss_mere;

      return $this;
   }

   /**
    * Get the value of nationalite_mere
    */ 
   public function getNationalite_mere()
   {
      return $this->nationalite_mere;
   }

   /**
    * Set the value of nationalite_mere
    *
    * @return  self
    */ 
   public function setNationalite_mere($nationalite_mere)
   {
      $this->nationalite_mere = $nationalite_mere;

      return $this;
   }

   /**
    * Get the value of lieu_naiss_mere
    */ 
   public function getLieu_naiss_mere()
   {
      return $this->lieu_naiss_mere;
   }

   /**
    * Set the value of lieu_naiss_mere
    *
    * @return  self
    */ 
   public function setLieu_naiss_mere($lieu_naiss_mere)
   {
      $this->lieu_naiss_mere = $lieu_naiss_mere;

      return $this;
   }

   /**
    * Get the value of cin_mere
    */ 
   public function getCin_mere()
   {
      return $this->cin_mere;
   }

   /**
    * Set the value of cin_mere
    *
    * @return  self
    */ 
   public function setCin_mere($cin_mere)
   {
      $this->cin_mere = $cin_mere;

      return $this;
   }

   /**
    * Get the value of tel_mere
    */ 
   public function getTel_mere()
   {
      return $this->tel_mere;
   }

   /**
    * Set the value of tel_mere
    *
    * @return  self
    */ 
   public function setTel_mere($tel_mere)
   {
      $this->tel_mere = $tel_mere;

      return $this;
   }

   /**
    * Get the value of code_postal_mere
    */ 
   public function getCode_postal_mere()
   {
      return $this->code_postal_mere;
   }

   /**
    * Set the value of code_postal_mere
    *
    * @return  self
    */ 
   public function setCode_postal_mere($code_postal_mere)
   {
      $this->code_postal_mere = $code_postal_mere;

      return $this;
   }

   /**
    * Get the value of adresse_mere
    */ 
   public function getAdresse_mere()
   {
      return $this->adresse_mere;
   }

   /**
    * Set the value of adresse_mere
    *
    * @return  self
    */ 
   public function setAdresse_mere($adresse_mere)
   {
      $this->adresse_mere = $adresse_mere;

      return $this;
   }

   /**
    * Get the value of ville_mere
    */ 
   public function getVille_mere()
   {
      return $this->ville_mere;
   }

   /**
    * Set the value of ville_mere
    *
    * @return  self
    */ 
   public function setVille_mere($ville_mere)
   {
      $this->ville_mere = $ville_mere;

      return $this;
   }

   /**
    * Get the value of pays_mere
    */ 
   public function getPays_mere()
   {
      return $this->pays_mere;
   }

   /**
    * Set the value of pays_mere
    *
    * @return  self
    */ 
   public function setPays_mere($pays_mere)
   {
      $this->pays_mere = $pays_mere;

      return $this;
   }

   /**
    * Get the value of email_mere
    */ 
   public function getEmail_mere()
   {
      return $this->email_mere;
   }

   /**
    * Set the value of email_mere
    *
    * @return  self
    */ 
   public function setEmail_mere($email_mere)
   {
      $this->email_mere = $email_mere;

      return $this;
   }

   /**
    * Get the value of profession_mere
    */ 
   public function getProfession_mere()
   {
      return $this->profession_mere;
   }

   /**
    * Set the value of profession_mere
    *
    * @return  self
    */ 
   public function setProfession_mere($profession_mere)
   {
      $this->profession_mere = $profession_mere;

      return $this;
   }

   /**
    * Get the value of diplome_langue
    */ 
   public function getDiplome_langue()
   {
      return $this->diplome_langue;
   }

   /**
    * Set the value of diplome_langue
    *
    * @return  self
    */ 
   public function setDiplome_langue($diplome_langue)
   {
      $this->diplome_langue = $diplome_langue;

      return $this;
   }

   /**
    * Get the value of niveau_etude
    */ 
   public function getNiveau_etude()
   {
      return $this->niveau_etude;
   }

   /**
    * Set the value of niveau_etude
    *
    * @return  self
    */ 
   public function setNiveau_etude($niveau_etude)
   {
      $this->niveau_etude = $niveau_etude;

      return $this;
   }
 

   /**
    * Get the value of langue_etude
    */ 
   public function getLangue_etude()
   {
      return $this->langue_etude;
   }

   /**
    * Set the value of langue_etude
    *
    * @return  self
    */ 
   public function setLangue_etude($langue_etude)
   {
      $this->langue_etude = $langue_etude;

      return $this;
   }
}





?>
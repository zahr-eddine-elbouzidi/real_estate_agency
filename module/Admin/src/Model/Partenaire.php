<?php
namespace Admin\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilter;

class Partenaire implements InputFilterAwareInterface
{

    private $id_partenaire;

    private $cycle;

    private $site_web;

    private $tel;

    private $email;

    private $criteres;

    private $filiere_id;

    private $langue_etude;
    
    private $coordonateur;
        
    private $frais_inscription_annuel;
    
    private $frais_traitement_dossier;

    private $created_by;


    protected $inputFilter;


    public function exchangeArray($data)
    {
        $this->id_partenaire = (isset($data['id_partenaire'])) ? $data['id_partenaire'] : null;
        $this->cycle = (isset($data['cycle'])) ? $data['cycle'] : null;
        $this->site_web = (isset($data['site_web'])) ? $data['site_web'] : null;
        $this->tel = (isset($data['tel'])) ? $data['tel'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->criteres = (isset($data['criteres'])) ? $data['criteres'] : null;
        $this->langue_etude = (isset($data['langue_etude'])) ? $data['langue_etude'] : null;
        $this->coordonateur = (isset($data['coordonateur'])) ? $data['coordonateur'] : null;
        $this->filiere_id = (isset($data['filiere_id'])) ? $data['filiere_id'] : null;
        $this->frais_inscription_annuel = (isset($data['frais_inscription_annuel'])) ? $data['frais_inscription_annuel'] : null;
        $this->frais_traitement_dossier = (isset($data['frais_traitement_dossier'])) ? $data['frais_traitement_dossier'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    // cette m�thode est ajout�e apres la construction de formulaire pour retourner
    //un tableau assossiatoif contenant les valeurs des attributs de ma classe, elle sera 
    //sera utilis� implicitement par les formulaires en mode �dition 
    public function getArrayCopy(){
        return get_object_vars($this);
        //appeler cette m�thode et lui passer l'objet courant
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterAwareInterface::getInputFilter()
     */
    public function getInputFilter()
    {
        if (! $this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name' => 'id_partenaire',
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));
            
 

            $inputFilter->add(array(
                'name' => 'cycle',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));
        
            
            $inputFilter->add(array(
                'name' => 'site_web',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'tel',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));


            $inputFilter->add(array(
                'name' => 'email',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'criteres',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'langue_etude',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'filiere_id',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));


            $inputFilter->add(array(
                'name' => 'coordonateur',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            

            $inputFilter->add(array(
                'name' => 'frais_inscription_annuel',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'frais_traitement_dossier',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'created_by',
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StripTags'
                    ),
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 250
                        )
                    )
                )
            ));

             
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Zend\InputFilter\InputFilterAwareInterface::setInputFilter()
     */
    public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not implemented');
    }


    




    /**
     * Get the value of id_partenaire
     */ 
    public function getId_partenaire()
    {
        return $this->id_partenaire;
    }

    /**
     * Set the value of id_partenaire
     *
     * @return  self
     */ 
    public function setId_partenaire($id_partenaire)
    {
        $this->id_partenaire = $id_partenaire;

        return $this;
    }

    /**
     * Get the value of cycle
     */ 
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set the value of cycle
     *
     * @return  self
     */ 
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get the value of site_web
     */ 
    public function getSite_web()
    {
        return $this->site_web;
    }

    /**
     * Set the value of site_web
     *
     * @return  self
     */ 
    public function setSite_web($site_web)
    {
        $this->site_web = $site_web;

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
     * Get the value of criteres
     */ 
    public function getCriteres()
    {
        return $this->criteres;
    }

    /**
     * Set the value of criteres
     *
     * @return  self
     */ 
    public function setCriteres($criteres)
    {
        $this->criteres = $criteres;

        return $this;
    }

    /**
     * Get the value of filiere_id
     */ 
    public function getFiliere_id()
    {
        return $this->filiere_id;
    }

    /**
     * Set the value of filiere_id
     *
     * @return  self
     */ 
    public function setFiliere_id($filiere_id)
    {
        $this->filiere_id = $filiere_id;

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
 

    /**
     * Get the value of coordonateur
     */ 
    public function getCoordonateur()
    {
        return $this->coordonateur;
    }

    /**
     * Set the value of coordonateur
     *
     * @return  self
     */ 
    public function setCoordonateur($coordonateur)
    {
        $this->coordonateur = $coordonateur;

        return $this;
    }

    /**
     * Get the value of frais_inscription_annuel
     */ 
    public function getFrais_inscription_annuel()
    {
        return $this->frais_inscription_annuel;
    }

    /**
     * Set the value of frais_inscription_annuel
     *
     * @return  self
     */ 
    public function setFrais_inscription_annuel($frais_inscription_annuel)
    {
        $this->frais_inscription_annuel = $frais_inscription_annuel;

        return $this;
    }

    /**
     * Get the value of frais_traitement_dossier
     */ 
    public function getFrais_traitement_dossier()
    {
        return $this->frais_traitement_dossier;
    }

    /**
     * Set the value of frais_traitement_dossier
     *
     * @return  self
     */ 
    public function setFrais_traitement_dossier($frais_traitement_dossier)
    {
        $this->frais_traitement_dossier = $frais_traitement_dossier;

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
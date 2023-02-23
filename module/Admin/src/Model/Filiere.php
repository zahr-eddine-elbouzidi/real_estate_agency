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

class Filiere implements InputFilterAwareInterface
{

    private $id_filiere;
    private $nom_filiere;
    private $created_by;
    private $etablissement_id;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_filiere = (!empty($data['id_filiere'])) ? $data['id_filiere'] : null;
        $this->nom_filiere = (!empty($data['nom_filiere'])) ? $data['nom_filiere'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->etablissement_id = (!empty($data['etablissement_id'])) ? $data['etablissement_id'] : null;

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
                'name' => 'id_filiere',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'nom_filiere',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags',
                    ),
                    array(
                        'name' => 'StringTrim',
                    ),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ));

        

         
        
         

        

            $inputFilter->add(array(
                'name' => 'created_by',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'StripTags',
                    ),
                    array(
                        'name' => 'StringTrim',
                    ),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'etablissement_id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    

    /**
     * Get the value of id_filiere
     */ 
    public function getId_filiere()
    {
        return $this->id_filiere;
    }

    /**
     * Set the value of id_filiere
     *
     * @return  self
     */ 
    public function setId_filiere($id_filiere)
    {
        $this->id_filiere = $id_filiere;

        return $this;
    }

    /**
     * Get the value of nom_filiere
     */ 
    public function getNom_filiere()
    {
        return $this->nom_filiere;
    }

    /**
     * Set the value of nom_filiere
     *
     * @return  self
     */ 
    public function setNom_filiere($nom_filiere)
    {
        $this->nom_filiere = $nom_filiere;

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
     * Get the value of etablissement_id
     */ 
    public function getEtablissement_id()
    {
        return $this->etablissement_id;
    }

    /**
     * Set the value of etablissement_id
     *
     * @return  self
     */ 
    public function setEtablissement_id($etablissement_id)
    {
        $this->etablissement_id = $etablissement_id;

        return $this;
    }
}

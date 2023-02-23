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

class Inscription implements InputFilterAwareInterface
{

    private $id_inscription;
    private $date_inscription;
    private $filiere_id;
    private $candidat_id;
    private $mt_paye_trait_dossier;
    private $mt_reste_trait_dossier;
    private $created_by;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_inscription = (!empty($data['id_inscription'])) ? $data['id_inscription'] : null;
        $this->date_inscription = (!empty($data['date_inscription'])) ? $data['date_inscription'] : null;
        $this->mt_paye_trait_dossier = (!empty($data['mt_paye_trait_dossier'])) ? $data['mt_paye_trait_dossier'] : 0;
        $this->mt_reste_trait_dossier = (!empty($data['mt_reste_trait_dossier'])) ? $data['mt_reste_trait_dossier'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->filiere_id = (!empty($data['filiere_id'])) ? $data['filiere_id'] : null;
        $this->candidat_id = (!empty($data['candidat_id'])) ? $data['candidat_id'] : null;

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
                'name' => 'id_inscription',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'date_inscription',
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
                'name' => 'mt_paye_trait_dossier',
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
                'name' => 'mt_reste_trait_dossier',
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
                'name' => 'filiere_id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'candidat_id',
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
     * Get the value of id_inscription
     */ 
    public function getId_inscription()
    {
        return $this->id_inscription;
    }

    /**
     * Set the value of id_inscription
     *
     * @return  self
     */ 
    public function setId_inscription($id_inscription)
    {
        $this->id_inscription = $id_inscription;

        return $this;
    }

    /**
     * Get the value of date_inscription
     */ 
    public function getDate_inscription()
    {
        return $this->date_inscription;
    }

    /**
     * Set the value of date_inscription
     *
     * @return  self
     */ 
    public function setDate_inscription($date_inscription)
    {
        $this->date_inscription = $date_inscription;

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
     * Get the value of candidat_id
     */ 
    public function getCandidat_id()
    {
        return $this->candidat_id;
    }

    /**
     * Set the value of candidat_id
     *
     * @return  self
     */ 
    public function setCandidat_id($candidat_id)
    {
        $this->candidat_id = $candidat_id;

        return $this;
    }

    /**
     * Get the value of mt_paye_trait_dossier
     */ 
    public function getMt_paye_trait_dossier()
    {
        return $this->mt_paye_trait_dossier;
    }

    /**
     * Set the value of mt_paye_trait_dossier
     *
     * @return  self
     */ 
    public function setMt_paye_trait_dossier($mt_paye_trait_dossier)
    {
        $this->mt_paye_trait_dossier = $mt_paye_trait_dossier;

        return $this;
    }

    /**
     * Get the value of mt_reste_trait_dossier
     */ 
    public function getMt_reste_trait_dossier()
    {
        return $this->mt_reste_trait_dossier;
    }

    /**
     * Set the value of mt_reste_trait_dossier
     *
     * @return  self
     */ 
    public function setMt_reste_trait_dossier($mt_reste_trait_dossier)
    {
        $this->mt_reste_trait_dossier = $mt_reste_trait_dossier;

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

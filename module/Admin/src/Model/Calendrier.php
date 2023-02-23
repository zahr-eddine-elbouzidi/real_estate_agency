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

class Calendrier implements InputFilterAwareInterface
{

    private $id_session_filiere;
    private $date_debut;
    private $date_fin;
    private $filiere_id;
    private $session_id;
    private $created_by;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_session_filiere = (!empty($data['id_session_filiere'])) ? $data['id_session_filiere'] : null;
        $this->date_debut = (!empty($data['date_debut'])) ? $data['date_debut'] : null;
        $this->date_fin = (!empty($data['date_fin'])) ? $data['date_fin'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->filiere_id = (!empty($data['filiere_id'])) ? $data['filiere_id'] : null;
        $this->session_id = (!empty($data['session_id'])) ? $data['session_id'] : null;

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
                'name' => 'id_session_filiere',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'date_debut',
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
                'name' => 'date_fin',
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
                'name' => 'session_id',
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
     * Get the value of id_session_filiere
     */ 
    public function getId_session_filiere()
    {
        return $this->id_session_filiere;
    }

    /**
     * Set the value of id_session_filiere
     *
     * @return  self
     */ 
    public function setId_session_filiere($id_session_filiere)
    {
        $this->id_session_filiere = $id_session_filiere;

        return $this;
    }

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;

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
     * Get the value of session_id
     */ 
    public function getSession_id()
    {
        return $this->session_id;
    }

    /**
     * Set the value of session_id
     *
     * @return  self
     */ 
    public function setSession_id($session_id)
    {
        $this->session_id = $session_id;

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

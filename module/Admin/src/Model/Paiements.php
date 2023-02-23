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

class Paiements implements InputFilterAwareInterface
{

    private $id_paiement;
    private $date_paiement;
    private $mt_paye;
    private $type_paie;
    private $remise;
    private $inscription_id;
    private $mode_id;
    private $created_by;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_paiement = (!empty($data['id_paiement'])) ? $data['id_paiement'] : null;
        $this->date_paiement = (!empty($data['date_paiement'])) ? $data['date_paiement'] : null;
        $this->mt_paye = (!empty($data['mt_paye'])) ? $data['mt_paye'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->type_paie = (!empty($data['type_paie'])) ? $data['type_paie'] : null;
        $this->remise = (!empty($data['remise'])) ? $data['remise'] : null;
        $this->inscription_id = (!empty($data['inscription_id'])) ? $data['inscription_id'] : null;
        $this->mode_id = (!empty($data['mode_id'])) ? $data['mode_id'] : null;

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
                'name' => 'id_paiement',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'date_paiement',
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
                'name' => 'mt_paye',
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
                'name' => 'type_paie',
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
                'name' => 'remise',
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
                'name' => 'inscription_id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'mode_id',
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
     * Get the value of id_paiement
     */ 
    public function getId_paiement()
    {
        return $this->id_paiement;
    }

    /**
     * Set the value of id_paiement
     *
     * @return  self
     */ 
    public function setId_paiement($id_paiement)
    {
        $this->id_paiement = $id_paiement;

        return $this;
    }

    /**
     * Get the value of date_paiement
     */ 
    public function getDate_paiement()
    {
        return $this->date_paiement;
    }

    /**
     * Set the value of date_paiement
     *
     * @return  self
     */ 
    public function setDate_paiement($date_paiement)
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }

    /**
     * Get the value of mt_paye
     */ 
    public function getMt_paye()
    {
        return $this->mt_paye;
    }

    /**
     * Set the value of mt_paye
     *
     * @return  self
     */ 
    public function setMt_paye($mt_paye)
    {
        $this->mt_paye = $mt_paye;

        return $this;
    }

    /**
     * Get the value of type_paie
     */ 
    public function getType_paie()
    {
        return $this->type_paie;
    }

    /**
     * Set the value of type_paie
     *
     * @return  self
     */ 
    public function setType_paie($type_paie)
    {
        $this->type_paie = $type_paie;

        return $this;
    }

    /**
     * Get the value of remise
     */ 
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * Set the value of remise
     *
     * @return  self
     */ 
    public function setRemise($remise)
    {
        $this->remise = $remise;

        return $this;
    }

    /**
     * Get the value of inscription_id
     */ 
    public function getInscription_id()
    {
        return $this->inscription_id;
    }

    /**
     * Set the value of inscription_id
     *
     * @return  self
     */ 
    public function setInscription_id($inscription_id)
    {
        $this->inscription_id = $inscription_id;

        return $this;
    }

    /**
     * Get the value of mode_id
     */ 
    public function getMode_id()
    {
        return $this->mode_id;
    }

    /**
     * Set the value of mode_id
     *
     * @return  self
     */ 
    public function setMode_id($mode_id)
    {
        $this->mode_id = $mode_id;

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

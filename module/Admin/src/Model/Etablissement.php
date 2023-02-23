<?php
namespace Admin\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilter;

class Etablissement implements InputFilterAwareInterface
{

    private $id_etablissement;

    private $nom_etablissement;

    private $type_etablissement;

    private $pays_etablissement;

    private $created_by;


    protected $inputFilter;



    public function exchangeArray($data)
    {
        $this->id_etablissement = (isset($data['id_etablissement'])) ? $data['id_etablissement'] : null;
        $this->nom_etablissement = (isset($data['nom_etablissement'])) ? $data['nom_etablissement'] : null;
        $this->type_etablissement = (isset($data['type_etablissement'])) ? $data['type_etablissement'] : null;
        $this->pays_etablissement = (isset($data['pays_etablissement'])) ? $data['pays_etablissement'] : null;
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
                'name' => 'id_etablissement',
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));
            
            $inputFilter->add(array(
                'name' => 'nom_etablissement',
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
                            'max' => 255
                        )
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'type_etablissement',
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
                'name' => 'pays_etablissement',
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
     * Get the value of id_etablissement
     */ 
    public function getId_etablissement()
    {
        return $this->id_etablissement;
    }

    /**
     * Set the value of id_etablissement
     *
     * @return  self
     */ 
    public function setId_etablissement($id_etablissement)
    {
        $this->id_etablissement = $id_etablissement;

        return $this;
    }

    /**
     * Get the value of nom_etablissement
     */ 
    public function getNom_etablissement()
    {
        return $this->nom_etablissement;
    }

    /**
     * Set the value of nom_etablissement
     *
     * @return  self
     */ 
    public function setNom_etablissement($nom_etablissement)
    {
        $this->nom_etablissement = $nom_etablissement;

        return $this;
    }

    /**
     * Get the value of type_etablissement
     */ 
    public function getType_etablissement()
    {
        return $this->type_etablissement;
    }

    /**
     * Set the value of type_etablissement
     *
     * @return  self
     */ 
    public function setType_etablissement($type_etablissement)
    {
        $this->type_etablissement = $type_etablissement;

        return $this;
    }

    /**
     * Get the value of pays_etablissement
     */ 
    public function getPays_etablissement()
    {
        return $this->pays_etablissement;
    }

    /**
     * Set the value of pays_etablissement
     *
     * @return  self
     */ 
    public function setPays_etablissement($pays_etablissement)
    {
        $this->pays_etablissement = $pays_etablissement;

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
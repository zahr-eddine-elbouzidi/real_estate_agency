<?php
namespace Admin\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilter;

class Session implements InputFilterAwareInterface
{

    private $id_session;

    private $nom_session;
 

    private $created_by;


    protected $inputFilter;



    public function exchangeArray($data)
    {
        $this->id_session = (isset($data['id_session'])) ? $data['id_session'] : null;
        $this->nom_session = (isset($data['nom_session'])) ? $data['nom_session'] : null;
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
                'name' => 'id_session',
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));
            
            $inputFilter->add(array(
                'name' => 'nom_session',
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
     * Get the value of id_session
     */ 
    public function getId_session()
    {
        return $this->id_session;
    }

    /**
     * Set the value of id_session
     *
     * @return  self
     */ 
    public function setId_session($id_session)
    {
        $this->id_session = $id_session;

        return $this;
    }

    /**
     * Get the value of nom_session
     */ 
    public function getNom_session()
    {
        return $this->nom_session;
    }

    /**
     * Set the value of nom_session
     *
     * @return  self
     */ 
    public function setNom_session($nom_session)
    {
        $this->nom_session = $nom_session;

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
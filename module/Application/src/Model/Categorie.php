<?php
namespace Application\Model;

use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilter;

class Categorie implements InputFilterAwareInterface
{

    private $id;

    private $name_fr;

    private $name_eng;

    private $name_ar;

    private $slug;

    private $level_cat;

    private $enabled;

    private $created_by;


    protected $inputFilter;

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
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));
            
            $inputFilter->add(array(
                'name' => 'name_fr',
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
                'name' => 'name_eng',
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
                'name' => 'name_ar',
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
                'name' => 'level_cat',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));

            $inputFilter->add(array(
                'name' => 'enabled',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int'
                    )
                )
            ));
            
            $inputFilter->add(array(
                'name' => 'slug',
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
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return the $name_fr
     */
    public function getNameFr()
    {
        return $this->name_fr;
    }

    /**
     *
     * @param field_type $name_fr            
     */
    public function setNameFr($name_fr)
    {
        $this->name_fr = $name_fr;
    }


    /**
     *
     * @return the $name_fr
     */
    public function getNameEng()
    {
        return $this->name_eng;
    }

    /**
     *
     * @param field_type $name_fr            
     */
    public function setNameEng($name_eng)
    {
        $this->name_eng = $name_eng;
    }


     /**
     *
     * @return the $name_ar
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     *
     * @param field_type $name_fr            
     */
    public function setNameAr($name_ar)
    {
        $this->name_ar = $name_ar;
    }

    
     /**
     *
     * @return the $level_cat
     */
    public function getLevelCat()
    {
        return $this->level_cat;
    }

    /**
     *
     * @param field_type $level_cat            
     */
    public function setLevelCat($level_cat)
    {
        $this->level_cat = $level_cat;
    }


     /**
     *
     * @return the $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     *
     * @param field_type $enabled            
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }


     /**
     *
     * @return the $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     *
     * @param field_type $slug            
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }


      /**
     *
     * @return the $created_by
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     *
     * @param field_type $created_by            
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     *
     * @return the $created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     *
     * @param field_type $created_at        
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

 

    public function exchangeArray($data)
    {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name_fr = (isset($data['name_fr'])) ? $data['name_fr'] : null;
        $this->name_eng = (isset($data['name_eng'])) ? $data['name_eng'] : null;
        $this->name_ar = (isset($data['name_ar'])) ? $data['name_ar'] : null;
        $this->enabled = (isset($data['enabled'])) ? $data['enabled'] : null;
        $this->level_cat = (isset($data['level_cat'])) ? $data['level_cat'] : null;
        $this->slug = (isset($data['slug'])) ? $data['slug'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
    }
    // cette m�thode est ajout�e apres la construction de formulaire pour retourner
    //un tableau assossiatoif contenant les valeurs des attributs de ma classe, elle sera 
    //sera utilis� implicitement par les formulaires en mode �dition 
    public function getArrayCopy(){
        return get_object_vars($this);
        //appeler cette m�thode et lui passer l'objet courant
    }
}
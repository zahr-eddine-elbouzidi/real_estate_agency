<?php
namespace Admin\Model;
use Laminas\InputFilter\Factory as InputFactory;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
// the object will be hydrated by Laminas\Db\TableGateway\TableGateway
class User implements InputFilterAwareInterface
{
    /**
     * properties
     */
    private $usr_id;
    private $usr_name;
    private $first_name;
    private $last_name;
    private $usr_password;
    private $usr_email;  
    private $usrl_id;    
    private $lng_id; 
    private $usr_active; 
    private $usr_question;   
    private $usr_answer; 
    private $usr_picture;    
    private $usr_password_salt;
    private $usr_registration_date;
    private $usr_registration_token; 
    private $usr_email_confirmed;    
    private $usr_country;    
    private $usr_city;    
    private $usr_isSuper;    
    private $created_by; 
    private $type; 
 


    // Hydration
    // ArrayObject, or at least implement exchangeArray. For Zend\Db\ResultSet\ResultSet to work
    public function exchangeArray($data) 
    {
        $this->usr_id     = (!empty($data['usr_id'])) ? $data['usr_id'] : null;
        $this->usr_name = (!empty($data['usr_name'])) ? $data['usr_name'] : null;
        $this->usr_password = (!empty($data['usr_password'])) ? $data['usr_password'] : null;
        $this->usr_email = (!empty($data['usr_email'])) ? $data['usr_email'] : null;
        $this->usrl_id = (!empty($data['usrl_id'])) ? $data['usrl_id'] : null;
        $this->lng_id = (!empty($data['lng_id'])) ? $data['lng_id'] : null;
        $this->usr_active = (isset($data['usr_active'])) ? $data['usr_active'] : null;
        $this->usr_question = (!empty($data['usr_question'])) ? $data['usr_question'] : null;
        $this->usr_answer = (!empty($data['usr_answer'])) ? $data['usr_answer'] : null;
        $this->first_name = (!empty($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name = (!empty($data['last_name'])) ? $data['last_name'] : null;
        $this->usr_picture = (!empty($data['usr_picture'])) ? $data['usr_picture'] : null;
        $this->usr_password_salt = (!empty($data['usr_password_salt'])) ? $data['usr_password_salt'] : null;
        $this->usr_registration_date = (!empty($data['usr_registration_date'])) ? $data['usr_registration_date'] : null;
        $this->usr_registration_token = (!empty($data['usr_registration_token'])) ? $data['usr_registration_token'] : null;
        $this->usr_email_confirmed = (isset($data['usr_email_confirmed'])) ? $data['usr_email_confirmed'] : null;
        $this->usr_country = (isset($data['usr_country'])) ? $data['usr_country'] : null;
        $this->usr_city = (isset($data['usr_city'])) ? $data['usr_city'] : null;
        $this->usr_isSuper = (isset($data['usr_isSuper'])) ? $data['usr_isSuper'] : null;
        $this->created_by = (isset($data['created_by'])) ? $data['created_by'] : null;
        $this->type = (isset($data['type'])) ? $data['type'] : null;
 
    }  
    
    /**
     *
     * @return the $id
     */
    public function getId()
    {
        return $this->usr_id;
    }

    /**
     *
     * @param field_type $id            
     */
    public function setId($id)
    {
        $this->usr_id = $id;
    }


    /**
     *
     * @return the $usr_name
     */
    public function getUsername()
    {
        return $this->usr_name;
    }
 
    /**
     *
     * @param field_type $usr_name            
     */
    public function setUsername($usr_name)
    {
        $this->usr_name = $usr_name;
    }


    
    /**
     *
     * @return the $firstname
     */
    public function getFirstname()
    {
        return $this->first_name;
    }

    /**
     *
     * @param field_type $first_name            
     */
    public function setFirstname($first_name)
    {
        $this->first_name = $first_name;
    }


      /**
     *
     * @return the $last name
     */
    public function getLastname()
    {
        return $this->last_name;
    }

    /**
     *
     * @param field_type $first_name            
     */
    public function setLastname($last_name)
    {
        $this->last_name = $last_name;
    }

        /**
     *
     * @return the $usr_email
     */
    public function getEmail()
    {
        return $this->usr_email;
    }

    /**
     *
     * @param field_type $usr_email            
     */
    public function setEmail($usr_email)
    {
        $this->usr_email = $usr_email;
    }


    /**
     *
     * @return the $usr_password
     */
    public function getPassword()
    {
        return $this->usr_password;
    }

    /**
     *
     * @param field_type $usr_password            
     */
    public function setPassword($usr_password)
    {
        $this->usr_password = $usr_password;
    }


      /**
     *
     * @return the $usrl_id
     */
    public function getUsrl_id()
    {
        return $this->usrl_id;
    }

    /**
     *
     * @param field_type $usrl_id            
     */
    public function setUsrl_id($usrl_id)
    {
        $this->usrl_id = $usrl_id;
    }


         /**
     *
     * @return the $lng_id
     */
    public function getLng_id()
    {
        return $this->lng_id;
    }

    /**
     *
     * @param field_type $lng_id            
     */
    public function setLng_id($lng_id)
    {
        $this->lng_id = $lng_id;
    }


            /**
     *
     * @return the $usr_active
     */
    public function getUsr_active()
    {
        return $this->usr_active;
    }

    /**
     *
     * @param field_type $usr_active            
     */
    public function setUsr_active($usr_active)
    {
        $this->usr_active = $usr_active;
    }


    
            /**
     *
     * @return the $usr_question
     */
    public function getUsr_question()
    {
        return $this->usr_question;
    }

    /**
     *
     * @param field_type $usr_question            
     */
    public function setUsr_question($usr_question)
    {
        $this->usr_question = $usr_question;
    }


      
            /**
     *
     * @return the $usr_answer
     */
    public function getUsr_answer()
    {
        return $this->usr_answer;
    }

    /**
     *
     * @param field_type $usr_answer            
     */
    public function setUsr_answer($usr_answer)
    {
        $this->usr_answer = $usr_answer;
    }


     /**
     *
     * @return the $usr_picture
     */
    public function getUsr_picture()
    {
        return $this->usr_picture;
    }

    /**
     *
     * @param field_type $usr_picture            
     */
    public function setUsr_picture($usr_picture)
    {
        $this->usr_picture = $usr_picture;
    }


    
     /**
     *
     * @return the $usr_password_salt
     */
    public function getUsr_password_salt()
    {
        return $this->usr_password_salt;
    }

    /**
     *
     * @param field_type $usr_password_salt            
     */
    public function setUsr_password_salt($usr_password_salt)
    {
        $this->usr_password_salt = $usr_password_salt;
    }


      /**
     *
     * @return the $usr_registration_date
     */
    public function getUsr_registration_date()
    {
        return $this->usr_registration_date;
    }

    /**
     *
     * @param field_type $usr_registration_date            
     */
    public function setUsr_registration_date($usr_registration_date)
    {
        $this->usr_registration_date = $usr_registration_date;
    }

      /**
     *
     * @return the $usr_registration_token
     */
    public function getUsr_registration_token()
    {
        return $this->usr_registration_token;
    }

    /**
     *
     * @param field_type $usr_registration_token            
     */
    public function setUsr_registration_token($usr_registration_token)
    {
        $this->usr_registration_token = $usr_registration_token;
    }


         /**
     *
     * @return the $usr_email_confirmed
     */
    public function getUsr_email_confirmed()
    {
        return $this->usr_email_confirmed;
    }

    /**
     *
     * @param field_type $usr_email_confirmed            
     */
    public function setUsr_email_confirmed($usr_email_confirmed)
    {
        $this->usr_email_confirmed = $usr_email_confirmed;
    }

           /**
     *
     * @return the $usr_country
     */
    public function getUsr_country()
    {
        return $this->usr_country;
    }

    /**
     *
     * @param field_type $usr_country            
     */
    public function setUsr_country($usr_country)
    {
        $this->usr_country = $usr_country;
    }


             /**
     *
     * @return the $usr_city
     */
    public function getUsr_city()
    {
        return $this->usr_city;
    }

    /**
     *
     * @param field_type $usr_city            
     */
    public function setUsr_city($usr_city)
    {
        $this->usr_city = $usr_city;
    }

    
             /**
     *
     * @return the $usr_isSuper
     */
    public function getUsr_isSuper()
    {
        return $this->usr_isSuper;
    }

    /**
     *
     * @param field_type $usr_isSuper            
     */
    public function setUsr_isSuper($usr_isSuper)
    {
        $this->usr_isSuper = $usr_isSuper;
    }



                /**
     *
     * @return the $created_by
     */
    public function getCreated_by()
    {
        return $this->created_by;
    }

    /**
     *
     * @param field_type $created_by            
     */
    public function setCreated_by($created_by)
    {
        $this->created_by = $created_by;
    }

                  /**
     *
     * @return the $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param field_type $type            
     */
    public function setType($type)
    {
        $this->type = $type;
    }






    // Extraction. The Registration from the tutorial works even without it.
    // The standard Hydrator of the Form expects getArrayCopy to be able to bind
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
    
    protected $inputFilter;
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                'name'     => 'usr_name',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'usr_password',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }   
}
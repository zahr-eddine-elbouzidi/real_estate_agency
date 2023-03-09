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

class File implements InputFilterAwareInterface
{

    private $id_file;
    private $filename;
    private $created_by;
    private $post_id;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_file = (!empty($data['id_file'])) ? $data['id_file'] : null;
        $this->filename = (!empty($data['filename'])) ? $data['filename'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->post_id = (!empty($data['post_id'])) ? $data['post_id'] : null;

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
                'name' => 'id_file',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'filename',
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
                'name' => 'post_id',
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
     * Get the value of id_file
     */
    public function getIdFile()
    {
        return $this->id_file;
    }

    /**
     * Set the value of id_file
     */
    public function setIdFile($id_file): self
    {
        $this->id_file = $id_file;

        return $this;
    }

    /**
     * Get the value of filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     */
    public function setFilename($filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of created_by
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Set the value of created_by
     */
    public function setCreatedBy($created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * Get the value of post_id
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * Set the value of post_id
     */
    public function setPostId($post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }
}

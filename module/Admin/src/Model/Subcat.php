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

class Subcat implements InputFilterAwareInterface
{

    private $id_subcat;
    private $sub_name_fr;
    private $sub_name_eng;
    private $sub_name_ar;
    private $sub_level;
    private $sub_enabled;
    private $sub_slug;
    private $sub_created_by;
    private $sub_created_at;
    private $sub_category_id;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_subcat = (!empty($data['id_subcat'])) ? $data['id_subcat'] : null;
        $this->sub_name_fr = (!empty($data['sub_name_fr'])) ? $data['sub_name_fr'] : null;
        $this->sub_name_eng = (!empty($data['sub_name_eng'])) ? $data['sub_name_eng'] : null;
        $this->sub_name_ar = (!empty($data['sub_name_ar'])) ? $data['sub_name_ar'] : null;
        $this->sub_level = (!empty($data['sub_level'])) ? $data['sub_level'] : null;
        $this->sub_enabled = (!empty($data['sub_enabled'])) ? $data['sub_enabled'] : 0;
        $this->sub_slug = (!empty($data['sub_slug'])) ? $data['sub_slug'] : null;
        $this->sub_created_by = (!empty($data['sub_created_by'])) ? $data['sub_created_by'] : null;
        $this->sub_category_id = (!empty($data['sub_category_id'])) ? $data['sub_category_id'] : null;

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
                'name' => 'id_subcat',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sub_name_fr',
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
                'name' => 'sub_name_eng',
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
                'name' => 'sub_name_ar',
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
                'name' => 'sub_level',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sub_enabled',
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sub_slug',
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
                'name' => 'sub_created_by',
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
                'name' => 'sub_category_id',
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
     * Get the value of id_subcat
     */
    public function getId_subcat()
    {
        return $this->id_subcat;
    }

    /**
     * Set the value of id_subcat
     *
     * @return  self
     */
    public function setId_subcat($id_subcat)
    {
        $this->id_subcat = $id_subcat;

        return $this;
    }

    /**
     * Get the value of sub_name_fr
     */
    public function getSub_name_fr()
    {
        return $this->sub_name_fr;
    }

    /**
     * Set the value of sub_name_fr
     *
     * @return  self
     */
    public function setSub_name_fr($sub_name_fr)
    {
        $this->sub_name_fr = $sub_name_fr;

        return $this;
    }

    /**
     * Get the value of sub_name_eng
     */
    public function getSub_name_eng()
    {
        return $this->sub_name_eng;
    }

    /**
     * Set the value of sub_name_eng
     *
     * @return  self
     */
    public function setSub_name_eng($sub_name_eng)
    {
        $this->sub_name_eng = $sub_name_eng;

        return $this;
    }

    /**
     * Get the value of sub_name_ar
     */
    public function getSub_name_ar()
    {
        return $this->sub_name_ar;
    }

    /**
     * Set the value of sub_name_ar
     *
     * @return  self
     */
    public function setSub_name_ar($sub_name_ar)
    {
        $this->sub_name_ar = $sub_name_ar;

        return $this;
    }

    /**
     * Get the value of sub_level
     */
    public function getSub_level()
    {
        return $this->sub_level;
    }

    /**
     * Set the value of sub_level
     *
     * @return  self
     */
    public function setSub_level($sub_level)
    {
        $this->sub_level = $sub_level;

        return $this;
    }

    /**
     * Get the value of sub_enabled
     */
    public function getSub_enabled()
    {
        return $this->sub_enabled;
    }

    /**
     * Set the value of sub_enabled
     *
     * @return  self
     */
    public function setSub_enabled($sub_enabled)
    {
        $this->sub_enabled = $sub_enabled;

        return $this;
    }

    /**
     * Get the value of sub_slug
     */
    public function getSub_slug()
    {
        return $this->sub_slug;
    }

    /**
     * Set the value of sub_slug
     *
     * @return  self
     */
    public function setSub_slug($sub_slug)
    {
        $this->sub_slug = $sub_slug;

        return $this;
    }

    /**
     * Get the value of sub_created_by
     */
    public function getSub_created_by()
    {
        return $this->sub_created_by;
    }

    /**
     * Set the value of sub_created_by
     *
     * @return  self
     */
    public function setSub_created_by($sub_created_by)
    {
        $this->sub_created_by = $sub_created_by;

        return $this;
    }

    /**
     * Get the value of sub_created_at
     */
    public function getSub_created_at()
    {
        return $this->sub_created_at;
    }

    /**
     * Set the value of sub_created_at
     *
     * @return  self
     */
    public function setSub_created_at($sub_created_at)
    {
        $this->sub_created_at = $sub_created_at;

        return $this;
    }

    /**
     * Get the value of sub_category_id
     */
    public function getSub_category_id()
    {
        return $this->sub_category_id;
    }

    /**
     * Set the value of sub_category_id
     *
     * @return  self
     */
    public function setSub_category_id($sub_category_id)
    {
        $this->sub_category_id = $sub_category_id;

        return $this;
    }
}

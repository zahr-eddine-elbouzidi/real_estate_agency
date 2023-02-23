<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class SubcatForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('subcat');
       $this->add(array(
           'name' => 'id_subcat',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'sub_name_fr',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name Fr',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));
       $this->add(array(
        'name' => 'sub_name_eng',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Eng',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'sub_name_ar',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Ar',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
       $this->add(array(
           'name' => 'sub_slug',
           'type' => 'Textarea',
           'options' => array(
               'label' => 'Slug',
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'sub_level',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'sub_enabled',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'sub_created_by',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'sub_category_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'category_id',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));



     
       $this->add(array(
           'name' =>'validate',
           'type' => 'Submit',
           'attributes' =>array(
               'value' => 'Valider',
               'id' => 'validate',
               'class' => 'btn btn-default'
           )
       ));
    }
}
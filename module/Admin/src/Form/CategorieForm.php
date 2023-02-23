<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class CategorieForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('category');
       $this->add(array(
           'name' => 'id',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'name_fr',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name Fr',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));
       $this->add(array(
        'name' => 'name_eng',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Eng',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'name_ar',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Ar',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
       $this->add(array(
           'name' => 'slug',
           'type' => 'Textarea',
           'options' => array(
               'label' => 'Slug',
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'level_cat',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'enabled',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'created_by',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
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
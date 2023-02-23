<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class CalendrierForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('session_filiere');
       $this->add(array(
           'name' => 'id_session_filiere',
           'type' => 'Hidden'
       ));

       $this->add(array(
           'name' => 'date_debut',
           'type' => 'Text',
           'options' => array(
               'label' => 'date de début',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'date_fin',
        'type' => 'Text',
        'options' => array(
            'label' => ' date fin Fr',      
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
        'name' => 'filiere_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'filiere_id',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'session_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'session_id',
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
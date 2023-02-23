<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class FiliereForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('filieres');
       $this->add(array(
           'name' => 'id_filiere',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'nom_filiere',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name Fr',      
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
        'name' => 'etablissement_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'etablissement_id',
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
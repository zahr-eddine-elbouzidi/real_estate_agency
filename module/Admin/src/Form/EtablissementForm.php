<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class EtablissementForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('etablissements');
       $this->add(array(
           'name' => 'id_etablissement',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'nom_etablissement',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name Fr',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));
       $this->add(array(
        'name' => 'type_etablissement',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Eng',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'pays_etablissement',
        'type' => 'Text',
        'options' => array(
            'label' => 'Name Ar',      
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
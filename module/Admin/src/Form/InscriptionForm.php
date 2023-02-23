<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class InscriptionForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('inscriptions');
       $this->add(array(
           'name' => 'id_inscription',
           'type' => 'Hidden'
       ));

       $this->add(array(
           'name' => 'date_inscription',
           'type' => 'Text',
           'options' => array(
               'label' => 'Dae inscription Fr',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'mt_paye_trait_dossier',
        'type' => 'Text',
        'options' => array(
            'label' => ' mt_paye_trait_dossier Fr',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    
    $this->add(array(
        'name' => 'mt_reste_trait_dossier',
        'type' => 'Text',
        'options' => array(
            'label' => ' mt_reste_trait_dossier Fr',      
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
        'name' => 'candidat_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'candidat_id',
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
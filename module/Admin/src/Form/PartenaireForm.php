<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class PartenaireForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('partenaires');
       $this->add(array(
           'name' => 'id',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'etablissement',
           'type' => 'Text',
           'options' => array(
               'label' => 'Etablissement',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));
       $this->add(array(
        'name' => 'domaine',
        'type' => 'Text',
        'options' => array(
            'label' => 'Domaine',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'cycle',
        'type' => 'Text',
        'options' => array(
            'label' => 'Cycle',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
       $this->add(array(
           'name' => 'site_web',
           'type' => 'Text',
           'options' => array(
               'label' => 'Slug',
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'tel',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'email',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    
    $this->add(array(
        'name' => 'criteres',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'filiere_etude',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'coordonateur',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'pays',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'frais_inscription_annuel',
        'type' => 'Text',
        'options' => array(
            'label' => 'Slug',
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'frais_traitement_dossier',
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
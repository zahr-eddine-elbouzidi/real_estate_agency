<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class PaiementsForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('paiements');
       $this->add(array(
           'name' => 'id_paiement',
           'type' => 'Hidden'
       ));

       $this->add(array(
           'name' => 'date_paiement',
           'type' => 'Text',
           'options' => array(
               'label' => 'date paie',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'mt_paye',
        'type' => 'Text',
        'options' => array(
            'label' => ' mt paye ',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'type_paie',
        'type' => 'Text',
        'options' => array(
            'label' => ' type paie ',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'remise',
        'type' => 'Text',
        'options' => array(
            'label' => 'remise ',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'mode_id',
        'type' => 'Text',
        'options' => array(
            'label' => ' mt paye ',      
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
        'name' => 'inscription_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'filiere_id',
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
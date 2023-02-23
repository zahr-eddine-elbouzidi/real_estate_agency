<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class ModeForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('mode_paiement');
       $this->add(array(
           'name' => 'id_mode',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'nom_mode',
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
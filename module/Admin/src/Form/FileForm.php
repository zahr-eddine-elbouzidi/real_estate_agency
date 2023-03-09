<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;

class FileForm extends Form
{
    public function __construct($name = null)
    {
       parent::__construct('files');
       $this->add(array(
           'name' => 'id_file',
           'type' => 'Hidden'
       ));
       $this->add(array(
           'name' => 'filename',
           'type' => 'Text',
           'options' => array(
               'label' => 'Filename',      
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
        'name' => 'post_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'post_id',
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
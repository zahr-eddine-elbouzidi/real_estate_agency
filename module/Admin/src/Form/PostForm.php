<?php
namespace Admin\Form;

use Laminas\Form\Form;
use Laminas\Form\Fieldset;

class PostForm extends Form
{
    public function __construct($name = null)
    {
        /**
         * init construction
         */
       parent::__construct('posts');

        /**
         * id contact init id hidden value
         */
       $this->add(array(
           'name' => 'id_post',
           'type' => 'Hidden'
       ));

       /**
        * name value
        */
       $this->add(array(
           'name' => 'title',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'type',
        'type' => 'Text',
        'options' => array(
            'label' => 'Tel',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'content',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'enabled',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'slug',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'level',
        'type' => 'Text',
        'options' => array(
            'label' => 'Level',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'important_msg',
        'type' => 'Text',
        'options' => array(
            'label' => 'Important Msg',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'filename',
        'type' => 'Text',
        'options' => array(
            'label' => 'Tel',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'subcategory_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'created_by',
        'type' => 'Text',
        'options' => array(
            'label' => 'FB',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'updated_at',
        'type' => 'Text',
        'options' => array(
            'label' => 'Instagram',      
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
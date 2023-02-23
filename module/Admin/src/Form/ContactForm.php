<?php
namespace Admin\Form;

use Laminas\Form\Form;
use Laminas\Form\Fieldset;

class ContactForm extends Form
{
    public function __construct($name = null)
    {
        /**
         * init construction
         */
       parent::__construct('contact');

        /**
         * id contact init id hidden value
         */
       $this->add(array(
           'name' => 'id_contact',
           'type' => 'Hidden'
       ));

       /**
        * name value
        */
       $this->add(array(
           'name' => 'name',
           'type' => 'Text',
           'options' => array(
               'label' => 'Name',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'tel',
        'type' => 'Text',
        'options' => array(
            'label' => 'Tel',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'gsm',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'email',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'website',
        'type' => 'Text',
        'options' => array(
            'label' => 'GSM',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'facebook_url',
        'type' => 'Text',
        'options' => array(
            'label' => 'FB',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'instagram_url',
        'type' => 'Text',
        'options' => array(
            'label' => 'Instagram',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'linkedin_url',
        'type' => 'Text',
        'options' => array(
            'label' => 'LinkedIn',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    

    $this->add(array(
        'name' => 'tiktok_url',
        'type' => 'Text',
        'options' => array(
            'label' => 'Tiktok',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    
    
    $this->add(array(
           'name' => 'address',
           'type' => 'Textarea',
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
            'label' => 'Created by',
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
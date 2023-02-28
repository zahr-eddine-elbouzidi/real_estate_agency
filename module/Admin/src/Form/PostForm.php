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
               'label' => 'title',      
           ),
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

       $this->add(array(
        'name' => 'type',
        'type' => 'Text',
        'options' => array(
            'label' => 'type',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'content',
        'type' => 'Text',
        'options' => array(
            'label' => 'content',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'enabled',
        'type' => 'Text',
        'options' => array(
            'label' => 'enabled',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'slug',
        'type' => 'Text',
        'options' => array(
            'label' => 'slug',      
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
            'label' => 'filename',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));


    $this->add(array(
        'name' => 'subcategory_id',
        'type' => 'Text',
        'options' => array(
            'label' => 'subcategory_id',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'address',
        'type' => 'Text',
        'options' => array(
            'label' => 'Address',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'bedrooms',
        'type' => 'Text',
        'options' => array(
            'label' => 'Beds',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'bathrooms',
        'type' => 'Text',
        'options' => array(
            'label' => 'Bathrooms',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'halls',
        'type' => 'Text',
        'options' => array(
            'label' => 'Halls',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'surface',
        'type' => 'Text',
        'options' => array(
            'label' => 'Surface',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'garage',
        'type' => 'Text',
        'options' => array(
            'label' => 'Garage',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'pays',
        'type' => 'Text',
        'options' => array(
            'label' => 'Pays',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'ville',
        'type' => 'Text',
        'options' => array(
            'label' => 'Ville',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'prix',
        'type' => 'Text',
        'options' => array(
            'label' => 'Prix',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));
    $this->add(array(
        'name' => 'created_by',
        'type' => 'Text',
        'options' => array(
            'label' => 'created_by',      
        ),
        'attributes' => array(
            'class' => 'form-control'
        )
    ));

    $this->add(array(
        'name' => 'updated_at',
        'type' => 'Text',
        'options' => array(
            'label' => 'updated_at',      
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
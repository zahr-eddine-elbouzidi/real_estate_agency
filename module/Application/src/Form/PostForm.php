<?php
namespace Application\Form;

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
        * name value
        */
       $this->add(array(
           'name' => 'search',
           'type' => 'Text',
          
           'attributes' => array(
               'class' => 'form-control'
           )
       ));

     
     
  

       $this->add(array(
           'name' =>'submit',
           'type' => 'Submit',
           'attributes' => [
            'value' => 'Go',
            'id'    => 'submitbutton',
            ], 
       ));
    }
}
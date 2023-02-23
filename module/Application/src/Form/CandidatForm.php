<?php
namespace Application\Form;

use Laminas\Form\Form;
use Laminas\Form\Fieldset;
use Laminas\Form\Element;

class CandidatForm extends Form
{
    public function __construct($name = null)
    {
        /**
         * init construction
         */
       parent::__construct('candidat');

        /**
         * id contact init id hidden value
         */
       $this->add(array(
           'name' => 'id_candidat',
           'type' => 'Hidden'
       ));


       /*$this->add([
        'type' => Element\Csrf::class,
        'name' => 'csrf',
        'options' => [
            'csrf_options' => [
                'timeout' => 600,
            ],
        ],
       ]);*/

       $this->add(array(
        'name' => 'token',
        'type' => 'Hidden'
      ));
    

       /**
        * name value
        */
       $this->add(array(
           'name' => 'fullname',
           'type' => 'Text',
           'options' => array(
              // 'label' => 'Nom et Prénom',      
           ),
           'attributes' => array(
               'required' => 'required',
               'class' => ''
           )
       ));

       $this->add(array(
        'name' => 'tel',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Téléphone',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

    $this->add(array(
        'name' => 'subject',
        'type' => 'Text',
        'options' => array(
         //   'label' => 'Sujet',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

    $this->add(array(
        'name' => 'email',
        'type' => 'Email',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

    $this->add(array(
        'name' => 'diplome_obtenu',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

 


    $this->add([
        'type' => Element\Select::class,
        'name' => 'niveau_etude',
        'options' => [
            'label' => 'Niveau d\'étude ?',
            'empty_option' => 'Veuillez sélectionner le niveau d\'étude',
            'value_options' => [
                'BAC' => 'BAC',
                'BAC+1' => 'BAC+1',
                'BAC+2' => 'BAC+2',
                'BAC+3' => 'BAC+3',
                'BAC+4' => 'BAC+4',
                'BAC+5' => 'BAC+5',
                'BAC+6' => 'BAC+6',
                'BAC+7' => 'BAC+7',
                'BAC+8' => 'BAC+8'
            ],
        ],
    ]);
  


    $this->add(array(
        'name' => 'filiere',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));


    $this->add(array(
        'name' => 'ville',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));


    $this->add(array(
        'name' => 'pays_destination',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

   

    $this->add([
        'type' => Element\Select::class,
        'name' => 'diplome_langue',
        'options' => [
            'label' => 'Langues ',
            'empty_option' => 'Veuillez sélectionner une option',
            'value_options' => [
                'TCF' => 'TCF',
                'DELF' => 'DELF',
                'DALF' => 'DALF'
                
            ],
        ],
    ]);

    $this->add([
        'type' => Element\Select::class,
        'name' => 'langue_etude',
        'options' => [
            'label' => 'Langue d\'étude',
            'empty_option' => 'Veuillez sélectionner la langue d\'étude ',
            'value_options' => [
                'Français' => 'Français',
                'Englais' => 'Englais',
                'Espagnole' => 'Espagnole',
                'Autre' => 'Autre'
                
            ],
        ],
    ]);

  





     
    
    $this->add(array(
           'name' => 'message',
           'type' => 'Textarea',
           'options' => array(
              // 'label' => 'Message',
           ),
           'attributes' => array(
            'required' => 'required',
               'class' => ''
           )
       ));

     
   

       $this->add(array(
           'name' =>'validate',
           'type' => 'Submit',
           'attributes' =>array(
               'value' => "S'inscrire",
               'id' => 'validate',
               'class' => 'octf-btn octf-btn-dark'
           )
       ));
    }
}
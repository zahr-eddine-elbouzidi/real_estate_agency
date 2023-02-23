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
 

       /**
        * name value
        */
       $this->add(array(
           'name' => 'cin_candidat',
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
        'name' => 'nom_candidat',
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
        'name' => 'prenom_candidat',
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
        'name' => 'date_naiss_candidat',
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
        'name' => 'lieu_naiss_candidat',
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
        'name' => 'nationalite_candidat',
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
        'name' => 'sexe_candidat',
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
        'name' => 'civilite_candidat',
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
        'name' => 'tel_candidat',
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
        'name' => 'adresse_candidat',
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
        'name' => 'ville_candidat',
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
        'name' => 'code_postal_candidat',
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
        'name' => 'pays_candidat',
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
        'name' => 'email_candidat',
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
        'name' => 'num_passport',
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
        'name' => 'date_delivrance_passport',
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
        'name' => 'date_dexpiration_passport',
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
        'name' => 'lieu_delivrance_passport',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

    /**
     * diplome
     */
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
    $this->add(array(
        'name' => 'option_diplome_candidat',
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
        'name' => 'annee_obtention_diplome_candidat',
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
        'name' => 'etab_delivre_diplome_candidat',
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
        'name' => 'niveau_etude',
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
        'name' => 'diplome_langue',
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
        'name' => 'langue_etude',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

    /**
     * programme demandé
     */

   
    $this->add(array(
        'name' => 'pays_demande',
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
        'name' => 'ville_demande',
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
        'name' => 'etablissement_demande',
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
        'name' => 'discipline_demande',
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
        'name' => 'specialite_demande',
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
        'name' => 'qualification_demande',
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
        'name' => 'langue_etude_demande',
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
        'name' => 'niveau_linguistique_demande',
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
        'name' => 'diplome_langue_demande',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

   
    /**
     * père
     */

  
    $this->add(array(
        'name' => 'type_pere',
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
        'name' => 'nom_pere',
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
        'name' => 'prenom_pere',
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
        'name' => 'date_naiss_pere',
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
        'name' => 'nationalite_pere',
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
        'name' => 'lieu_naiss_pere',
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
        'name' => 'cin_pere',
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
        'name' => 'tel_pere',
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
        'name' => 'code_postal_pere',
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
        'name' => 'adresse_pere',
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
        'name' => 'ville_pere',
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
        'name' => 'pays_pere',
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
        'name' => 'email_pere',
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
        'name' => 'profession_pere',
        'type' => 'Text',
        'options' => array(
            //'label' => 'Adresse Email',      
        ),
        'attributes' => array(
            'required' => 'required',
            'class' => ''
        )
    ));

   
  
 
    /**
     * mère
     */

  
    $this->add(array(
        'name' => 'type_mere',
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
        'name' => 'nom_mere',
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
        'name' => 'prenom_mere',
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
        'name' => 'date_naiss_mere',
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
        'name' => 'nationalite_mere',
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
        'name' => 'lieu_naiss_mere',
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
        'name' => 'cin_mere',
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
        'name' => 'tel_mere',
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
        'name' => 'code_postal_mere',
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
        'name' => 'adresse_mere',
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
        'name' => 'ville_mere',
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
        'name' => 'pays_mere',
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
        'name' => 'email_mere',
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
        'name' => 'profession_mere',
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
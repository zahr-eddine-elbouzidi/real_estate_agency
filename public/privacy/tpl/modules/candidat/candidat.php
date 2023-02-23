<style>
  canvas {
    background-color: #f3f3f3;
    -webkit-box-shadow: 3px 3px 3px 0 #e3e3e3;
    -moz-box-shadow: 3px 3px 3px 0 #e3e3e3;
    box-shadow: 3px 3px 3px 0 #e3e3e3;
    border: 1px solid #c3c3c3;
    height: 100px;
    margin: 6px 0 0 6px;
  }

  /* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
 
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

.col-xs-3 {
  float : none;
}
</style> 


<div >
  
  <!--<toaster-container
    toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->



    <div class="bg-light lter b-b wrapper-md"  >
        
        <div class="wrapper-md bg-light dk b-b text-b">
        <!--<b><span class="pull-right m-t-xs">Nombre de poste(s) <b class="badge bg-dark">{{hireEdit.post_number}}</b></span></b>-->
          <h3 class="m-n font-thin text-primary">Informations Personnelles</h3>    
          <h4 class="m-n font-bold text-primary"></h4>  
        </div>
  </div>




  <div class="wrapper-md"  ng-init="steps={step1:true, step2:false, step3:false, step4:false}">

     <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3" > 
                <a  type="button"  class="btn btn-success btn-circle">1</a>
                <p><small>Les informations personnelles</small></p>
            </div>
            <div class="stepwizard-step" > 
                <a ui-sref="app.upload({slug: 'divers'})" type="button" ng-disabled="step1.$invalid" class="btn btn-default btn-circle" >2</a>
                <p><small>Mon dossier de base</small></p>
            </div>
           <!-- <div class="stepwizard-step col-xs-3" ng-if="isProf == true || isProfM == true"> 
                <a href="#step-3" type="button"  class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Jury de la thèse pour les PA</small></p>
            </div>-->
            <div class="stepwizard-step col-xs-3"> 
                <a ui-sref="app.mes-concours" type="button" class="btn btn-default btn-circle">3</a>
                <p><small>Concours</small></p>
            </div>
 
        </div>
    </div>


   <div class="panel panel-default"> 
     
<!--
  <div class="col-lg-6">
<div class="list-group-item">
  
   <progressbar value="advenced" class="progress-striped active progress-xs m-b-sm" animate="true" type="info"><span style="white-space:nowrap;">{{advenced}}%</span></progressbar>
</div>
</div>-->




 
<div class="panel panel-primary setup-content" id="step-1">
<tabset class="tab-container" justified="true" ng-init="steps={percent:20, step1:true, step2:false, step3:false}">
   
   
<tab heading="1 | Informations Personnelles - المعلومات الشخصية" ng-controller="CandidatCtrl">
   <!--<h4>Informations personnelles</h4>-->
    <form name="step1" class="form-validation" ng-submit="saveCandidat()">

     <div class="m-t m-b" >
     <center> <button type="submit"   ng-disabled="step1.$invalid" ng-click="steps.step2=false" class="btn btn-success btn-md" ><i class="fa fa-check"></i> Valider ma candidature | تأكيد المعلومات</button></center>
    </div> 

    
    <div class="panel-body">
      <div class="col-sm-12">

      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
      <a   type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        {{'1. Identification du candidat | Dossier scolaire et universitaire' | uppercase }}
      </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">

      <div class="col-sm-3">

    <p class="label label-primary">Informations Personnelles</p>
    <br />
    <br />
    
    <p class="text-sm">Numéro de dossier</p>
    <input type="text" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le N° de dossier" name="num_dossier" class="form-control input-md" ng-model="candidat.num_dossier" required ng-change="step1.num_dossier.$valid ? (steps.percent=30) : (steps.percent=20)" ng-pattern="/^[A-Z]{1,2}[0-9]+$/" placeholder="N° de dossier">
    <br />

    <p class="text-sm">C.I.N</p>
    <input type="text" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le N° de Carte d'identité Nationale" name="cin" class="form-control input-md" ng-model="candidat.cin_candidat" required ng-pattern="/^[A-Z]{1,2}[0-9]+$/" placeholder="Exemple : XX000000">
    <br />


    <p class="text-sm">Nom</p>
    <input type="text" name="nom" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer votre nom de famille" placeholder="Nom" class="form-control input-md" ng-model="candidat.nom_candidat"  required>
    <br />

    <p  class="text-sm">Prénom</p>
    <input type="text" name="prenom" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer votre prénom " placeholder="Prénom" class="form-control input-md" ng-model="candidat.prenom_candidat"  required>
    <br />

    <p  class="text-sm">Adresse</p>
    <textarea id="adresse_fr" name="adresse_fr" tooltip-trigger="focus"  ng-model="candidat.adresse_candidat" tooltip-placement="top" tooltip="Entrer votre adresse" class="form-control input-md"   required="true" placeholder="Adresse personnelle" >
    </textarea>
    
    <p  class="text-sm">Code postal</p>
    <input type="text" name="code_postal" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le code postal " placeholder="Code postal" class="form-control input-md" ng-model="candidat.code_postal_candidat"  required>
    <br />
    <p  class="text-sm">Pays</p>
    <input type="text" name="pays" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le pays " placeholder="Pays" class="form-control input-md" ng-model="candidat.pays_candidat"  required>
    <br />




    </div>  

    <div class="col-sm-3">

    <p class="label label-primary">Suite (Informations Personnelles)</p>
    <br />
    <br /> 

    <p  class="text-sm">Date de naissance</p>
    <input type="date" name="date_naiss" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer la date de naissance" placeholder="Date de naissance" class="form-control input-md"  ng-model="candidat.date_naiss_candidat" required>
    <br />
    <p  class="text-sm">Lieu de naissance/Ville</p>
    <input type="text" name="lieu_naiss" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le lieu de naissance / ville" placeholder="Lieu de naissance / ville" class="form-control input-md"  ng-model="candidat.lieu_naiss_candidat" required>
    <br />

    <p  class="text-sm">Civilité</p>
    <select id="sexe" name="civilite" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner la civilité " class="form-control input-md"  ng-model="candidat.civilite_candidat" required="true">
    <option>Mme</option>
    <option>Mlle</option>
    <option>Mr</option>
    </select>
    <br />

    <p  class="text-sm">Sexe</p>
    <select id="sexe" name="sexe" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner le genre" class="form-control input-md"  ng-model="candidat.sexe_candidat" required="true">
    <option>Homme</option>
    <option>Femme</option>
    </select>
    <br />

    <p  class="text-sm" >Téléphone</p>
    <input id="tel" type="text" name="tel" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer le Numéro de téléphone " class="form-control input-md"   required placeholder="XXXXXXXXXX" ng-model="candidat.tel_candidat"  />
    <br />

    <p  class="text-sm" >Nationalité</p>
    <input id="nationalite" type="text" name="nationalite" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer la nationalité" class="form-control input-md"   required placeholder="Nationalité (Marocaine,..)" ng-model="candidat.nationalite_candidat"  />
    <br />



    <p  class="text-sm">Email</p>
    <input type="email" name="email" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer l'email " placeholder="Email" class="form-control input-md" ng-model="candidat.email_candidat"  required>
    <br />



    </div>


    <div class="col-sm-3">

    <p class="label label-success">Parcours académique</p>
    <br />
    <br />
    <p  class="text-sm">Niveau d'études actuel</p>

    <select id="diplome" name="diplome" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner votre diplôme de postulation " class="form-control input-md" ng-model="candidat.diplome_obtenu" required="true">
      <option   value="Baccalauréat ou un diplôme équivalent">
      Baccalauréat ou un diplôme équivalent</option>   

      <option  value="DTS,DUT,BTS,DEUG ou un diplôme équivalent">DTS,DUT,BTS,DEUG ou un diplôme équivalent</option>

      <option  value="Licence ou un diplôme équivalent">
      Licence ou un diplôme équivalent</option>

      <option  value="Master ou un diplôme équivalent">
      Master ou un diplôme équivalent</option>

      <option  value="Ingénieur ou un diplôme équivalent">
      Ingénieur ou un diplôme équivalent</option>

      </select>

    <br />

    <p  class="text-sm">Spécialité du diplôme</p>
      <input id="specialite" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer la spécialité du diplôme" name="specialite" class="form-control input-md"  required="true" placeholder="Spécialité du diplôme" ng-model="candidat.specialite" />
    <br />

    <p  class="text-sm">Option</p>
      <input id="specialite" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre option du diplôme" name="specialite" class="form-control input-md"  required="true" placeholder="Option du diplôme" ng-model="candidat.option_diplome_candidat " />
    <br />

    <p  class="text-sm">Année d'obtention</p>
      <input id="annee_obtention" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer l'année d'obtention du diplôme" name="annee_obtention" class="form-control input-md"  required="true" placeholder="Année d'optention du diplôme" ng-model="candidat.annee_obtention_diplome_candidat" />
    <br />

    <p  class="text-sm">Etablissement ayant délivré le diplôme</p>
      <input id="etablissement_diplome" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer l'établissement ayant délivré le diplôme" name="etablissement_diplome" class="form-control input-md"  required="true" placeholder="Etablissement ayant délivré le diplôme" ng-model="candidat.etab_delivre_diplome_candidat" />
    <br />






    </div>  


    <div class="col-sm-3">

    <p class="label label-default">Passport</p>
    <br />
    <br />
    <p  class="text-sm">N° de passport </p>
    <input  type="text" name="num_passport"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Entrer votre numéro de passport" class="form-control input-md" ng-model="candidat.num_passport" required ng-change="step1.num_passport.$valid ? (steps.percent=30) : (steps.percent=20)" placeholder="Numéro de passport">

    <br />


    <p  class="text-sm">Date de délivrance</p>
    <input type="date" name="date_delivrance" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre date de délivrance du passport" placeholder="dd/mm/yyyy" class="form-control input-md" ng-model="candidat.date_delivrance_passport" required>

    <br />

    <p  class="text-sm">Date d'expiration</p>
    <input type="date" name="date_expiration" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre date d'expiration du passport" placeholder="dd/mm/yyyy" class="form-control input-md" ng-model="candidat.date_dexpiration_passport" required>

    <br />

    <p  class="text-sm">Lieu de délivrance</p>
    <input type="text" name="lieu_delivrance" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre lieu de délivrance du passport " placeholder="Lieu de délivrance" class="form-control input-md" ng-model="candidat.lieu_delivrance_passport" required>

    <br />




    </div>  




          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
          <a   type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            {{'2. Programme demandé ' | uppercase }}
          </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
            <div class="col-sm-6">
    
          
              <p  class="text-sm">Pays </p>
              <input  type="text" name="pays_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Pays" class="form-control input-md" ng-model="candidat.pays_demande" required ng-change="step1.pays_demande.$valid ? (steps.percent=30) : (steps.percent=20)" placeholder="Pays">

              <br />

              <p  class="text-sm">Ville </p>
              <input  type="text" name="ville_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Ville" class="form-control input-md" ng-model="candidat.ville_demande" required  placeholder="Ville">

              <br />

              <p  class="text-sm">Nom de l'etablissement </p>
              <input  type="text" name="etablissement_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Etablissement" class="form-control input-md" ng-model="candidat.etablissement_demande" required  placeholder="Etablissement">

              <br />

              <p  class="text-sm">Discipline </p>
              <input  type="text" name="discipline_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Discipline" class="form-control input-md" ng-model="candidat.discipline_demande" required  placeholder="Discipline">

              <br />
              <p  class="text-sm">Spécialité  </p>
              <input  type="text" name="specialite_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Spécialité" class="form-control input-md" ng-model="candidat.specialite_demande" required  placeholder="Spécialité">

              <br />
            </div>

            <div class="col-sm-6">
            <p  class="text-sm">Qualification</p>
              <select id="qualification_demande" name="qualification_demande" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner la qualification " class="form-control input-md"  ng-model="candidat.qualification_demande" required="true">
              <option>Bachelor</option>
              <option>Master</option>
              </select>
              <br />


         

          <p  class="text-sm">Langue d'étude  </p>
          <input  type="text" name="langue_etude_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Langue" class="form-control input-md" ng-model="candidat.langue_etude_demande" required  placeholder="Langue d'étude">

          <br />


          <p  class="text-sm">Niveau linguistique</p>
          <select id="linguistique_demande" name="linguistique_demande" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner le niveau linguistique " class="form-control input-md"  ng-model="candidat.niveau_linguistique_demande" required="true">
          <option>Débutant</option>
          <option>Moyen</option>
          <option>Avancé</option>
          </select>
          <br />

          <p  class="text-sm">Diplôme de langue  </p>
          <input  type="text" name="diplome_langue_demande"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Entrer le diplôme de langue" class="form-control input-md" ng-model="candidat.diplome_langue_demande" required  placeholder="Diplôme de langue">

          <br />


        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a type="button" data-toggle="collapse" data-target="#collapseThree"   aria-expanded="false" aria-controls="collapseThree">
        {{'3. Identification du père ' | uppercase }}
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">

      <div class="col-sm-6">
 

          <p  class="text-sm">Type</p>
          <select id="sexe" name="type_pere" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner le type " class="form-control input-md"  ng-model="candidat.type_pere" required ng-change="step1.type_pere.$valid ? (steps.percent=30) : (steps.percent=20)">
          <option>Garant</option>
          <option>Responsable dossier</option>
          </select>
          <br />

          <p  class="text-sm">Nom </p>
          <input  type="text" name="nom_pere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Nom du père" class="form-control input-md" ng-model="candidat.nom_pere" required  placeholder="Nom du père">

          <br />

          <p  class="text-sm">Prénom </p>
          <input  type="text" name="prenom_pere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Prénom du père" class="form-control input-md" ng-model="candidat.prenom_pere" required  placeholder="Prénom du père">

          <br />

          <p  class="text-sm">Date de naissance</p>
          <input type="date" name="date_naiss_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer la date de naissance du père" placeholder="Date de naissance" class="form-control input-md"  ng-model="candidat.date_naiss_pere" required>
          <br />

          <p  class="text-sm" >Nationalité</p>
          <input id="nationalite_pere" type="text" name="nationalite_pere" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer la nationalité" class="form-control input-md"   required placeholder="Nationalité (Marocaine,..)" ng-model="candidat.nationalite_pere"  />
          <br />

          <p  class="text-sm">Lieu de naissance</p>
          <input type="text" name="lieu_naiss_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le lieu de naissance du père" placeholder="Lieu de naissance" class="form-control input-md"  ng-model="candidat.lieu_naiss_pere" required>
          <br />

          <p  class="text-sm">C.I.N</p>
          <input type="text" name="cin_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Carte d'Identité Nationale du père" placeholder="C.I.N du père " class="form-control input-md"  ng-model="candidat.cin_pere" required>
          <br />

          

         
          
 
        </div>

        <div class="col-sm-6">

        <p  class="text-sm" >Téléphone</p>
          <input id="tel_pere" type="text" name="tel" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer le Numéro de téléphone" class="form-control input-md"   required placeholder="XXXXXXXXXX" ng-model="candidat.tel_pere"  />
          <br />

       
        <p  class="text-sm">Code postal</p>
          <input type="text" name="code_postal_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le code postal " placeholder="Code postal" class="form-control input-md" ng-model="candidat.code_postal_pere"  required>
          <br />


          <p  class="text-sm">Adresse</p>
          <textarea id="adresse_fr_pere" name="adresse_fr_pere" tooltip-trigger="focus"  ng-model="candidat.adresse_pere" tooltip-placement="top" tooltip="Entrer votre adresse" class="form-control input-md"   required="true" placeholder="Adresse personnelle" >
          </textarea>

          <p  class="text-sm">Ville </p>
          <input  type="text" name="ville_pere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Ville" class="form-control input-md" ng-model="candidat.ville_pere" required  placeholder="Ville">

          <br />
          
          
          <p  class="text-sm">Pays</p>
          <input type="text" name="pays_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le pays " placeholder="Pays" class="form-control input-md" ng-model="candidat.pays_pere"  required>
          <br />


          

          <p  class="text-sm">Email</p>
          <input type="email" name="email_pere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer l'email " placeholder="Email" class="form-control input-md" ng-model="candidat.email_pere"  required>
          <br />




      
          <p  class="text-sm">Profession </p>
          <input  type="text" name="profession_pere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Profession du père" class="form-control input-md" ng-model="candidat.profession_pere"  placeholder="Profession">

          <br />


        </div>
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a type="button" data-toggle="collapse" data-target="#collapseFor"   aria-expanded="false" aria-controls="collapseFor">
        {{'4. Identification de la mère ' | uppercase }}
        </a>
      </h4>
    </div>
    <div id="collapseFor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
     
      <div class="col-sm-6">
 
        <p  class="text-sm">Type</p>
          <select id="sexe" name="type_mere" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner le type " class="form-control input-md"  ng-model="candidat.type_mere" required ng-change="step1.type_mere.$valid ? (steps.percent=30) : (steps.percent=20)">
          <option>Garant</option>
          <option>Responsable dossier</option>
          </select>
          <br />
          <p  class="text-sm">Nom </p>
          <input  type="text" name="nom_mere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Nom de la mère" class="form-control input-md" ng-model="candidat.nom_mere" required  placeholder="Nom de la mère">

          <br />

          <p  class="text-sm">Prénom </p>
          <input  type="text" name="prenom_mere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Prénom de la mère" class="form-control input-md" ng-model="candidat.prenom_mere" required  placeholder="Prénom de la mère">

          <br />

          <p  class="text-sm">Date de naissance</p>
          <input type="date" name="date_naiss_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer la date de naissance de la mère" placeholder="Date de naissance" class="form-control input-md"  ng-model="candidat.date_naiss_mere" required>
          <br />

          <p  class="text-sm" >Nationalité</p>
          <input id="nationalite_mere" type="text" name="nationalite_mere" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer la nationalité" class="form-control input-md"   required placeholder="Nationalité (Marocaine,..)" ng-model="candidat.nationalite_mere"  />
          <br />

          <p  class="text-sm">Lieu de naissance</p>
          <input type="text" name="lieu_naiss_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le lieu de naissance de la mère" placeholder="Lieu de naissance" class="form-control input-md"  ng-model="candidat.lieu_naiss_mere" required>
          <br />

          <p  class="text-sm">C.I.N</p>
          <input type="text" name="cin_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Carte d'Identité Nationale de la mère" placeholder="C.I.N de la mère " class="form-control input-md"  ng-model="candidat.cin_mere" required>
          <br />

          
 
        </div>

        <div class="col-sm-6">

        <p  class="text-sm" >Téléphone</p>
          <input id="tel_mere" type="text" name="tel" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer le Numéro de téléphone" class="form-control input-md"   required placeholder="XXXXXXXXXX" ng-model="candidat.tel_mere"  />
          <br />
       
        <p  class="text-sm">Code postal</p>
          <input type="text" name="code_postal_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le code postal " placeholder="Code postal" class="form-control input-md" ng-model="candidat.code_postal_mere"  required>
          <br />


          <p  class="text-sm">Adresse</p>
          <textarea id="adresse_fr_mere" name="adresse_fr_mere" tooltip-trigger="focus"  ng-model="candidat.adresse_mere" tooltip-placement="top" tooltip="Entrer votre adresse" class="form-control input-md"   required="true" placeholder="Adresse personnelle" >
          </textarea>

          <p  class="text-sm">Ville </p>
          <input  type="text" name="ville_mere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Ville" class="form-control input-md" ng-model="candidat.ville_mere" required  placeholder="Ville">

          <br />
          
          
          <p  class="text-sm">Pays</p>
          <input type="text" name="pays_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le pays " placeholder="Pays" class="form-control input-md" ng-model="candidat.pays_mere"  required>
          <br />

 
          <p  class="text-sm">Email</p>
          <input type="email" name="email_mere" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer l'email " placeholder="Email" class="form-control input-md" ng-model="candidat.email_mere"  required>
          <br />

          <p  class="text-sm">Profession </p>
          <input  type="text" name="profession_mere"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Profession de la mère" class="form-control input-md" ng-model="candidat.profession_mere"  placeholder="Profession">

          <br />


        </div>
    </div>
    </div>


  </div>
</div>
</div>
        
      


    </div>

    
  </div>       
    <input type="hidden" name="filename_cv" />
    <input type="hidden" name="filename_diplome" />
    <input type="hidden" name="is_fonctionnaire" />
    <input type="hidden" name="created_by" />


</form>
</tab>


<tab heading="2 | Mes documents - الوثائق" ng-controller="FilesCtrl" ng-mouseenter="refFiles();" ng-init="loadFilesTab();" disabled="step1.$invalid" active="steps.step2" select="steps.percent=30">


<center>
  <h4 class="alert alert-info">خانة إدارة الملف التوظيفي</h4>
  <b class="text-danger">N.B: Vous n'avez pas le droit de supprimer un fichier déjà attaché a un concours postulé, si vous pouvez le supprimer il faut tout d'abord supprimer votre candidature a ce poste. </b>
  <p class="text-danger" style="font-weight: bold;">ملحوظة مهمة : ليس لديك الحق في حدف اي ملف من ملفاتك ادا كان هدا الملف وثيقة أساسية في أحد المباريات التي تقدمت اليها. فادا كنت تريد حدف هدا الملف فيجب عليك أن تحدف المباراة التي تقدمت اليها بهدا الملف أولا في <b class="text-primary"> (الخانة الرابعة المباريات التي ثم التقديم اليها)</b> ثم تقدم الى المباراة من جديد</p>
</center>
<center><a ui-sref="app.upload({slug: 'divers'})" ng-if="piecesManqu.length != 0 && piecesManqu.length != null" class="btn btn-danger btn-md">Votre dossier est incomplet! Veuillez terminer l'importation du dossier <hr />الملف ناقص , المرجو اتمام عملية رفع الملفات</a>  </center>

<br />

<div class="btn-toolbar">
     
    <div class="btn-group">
     <input type="text" ng-model="searchFile"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
    </div>
   <button class="btn btn-md btn-bg btn-info pull-right" ng-click="loadFilesTab();"><i class="fa fa-refresh"></i> Afficher les fichiers - إظهار الملفات</button> 
 </div>

<div class="row">
  <div class="col-lg-8">
  <!--TABLE D'AFFICHAGE -->
  <table  class="table table-bordered small" ng-mouseenter="refFiles();">

    <tr>
         <th data-toggle="true">
          <a    ng-click="sortType = 'file_type'; sortReverse = !sortReverse"  >
           <span  >Fichier - إظهار الملف</span>          
           <span ng-show="sortType == 'file_type' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'file_type' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th> 


       <th data-toggle="true">
            <a    ng-click="sortType = 'filename'; sortReverse = !sortReverse"  >
             <span  >Type du fichier - نوع الملف</span>
             <span ng-show="sortType == 'filename' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'filename' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>


       <th>
        Création - تاريخ رفع الملف
      </th>
      
      <th >
       Action - العملية
     </th>               
   </tr>
   
   <tr ng-repeat="file in fileDatas.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: searchFile | orderBy:sortType:sortReverse">

    <td>
        <a href="{{BASE_URL}}/uploadsFiles/{{file.usr_registration_token}}/files/{{file.filename}}" target="_blank" ><span class="label label-default"><i class="fa fa-download"></i> {{ file.filename }}</span></a>
    </td>
    <td>
        <span>{{file.type_file}}</span> 
    </td>  
    <td>{{file.created_at_file }}</td>
    <td> 
 

      <a data-record-id="{{file.id_file}}" data-record-title="{{file.type_file}}" title="{{ file.filename }}" data-toggle="modal" data-target="#confirm-delete"  ng-click="deleteFile()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i>
      </a>                 
    </td> 
   </tr>
</table>
</div>
<div class="col-lg-4">
  <table  class="table table-bordered small" ng-mouseenter="refFiles();">

    <tr>
         <th data-toggle="true">
          <a    ng-click="sortType = 'type'; sortReverse = !sortReverse"  >
           <span  >Type du fichier - نوع الملف</span>
           <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th> 


       <th data-toggle="true">
            <a    ng-click="sortType = 'nbre_files'; sortReverse = !sortReverse"  >
             <span  >Nbre de fichiers - عدد الملفات</span>
             <span ng-show="sortType == 'nbre_files' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'nbre_files' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
          
   </tr>
   
   <tr ng-repeat="ft in fileDatasType.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | orderBy:sortType:sortReverse">
    <td>
        <span>{{ft.type}}</span> 
    </td>  
    <td>
        <span>{{ft.nbre_files}}</span> 
    </td>  
   </tr>
</table>
<!--Confirmation de dialogue Delete File BEGIN-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" >Confirmation</h4>
                </div>
                <div class="modal-body">
                 <p>
                   
                  Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="title"></i></b>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                
              </div>
            </div>
          </div>
</div> 
<!--Confirmation de dialogue Delete File END-->

</div>
</div>
</tab>

<tab heading="3 | Mes Jury - أعضاء اللجنة" ng-if="isProf == true || isProfM == true" ng-controller="JuryCtrl" ng-mouseenter="ref();"  ng-init="loadJurysMembers();" disabled="step1.$invalid" active="steps.step3" select="steps.percent=30">

 <center>
        <h4 class="alert alert-info">خانة إدارة أعظاء لجنة الأطروحة</h4>
</center>

<center class="alert alert-warning">
  <b ng-if="candidat.diplome !='Doctorat ou un diplôme équivalent (Médecine)' && candidat.diplome != 'Doctorat ou un diplôme équivalent'">
    Partie reservé aux candidats de type (Professeurs Assistants PA)
  </b><br />
  <b>هده الخانة مخصصة للمترشحين الاساتدة المساعدين</b>
</center>


 <table  class="table table-striped small" ng-if="candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent'" >

                <tr>
                  
                  <th data-toggle="true">
                    <a    ng-click="sortType = 'nom_complet'; sortReverse = !sortReverse"  >
                      <span  >Nom et Prénom </span>
                      <span ng-show="sortType == 'nom_complet' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'nom_complet' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

                  <th data-toggle="true">
                    <a    ng-click="sortType = 'etablissement'; sortReverse = !sortReverse"  >
                      <span  >Etablissement, Université </span>
                      <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

          
                  <th data-toggle="true">
                    <a    ng-click="sortType = 'specialite'; sortReverse = !sortReverse"  >
                      <span  >Spécialité  </span>
                      <span ng-show="sortType == 'specialite' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'specialite' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

           

                  <th >
                    Action
                  </th>                  
                </tr>
                <tr ng-repeat="file in jury | orderBy:sortType:sortReverse">
                 <td><span>{{file.nom_complet}}</span></td>  
                 <td><span>{{file.etablissement}}</span></td>  
                  <td><span>{{file.specialite}}</span></td>  

                 <td> 


                  <i  ng-if="date > hireEdit.session_date_end" class="glyphicon glyphicon-lock"></i>


                  <a  data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-dismiss="modal" data-toggle="modal" data-target="#confirm-delete-jury"
                  
                  ng-click="deleteJury(file.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>

                </td> 
              </tr>
            </table>

 

</tab>

  <tab heading="4 | Mes candidatures - المباريات التي ثم التقديم إليها" tooltip-placement="bottom" tooltip="هده الخانة مخصصة للمباريات التي ثم التقدم اليها" 
       ng-controller="PostulationCtrl" disabled="step1.$invalid" active="steps.step4" select="steps.percent=30">



  <div class="btn-toolbar">
     
    <div class="btn-group">
     <input type="text" ng-model="search" style="width: 500px;"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
    </div>
   <button class="btn btn-md btn-bg btn-primary pull-right" ng-click="refreshPostulation();"><i class="fa fa-refresh"></i> Afficher</button> 
 </div>
    <div class="table table-responsive">
    <!--Table suivre ma candidature et historique de postulation -->
    <table  class="table table-striped small" >

         <tr>
          <!-- <th>
            <a    ng-click="sortType = 'num'; sortReverse = !sortReverse"  >
             <span  > N° d'inscription </span>
             <span ng-show="sortType == 'num' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'num' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>-->

        <th>
          <a    ng-click="sortType = 'type_name'; sortReverse = !sortReverse"  >
           <span  > Grade </span>
           <span ng-show="sortType == 'type_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'type_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
        </th>
        <th>
          <a    ng-click="sortType = 'etablissement_name'; sortReverse = !sortReverse"  >
           <span  > Etablissement </span>
           <span ng-show="sortType == 'etablissement_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'etablissement_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
         
       <th>
        <a  ng-click="sortType = 'postuled_at'; sortReverse = !sortReverse" >
         <span > Date de postulation  </span>
         <span ng-show="sortType == 'postuled_at' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'postuled_at' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>

       <th>
        <a  ng-click="sortType = 'session_date_end'; sortReverse = !sortReverse" >
         <span > Date limite de dépôt</span>
         <span ng-show="sortType == 'session_date_end' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'session_date_end' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
       <th>
        <a  ng-click="sortType = 'hire_date'; sortReverse = !sortReverse" >
         <span > Date de concours  </span>
         <span ng-show="sortType == 'hire_date' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'hire_date' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th>
        <a  ng-click="sortType = 'etat'; sortReverse = !sortReverse" >
         <span > Etude préalable de mon dossier </span>
         <span ng-show="sortType == 'etat' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'etat' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th ng-if="display_motif == true">
        <a  ng-click="sortType = 'etatFinale'; sortReverse = !sortReverse" >
         <span > Etat finale de ma candidature </span>
         <span ng-show="sortType == 'etatFinale' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'etatFinale' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th>
        Reçu de dépôt
      </th>
      <th>Motif </th>
      <!--  <th>Convocation</th>  -->
      <th translate="categorie.titles.ACTIONS">
       Action
      </th>
  </tr>

  <tr ng-repeat="hire in postules.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
 
  	  <td>{{hire.type_name}} en <b>{{hire.specialty_fr }}</b></td>
      <td>{{hire.etablissement_name}}</td>
      <td>{{hire.postuled_at | date:'dd-MM-yyyy' }}</td>
      <td>{{hire.session_date_end | date:'dd-MM-yyyy' }}</td>
      <td>{{hire.hire_date | date:'dd-MM-yyyy' }}</td>
      <td>
      <span class="label label-danger label-xs"   ng-if="hire.accepted==0" ><i class="fa fa-ckeck"></i> Le dossier est étudié </span>  
       <span class="label label-success label-xs" ng-if="hire.accepted==1" ><i class="fa fa-ckeck"></i> Le dossier est étudié </span>
       <span class="label label-warning label-xs" ng-if="hire.accepted==2" >Le dossier est en cours d'étude par le service R.H... </span>
      </td>
  
  	 <td ng-if="display_motif == true">
      	<span class="label label-danger label-xs"   ng-if="hire.etatFinale==0" ><i class="fa fa-ckeck"></i> Candidature rejetée. </span>  
        <span class="label label-success label-xs" ng-if="hire.etatFinale==1" ><i class="fa fa-ckeck"></i> Candidature acceptée.</span>
        <span class="label label-warning label-xs" ng-if="hire.etatFinale==2 || hire.etatFinale== null " >Votre candidature est en cours de validation. </span>
      </td>
      <td>




              <form tooltip-placement="top" tooltip="Votre reçu de dépôt est prêt pour l'impression المرجو طباعة الوصل" ng-if="hire.prepared == true" method="POST" action="tpl/recu.php" target="_blank">

                <input type="hidden" name="hidden" value="{{hire}}" />
                <input type="hidden" name="candidat" value="{{candidat}}" />
                <input type="hidden" name="files" value="{{fileDatas}}">
                 <button type="submit" name="submit"  class="btn btn-success btn-md" ><i class="fa fa-print"></i> Imprimer le reçu de dépôt</button>

              </form>


                <button tooltip-placement="top" tooltip="Veuillez préparer votre reçu de dépôt du dossier المرجو تحظير الوصل بالنقر على هدا الزر" type="submit" ng-if="hire.prepared == false || hire.prepared == NULL" ng-click="prepareRecu(hire.postule_id)" class="btn btn-default btn-md font-bold"  ui-toggle-class="show inline" target="#{{hire.postule_id}}">
                <i ng-show="{{hire.prepared}}" class="fa  fa-check"></i>
                <span ng-if="hire.prepared == false || hire.prepared == NULL">Préparer le reçu de dépôt  </span>
                <i class="fa fa-spin fa-spinner hide" id="{{hire.postule_id}}"></i>
              </button>
      </td>
     
   
      <td>
         <p ng-if="hire.etatFinale == 0 && hire.dossier != null">{{hire.dossier }} <span class="label label-success label-xs">Par administrateur</span></p>
       </td>             
       <td>
          <i   ng-if="date > hire.session_date_end || hire.accepted == 1 || hire.accepted == 0" class="glyphicon glyphicon-lock"></i>
          <a tooltip-placement="top" tooltip="Supprimer votre candidature a ce poste حدف تقديمك لهدا المنصب"  ng-if="date <= hire.session_date_end && hire.accepted == 2" data-record-id="{{hire.postule_id}}" data-record-title="{{hire.type_name}} en {{hire.specialty_fr }} - Etablissement {{hire.etablissement_name}}" data-toggle="modal" data-target="#confirm-delete-candidature" ng-click="deletePostuler()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i>
          </a>
       </td>               
     </tr>
               
  </table>

  <div class="modal fade" id="confirm-delete-candidature" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" >Confirmer la suppression</h4>
                </div>
                <div class="modal-body">
                 <p>
                  Vous essayez de supprimer votre candidature de : <br /><b class="text-primary font-bold"><i class="title"></i></b>
                 </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                  <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                </div>
              </div>
            </div>
  </div>

</div>

</tab>



</tabset>
</div>
</div>
</div>
</div>



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
  </style>

  

  <div class="bg-light lter b-b wrapper-md"  >
    <div>
     <h4>Gestion des partenaires</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li><a ui-sref="app.partenaires"> Gestion des Partenaires</a></li>
      <li class="active">Modifier</li>
    </ul>
  </div>


</div>

<div class="wrapper-md" ng-controller="PartEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" >
      Partenaires
    </div>
    
    <form  class="form-horizontal" ng-submit="saveChange(partenaireEdit.id)" >
      
     
     <!-- BEGIN FILE UPLOAD TRAITEMENT -->
     

     
     <div class="form-group">

<div class="col-sm-12">
 <button ng-click="saveChange(partenaireEdit.id)" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-edit"></i> Modifier</button>

 <a href="#/app/partenaires"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>

</div>
</div>
     
     
     
    <div class="form-group">

      <label class="col-lg-2 control-label"  >Etablissement</label>
      <div class="col-lg-8"  >
            <input   type="text" id="etablissement"   class="form-control" ng-model="partenaireEdit.etablissement" 
                  placeholder="Nom de l'établissement" required="true"   />
      </div> 

   </div>

   <div class="form-group">

<label class="col-lg-2 control-label"  >Domaine d'étude</label>
<div class="col-lg-8"  >
 <input   type="text" id="domaine"   class="form-control" ng-model="partenaireEdit.domaine"   />
</div> 

</div>


   <div class="form-group">

      <label class="col-lg-2 control-label">Cycle d'étude</label>
      <div class="col-lg-8"  >
       <input   type="text" id="cycle"   class="form-control" ng-model="partenaireEdit.cycle"   />
     </div> 

   </div>

   <div class="form-group">

    <label class="col-lg-2 control-label">Site web</label>

    <div class="col-lg-8"  >
      <input   type="text" id="site_web"  class="form-control" ng-model="partenaireEdit.site_web"   />
    </div> 

  </div>


<div class="form-group">

<label class="col-lg-2 control-label">Téléphone</label>
<div class="col-lg-8"  >
 <input   type="text" id="tel"   class="form-control" ng-model="partenaireEdit.tel"   />
</div> 

</div>

<div class="form-group">

<label class="col-lg-2 control-label">Adresse Mail</label>
<div class="col-lg-8"  >
 <input   type="text" id="email"   class="form-control" ng-model="partenaireEdit.email"   />
</div> 

</div>

<div class="form-group">

<label class="col-lg-2 control-label">Critères d'admission</label>
<div class="col-lg-8"  >
 <textarea   type="text" id="criteres"   class="form-control" ng-model="partenaireEdit.criteres">
  </textarea>
</div> 

</div>

<div class="form-group">

<label class="col-lg-2 control-label">Filière d'étude</label>
<div class="col-lg-8"  >
 <input   type="text" id="filiere_etude"   class="form-control" ng-model="partenaireEdit.filiere_etude"   />
</div> 

</div>

<div class="form-group">

<label class="col-lg-2 control-label">Coordonateur</label>
<div class="col-lg-8"  >
 <input   type="text" id="coordonateur"   class="form-control" ng-model="partenaireEdit.coordonateur"   />
</div> 

</div>


<div class="form-group">

<label class="col-lg-2 control-label">Pays</label>
<div class="col-lg-8"  >
 <input   type="text" id="pays"   class="form-control" ng-model="partenaireEdit.pays"   />
</div> 

</div>

<div class="form-group">

<label class="col-lg-2 control-label">Frais d'inscription Annuel </label>
<div class="col-lg-8"  >
 <input   type="text" id="frais_inscription_annuel"   class="form-control" ng-model="partenaireEdit.frais_inscription_annuel"   />
</div> 

</div>


<div class="form-group">

<label class="col-lg-2 control-label">Frais de traitement du dossier </label>
<div class="col-lg-8"  >
 <input   type="text" id="frais_traitement_dossier"   class="form-control" ng-model="partenaireEdit.frais_traitement_dossier"   />
</div> 

</div>




  
  
  
  <input id="filename" type="hidden"  name="filename" />
  
  <input id="created_by" type="hidden"  name="created_by" />
  
  <div class="form-group">
   <label class="col-lg-2 control-label" ></label>
   <div class="col-lg-8">
     <input type="submit"  class="btn btn-info" value="Modifier" />
     <a href="#/app/partenaires" class="btn btn-default">Annuler</a>
   </div>
 </div>
</form>




</div>

</div>

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
   <h4>Gestion des fonctionnaires</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des fonctionnaires</li>
  </ul>
</div>


</div>



<div class="wrapper-md" ng-controller="AgentEditCtrl">
 <!-- <toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  <div class="panel panel-default">

    <div class="wrapper-md" >

     
     
     
     
     <form  class="form-horizontal" ng-submit="saveChange(agent.id)" >


       <div class="form-group">
        <label class="col-lg-2 control-label"  >P.P.R</label>
        <div class="col-lg-8">
         <input  type="text" name="agent.doti" class="form-control"  required="true" ng-model="agent.doti" />
         
       </div>
     </div>

     <div class="form-group">
      <label class="col-lg-2 control-label"  >C.I.N</label>
      <div class="col-lg-8">
       <input  type="text" name="agent.cin" class="form-control"  required="true" ng-model="agent.cin" />
       
     </div>
   </div>

   <div class="form-group">
    <label class="col-lg-2 control-label"  >Nom et Prénom </label>
    <div class="col-lg-8">
     <input  type="text" name="agent.nom_complet" class="form-control"  required="true" ng-model="agent.nom_complet" />
     
   </div>
 </div>

 <div class="form-group">
  <label class="col-lg-2 control-label"  >Nom et Prénom (arabe) </label>
  <div class="col-lg-8">
   <input  type="text" name="agent.nom_complet_ar" class="form-control"  required="true" ng-model="agent.nom_complet_ar" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Date de naissance </label>
  <div class="col-lg-8">
   <input  type="date" name="agent.date_naiss" class="form-control"  required="true" ng-model="agent.date_naiss" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Date de recrutement </label>
  <div class="col-lg-8">
   <input  type="date" name="agent.date_rec" class="form-control"  required="true" ng-model="agent.date_rec" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Sexe </label>
  <div class="col-lg-8">

    <select class="form-control" ng-model="agent.sexe">
      <option>M</option>
      <option>F</option>
    </select>
    
  </div>
</div>



<div class="form-group">
  <label class="col-lg-2 control-label" >Grade </label>
  <div class="col-lg-8">
   <input  type="text" name="agent.grade" class="form-control"  required="true" ng-model="agent.grade" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label" >Etablissement </label>
  <div class="col-lg-8">
    <input  type="text" name="agent.etab" class="form-control"  required="true" ng-model="agent.etab" />
    
  </div>
</div>

<div class="form-group">
 
  <label class="col-lg-2 control-label"   ></label>
  <div class="col-sm-4">
   <input type="submit"  class="btn btn-info" value="Modifier" />
   <a href="#/app/agent" class="btn btn-default">Annuler</a>
 </div>
</div>

</form>


</div>



</div>

</div>

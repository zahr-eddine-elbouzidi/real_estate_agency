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
      <h4>Gestion des concours</h4>
      <ul class="breadcrumb bg-white b-a">
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.categorie" > Gestion des catégories</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.type" > Gestion des sous catégories</a></li>
        <li><a ui-sref="app.hires"> Gestion des concours</a></li>
        <li class="active">Modifier</li>
      </ul>
    </div>


  </div>

  <div class="wrapper-md" ng-controller="EditHiresCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading"  >
      Concours
    </div>
    <p>
        <!--<button type="button" class="btn btn-success" 
                ng-click="addCategory()">
               <b class="icon-plus-sign"></b>Add Category
             </button>-->

           </p>
           
           

           
           
           <div class="wrapper-md" >

             
             
             
             
             <form  class="form-horizontal" ng-submit="saveHire(hireEdit.id)" >



                 <div class="form-group">
              <label class="col-lg-3 control-label" >Session</label>
              <div class="col-lg-6">
               <select id="session_id" name="session_id" ng-model="hireEdit.session_id" class="form-control" ng-options="session.id as session.session_date group by session.session_date for session in sessions" id="hireEdit.session_id" name="hireEdit.session_id"  >
                <option required="true">---</option>
              </select>
            </div>
          </div>
              
               <div class="form-group">
                <label class="col-lg-3 control-label" >Type du poste</label>
                <div class="col-lg-6">
                 <select id="type_poste" name="type_poste" ng-model="hireEdit.type_poste" class="form-control"  id="type_poste" name="type_poste"  >
                   <option value="Création">Création</option>
                   <option value="Transformation">Transformation</option>
                 </select>
               </div>
             </div>


             <div class="form-group">
              <label class="col-lg-3 control-label" >Établissement</label>
              <div class="col-lg-6">
               <select id="etablissement_id" name="etablissement_id" ng-model="hireEdit.etablissement_id" class="form-control" ng-options="etablissement.etablissement_id as etablissement.etablissement_name group by etablissement.university_name for etablissement in etablissements" id="hireEdit.etablissement_id" name="hireEdit.etablissement_id"  >
                <option required="true">---</option>
              </select>
            </div>
          </div>

          

          <div class="line line-dashed b-b line-lg pull-in"></div>

          <div class="form-group">
            <label class="col-lg-3 control-label" translate="type.titles.TYPE">Sous-catégorie</label>
            <div class="col-lg-6">
             <select id="type_id" name="type_id" ng-model="hireEdit.type_id" class="form-control" ng-options="type.id as type.nom+' | '+type.nom_ar group by type.categorie_name for type in types" id="type.type_id" name="type.type_id"  >
              <option required="true">---</option>
            </select>
          </div>
        </div>


        <div class="form-group">
          <label class="col-lg-3 control-label" >Code du concours</label>
          <div class="col-lg-6">
           <input id="hire_code" type="text" ng-disabled="true" name="hire_code" class="form-control"  required="true" placeholder="N°/Année" ng-model="hireEdit.hire_code" />
           
         </div>
       </div>
       
       

       <div class="form-group">
        <label class="col-lg-3 control-label" >Spécialité </label>
        <div class="col-lg-6">
         <input id="specialty_fr" type="text" name="specialty_fr" class="form-control"  required="true" ng-model="hireEdit.specialty_fr" />
         
       </div>
     </div>
     


     <!--<div class="form-group">
      <label class="col-lg-3 control-label" >Date limite de dépôt du dossier </label>
      <div class="col-lg-6">
       <input id="session_date_end" type="date" name="session_date_end" class="form-control"   required="true" ng-model="hireEdit.session_date_end" />
     </div>
   </div>


   <div class="form-group">
    <label class="col-lg-3 control-label" >Date du concours </label>
    <div class="col-lg-6">
     <input id="hire_date" type="date" name="hire_date" class="form-control"   required="true" ng-model="hireEdit.hire_date" />
   </div>
 </div>

 <div class="form-group">
  <label class="col-lg-3 control-label" >Adresse du concours </label>
  <div class="col-lg-6">

    <textarea id="adresse"  name="adresse" class="form-control"   required="true" ng-model="hireEdit.adresse">
      
    </textarea>
  </div>
</div>-->




<div class="form-group">
  <label class="col-lg-3 control-label" >Nombre de poste</label>
  <div class="col-lg-6">
   <input id="post_number" type="search" name="post_number" class="form-control"  required="true" ng-model="hireEdit.post_number" />
   
 </div>
 <div class="col-sm-1">
  <input id="color" type="color" name="color" class="form-control"  required="true" ng-model="hireEdit.color" placeholder="color" />
</div>
</div>





<input id="created_by" type="hidden"  name="created_by" />
<input id="id" type="hidden"  name="id" />

<br />
<br />
<div class="form-group">
 
  <label class="col-lg-3 control-label"   ></label>
  <div class="col-sm-4">
   <input type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.editHire || paramsDroit.ctl_all ))"  class="btn btn-info" value="Modifier" />
   <a href="#/app/hires" class="btn btn-default">Annuler</a>
 </div>
</div>
</form>


</div>


</div>


</div>

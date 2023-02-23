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
      <li class="active">Ajouter</li>
    </ul>
  </div>


</div>

<div class="wrapper-md" ng-controller="HiresCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading"  >
      Concours
    </div>
    <p>
 

           </p>
           
           

           
           
           <div class="wrapper-md" >

             
             
             
             
             <form  class="form-horizontal" ng-submit="saveHire()" >


          <div class="form-group">
              <label class="col-lg-3 control-label" >Session</label>
              <div class="col-lg-6">
               <select id="session_id" name="session_id" ng-model="type.session_id" class="form-control" ng-options="session.id as session.session_date group by session.session_date for session in sessions" id="type.session_id" name="type.session_id"  >
                <option required="true">---</option>
              </select>
            </div>
          </div>
              

               
               <div class="form-group">
                <label class="col-lg-3 control-label" >Type du poste</label>
                <div class="col-lg-6">
                 <select id="type_poste" name="type_poste" ng-model="type_poste" class="form-control"  id="type_poste" name="type_poste"  >
                   <option value="Création">Création</option>
                   <option value="Transformation">Transformation</option>
                 </select>
               </div>
             </div>


             <div class="form-group">
              <label class="col-lg-3 control-label" >Établissement</label>
              <div class="col-lg-6">
               <select id="etablissement_id" name="etablissement_id" ng-model="type.etablissement_id" class="form-control" ng-options="etablissement.etablissement_id as etablissement.etablissement_name group by etablissement.university_name for etablissement in etablissements" id="type.etablissement_id" name="type.etablissement_id"  >
                <option required="true">---</option>
              </select>
            </div>
          </div>


          

          

          

          <div class="form-group">
            <label class="col-lg-3 control-label" >Catégories</label>
            <div class="col-lg-6">
             <select id="type_id" name="type_id" ng-model="type.type_id" class="form-control" ng-options="type.id as type.nom+' | '+type.nom_ar group by type.categorie_name for type in types" id="type.type_id" name="type.type_id"  >
              <option required="true">---</option>
            </select>
          </div>
        </div>

        


        <div class="form-group">
          <label class="col-lg-3 control-label" >Code du concours</label>
          <div class="col-lg-6">
           <input id="hire_code" ng-disabled="true" type="text" name="hire_code" class="form-control"   placeholder="Code généré est {{new_code}}" ng-model="hire.hire_code"  />
           
         </div>
       </div>
       
       

       <div class="form-group">
        <label class="col-lg-3 control-label" >Spécialité </label>
        <div class="col-lg-6">
         <input id="specialty_fr" type="text" name="specialty_fr" class="form-control"  required="true" ng-model="hire.specialty_fr" />
         
       </div>
     </div>
 

    <div class="form-group">
      <label class="col-lg-3 control-label" >Nombre de postes</label>
      <div class="col-lg-6">
       <input id="post_number" type="number" name="post_number" class="form-control"  required="true" ng-model="hire.post_number" />
       
     </div>
     <div class="col-sm-1">
       <input id="color" type="color" name="color" class="form-control"  required="true" ng-model="hire.color" placeholder="color" />
       
     </div>
   </div>
   
   


   

   <input id="created_by" type="hidden"  name="created_by" />
   <input id="id" type="hidden"  name="id" />
   
   <br />
   <br />
   <div class="form-group">
     
    <label class="col-lg-2 control-label"   ></label>
    <div class="col-sm-4">
     <input type="submit" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.addHire || paramsDroit.ctl_all ))" class="btn btn-info" value="Ajouter" />
     <a href="#/app/hires" class="btn btn-default">Annuler</a>
   </div>
 </div>
</form>


</div>


</div>


</div>

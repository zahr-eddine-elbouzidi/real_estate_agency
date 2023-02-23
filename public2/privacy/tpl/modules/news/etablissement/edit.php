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
       <h4 >Gestion des établissements</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li><a ui-sref="app.university" >Université</a></li>
        <li><a ui-sref="app.etablissement" >Gestion des établissements</a></li>
        <li class="active" >Modifier</li>
      </ul>
    </div>
  </div>

  <div class="wrapper-md" ng-controller="EtablissementEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" >
      Établissement
    </div>
    
    
    
    <form  class="form-horizontal" ng-submit="saveChange(etablissementEdit.etablissement_id)" >



      <div class="form-group">
        <label class="col-lg-2 control-label"  >Catégories </label>
        <div class="col-lg-8">
         
         <select ng-model="etablissementEdit.university_id" class="form-control" ng-options="university.university_id as university.university_name for university in universities" id="etablissementEdit.university_id" name="etablissementEdit.university_id" required="true">
          <option required="true">---</option>
        </select>   
      </div>
    </div>


    <div class="form-group">
      <label class="col-lg-2 control-label" >Code d'Établissement</label>
      <div class="col-lg-8">
       
        <input id="etablissementEdit.etablissement_code" type="text" name="etablissementEdit.etablissement_code" class="form-control" placeholder="Code d'Établissement" required="true" ng-model="etablissementEdit.etablissement_code" />

      </div>
    </div>

    <div class="form-group">
      <label class="col-lg-2 control-label" >Nom d'Établissement</label>
      <div class="col-lg-8">
       
        <input id="etablissementEdit.etablissement_name" type="text" name="etablissementEdit.etablissement_name" class="form-control" placeholder="Nom d'Établissement" required="true" ng-model="etablissementEdit.etablissement_name" />

      </div>
    </div>

    
    
    <input id="created_by" type="hidden"  name="created_by" />


    <div class="form-group">
     <label class="col-lg-2 control-label"   ></label>
     <div class="col-sm-4">
      <div class="form-actions">
       <input type="submit"  class="btn btn-primary" value="Modifier" />
       <a href="#/app/etablissement" class="btn btn-default">Annuler</a>
     </div>
   </div>
 </div>

</form>





</div>

</div>

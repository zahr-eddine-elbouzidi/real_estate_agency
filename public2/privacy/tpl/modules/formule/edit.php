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
       <h4 >Gestion des formules</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
        <li><a ui-sref="app.formule" >Gestion des formules</a></li>
        <li class="active" >Modifier</li>
      </ul>
    </div>


  </div>

  <div class="wrapper-md" ng-controller="FormuleEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" >
      Formules
    </div>
    
    
    
    <form  class="form-horizontal" ng-submit="saveChange(formuleEdit.id)" >



      <div class="form-group">
        <label class="col-lg-2 control-label"  >Catégories </label>
        <div class="col-lg-8">
         
         <select ng-model="formuleEdit.category_id" class="form-control" ng-options="category.id as category.nom for category in categories" id="formuleEdit.category_id" name="formuleEdit.category_id" required>
          <option required="true">---</option>
        </select>   
      </div>
    </div>

     <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Spécialité</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formuleEdit.coeff_spe" class="form-control"  required ng-model="formuleEdit.coeff_spe" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Génerale</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formuleEdit.coeff_gen" class="form-control"  required ng-model="formuleEdit.coeff_gen" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Orale</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formuleEdit.coeff_ora" class="form-control"  required ng-model="formuleEdit.coeff_ora" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Note de passage</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formuleEdit.pass_note" class="form-control"  required ng-model="formuleEdit.pass_note" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Note de passage (Examen Finale)</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formuleEdit.pass_note_finale" class="form-control"  required ng-model="formuleEdit.pass_note_finale" />

            </div>
          </div>



 <div class="form-group">
   <label class="col-lg-2 control-label"   ></label>
   <div class="col-sm-4">
    <div class="form-actions">
     <input type="submit"  class="btn btn-primary" value="Modifier" />
     <a href="#/app/formule" class="btn btn-default">Annuler</a>
   </div>
 </div>
</div>

</form>





</div>

</div>

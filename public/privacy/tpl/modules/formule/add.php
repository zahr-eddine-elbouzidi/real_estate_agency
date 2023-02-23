  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des formules</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.formule" >Gestion des formules</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="FormuleListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

 

          <div class="panel-heading" >
            Formules
          </div>
          <p>
 
           </p>
           
           
           
           
           <form  class="form-horizontal" ng-submit="saveFormule()" >
             

             <div class="form-group">
              <label class="col-lg-2 control-label" >Catégorie </label>
              <div class="col-lg-8">
               
               <select ng-model="formule.category_id" class="form-control" ng-options="category.id as category.nom for category in categories" id="type.categorie_id" name="type.categorie_id" required>
                <option required="true">---</option>
              </select>   
            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Spécialité</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formule.coeff_spe" class="form-control"  required ng-model="formule.coeff_spe" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Génerale</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formule.coeff_gen" class="form-control"  required ng-model="formule.coeff_gen" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Coeff Orale</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formule.coeff_ora" class="form-control"  required ng-model="formule.coeff_ora" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Note de passage</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formule.pass_note" class="form-control"  required ng-model="formule.pass_note" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Note de passage (Examen Finale)</label>
            <div class="col-lg-8">
             
              <input id="nom" type="text" name="formule.pass_note_finale" class="form-control"  required ng-model="formule.pass_note_finale" />

            </div>
          </div>


 

          <div class="form-group">
           <label class="col-lg-2 control-label"   ></label>
           <div class="col-sm-4">
            <div class="form-actions">      
              <input type="submit"  value="Ajouter" class="btn btn-primary" />
              <a href="#/app/formule" class="btn btn-default">Annuler</a>
            </div>
          </div>  
        </div>
        
      </form>

      <!-- BEGIN PROGRAM -->


      <!-- END PROGRAM -->

      
    </div>

  </div>

  
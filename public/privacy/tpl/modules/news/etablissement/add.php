  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des établissements</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.etablissement" >Gestion des établissements</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="EtablissementListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
            Établissement
          </div>
          <p>
        <!--<button type="button" class="btn btn-success" 
                ng-click="addCategory()">
               <b class="icon-plus-sign"></b>Add Category
             </button>-->

           </p>
           
           
           
           
           <form  class="form-horizontal" ng-submit="saveEtablissement()" >
             
  
          <div class="form-group">
            <label class="col-lg-2 control-label" >Nom d'Établissement</label>
            <div class="col-lg-8">
             
              <input id="etablissement.nom_etablissement" type="text" name="etablissement.nom_etablissement" class="form-control" placeholder="Nom d'Établissement" required="true" ng-model="etablissement.nom_etablissement" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Type d'Établissement</label>
            <div class="col-lg-8">
              <select id="etablissement.type_etablissement" class="form-control"  required="true" ng-model="etablissement.type_etablissement">
                <option>Hight School</option>
                <option>University</option>
                <option>Language School</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Pays d'Établissement</label>
            <div class="col-lg-8">
             
              <input id="etablissement.pays_etablissement" type="text" name="etablissement.pays_etablissement" class="form-control" placeholder="Pays d'Établissement" required="true" ng-model="etablissement.pays_etablissement" />

            </div>
          </div>

          

          
          
          <input id="created_by" type="hidden"  name="created_by" />

          <div class="form-group">
           <label class="col-lg-2 control-label"   ></label>
           <div class="col-sm-4">
            <div class="form-actions">      
              <input type="submit"  value="Ajouter" class="btn btn-primary" />
              <a href="#/app/etablissement" class="btn btn-default">Annuler</a>
            </div>
          </div>  
        </div>
        
      </form>

      <!-- BEGIN PROGRAM -->


      <!-- END PROGRAM -->

      
    </div>

  </div>

  
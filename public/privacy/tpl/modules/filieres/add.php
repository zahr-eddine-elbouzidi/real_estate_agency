  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4>Gestion des filières</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.filieres" >Gestion des filières</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="FiliereListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

         

          <div class="panel-heading" >
            Filières
          </div>
     
    
           <form  class="form-horizontal"   >
           <div class="form-group">
             
             
             <div class="col-sm-12">
              <button ng-click="saveFiliere()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>

              <a href="#/app/filieres"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>




             <div class="form-group">
              <label class="col-lg-2 control-label" >Etablissement </label>
              <div class="col-lg-8">
               
               <select ng-model="filiere.etablissement_id" class="form-control" 
                  ng-options="etablissement.id_etablissement as etablissement.nom_etablissement group by  ('Pays : '+etablissement.pays_etablissement+' | Type : '+etablissement.type_etablissement) for etablissement in etablissements" 
                  id="filiere.etablissement_id" name="filiere.etablissement_id" required>
                <option required="true">---</option>
              </select>   
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label" >Nom de la filière</label>
            <div class="col-lg-8">
             
              <input id="filiere.nom_filiere" type="text" name="filiere.nom_filiere" class="form-control" placeholder="Nom de la filière" required ng-model="filiere.nom_filiere" />

            </div>
          </div>

         

 
        
        
      </form>

      <!-- BEGIN PROGRAM -->


      <!-- END PROGRAM -->

      
    </div>

  </div>

  
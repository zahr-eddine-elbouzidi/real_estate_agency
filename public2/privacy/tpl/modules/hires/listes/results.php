   <div ng-controller="ResultsCtrl" ng-init="load();">
 

  <div class="bg-light lter b-b wrapper-md"   >
    <div>
      


      <h4>Gestion des résultats</h4>
      <ul class="breadcrumb bg-white b-a">
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.categorie" > Gestion des catégories</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.type" > Gestion des sous catégories</a></li>
        <li><a ui-sref="app.hires"> Gestion des concours</a></li>
        <li class="active">Gestion des résultats</li>
      </ul>

      

    <div class="wrapper-md bg-light dk b-b text-b">
 
		  <h2 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h2>       
		  <h4 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h4>      
		  <h4 class="m-n font-thin">Code : {{hireEdit.hire_code}} </h4>      
		  <h4 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date |  date:'dd-MM-yyyy' }}</h4> 
		  <h4 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h4> 
  </h5>
	</div>

 </div>

   
   <div class="wrapper-md" >

       

    <div class="panel panel-default">

    	<div class="row">
    		<center>
    			<a ng-click="initDisplayedResultats('ecrit');" class="btn btn-danger btn-md">Supprimer le fichier (Convoqués aux épreuves écrites)</a>
	    		<a ng-click="initDisplayedResultats('oral');" class="btn btn-danger btn-md">Supprimer le fichier (Convoqués aux épreuves orales)</a>
	    		<a ng-click="initDisplayedResultats('final');" class="btn btn-danger btn-md">Supprimer le résultat final</a>
    		</center>
    	</div>
     
   <div class="wrapper-md" >
 			
 	 <div class="form-group">
        <label class="col-sm-4 control-label">Type de résultat</label>
        <div class="col-lg-8">
          <select   class="form-control input-sm" ng-model="type"  >

            <option value="ecrit">Liste des candidats convoqués aux épreuves écrites</option>
            <option value="oral">Liste des candidats convoqués aux épreuves orales</option>
            <option value="final">Liste des admis + Liste d'attente (Résultat finale)</option>
            
            
          </select>
        </div>
      </div>

 	  <br />
      <br />
      <div class="form-group">
        <label class="col-sm-4 control-label">Description</label>
        <div class="col-lg-8">
          <textarea class="form-control" ng-model="description"  >  
          </textarea>
        </div>
      </div>
      <br />
      <br />

      <div class="form-group">
        <label class="col-sm-4 control-label">Sélectionner un fichier (.PDF)</label>
        <div class="col-lg-8">
          <input type="file" nv-file-select="" id="file_upload"  accept=".pdf"   uploader="uploader" ng-click="uploader.clear()"  />
          
        </div>
      </div>
      <br /><br />

      <div class="form-group">
       
        <label class="col-sm-4 control-label">Détails</label>
        <div class="col-lg-8">
          
         <div class="table-responsive">
          
          <table class="table bg-white-only b-a" style="height: 50px;">
            <thead>
              <tr>
                <th class="text-dark" width="50%">Fichier</th>
                <th class="text-dark" ng-show="uploader.isHTML5">Taille</th>
                <th class="text-dark" ng-show="uploader.isHTML5">Progression</th>
                <th class="text-dark">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="item in uploader.queue">
                
                
                <td>
                  <strong class="text-primary">{{ filename }}</strong>
                  
                  <!--<div class="alert alert-danger" >La taille du fichier {{ filename }} doit être inférieur ou égale 500Ko</div>-->
                </td>
                <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024 |number:2 }} MB</td>
                <td ng-show="uploader.isHTML5">
                  <div class="progress progress-sm m-b-none m-t-xs">
                    <div class="progress-bar bg-info" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                  </div>
                </td>
                
                
                <td nowrap>
                  
                  <button type="button" ng-if="invalidate==false" class="btn btn-primary btn-xs"  ng-click="uploadImage(item)" >
                    Importer et Valider
                  </button>
                  <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                    Supprimer
                  </button>


                </td>
              </tr>
            </tbody>
          </table> 
        </div>

      </div>    

     
      <form method="post">
                <div class="form-group" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.gestionR || paramsDroit.ctl_all ))" >
                  <label class="i-switch m-t-xs m-r">
                    <input type="checkbox"  ng-checked="hireEdit.displayed == 1" ng-model="hireEdit.displayed" ng-click="getChangeConcoursDisplayed(hireEdit.displayed)" >
                    <i></i>
                  </label> 
                  <b><label class="col-sm-8 control-label text-md">Afficher les résultats ?</label></b>
                </div>              
            </form>

      <br />
      <br />


 		</div>	

        
   </div>


  </div>
  </div>

     
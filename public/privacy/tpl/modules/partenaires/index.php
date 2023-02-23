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

  

  <div class="bg-light lter b-b wrapper-md"   >
    <div>
     <h4>Gestion des partenaires</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li class="active" >Gestion des partenaires</li>
    </ul>
  </div>


</div>



<div class="wrapper-md" ng-controller="PartListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addPartenaire" class="btn btn-info btn-xs" style="width: 100px;">Ajouter  <i class="fa fa-plus"></i></a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">


 <div class="panel-heading" >
            Partenaires
          </div>
   
          <div class="row">
          <div class="form-group">

<label class="col-lg-2 control-label" >Sélectionner un fichier </label>
<div class="col-lg-8 bg-default"  >

    
<span class="pull-right m-t-xs">Element(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
     

  <input type="file" nv-file-select="" id="file_upload" uploader="uploader" ng-click="uploader.clear()"  />

         <table class="table bg-white-only b-a">
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
                                        <strong class="label label-primary">{{ filename }}</strong>
                                         <!-- Image preview -->
                                        <!--auto height-->
                                        <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
                                        <!--auto width
                                        <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>-->
                                        <!--fixed width and height -->
                                        <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
    </td>
                      <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
                      <td ng-show="uploader.isHTML5">
                          <div class="progress progress-sm m-b-none m-t-xs">
                              <div class="progress-bar bg-info" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                          </div>
                      </td>
                     
                     
                      <td nowrap>
                          <button type="button" class="btn btn-default btn-xs" ng-click="uploadImage(item);" translate="upload.titles.UPLOAD">
                              importer
                          </button>
                          <button type="button" class="btn btn-default btn-xs" ng-click="item.remove()">
                              Supprimer
                          </button>


                      </td>
                  </tr>
              </tbody>
          </table> 

</div>   
</div>
</div>
<br />
<br />
   <!-- BEGIN FILE UPLOAD TRAITEMENT -->
  <div class="table-responsive">
    
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
      
    </blockquote>

    
    <div style="float: right;">
     <!-- <label class="col-sm-2 control-label" translate="operations.VIEW" >Afficher</label>-->
     
     
     
     
     
   </div>
   
        <!--<span translate="operations.RECORDS" >records.</span>
        <br />
        <br />-->
        
        <table  class="table table-striped" >

         <tr>
          <th>
            <a ng-click="sortType = 'etablissement'; sortReverse = !sortReverse"  >
             <span  >Etablissement</span>
             <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          
           <th>
            <a    ng-click="sortType = 'domaine'; sortReverse = !sortReverse"  >
             <span  > Domaine d'étude</span>
             <span ng-show="sortType == 'domaine' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'domaine' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         
         <th>
          <a  ng-click="sortType = 'cycle'; sortReverse = !sortReverse">
           <span > Cycle d'étude  </span>
           <span ng-show="sortType == 'cycle' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'cycle' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'site_web'; sortReverse = !sortReverse">
           <span > Site web </span>
           <span ng-show="sortType == 'site_web' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'site_web' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'tel'; sortReverse = !sortReverse">
           <span > Téléphone </span>
           <span ng-show="sortType == 'tel' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'tel' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'email'; sortReverse = !sortReverse">
           <span > Email </span>
           <span ng-show="sortType == 'email' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'email' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'criteres'; sortReverse = !sortReverse">
           <span > Critères </span>
           <span ng-show="sortType == 'criteres' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'criteres' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'filiere_etude'; sortReverse = !sortReverse">
           <span > Filière d'étude </span>
           <span ng-show="sortType == 'filiere_etude' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'filiere_etude' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'coordonateur'; sortReverse = !sortReverse">
           <span > Coordonateur </span>
           <span ng-show="sortType == 'coordonateur' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'coordonateur' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'pays'; sortReverse = !sortReverse">
           <span > Pays </span>
           <span ng-show="sortType == 'pays' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'pays' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'frais_inscription_annuel'; sortReverse = !sortReverse">
           <span > Frais d'inscription Annuel </span>
           <span ng-show="sortType == 'frais_inscription_annuel' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'frais_inscription_annuel' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       
       <th>
          <a  ng-click="sortType = 'frais_traitement_dossier'; sortReverse = !sortReverse">
           <span > Frais de traitement du dossier  </span>
           <span ng-show="sortType == 'frais_traitement_dossier' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'frais_traitement_dossier' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>


       
       <th>
        <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
         <span > Créée par  </span>
         <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     <th  ng-show="role == 'SuperviseurT'">
       Action
     </th>
     
     
     
   </tr>
   <tr>
   </tr>
   <tr ng-repeat="partenaire in partenaires.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    <td>{{ partenaire.etablissement }}</td>
    <td>{{ partenaire.domaine }}</td>
    <td>{{ partenaire.cycle }}</td>
    <td>
        {{ partenaire.site_web }}
    </td>
    <td>
        {{ partenaire.tel }}
    </td>
    <td>{{ partenaire.email }}</td>
    <td>{{ partenaire.criteres }}</td>
    <td>{{ partenaire.filiere_etude }}</td>
    <td>{{ partenaire.coordonateur }}</td>
    <td>{{ partenaire.pays }}</td>
    <td>{{ partenaire.frais_inscription_annuel }}</td>
    <td>{{ partenaire.frais_traitement_dossier }}</td>
    
    <td><span class="label label-primary label-xs">{{ partenaire.created_by }}</span></td>
    

    <td  ng-show="role == 'SuperviseurT'"> 

     <a   ng-click="getElement(partenaire)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a> 

     <a   data-record-id="{{partenaire.id}}" data-record-title="{{partenaire.etablissement}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"
     ng-click="deletePartenaire()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td> 
     
   </tr>
 </table>

 

 <div class="form-group">
   <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


 </div>
 
 
 
 
 
</div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" >Gestion des partenaires</h4>
      </div>
      <div class="modal-body">
       <p>
         
        Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="title"></i></b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
        <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
        
      </div>
    </div>
  </div>
</div>
</div>

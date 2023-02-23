<?php

/**
 * @Author: zahr
 * @Date:   2019-07-11 01:00:20
 * @Last Modified by:   zahr
 * @Last Modified time: 2019-07-11 01:08:11
 */
?>
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



<div class="wrapper-md" ng-controller="AgentCtrl"  nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter">

 <!-- <toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  <a ui-sref="app.addFonctionnaires" class="btn btn-info btn-xs" style="width: 100px;"> Ajouter </a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">



  <a  ng-if="(role == 'Superviseur')"  data-toggle="modal"  data-target="#confirm-resultat"  title="{{'operations.DELETEOP' | translate}}" 
  class="btn btn-primary btn-xs pull-right">Importer la liste des professeurs</a><br />
  
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
           <th>N°</th>
           
           
           <th>
            <a    ng-click="sortType = 'nom_complet'; sortReverse = !sortReverse"  >
             <span  > Doti | Nom et Prénom </span>
             <span ng-show="sortType == 'nom_complet' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'nom_complet' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         
         <th>
          <a  ng-click="sortType = 'grade_id'; sortReverse = !sortReverse">
           <span  > Grade </span>
           <span ng-show="sortType == 'grade_id' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'grade_id' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       
       <th>
        <a  ng-click="sortType = 'etablissement_id'; sortReverse = !sortReverse" >
         <span > Etablissement</span>
         <span ng-show="sortType == 'etablissement_id' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'etablissement_id' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     <th>
       Action
     </th>

     
     
     
   </tr>
   <tr>
   </tr>
   <tr ng-repeat="agent in agents.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    <td>{{$index}}</td> 
    
    <td>{{ agent.doti }} | {{ agent.nom_complet }}</td>                   
    

    <td >
     {{ agent.grade_id }} 
   </td>
   <td><span class="label label-default"> {{ agent.etablissement_id}}</span></td>
   

   
   <td> <a   ng-click="getElement(agent)" title="{{'operations.EDITOP' | translate}}"><i class="fa fa-edit"></i></a> </td>
 </tr>
</table>



<div class="form-group">
 <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  
 ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


</div>





</div>
</div>
           <!-- <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel" translate="categorie.titles.SUPTITLECAT">Confirm Delete</h4>
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
                  </div>-->


                  <div class="modal fade" id="confirm-resultat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top:200px;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title" id="myModalLabel" >Importer la liste des professeurs <b><u><i class="title"></i></u></b></h4>
                        </div>
                        <div class="modal-body">


                         <div class="form-group">
                          <label class="col-sm-4 control-label">Sélectionner un fichier (.xls)</label>
                          <div class="col-lg-8">
                            <input type="file" nv-file-select="" id="file_upload"  accept=".xlsx"   uploader="uploader" ng-click="uploader.clear()"  />
                            
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
                                    
                                    <button type="button"  class="btn btn-primary btn-xs"  ng-click="uploadImage(item)" >
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

                        <br />
                        <br />



                        
                        
                      </div> 
                      
                    </div>
                    <div class="modal-footer" style="clear:both;">
                      <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button> 
                    </div>
                  </div>
                </div>
              </div> 





              <div class="modal fade" id="confirm-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title" id="myModalLabel" >Situation</h4>
                    </div>
                    <div class="modal-body">
                      
                     <table  class="table table-striped small" >
                      <tr>
                       

                        <th>
                          <a    ng-click="sortType = 'annee'; sortReverse = !sortReverse"  >
                           <span  > Année </span>
                           <span ng-show="sortType == 'annee' && !sortReverse" class="fa fa-caret-down"></span>
                           <span ng-show="sortType == 'annee' && sortReverse" class="fa fa-caret-up"></span>
                         </a>
                       </th>
                       
                       <th>
                        <a  ng-click="sortType = 'total_annel'; sortReverse = !sortReverse">
                         <span  > Nbre de jours Administratif </span>
                         <span ng-show="sortType == 'total_annel' && !sortReverse" class="fa fa-caret-down"></span>
                         <span ng-show="sortType == 'total_annel' && sortReverse" class="fa fa-caret-up"></span>
                       </a>
                     </th>

                     <th>
                      <a  ng-click="sortType = 'total_excep'; sortReverse = !sortReverse">
                       <span  > Nbre de jours Exceptionnel </span>
                       <span ng-show="sortType == 'total_excep' && !sortReverse" class="fa fa-caret-down"></span>
                       <span ng-show="sortType == 'total_excep' && sortReverse" class="fa fa-caret-up"></span>
                     </a>
                   </th>

                 </tr>
                 
                 <tr ng-repeat="state in states.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
                   
                  <td style="text-align: left;">
                   <span ng-if="state.total_annel == 0" style="background-color: #fbc1bf;">{{ state.annee }}</span> 
                   <span ng-if="state.total_annel != 0" style="background-color: #c2fec5;">{{ state.annee }}</span> 
                 </td>
                 <td style="text-align: left;">
                  
                  <span ng-if="state.total_annel == 0" style="background-color: #fbc1bf;">{{ state.total_annel }}</span> 
                  <span ng-if="state.total_annel != 0" style="background-color: #c2fec5;">{{ state.total_annel }}</span> 
                </td>

                <td style="text-align: left;">
                  
                  <span ng-if="state.total_excep == 0" style="background-color: #fbc1bf;">{{ state.total_excep }}</span> 
                  <span ng-if="state.total_excep != 0" style="background-color: #c2fec5;">{{ state.total_excep }}</span> 
                </td>
                
                
                
                
              </tr>

            </table>
            
          </div>
          <div class="modal-footer">
           
            <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
            
          </div>
        </div>
      </div>
    </div>
  </div>

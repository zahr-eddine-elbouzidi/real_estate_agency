<?php

/**
 * @Author: zahr
 * @Date:   2020-08-30 01:43:43
 * @Last Modified by:   zahr
 * @Last Modified time: 2020-08-30 02:57:59
 */
?>

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Candidats inscrits</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des candidats</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="CandidatsListCtrl">
 <button class="btn btn-default btn-md rounded padder pull-left" ng-click="load();"><i class="fa fa-refresh"></i> Afficher la liste des inscrits</button> &nbsp;&nbsp;&nbsp;
 <button ui-sref="app.profil"  class="btn btn-primary btn-md rounded padder pull-left" ><i class="fa fa-refresh"></i> Ajouter candidat</button> &nbsp;&nbsp;&nbsp;

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

   <span class="btn btn-primary btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 


 <div class="panel panel-default" style="clear:both;" ng-init="load();">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
             Candidats    
          </div>

          <div class="pull-right">
            <button class="btn btn-primary btn-md padder" ng-click="exportData();"><i class="fa fa-file"></i> Préparer la liste des inscrits</button> 
            <a class="btn btn-success btn-md padder" href="{{BASE_URL}}/data_iew.xlsx" ><i class="fa fa-download"></i> Télécharger la liste des inscrits</a> 
          </div>
          <br />
          
          <div class="table-responsive" style="clear:both;">

          
           <blockquote>
            <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
          </blockquote>

          

         <!-- <span translate="operations.VIEW">Afficher</span> <select ng-model="viewby" ng-change="setItemsPerPage(viewby)">
        
            <option>5</option>
            <option>10</option>
            <option>20</option>
            <option>Tous</option>
        
        </select> <span translate="operations.RECORDS">records.</span>
        <br />
        <br />-->
        <table  class="table table-striped" >
         <tr>

         <th>
          <a   ng-click="sortType = 'full_name'; sortReverse = !sortReverse">
           <span  > Nom et Prénom    </span>
           <span ng-show="sortType == 'full_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'full_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>


           <th>
            <a  ng-click="sortType = 'email'; sortReverse = !sortReverse">
             <span  > Email  </span>
             <span ng-show="sortType == 'email' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'email' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>




        <th>
          <a   ng-click="sortType = 'tel'; sortReverse = !sortReverse">
           <span  > Téléphone  </span>
           <span ng-show="sortType == 'tel' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'tel' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a   ng-click="sortType = 'subject'; sortReverse = !sortReverse">
           <span  > Sujet  </span>
           <span ng-show="sortType == 'subject' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'subject' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a   ng-click="sortType = 'country'; sortReverse = !sortReverse">
           <span  > Pays  </span>
           <span ng-show="sortType == 'country' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'country' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>


        <th>
            <a   ng-click="sortType = 'message'; sortReverse = !sortReverse">
             <span  > Message</span>
             <span ng-show="sortType == 'message' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'message' && sortReverse" class="fa fa-caret-up"></span>
           </a>
        </th>


	       <th>
	        <a  ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
	         <span  > Date création </span>
	         <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
	         <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
	       </a>
	     </th>
                           
        <th ng-if="role == 'SuperviseurT'">
          Actions 
        </th>
       </tr>
      
       <tr ng-repeat="candidat in candidats.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    
        <td>{{ candidat.fullname }}</td>
        <td>{{ candidat.tel }}</td>
        <td>{{ candidat.email }}</td>
        <td>{{ candidat.subject }}</td>
        <td>{{ candidat.country_engine }}</td>
        <td>{{ candidat.message }}</td>
        <td>{{ candidat.created_at | date:"MM/dd/yyyy 'at' h:mma" }}</td>  
        <td>
          <a   ng-click="getInscriptions(candidat)" title="Gestion de inscriptions" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Inscriptions</a>
        </td>                      
        </tr>
      </table>

                        


                        <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>
                        

                        
                        <!-- Trigger the modal with a button -->
                        
                        <!-- Modal pour l'edition des information-->

                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel" >Confirmation</h4>
                              </div>
                              <div class="modal-body">
                               <p>
                                 
                                Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="title"></i></b>

                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                              <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                              
                            </div>
                          </div>
                        </div>
                      </div>

                      <!--fin modal d'edition des information -->
                    </div>
                  </div>

                </div>


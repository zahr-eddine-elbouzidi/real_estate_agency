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
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

   <span class="btn btn-primary btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
          Candidats    </div>
          
          <div class="table-responsive">

           

           <blockquote>
            <input type="text" ng-model="search"  class="form-control input-sm bg-white rounded padder" placeholder="Rechercher..."> 
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
         		ACT
         	</th>
           <th>
            <a   ng-click="sortType = 'usr_email'; sortReverse = !sortReverse">
             <span  > Email  </span>
             <span ng-show="sortType == 'usr_email' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'usr_email' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
            <a   ng-click="sortType = 'created_by'; sortReverse = !sortReverse">
             <span  > Créée par  </span>
             <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
            <a   ng-click="sortType = 'cin'; sortReverse = !sortReverse">
             <span  > C.I.N  </span>
             <span ng-show="sortType == 'cin' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'cin' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
          <a   ng-click="sortType = 'full_name_fr'; sortReverse = !sortReverse">
           <span  > Nom et Prénom (Fr)  </span>
           <span ng-show="sortType == 'full_name_fr' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'full_name_fr' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

        <th>
          <a   ng-click="sortType = 'full_name_ar'; sortReverse = !sortReverse">
           <span  > Nom et Prénom (Ar)  </span>
           <span ng-show="sortType == 'full_name_ar' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'full_name_ar' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

        <th>
            <a   ng-click="sortType = 'date_naiss'; sortReverse = !sortReverse">
             <span  > Date de naissance </span>
             <span ng-show="sortType == 'date_naiss' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'date_naiss' && sortReverse" class="fa fa-caret-up"></span>
           </a>
        </th>
        <th>
            <a   ng-click="sortType = 'lieu_naiss'; sortReverse = !sortReverse">
             <span  > Lieu de naissance </span>
             <span ng-show="sortType == 'lieu_naiss' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'lieu_naiss' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         <th>
            <a   ng-click="sortType = 'tel'; sortReverse = !sortReverse">
             <span  > Tél </span>
             <span ng-show="sortType == 'tel' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'tel' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'adresse_fr'; sortReverse = !sortReverse">
             <span  > Adresse (Fr) </span>
             <span ng-show="sortType == 'adresse_fr' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'adresse_fr' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'adresse_ar'; sortReverse = !sortReverse">
             <span  > Adresse (Ar) </span>
             <span ng-show="sortType == 'adresse_ar' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'adresse_ar' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
	        <a  ng-click="sortType = 'etablissement'; sortReverse = !sortReverse">
	         <span  > Fonctionnaire ? </span>
	         <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
	         <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
	       </a>
	     </th>

	      <th>
	        <a  ng-click="sortType = 'is_fonctionnaire'; sortReverse = !sortReverse">
	         <span  > Candidat Handicap </span>
	         <span ng-show="sortType == 'is_fonctionnaire' && !sortReverse" class="fa fa-caret-down"></span>
	         <span ng-show="sortType == 'is_fonctionnaire' && sortReverse" class="fa fa-caret-up"></span>
	       </a>
	     </th>

          <th>
            <a   ng-click="sortType = 'diplome'; sortReverse = !sortReverse">
             <span  > Diplôme </span>
             <span ng-show="sortType == 'diplome' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'diplome' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
            <a   ng-click="sortType = 'specialite'; sortReverse = !sortReverse">
             <span  > Spécialité </span>
             <span ng-show="sortType == 'specialite' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'specialite' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

	       <th>
	        <a  ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
	         <span  > Date création </span>
	         <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
	         <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
	       </a>
	     </th>
                           
        <th ng-if="role == 'Superviseur'">
          Actions 
        </th>
       </tr>
      
       <tr ng-repeat="candidat in candidats.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
       <td>
        	<a ng-click="redirect(candidat);" class="btn btn-default btn-xs">Afficher les détails</a>
        </td>
        <td>{{ candidat.usr_email }}</td>
        <td>{{ candidat.created_by }}</td>
        <td>{{ candidat.cin }}</td>
        <td>{{ candidat.full_name_fr }}</td>
        <td>{{ candidat.full_name_ar }}</td>
        <td>{{ candidat.date_naiss }}</td>
        <td>{{ candidat.lieu_naiss }}</td>
        <td>{{ candidat.tel }}</td>
        <td>{{ candidat.adresse_fr }}</td>
        <td>{{ candidat.adresse_ar }}</td>
        <td>{{ candidat.etablissement }}</td>
        <td>{{ candidat.is_fonctionnaire }}</td>
        <td>{{ candidat.diplome }}</td>
        <td>{{ candidat.specialite }}</td>
        <td>{{ candidat.created_at }}</td>                             
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


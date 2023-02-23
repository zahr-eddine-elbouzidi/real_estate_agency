<?php

/**
 * @Author: zahr
 * @Date:   2020-08-30 01:43:43
 * @Last Modified by:   zahr
 * @Last Modified time: 2020-08-30 02:58:09
 */
?>

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Le journal de postulation</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Journal de postulation</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="CandidatPostuledLogListCtrl">


  <div class="wrapper-md bg-light dk b-b text-b">


            <h4 class="m-n font-bold text-primary">Candidat : {{candidat.nom | uppercase}} {{candidat.prenom | uppercase}} | {{candidat.prenom_ar}} {{candidat.nom_ar}}</h4>

            <h5 class="m-n font-thin">Carte d'Identité Nationale : {{candidat.cin}} </h5>      
            <h5 class="m-n font-thin">Téléphone : {{candidat.tel}} </h5>      
            <h5 class="m-n font-thin">Sexe : {{candidat.sexe}} </h5>      
            <h5 class="m-n font-thin">Date de naissance : {{candidat.date_naiss |  date:'dd-MM-yyyy'}} </h5>      
            <h5 class="m-n font-thin">Lieu de naissance : {{candidat.lieu_naiss | uppercase}} </h5>      
            <h5 class="m-n font-thin">Diplôme : {{candidat.diplome}} </h5>      
            <h5 class="m-n font-thin">Spécialité : {{candidat.specialite | uppercase}} </h5>      
            <h5 class="m-n font-thin">Mention : {{candidat.mention}} </h5>      
            <h5 class="m-n font-thin">Année d'obtention : {{candidat.date_obtention}} </h5>      
            <h5 class="m-n font-thin">Adresse : {{candidat.adresse_fr | uppercase}} | {{candidat.adresse_ar}}</h5>      
            <h5 class="m-n font-thin">Candidat Handicapé ? : <span ng-if="candidat.is_fonctionnaire == 0">Non</span><span ng-if="candidat.is_fonctionnaire == 1">Oui</span> </h5>      
            <h5 class="m-n font-thin">Candidat Fonctionnaire ? : <span ng-if="candidat.etablissement != null && candidat.etablissement != ''">Oui - Organisme : {{candidat.etablissement | uppercase}}</span><span ng-if="candidat.etablissement == null || candidat.etablissement == ''">Non</span> </h5>      
              <hr />
           
            
             

  </div>


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
            <a   ng-click="sortType = 'created_by'; sortReverse = !sortReverse">
             <span  > Date de session  </span>
             <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'created_by'; sortReverse = !sortReverse">
             <span  > Date limite de dépôt du dossier  </span>
             <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
            <a   ng-click="sortType = 'usr_email'; sortReverse = !sortReverse">
             <span  > Concours  </span>
             <span ng-show="sortType == 'usr_email' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'usr_email' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
 

         <th>
            <a   ng-click="sortType = 'created_by'; sortReverse = !sortReverse">
             <span  > Date de postulation  </span>
             <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'created_by'; sortReverse = !sortReverse">
             <span  > Administration organisatrice</span>
             <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         
                           
        <th ng-if="role == 'Superviseur'">
          Actions 
        </th>
       </tr>
      
       <tr ng-repeat="postule in postules.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
        <td>{{ postule.hire_date }}</td>
        <td>{{ postule.session_date_end }}</td>
        <td>{{ postule.type_name }} en {{postule.specialty_fr}}</td>
        <td>{{ postule.postuled_at }}</td>
        <td>{{ postule.university_name }} - {{ postule.etablissement_name }}</td>
                                  
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


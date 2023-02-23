  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des établissements</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.university" >Université</a></li>
    <li class="active" >Gestion des établissements</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="EtablissementListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addEtablissement" class="btn btn-primary btn-xs" style="width: 100px;"> Ajouter </a>
  <span class="btn btn-primary btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
          Etablissement    </div>
          
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
            <a   ng-click="sortType = 'etablissement_code'; sortReverse = !sortReverse">
             <span  > Code d'Établissement  </span>
             <span ng-show="sortType == 'etablissement_code' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'etablissement_code' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
          <a   ng-click="sortType = 'etablissement_name'; sortReverse = !sortReverse">
           <span  > Nom d'Établissement  </span>
           <span ng-show="sortType == 'etablissement_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'etablissement_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       <th>
        <a  ng-click="sortType = 'university_name'; sortReverse = !sortReverse">
         <span  > Université </span>
         <span ng-show="sortType == 'university_name' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'university_name' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>

                      <!-- <th>
                            <a  ng-click="sortType = 'profile'; sortReverse = !sortReverse">
                                 <span  > Niveau </span>
                                <span ng-show="sortType == 'profile' && !sortReverse" class="fa fa-caret-down"></span>
                                <span ng-show="sortType == 'profile' && sortReverse" class="fa fa-caret-up"></span>
                              </a>
                            </th>-->
                            
                            <th>
                              <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
                               <span > Crée par  </span>
                               <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
                               <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
                             </a>
                           </th>
                           
                           <th ng-if="role == 'SuperviseurT'">
                             Actions 
                           </th>
                           
                           
                         </tr>
                         <tr>
                         </tr>
                         <tr ng-repeat="etablissement in etablissements.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
                          <td>{{ etablissement.etablissement_code }}</td>
                          <td>{{ etablissement.etablissement_name }}</td>
                          <td>{{ etablissement.university_name }}</td>
                          <!-- <td><span >{{ type.profile }}</span></td>-->
                          <td><span class="label label-primary label-xs">{{ type.created_by }}</span></td>

                          

                          <td ng-if="role == 'SuperviseurT'">

                            <a   ng-click="getElement(etablissement)" title="{{'operations.EDITOP' | translate}}"><i class="fa fa-edit"></i></a>
                            <a   data-record-id="{{etablissement.etablissement_id}}" data-record-title="{{etablissement.etablissement_name}}"
                            data-toggle="modal" data-target="#confirm-delete" ng-click="deleteEtablissement(etablissement.etablissement_id)" title="{{'operations.DELETEOP' | translate}}">
                            <i class="glyphicon glyphicon-remove"></i></a></td>
                            
                            
                            
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

                
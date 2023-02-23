  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des formules</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des formules</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="FormuleListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addFormule" class="btn btn-primary btn-xs" style="width: 100px;"> Ajouter </a>
  <span class="btn btn-primary btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
            Formules
          </div>
          
          <div class="table-responsive">

           

           <blockquote>
            <input type="text" ng-model="search"  class="form-control input-sm bg-white rounded padder" placeholder="Rechercher..."> 
          </blockquote>
 
        <table  class="table table-striped" >
         <tr>
        
        <th>
            <a   ng-click="sortType = 'coeff_spe'; sortReverse = !sortReverse">
             <span  > Coeff Spécialité </span>
             <span ng-show="sortType == 'coeff_spe' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'coeff_spe' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'coeff_gen'; sortReverse = !sortReverse">
             <span  > Coeff Genérale </span>
             <span ng-show="sortType == 'coeff_gen' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'coeff_gen' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'coeff_ora'; sortReverse = !sortReverse">
             <span  > Coeff Oral </span>
             <span ng-show="sortType == 'coeff_ora' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'coeff_ora' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th>
            <a   ng-click="sortType = 'pass_note'; sortReverse = !sortReverse">
             <span  > Note de passage par Grade </span>
             <span ng-show="sortType == 'pass_note' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'pass_note' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          <th>
            <a   ng-click="sortType = 'pass_note_finale'; sortReverse = !sortReverse">
             <span  > Note de passage (Examen finale) par Grade </span>
             <span ng-show="sortType == 'pass_note_finale' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'pass_note_finale' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>




      <th>
          <a  ng-click="sortType = 'categorie_name'; sortReverse = !sortReverse">
           <span  > Catégories </span>
           <span ng-show="sortType == 'categorie_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'categorie_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

                           
      <th ng-if="role == 'Superviseur'">
       Actions 
     </th>
      </tr>
           
                         <tr ng-repeat="formule in formules.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
                          <td>{{ formule.coeff_spe }}</td>
                          <td>{{ formule.coeff_gen }}</td>
                          <td>{{ formule.coeff_ora }}</td>
                          <td>{{ formule.pass_note }}</td>
                          <td>{{ formule.pass_note_finale }}</td>
                          <td><span >{{ formule.categorie_name }}</span></td>
                     
                          <td  ng-if="role == 'Superviseur'">

                            <a   ng-click="getElement(formule)" title="{{'operations.EDITOP' | translate}}"><i class="fa fa-edit"></i></a>
                            <a   data-record-id="{{formule.id}}" data-record-title="{{formule.categorie_name}}" data-toggle="modal" data-target="#confirm-delete" 
                            ng-click="deleteFormule(formule.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a></td>
                            
                            
                            
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
                                <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                              </div>
                              <div class="modal-body">
                               <p>
                                 
                                Vous essayez de supprimer la formule de l'enregistrement <b class="label label-primary"><i class="title"></i></b>

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

                
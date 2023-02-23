  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des sous catégories</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.categorie" >Catégories</a></li>
    <li class="active" >Gestion des sous catégories</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="SubCategoryListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addSubCategory" class="btn btn-primary btn-xs" style="width: 100px;"><i class="fa fa-plus"></i> Ajouter </a>
  <span class="btn btn-primary btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
            Sous catégories
          </div>
          
          <div class="table-responsive">

           

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
                          <a ng-click="sortType = 'sub_name_fr'; sortReverse = !sortReverse"  >
                          <span  >Sous catégory en (Français)</span>
                          <span ng-show="sortType == 'sub_name_fr' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'sub_name_fr' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

                        
                        <th>
                          <a    ng-click="sortType = 'sub_name_eng'; sortReverse = !sortReverse"  >
                          <span  > Sous catégorie en (Englais)</span>
                          <span ng-show="sortType == 'sub_name_eng' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'sub_name_eng' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>
                      
                      <th>
                        <a  ng-click="sortType = 'sub_level'; sortReverse = !sortReverse">
                        <span > Classement de sous catégorie </span>
                        <span ng-show="sortType == 'sub_level' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'sub_level' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th>
                        <a  ng-click="sortType = 'sub_enabled'; sortReverse = !sortReverse">
                        <span > Active? </span>
                        <span ng-show="sortType == 'sub_enabled' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'sub_enabled' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th>
                        <a  ng-click="sortType = 'sub_category_id'; sortReverse = !sortReverse">
                        <span > Catégorie  </span>
                        <span ng-show="sortType == 'sub_category_id' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'sub_category_id' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>
                    
                    <th>
                      <a  ng-click="sortType = 'sub_created_by'; sortReverse = !sortReverse" >
                      <span > Créée par  </span>
                      <span ng-show="sortType == 'sub_created_by' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'sub_created_by' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>
                  <th  ng-show="role == 'SuperviseurT'">
                    Action
                  </th>               
                         </tr>
                         <tr>
                         </tr>
                         <tr ng-repeat="sub_cat in sub_categories.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
                          <td>{{ sub_cat.sub_name_fr }}</td>
                          <td>{{ sub_cat.sub_name_eng }}</td>
                          <td>{{ sub_cat.sub_level }}</td>
                          <td>
                            <span ng-if="sub_cat.sub_enabled == 1"><i class="glyphicon glyphicon-ok text-success"></i></span>
                            <span ng-if="sub_cat.sub_enabled == 0"><i class="glyphicon glyphicon-remove text-danger"></i></span>
                          </td>
                          <td><span class="label label-default label-xs" >{{ sub_cat.name_fr }}</span></td>
                          <td><span class="label label-primary label-xs">{{ sub_cat.sub_created_by }}</span></td>

                          

                          <td  ng-if="role == 'SuperviseurT'">

                            <a   ng-click="getElement(sub_cat)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a>
                            <a   data-record-id="{{sub_cat.id_subcat}}" data-record-title="{{sub_cat.sub_name_fr}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"
                            ng-click="deleteType(sub_cat.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td>
                            
                            
                            
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
                                <h4 class="modal-title" id="myModalLabel" translate="type.titles.SUPTITLETYPE">Confirm Delete</h4>
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

                
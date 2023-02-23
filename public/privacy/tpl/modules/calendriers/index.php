  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des calendriers</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des calendriers</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="CalendrierListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="wrapper-md bg-light dk b-b text-b">
  <h2 class="m-n font-bold text-primary">Etablissement : {{filieres.nom_etablissement}}</h2>       
  <h4 class="m-n font-thin">Type d'établissement : {{filieres.type_etablissement}} </h4>      
  <h4 class="m-n font-thin">Pays d'établissement : {{filieres.pays_etablissement}} </h4>      
  <h4 class="m-n font-thin">Filière : {{filieres.nom_filiere }}</h4> 
  <hr />
  <div class="btn-toolbar">
     
    <div class="btn-group">
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..." /> 
    </div>
    <button  class="btn btn-lg btn-bg btn-success rounded padder"   ng-click="clickLoad();"><i class="fa fa-refresh"></i> Afficher et Actualiser </button>
   
  </div>
  <br />
    
      <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
       <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
         <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
       </select> 
   

</div>
 







  <a   class="btn btn-primary btn-xs" style="width: 100px;"><i class="fa fa-plus"></i> Ajouter </a>
 
 <div class="panel panel-default">

          <!--<select ui-jq="chosen" ng-model="category_id" data-placeholder="Select Student..." class="form-control" >
            <option ng-repeat="list in categories" value="{{list.id}}"> {{list.id}} </option>
          </select>-->

          <div class="panel-heading" >
            Calendriers
          </div>
          
          <br />
          <div class="row">
                  
           <form  class="form-horizontal"   >

           

           <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-4 control-label" >Date de début</label>
            <div class="col-sm-6">
             
              <input id="calendrier.date_debut" type="date" name="calendrier.date_debut" class="form-control" placeholder="Date de début" required ng-model="calendrier.date_debut" />

            </div>
          </div>          
        </div>

        <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-4 control-label" >Date de fin</label>
            <div class="col-sm-6">
             
              <input id="calendrier.date_fin" type="date" name="calendrier.date_fin" class="form-control" placeholder="Date de fin" required ng-model="calendrier.date_fin" />

            </div>
          </div>          
        </div>

        <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-4 control-label" >Session</label>
            <div class="col-sm-6">
             
            <select ng-model="calendrier.session_id" class="form-control" 
                  ng-options="session.id_session as session.nom_session  for session in sessions" 
                  id="calendrier.session_id" name="calendrier.session_id" required>
                <option required="true">---</option>
              </select> 
            </div>
          </div>          
        </div>

        <div class="col-sm-3">
            <div class="form-group">
                <button ng-click="saveCalendrier()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>
            </div>
           </div>

      </form>

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
                        <a  ng-click="sortType = 'session_id'; sortReverse = !sortReverse">
                        <span > Session  </span>
                        <span ng-show="sortType == 'session_id' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'session_id' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>


                        <th>
                          <a ng-click="sortType = 'date_debut'; sortReverse = !sortReverse"  >
                          <span  >Date de début</span>
                          <span ng-show="sortType == 'date_debut' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'date_debut' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

                      <th>
                          <a ng-click="sortType = 'date_fin'; sortReverse = !sortReverse"  >
                          <span  >Date de fin</span>
                          <span ng-show="sortType == 'date_fin' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'date_fin' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

               

                    

                    <th>
                        <a  ng-click="sortType = 'filiere_id'; sortReverse = !sortReverse">
                        <span > Filière  </span>
                        <span ng-show="sortType == 'filiere_id' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'filiere_id' && sortReverse" class="fa fa-caret-up"></span>
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
                   
                         <tr ng-repeat="calendrier in calendriers.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
                          <td>{{ calendrier.nom_session }}</td>
                          <td>{{ calendrier.date_debut }}</td>
                          <td>{{ calendrier.date_fin }}</td>
                       
                           <td><span class="label label-default label-xs" >{{ calendrier.nom_filiere }}</span></td>
                          <td><span class="label label-primary label-xs">{{ calendrier.created_by }}</span></td>

                          

                          <td  ng-if="role == 'SuperviseurT'">

                            <!--<a   ng-click="getElement(calendrier)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a>-->
                            <a   data-record-id="{{calendrier.id_session_filiere}}" data-record-title="{{calendrier.date_debut}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"
                            ng-click="deleteRecord(calendrier.id_session_filiere)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td>
                            
 
                            
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
                                <h4 class="modal-title" id="myModalLabel">Gestion des calendriers</h4>
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

                
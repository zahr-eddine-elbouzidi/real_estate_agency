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


<div ng-controller="FilesCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="bg-light lter b-b wrapper-md"   >
    <div>

      <h4>Mes documents</h4>
   

    </div>

    <div class="btn-toolbar">
     
    <div class="btn-group">
      
     <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 




   </div>
     <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
        <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
          <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
        </select> 

        <center><a ng-click="editerFiles();" class="btn btn-success btn-lg"> Editer mes fichiers</a></center><br />
 
 </div>
    
 

  </div>

  <div class="wrapper-md" style="clear: both;">

    <div class="panel panel-default">
      <div class="panel-heading">
        Mes documents
      </div>
      <div class="table-responsive" style="clear: both;">

        

        <!--TABLE D'AFFICHAGE -->
        <table  class="table table-striped small" >

         <tr>

          
          <th data-toggle="true">
            <a    ng-click="sortType = 'filename'; sortReverse = !sortReverse"  >
             <span  >Fichier</span>
             <span ng-show="sortType == 'filename' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'filename' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

         <th data-toggle="true">
          <a    ng-click="sortType = 'file_type'; sortReverse = !sortReverse"  >
           <span  >Type du fichier  </span>
           <span ng-show="sortType == 'file_type' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'file_type' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th> 
       <th>
        Création
      </th>
      
      <th >
       Action
     </th>               
   </tr>
   
   <tr ng-repeat="file in fileDatas.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
     

    <td><a href="{{BASE_URL}}/uploadsFiles/{{file.usr_registration_token}}/files/{{file.filename}}" target="_blank" ><span class="label label-default"><i class="fa fa-download"></i> {{ file.filename }}</span></a></td>
    <td><span>{{file.type_file}}</span>  
     <!-- <a ng-if="file.type_file == 'Thèse'" data-target="#confirm" class="btn btn-danger btn-small" id="custId" data-toggle="modal" data-record-id="{{file.id_file}}"  >Ajouter/Modifier les membres de thèse </a>
     <a ng-if="file.type_file == 'Thèse'" ui-sref="app.my-jury({id_file : file.id_file})" data-target="#confirm" class="btn btn-danger btn-small" id="custId"   >Ajouter/Modifier les membres de thèse </a>-->
     <a ng-if="file.type_file == 'Thèse'" data-target="#confirm-info" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-record-id="{{file.id_file}}" ng-click="displayFile(file.id_file)"  >
      <i class="fa fa-eye"></i> Afficher mes membres
    </a>
    
  </td>  
  <td>{{file.created_at_file }}</td>
  
                    <!-- <td  ng-if="file.type_file != 'Thèse'">
                       </td>-->
                      <td> 
                        
                        <i  ng-if="date > hireGet.session_date_end || postuled.accepted == 1 || postuled.accepted == 0" class="glyphicon glyphicon-lock"></i>
                        <a    ng-if="date <= hireGet.session_date_end && postuled.accepted == 2" data-record-id="{{file.id_file}}" data-record-title="{{file.type_file}}" title="{{ file.filename }}" data-toggle="modal" data-target="#confirm-delete"  ng-click="deleteFile()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>

                        
                      </td> 
                    </tr>
                  </table>

                  
                  <!-- PAGINATION SYSTEME -->
                  <div class="form-group">
                   <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  
                   ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>
                 </div>
                 
                 
                 
                 
                 
               </div>
             </div>
             
           </div>



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



        <div class="modal fade" id="confirm-delete-jury" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" >Confirmation Jury</h4>
              </div>
              <div class="modal-body">
               <p>
                 
                Vous essayez de supprimer le jury<b class="label label-primary"><i class="title"></i></b>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-jury btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
              <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
              
            </div>
          </div>
        </div>
      </div> 


      <div class="modal fade" id="confirm-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title" id="myModalLabel" >Les membres de thèse</h4>
            </div>
            <div class="modal-body">

              <div class="table-responsive">
                <table  class="table table-striped small" >

                  <tr>
                    
                    <th data-toggle="true">
                      <a    ng-click="sortType = 'nom_complet'; sortReverse = !sortReverse"  >
                        <span  >Nom et Prénom </span>
                        <span ng-show="sortType == 'nom_complet' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'nom_complet' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                      <a    ng-click="sortType = 'etablissement'; sortReverse = !sortReverse"  >
                        <span  >Etablissement, Université </span>
                        <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                 

                    <th data-toggle="true">
                      <a    ng-click="sortType = 'specialite'; sortReverse = !sortReverse"  >
                        <span  >Spécialité  </span>
                        <span ng-show="sortType == 'specialite' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'specialite' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                 
                

                    <th >
                      Action
                    </th>                  
                  </tr>
                  <tr ng-repeat="file in jury | orderBy:sortType:sortReverse">
                   <td><span>{{file.nom_complet}}</span></td>  
                   <td><span>{{file.etablissement}}</span></td>  
                   <td><span>{{file.specialite}}</span></td>  
             

                   <td> 
                    <i  ng-if="date > hireGet.session_date_end || postuled.accepted == 1 || postuled.accepted == 0" class="glyphicon glyphicon-lock"></i>
                    <a   ng-if="date <= hireGet.session_date_end && postuled.accepted == 2" data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-dismiss="modal" data-toggle="modal" data-target="#confirm-delete-jury"
                    
                    ng-click="deleteJury(file.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>

                  </td> 
                </tr>
              </table>
            </div>

          </div>
          <div class="modal-footer">
           
            <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
            
          </div>
        </div>
      </div>
    </div> 

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 200px;">



      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" >Confirmation de candidature</h4>
          </div> 
          
          <div class="modal-body">

            
           <p class="label label-danger"><i class="fa fa-info"></i>  Pour compléter votre demande de candidature, prière de remplir ce formulaire avant de postuler !</p><br /><br />
           <span class="text-primary">Membres de jury:</span><br /><br />
           
           <div class="form-group">
            <label class="col-lg-4 control-label">Nom et Prénom</label>
            <div class="col-lg-8">
              <input id="nom_complet" type="text" name="file.nom_complet" class="form-control" required ng-model="file.nom_complet" />
            </div>
          </div> <br /> 
          <div class="form-group">
            <label class="col-lg-4 control-label">Etablissement, Université</label>
            <div class="col-lg-8">
              <input id="etablissement" type="text" name="file.etablissement" class="form-control"   required ng-model="file.etablissement" />
            </div>
          </div><br />
          <div class="form-group">
            <label class="col-lg-4 control-label">Spécialité</label>
            <div class="col-lg-8">
              <input id="specialite" type="text" name="file.specialite" class="form-control"   required ng-model="file.specialite" />
            </div>
          </div><br />
 
     
          
          <br /><br />
          <span class="text-danger"><i class="fa fa-info"></i>  Un dossier soumissioné avec le formulaire vide ou incomplet sera rejeté automatiquement.</span>
          
          


        </div>
        <div class="modal-footer">
          <button type="button"   class="btn btn-success btn-conf pull-left" ng-click="saveJury();" data-dismiss="modal" >Confirmer</button>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" >X</button>
          
        </div> 
        
        
      </div>
    </div>
    
    

                <!--<div class="modal fade" id="confirm" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Data</h4>
                          </div>
                          <div class="modal-body">
                              <div class="fetched-data"></div> //Here Will show the Data
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
                </div> -->
              </div>
            </div>
            
            

            
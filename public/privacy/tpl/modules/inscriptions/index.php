  
   <style>
 
 .selected {
    background-color:#1084D9;
    color:white;
    font-weight:bold;
}
  </style>

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion des calendriers</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des calendriers</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="InscriptionsListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="wrapper-md bg-light dk b-b text-b">
  <h2 class="m-n font-bold text-primary">Candidat : {{candidat.fullname}}</h2>       
  <h4 class="m-n font-thin">Date de naissance : {{candidat.date_naiss}} , Lieu de naissance : {{candidat.lieu_naiss}}</h4>      
 
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
            Contrats
          </div>
          
          <br /> 
          <form  class="form-horizontal"   >

     
          <div class="row">
                  
          

           

           <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-6 control-label" >Date du contrat</label>
            <div class="col-sm-6">
             
              <input id="inscriptions.date_inscription" type="date" name="inscriptions.date_inscription" class="form-control" placeholder="Date d'inscription" required ng-model="inscriptions.date_inscription" />

            </div>
          </div>          
        </div>

  

        <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-4 control-label" >Filière</label>
            <div class="col-sm-8">
             
            <select ng-model="inscriptions.filiere_id" class="form-control"  ng-change="getPart(inscriptions.filiere_id)" 
                  ng-options="filiere.id_filiere as (filiere.nom_filiere+' - '+filiere.nom_etablissement)  for filiere in filieres" 
                  id="inscriptions.filiere_id" name="inscriptions.filiere_id" required>
                <option required="true">---</option>
              </select> 
            </div>
          </div>          
        </div>

        <div class="col-sm-3">
           <div class="form-group">
            <label class="col-sm-6 control-label" >Frais de traitement du dossier</label>
            <div class="col-sm-6">
             
              <input id="inscriptions.mt_reste_trait_dossier" type="text" name="inscriptions.mt_reste_trait_dossier" class="form-control" placeholder="Frais Traitement du dossier" required ng-model="inscriptions.mt_reste_trait_dossier" />

            </div>
          </div>          
        </div>

        <div class="col-sm-3">
           <div class="form-group">
             
            <div class="col-sm-6">
             
            <button ng-click="saveInscription()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter le contrat</button>
            </div>
          </div>          
        </div>



       
      

          </div>
          </form>

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
        <table  class="table" >
                      <tr>

                      <th data-toggle="true">
                        <a  ng-click="sortType = 'id_inscription'; sortReverse = !sortReverse">
                        <span > N°  </span>
                        <span ng-show="sortType == 'id_inscription' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'id_inscription' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>
                    <th data-toggle="true">
                        <a  ng-click="sortType = 'filiere_id'; sortReverse = !sortReverse">
                        <span > Filiere  </span>
                        <span ng-show="sortType == 'filiere_id' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'filiere_id' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'nom_etablissement'; sortReverse = !sortReverse">
                        <span > Etablissement  </span>
                        <span ng-show="sortType == 'nom_etablissement' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'nom_etablissement' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'pays_etablissement'; sortReverse = !sortReverse">
                        <span > Pays  </span>
                        <span ng-show="sortType == 'pays_etablissement' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'pays_etablissement' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>


                    <th data-toggle="true">
                          <a ng-click="sortType = 'date_inscription'; sortReverse = !sortReverse"  >
                          <span  >Date d'inscription</span>
                          <span ng-show="sortType == 'date_inscription' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'date_inscription' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

                      <th data-toggle="true">
                          <a ng-click="sortType = 'mt_reste_trait_dossier'; sortReverse = !sortReverse"  >
                          <span  >Frais de traitement du dossier (Reste)</span>
                          <span ng-show="sortType == 'mt_reste_trait_dossier' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'mt_reste_trait_dossier' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>
                      <th data-toggle="true">
                          <a ng-click="sortType = 'mt_paye_trait_dossier'; sortReverse = !sortReverse"  >
                          <span  >Frais de traitement du dossier (Payé)</span>
                          <span ng-show="sortType == 'mt_paye_trait_dossier' && !sortReverse" class="fa fa-caret-down"></span>
                          <span ng-show="sortType == 'mt_paye_trait_dossier' && sortReverse" class="fa fa-caret-up"></span>
                        </a>
                      </th>

                    
                    <th data-toggle="true">
                      <a  ng-click="sortType = 'sub_created_by'; sortReverse = !sortReverse" >
                      <span > Créée par  </span>
                      <span ng-show="sortType == 'sub_created_by' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'sub_created_by' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>
                  <th data-toggle="true"  ng-show="role == 'SuperviseurT'">
                    Action
                  </th> 

                
                  
            
                         </tr>
                   
                         <tr ng-repeat="inscription in inscriptions.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse" ng-click="setClickedRow(inscription.id_inscription)" ng-class="{'selected':inscription.id_inscription == selectedRow}" >
                           <td>{{ inscription.id_inscription }}</td>
                          <td>{{ inscription.nom_filiere }}</td>

                          <td><span class="label label-default label-xs" >{{ inscription.nom_etablissement }}</span></td>
                          <td><span class="label label-default label-xs" >{{ inscription.pays_etablissement }}</span></td>
                          <td>{{ inscription.date_inscription }}</td>
                          <td>{{ inscription.mt_reste_trait_dossier }}</td>
                          <td>{{ inscription.mt_paye_trait_dossier }}</td>

                          <td><span class="label label-primary label-xs">{{ inscription.created_by }}</span></td>

                          

                          <td  ng-if="role == 'SuperviseurT'">

                            <!--<a   ng-click="getElement(calendrier)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a>-->
                            <a   data-record-id="{{inscription.id_inscription}}" data-record-title="{{inscription.nom_filiere}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"
                            ng-click="deleteRecord(inscription.id_inscription)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td>
                            
 
                            
                          </tr>


                        </table>

                        


                        <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>
                        

                        
                        <div class="wrapper-md bg-light dk b-b text-b">
                          <h4>Gestion de paiement :</h4>
                        </div>
                        <hr />
                        <div class="row">
                  
                  <form  class="form-horizontal"   >
       
                  
                  <div class="col-sm-4">
                  <div class="form-group">
                   <label class="col-sm-4 control-label" >Remise</label>
                   <div class="col-sm-6">
                    
                   <select ng-model="paiement.remise" class="form-control"  id="paiement.remise" name="paiement.remise" required>
                       <option required="true">Entreprise I.E.W</option>
                       <option required="true">Pers L.R</option>
                     </select> 
                   </div>
                 </div>          
               </div>


               <div class="col-sm-4">
                  <div class="form-group">
                   <label class="col-sm-4 control-label" >Mode de paiement</label>
                   <div class="col-sm-6">
                    
                   <select ng-model="paiement.mode_id" class="form-control" 
                         ng-options="mode.id_mode as mode.nom_mode for mode in modes" 
                         id="paiement.mode_id" name="paiement.mode_id" required>
                       <option required="true">---</option>
                     </select> 
                   </div>
                 </div>          
               </div>
       
             
         
       
               <div class="col-sm-4">
                  <div class="form-group">
                   <label class="col-sm-4 control-label" >Type de paiement</label>
                   <div class="col-sm-6">
                    
                   <select ng-model="paiement.type_paie" class="form-control"  id="paiement.type_paie" name="paiement.type_paie" required>
                       <option required="true">Frais de traitement du dossier</option>
                     </select> 
                   </div>
                 </div>          
               </div>

               <div class="col-sm-4">
                  <div class="form-group">
                   <label class="col-sm-4 control-label" >Date de paiement</label>
                   <div class="col-sm-6">
                    
                     <input id="paiement.date_paiement" type="date" name="paiement.date_paiement" class="form-control" placeholder="Date de paiement" required ng-model="paiement.date_paiement" />
       
                   </div>
                 </div>          
               </div>

               <div class="col-sm-4">
                  <div class="form-group">
                   <label class="col-sm-4 control-label" >Montant Paye</label>
                   <div class="col-sm-6">
                    
                     <input id="paiement.mt_paye" type="text" name="paiement.mt_paye" class="form-control" placeholder="Mt payé en DH." required ng-model="paiement.mt_paye" />
       
                   </div>
                 </div>          
               </div>
       
       
               <div class="col-sm-4">
                   <div class="form-group">
                   <label class="col-sm-4 control-label" ></label>
                   <div class="col-sm-6">
                       <button ng-click="savePaiement()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Valider</button>
                   </div>
                   </div>
                  </div>
       
             </form>




                        <!-- Trigger the modal with a button -->
                        
                        <!-- Modal pour l'edition des information-->

                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Gestion des inscriptions</h4>
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



                <hr />



                  <table  class="table" >
                      <tr>

                      <th data-toggle="true">
                        <a  ng-click="sortType = 'date_paiement'; sortReverse = !sortReverse">
                        <span > Date de paiement </span>
                        <span ng-show="sortType == 'date_paiement' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'date_paiement' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'mt_paye'; sortReverse = !sortReverse">
                        <span > Montant Payé </span>
                        <span ng-show="sortType == 'mt_paye' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'mt_paye' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'remise'; sortReverse = !sortReverse">
                        <span > Remise  </span>
                        <span ng-show="sortType == 'remise' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'remise' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'type_paie'; sortReverse = !sortReverse">
                        <span > Type de paiement  </span>
                        <span ng-show="sortType == 'type_paie' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'type_paie' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>

                    <th data-toggle="true">
                        <a  ng-click="sortType = 'nom_mode'; sortReverse = !sortReverse">
                        <span > Mode de paiement  </span>
                        <span ng-show="sortType == 'nom_mode' && !sortReverse" class="fa fa-caret-down"></span>
                        <span ng-show="sortType == 'nom_mode' && sortReverse" class="fa fa-caret-up"></span>
                      </a>
                    </th>
 
                    
                    <th data-toggle="true">
                      <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
                      <span > Créée par  </span>
                      <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>
                  <th data-toggle="true"  ng-show="role == 'SuperviseurT'">
                    Action
                  </th> 

                
                  
            
                         </tr>
                   
                         <tr ng-repeat="paiement in paiements" >
                          <td>{{ paiement.date_paiement }}</td>
                          <td>{{ paiement.mt_paye }}DH.</td>
                          <td>{{ paiement.remise }}</td>
                          <td>{{ paiement.type_paie }}</td>
                          <td>{{ paiement.nom_mode }}</td>

                          

                          <td><span class="label label-primary label-xs">{{ paiement.created_by }}</span></td>

                          

                          <td  ng-if="role == 'SuperviseurT'">

                            <!--<a   ng-click="getElement(calendrier)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a>-->
                            <a   data-record-id="{{paiement.id_paiement}}" data-record-titlepaie="{{paiement.mt_paye}}" data-toggle="modal" data-target="#confirm-deletepaie" class="btn btn-danger btn-xs"
                            ng-click="deletePaiement(paiement.id_paiement)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td>
                            
 
                            
                          </tr>


                        </table>

                        


                         

                        <div class="modal fade" id="confirm-deletepaie" tabindex="-1" role="dialog" aria-labelledby="myModalLabelpaie" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabelpaie">Gestion des paiements</h4>
                              </div>
                              <div class="modal-body">
                               <p>
                                 
                                Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="titlepaie"></i></b>

                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger btn-paie btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                              <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                              
                            </div>
                          </div>
                        </div>
                      </div>


 </div>

                
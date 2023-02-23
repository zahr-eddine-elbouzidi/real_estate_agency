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
     <h4 >Suivre mes candidatures</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1" translate="operations.HOME"><i class="fa fa-home"></i> Accueil</a></li>
      <li class="active">Suivre mes candidatures</li>
    </ul>
  </div>


</div>



<!--<center><p class="alert alert-success"><i class="fa fa-info"></i> Télécharger votre convocation si vous êtes accepté pour passer l'épreuve écrite.</p></center>-->
<div ng-controller="CandidatCtrl" >
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>{{hiresOld | json}}{{candidat | json}}-->

   <div > 


               <form method="POST" action="tpl/recu.php" target="_blank">

                <input type="hidden" name="hidden" value="{{hiresOld}}" />
                <input type="hidden" name="candidat" value="{{candidat}}" />
               <button type="submit" name="submit"  class="btn btn-primary" ><i class="fa fa-print"></i> Imprimer le reçu</button>

              </form>
        </div> 

  <div class="wrapper bg-light lter b-b">
    <div class="btn-group pull-right">
     <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
     <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
       <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
     </select> 
   </div>
   <div class="btn-toolbar">
     
    <div class="btn-group">
      
     <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 


   </div>
   <center> <button class="btn btn-lg btn-bg btn-success" ng-click="refR();"><i class="fa fa-refresh"></i> Actualiser le tableau</button></center>
 </div>
</div>


<div class="wrapper-md" >
 
  
  <div class="panel panel-default">


   
   
    <div class="table-responsive" style="clear: both;">
      
    

     
     
        <!--<span translate="operations.RECORDS" >records.</span>
        <br />
        <br />-->
        
        <table  class="table table-striped" >

         <tr>
          <!-- <th>
            <a    ng-click="sortType = 'num'; sortReverse = !sortReverse"  >
             <span  > N° d'inscription </span>
             <span ng-show="sortType == 'num' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'num' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>-->

         <th>
          <a    ng-click="sortType = 'type_name'; sortReverse = !sortReverse"  >
           <span  > Grade </span>
           <span ng-show="sortType == 'type_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'type_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
        <th>
          <a    ng-click="sortType = 'etablissement_name'; sortReverse = !sortReverse"  >
           <span  > Etablissement </span>
           <span ng-show="sortType == 'etablissement_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'etablissement_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       
       <th>
        <a  ng-click="sortType = 'specialty_fr'; sortReverse = !sortReverse">
         <span  > Spécialité </span>
         <span ng-show="sortType == 'specialty_fr' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'specialty_fr' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     
     <th>
      <a  ng-click="sortType = 'postuled_at'; sortReverse = !sortReverse" >
       <span > Date de postulation  </span>
       <span ng-show="sortType == 'postuled_at' && !sortReverse" class="fa fa-caret-down"></span>
       <span ng-show="sortType == 'postuled_at' && sortReverse" class="fa fa-caret-up"></span>
     </a>
   </th>

   <th>
    <a  ng-click="sortType = 'session_date_end'; sortReverse = !sortReverse" >
     <span > Date limite de dépôt du dossier  </span>
     <span ng-show="sortType == 'session_date_end' && !sortReverse" class="fa fa-caret-down"></span>
     <span ng-show="sortType == 'session_date_end' && sortReverse" class="fa fa-caret-up"></span>
   </a>
 </th>

 <th>
  <a  ng-click="sortType = 'hire_date'; sortReverse = !sortReverse" >
   <span > Date de concours  </span>
   <span ng-show="sortType == 'hire_date' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'hire_date' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
<th>
  <a  ng-click="sortType = 'etat'; sortReverse = !sortReverse" >
   <span > Etat du dossier </span>
   <span ng-show="sortType == 'etat' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'etat' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
<th>Mes Fichiers </th>
<th>Ajouter les jury (PA)</th>
<th>Motif </th>
<!--  <th>Convocation</th>  -->
<th translate="categorie.titles.ACTIONS">
 Action
</th>



</tr>

<tr ng-repeat="hire in hiresOld.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
 <!-- <td>

    <span class="label label-warning label-xs"   ng-show="{{hire.accepted==2}}" >votre candidature est en cours de traitement... </span>
    <span class="label label-success label-xs"   ng-show="{{hire.accepted == 1}}" > {{hire.num}}</span>

    


  </td>-->
  <td>{{hire.type_name}}</td>
  <td>{{hire.etablissement_name}}</td>
  <td>{{hire.specialty_fr }}</td>
  <td>{{hire.postuled_at | date:'dd-MM-yyyy' }}</td>
  <td>{{hire.session_date_end | date:'dd-MM-yyyy' }}</td>
  <td>{{hire.hire_date | date:'dd-MM-yyyy' }}</td>
  <td>
    
   <span class="label label-danger label-xs"   ng-show="{{hire.accepted==0}}" >votre candidature est rejetée </span>  
   <span class="label label-success label-xs" ng-show="{{hire.accepted==1}}" > votre candidature est acceptée </span>
   <span class="label label-warning label-xs" ng-show="{{hire.accepted==2}}" > En cours de traitement... </span>
   

 </td>
 <td><a ng-click="getMesFiles(hire.id);" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-upload"></i> Mes pièces jointes</a></td>
 <td><a ng-if="hire.profile == 'BAC+8'" ng-click="getThese(hire.id);" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-upload"></i> Ajouter les jury</a></td>
 <td>
  {{hire.dossier }} <span ng-if="hire.dossier != null" class="label label-success label-xs">Par administrateur</span>
</td>

                   <!-- <td>
                       <a ng-if="hire.num != 0 && hire.num != null" ng-click="getConvocation(hire)" class="label label-primary label-xs" title="Imprimer la convocation">Imprimer la convocation <i class="icon icon-link"></i></a>
                     </td>-->
                     

                     <td>
                      <i   ng-if="date > hire.session_date_end || hire.accepted == 1 || hire.accepted == 0" class="glyphicon glyphicon-lock"></i>
                      <a   ng-if="date <= hire.session_date_end && hire.accepted == 2" data-record-id="{{hire.postule_id}}" data-record-title="{{hire.type_name}} en {{hire.specialty_fr }}" data-toggle="modal" data-target="#confirm-delete" ng-click="deletePostuler()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>
                    </td> 
                    
                  </tr>
                </table>

                

                <div class="form-group">
                 <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


               </div>
               
               
               
               
               
             </div>
           </div>
           <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" >Confirmer la suppression</h4>
                </div>
                <div class="modal-body">
                 <p>
                   
                  Vous essayez de supprimer l'enregistrement : <br /><b class="text-primary font-bold"><i class="title"></i></b></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                  <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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

  
  <div ng-controller="RequestsOralCtrl" ng-init="loadAccepted();">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="bg-light lter b-b wrapper-md"   >
    <div>
      


      <h4>Liste des candidats par concours</h4>
      <ul class="breadcrumb bg-white b-a">
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.categorie" > Gestion des catégories</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.type" > Gestion des sous catégories</a></li>
        <li><a ui-sref="app.hires"> Gestion des concours</a></li>
        <li class="active">L'examen oral</li>
        
      </ul>

    </div>


      <div class="wrapper-md bg-light dk b-b text-b">
<!--<b><span class="pull-right m-t-xs">Nombre de poste(s) <b class="badge bg-dark">{{hireEdit.post_number}}</b></span></b>-->
  <h2 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h2>       
  <h4 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h4>      
  <h4 class="m-n font-thin">Code : {{hireEdit.hire_code}} </h4>      
  <h4 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date |  date:'dd-MM-yyyy' }}</h4> 
  <h4 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h4> 
  <hr />
  <div class="btn-toolbar">
     
    <div class="btn-group">
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..." /> 
    </div>
    <button  class="btn btn-lg btn-bg btn-success rounded padder"   ng-click="clickLoad();"><i class="fa fa-refresh"></i> Afficher et Actualiser </button>
  </div>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
       <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
         <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
       </select> 
   

</div>


 

   </div>


 


  
  <div class="wrapper-md" style="clear: both;">
   
   
   
   
    <div class="panel panel-default">
     
     <div class="table-responsive" style="clear: both;">
       
        <!--<span translate="operations.RECORDS" >records.</span>
          <br />-->

          
         
          
          
          <table  class="table table-striped" >

           <tr>
             <th data-toggle="true">
              <a    ng-click="sortType = 'num'; sortReverse = !sortReverse"  >
               <span  > N° d'inscription </span>
               <span ng-show="sortType == 'num' && !sortReverse" class="fa fa-caret-down"></span>
               <span ng-show="sortType == 'num' && sortReverse" class="fa fa-caret-up"></span>
             </a>
           </th>

       
             <th data-toggle="true">
              <a    ng-click="sortType = 'note_ex1'; sortReverse = !sortReverse"  >
               <span  > Note (Examen 1) /20</span>
               <span ng-show="sortType == 'note_ex1' && !sortReverse" class="fa fa-caret-down"></span>
               <span ng-show="sortType == 'note_ex1' && sortReverse" class="fa fa-caret-up"></span>
             </a>
           </th>


           <th data-toggle="true">
            <a    ng-click="sortType = 'cin'; sortReverse = !sortReverse"  >
             <span  > C.I.N </span>
             <span ng-show="sortType == 'cin' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'cin' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         <th data-toggle="true">
          <a    ng-click="sortType = 'nom'; sortReverse = !sortReverse"  >
           <span  >Nom et Prénom  </span>
           <span ng-show="sortType == 'nom' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'nom' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th data-toggle="true">
        <a    ng-click="sortType = 'age'; sortReverse = !sortReverse"  >
         <span  >Age  </span>
         <span ng-show="sortType == 'age' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'age' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>

     <th data-toggle="true">
      <a    ng-click="sortType = 'diplome'; sortReverse = !sortReverse"  >
       <span  >Diplôme  </span>
       <span ng-show="sortType == 'diplome' && !sortReverse" class="fa fa-caret-down"></span>
       <span ng-show="sortType == 'diplome' && sortReverse" class="fa fa-caret-up"></span>
     </a>
   </th>

   <th data-toggle="true">
    <a    ng-click="sortType = 'diplome'; sortReverse = !sortReverse"  >
     <span  >Spécialité du diplôme  </span>
     <span ng-show="sortType == 'diplome' && !sortReverse" class="fa fa-caret-down"></span>
     <span ng-show="sortType == 'diplome' && sortReverse" class="fa fa-caret-up"></span>
   </a>
 </th>
 
 <th data-hide="phone,tablet">
  <a  ng-click="sortType = 'etat'; sortReverse = !sortReverse" >
   <span > Etat  </span>
   <span ng-show="sortType == 'etat' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'etat' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>





<th data-hide="phone,tablet" >
 Note (Examen 2 | Oral )
</th>
<!--<th ng-if="role=='Superviseur' || role == 'Admin' || role=='Commission'" data-hide="phone,tablet" >
 Validation
</th>-->




</tr>


<tr ng-repeat="candidat in candidatsAccepted.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
 <td>{{candidat.num}}</td>
 <td>{{candidat.note_ex1}}/20</td>
 <td>{{candidat.cin}}</td>
 <td>{{candidat.nom}} {{candidat.prenom}}</td>
 <td>{{candidat.age}}ans.</td>
 <td>{{candidat.diplome}}</td>
 <td>{{candidat.specialite}}</td>
 
 <td>
  
   <span   class="label label-warning label-xs"  ng-show="{{candidat.passed==0 || candidat.passed == null}}" > En attente</span>  
   <span class="label label-success label-xs" ng-show="{{candidat.passed==1}}" > il a réussi</span>
   
 </td>

 
  <td>

     <a   data-record-id="{{candidat.postuler_id}}" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.notes_ex2 || paramsDroit.ctl_all ))" data-record-title="{{candidat.nom | uppercase}} {{candidat.prenom | uppercase}}" data-toggle="modal"  class="btn btn-default btn-md" data-target="#confirm-note-ex2" ng-click="confirmNoteEx2(candidat.postuler_id)" ><i class="fa fa-plus"></i> Gestion des notes</a>
                     
    </td>

 
 <!--<td  ng-if="role == 'Admin' || role=='Commission'">
  <button ng-if="role == 'Admin' || role=='Commission' " class="btn btn-success btn-xs" ng-disabled="{{candidat.passed == 1}}"  ng-click="passerOrale(candidat.postuler_id);">Passer</button>
  <button ng-if="role == 'Admin' || role=='Commission'" class="btn btn-danger btn-xs" ng-disabled="{{candidat.passed == 0}}" ng-click="annulerOrale(candidat.postuler_id);">Annuler</button>
</td>-->

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
        <h4 class="modal-title" id="myModalLabel" >Les pièces joints</h4>
      </div>
      <div class="modal-body">
       <p>
         
       Liste des pièces joints :</p>

       span
     </div>
     <div class="modal-footer">
      
      <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
      
    </div>
  </div>
</div>
</div>
</div>

 <div class="modal fade" id="confirm-note-ex2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 200px;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Ajouter la note (Examen 2) | Candidat : <b class="title"></b></h4>
      </div>
      <div class="modal-body">

       <div class="row">
          <div class="form-group">
            <label class="col-lg-4 control-label">Note</label>
            <div class="col-lg-8">
               <input type="text" ng-model="candidat.note_ora" ng-style="passwordStrength" placeholder=".../20" class="form-control" required   ng-change="analyze(candidat.note_ora)"  />
           
            </div>
          </div>
       </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" ng-disabled="!validated" class="btn btn-success btn-ok btn-xs pull-left" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.notes_ex2 || paramsDroit.ctl_all ))">Ajouter la note</button>
        <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
        
      </div>
    </div>
  </div>
</div>


</div>


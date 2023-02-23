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

 .selected {
    background-color:#1084D9;
    color:white;
    font-weight:bold;
}
  </style>

  
  <div ng-controller="RequestsCtrl" ng-init="load();">
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
   
    <button ng-if="hiresWating == 0" class="btn btn-md btn-bg btn-danger padder pull-right" ng-click="validation();"><i class="fa fa-check"></i> Valider le concours définitivement.</button>
  </div><br />
    <span ng-repeat="state in states">
                <span ng-if="state.type == 'Nbre candidats en attentes'" class="label label-warning">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats acceptés'" class="label label-success">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats rejets'" class="label label-danger">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats postulés'" class="label label-info">{{state.type}} : {{state.nbre_wait}}</span>
                
    </span>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
       <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
         <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
       </select> 
   

</div>
 </div>

   
   <div class="wrapper-md" style="clear: both;">

       

    <div class="panel panel-default">
     
      
      
      <div class="table-responsive" style="clear: both;">


       <br />

       <div class="row"  ><div class="col-md-12"  >

        <div class="col-md-6">
          <input type="text"  class="form-control input-lg" ng-model="comment" placeholder="Ajouter un commentaire ..." /><br />

        </div>

        <div class="col-md-6">
          <select class="form-control input-lg"  ng-model="dossier">
           <option value="خارج التخصص">خارج التخصص</option>
           <option value="الملف ناقص">الملف ناقص</option>
         </select>

       </div>
       
     </div>           </div>  
     


           
        <!--<span translate="operations.RECORDS" >records.</span>
          <br />-->

          
          <button ng-show="role == 'Superviseur' || role == 'Admin' || role == 'Commission'" style="float: right" class="btn btn-md btn-bg btn-info" ng-click="getPassing()"><i class="fa fa-refresh"></i> Examen oral</button>
         

          
          <br />
          
          <table  class="table" >

           <tr>
             <th data-toggle="true">
              <a    ng-click="sortType = 'index'; sortReverse = !sortReverse"  >
               <span  > N° Ordre </span>
               <span ng-show="sortType == 'index' && !sortReverse" class="fa fa-caret-down"></span>
               <span ng-show="sortType == 'index' && sortReverse" class="fa fa-caret-up"></span>
             </a>
           </th>

             <th data-toggle="true">
              <a    ng-click="sortType = 'num'; sortReverse = !sortReverse"  >
               <span  > N° d'inscription </span>
               <span ng-show="sortType == 'num' && !sortReverse" class="fa fa-caret-down"></span>
               <span ng-show="sortType == 'num' && sortReverse" class="fa fa-caret-up"></span>
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
  <a  ng-click="sortType = 'accepted'; sortReverse = !sortReverse" >
   <span > Etude de dossiers  </span>
   <span ng-show="sortType == 'accepted' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'accepted' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
           
<th data-hide="phone,tablet">
  <a  ng-click="sortType = 'etatFinale'; sortReverse = !sortReverse" >
   <span > Etat finale des candidats  </span>
   <span ng-show="sortType == 'etatFinale' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'etatFinale' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
<th data-hide="phone,tablet">
  <a  ng-click="sortType = 'motif'; sortReverse = !sortReverse" >
   <span > Motif sur les dossiers rejetés   </span>
   <span ng-show="sortType == 'motif' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'etmotifat' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>

<th data-hide="phone,tablet" >
 Note (Examen 1 | Ecrit ou l'étude de dossiers PA)
</th>
<th data-hide="phone,tablet" >
 Pièces Jointes et validation
</th>
<th data-hide="phone,tablet" >
 validation
</th>







</tr>

<tr  ng-repeat="candidat in candidatss.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse"   ng-class="{'selected':candidat.postuler_id == selectedRow}" ng-click="setClickedRow(candidat.postuler_id)">
  <td>{{candidat.postuler_id}}</td>
  <td >{{candidat.num}}</td>
  <td>{{candidat.cin}}</td>
  <td>{{candidat.nom}} {{candidat.prenom}}</td>
  <td>{{candidat.age}}ans</td>
  <td>{{candidat.diplome}}</td>
  <td>{{candidat.specialite}}</td>
  
  <td>
    <span class="label label-danger label-xs"   ng-if="candidat.accepted==0" title="At {{candidat.accepted_at}}" > Dossier Etudié par {{candidat.accepted_by}}</span>  
   <span class="label label-success label-xs" ng-if="candidat.accepted==1" title="At {{candidat.accepted_at}}"> <i class="fa fa-check"></i> Dossier Etudié par {{candidat.accepted_by}}</span>
   <span class="label label-warning label-xs" ng-if="candidat.accepted==2" > En attente (Etude).</span>
 </td>

 <td>
    <span class="label label-danger label-xs"   ng-if="candidat.etatFinale==0" title="At {{candidat.accepted_at}}" > Candidature Rejetée par {{candidat.accepted_by}}</span>  
   <span class="label label-success label-xs" ng-if="candidat.etatFinale==1" title="At {{candidat.accepted_at}}"> <i class="fa fa-check"></i> Candidature Acceptée par {{candidat.accepted_by}}.</span>
   <span class="label label-warning label-xs" ng-if="candidat.etatFinale==2 || candidat.etatFinale==null" > En attente de la validation finale </span>  
 </td>
 <td><span ng-show="{{candidat.accepted==0}}">{{candidat.motif}}</span></td>
                      

                      <td>

                         <a  ng-if="candidat.accepted==1 && (role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.notes_ex1 || paramsDroit.ctl_all )))"  data-record-id="{{candidat.postuler_id}}" data-record-title="{{candidat.nom | uppercase}} {{candidat.prenom | uppercase}}" data-toggle="modal"  class="btn btn-default btn-md" data-target="#confirm-note-ex1" ng-click="confirmNoteEx1(candidat.postuler_id)" ><i class="fa fa-plus"></i> Gestion des notes</a>
                     
                      </td>

                      <td>

                        <a ng-click="getFilesForAccept(candidat.postuler_id , isMembre);"  class="btn btn-default"><i class="fa fa-eye"></i> Afficher les Pièces jointes et validation</a>
                      </td>
                      
                      
                      <td> 

                        <button ng-if="role == 'Superviseur' || (role == 'Commission' && type_comm != 'Membre') || 
                                       (role == 'Admin' && candidat.profile != 'BAC+8' && type_comm != 'Membre' && (paramsDroit.traitAdmin || paramsDroit.ctl_all ) ) 
                                       " class="btn btn-success btn-xs" ng-disabled="{{candidat.accepted == 1}}"  
                                ng-click="accepter(candidat.postuler_id,hireEdit.is_open);">Accepter</button>



                        <button ng-if="role == 'Superviseur' || (role == 'Commission' && type_comm != 'Membre')  
                                       || (candidat.accepted != 1 && role == 'Admin' && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) 
                                       || (role == 'Admin' && candidat.profile != 'BAC+8' && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) 
                                       " class="btn btn-danger btn-xs" ng-disabled="{{candidat.accepted == 0}}" 
                                ng-click="rejeter(candidat.postuler_id , hireEdit.session_date_end,hireEdit.is_open);">Rejeter</button>     


                        <button ng-if="role=='Superviseur' || (role == 'Admin'  && type_comm != 'Membre' 
                                       && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) " class="btn btn-warning btn-xs" 
                                ng-disabled="{{candidat.accepted == 1 || candidat.accepted == 0 && candidat.profile == 'BAC+8'}}"  
                                ng-click="annulerRejet(candidat.postuler_id,hireEdit.is_open);">Annuler</button>


                      </td>
                      
                    </tr>
                  </table>

                  

                  <div class="form-group">
                   <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


                 </div>
                 
                 
                 
                 
                 
               </div>
             </div>


          </div>

  <div class="modal fade" id="confirm-note-ex1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Ajouter la note (Examen 1) | Candidat : <b class="title"></b></h4>
      </div>
      <div class="modal-body">

       <div class="row">
          <div class="form-group">
            <label class="col-lg-4 control-label">Note (Générale) Ou Etude de dossier</label>
            <div class="col-lg-8">
               <input type="text" ng-model="candidat.note_gen" ng-style="styleZone" placeholder=".../20" class="form-control" required   ng-change="analyze(candidat.note_gen)"  />
           
            </div>
          </div>
       </div>

       <div class="row" ng-if="profile != 'BAC+8'">
          <div class="form-group">
            <label class="col-lg-4 control-label">Note (Spécialité)</label>
            <div class="col-lg-8">
               <input type="text" ng-model="candidat.note_spe" ng-style="styleZone" placeholder=".../20" class="form-control"  ng-change="analyze(candidat.note_spe)"  />
           
            </div>
          </div>
       </div>

       <div class="row">
          <div class="form-group">
            <label class="col-lg-4 control-label">Note Finale (Examen 1)</label>
            <div class="col-lg-8">
               <input type="text" ng-model="candidat.note_ex1" ng-style="styleZone" disabled="" class="form-control"    />
           
            </div>
          </div>
       </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" ng-disabled="!validated" class="btn btn-success btn-ok btn-xs pull-left" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.notes_ex1 || paramsDroit.ctl_all ))" >Ajouter la note</button>
        <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
        
      </div>
    </div>
  </div>
</div>
        </div>

     
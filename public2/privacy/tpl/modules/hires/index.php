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


<div ng-controller="HiresCtrl" ng-init="load();"  nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter" >
  <!--<toaster-container
    toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

    
    <div class="bg-light lter b-b wrapper-md"  >
      <div>
       <h4>Gestion des concours</h4>
       <ul class="breadcrumb bg-white b-a">
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.categorie" > Gestion des catégories</a></li>
        <li ng-if="role == 'Superviseur'"><a ui-sref="app.type" > Gestion des sous catégories</a></li>
        <li class="active"> Gestion des concours</li>
      </ul>
    </div>
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher...">         
    </blockquote>
    <a ui-sref="app.addHire" ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.addHire || paramsDroit.ctl_all ))" class="btn btn-info btn-xs" style="width: 100px;"> Ajouter </a>
      <center><a ng-click="getHiresWaitings(0);"  ng-if="role == 'Superviseur'" class="btn btn-primary btn-rounded btn-md" 
                 data-toggle="modal" data-target="#confirm-hires-waitings"> <i class="fa fa-bar-chart-o"></i> Vérifier les candidats en attente</a></center>
    <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
    <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
     <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
   </select> 
   <br />
   <br />

              <center> <h4 class="m-n font-bold text-primary">Sélectionner un établissement</h4>
               <select id="etablissement_id" style="width: 500px;" name="etablissement_id" ng-model="type.etablissement_id" class="form-control"
                       ng-options="etablissement.etablissement_id as etablissement.etablissement_name group by 'Sélectionner une établissement...' for etablissement in etablissementsScreen" ng-change="load(type.etablissement_id)" id="type.etablissement_id" name="type.etablissement_id"  >
                <option></option>
              </select></center>
 </div>
 


 <div class="wrapper-md" >

   
  
  <div class="panel panel-default">


              
   


    <div class="row row-sm">

     


      <div class="col-sm-12"  ng-repeat="hire in hires.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
        <div>
         
          <div class="panel-heading wrapper-xs bg-success no-border" style="color: #f4f3f9;
          background-color: {{ hire.color }};">          
        </div>

         <div class="col-sm-4"> 
          <ul class="list-group">
            <li class="list-group-item">
        <a href="" ng-click="getRequests(hire);" ng-if="role == 'Admin' || role == 'Superviseur'">
          <sup class="label label-danger label-xs" style="float:right;" ng-show="date > hire.session_end" >Expiré</sup>
          <sup class="label label-default label-xs pull-left"  ng-if="hire.is_report == 1" >Session reportée</sup>
          <div class="wrapper text-center">
            <input type="hidden" ng-model="hire.id">
            
            <h4 class="text-u-c m-b-none" ng-hide="date > hire.session_end">Recrutement - {{hire.type_name}}</h4>
            <h4 class="text-u-c m-b-none text-l-t" ng-show="date > hire.session_end" >Recrutement - {{hire.type_name}}</h4>
            <sup class="text-xs text-lt" style="color: #000000;"><p class="label label-primary">{{hire.post_number}} Poste(s) {{hire.type}}</p>  </sup>
            <center><span class="text-xs text-lt text-primary">{{hire.university_name }} - {{hire.etablissement_name }}</span></center>
           
            <center> <div ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.exportJur || paramsDroit.ctl_all )) && hire.profile == 'BAC+8'">

            <!--<a ng-click="exportJury(hire.id);" class="btn btn-primary btn-xs"> <i class="fa fa-file-excel-o"></i> Exporter les jurys</a>

            <a  ng-href="{{BASE_URL}}/uploadsFiles/{{user | limitTo:32}}/concours/{{hire.session_date |  date:'dd-MM-yyyy'}}.xlsx"  class="btn btn-success btn-xs" download=""> <i class="fa fa-download"></i> Télécharger la liste des jury</a>-->
          </div></center><br />
              <a ng-click="getHiresStates(hire.id);" class="btn btn-default btn-rounded btn-block" data-toggle="modal" data-target="#confirm-situation"> 
              <i class="fa fa-bar-chart-o text-primary-dker"></i> Situation des candidats</a>
              <br />

          </div>
        </a>
       


         
        </div>


      </li>
      </ul>
        <div class="col-sm-4">
        <ul class="list-group">

          
           
          <li class="list-group-item">
            
            <b> <small class="text-md" ><i class="icon-check text-default m-r-xs"></i>Spécialité: {{hire.specialty_fr }}</small> </b><br />
            <b> <em class="text-sm" ><i class="fa fa-calendar text-default m-r-xs"></i>Publié le: <span class="text-dark">{{hire.session_date_begin | date:'dd-MM-yyyy' }}</span></em></b><br />
            <b><em class="text-sm"><i class="fa fa-calendar text-default m-r-xs"></i>Date limite de dépôt du dossier: <span class="text-danger">{{hire.session_end | date:'dd-MM-yyyy' }}</span></em></b><br />
            <b><em class="text-sm text-u-l"><i class="fa fa-calendar text-default m-r-xs"></i>Date/Session du concours: <span class="text-success">{{hire.session_date | date:'dd-MM-yyyy' }}</span></em></b><br />

            <em class="text-sm"><i class="fa fa-list text-default m-r-xs"></i>Nombre de poste(s): <span class="text-default">{{hire.post_number}}</span></em> <br />
            
          </li>
          
          
        </ul>
         <a ng-click="getImpression(hire)"  class="btn btn-default btn-rounded btn-block"><i class="glyphicon glyphicon-th icon text-success-dker"></i> Gestion des listes</a>
      </div>
       <div class="col-sm-4">
        <div class="hbox text-center b-b b-light text-sm">          
         
          <a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.editHire || paramsDroit.ctl_all ))" class="col padder-v text-muted b-r b-light" ng-click="getElement(hire)" title="{{'operations.EDITOP' | translate}}">
            <i class="glyphicon  glyphicon-edit block m-b-xs fa-2x"></i>
            <span>Modifier</span>
          </a>
          <a  ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.deleteHire || paramsDroit.ctl_all ))" class="col padder-v text-white b-r b-light bg-danger" data-record-id="{{hire.id}}" data-record-title="{{hire.full_name}}" data-toggle="modal"  data-target="#confirm-delete" ng-click="deleteHire()" title="{{'operations.DELETEOP' | translate}}">
            <i class="glyphicon glyphicon-trash block m-b-xs fa-2x"></i>
            <span>Supprimer</span>
          </a>

        </div>

        <div class="hbox text-center b-b b-light text-sm">   
          <!-- <a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.gestionComm || paramsDroit.ctl_all ))"  ui-sref="app.membres-commission({hire_id : hire.id})" class="col padder-v text-white b-r b-light bg-info" title="Les membres de commission">
            <i class="fa fa-chain block m-b-xs fa-2x"></i>
            <span>G.Commissions</span>
          </a>       
          <a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.gestionRes || paramsDroit.ctl_all ))"    ng-click="getHireId(hire)" data-record-id="{{hire.id}}" data-record-title="{{hire.full_name}}" data-toggle="modal" data-target="#confirm-resultat"  title="Résultats" class="col padder-v text-muted b-r b-light">
            <i class="fa fa-plus block m-b-xs fa-2x"></i>
            <span>Résultats</span>
          </a>-->
		
          <a ng-if="role == 'Superviseur' || ( role == 'Admin' && (paramsDroit.gestionR || paramsDroit.ctl_all ))"    ng-click="getResults(hire)"   title="Résultats" class="col padder-v text-muted b-r b-light">
            <i class="fa fa-plus block m-b-xs fa-2x"></i>
            <span>Résultats</span>
          </a>
          
          
        </div>
        
    
        </div>
        </div>
      </div>



    </div>

    <div class="modal fade" id="confirm-situation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;">Situation des candidats</h4>
          </div>
          <div class="modal-body">
            
			  <img src="img/state.gif" style="width:50px;height:auto;" ng-model="stateLoader" ng-if="stateLoader == true" />
              <span ng-if="stateLoader == false" ng-repeat="state in states">
                <span ng-if="state.type == 'Nbre candidats en attentes'" class="label label-warning">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats acceptés'" class="label label-success">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats rejets'" class="label label-danger">{{state.type}} : {{state.nbre_wait}}</span>
                <span ng-if="state.type == 'Nbre candidats postulés'" class="label label-info">{{state.type}} : {{state.nbre_wait}}</span>
                
              </span>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
          
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="confirm-hires-waitings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;">Situation des candidats</h4>
          </div>
          <div class="modal-body">
            
                <table class="table table-bordered small">
                  <thead>
                    <th>
                      Session
                    </th>
                    <th>
                      Concours
                    </th>
                    <th>
                      Nbre candidats en attente
                    </th>
                  </thead>
                  <tbody>
                    <tr ng-repeat="hiresW in hiresWating">
                      <td>
                        {{hiresW.session_date}}
                      </td>
                      <td>
                        {{hiresW.type_name}} en {{hiresW.specialty_fr}} ({{hiresW.post_number}} posts)
                      </td>
                      <td>
                        {{hiresW.nbre_postuled}}
                      </td>
             
                      
                    </tr>
                  </tbody>
                </table>
               
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
          
        </div>
      </div>
    </div>
  </div>





    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;">Confirmation</h4>
          </div>
          <div class="modal-body">
           <p>
             Voulez-vous réellement supprimer cet enregistrement ?<br /> <b><u><i class="title"></i></u></b>
           </p>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
          <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
          
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="confirm-commission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel" >Ajouter un membre de commission <b><u><i class="title"></i></u></b></h4>
        </div>
        <div class="modal-body">

         <div class="form-group">
          <label class="col-lg-4 control-label" >Membres de commission </label>
          <div class="col-lg-8">
           
           <select ng-model="jurys.jury_id" class="form-control" ng-options="jur.usr_id as jur.usr_email group by jur.nom for jur in jury" id="jury.jury_id" name="jury.jury_id" required="true">
            <option required="true">---</option>
          </select>   
        </div>
      </div>
      <br />
      <br />
      
      <div class="form-group" ng-init="changeTypeComm();">
       <label class="col-lg-4 control-label" >Droit </label>
       <div class="col-lg-8">
        <select ng-model="jurys.typeComm"  class="form-control">
          <option ng-repeat="ty in typesComm">{{ty}}</option>
        </select> </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-success btn-jury btn-xs pull-left" ng-click="saveCommissionToHire();">Ajouter</button>
      <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
      
    </div>
  </div>
</div>
</div> 



 
</div>
</div>









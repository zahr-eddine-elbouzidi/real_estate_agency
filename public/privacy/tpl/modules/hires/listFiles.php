<?php

/**
 * @Author: zahr
 * @Date:   2019-06-13 23:29:11
 * @Last Modified by:   zahr
 * @Last Modified time: 2020-08-14 01:55:50
 */
?>

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


<div ng-controller="ListFileAdministrationCtrl" ng-init="loading();">
 
  <div class="row">
    <div class="col-sm-6">
          <div class="wrapper-md bg-light dk b-b text-b">


            <h4 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h4><hr />
            <h5 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h5>      
             <h5 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date |  date:'dd-MM-yyyy' }}</h5> 
             <h5 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h5> 
             <hr />
            <div class="btn-toolbar">
               
              <div class="btn-group">
                <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..." /> 
              </div>
              <button  class="btn btn-lg btn-bg btn-success rounded padder"   ng-click="refresh();"><i class="fa fa-refresh"></i> Afficher et Actualiser </button>
            </div>
           
             

          </div>
    </div>
    <div class="col-sm-6">
      <div class="wrapper-md bg-light dk b-b text-b">


            <h4 class="m-n font-bold text-primary">Candidat : {{candidat.nom | uppercase}} {{candidat.prenom | uppercase}} | {{candidat.prenom_ar}} {{candidat.nom_ar}}</h4>

            <h5 class="m-n font-thin">Carte d'Identité Nationale : {{candidat.cin}} </h5>      
            <h5 class="m-n font-thin">Téléphone : {{candidat.tel}} </h5>      
            <h5 class="m-n font-thin">Sexe : {{candidat.sexe}} </h5>      
            <h5 class="m-n font-thin">Date de naissance : {{candidat.date_naiss |  date:'dd-MM-yyyy'}} </h5>      
            <h5 class="m-n font-thin">Lieu de naissance : {{candidat.lieu_naiss | uppercase}} </h5>      
            <h5 class="m-n font-thin">Diplôme : {{candidat.diplome}} </h5>      
            <h5 class="m-n font-thin">Spécialité : {{candidat.specialite | uppercase}} </h5>      
            <h5 class="m-n font-thin">Mention : {{candidat.mention}} </h5>      
            <h5 class="m-n font-thin">Année d'obtention : {{candidat.date_obtention}} </h5>      
            <h5 class="m-n font-thin">Adresse : {{candidat.adresse_fr | uppercase}} | {{candidat.adresse_ar}}</h5>      
            <h5 class="m-n font-thin">Candidat Handicapé ? : <span ng-if="candidat.is_fonctionnaire == 0">Non</span><span ng-if="candidat.is_fonctionnaire == 1">Oui</span> </h5>      
            <h5 class="m-n font-thin">Candidat Fonctionnaire ? : <span ng-if="candidat.etablissement != null && candidat.etablissement != ''">Oui - Organisme : {{candidat.etablissement | uppercase}}</span><span ng-if="candidat.etablissement == null || candidat.etablissement == ''">Non</span> </h5>      
              <hr />
           
            
             

          </div>
    </div>
  </div>        

  
  
  



  
  <div class="wrapper-md" style="clear: both;">
   
   
   
 
    <div class="panel panel-default">
      <div class="panel-heading">
        Pièces Jointes
      </div>
      <br />
      <div class="col-md-12"  >

        <div class="col-md-6">
          <input type="text"  class="form-control" ng-model="comment" placeholder="Ajouter un commentaire sur les candidats ..." /><br />

        </div>

        <div class="col-md-6">
          <select class="form-control"  ng-model="dossier">
           <option value="خارج التخصص">خارج التخصص</option>
           <option value="الملف ناقص">الملف ناقص</option>
         </select>
       
     </div>  
   </div>
 

     <center>
      <button ng-if="(role == 'Commission' && type_comm != 'Membre') || (role == 'Admin' && profile != 'BAC+8' 
                     && profile != null && type_comm != 'Membre' && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) " class="btn btn-success" 
              ng-disabled="{{postuler.accepted == 1}}"  ng-click="accepter();">Accepter</button>

      <button ng-if="(role == 'Commission' && type_comm != 'Membre')  || (postuler.accepted != 1 && role == 'Admin' 
                     && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) || (role == 'Admin' && profile != 'BAC+8' 
                     && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) " 
              class="btn btn-danger" ng-disabled="{{postuler.accepted == 0}}" ng-click="rejeter(hireEdit.session_date_end);">Rejeter </button>

      <button ng-if="(role == 'Admin'  && type_comm != 'Membre' && (paramsDroit.traitAdmin || paramsDroit.ctl_all )) " 
              class="btn btn-warning" ng-disabled="{{postuler.accepted == 1 || postuler.accepted == 0 && profile == 'BAC+8'}}"  ng-click="annulerRejet();">Annuler</button>

    </center>
      
      <div class="table-responsive" style="clear: both;">

       <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
       <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
        <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
      </select> 

      
      
      
      
      
      <table  class="table table-striped small" >

     <!--  <tr>
         <th data-toggle="true">
          <a    ng-click="sortType = 'nom'; sortReverse = !sortReverse"  >
           <span  > Nom et Prénom </span>
           <span ng-show="sortType == 'nom' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'nom' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       <th data-toggle="true">
        <a    ng-click="sortType = 'cin'; sortReverse = !sortReverse"  >
         <span  > C.I.N </span>
         <span ng-show="sortType == 'cin' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'cin' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>-->

      <th data-toggle="true">
    <a    ng-click="sortType = 'file_type'; sortReverse = !sortReverse"  >
     <span  >Type du fichier  </span>
     <span ng-show="sortType == 'file_type' && !sortReverse" class="fa fa-caret-down"></span>
     <span ng-show="sortType == 'file_type' && sortReverse" class="fa fa-caret-up"></span>
   </a>
 </th> 

 
     <th data-toggle="true">
      <a    ng-click="sortType = 'filename'; sortReverse = !sortReverse"  >
       <span  >Fichier</span>
       <span ng-show="sortType == 'filename' && !sortReverse" class="fa fa-caret-down"></span>
       <span ng-show="sortType == 'filename' && sortReverse" class="fa fa-caret-up"></span>
     </a>
   </th>

  
 <th>
  Création
</th>    



</tr>

<tr ng-repeat="file in files.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
  <!--<td>{{file.nom}} {{file.prenom}}</td>
  <td>{{file.cin}}</td>-->
   <td><span>{{file.type_file}}</span>  <a  ng-if="file.type_file == 'Thèse'" data-target="#confirm-info" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-record-id="{{file.id_file}}" ng-click="displayFile(file.id)"  >Les membres de jury <i class="fa fa-eye"></i>
  </a></td>

  <td ng-if="role == 'Superviseur' || (role == 'Admin' && (paramsDroit.traitAdmin || paramsDroit.ctl_all ))">
    <a href="{{BASE_URL}}/uploadsFiles/{{file.usr_registration_token}}/files/{{file.filename}}" target="_blank" ><span class="label label-primary"> {{ file.filename }}</span></a>
  </td>
 
  <td>{{file.created_at_file }}</td> 

  
</tr>
</table>



<div class="form-group">
 <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


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
 

        
            </tr>
            <tr ng-repeat="file in jury | orderBy:sortType:sortReverse">
             <td><span>{{file.nom_complet}}</span></td>  
             <td><span>{{file.etablissement}}</span></td>  
              <td><span>{{file.specialite}}</span></td>  
              
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
</div>
</div>




</div>
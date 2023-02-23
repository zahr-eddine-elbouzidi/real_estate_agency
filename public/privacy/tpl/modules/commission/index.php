<?php

/**
 * @Author: zahr
 * @Date:   2019-07-16 22:07:41
 * @Last Modified by:   zahr
 * @Last Modified time: 2019-07-16 23:27:20
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


<div ng-controller="CommissionCtrl" >
  <!--<toaster-container
    toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


    <div class="bg-light lter b-b wrapper-md"  >
      <div>
       <h4>Mes concours</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a><i class="fa fa-home"></i> Accueil</a></li>
        <li class="active">Mes concours</li>
      </ul>
    </div>
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher...">         
    </blockquote>
    
    <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
    <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
     <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
   </select> 
 </div>
 


 <div class="wrapper-md" >
  
   
  
  <div class="panel panel-default">



    <div class="row row-sm">

     


      <div class="col-sm-4 col-md-4 col-sm-6" ng-repeat="hire in hiresCommission.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
        <div class="panel b-a">
          <div class="panel-heading wrapper-xs bg-success no-border" style="color: #f4f3f9;
          background-color: {{ hire.color }};">          
        </div>
        <a href="" ng-click="getRequests(hire);">
          <sup class="label label-danger label-xs" style="float:right;" ng-show="date > hire.session_date_end" >Expiré</sup>
          <div class="wrapper text-center">
            
            <h4 class="text-u-c m-b-none" ng-hide="date > hire.session_date_end">Recrutement - {{hire.type_name}}</h4>
            <h4 class="text-u-c m-b-none text-l-t" ng-show="date > hire.session_date_end" >Recrutement - {{hire.type_name}}</h4>
            <sup class="text-xs text-lt" style="color: #000000;"><p class="label label-primary">{{hire.post_number}} Poste(s) {{hire.type}}</p>  </sup>
            <h2 class="m-t-none">
             
            </h2>
          </div>
        </a>

        <ul class="list-group">

          <center><span class="label label-success text-xs text-lt">{{hire.university_name }} - {{hire.etablissement_name }}</span></center>
          
          <li class="list-group-item">
            
            <b> <small class="text-xs" ><i class="icon-check text-default m-r-xs"></i>Spécialité: {{hire.specialty_fr }}</small> </b><br />
            <b> <em class="text-xs" ><i class="fa fa-calendar text-default m-r-xs"></i>Publié le: <span class="text-dark">{{hire.session_date_begin | date:'dd-MM-yyyy' }}</span></em></b><br />
            <b><em class="text-xs"><i class="fa fa-calendar text-default m-r-xs"></i>Date limite de dépôt du dossier: <span class="text-danger">{{hire.session_date_end | date:'dd-MM-yyyy' }}</span></em></b><br />
            <b><em class="text-xs text-u-l"><i class="fa fa-calendar text-default m-r-xs"></i>Concours le: <span class="text-success">{{hire.hire_date | date:'dd-MM-yyyy' }}</span></em></b><br />

            <em class="text-xs"><i class="fa fa-list text-default m-r-xs"></i>Nombre de poste(s): <span class="text-default">{{hire.post_number}}</span></em> <br />

            <em class="text-xs"><i class="fa fa-map-marker text-default m-r-xs"></i>Adresse : <span class="text-default">{{hire.hire_adresse}}</span></em> 
            
          </li>
          
          
        </ul>
        
        <div class="panel-footer text-center">
          
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



<div class="modal fade" id="confirm-jury" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" >Ajouter un membre de commission</h4>
      </div>
      <div class="modal-body">

       <div class="form-group">
        <label class="col-lg-2 control-label" >Membres de commission <b><u><i class="title"></i></u></b></label>
        <div class="col-lg-8">
         
         <select ng-model="jury.jury_id" class="form-control" ng-options="jur.usr_id as jur.usr_email group by jur.nom for jur in jury" id="jury.jury_id" name="jury.jury_id" required="true">
          <option required="true">---</option>
        </select>   
      </div>
    </div>
    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-success btn-jury btn-xs pull-left" ng-click="AddCommissionToHire();">Ajouter</button>
    <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
    
  </div>
</div>
</div>
</div> 
</div>
</div>
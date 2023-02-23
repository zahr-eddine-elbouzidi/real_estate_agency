<!DOCTYPE html>
<?php

/**
* @Author: zahr
* @Date:   2019-06-13 23:29:11
* @Last Modified by:   zahr
* @Last Modified time: 2019-06-14 00:44:15
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


<div ng-controller="CommissionCtrl" ng-init="changer();">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  
  
  <div class="bg-light lter b-b wrapper-md"   >
    <div>
      


      <h4>Affectation (Membres de commission)</h4>
      <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li class="active">Affectation (Membres de commission)</li>
      </ul>


    </div>
    
    <!--<br /><br />

    <input type="text" ng-model="search"  class="form-control input-sm bg-white rounded padder" placeholder="Rechercher..."> -->

  </div>


  <div class="wrapper-md" style="clear: both;">



    <div class="panel panel-default">
      <div class="panel-heading">
        Affectation (Membres de commission)
      </div>

      <div class="row">
        <div class="col-sm-4">
           <form class="form-horizontal" ng-submit="saveCommissionToHire();">


       
        <div class="form-group" >
          <label class="col-lg-4 control-label" >Commission </label>
          <div class="col-lg-8" ng-click="changer();">

             <select  ui-jq="chosen"  data-placeholder="Sélectionner un prof"  ng-model="jurys.jury_id"  class="form-control"  single >
                      <option ng-repeat="list in tolist" value="{{list.usr_id}}"   >{{list.nom_complet}} {{list.nom_complet_ar}}   < {{list.usr_email}} - {{list.etablissement_id}} > </option>
                       
              </select>
           
         <!--  <select editable="true" ng-model="jurys.jury_id" class="form-control" ng-options="jur.usr_id as jur.usr_email+' <'+jur.nom+' '+jur.prenom+'> <'+' '+jur.etablissement_name+'>'  for jur in jury" id="jury.jury_id" name="jury.jury_id" required="true">
            <option required="true">---</option>
          </select>   -->
        </div>
      </div>



      <div class="form-group" ng-init="changeTypeComm();">
        <label class="col-lg-4 control-label" >Type </label>
        <div class="col-lg-8">
          <select ng-model="jurys.typeComm"  class="form-control">
            <option ng-repeat="ty in typesComm">{{ty}}</option>
          </select> </div>
        </div>

        <div class="form-group">
          <label class="col-lg-4 control-label" > </label>
          <div class="col-lg-8">
         <input type="submit" value="Affecter" class="btn btn-success btn-jury"  ng-click="changer();" />
       </div>
       </div>

     </form>
        </div>
        <div class="col-sm-8">
             <div class="table-responsive">
      <table  class="table table-striped small" >

        <tr>
          <th data-toggle="true">
            <a    ng-click="sortType = 'doti'; sortReverse = !sortReverse"  >
              <span  >PPR </span>
              <span ng-show="sortType == 'doti' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'doti' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'cin'; sortReverse = !sortReverse"  >
              <span  >CIN  </span>
              <span ng-show="sortType == 'cin' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'cin' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>
          <th data-toggle="true">
            <a    ng-click="sortType = 'nom_complet'; sortReverse = !sortReverse"  >
              <span  >Nom et Prénom </span>
              <span ng-show="sortType == 'nom_complet' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'nom_complet' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'nom_complet_ar'; sortReverse = !sortReverse"  >
              <span  >الاسم و النسب  </span>
              <span ng-show="sortType == 'nom_complet_ar' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'nom_complet_ar' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'usr_email'; sortReverse = !sortReverse"  >
              <span  >Email  </span>
              <span ng-show="sortType == 'usr_email' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'usr_email' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>



          <th data-toggle="true">
            <a    ng-click="sortType = 'etablissement'; sortReverse = !sortReverse"  >
              <span  >Etablissement </span>
              <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'status_membre'; sortReverse = !sortReverse"  >
              <span  >Grade</span>
              <span ng-show="sortType == 'status_membre' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'status_membre' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'type'; sortReverse = !sortReverse"  >
              <span  >Type de commission</span>
              <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>


          

          <th data-toggle="true">
            <a    ng-click="sortType = 'date_naiss'; sortReverse = !sortReverse"  >
              <span  >Date de naissance  </span>
              <span ng-show="sortType == 'date_naiss' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'date_naiss' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          <th data-toggle="true">
            <a    ng-click="sortType = 'date_rec'; sortReverse = !sortReverse"  >
              <span  >Date de recrutement  </span>
              <span ng-show="sortType == 'date_rec' && !sortReverse" class="fa fa-caret-down"></span>
              <span ng-show="sortType == 'date_rec' && sortReverse" class="fa fa-caret-up"></span>
            </a>
          </th>

          
          

          <th >
            Action
          </th>                  
        </tr>
        <tr ng-repeat="file in membres | orderBy:sortType:sortReverse">
          <td><span>{{file.doti}}</span></td>  
          <td><span>{{file.cin}}</span></td>  
          <td><span>{{file.nom_complet}}</span></td>  
          <td><span>{{file.nom_complet_ar}}</span></td>  
          <td><span>{{file.usr_email}}</span></td>  
          <td><span>{{file.etablissement_id}}</span></td>  
          <td><span>{{file.grade_id}}</span></td>  
          <td><span>{{file.type}}</span></td>  
          <td><span>{{file.date_naiss}}</span></td>  
          <td><span>{{file.date_rec}}</span></td>  
          

          <td> 
            <a   data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-toggle="modal" data-target="#confirm-delete-jury" ng-click="deleteCommission();" title="{{'operations.DELETEOP' | translate}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Supprimer</a>

          </td> 
        </tr>
      </table>                 
    </div>            
    
        </div>


      </div>



  
    
  </div>





  <div class="modal fade" id="confirm-delete-jury" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel" >Supprimer (Membres de commission)</h4>
        </div>
        <div class="modal-body">
         <p>
           
          Vous essayez de supprimer <b class="label label-primary"><i class="title"></i></b>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Supprimer</button>
        <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
        
      </div>
    </div>
  </div>
</div> 




</div>




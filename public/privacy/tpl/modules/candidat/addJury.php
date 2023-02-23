 

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


<div ng-controller="JuryCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  
  
  <div class="bg-light lter b-b wrapper-md"   >
    <div>
      
      <h4>Mes jury</h4>
      <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li class="active">Mes Jury</li>
      </ul>


    </div>
    
    <br />
 <span class="text-danger"><i class="fa fa-info"></i>  Un dossier soumissioné avec le formulaire vide ou incomplet sera rejeté automatiquement.</span><br /><br />
  </div>


  <div class="wrapper-md" style="clear: both;">

    <div class="panel panel-default">
      <div class="panel-heading">
        Mes JURY
      </div>


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
            <td><span> {{file.specialite}}</span></td>  
    

            <td> 

              <i  ng-if="date > hireGet.session_date_end" class="glyphicon glyphicon-lock"></i>
              <a  ng-if="date <= hireGet.session_date_end" data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-dismiss="modal" 
              data-toggle="modal" data-target="#confirm-delete-jury" ng-click="deleteJury(file.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>

            </td> 
          </tr>
        </table>
      </div>  
      <div class="table-responsive" >
        <form action="POST" name="formValidate" class="form-validation">
         
          <div class="form-group"  >
            
           
           
            <p class="label label-danger"><i class="fa fa-info"></i>  Pour compléter votre demande de candidature, prière de remplir ce formulaire avant de postuler !</p><br /><br />

            <span class="text-danger"><i class="fa fa-info"></i>  Un dossier soumissioné avec le formulaire vide ou incomplet sera rejeté automatiquement.</span><br /><br />


            <button type="button"  class="btn btn-success btn-conf pull-right" ng-click="saveJury();" data-dismiss="modal" >Ajouter</button><br />
            <span class="text-primary">Membres de jury (La page de garde de la thèse):</span><br /><br />
           <!-- <div class="form-group" >
              <label class="col-lg-4 control-label" >Professeurs </label>
              <div class="col-sm-8">
                <select ng-init="loadJury();" ng-if="tolist.length != 0" ui-jq="chosen" data-placeholder="Sélectionner les membres de jury de la thèse"  ng-model="file.idagent"  class="form-control"  single ng-change="getValue();">
                  <option ng-repeat="list in tolist" value="{{list.idagent}}" >{{list.nom_complet}}  < {{list.doti}} - {{list.etablissement_id}} > </option>
                  <option value="0" >Autre</option>
                  <option value="-1" disabled="true"></option>
                </select>
              </div>
            </div>-->
            <div class="form-group">
             <label class="col-lg-4 control-label">Nom et Prénom</label>
             <div class="col-lg-8">
              <input id="nom_complet" type="text"  ng-minlength="5"  name="file.nom_complet" class="form-control" placeholder="Nom et Prénom" ng-model="file.nom_complet" />
            </div>
          </div> <br /> 
          <div class="form-group">
            <label class="col-lg-4 control-label">Etablissement, Université</label>
            <div class="col-lg-8">
              <input id="etablissement" type="text"  ng-minlength="5"  name="file.etablissement" class="form-control" placeholder="Établissement"   required ng-model="file.etablissement" />
            </div>
          </div><br />
          <div class="form-group">
            <label class="col-lg-4 control-label">Spécialité</label>
            <div class="col-lg-8">
              <input id="specialite" placeholder="Spécialité"  ng-minlength="6"  type="text" name="file.specialite" class="form-control"   required ng-model="file.specialite" />
            </div>
          </div><br />

          <br /><br />
          <span class="text-danger"><i class="fa fa-info"></i>  Un dossier soumissioné avec le formulaire vide ou incomplet sera rejeté automatiquement.</span>
          <br /><br />
          
          
          
        </div>
      </form>
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




</div>




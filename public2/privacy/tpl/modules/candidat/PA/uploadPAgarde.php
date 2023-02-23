<div ng-controller="FileUpProfCtrl"  nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter" >

<div class="bg-light lter b-b wrapper-md" ng-init="copyFilesInBackground();" >
<div>
     <h4>Pièces Jointes et Postulation</h4>
</div> 

<div class="panel panel-default">
 

<div class="wrapper-md bg-light dk b-b text-b">
<!--<b><span class="pull-right m-t-xs">Nombre de poste(s) <b class="badge bg-dark">{{hireEdit.post_number}}</b></span></b>-->
  <h2 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h2>       
  <h4 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h4>      
  <h4 class="m-n font-thin">Code : {{hireEdit.hire_code}} </h4>      
  <h4 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date |  date:'dd-MM-yyyy' }}</h4> 
  <h4 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h4> 
  <hr />

   <div  ng-if="messageTerminer != null">
    <center> <b  >
      <button ng-if="isPostuled == false;" type="submit" class="btn btn-success btn-lg font-bold m"  ng-click="savePostuler()">Postuler <i class="glyphicon glyphicon-ok"></i><hr /><h6><i class="icon icon-info"></i> {{messageTerminer}} </h6></button>
    </b></center>
  </div> 

<div class="alert alert-info" ng-if="theseUploaded && (role=='Candidat-PESAF' || role=='Candidat-PESAM')">
  <h5 class="m-n font-bold text-danger text-center">N.B: Un dossier soumissioné sans membres de jury de la thèse ou incomplet sera rejeté automatiquement. !</h5>   
   <a  data-target="#confirm"  id="custId" data-toggle="modal"  >  <h4 class="text-center text-b" style="text-decoration: underline;font-weight: bold;"><i class="icon icon-info"></i> Veuillez ajouter les membres de jury de la thèse en cliquant sur le lien suivant : <span class="text-info">Ajouter les membres de jury</span></h4></a>

    <a  data-target="#confirm"  id="custId" data-toggle="modal"  >  <h4 class="text-center text-b" style="text-decoration: underline;font-weight: bold;">المرجوا إظافة جميع أعضاء لجنة الأطروحة  <i class="icon icon-info"></i> </h4></a>

     <center><a  data-target="#confirm-info" class="btn btn-default btn-small" id="custId" data-toggle="modal" data-record-id="{{file.id_file}}" ng-click="displayFile('Thèse')"  >
    <i class="fa fa-eye"></i>  Afficher mes membres de jury de la thèse
  </a></center>
</div>
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"> 

        <a  ng-click="redirectMesPieces();" class="btn btn-default btn-lg" ng-if="SLUG == 'Dossier: Diplômes' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" ><i class="fa fa-arrow-left"></i> Étape Précedente | Pièces 
     <span aria-hidden="true"></span></a>

     <a ng-click="redirectUploadDocPADiplomesadmin();" class="btn btn-default btn-lg" ng-if="SLUG == 'Dossier: Thèse, Publications et Communications' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')"><i class="fa fa-arrow-left"></i> Étape Précedente | Diplômes 
     <span aria-hidden="true"></span></a>

     <a ng-click="redirectUploadDocDossierScienti();" class="btn btn-default btn-lg" ng-if="SLUG == 'Dossier: Attestations' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')"><i class="fa fa-arrow-left"></i> Étape Précedente | Dossier Scientifique 
     <span aria-hidden="true"></span></a>

   </li>
    
    <li class="next">

      <a ng-click="redirectUploadDocPADiplomesadmin();" class="btn btn-default btn-lg" ng-if="SLUG == 'Les pièces à fournir' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')">Étape Suivante | Diplômes <i class="fa fa-arrow-right"></i>
     <span aria-hidden="true"></span></a>

     <a ng-click="redirectUploadDocDipAdmin();" class="btn btn-default btn-lg" ng-if="SLUG == 'Les pièces à fournir' && (role=='Candidat-Normale')">Étape Suivante | Diplômes <i class="fa fa-arrow-right"></i>
     <span aria-hidden="true"></span></a>


     

     <a  ng-click="redirectUploadDocDossierScienti();"  class="btn btn-default btn-lg" ng-if="SLUG == 'Dossier: Diplômes' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" >Étape Suivante | Dossier Scientifique <i class="fa fa-arrow-right"></i>
     <span aria-hidden="true"></span></a>

     <a ng-click="redirectUploadDocAttestationExp();"  class="btn btn-default btn-lg" ng-if="SLUG == 'Dossier: Thèse, Publications et Communications' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" >Étape Suivante | Expérience Pédagogique <i class="fa fa-arrow-right"></i>
     <span aria-hidden="true"></span></a>

     <!--<a  ui-sref="app.mes-concours" ng-if="SLUG == 'Dossier: Diplômes' && role=='Candidat-Normale'" >Étape Suivante (Concours) <i class="fa fa-arrow-right"></i>
     <span aria-hidden="true"></span></a>-->


   </li>
  </ul>
</nav>
</div>


 <div class="wrapper-md">




 <div class="col-sm-8"   >
       
    <div class="panel panel-default"  >
     

      <div class="wrapper-md bg-light dk b-b">
            <span class="pull-right m-t-xs">Fichier(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
            <h3 class="m-n font-thin">{{SLUG }}</h3>      
          </div>
      <div class="panel-body">


        <div class="row">
         <div class="form-group" ng-if="SLUG == 'Dossier: Diplômes'">
        <label class="col-sm-2 control-label">Type du diplôme</label>
        <div class="col-lg-10">
          <select id="nature" name="nature" class="form-control input-sm" ng-model="nature" ng-change="change(nature)">
            <option>Marocain</option>
            <option>Etranger</option>
        </select>
        </div>
      </div>
     

      </div>
  <div class="row">
       <div class="form-group">
        <label class="col-sm-2 control-label">Type du pièce jointe</label>
        <div class="col-lg-10">
          <select id="type" name="type" class="form-control input-sm" ng-model="type"  ng-options="t.name as t.name for t in types"  ng-click="clearAll();"  >

            <option></option>
                 
                
        </select>
        </div>
      </div>
    </div>

  
<div class="row">

       <div class="form-group">
        <label class="col-sm-4 control-label">Sélectionner un fichier (.PDF)</label>
        <div class="col-lg-6">
           <input type="file" nv-file-select="" id="file_upload"  accept=".pdf"  ng-show="!admin" uploader="uploader" ng-click="uploader.clear()"  />
            <p class="label label-warning">N.B: La taille des fichiers doit être inférieur ou égale {{sizeFile}}Mo</p>
        </div>
      </div>        </div>




  
      <div class="row">

       <div class="form-group">
       
        <label class="col-sm-2 control-label">Détails</label>
        <div class="col-lg-6">
           <table class="table bg-white-only b-a" style="height: 50px;">
                  <thead>
                      <tr>
                          <th class="text-dark" width="50%">Fichier</th>
                          <th class="text-dark" ng-show="uploader.isHTML5">Taille</th>
                          <th class="text-dark" ng-show="uploader.isHTML5">Progression</th>
                          <th translate="upload.titles.STATUS">Status</th>
                          <th class="text-dark">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr ng-repeat="item in uploader.queue">
                       
                      
                         <td>
                         <strong class="text-primary">{{ filename }}</strong>
                         
                         <div class="alert alert-danger" ng-if="item.file.size/1024/1024 > sizeFile">La taille du fichier {{ filename }} doit être inférieur ou égale {{sizeFile}}Mo</div>
              
                         </td>
                          <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024 |number:2 }} MB</td>
                          <td ng-show="uploader.isHTML5">
                              <div class="progress progress-sm m-b-none m-t-xs">
                                  <div class="progress-bar bg-info" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                              </div>
                          </td>
                           <td class="text-center">
                              <span ng-show="item.isSuccess" class="text-success"><i class="glyphicon glyphicon-ok"></i></span>
                              <span ng-show="item.isCancel" class="text-warning"><i class="glyphicon glyphicon-ban-circle"></i></span>
                              <span ng-show="item.isError" class="text-danger"><i class="glyphicon glyphicon-remove"></i></span>
                          </td>
                         
                         
                          <td nowrap>
                            
                              <button type="button" ng-if="item.file.size/1024/1024 < sizeFile && invalidate==false" class="btn btn-primary btn-xs"  ng-click="uploadImage(item)" >
                                  importer
                              </button>
                              <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                                  Supprimer
                              </button>


                          </td>
                      </tr>
                  </tbody>
              </table> 

        </div>

      

            
      </div>         
      </div>  

    
</div> 
 
 


</div>

</div>

<div class="col-sm-4" ng-init="checked();" ng-if="piecesManqu.length != 0"  >
     <button class="btn btn-success" ng-click="checked();" ><i class="icon icon-refresh"></i> Vérifier les pièces manquantes à fournir !</button> <br />
      <br /><b class="text-center text-danger">Merci d'importer vos documents et postuler aux concours correspondants à votre spécialité du diplôme.</b><br />
       
        
       <ol class="text-danger text-small" ><li ng-repeat="piece in piecesManqu">{{piece}}</li></ol>

    </div>
 

</div>





<!--
<button type="button" ng-if="SLUG == 'Les pièces à fournir' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" class="btn btn-primary" style="float:right;" 
         ng-click="redirectUploadDocPADiplomesadmin();" >Étape Suivante (Diplôme) <i class="fa fa-arrow-right"></i></button>

<button type="button" ng-if="SLUG == 'Dossier: Diplômes' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" class="btn btn-primary" style="float:right;" 
         ng-click="redirectUploadDocDossierScienti();" >Étape Suivante (Dossier Scientifique) <i class="fa fa-arrow-right"></i></button>

 <button type="button" ng-if="SLUG == 'Dossier: Thèse, Publications et Communications' && (role=='Candidat-PESAF' || role=='Candidat-PESAM')" class="btn btn-primary" style="float:right;"  ui-sref="app.mes-concours" >Étape Suivante (Concours) <i class="fa fa-arrow-right"></i></button>

 <button type="button" ng-if="SLUG == 'Dossier: Diplômes' && role=='Candidat-Normale'" class="btn btn-primary" style="float:right;" 
         ui-sref="app.mes-concours" >Étape Suivante (Concours) <i class="fa fa-arrow-right"></i></button>-->




  <div class="wrapper-md" style="clear: both;">


    </div>

    </div>

      <div ng-show="drap == false" >
         <div class="wrapper-md dker b-b alert alert-danger">
          <h5 class="m-n font-thin"><i class="icon icon-info"></i>  Veuillez complèter votre profile ! <a  ui-sref="app.monespace" class="label label-primary">ICI</a></h5>

        </div>

 </div>

  </div>

   <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 250px;">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form name="formValidate" class="form-validation">
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
            <input id="nom_complet" type="text" ng-minlength="5" name="file.nom_complet" class="form-control" required ng-model="file.nom_complet" />
          </div>
        </div> <br /> 
        <div class="form-group">
          <label class="col-lg-4 control-label">Etablissement, Université</label>
          <div class="col-lg-8">
            <input id="etablissement" ng-minlength="5" type="text" name="file.etablissement" class="form-control"   required ng-model="file.etablissement" />
          </div>
        </div><br />
        <div class="form-group">
          <label class="col-lg-4 control-label">Spécialité</label>
          <div class="col-lg-8">
            <input id="specialite" ng-minlength="6" type="text" name="file.specialite" class="form-control"   required ng-model="file.specialite" />
          </div>
        </div><br />

        <li class="line dk hidden-folded"></li>
  
        <br />
        <span class="text-danger"><i class="fa fa-info"></i>  Un dossier soumissioné avec le formulaire vide ou incomplet sera rejeté automatiquement.</span>
        
      

      </div>
      <div class="modal-footer">
        <button type="button"   class="btn btn-success btn-conf pull-left" ng-click="saveJury();" >Ajouter</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" >X</button>
        
      </div> </form>
      
      
    </div>
  </div>

            </div>



<div class="modal fade" id="confirm-delete-jury" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 250px;">
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
    <div class="modal fade" id="confirm-info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 250px;">
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


                  <i  ng-if="date > hireEdit.session_date_end" class="glyphicon glyphicon-lock"></i>


                  <a  ng-if="date <= hireEdit.session_date_end"  data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-dismiss="modal" data-toggle="modal" data-target="#confirm-delete-jury"
                  
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
</div>
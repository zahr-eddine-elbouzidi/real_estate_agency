<div ng-controller="FileUpProfRestCtrl"  nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter" >

<div class="bg-light lter b-b wrapper-md" >
 
<div class="panel panel-default">
 

<div class="wrapper-md bg-light dk b-b text-b">

   <h2 class="m-n font-bold text-primary">Concours de recrutement - {{hireEdit.type}}  en {{hireEdit.specialty_fr}}</h2>       
  <h4 class="m-n font-thin">Etablissement Organisatrice : {{hireEdit.etablissement}} </h4>      
  <h4 class="m-n font-thin">Code : {{hireEdit.hire_code}} </h4>      
  <h4 class="m-n font-thin">Session/Date du concours : {{hireEdit.hire_date }}</h4> 
  <h4 class="m-n font-thin">Nombre de poste(s) : {{hireEdit.post_number}}</h4> 
  <hr />

   <div  ng-if="messageTerminer != null">
    <center> <b  >
      <button ng-if="isPostuled == false;" type="submit" class="btn btn-default btn-lg font-bold m"  ng-click="savePostuler()">Postuler <i class="glyphicon glyphicon-ok"></i><hr /><h6><i class="icon icon-info"></i> {{messageTerminer}} - Cliquez ici pour terminer l'opération<hr /> المرجو الضغط على الزر لإتمام العملية</h6></button>
    </b></center>
  </div> 
 
 <div class="col-sm-8" ng-init="checked();" ng-if="piecesManqu.length != 0"  >
       <button class="btn btn-success" ng-click="checked();" ><i class="icon icon-refresh"></i> Vérifier les pièces</button> <br />
        <br /><b class="text-center text-danger">Merci d'importer les pièces listés ci-dessous.</b><br />        
         <ol class="text-danger text-small" ><li ng-repeat="piece in piecesManqu">{{piece}}</li></ol>
  </div>

 
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"> 

      <a ui-sref="app.profil" class="btn btn-default btn-md"><i class="fa fa-arrow-left"></i> Étape Précedente<hr />Mon Profil - المعلومات الشخصية 
     <span aria-hidden="true"></span></a>
 
   </li>
    
    <li class="next">

      <a ui-sref="app.mes-concours" ng-if="nbre_files_without_hire == 0" class="btn btn-default btn-md" >Étape Suivante <i class="fa fa-arrow-right"></i><hr />Concours - المناصب 
     <span aria-hidden="true"></span></a>
    
    <a ng-click="redirectUploadDocDipAdmin();" class="btn btn-default btn-md" ng-if="nbre_files_without_hire != 0">Étape Suivante <i class="fa fa-arrow-right"></i><hr />Diplômes - الدبلومات 
     <span aria-hidden="true"></span></a>
       
    

   
 


   </li>
  </ul>
</nav>
</div>


 <div class="wrapper-md">




 <div class="col-sm-12"   >
       
    <div class="panel panel-default"  >
     

      <div class="wrapper-md bg-light dk b-b">
            <!--<span class="pull-right m-t-xs">Fichier(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>-->
            <h3 class="m-n font-thin">{{SLUG }}</h3>      
          </div>
      <div class="panel-body">

        <div class="col-sm-6">
          <div class="row">
               <div class="form-group">
                <label class="col-sm-4 control-label">Type du pièce jointe</label>
                <div class="col-lg-8">
                  <select id="type" name="type" class="form-control input-md" ng-model="type"  ng-options="t.name as t.name+' | '+t.name_ar for t in types"  ng-click="clearAll();"  ng-change="getFileCandidat();">

                  <option></option>     
                </select>
                </div>
              </div>
            </div>

    
   
        </div>

       
    <br />

  <div class="col-sm-6">
    <div class="row">

       <div class="form-group">
        <label class="col-sm-4 control-label">Sélectionner un fichier (.PDF)</label>
        <div class="col-lg-6">
           <input type="file" nv-file-select="" id="file_upload"  accept=".pdf"  ng-show="!admin" uploader="uploader" ng-click="uploader.clear()"  />
            <p class="label label-warning">N.B: La taille des fichiers doit être inférieur ou égale {{sizeFile}}Mo</p>
        </div>
      </div>     
</div>

<br />


  
      <div class="row">

       <div class="form-group">
       
        <div class="col-lg-6">
           <table class="table bg-white-only b-a" style="height: 50px;">
                  <thead>
                      <tr>
                          <th class="text-dark" width="50%">Nouveau nom du fichier</th>
                          <th class="text-dark" ng-show="uploader.isHTML5">Taille</th>
                          <th class="text-dark" ng-show="uploader.isHTML5">Progression</th>
                          <th class="text-dark">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr ng-repeat="item in uploader.queue">
                       
                      
                         <td>
                         <strong class="text-primary">{{ filename }}</strong>
                         
                         <div class="alert alert-danger" ng-if="item.file.size/1024/1024 > sizeFile">Taille du fichier {{ filename }} doit être inférieur ou égale {{sizeFile}}Mo</div>
              
                         </td>


                          <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024 |number:2 }} MB</td>

                          <td ng-show="uploader.isHTML5" colspan="2">
                              <div class="progress progress-sm m-b-none m-t-xs">
                                  <div class="progress-bar bg-info" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                              </div>
                          </td>
                        
                         
                         
                          <td nowrap>
                            
                              <button type="button" ng-if="item.file.size/1024/1024 < sizeFile && invalidate==false" class="btn btn-primary btn-md"  ng-click="uploadImage(item)" >
                                  Importer
                              </button>
                              <button type="button" class="btn btn-danger btn-md" ng-click="item.remove()">
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

</div>

  
</div>

 

 
 
   
</div>
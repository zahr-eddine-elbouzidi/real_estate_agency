<div ng-controller="FileUploadCtrl"  nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter" >
  <toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>

  
  <div class="bg-light lter b-b wrapper-md"  >
    <div>
     <h4>Pièces Jointes</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1" translate="operations.HOME"><i class="fa fa-home"></i> Accueil</a></li>
      <li class="active" >Pièces Jointes</li>
    </ul>
  </div>
  
  
</div>



<div class="wrapper-md">


  <div class="panel panel-default"  ng-show="drap == true">
    <button class="btn btn-primary btn-xs" ng-click="refresh();" style="float: right;"><i class="icon icon-refresh"></i> Actualiser</button>

    <div class="wrapper-md bg-light dk b-b">
      <span class="pull-right m-t-xs">Fichier(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
      <h3 class="m-n font-thin">Importer un fichier</h3>      
    </div>

    <ul ng-if="(candidat.filename_diplome == null || candidat.filename_diplome == '') || (candidat.filename_demande == null || candidat.filename_demande == '') || (candidat.filename_cv == null || candidat.filename_cv == '') ||   ((candidat.filename_autorisation == null || candidat.filename_autorisation == '') && (candidat.etablissement != null && candidat.etablissement != '')) || (candidat.filename_cin == null || candidat.filename_cin == '')">
      <p class="label label-danger" ng-if="(candidat.filename_diplome == null || candidat.filename_diplome == '') || (candidat.filename_demande == null || candidat.filename_demande == '') || (candidat.filename_cv == null || candidat.filename_cv == '') ||   ((candidat.filename_autorisation == null || candidat.filename_autorisation == '') && (candidat.etablissement != null && candidat.etablissement != '')) || (candidat.filename_cin == null || candidat.filename_cin == '')">Les pièces manquantes</p>

      <li class="text text-danger" ng-if="candidat.filename_diplome == null || candidat.filename_diplome == ''">Diplôme</li>
      <li class="text text-danger" ng-if="candidat.filename_demande == null || candidat.filename_demande == '' ">Demande manuscrite</li>
      <li class="text text-danger" ng-if="candidat.filename_cv == null || candidat.filename_cv == ''">Curriculum Vitae</li>
      <li class="text text-danger" ng-if="(candidat.filename_autorisation == null || candidat.filename_autorisation == '') && (candidat.etablissement != null && candidat.etablissement != '') ">Autorisation pour les fonctionnaire</li>
      <li class="text text-danger" ng-if="candidat.filename_cin == null || candidat.filename_cin == ''">Carte d'Identité Nationale</li>
      <li class="text text-danger" ng-if="candidat.filename_tassrih == null || candidat.filename_tassrih == ''">Tassrih</li>
    </ul>


    <div class="panel-body">
     <div class="form-group">
      <label class="col-sm-2 control-label">Type du pièce jointe</label>
      <div class="col-lg-6">
        <select id="type" name="type" class="form-control input-sm" ng-model="type"  ng-click="clearAll();"  >

          <option >Diplôme</option>
          <option >Demande manuscrite</option>
          <option >Curriculum Vitae</option>
          <option  ng-if=" (candidat.etablissement != null && candidat.etablissement != '')">Autorisation pour les fonctionnaire</option>
          <option>Carte d'Identité Nationale</option>
          <option>Autorisation Exceptionnelle</option>
          <option>Déclaration sur l'honneur</option>
          
        </select>
      </div>
    </div>
    <br />
    <br />


    <div class="form-group">
      <label class="col-sm-4 control-label">Sélectionner un fichier (.PDF)</label>
      <div class="col-lg-6">
       <input type="file" nv-file-select="" id="file_upload"  accept=".pdf"  ng-show="!admin" uploader="uploader" ng-click="uploader.clear()"  />
     </div>
   </div>

   <br />
   <br />



   <div class="form-group">

    <label class="col-sm-2 control-label">Détails</label>
    <div class="col-lg-6">
     <table class="table bg-white-only b-a" style="height: 50px;">
      <thead>
        <tr>
          <th class="text-dark" width="50%">Fichier</th>
          <th class="text-dark" ng-show="uploader.isHTML5">Taille</th>
          <th class="text-dark" ng-show="uploader.isHTML5">Progression</th>
          <th class="text-dark">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="item in uploader.queue">
         <td>
          <strong class="label label-primary">{{ filename }}</strong>
          <!-- Image preview -->
          <!--auto height-->
          <!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
          <!--auto width-->
          <div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
          <!--fixed width and height -->
          <!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
        </td>
        <td ng-show="uploader.isHTML5" nowrap>{{ item.file.size/1024/1024|number:2 }} MB</td>
        <td ng-show="uploader.isHTML5">
          <div class="progress progress-sm m-b-none m-t-xs">
            <div class="progress-bar bg-info" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
          </div>
        </td>
        
        
        <td nowrap>
          <button type="button" class="btn btn-primary btn-xs" ng-click="uploadImage(item)" >
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



<div class="col-sm-12">
  <div class="form-group">
   
   <p class="m-t">Les pièces jointes</p>  

   <a ng-if="candidat.filename_diplome != null && candidat.filename_diplome != '' "  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_diplome}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Diplôme</a>
   <a ng-if="candidat.filename_demande != null && candidat.filename_demande != ''"  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_demande}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Demande manuscrite</a>
   <a ng-if="candidat.filename_cv != null && candidat.filename_cv != '' "  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_cv}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Curriculum Vitae</a>
   <a ng-if=" (candidat.etablissement != null && candidat.etablissement != '') " href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_autorisation}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Autorisation</a>
   <a ng-if="candidat.filename_cin != null && candidat.filename_cin != ''"  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_cin}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Carte d'Identité Nationale</a>
   <a ng-if="candidat.filename_tassrih != null && candidat.filename_tassrih != ''"  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_tassrih}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Tassrih</a>
   <a ng-if="candidat.filename_autorisation_exceptionnelle != null && candidat.filename_autorisation_exceptionnelle != ''"  href="../../../uploadsFiles/{{user | limitTo:32}}/files/{{candidat.filename_autorisation_exceptionnelle}}" target="_blank" class="label label-primary"><i class="fa fa-upload"></i> Autorisation Exceptionnelle</a>
 </div>
 
</div>

</div>

</div>

<div ng-show="drap == false" >
 <div class="wrapper-md dker b-b alert alert-danger">
  <h5 class="m-n font-thin"><i class="icon icon-info"></i>  Veuillez complèter votre profile ! <a  ui-sref="app.monespace" class="label label-primary">ICI</a></h5>

</div>

</div>


</div>
</div>
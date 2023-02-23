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

  

  <div class="bg-light lter b-b wrapper-md"  >
    <div>
     <h4>Gestion des universités</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li><a ui-sref="app.categorie"> Gestion des universités</a></li>
      <li class="active">Modifier</li>
    </ul>
  </div>


</div>

<div class="wrapper-md" ng-controller="UniversityEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading">
      Universités
    </div>
    
    <form  class="form-horizontal" ng-submit="saveChange(universityEdit.university_id)" >
      
     
     <!-- BEGIN FILE UPLOAD TRAITEMENT -->
     

     <div class="form-group">

      <label class="col-lg-2 control-label" >Sélectionner un fichier </label>
      <div class="col-lg-8 bg-primary"  >
   
  
 
          
      <span class="pull-right m-t-xs">Element(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
           
    
        <input type="file" nv-file-select=""  id="file_upload"  uploader="uploader" ng-click="uploader.clear()"  />

               <table class="table bg-white-only b-a">
                    <thead>
                        <tr>
                            <th class="text-dark" width="50%">Image</th>
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
                                <button type="button" class="btn btn-default btn-xs" ng-click="item.upload()" translate="upload.titles.UPLOAD">
                                    importer
                                </button>
                                <button type="button" class="btn btn-default btn-xs" ng-click="item.remove()">
                                    Supprimer
                                </button>


                            </td>
                        </tr>
                    </tbody>
                </table> 

 
      </div></div>
         
         <!-- BEGIN FILE UPLOAD TRAITEMENT -->
 
     
     
     
     
     <div class="form-group">

      <label class="col-lg-2 control-label">Code d'Université</label>
      <div class="col-lg-8"  >
       <input   type="text" id="universityEdit.university_code"   class="form-control" ng-model="universityEdit.university_code" placeholder="Code d'université" required="true"   />
     </div> 

   </div>



   <div class="form-group">

    <label class="col-lg-2 control-label">Nom d'Université</label>
    <div class="col-lg-8"  >
     <input   type="text" id="universityEdit.university_name"   class="form-control" ng-model="universityEdit.university_name" placeholder="Nom d'université" required="true"   />
   </div> 

 </div>



   <div class="form-group">

    <label class="col-lg-2 control-label">Nom d'Université (Arabe)</label>
    <div class="col-lg-8"  >
     <input   type="text" id="universityEdit.university_name_ar" style="float: right;"  class="form-control" ng-model="universityEdit.university_name_ar" placeholder="Nom d'université" required="true"   />
   </div> 

 </div>

 
 
 
 <input id="created_by" type="hidden"  name="created_by" />
 
 <div class="form-group">
   <label class="col-lg-2 control-label" ></label>
   <div class="col-lg-8">
     <input type="submit"  class="btn btn-info" value="Modifier" />
     <a href="#/app/university" class="btn btn-default">Annuler</a>
   </div>
 </div>
</form>




</div>

</div>

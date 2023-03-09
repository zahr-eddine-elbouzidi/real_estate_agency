  

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
   <h4>Gestion des images</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Ajouter une image</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="AddFileCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading"  >
      Images
    </div>

 
           <div class="wrapper-md" >
 
             <form  class="form-horizontal"   >
             <div class="form-group">
             
             
             <div class="col-sm-12">
              <button ng-click="saveImage()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>

              <a href="#/app/files"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>
           
               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
            
 
 
                
   <div class="form-group">

<label class="col-lg-2 control-label" >Sélectionner un fichier </label>
<div class="col-lg-8 bg-default"  >

    
<span class="pull-right m-t-xs">Element(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
     

  <input type="file" nv-file-select="" id="file_upload" uploader="uploader" ng-click="uploader.clear()" multiple />

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
                          <button type="button" class="btn btn-default btn-xs" ng-click="uploadImage(item);" translate="upload.titles.UPLOAD">
                              importer
                          </button>
                          <button type="button" class="btn btn-default btn-xs" ng-click="item.remove()">
                              Supprimer
                          </button>


                      </td>
                  </tr>
              </tbody>
          </table> 

</div>   
</div>
   <!-- BEGIN FILE UPLOAD TRAITEMENT -->
           

           

            <br />
            <br />
           
         </form>


       </div>
       
       
     </div>
     

   </div>
   
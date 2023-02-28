  

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
   <h4>Gestion des annonces</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.categorie"> Gestion des catégories</a></li>
    <li><a ui-sref="app.type"> Gestion des sous catégories</a></li>
    <li class="active" >Modifier une annonce</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="EditPubsCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading"  >
      Publications
    </div>

 
           <div class="wrapper-md" >
 
             <form  class="form-horizontal"  >
             <div class="form-group">
             
             
             <div class="col-sm-12">
             <button ng-click="savePub()" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-edit"></i>Modifier</button>

               <a href="#/app/publications"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
            </div>
          </div>
             <div class="form-group">
                <label class="col-lg-2 control-label" >Catégories</label>
                <div class="col-lg-8">
                <select id="pub.subcategory_id" name="pub.subcategory_id" ng-model="pub.subcategory_id" class="form-control"
                           ng-options="subcat.id_subcat as subcat.sub_name_fr group by subcat.name_fr for subcat in subcategories" id="type.type_id" name="type.type_id"  >
                  <option required="true">---</option>
                </select>
              </div>
            </div>
               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
               <div class="form-group">
                <label class="col-lg-2 control-label" >Titre d'article</label>
                <div class="col-lg-8">
                 <input id="pub.title" type="text" name="pub.title" class="form-control" placeholder="Titre" required="true" ng-model="pub.title" />
                 
               </div>
             </div>

             <div class="form-group">
                <label class="col-lg-2 control-label"  >Type d'article</label>
                <div class="col-lg-8">
                    <select name="pub.type"  ng-model="pub.type" required class="form-control"  >
                    <!--<option value="Article">Article</option>
                    <option value="Webinaire">Webinaire</option>
                    <option value="Annonce">Annonce</option>
                    <option value="Blog">Blog</option>
                    <option value="Slider">Slide show</option>
                    <option value="Vidéo">Vidéo</option>-->
                    <option value="Annonce">Annonce</option>
                </select>
               </div>
             </div>

             <div class="form-group">
               <label class="col-lg-2 control-label"  >Classement</label>
               <div class="col-lg-8">
                <input id="pub.level" type="text"  name="pub.level" class="form-control"  placeholder="Classement"   ng-model="pub.level"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Prix</label>
               <div class="col-lg-8">
                <input id="pub.prix" type="text"  name="pub.level" class="form-control"  placeholder="Prix"   ng-model="pub.prix"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Nombre de chambres</label>
               <div class="col-lg-8">
                <input id="pub.bedrooms" type="text"  name="pub.bedrooms" class="form-control"  placeholder="Nombre de chambres"   ng-model="pub.bedrooms"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Nombre de salles de bains</label>
               <div class="col-lg-8">
                <input id="pub.bathroom" type="text"  name="pub.bathroom" class="form-control"  placeholder="Nombre de salles de bains"   ng-model="pub.bathrooms"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Nombre de salles </label>
               <div class="col-lg-8">
                <input id="pub.halls" type="text"  name="pub.halls" class="form-control"  placeholder="Nombre de salles"   ng-model="pub.halls"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Surface en m2 </label>
               <div class="col-lg-8">
                <input id="pub.surface" type="text"  name="pub.surface" class="form-control"  placeholder="Surface en M2"   ng-model="pub.surface"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Nombre de garage </label>
               <div class="col-lg-8">
                <input id="pub.garage" type="text"  name="pub.garage" class="form-control"  placeholder="Nombre de garage"   ng-model="pub.garage"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Pays </label>
               <div class="col-lg-8">
                <input id="pub.pays" type="text"  name="pub.pays" class="form-control"  placeholder="Pays"   ng-model="pub.pays"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Ville </label>
               <div class="col-lg-8">
                <input id="pub.ville" type="text"  name="pub.ville" class="form-control"  placeholder="Ville"   ng-model="pub.ville"  />
              </div> 
            </div>
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Adresse</label>
               <div class="col-lg-8">
                <textarea name="pub.important_msg" id="pub.address" class="form-control" 
                ng-model="pub.address" cols="30" rows="3" placeholder="Adresse">
                
                </textarea>
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Message important !</label>
               <div class="col-lg-8">
                <textarea name="pub.important_msg" id="pub.important_msg" class="form-control" 
                ng-model="pub.important_msg" cols="30" rows="3" placeholder="Required message here !">
                
                </textarea>
              </div> 
            </div>
                


             <div class="form-group">
               <label class="col-lg-2 control-label"  >Visible ?</label>
               <div class="col-lg-8">
                <input type="checkbox" ng-model="pub.enabled" class="form-control checkbox-xs" />
              </div> 
            </div>
<a class="pull-right thumb-lg avatar m-l-n-md">
            <img src="../../../uploadsFiles/posts/{{pub.filename}}" class="img-circle" alt="...">
</a>
  
<div class="form-group">

<label class="col-lg-2 control-label" >Sélectionner un fichier </label>
<div class="col-lg-8 bg-default"  >

    
<span class="pull-right m-t-xs">Element(s) <b class="badge bg-info">{{ uploader.queue.length }}</b></span>
     

  <input type="file" nv-file-select="" id="file_upload" uploader="uploader" ng-click="uploader.clear()"  />

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
              <div class="form-group">
                <label class="col-lg-2 control-label"  >Contenu</label>
                <div class="col-lg-8">
                   <textarea ui-tinymce="tinymceOptions"  ng-model="pub.content"  name="tinymceModel"></textarea>
               </div>
             </div>

            <br />
            <br />
            
         </form>


       </div>
       
       
     </div>
     

   </div>
   
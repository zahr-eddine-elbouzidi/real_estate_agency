<div class="bg-light lter b-b wrapper-md hidden-print">
    <h1 class="m-n font-thin h3">Gestion des droits</h1>
</div>


<div class="wrapper-md" ng-controller="DroitsCtrl">

    <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

    <center><h2 class="text-primary font-thin">Ajouter les droits d'accès d'utilisateur : {{userEdit.nom | uppercase}} </h2>
  <h3 class="text-black font-thin">{{userEdit.usr_email}}</h3></center>
    <br />
    <div class="panel panel-default">


        <form class="form-horizontal">

            <div class="row row-sm">

                <div class="col-sm-12">

                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addCategory"
                                    ng-click="saveParam(params.addCategory , 'addCategory')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter Catégorie</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editCategory"
                                    ng-click="saveParam(params.editCategory , 'editCategory')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier Catégorie</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deleteCategory"
                                    ng-click="saveParam(params.deleteCategory , 'deleteCategory')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer Catégorie</label>

                        </div>



                    </div>



                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addSubCat"
                                    ng-click="saveParam(params.addSubCat , 'addSubCat')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter sous categorie</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editSubCat"
                                    ng-click="saveParam(params.editSubCat , 'editSubCat')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier sous categorie</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deleteSubCat"
                                    ng-click="saveParam(params.deleteSubCat,'deleteSubCat')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer sous categorie</label>

                        </div>




                    </div>



                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addPost"
                                    ng-click="saveParam(params.addPost , 'addPost')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter Article</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editPost"
                                    ng-click="saveParam(params.editPost , 'editPost')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier Article</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deletePost"
                                    ng-click="saveParam(params.deletePost , 'deletePost')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer Article</label>

                        </div>

                    </div>




                </div>
            </div>

            <hr />
            <div class="row row-sm">
                <div class="col-sm-12">

                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addBlog"
                                    ng-click="saveParam(params.addBlog , 'addBlog')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter Blog</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editBlog"
                                    ng-click="saveParam(params.editBlog , 'editBlog')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier Blog</label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deleteBlog"
                                    ng-click="saveParam(params.deleteBlog , 'deleteBlog')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer Blog</label>

                        </div>



                    </div>



                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addVideo"
                                    ng-click="saveParam(params.addVideo, 'addVideo')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter Vidéo </label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editVideo"
                                    ng-click="saveParam(params.editVideo, 'editVideo')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier Vidéo </label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deleteVideo"
                                    ng-click="saveParam(params.deleteVideo , 'deleteVideo')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer Vidéo</label>

                        </div>
                    </div>


                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.addImage"
                                    ng-click="saveParam(params.addImage, 'addImage')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Ajouter Image </label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.editImage"
                                    ng-click="saveParam(params.editImage, 'editImage')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Modifier Image </label>

                        </div>

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.deleteImage"
                                    ng-click="saveParam(params.deleteImage , 'deleteImage')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Supprimer Image</label>

                        </div>
                    </div>



                </div>
            </div>

            <hr />
            <div class="row row-sm">
                <div class="col-sm-12">

                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.ctl_all"
                                    ng-click="saveParam(params.ctl_all,'all')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Contrôle Totale</label>

                        </div>
                    </div>



                    <div class="col-sm-4">

                        <div class="form-group">
                            <label class="i-switch m-t-xs m-r">
                                <input type="checkbox" ng-model="params.exportInscription"
                                    ng-click="saveParam(params.exportInscription,'exportInscription')">
                                <i></i>
                            </label>
                            <label class="col-sm-6 control-label">Exporter les inscrits</label>

                        </div>

                    </div>






                </div>
            </div>
 
    </form>



</div>
</div>
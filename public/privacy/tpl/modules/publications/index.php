<?php

/**
 * @Author: zahr
 * @Date:   2019-07-11 01:00:20
 * @Last Modified by:   zahr
 * @Last Modified time: 2020-08-10 01:13:00
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



<div class="bg-light lter b-b wrapper-md"  >
  <div>
   <h4>Gestion des annonces</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion des annonces</li>
  </ul>
</div>


</div>



<div class="wrapper-md" ng-controller="PubsCtrl">

<blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
      
    </blockquote>

    
 <!-- <toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  <a ui-sref="app.addPubs" class="btn btn-info btn-xs" style="width: 100px;"><i class="fa fa-plus"></i> Ajouter </a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 


 <div class="row">
    <div class="col-sm-3" ng-repeat="post in posts.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
      <div class="blog-post">                   
        <div class="panel">

           <div >
            <img src="../../public/uploadsFiles/posts/{{post.filename}}" style="height:30vh;width:100%;">
          </div>
          
      
          <div class="wrapper-lg">
            <h2 class="m-t-none text-ellipsis"><a href>{{post.title}}</a></h2>
            <!--<div>
                <p class="perso-ellipsis" ng-bind-html="returnText(post.content)"></p>
            </div>-->
            <div class="line line-lg b-b b-light"></div>
            <div class="text-muted">
              <i class="fa fa-user text-muted"></i> par <a href class="m-r-sm">{{ post.created_by}}</a><br />
              <i class="fa fa-clock-o text-muted"></i> {{ post.created_at}} 
                <span class="pull-right">
                  <span ng-if="post.post_enabled == 1"><i class="glyphicon glyphicon-ok text-success"></i></span>
                  <span ng-if="post.post_enabled == 0"><i class="glyphicon glyphicon-remove text-danger"></i></span>
                </span>
                <br/>
                <span><i class="fa fa-money text-muted"></i><a href class="m-l-md">{{ post.prix}} DH</a></span>
                <br/>
                <span><i class="glyphicon glyphicon-ok text-muted"></i><a href class="m-l-md">{{ post.bedrooms}} Chambre(s)</a></span>
                <br/>
                <span><i class="glyphicon glyphicon-ok text-muted"></i><a href class="m-l-md">{{ post.bathrooms}} Salle(s) de bain(s)</a></span>
                <br/>
                <span><i class="glyphicon glyphicon-ok text-muted"></i><a href class="m-l-md">{{ post.halls}} Salle(s)</a></span>
                <br/>
                <span><i class="glyphicon glyphicon-ok text-muted"></i><a href class="m-l-md">{{ post.garage}} Garage(s)</a></span>
              </div>
            <div class="line line-lg b-b b-light"></div>
            <a class="btn btn-primary btn-xs"  ng-click="getElement(post)" title="{{'operations.EDITOP' | translate}}" > Modifier <i class="fa fa-edit"></i></a>  
            <a class="btn btn-danger btn-xs"  data-record-id="{{post.id_post}}" data-record-title="{{post.title}} de type : {{post.type}}"
      data-toggle="modal" data-target="#confirm-delete" ng-click="deletePub()" title="{{'operations.DELETEOP' | translate}}">Supprimer <i class="glyphicon glyphicon-remove"></i></a>
            <a  ng-click="getImages(post)" class="btn btn-default btn-xs pull-right">Gérer les images</a>
          </div>
          </div>
        </div>
      </div>
      
</div>
 <div class="panel panel-default">



   
  
  <div class="table-responsive">
    
   


<div class="form-group">
 <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  
 ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


</div>





</div>
</div>
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Confirmer l'opération</h4>
                            </div>
                             <div class="modal-body">
                                                   <p>
                                                   
                                                    Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="title"></i></b></p>
                                              </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                                <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                                
                            </div>
                        </div>
                    </div>
                  </div>

 


 
  </div>

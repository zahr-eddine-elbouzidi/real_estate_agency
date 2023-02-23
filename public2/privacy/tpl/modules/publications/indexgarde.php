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
   <h4>Gestion d'articles</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Gestion d'articles</li>
  </ul>
</div>


</div>



<div class="wrapper-md" ng-controller="PubsCtrl">

 <!-- <toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  <a ui-sref="app.addPubs" class="btn btn-info btn-xs" style="width: 100px;"><i class="fa fa-plus"></i> Ajouter </a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">



   
  
  <div class="table-responsive">
    
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
      
    </blockquote>

    
    <div style="float: right;">
     <!-- <label class="col-sm-2 control-label" translate="operations.VIEW" >Afficher</label>-->
     
     
     
     
     
   </div>
   
        <!--<span translate="operations.RECORDS" >records.</span>
        <br />
        <br />-->
        
        <table  class="table table-striped" >

         <tr>
           <th>N°</th>
           
           <th>
            <a    ng-click="sortType = 'title'; sortReverse = !sortReverse"  >
             <span  > Titre</span>
             <span ng-show="sortType == 'title' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'title' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
           <th>
            <a    ng-click="sortType = 'type'; sortReverse = !sortReverse"  >
             <span  > Type</span>
             <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         
         <th>
          <a  ng-click="sortType = 'contents'; sortReverse = !sortReverse">
           <span  > Contenu </span>
           <span ng-show="sortType == 'contents' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'contents' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'enabled'; sortReverse = !sortReverse">
           <span  > Visible ? </span>
           <span ng-show="sortType == 'enabled' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'enabled' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       
       <th>
        <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
         <span > Créée par</span>
         <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     <th>
       Action
     </th>

     
     
     
   </tr>
   <tr>
   </tr>
   <tr ng-repeat="post in posts.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    <td>{{$index}}</td> 

    <td> 
      <span>{{post.title}}</span>
    </td>  
    <td> 
      <span>{{post.type}}</span>
    </td>  

    

    <td> <p ng-bind-html="returnText(post.content)"></p>...</td>    
    
    <td>
      <span ng-if="post.post_enabled == 1"><i class="glyphicon glyphicon-ok text-success"></i></span>
      <span ng-if="post.post_enabled == 0"><i class="glyphicon glyphicon-remove text-danger"></i></span>
    </td>               

   <td><span class="label label-default"> {{ post.created_by}}</span></td>
   
   <td><a class="btn btn-primary btn-xs"  ng-click="getElement(post)" title="{{'operations.EDITOP' | translate}}" > Modifier <i class="fa fa-edit"></i></a>  
       <a class="btn btn-danger btn-xs"  data-record-id="{{post.id_post}}" data-record-title="{{post.title}} de type : {{post.type}}"
      data-toggle="modal" data-target="#confirm-delete" ng-click="deletePub()" title="{{'operations.DELETEOP' | translate}}">Supprimer <i class="glyphicon glyphicon-remove"></i></a></td>
      
 </tr>
</table>



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

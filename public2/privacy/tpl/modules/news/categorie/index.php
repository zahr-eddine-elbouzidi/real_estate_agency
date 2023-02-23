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

  

  <div class="bg-light lter b-b wrapper-md"   >
    <div>
     <h4 translate="categorie.titles.SUPTITLECAT">Gestion des catégories</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li class="active" translate="categorie.titles.SUPTITLECAT" >Gestion des catégories</li>
    </ul>
  </div>


</div>



<div class="wrapper-md" ng-controller="CatListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addCategory" class="btn btn-info btn-xs" style="width: 100px;">Ajouter  <i class="fa fa-plus"></i></a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">


    <div class="panel-heading" >
      Catégories
    </div>
   
   
  <div class="table-responsive">
    
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
      
    </blockquote>

    
 
        <table  class="table table-striped" >

         <tr>
          <th>
            <a ng-click="sortType = 'name_fr'; sortReverse = !sortReverse"  >
             <span  >Catégorie en (Français)</span>
             <span ng-show="sortType == 'name_fr' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'name_fr' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>

          
           <th>
            <a    ng-click="sortType = 'name_eng'; sortReverse = !sortReverse"  >
             <span  > Catégorie en (Englais)</span>
             <span ng-show="sortType == 'name_eng' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'name_eng' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
         
         <th>
          <a  ng-click="sortType = 'level_cat'; sortReverse = !sortReverse">
           <span > Classement de la catégorie </span>
           <span ng-show="sortType == 'level_cat' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'level_cat' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

       <th>
          <a  ng-click="sortType = 'enabled'; sortReverse = !sortReverse">
           <span > Active? </span>
           <span ng-show="sortType == 'enabled' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'enabled' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
       
       <th>
        <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
         <span > Créée par  </span>
         <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     <th  ng-show="role == 'SuperviseurT'">
       Action
     </th>
     
   </tr>
  
   <tr ng-repeat="cat in categories.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    <td>{{ cat.name_fr }}</td>
    <td>{{ cat.name_eng }}</td>
    <td>{{ cat.level_cat }}</td>
    <td>
      <span ng-if="cat.enabled == 1"><i class="glyphicon glyphicon-ok text-success"></i></span>
      <span ng-if="cat.enabled == 0"><i class="glyphicon glyphicon-remove text-danger"></i></span>
    </td>
    
    <td><span class="label label-primary label-xs">{{ cat.created_by }}</span></td>
    

    <td  ng-show="role == 'SuperviseurT'"> 

     <a   ng-click="getElement(cat)" title="{{'operations.EDITOP' | translate}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier</a> 

     <a   data-record-id="{{cat.id}}" data-record-title="{{cat.name_fr}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-xs"
     ng-click="deleteCategorie()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i> Supprimer</a></td> 
     
   </tr>
 </table>

 

 <div class="form-group">
   <pagination total-items="totalItems" boundary-link-numbers="false" rotate="true" boundary-links="true" force-ellipses="false"  ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>


 </div>
 
 
 
 
 
</div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel" translate="categorie.titles.SUPTITLECAT">Confirm Delete</h4>
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

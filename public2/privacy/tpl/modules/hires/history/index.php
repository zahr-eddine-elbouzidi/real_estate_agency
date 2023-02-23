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
  


  <div ng-controller="ParamsCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="bg-light lter b-b wrapper-md"  >
    <div>
     <h4 >Historiques</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li class="active">Historiques</li>
    </ul>
  </div>


</div>





<div class="wrapper-md" >
  <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> <br /><br />
  
  <span class="btn btn-info btn-xs" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select  ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">



   
   
  <div class="table-responsive">
    
    
    
   
   
    <table  class="table table-striped" >

     <tr>
       <th>
        <a    ng-click="sortType = 'created_by'; sortReverse = !sortReverse"  >
         <span  > User </span>
         <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     
     <th>
      <a  ng-click="sortType = 'type'; sortReverse = !sortReverse">
       <span  > Operation </span>
       <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
       <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
     </a>
   </th>
   <th>
    <a  ng-click="sortType = 'tab'; sortReverse = !sortReverse">
     <span  > Table </span>
     <span ng-show="sortType == 'tab' && !sortReverse" class="fa fa-caret-down"></span>
     <span ng-show="sortType == 'tab' && sortReverse" class="fa fa-caret-up"></span>
   </a>
 </th>

 <th>
  <a  ng-click="sortType = 'ip'; sortReverse = !sortReverse">
   <span  > IP </span>
   <span ng-show="sortType == 'ip' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'ip' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>

<th>
  <a  ng-click="sortType = 'old'; sortReverse = !sortReverse">
   <span  > Old value </span>
   <span ng-show="sortType == 'old' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'old' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>

<th>
  <a  ng-click="sortType = 'new'; sortReverse = !sortReverse">
   <span  > New value </span>
   <span ng-show="sortType == 'new' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'new' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>

<th>
  <a  ng-click="sortType = 'navigator'; sortReverse = !sortReverse" >
   <span > Navigator  </span>
   <span ng-show="sortType == 'navigator' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'navigator' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>


<th>
  <a  ng-click="sortType = 'server_name'; sortReverse = !sortReverse" >
   <span > Server Name  </span>
   <span ng-show="sortType == 'server_name' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'server_name' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
<th>
  <a  ng-click="sortType = 'server_port'; sortReverse = !sortReverse" >
   <span > Server Port  </span>
   <span ng-show="sortType == 'server_port' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'server_port' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>

<th>
  <a  ng-click="sortType = 'server_address'; sortReverse = !sortReverse" >
   <span > Server Address  </span>
   <span ng-show="sortType == 'server_address' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'server_address' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>
<th>
  <a  ng-click="sortType = 'created_at'; sortReverse = !sortReverse" >
   <span > Date  </span>
   <span ng-show="sortType == 'created_at' && !sortReverse" class="fa fa-caret-down"></span>
   <span ng-show="sortType == 'created_at' && sortReverse" class="fa fa-caret-up"></span>
 </a>
</th>




</tr>
<tr>
</tr>
<tr ng-repeat="his in history.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
  <td>{{ his.created_by }}</td>
  <td>{{ his.type }}</td>
  <td>{{ his.tab }}</td>
  <td>{{ his.ip }}</td>
  <td>{{ his.old }}</td>
  <td>{{ his.new }}</td>
  <td>{{ his.navigator }}</td>
  <td>{{ his.server_name }}</td>
  <td>{{ his.server_port }}</td>
  <td>{{ his.server_address }}</td>
  <td>{{ his.created_at }}</td>
  
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
</div>
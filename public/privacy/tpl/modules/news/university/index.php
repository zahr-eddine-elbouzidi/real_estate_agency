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
      <li class="active">Gestion des universités</li>
    </ul>
  </div>


</div>



<div class="wrapper-md" ng-controller="UniversityListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <a ui-sref="app.addUniversity" class="btn btn-info btn-xs" style="width: 100px;"> Ajouter </a>
  <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
  <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
 
 <div class="panel panel-default">



   
   
  <div class="table-responsive">
    
    <blockquote>
      <input type="text" ng-model="search"  class="form-control input-sm bg-white rounded padder" placeholder="Rechercher..."> 
      
    </blockquote>

    
    <div style="float: right;">
     <!-- <label class="col-sm-2 control-label" translate="operations.VIEW" >Afficher</label>-->
     
     
     
     
     
   </div>
   
        <!--<span translate="operations.RECORDS" >records.</span>
        <br />
        <br />-->
        
        <table  class="table table-striped" >

         <tr>
           <th>
            <a    ng-click="sortType = 'university_code'; sortReverse = !sortReverse"  >
             <span  > Code d'Université </span>
             <span ng-show="sortType == 'university_code' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'university_code' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>


         <th>
          <a    ng-click="sortType = 'university_name'; sortReverse = !sortReverse"  >
           <span  > Nom d'Université </span>
           <span ng-show="sortType == 'university_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'university_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>

          <th>
          <a    ng-click="sortType = 'university_name_ar'; sortReverse = !sortReverse"  >
           <span  > Nom d'Université (Arabe)</span>
           <span ng-show="sortType == 'university_name_ar' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'university_name_ar' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>



       
       
       <th>
        <a  ng-click="sortType = 'created_by'; sortReverse = !sortReverse" >
         <span > Crée par  </span>
         <span ng-show="sortType == 'created_by' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'created_by' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
     <th ng-if="role == 'SuperviseurT'">
       Action
     </th>
     
     
     
   </tr>
   <tr>
   </tr>
   <tr ng-repeat="university in universities.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
    <td>{{ university.university_code }}</td>
    <td>{{ university.university_name }}</td>
    <td>{{ university.university_name_ar }}</td>
    
    
    <td><span class="label label-primary label-xs">{{ university.created_by }}</span></td>
    

    <td  ng-if="role == 'SuperviseurT'"> 

      <a   ng-click="getElement(university)" title="{{'operations.EDITOP' | translate}}"><i class="fa fa-edit"></i></a> 

      <a   data-record-id="{{university.university_id}}" data-record-title="{{university.university_name}}"
      data-toggle="modal" data-target="#confirm-delete" ng-click="deleteUniversity()" title="{{'operations.DELETEOP' | translate}}">
      <i class="glyphicon glyphicon-remove"></i></a></td>
      
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
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
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

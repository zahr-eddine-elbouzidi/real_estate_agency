<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3" translate="header.params.PROFILEADD">Users</h1>
  <blockquote>
   <input ng-model="search" placeholder="{{'operations.SEARCH' | translate}}" class="form-control"    />
 </blockquote>
 <a ui-sref="app.addUser" ng-if="role == 'Superviseur' || role == 'SuperviseurT' || role == 'AdminT'" class="btn btn-primary"  >Ajouter un utilisateur</a>
 
</div>


<div class="wrapper-md" ng-controller="UsersCtrl" > 

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


 <div class="panel panel-default">
   
   <div class="table-responsive">

    <span translate="operations.VIEW">Afficher</span> <select ng-model="viewby" ng-change="setItemsPerPage(viewby)">
      
      <option>25</option>
      <option>50</option>
      <option>100</option>
      <option>Tous</option>
      
    </select> <span translate="operations.RECORDS">records.</span>
    <br />
    <br />
    <table  class="table table-striped" >
     <tr>
       
      <th>
        <a  ng-click="sortType = 'usr_email'; sortReverse = !sortReverse" >
          <span > Email</span>
          <span ng-show="sortType == 'usr_email' && !sortReverse" class="fa fa-caret-down"></span>
          <span ng-show="sortType == 'usr_email' && sortReverse" class="fa fa-caret-up"></span>
        </a>
      </th>
      <th>
        <a    ng-click="sortType = 'nom'; sortReverse = !sortReverse"  >
         <span> Nom complèt</span>
         <span ng-show="sortType == 'nom' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'nom' && sortReverse" class="fa fa-caret-up"></span>
       </a>
     </th>
  
   <th>
     Etat
   </th>
   <th ng-if="role == 'SuperviseurT' || role == 'AdminT'">
     Activer/Désactiver
   </th>
 
   <th ng-if="role == 'SuperviseurT'">
     Droits
   </th>
   <th ng-if="role == 'SuperviseurT' || role == 'AdminT'">
     Supprimer
   </th>
    <th ng-if="role == 'SuperviseurT' || role == 'AdminT'">
     Modifier
   </th>
   
   
   
 </tr>
 
 <tr ng-repeat="user in users.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
  <td>{{ user.usr_email }}</td>
  <td>{{ user.first_name }}</td>
  <td>
    <span class="label label-danger label-xs" ng-hide="{{user.usr_active}}" >Inactif </span>  
    <span class="label label-success label-xs" ng-show="{{user.usr_active}}" >Actif </span>
  </td>
  
  <td ng-if="role == 'SuperviseurT' || role == 'AdminT'"> 
   <button ng-hide="{{user.usr_active}}" class="btn btn-primary btn-xs" ng-click="activerCompte({{user.usr_id}})">  Activer</button>
   <button ng-show="{{user.usr_active}}" class="btn btn-primary btn-xs" ng-click="desactiverCompte({{user.usr_id}})">Désactiver</button>

  </td>
  

 <td>
   <a ng-if="user.type == 'Admin' && role == 'SuperviseurT'" ng-click="getDroits({{user.usr_id}})" class="btn btn-default btn-xs" title="{{'operations.DELETEOP' | translate}}">Gesion des droits</a>
 </td> 

 <td ng-if="role == 'SuperviseurT' || role == 'AdminT'">
   <a  ng-click="deleteUser({{user.usr_id}})" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>
 </td> 

 <td ng-if="role == 'SuperviseurT' || role == 'AdminT'">
   <a  ng-click="getElement(user)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-edit"></i> Modifier</a>
 </td> 

 
 
 
</tr>
</table>




<pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" class="pagination-sm" items-per-page="itemsPerPage"></pagination>



<!-- Trigger the modal with a button -->

<!-- Modal pour l'edition des information-->

<!--fin modal d'edition des information -->
</div>





</div>
</div>
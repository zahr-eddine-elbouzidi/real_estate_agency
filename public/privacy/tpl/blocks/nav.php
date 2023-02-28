<!-- list -->
<ul class="nav"  >
  <toaster-container toaster-options="{'position-class': 'toast-top-right', 'close-button':true}"></toaster-container>

  <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
    <span translate="aside.nav.HEADER">Navigation</span>
  </li> 
  
  
  <li ng-if="admin && adminName=='admin' && (role=='Admin' || role=='AdminT' || role=='Superviseur' || role=='SuperviseurT' || role=='Ministère')" ng-class="{active:$state.includes('app.page')}">
    <a ui-sref="app.go" class="auto" >
      <span class="pull-right text-muted">
        
      </span>
      <i class="glyphicon glyphicon-th icon text-info"></i>
      <span class="text-ellipsis" >E-Administratif</span>
    </a>
  </li>

  <li dir="rtl" ng-show="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT' || role=='Ministère')">
    <a ui-sref="app.dashboard-v1" class="auto">      
      <span class="pull-right text-muted">
        <i class="fa fa-fw fa-angle-right text"></i>
        <i class="fa fa-fw fa-angle-down text-active"></i>
      </span>
      <i class="glyphicon glyphicon-stats icon text-primary-dker"></i> 
      <span class="font-bold" translate="aside.nav.DASHBOARD">Dashboard</span>
    </a>
    
  </li>
 

  <li class="line dk"></li>
  <li>
    <a href class="auto" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')">      
      <span class="pull-right text-muted">
        <i class="fa fa-fw fa-angle-right text"></i>
        <i class="fa fa-fw fa-angle-down text-active"></i>
      </span>
      <b class="badge bg-info pull-right">3</b>
      <i class="glyphicon glyphicon-th"></i>
      <span>Paramètres</span>
    </a>
    <ul class="nav nav-sub dk">
     
      <li ui-sref-active="active" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" ng-class="{active:$state.includes('app.page')}">
        <a ui-sref="app.contact">
          <i class="glyphicon glyphicon-phone-alt icon text-light-dker"></i>
          <span>Contact</span>
        </a>
      </li>

    
      
    
        
    </ul>
  </li>
 

 

   <li class="line dk"></li>


   <li>
    <a href class="auto" ng-if="admin && adminName=='admin'  && (role=='SuperviseurT' || role=='Ministère') ">      
      <span class="pull-right text-muted">
        <i class="fa fa-fw fa-angle-right text"></i>
        <i class="fa fa-fw fa-angle-down text-active"></i>
      </span>
      <b class="badge bg-danger pull-right">4</b>
      <i class="glyphicon glyphicon-th"></i>
      <span>Site web</span>
    </a>
    <ul class="nav nav-sub dk">
     
     
  
      <li ui-sref-active="active" ng-if="admin && adminName=='admin'  && (role=='SuperviseurT' || role=='Ministère') " ng-class="{active:$state.includes('app.page')}">
        <a ui-sref="app.categorie">
           <i class="glyphicon glyphicon-th-large icon text-danger-dker"></i>
          <span>G.Catégories</span>
        </a>
      </li>  

      <li ui-sref-active="active"  ng-if="admin && adminName=='admin'  && (role=='SuperviseurT' || role=='Ministère') " ng-class="{active:$state.includes('app.page')}">
        <a ui-sref="app.type">
           <i class="glyphicon glyphicon-th icon text-success-dker"></i>
          <span>G.Menu</span>
        </a>
      </li> 
 

      <li ui-sref-active="active"  ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" ng-class="{active:$state.includes('app.page')}">
        <a ui-sref="app.pubs">
          <i class="fa fa-share-alt icon text-primary-dker"></i>
          <span>Annonces</span>
        </a>
      </li>

    </ul>
  </li>
  
 

  <li class="line dk hidden-folded"></li>
  <!--<li>
    <a ng-if="(role == '' || role == null)" href="{{BASE_URL}}/uploadsFiles/user_guide_candidat.pdf" target="_blank">
      <i class="icon-question icon"></i>
      <span>Guide d'utilisation</span>
    </a>
  
   <a ng-if="(role != '' && role != null)" href="{{BASE_URL}}/uploadsFiles/user_guide_admin.pdf" target="_blank">
      <i class="icon-question icon"></i>
      <span>Guide d'utilisation</span>
    </a>
  </li>-->

</ul>
<!-- / list -->
 
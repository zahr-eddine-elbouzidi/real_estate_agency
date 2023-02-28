<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Administration</h1>
 <!-- <center>
   <a href="{{BASE_URL}}/uploadsFiles/user_guide_admin.pdf" target="_blank" class="btn btn-default btn-md">Documentation  <hr />Guide d'utilisateur دليل المستخدم</a>
</button></center>-->
</div>
<div class="wrapper-md">
 
<div class="row" >
    

 <div ui-sref="app.dashboard-v1" style="cursor: pointer;" class="col-md-3"   >
       <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.dashboard-v1" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/statistics.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">Statistiques</div>
                  <small class="text-muted">Statistiques par mois, Répartitions...</small>
                </div>

                <!--<div class="clear">
                   <a ui-sref="app.dashboard-v1" class="btn btn-warning pull-right"><i class="icon icon-link"></i> Voir ></a>
                </div>-->
              </div>
            </div>
    
      </div>
    
    </div>
 

    
    <div ui-sref="app.categorie" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin'  && (role=='SuperviseurT' || role=='Ministère') " >
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.categorie" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/types.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">G. Catégories</div>
                  <small class="text-muted">La gestion des catégories, L'ajout ...</small>
                </div>

               <!-- <div class="clear">
                   <a ui-sref="app.conge" class="btn btn-primary pull-right"><i class="icon icon-link"></i> Consulter ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>

     <div ui-sref="app.type" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin'  && (role=='SuperviseurT' || role=='Ministère') ">
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.type" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/menu.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">G. Menu</div>
                  <small class="text-muted">La gestion de menus, L'ajout...</small>
                </div>

               <!-- <div class="clear">
                   <a ui-sref="app.conge" class="btn btn-primary pull-right"><i class="icon icon-link"></i> Consulter ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>
    <div ui-sref="app.pubs" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" >
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.pubs" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/share.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">Gestion des annonces</div>
                  <small class="text-muted">Annonces, Blogs, Vidéos, Images...</small>
                </div>

                <!--<div class="clear">
                   <a ui-sref="app.addConge" class="btn btn-info pull-right"><i class="icon icon-link"></i> Déposer ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>

    <div ui-sref="app.candidats" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" >
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.pubs" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/grades.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">Gestion des inscrits</div>
                  <small class="text-muted">Gestion des inscrits</small>
                </div>

                <!--<div class="clear">
                   <a ui-sref="app.addConge" class="btn btn-info pull-right"><i class="icon icon-link"></i> Déposer ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>
    
    <div ui-sref="app.users" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" >
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.users" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/users.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">G. Utilisateurs</div>
                  <small class="text-muted">Les droits, Privilèges...</small>
                </div>

               <!-- <div class="clear">
                   <a ui-sref="app.conge" class="btn btn-primary pull-right"><i class="icon icon-link"></i> Consulter ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>


    <div ui-sref="app.history" style="cursor: pointer;" class="col-md-3" ng-if="admin && adminName=='admin' && (role=='Superviseur' || role=='SuperviseurT')" >
      <a ui-sref="app.go" >
      <div class="panel panel-white">

        <div class="panel-heading">
              <div class="clearfix">
                <a ui-sref="app.history" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/logs.png" alt="...">
                </a>
                <div class="clear">
                  <div class="h4 m-t m-b-xs">Historiques</div>
                  <small class="text-muted">Logs des actions ...</small>
                </div>

               <!-- <div class="clear">
                   <a ui-sref="app.conge" class="btn btn-primary pull-right"><i class="icon icon-link"></i> Consulter ></a>
                </div>-->
              </div>
            </div>
    
      </div>
      </a>
    </div>

    </div>
 
 

 
 
</div>

<!-- navbar header -->
      <div class="navbar-header {{app.settings.navbarHeaderColor}}">
        <button class="pull-right visible-xs dk" ui-toggle-class="show" data-target=".navbar-collapse">
          <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle-class="off-screen" data-target=".app-aside" ui-scroll="app">
          <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a ui-sref="app.profil" class="navbar-brand text-lt">
          <!--<i class="fa fa-btc"></i>-->
          <img src="img/logo.png" alt="." class="hide">
          <span class="hidden-folded m-l-xs">{{app.name}}</span>
        </a>
        <!-- / brand -->
      </div>
      <!-- / navbar header -->

      <!-- navbar collapse -->
      <div class="collapse pos-rlt navbar-collapse box-shadow {{app.settings.navbarCollapseColor}}">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
          <a href class="btn no-shadow navbar-btn" ng-click="app.settings.asideFolded = !app.settings.asideFolded">
            <i class="fa {{app.settings.asideFolded ? 'fa-indent' : 'fa-dedent'}} fa-fw"></i>
          </a>
          <a href class="btn no-shadow navbar-btn" ui-toggle-class="show" target="#aside-user">
            <i class="icon-user fa-fw"></i>
          </a>
       <!--    <a ng-show="admin && adminName=='admin'" ui-sref="app.backup" class="btn no-shadow navbar-btn">
           <i class="icon-cloud-download"></i>
          </a>

           <a ng-show="admin && adminName=='admin'" ui-sref="app.modules" class="btn no-shadow navbar-btn">
           <i class="icon icon-settings"></i>
         </a>

         <a ng-show="admin && adminName=='admin' && role=='SuperviseurT'" ui-sref="app.params" class="btn no-shadow navbar-btn">
           <i class="icon icon-settings"></i>
         </a>-->
         <a ng-show="admin && adminName=='admin' && role=='Superviseur' " ui-sref="app.history" class="btn no-shadow navbar-btn">
           <i class="fa fa-history"></i>  
         </a>

         <a ng-show="admin && adminName=='admin' && (role=='SuperviseurT' || role=='AdminT')" ui-sref="app.users" class="btn no-shadow navbar-btn">
           <i class="fa fa-users"></i>
         </a>


       </div>
       <!-- / buttons -->

        <!-- link and dropdown -->
        <ul class="nav navbar-nav hidden-sm">
          <li class="dropdown pos-stc" dropdown>
            <a href class="dropdown-toggle" dropdown-toggle>
              <span  class="m-l-md m-t-md m-b-md font-bold">Menu</span> 
              <span class="caret"></span>
            </a>
            <div class="dropdown-menu wrapper w-full bg-white">
              <div class="row">
                <div class="col-sm-8" >
                  
                  <!--<div class="row">
                    <div class="col-xs-6">
                      <ul class="list-unstyled l-h-2x">
                        <li>
                         
                        </li>
                        <li>
                          <a href="./autorisation_passer_concours.docx" download="./autorisation_passer_concours.docx"  target="_blank"> <i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Autorisation de participation au concours</a>
                        </li>
                        <li>
                          <a ui-sref="app.post" translate="apps.news.POST"><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Articles/Fichiers</a>
                        </li>
                  
                      </ul>
                    </div>
                 
                  </div>-->
                </div>

  

            
              </div>
            </div>
          </li>
          
          


        </ul>
        <!-- / link and dropdown -->

        <!-- search form 
        <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo" target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
          <div class="form-group">
            <div class="input-group">
            <input type="text" ng-model="selected" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control input-sm bg-light no-border rounded padder" placeholder="Search projects..."> 
              <span class="input-group-btn">
                <button type="submit" class="btn btn-sm bg-light rounded"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </form>-->
        <!-- / search form -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
          
          <li class="hidden-xs">
            <a ui-fullscreen></a>
          </li>
        <!--  <li class="dropdown" dropdown>
            <a href class="dropdown-toggle" dropdown-toggle>
              <i class="icon-bell fa-fw"></i>
              <span class="visible-xs-inline">Notifications</span>
              <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
            </a>
      
            <div class="dropdown-menu w-xl animated fadeInUp">
              <div class="panel bg-white">
                <div class="panel-heading b-light bg-light">
                  <strong>You have <span>2</span> notifications</strong>
                </div>
                <div class="list-group">
                  <a href class="media list-group-item">
                    <span class="pull-left thumb-sm">
                      <img src="img/a0.jpg" alt="..." class="img-circle">
                    </span>
                    <span class="media-body block m-b-none">
                      Use awesome animate.css<br>
                      <small class="text-muted">10 minutes ago</small>
                    </span>
                  </a>
                  <a href class="media list-group-item">
                    <span class="media-body block m-b-none">
                      1.0 initial released<br>
                      <small class="text-muted">1 hour ago</small>
                    </span>
                  </a>
                </div>
                <div class="panel-footer text-sm">
                  <a href class="pull-right"><i class="fa fa-cog"></i></a>
                  <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                </div>
              </div>
            </div>
         
          </li>-->


          <li class="dropdown" dropdown >
            <a href class="dropdown-toggle clear" title="{{users.usr_email}}" dropdown-toggle>
            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                <img  src="img/itisde_logo_head_red.png" alt="...">
                <i class="on md b-white bottom"></i>
              </span>
              <span class="hidden-sm hidden-md">{{email}} </span> <b class="caret"></b>

            </a>
            <!-- dropdown -->
            <ul class="dropdown-menu animated fadeInRight w">
              <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                <div>
                  <p translate="header.params.PROFILENAME">Mon profile</p>
                </div>
                
              </li>
              
              <li>
                <a ui-sref="access.forgotpwd" >Initialiser le mot de passe</a>
              </li>
              <!--<li>
                <a ui-sref="app.droits" translate="header.params.PROFILEADD">Utilisateurs</a>
              </li>-->
              
              <li class="divider"></li>
              <li ng-controller="SigninFormController">
               
                <a  ng-click="logout()" translate="header.params.PROFILEDEC">Se déconnecter</a>
              </li>
            </ul>
            <!-- / dropdown -->
          </li>
        </ul>
        <!-- / navbar right -->

      </div>
      <!-- / navbar collapse -->
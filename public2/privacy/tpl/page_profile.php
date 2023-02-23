<div class="hbox hbox-auto-xs hbox-auto-sm" ng-controller="ProfileController">
  <div class="col">
    <toaster-container toaster-options="{'position-class': 'toast-top-right', 'close-button':true}"></toaster-container>

    <div style="background:url(img/c4.jpg) center center; background-size:cover">
      <div class="wrapper-lg bg-white-opacity">
        <div class="row m-t">
          <div class="col-sm-7">
            <!--<a href class="thumb-lg pull-left m-r">
             <img src="js/controllers/{{ users.usr_name }}/uploads/{{ users.usr_picture }}" class="img-circle" />
           </a>-->
           <div class="clear m-b">
            <div class="m-b m-t-sm">
              <span class="h3 text-black">{{ users.usr_nom }}.{{ users.usr_prenom }}</span>
            </div>
            
          </div>
        </div>
        <div class="col-sm-5">
          <div class="pull-right pull-none-xs text-center">
            <a href class="m-b-md inline m">
              <span class="h3 block font-bold"></span>
              <small></small>
            </a>
            <a href class="m-b-md inline m">
              <span class="h3 block font-bold"></span>
              <small></small>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wrapper bg-white b-b">
    <ul class="nav nav-pills nav-sm">
      <li class="active"><a href>Profile</a></li>
      
    </ul>
  </div>
  <div class="padder">      
    <div class="streamline b-l b-info m-l-lg m-b padder-v">
      <div>
        <a class="pull-left thumb-sm avatar m-l-n-md">
        </a>
        <div class="m-l-lg">
          <div class="m-b-xs">
            <a href class="h4" translate="header.params.PROFILEEDIT">Editer votre profile.</a>
            <span class="text-muted m-l-sm pull-right">
            </span>
          </div>
          <div class="m-b">
            <div>Informations</div>
            <div class="m-t-sm">
             
            </div>
          </div>
        </div>
      </div>
      <!-- .comment-reply -->
      <div class="m-l-lg">
        <a class="pull-left thumb-sm avatar">
          
        </a>          
        <div class="m-l-xxl panel b-a">
          <div class="panel-heading pos-rlt">
            <span class="arrow left pull-up"></span>
            <span class="text-muted m-l-sm pull-right">
              
            </span>
            




            <form name="form" class="form-validation">

             <div class="m-b-md" ng-show="authError">
              <alert type="danger" close="closeAlert(0)"> {{authError}}</alert>
            </div>
            
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input placeholder="Nom d'utilisateur" class="form-control no-border" ng-model="users.usr_name" ng-value="{{users.usr_name}}"  required>
              </div>
              <div class="list-group-item">
                <input placeholder="Nom" class="form-control no-border" ng-model="users.usr_nom" ng-value="{{users.usr_nom}}"  >
              </div>
              <div class="list-group-item">
                <input placeholder="Prénom" class="form-control no-border" ng-model="users.usr_prenom" ng-value="{{users.usr_prenom}}"   >
              </div>
              <div class="list-group-item">
                <input type="email" placeholder="Email" class="form-control no-border" ng-model="users.usr_email" ng-value="{{users.usr_email}}"  required>
              </div>
              
            </div>
            
            
          </div>
          
          <button type="submit" class="btn btn-sm btn-primary" ng-click="editeProfile(users)" ng-disabled='form.$invalid' translate="operations.EDITOP">Envoyer</button>
          <div class="line line-dashed"></div>
          
        </form>





      </div>
    </div>
  </div>
  
</div>
</div>
</div>
<div class="col w-lg bg-light lter b-l bg-auto">
  <div class="wrapper">
    
    
   
  </div>
</div>
</div>
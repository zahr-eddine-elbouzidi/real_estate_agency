    <div class="container w-xxl w-auto-xs" ng-controller="ConfirmationFormController" ng-init="app.settings.container = false;">

      <a class="thumb-md pull-left m-r">
        <img src="img/enssup.png" class="img-circle" alt="Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines">
      </a>
      <div class="m-l-lg">
        <div class="m-b-xs">
          <small class="text-muted m-t">Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines </small>

          
        </div>

      </div>
      
      <div class="m-b-md" ng-show="errorMessage">
        <alert type="danger" close="closeAlert(0)"> {{errorMessage}}</alert>
      </div>
      <div class="m-b-md" ng-show="successMessage">
        <alert type="success" close="closeAlert(0)"> {{successMessage}}</alert>
      </div>
      
      <a href class="navbar-brand block m-t">{{app.name}} | Initialisation</a>
      <div class="m-b-lg">
        <div class="wrapper text-center">
          <strong>Initialiser le mot de passe de votre compte.</strong>
        </div>
        <form name="form" class="form-validation"> 

         <div class="m-b-md" ng-show="authError">
          <alert type="danger" close="closeAlert(0)"> {{authError}}</alert>
        </div>
        
        <div class="list-group list-group-sm">
         
          <div class="list-group-item">
           <input type="password" placeholder="Mot de passe" ng-style="passwordStrength" ng-change="analyze(user.password)" class="form-control no-border" name="password" ng-model="user.password" required > 
         </div>
         <div class="list-group-item">
           <input type="password" placeholder="Confirmer le mot de passe" class="form-control no-border" name="confirm_password" required ng-model="user.confirm_password" ui-validate=" '$value==user.password' " ui-validate-watch=" 'user.password' ">
           <span ng-show='form.confirm_password.$error.validator'>Confirmation est incorrecte.</span>
         </div>
         
       </div>
       
       <button type="submit" class="btn btn-md btn-primary btn-block" ng-click="confirmationResetPW()" ng-disabled='form.$invalid'>Envoyer</button>
       <div class="line line-dashed"></div>
       <a ui-sref="access.signin" class="btn btn-md btn-default btn-block">Connexion</a>
     </form>
   </div>
   <div class="text-center" ng-include="'tpl/blocks/page_footer.php'"></div>
 </div>     


 
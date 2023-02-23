<div class="container w-xxl w-auto-xs" ng-init="app.settings.container = false;" ng-controller="ForgotPasswordController">
  <a class="thumb-md pull-left m-r">
    <img src="img/enssup.png" class="img-circle" alt="Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines">
  </a>
  <div class="m-l-lg">
    <div class="m-b-xs">
      <small class="text-muted m-t">Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines </small>

      
    </div>

  </div>
  <a href class="navbar-brand block m-t">{{app.name}} | Initialisation</a>
  <div class="m-b-md" ng-show="errorMessage">
    <alert type="danger" close="closeAlert(0)"> {{errorMessage}}</alert>
  </div>
  <div class="m-b-md" ng-show="successMessage">
    <alert type="success" close="closeAlert(0)"> {{successMessage}}</alert>
  </div>
  
  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong>Entrer l'adresse mail</strong>
    </div>
    <form name="reset" class="form-validation" >
      <div class="list-group list-group-sm">
        <div class="list-group-item">
          <input type="email" placeholder="email@domain" ng-model="usr_email" class="form-control no-border" required>
        </div>
      </div>
      <button type="submit" ng-disabled="reset.$invalid" class="btn btn-md btn-primary btn-block"  ng-init="isCollapsed = !isCollapsed"  ng-click="resetPassword()">Envoyer</button>
    </form>
    <div  class="m-t">
      <div class="alert alert-success">
        <p>Pour initialiser le mot de passe il faut ajouter l'adresse mail de votre compte.
          <a ui-sref="access.signin" class="btn btn-sm btn-success">Connexion</a></p>
        </div>
      </div>
    </div>
    <div class="text-center" ng-include="'tpl/blocks/page_footer.php'"></div>
  </div>
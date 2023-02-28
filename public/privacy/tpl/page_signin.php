<div class="container w-xxl w-auto-xs" ng-controller="SigninFormController" ng-init="app.settings.container = false;">


  <center >
    <img src="img/123.png" width="350" class="img-circle" alt="Agence Immobilière">
</center>
 
  
  <a href class="navbar-brand block m-t">{{app.name}} | Authentification</a>
   <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong  class="label bg-info" ></strong>
    </div>
    
    <form name="form" class="form-validation">
      <div class="m-b-md" ng-show="authError">
        <alert type="danger" close="closeAlert(0)"> {{authError}}</alert>
      </div>
      <div class="list-group list-group-sm">

        <!-- <div class="list-group-item">
               <select ng-model="user.type"  class="form-control no-border">
                 <option>Candidat-Normale</option>
                 <option>Candidat-Professeur</option>
               </select>
             </div>-->


             <div class="list-group-item">
              <input type="text" placeholder="Email" class="form-control no-border" ng-model="user.email" required>
            </div>
            <div class="list-group-item">
             <input type="password" placeholder="Mot de passe"  class="form-control no-border" ng-model="user.password"   required>
           </div>
           
           <label class="checkbox i-checks m-l-md m-b-md">   
             <input type="checkbox" ng-model="user.rememberme"><i></i>
             Garder ma session active.  
           </label>
           
         </div>
         <button type="submit" class="btn btn-md btn-info btn-block" ng-click="login()" ng-disabled='form.$invalid'> Connexion <i class="icon icon-login"></i></button>
         

         <div class="text-center m-t m-b"><b><a class="label-label-default" ui-sref="access.forgotpwd" class="text-primary"><u>Mot de passe oublié ?</u></a></b></div>
         <div class="line line-dashed"></div>
         
        </form>
 
     </div>
     <div class="text-center" ng-include="'tpl/blocks/page_footer.php'"></div>
   </div>

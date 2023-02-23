  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion d'utilisateurs</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.formule" >Gestion d'utilisateurs</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="EditUsersCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

    <div class="panel-heading" >
       Utilisateurs
    </div>
      
    <div class="row">
      <div class="col-sm-6">
        <form  class="form-horizontal" ng-submit="saveUser()" >
             

          <div class="form-group">
              <label class="col-lg-2 control-label" >Compte </label>
              <div class="col-lg-6">
               
               <select ng-model="userEdit.type"  class="form-control"  ng-change="changeTypeComm(userEdit.type);">
                      <option ng-if="role == 'SuperviseurT'" value="Superviseur">Superviseur Fonctionnelle</option>
                      <option ng-if="role == 'SuperviseurT'" value="SuperviseurT">Superviseur Technique</option>
                      <option ng-if="role == 'SuperviseurT'" value="Admin">Administrateur Fonctionnelle</option>
                      <option ng-if="role == 'SuperviseurT'" value="AdminT">Administrateur Technique</option>
               </select>  
            </div>
          </div>

           


 
 
          <div class="form-group">
            <label class="col-lg-2 control-label">Nom complet</label>
            <div class="col-lg-6">
             
              <input placeholder="Nom et Prénom" class="form-control" ng-model="userEdit.nom" >

            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-2 control-label">Email</label>
            <div class="col-lg-6">
             
                <input type="email" placeholder="Email" class="form-control" ng-model="userEdit.tel" required>

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label">Mot de passe</label>
            <div class="col-lg-6">
             
                <input type="password" placeholder="Mot de passe" ng-style="passwordStrength" class="form-control" name="password" ng-model="userEdit.password" ng-change="analyze(userEdit.password)" required >  

            </div>
          </div>


          <div class="form-group">
            <label class="col-lg-2 control-label">Confirmer le mot de passe</label>
            <div class="col-lg-6">
             
               <input type="password" placeholder="Confirmer le mot de passe" class="form-control" name="confirm_password" required ng-model="userEdit.confirm_password" ui-validate=" '$value==userEdit.password' " ui-validate-watch=" 'userEdit.password' ">
                   <span ng-show='form.confirm_password.$error.validator' style="color : red;">Confirmation de mot de passe est incorrecte.</span>

            </div>
          </div>


          <div class="form-group">
           <label class="col-lg-2 control-label"   ></label>
           <div class="col-sm-4">
            <div class="form-actions">      
              <input type="submit"  value="Modifier" class="btn btn-primary" />
              <a ui-sref="app.users" class="btn btn-default">Annuler</a>
            </div>
          </div>  
        </div>
        
      </form>

      </div>  
 
  
               
    </div>         
      </div>
    </div> 
    



  </div>
 


</div>


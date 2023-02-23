  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 >Gestion d'utilisateurs</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.formule" >Gestion des utilisateurs</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="UsersCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

 

          <div class="panel-heading" >
            Utilisateurs
          </div>
        
           
           
           
           <br />
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


          <!--<div class="form-group" ng-if="userEdit.type == 'Admin'">
            <label class="col-lg-2 control-label">Rôle</label>
            <div class="col-lg-6">
             
               <select ng-model="userEdit.id_role" class="form-control small" ng-options="role.id as role.name for role in roles" id="userEdit.id_role" name="userEdit.id_role" >
                        <option>---</option>
               </select>   

            </div>
          </div>-->



 

 

          <div class="form-group">
           <label class="col-lg-2 control-label"   ></label>
           <div class="col-sm-4">
            <div class="form-actions">      
              <input type="submit"  value="Ajouter" class="btn btn-primary" />
              <a ui-sref="app.droits" class="btn btn-default">Annuler</a>
            </div>
          </div>  
        </div>
        
      </form>

      <!-- BEGIN PROGRAM -->


      <!-- END PROGRAM -->

      
    </div>

  </div>


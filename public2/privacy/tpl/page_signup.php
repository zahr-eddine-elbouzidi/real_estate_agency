<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script
src="https://www.google.com/recaptcha/api.js?onload=vcRecaptchaApiLoaded&render=explicit"
async defer></script>


<?php
include dirname(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'autoload'.DIRECTORY_SEPARATOR.'google.php';
if(!isset($keys)) $keys = null;
?>

<div class="container w-xxl w-auto-xs" ng-controller="SignupFormController" ng-init="app.settings.container = false;">
  <a class="thumb-md pull-left m-r">
    <img src="img/enssup.png" class="img-circle" alt="Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines">
  </a>
  <div class="m-l-lg">
    <div class="m-b-xs">
      <small class="text-muted m-t">Ministère de l'Education Nationale, de la Formation professionnelle, de l'Enseignement Supérieur et de la Recherche Scientifique - Direction des ressources humaines </small>

      
    </div>

  </div>
  <a href class="navbar-brand block m-t">{{app.name}} | Inscription</a>
  <toaster-container toaster-options="{'position-class': 'toast-top-right', 'close-button':true}"></toaster-container>

  <div class="m-b-lg">
    <div class="wrapper text-center">
      <strong></strong>
    </div>
    <form name="form" class="form-validation">

     <div class="m-b-md" ng-show="authError">
      <alert type="danger" close="closeAlert(0)"> {{authError}}</alert>
    </div>
    
    <div class="list-group list-group-sm">
     
    <!--<div class="list-group-item">
       <select ng-model="user.type"  class="form-control no-border"  >
         <option  ng-if="isAdministratif == true" value="Candidat-Normale" >Administratifs et Techniques</option>
         <option  ng-if="isProf == true" value="Candidat-PESAF">PA Fondamentale</option>
         <option  ng-if="isProfM == true" value="Candidat-PESAM">PA Médecine</option>
       </select>
     </div>-->
     <input type="hidden" ng-model="user.captchaResponse">
     <div class="list-group-item">
      <input type="email" placeholder="Adresse Mail" class="form-control no-border" ng-model="user.tel" required>
    </div>
    <div class="list-group-item">
     <input type="password" placeholder="Mot de passe" ng-style="passwordStrength" class="form-control no-border"  name="password" ng-model="user.password"  ng-change="analyze(user.password)" required > 
   </div>
   <div class="list-group-item">
     <input type="password" placeholder="Confirmer le mot de passe" class="form-control no-border" name="confirm_password" required ng-model="user.confirm_password" ui-validate=" '$value==user.password' " ui-validate-watch=" 'user.password' ">
     <span ng-show='form.confirm_password.$error.validator' style="color:red;">Confirmation est incorrecte.</span>
   </div>
   
 </div>
 
 

 <div class="list-group-item">
  <div tabindex="3" theme="clean" vc-recaptcha key="'<?php echo $keys['SITE_KEY']; ?>'"></div>
</div>
<br />
<div class="checkbox m-b-md m-t-none">
  <label class="i-checks">

    <input type="checkbox" ng-model="agree" required><i></i> <a data-toggle="modal" data-target="#confirm-delete" style="text-decoration:underline;font-weight:bold;">Lire et accepter les conditions d'utilisations</a>
  </label>
</div>
<button type="submit" name="submit" class="btn btn-md btn-primary btn-block" ng-click="signup()" ng-disabled='form.$invalid'>S'inscrire <i class="icon icon-login"></i></button>
<div class="line line-dashed"></div>
<p class="text-center"><small>Vous avez déjà un compte?</small> <b><a ui-sref="access.signin" class="text-info">Connexion</a></b></p>

</form>
</div>
<div class="text-center" ng-include="'tpl/blocks/page_footer.php'"></div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="font-size:14px;">
  <div class="modal-dialog modal-dialog-centered">
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">E-Concours | Mentions légales</h4>
      </div>
      <div class="modal-body">
       <h5 class="text-primary" style="font-weight: bold;">E-Concours</h5>
       <h5>La plateforme de Gestion des Concours (E-Concours) permet aux candidats de postuler aux concours de recrutement.La candidature est effectuée exclusivement en ligne.</h5>


       <h5 class="text-primary" style="font-weight: bold;">Utilisation</h5>
       <p >L'utilisation de cet espace implique que vous acceptiez l'application des conditions générales suivantes et de respecter 
       l'ensemble de la réglementation applicable à ce mode de communication.</p>
       <p>Les informations qui vous sont demandées sont nécessaires au traitement de votre demande.</p>

       <p>Les informations à caractère nominatif que vous pourriez nous donner sont protégées conformément à la loi n° 09-08 
       relative à la protection des personnes physiques à l'égard du traitement des données à caractère personnel.</p>

       <p>Tout utilisateur qui fournit des informations, consent l'intégralité des droits transférables relatifs 
       à ces informations et autorise le ministère à en faire usage.</p>


       <ul style="font-weight: bold;">
         <span  class="text-danger">N.B:</span>
         <li class="text-danger">Les documents illisibles, mal orientés ou bien scannés a l'aide d'un appareil photo ou Smartphone ne seront pas acceptés.</li>
         <li class="text-danger">Toute fausse information entraînera l'annulation de votre candidature.</li>
         <li class="text-danger">Vous n'avez pas le droit de rectifier de votre candidature après la date limite de dépôt de dossier.</li>
         <li class="text-danger">Toute candidature avec des documents non légalisés sera automatiquement rejetée.</li>
         <li class="text-danger"> Le candidat doit charger ou scanner :
          <ul>
            <li class="text-danger">Documents en format PDF.</li>
            <li class="text-danger">Déclaration sur l'honneur</li>
            <li class="text-danger">Autorisation de participation au concours (Fonctionnaires)</li>
            <li class="text-danger">Arrêté d'équivalence des diplômes étrangers (publié au bulletin officiel)</li>
          </ul>
        </li>

        
      </ul>


      <a href="./declaration_sur_honneur.docx" download="./declaration_sur_honneur.docx"  target="_blank" class="label label-primary" ><i class="fa fa-download"></i>Télécharger la déclaration sur l'honneur التصريح بالشرف  </a><br /><br />
      <a href="./autorisation_passer_concours.docx" download="./autorisation_passer_concours.docx"  target="_blank" class="label label-success" ><i class="fa fa-download"></i>
      Télécharger Autorisation de participation au concours (Fonctionnaires)      الترخيص باجتياز المباراة </a><br /><br />

      <a href="./autorisation_passer_concours.docx" download="./autorisation_passer_concours_limite_age.docx"   
      target="_blank" class="label label-default" ><i class="fa fa-download"></i>Télécharger Autorisation de participation au concours  الترخيص باجتياز المباراة استثناءا من شرط السن بالنسبة للمترشحين غير الموظفين     </a>
      
      <br />
      <br />
      <!--<p>Après l'inscription, Merci de consulter le guide d'utilisation.</p>-->
      
      <p class="text-primary text-b"><i class="fa fa-info"></i> La version papier du dossier de candidature vous sera demandée lors de l'entretien oral.</p>
      <!--<p class="text-success text-b"><i class="fa fa-info"></i> Connectez-vous à votre Espace candidat en cliquant sur <a ui-sref="app.mes-candidatures" target="_blank">Mes Candidatures</a></p>-->
      
      
      
    </div>
    <div class="modal-footer">

      <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">Fermer</button>
      
    </div>
  </div>
</div>
</div>
</div>

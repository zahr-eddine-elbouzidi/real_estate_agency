<div class="modal-over bg-white" ng-controller="ConfirmationFormController">
  <div class="bg-light lter b-b wrapper-md">
   <div class="m-b-md" ng-show="errorMessage">
    <alert type="danger" close="closeAlert(0)"> {{errorMessage}}</alert>
  </div>
  <div class="m-b-md" ng-show="successMessage">
    <alert type="success" close="closeAlert(0)"> {{successMessage}}</alert>
  </div>
 
    
 
    


  <div class="modal-center animated fadeInUp text-center" style="width:300px;margin:-200px 0 0 -150px;">
  
        
       
            <p class="h5">Entrer le code de confirmation pour terminer la création de votre compte.</p>  
            <p class="h5">المرجو إدخال رمز التحقق الدي ثم التوصل به عبر بريدك الالكتروني (<b>{{user_email_signup}}</b>)</p>  
            <hr />
            <div class="input-group">
              <div class="input-group-addon input-rounded">ENS.RH-</div>
              <input type="text" class="form-control text-sm btn-rounded" name="confirmation_code" ng-model="confirmation_code" placeholder="XXXXX">
              <br />
              <span class="input-group-btn">
                 <button type="submit" class="btn btn-success btn-rounded no-border" ng-click="confirmationPW()" ng-disabled='form.$invalid'>Confirmer</button>
              </span>
            </div> 
            <hr />
             <div class="row">
                <p class="text-danger">N.B: Votre code vous sera communiqué sur votre boite email ({{user_email_signup}}).</p>
              </div>

             Si vous n'avez pas reçu votre code par votre adresse email ({{user_email_signup}}) cliquez ici <br /><a style="margin-left: -10px;text-decoration: underline;" class="text-primary" ng-click="generateNewCode()" ><b>Nouveau code de confirmation</b></a>
          </div>



</div>
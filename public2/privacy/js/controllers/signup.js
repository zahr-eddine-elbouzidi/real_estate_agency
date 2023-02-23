'use strict';

// signup controller
app.controller('SignupFormController', ['$scope','$rootScope','vcRecaptchaService', '$http', '$state','toaster', 'API_URL',
  function($scope,$rootScope,vcRecaptchaService, $http, $state,toaster,API_URL) {

    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

    $scope.passwordStrength = {

    };

    $scope.analyze = function(value) {
      if(strongRegex.test(value)) {
       $scope.passwordStrength["border-bottom"] = "1px solid green";
     } else if(mediumRegex.test(value)) {
      $scope.passwordStrength["border-bottom"] = "1px solid orange";

    } else {
     $scope.passwordStrength["border-bottom"] = "1px solid red";

   }
 };


     /*$scope.changeTypes = function(){

      $rootScope.loader = true;

       $http.get(API_URL+'/param/getList')
           .success(function(response, status, headers, config) {

               $scope.params = response.data;
               $scope.params.isProf = response.data[0].isProf;

               if($scope.params.isProf == 1){
                 $scope.params.isProf = true;
                 $rootScope.isProf = true;
               }else{
                 $scope.params.isProf = false;
                 $rootScope.isProf = false;
               }

                $rootScope.loader = false;
               // console.log($rootScope.isProf);


         });
       }; */


       
       $scope.user = {};

       $scope.authError = null;


       $rootScope.user_id= null;

       $rootScope.loader = false;




       $scope.signup = function() {
        $rootScope.loader = true;
        $scope.authError = null;
        
      	// Try to create
        $http.post(API_URL+'/registration/signup', 
        {
          usr_email: $scope.user.tel, 
          usr_password: $scope.user.password,
          usr_type: $scope.user.type,
          nom : null,
          prenom : null,
          captchaResponse  : vcRecaptchaService.getResponse()

        }).then(function(response) {

          $rootScope.loader = false;
           // console.log(response.data.messageSMS);
           if(response.data.messageSMS==""){

              toaster.pop('success','Information', '<br>'+"Votre message de vérification à bien été envoyé."+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
             
           }else{

            toaster.pop('error','Information', '<br>'+"Erreur d'envoi du code de confirmation, Veuillez réssayer plus tard!"+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");

            
          }
             // console.log("userrrrr id : "+  $rootScope.user_id);
             if(response.data.usr_email_confirmed===0){
              $state.go('confirmation', { id : response.data.usr_identity, token : response.data.token, email : response.data.usr_email_params });
            }
            if(response.data.message_user_exists != null){
              $scope.authError=response.data.message_user_exists;
            }else{
              $scope.authError = null;
            }
          }, function(x) {
            $scope.authError = 'Server Error'+x;
            $rootScope.loader = false;

          });

   };




   
 }]);

// signup controller
app.controller('ConfirmationFormController', ['$scope','$stateParams','$rootScope','$timeout', '$http', '$state','API_URL', 
  function($scope,$stateParams,$rootScope,$timeout, $http, $state,API_URL) {



    $rootScope.loader = false;
    $scope.user_email_signup = $stateParams.email;


    $scope.confirmation=function(){

      $scope.successMessage = null;
      $scope.errorMessage = null;
      $rootScope.loader = true;

      $http.post(API_URL+'/registration/activateaccount' , 

      { 
        user_id : $stateParams.id , 
        confirmation_code : $scope.confirmation_code 
      } 


      ).then(function(response){

        if(response.data.usr_active==1 && response.data.usr_email_confirmed==1){

          $scope.successMessage=response.data.message;
          $timeout(function() {
            $rootScope.loader = false;
            $state.go('access.signin');
          }, 1500);
        }else{
         $scope.errorMessage=response.data.Error_message;
         $rootScope.loader = false;
       }

       

     },function(x) {

      $rootScope.loader = false;
    });

    };

    $scope.generateNewCode=function(){

      $scope.successMessage = null;
      $scope.errorMessage = null;
      $rootScope.loader = true;

      $http.post(API_URL+"/registration/generatenewcode" , 

      { 
        usr_id :  $stateParams.id 
      } 


      ).then(function(response){

        if(response.data.isOK === true){
          $scope.successMessage=response.data.messageSuccess;

          $timeout(function() {
           $rootScope.loader = false;
           $state.go('access.confirmation',{ id : response.data.usr_identity, token : response.data.token });
         }, 4000);
          
        }else{
         $scope.errorMessage=response.data.messageError;
          $rootScope.loader = false;
       }

       

     },function(x) {
       $rootScope.loader = false;

     });

    };

    




    $scope.confirmationPW=function(){

      $scope.successMessage = null;
      $scope.errorMessage = null;
      $rootScope.loader = true;

      $http.post(API_URL+"/registration/activatePWaccount" , 

      { 
        user_id : $stateParams.id , 
        confirmation_code : $scope.confirmation_code 
      } 


      ).then(function(response){
         $rootScope.loader = false;

 
        if(response.data.drap==true){
          $scope.successMessage="";
          $timeout(function() {
           $state.go('access.initializepw',{ id : $stateParams.id });
         }, 1500); 
        }else{
            // $scope.errorMessage="Un erreur est survenue lors de l'initialisation de mot de passe de votre compte ! Veuillez réessayer plus tard.";
          $scope.errorMessage='Votre code de confirmation est incorrect!';
          $rootScope.loader = false;
        }

          

        },function(x) {
           $rootScope.loader = false;

        });

    };


var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

    $scope.passwordStrength = {

    };

    $scope.analyze = function(value) {
      if(strongRegex.test(value)) {
       $scope.passwordStrength["border"] = "1px solid green";
     } else if(mediumRegex.test(value)) {
      $scope.passwordStrength["border"] = "1px solid orange";

    } else {
     $scope.passwordStrength["border"] = "1px solid red";

   }
 };




    $scope.user = {};
    $scope.confirmationResetPW=function(){

      $scope.successMessage = null;
      $scope.errorMessage = null;
      $rootScope.loader = true;

      $http.post(API_URL+"/registration/resetpassword" , 

      { 
        usr_id : $stateParams.id , 
        usr_password : $scope.user.password 
      } 


      ).then(function(response){

        $rootScope.loader = false;


        if(response.data.isOK===true){
          $scope.successMessage=response.data.messageSuccess;

          $timeout(function() {
           
           $state.go('access.signin');
         }, 5000); 
        }else{
         $scope.errorMessage=response.data.messageError;
       }

       

     },function(x) {

        $rootScope.loader = false;

     });

    };






  }]);





// signup controller
app.controller('ForgotPasswordController', ['$scope','$stateParams','$rootScope','$timeout', '$http', '$state', 'API_URL',
  function($scope,$stateParams,$rootScope,$timeout, $http, $state,API_URL) {



   $rootScope.loader = false;
   


   $scope.resetPassword=function(){

    $scope.successMessage = null;
    $scope.errorMessage = null;
    $rootScope.loader = true;

    $http.post(API_URL+"/registration/forgotpassword" , 

    { 
      usr_email :  $scope.usr_email
    } 


    ).then(function(response){
      $rootScope.loader = false;
      if(response.data.isOK === true){
        $scope.successMessage=response.data.messageSuccess;

        $timeout(function() {
         
         $state.go('access.confirmInitializepw',{ id : response.data.usr_identity, token : response.data.token, email : $scope.usr_email });
       }, 4000);
        
      }else{
       $scope.errorMessage=response.data.messageError;
     }

     

   },function(x) {

    $rootScope.loader = false;

   });

  };

}]);








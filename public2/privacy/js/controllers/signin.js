'use strict';

/* Controllers */
  // signin controller
  app.controller('SigninFormController', ['$scope','$rootScope','$timeout','$cookies', '$http', '$state','$window' ,'API_URL',
    function($scope,$rootScope, $timeout,$cookies, $http, $state,$window,API_URL) {


          


      var initApp = function(){
       $http.get(API_URL+'/registration/init').
       success(function(data, status, headers, config) {
       });
     };
     
     initApp();
     
     $rootScope.loader = false;


     $scope.user = {};
 /*   var loadAnalytics = function(){


       


       //load modules data
       $http.get(API_URL+'/modulesapp/availablemodules/'+$rootScope.user).
       success(function(data, status, headers, config) {

            angular.forEach(data.modulesavailable , function(value , key){


                if(value.module_code == "001"){

                  $rootScope.isNewsModule = true;
                
                }else if(value.module_code == "002"){

                  $rootScope.isScolaireModule = true;

                }else{
                   $rootScope.isNewsModule = false;
                   $rootScope.isScolaireModule = false;
                }
            });          

         });
         
         






     



       };*/

      //load users

      /**
       * [loadUsers description]
       * @return {[type]} [description]*/
       
       var loadUsers = function(){


    
     $http.get(API_URL+'/registration/getUserRole/'+$rootScope.user)
            .success(function(response, status, headers, config) {
            $scope.users = response;
             $rootScope.paramsDroit = {};
            $rootScope.roles = response.roles;

      angular.forEach($rootScope.roles, function(value, key) {
             

        if(value.code == 'addCategory'){
           $rootScope.paramsDroit.addCategory = true;
        }else if(value.code == 'editCategory'){
            $rootScope.paramsDroit.editCategory = true;
        }else if(value.code == 'deleteCategory'){
            $rootScope.paramsDroit.deleteCategory = true;
        }else if(value.code == 'addGrade'){
            $rootScope.paramsDroit.addGrade = true;
        }else if(value.code == 'editGrade'){
            $rootScope.paramsDroit.editGrade = true;
        }else if(value.code == 'deleteGrade'){
            $rootScope.paramsDroit.deleteGrade = true;
        }else if(value.code == 'addHire'){
            $rootScope.paramsDroit.addHire = true;
        }else if(value.code == 'editHire'){
            $rootScope.paramsDroit.editHire = true;
        }else if(value.code == 'deleteHire'){
            $rootScope.paramsDroit.deleteHire = true;
        }else if(value.code == 'addSession'){
            $rootScope.paramsDroit.addSession = true;
        }else if(value.code == 'editSession'){
            $rootScope.paramsDroit.editSession = true;
        }else if(value.code == 'deleteSession'){
            $rootScope.paramsDroit.deleteSession = true;
        }else if(value.code == 'gestionNoteExOne'){
            $rootScope.paramsDroit.notes_ex1 = true;
        }else if(value.code == 'gestionNoteExTwo'){
            $rootScope.paramsDroit.notes_ex2 = true;
        }else if(value.code == 'exportListPostuled'){
            $rootScope.paramsDroit.exportPostuled = true;
        }else if(value.code == 'exportListEcrit'){
            $rootScope.paramsDroit.exportEcrit = true;
        }else if(value.code == 'exportListOral'){
            $rootScope.paramsDroit.exportOral = true;
        }else if(value.code == 'exportListFinale'){
            $rootScope.paramsDroit.exportFinale = true;
        }else if(value.code == 'gestionCommission'){
            $rootScope.paramsDroit.gestionComm = true;
        }else if(value.code == 'all'){
            $rootScope.paramsDroit.ctl_all = true;
        }else if(value.code == 'pvs'){
            $rootScope.paramsDroit.pvs = true;
        }else if(value.code == 'gestionRes'){
            $rootScope.paramsDroit.gestionR = true;
        }else if(value.code == 'exportJury'){
            $rootScope.paramsDroit.exportJur = true;
        }else if(value.code == 'traitAdmin'){
            $rootScope.paramsDroit.traitAdmin = true;
        }
 
 
 
         
            
     });
  //console.log( $rootScope.paramsDroit); 
      });

         $http.get(API_URL+'/registration/getUser/'+$rootScope.user)
         .success(function(response, status, headers, config) {
          $scope.users = response;

           // console.info($scope.users);

           $rootScope.user_fullname = $scope.users.user_fullname;
           $rootScope.email = $scope.users.usr_email;
           $rootScope.role = $scope.users.type;
           
               //check that is admin
               if(response.usr_isSuper == 1){
                 $rootScope.user_admin = 'true';
                 $rootScope.admin = true;
                 $rootScope.adminName = 'admin';
               }else if(response.usr_isSuper == null){
                $state.go('access.signin');
              }else{
                $rootScope.user_admin = 'false';
                $rootScope.admin = false;
                $rootScope.adminName = 'standard';
                

              }

              

            });
         

       };


       $scope.refresh = function(){
        loadUsers();
      }

      


    //  si usser is logged redirest to the dashboard
    var redirect =  function(){


      if($rootScope.user != ""){


        $timeout(function() {
          $state.go('app.dashboard-v1');
        }, 500);
      }

    }

     //redirect();


     $scope.authError = null;
     var Isrememberme = false;





     


    // console.log($window.document.cookie["PHPCOOKIE"]);

    /**
     * [login description]
     * @return {[type]} [description]
     */
     $scope.login = function() {

      $rootScope.loader = true;

      if($scope.user.rememberme === undefined){
        Isrememberme=false;
      }else{
        Isrememberme=$scope.user.rememberme;
      }

    //  console.log(Isrememberme);
    $scope.authError = null;
      // Try to login
      // 
      var config = {
        headers : {
          'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      }
      $http.post(API_URL+"/index/log", 
      { 
        usr_email: $scope.user.email, 
        usr_password: $scope.user.password , 
        rememberme: Isrememberme
      },config
      ).then(function(response) {

        
        if(response.data.usr_active==0 ){
         $scope.authError="Votre compte est désactivé, Veuillez activer votre compte !";
         $rootScope.loader = false;

         if((response.data.usr_answer == null || response.data.usr_answer == '' ) && response.data.usr_active==0){
          $timeout(function() {
            $state.go('confirmation', 
              { id : response.data.user_id, 
                token : response.data.user_token });
          }, 3000);
        }
      }else if(response.data.isConnected){

                       $window.sessionStorage.setItem("keySessionPHP", response.data.user_token+response.data.staticSalt);
                       $rootScope.user=sessionStorage.getItem("keySessionPHP");
                       $rootScope.user_fullname = response.data.user_fullname;
                       $rootScope.email = response.data.usr_email;
                       $rootScope.role = response.data.type;

                        // vérifier la visibilité de la l'ongle Gestion des utilisateurs
                        
                      $scope.refresh();

                      if(Isrememberme){
                        var now = new Date();
                        var time = now.getTime();
                        var expireTime = time + 1000*36000*14;
                        now.setTime(expireTime);
                        $window.document.cookie = "PHPCOOKIE="+(response.data.user_token+response.data.staticSalt)+"; expires="+now.toGMTString()+"; path=/";
                      }   
                      $rootScope.loader = false;
                      if(response.data.user_admin == 1){
                         $rootScope.user_admin = 'true';
                         $rootScope.admin = true;
                         $rootScope.adminName = 'admin';
                      }else if(response.data.user_admin == null){
                        $state.go('access.signin');
                      }else{
                        $rootScope.user_admin = 'false';
                        $rootScope.admin = false;
                        $rootScope.adminName = 'standard';
                      }
                      if((response.data.user_admin==1 && response.data.type=="Superviseur") || 
                        (response.data.user_admin==1 && response.data.type=="SuperviseurT")|| 
                        (response.data.user_admin==1 && response.data.type=="Ministère")){
                        //$state.go('app.dashboard-v1');
                        $state.go('app.go');
                      }else if(response.data.user_admin==0 && response.data.type=="Standard"){
                        $state.go('app.mes-concours');
                      }else if(response.data.user_admin==1 && response.data.type=="Commission"){
                        $state.go('app.commission');
                      }else if(response.data.user_admin==1 && response.data.type=="Admin"){
                        $state.go('app.hires');
                      }else if(response.data.user_admin==1 && response.data.type=="AdminT"){
                        $state.go('app.users');
                      }else{
                        $state.go('app.profil');
                      } 
                      

                    }else{
                      $scope.authError = response.data.messages;
                      $rootScope.usr_full_name = null;
                      $rootScope.email = null;
                      $rootScope.role = null;
                      $rootScope.loader = false;
                    }
                  }, function(x) {
                   $scope.authError = "Error 500";
                   $rootScope.loader = false;
                 });
    };


    /**
     * [logout description]
     * @return {[type]} [description]
     */
     $scope.logout=function(){

      $rootScope.loader = true;

      $http.get(API_URL+'/index/logout')
      .success(function(data, status, headers, config) {
        
       $rootScope.user="";
       sessionStorage.removeItem("keySessionPHP");
       $rootScope.user_admin = 'false';
                //console.log("signin = "+$rootScope.user_admin);
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + 1000*36000*18;
                now.setTime(expireTime);
                $window.document.cookie = "PHPCOOKIE=; expires="+now.toGMTString()+"; path=/";
                $rootScope.usr_full_name = null;
                $rootScope.email = null;
                $rootScope.loader = false;
                $rootScope.adminName = undefined;
                $rootScope.role = null;
                $scope.refresh();

                $state.go('access.signin');
                
              });

    };



    






  }]);
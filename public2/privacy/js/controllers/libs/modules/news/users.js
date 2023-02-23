 


app.controller('UsersCtrl',['$scope','$state', '$rootScope', '$http', '$location','API_URL','toaster','$timeout','ServiceTranslate'
  , function($scope, $state ,$rootScope, $http, $location,API_URL,toaster,$timeout,ServiceTranslate) {
   


var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

$scope.passwordStrength = {

};

$scope.analyze = function(value) {

    if(strongRegex.test(value)) {
       $scope.passwordStrength["border"] = "1px solid green";
     }else if(mediumRegex.test(value)) {
      $scope.passwordStrength["border"] = "1px solid orange";
    }else{
     $scope.passwordStrength["border"] = "1px solid red";
   }
};


$scope.getElement=function(user){

     
     $state.go('app.editUser', { id : user.usr_id });

};


    $scope.array = ServiceTranslate.personalTranslateLang();

    
     
     
  
 

  $http.get(API_URL+'/param/getRoles').success(function(response, status, headers, config) {

        $scope.roles =response.data;
        
    
});
      


  
  
        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
                $http.get(API_URL+"/index/getAll/"+$rootScope.user).success(function(data, status, headers, config) {

                        $scope.users = data.data;
                        angular.copy($scope.users, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = 25;
	                      $scope.totalItems = $scope.users.length;
	                      $scope.currentPage = 1;
	                      $scope.itemsPerPage = $scope.viewby;
	                      $scope.maxSize = $scope.users.length; //Number of pager buttons to show

	                      $scope.setPage = function (pageNo) {
                         $scope.currentPage = pageNo;
                       };

                       $scope.pageChanged = function() {
	                       // console.log('Page changed to: ' + $scope.currentPage);
                      };

                       $scope.setItemsPerPage = function(num) {
                       if(num === 'Tous'){
                        $scope.itemsPerPage = $scope.users.length;
                      }else{
                        if($scope.viewby > $scope.users.length ){

                          $scope.itemsPerPage =  $scope.users.length;
                          
                        }else{
                         $scope.itemsPerPage = num;
                       }
                       
                     }
                   }
                      });
       }



     

         /**
        * End load function
        * 
        *
        **/


        load(); //Call load function


        $scope.getDroits = function(user_id){

           $state.go('app.droits', { id : user_id });


        };

        
        $scope.deleteUser = function(id) {
          
          var confirmMessage = null;


          if($rootScope.user_admin == 'true'){
           if($rootScope.selectLang == 'French'){
             confirmMessage= confirm("Voulez-vous vraiment supprimer cette utilisateur ?");
           }else{
            confirmMessage= confirm("Are you sure ?");
          }


          
          if (confirmMessage)
          {
            $rootScope.loader = true;
            $http({
              method:'DELETE',
              url:API_URL + '/index/delete/'+id
            }).success(function(data, status, headers, config) {
             
              $rootScope.loader = false;
              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/droits');
              
            }).error(function(data, status, headers, config) {

            });
          }

        }
        
      };
 


      $scope.saveUser = function() {
        $rootScope.loader = true;
        $scope.authError = null;

                // Try to create
                if($rootScope.user_admin === 'true'){
                  $http.post(API_URL+'/registration/save', 
                  {
                    
                    'usr_email': $scope.userEdit.tel, 
                    'usr_password': $scope.userEdit.password,
                    'first_name' : $scope.userEdit.nom,
                    'last_name' : $scope.userEdit.nom,
                    'created_by' : $rootScope.user,
                    'usr_type': $scope.userEdit.type,
                    'created_by_new' : $scope.userEdit.tel,
                  }
                  ).then(function(response) {
                   
                    $rootScope.loader = false;
                    
                    if(response.data.message_user_exists != null){
                      $scope.authError=response.data.message_user_exists;
                      
                      toaster.pop('warning','Information', '<br>'+response.data.message_user_exists+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                      
                    }else{
                      
                      $scope.authError = "Utilisateur est ajouté avec succès.";
                      
                      toaster.pop('success','Information', '<br>'+"L'utilisateur est ajouté avec succès."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                    }

                    load();
                    $location.path('/app/users');

                    




                  }, function(x) {
                   $scope.authError = 'Server Error'+x;

                 }); 


                }


              };



              $scope.activerCompte = function(id){

               if($rootScope.user_admin === 'true'){
                $rootScope.loader = true;

                $http.post(API_URL + '/registration/activercompte', 
                {
                  user_id: id ,
                  value : 1
                  
                }
                ).then(function(response) {

                  toaster.pop('success','Information', '<br>'+"Le compte d'utilisateur est actif."+'<br><br>' + 
                    '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                    0, 'trustedHtml', null, "note-toaster-container");
                  load();
                  $location.path('/app/users');
                  $rootScope.loader = false;

                }, function(x) {
                 $scope.authError = 'Server Error'+x;
                 toaster.pop('error','Information', '<br>'+"Server Error "+x+'<br><br>' + 
                  '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                  0, 'trustedHtml', null, "note-toaster-container");

               });

              }
              



            };

            $scope.desactiverCompte = function(id){

             if($rootScope.user_admin === 'true'){
              $rootScope.loader = true;
              $http.post(API_URL + '/registration/activercompte', 
              {
                user_id: id,
                value : 0 
                
              }
              ).then(function(response) {
               
               toaster.pop('success','Information', '<br>'+"Le compte d'utilisateur est inactif."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");
               load();
               $location.path('/app/users');
               $rootScope.loader = false;

             }, function(x) {
               $scope.authError = 'Server Error'+x;
               toaster.pop('error','Information', '<br>'+"Server Error "+x+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

             });
            }


          };
          

          
        }]);


 
app.controller('EditUsersCtrl',['$scope','$state','$stateParams', '$rootScope', '$http', '$location','API_URL','toaster','$timeout','ServiceTranslate'
  , function($scope, $state ,$stateParams,$rootScope, $http, $location,API_URL,toaster,$timeout,ServiceTranslate) {
   


var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

$scope.passwordStrength = {

};

$scope.analyze = function(value) {

    if(strongRegex.test(value)) {
       $scope.passwordStrength["border"] = "1px solid green";
     }else if(mediumRegex.test(value)) {
      $scope.passwordStrength["border"] = "1px solid orange";
    }else{
     $scope.passwordStrength["border"] = "1px solid red";
   }
};


 

 
     
  
  
 


  $http.get(API_URL+'/param/getRoles').success(function(response, status, headers, config) {

        $scope.roles =response.data;
        
    
});
      

$http.get(API_URL+"/index/getUser/"+$stateParams.id).success(function(response, status, headers, config) {

        $scope.userEdit =response.data;
        $scope.userEdit.nom =response.data.first_name;
        $scope.userEdit.tel = response.data.usr_email;
        $scope.userEdit.type = response.data.type;
        console.log($scope.user);
        
    
});


  
 

  
        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
                $http.get(API_URL+"/index/getAll/"+$rootScope.user).success(function(data, status, headers, config) {

                        $scope.users = data.data;
                        angular.copy($scope.users, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.users.length;
                        $scope.totalItems = $scope.users.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = $scope.users.length; //Number of pager buttons to show

                        $scope.setPage = function (pageNo) {
                         $scope.currentPage = pageNo;
                       };

                       $scope.pageChanged = function() {
                         // console.log('Page changed to: ' + $scope.currentPage);
                      };

                      $scope.setItemsPerPage = function(num) {
                       $scope.itemsPerPage = num;
                          $scope.currentPage = 1; //reset to first paghe
                        }
                      });
       }



 
       

         /**
        * End load function
        * 
        *
        **/


        load(); //Call load function

 


      $scope.saveUser = function() {
        $rootScope.loader = true;
        $scope.authError = null;

                // Try to create
                if($rootScope.user_admin === 'true'){
                  $http.post(API_URL+'/registration/editUser', 
                  {
                    
                    'usr_id': $stateParams.id, 
                    'usr_email': $scope.userEdit.tel, 
                    'usr_password': $scope.userEdit.password,
                    'first_name' : $scope.userEdit.nom,
                    'last_name' : $scope.userEdit.nom,
                    'created_by' : $rootScope.user,
                    'usr_type': $scope.userEdit.type,
                    'created_by_new' : $scope.userEdit.tel
                  }
                  ).then(function(response) {
                   
                    $rootScope.loader = false;
                    
                    if(response.data.message_user_exists != null){
                      $scope.authError=response.data.message_user_exists;
                      
                      toaster.pop('warning','Information', '<br>'+response.data.message_user_exists+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                      
                    }else{
                      
                      $scope.authError = "Utilisateur est ajouté avec succès.";
                      
                      toaster.pop('success','Information', '<br>'+"L'utilisateur est ajouté avec succès."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                    }

                    load();
                    $location.path('/app/users');

                    




                  }, function(x) {
                   $scope.authError = 'Server Error'+x;

                 }); 


                }


              };



     
 
          

          
        }]);



  


app.controller('DroitsCtrl',['$scope','$state','$stateParams', '$rootScope', '$http', '$location','API_URL','toaster','$timeout','ServiceTranslate'
  , function($scope, $state ,$stateParams , $rootScope, $http, $location,API_URL,toaster,$timeout,ServiceTranslate) {
    
     
     
     $scope.userEdit = {};
    $http.get(API_URL+'/registration/getUserById/'+$stateParams.id).success(function(data, status, headers, config) {

      $scope.userEdit = data;
      $scope.userEdit.nom = data.usr_nom;
      $scope.userEdit.prenom = data.usr_prenom;

 

    });

    $scope.params = {};

     $http.get(API_URL+'/registration/getDroitsUser/'+$stateParams.id).success(function(data, status, headers, config) {

      $scope.droits = data;
 
      angular.forEach($scope.droits.roles, function(value, key) {

        if(value.rule_code == 'addCategory'){
           $scope.params.addCategory = true;
        }else if(value.rule_code == 'editCategory'){
            $scope.params.editCategory = true;
        }else if(value.rule_code == 'deleteCategory'){
            $scope.params.deleteCategory = true;
        }else if(value.rule_code == 'addSubcat'){
            $scope.params.addSubcat = true;
        }else if(value.rule_code == 'editSubcat'){
            $scope.params.editSubcat = true;
        }else if(value.rule_code == 'deleteSubcat'){
            $scope.params.deleteSubcat = true;
        }else if(value.rule_code == 'addPost'){
            $scope.params.addPost = true;
        }else if(value.rule_code == 'editPost'){
            $scope.params.editPost = true;
        }else if(value.rule_code == 'deletePost'){
            $scope.params.deletePost = true;
        }else if(value.rule_code == 'addBlog'){
            $scope.params.addBlog = true;
        }else if(value.rule_code == 'editBlog'){
            $scope.params.editBlog = true;
        }else if(value.rule_code == 'deleteBlog'){
            $scope.params.deleteBlog = true;
        }else if(value.rule_code == 'addImage'){
            $scope.params.addImage = true;
        }else if(value.rule_code == 'editImage'){
            $scope.params.editImage = true;
        }else if(value.rule_code == 'deleteImage'){
            $scope.params.deleteImage = true;
        }else if(value.rule_code == 'addVideo'){
            $scope.params.addVideo = true;
        }else if(value.rule_code == 'editVideo'){
            $scope.params.editVideo = true;
        }else if(value.rule_code == 'deleteVideo'){
            $scope.params.deleteVideo = true;
        }else if(value.rule_code == 'exportInscription'){
            $scope.params.exportInscription = true;
        }else if(value.rule_code == 'all'){
            $scope.params.ctl_all = true;
        }
 

      }); 

 

    });




      $scope.saveParam = function(checked , type) {

          
         $rootScope.loader = true;
         
         
         $http.post( API_URL + '/registration/addRole/'+$stateParams.id, 
         {
          'checked':checked,
          'type':type,
          'created_by':$rootScope.user

        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          load();
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
          
          
        })
        .error(function(data, status, headers, config) {
        });

    
      };
      

      
  
  
  
 

  
  
        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
                $http.get(API_URL+"/index/getAll/"+$rootScope.user).success(function(data, status, headers, config) {

                        $scope.users = data.data;
                        angular.copy($scope.users, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.users.length;
                        $scope.totalItems = $scope.users.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = $scope.users.length; //Number of pager buttons to show

                        $scope.setPage = function (pageNo) {
                         $scope.currentPage = pageNo;
                       };

                       $scope.pageChanged = function() {
                         // console.log('Page changed to: ' + $scope.currentPage);
                      };

                      $scope.setItemsPerPage = function(num) {
                       $scope.itemsPerPage = num;
                          $scope.currentPage = 1; //reset to first paghe
                        }
                      });
       }

         /**
        * End load function
        * 
        *
        **/


        load(); //Call load function


        $scope.getDroits = function(user_id){

           $state.go('app.droits', { id : user_id });


        };

        
        $scope.deleteUser = function(id) {
          
          var confirmMessage = null;


          if($rootScope.user_admin == 'true'){
           if($rootScope.selectLang == 'French'){
             confirmMessage= confirm("Voulez-vous vraiment supprimer cette utilisateur ?");
           }else{
            confirmMessage= confirm("Are you sure ?");
          }


          
          if (confirmMessage)
          {
            $rootScope.loader = true;
            $http({
              method:'DELETE',
              url:API_URL + '/index/delete/'+id
            }).success(function(data, status, headers, config) {
             
              $rootScope.loader = false;
              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/droits');
              
            }).error(function(data, status, headers, config) {

            });
          }

        }
        
      };


      $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
        
        
        $scope.etablissements = data.data;
        
      });



      $scope.saveUser = function() {
        $rootScope.loader = true;
        $scope.authError = null;

                // Try to create
                if($rootScope.user_admin === 'true'){
                  $http.post(API_URL+'/registration/save', 
                  {
                    
                    usr_email: $scope.userEdit.tel, 
                    usr_password: $scope.userEdit.password,
                    nom : $scope.userEdit.nom,
                    prenom : $scope.userEdit.nom,
                    created_by : $rootScope.user,
                    usr_type: $scope.userEdit.type,
                    etablissement_id : $scope.userEdit.etablissement_id,
                    created_by_new : $scope.userEdit.tel,
                    id_agent : $scope.userEdit.idagent
                    //id_role : $scope.userEdit.id_role
                  }
                  ).then(function(response) {
                   
                    $rootScope.loader = false;
                    
                    if(response.data.message_user_exists != null){
                      $scope.authError=response.data.message_user_exists;
                      
                      toaster.pop('warning','Information', '<br>'+response.data.message_user_exists+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                      
                    }else{
                      
                      $scope.authError = "Utilisateur est ajouté avec succès.";
                      
                      toaster.pop('success','Information', '<br>'+"L'utilisateur est ajouté avec succès."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                    }

                    load();
                    $location.path('/app/droits');

                    




                  }, function(x) {
                   $scope.authError = 'Server Error'+x;

                 }); 


                }


              };



              $scope.activerCompte = function(id){

               if($rootScope.user_admin === 'true'){
                $rootScope.loader = true;

                $http.post(API_URL + '/registration/activercompte', 
                {
                  user_id: id ,
                  value : 1
                  
                }
                ).then(function(response) {

                  toaster.pop('success','Information', '<br>'+"Le compte d'utilisateur est actif."+'<br><br>' + 
                    '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                    0, 'trustedHtml', null, "note-toaster-container");
                  load();
                  $location.path('/app/droits');
                  $rootScope.loader = false;

                }, function(x) {
                 $scope.authError = 'Server Error'+x;
                 toaster.pop('error','Information', '<br>'+"Server Error "+x+'<br><br>' + 
                  '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                  0, 'trustedHtml', null, "note-toaster-container");

               });

              }
              



            };

            $scope.desactiverCompte = function(id){

             if($rootScope.user_admin === 'true'){
              $rootScope.loader = true;
              $http.post(API_URL + '/registration/activercompte', 
              {
                user_id: id,
                value : 0 
                
              }
              ).then(function(response) {
               
               toaster.pop('success','Information', '<br>'+"Le compte d'utilisateur est inactif."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");
               load();
               $location.path('/app/droits');
               $rootScope.loader = false;

             }, function(x) {
               $scope.authError = 'Server Error'+x;
               toaster.pop('error','Information', '<br>'+"Server Error "+x+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

             });
            }


          };
          

          
        }]);


 


 
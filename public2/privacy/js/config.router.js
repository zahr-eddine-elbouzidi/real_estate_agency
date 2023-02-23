'use strict';

/**
 * Config for the router
 */


    var getCookie=function(cname)
    {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
        }
         return "";
    }

     
angular.module('app')
  .run(
    ['$rootScope', '$state', '$stateParams',function ($rootScope,   $state,   $stateParams) {
            $rootScope.$state = $state;
          $rootScope.$stateParams = $stateParams;  
          
          

           if(!sessionStorage.getItem("keySessionPHP")){
              $rootScope.user=getCookie("PHPCOOKIE");
           }else{
             $rootScope.user=sessionStorage.getItem("keySessionPHP");
           }
          //debut
           $rootScope.$on('$stateChangeStart', function (event, toState, toParams ,next, current) {

            
            


            var accessDenied = function(){
                event.preventDefault();

                //do whatever neccessary   
                //alert("UNAUTHORIZED_ACCESS");
                 $state.go("app.unauthorized");

             };

             var accessDeniedRequireLogin = function(){
                event.preventDefault();
                $state.go("access.signin");

             };


           var accessModulesBlocked =  function(){
                event.preventDefault();
                $state.go('app.serviceblocked');
             } 

             


              if(angular.isDefined(toState.data)){


          

                        if(toState.data.requireLogin && sessionStorage.getItem("keySessionPHP") === null && getCookie("PHPCOOKIE")==="") {
                            
                            
                            accessDeniedRequireLogin();

                         }  
               

                        if(angular.isDefined(toState.data.requiredRole) && 
                            angular.isDefined(toState.data.requiredType) && 
                            angular.isDefined($rootScope.role)  
                            && angular.isDefined(toState.data.requiredType)){

                           // alert($rootScope.adminName);
                            //alert($rootScope.type );
                            //alert(toState.data.requiredRole.indexOf($rootScope.adminName));
                            //alert(toState.data.requiredType.indexOf($rootScope.type) );


                           if(toState.data.requiredRole.indexOf($rootScope.adminName) < 0 
                            || toState.data.requiredType.indexOf($rootScope.role) < 0){

                             accessDenied();

                            }else{
                              //alert('ELSE');
                            } 

                       }

           

         
              } 
             
            });
          //fin
      }
    ]
  )
  .config(
    ['$stateProvider','$locationProvider', '$urlRouterProvider',function ($stateProvider,$locationProvider,   $urlRouterProvider) {
          



 // use the HTML5 History API
     //   $locationProvider.html5Mode(true);



          $urlRouterProvider.otherwise('/app/404');


          $stateProvider
              .state('app', {
                  abstract: true,
                  url: '/app',
                  templateUrl: 'tpl/app.php',
                   data: {
                      requireLogin: true // this property will apply to all children of 'app'
                    },  
                    resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signin.js'] );
                      }]
                  }
              })

              .state('app.categorie', {
                  url: '/categorie',
                  templateUrl: 'tpl/modules/news/categorie/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/categories.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


              .state('app.sessions', {
                  url: '/sessions',
                  templateUrl: 'tpl/modules/sessions/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/sessions/sessions.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
               
              })

              .state('app.addSession', {
                  url: '/sessions/add',
                  templateUrl: 'tpl/modules/sessions/add.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/sessions/sessions.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
               
              })


              .state('app.editSession', {
                  url: '/sessions/edit/:id',
                  templateUrl: 'tpl/modules/sessions/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/sessions/sessions.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

               .state('app.addCategory', {
                  url: '/category/add',
                  templateUrl: 'tpl/modules/news/categorie/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/categories.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            .state('app.editCategory', {
                  url: '/category/edit/:id',
                  templateUrl: 'tpl/modules/news/categorie/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/categories.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

                .state('app.university', {
                  url: '/university',
                  templateUrl: 'tpl/modules/news/university/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/university.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


                .state('app.addUniversity', {
                  url: '/university/add',
                  templateUrl: 'tpl/modules/news/university/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/university.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


                .state('app.editUniversity', {
                  url: '/university/edit/:id',
                  templateUrl: 'tpl/modules/news/university/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/university.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


              .state('app.params', {
                  url: '/settings',
                  templateUrl: 'tpl/modules/hires/params/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/params/params.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })
    
    
    
     		.state('app.contact', {
                  url: '/contact',
                  templateUrl: 'tpl/modules/contact/add.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/contact/contact.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


          .state('app.addPubs', {
                  url: '/publication/add',
                  templateUrl: 'tpl/modules/publications/add.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/pubs/pubs.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

          .state('app.pubs', {
                  url: '/publications',
                  templateUrl: 'tpl/modules/publications/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/pubs/pubs.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

           .state('app.editpub', {
                  url: '/publication/edit/:id',
                  templateUrl: 'tpl/modules/publications/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/pubs/pubs.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


               .state('app.history', {
                  url: '/history',
                  templateUrl: 'tpl/modules/hires/history/index.php',
                    data: {
                      requireLogin: true, // this property will apply to all children of 'app',
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/params/params.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              

           .state('app.users', {
                  url: '/users',
                  templateUrl: 'tpl/users.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','AdminT']
                    },
                   resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( [ 'js/controllers/chart.js',
                                               'js/controllers/libs/modules/news/users.js',
                                               'vendor/libs/moment.min.js'
                                               ] );
                      }]
                  }
                
                 
              })

              .state('app.droits', {
                  url: '/droits/:id',
                  templateUrl: 'tpl/droits.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                   resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( [ 'js/controllers/chart.js',
                                               'js/controllers/libs/modules/news/users.js',
                                               'vendor/libs/moment.min.js'
                                               ] );
                      }]
                  }
                
                 
              })
    
    
     .state('app.addUser', {
                  url: '/users/add',
                  templateUrl: 'tpl/addUser.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','AdminT']
                    },
                   resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( [ 'js/controllers/chart.js',
                                               'js/controllers/libs/modules/news/users.js',
                                               'vendor/libs/moment.min.js'
                                               ] );
                      }]
                  }
                
                 
              })

          .state('app.editUser', {
                  url: '/users/edit/:id',
                  templateUrl: 'tpl/editUser.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','AdminT']
                    },
                   resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( [ 'js/controllers/chart.js',
                                               'js/controllers/libs/modules/news/users.js',
                                               'vendor/libs/moment.min.js'
                                               ] );
                      }]
                  }
                
                 
              })
            
              .state('app.backup', {
                  url: '/backup',
                  templateUrl: 'tpl/backup.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Ministère']
                    },
                   resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( [ 'js/controllers/chart.js',
                                               'js/controllers/libs/modules/backup/backup.js',
                                               'vendor/libs/moment.min.js'
                                               ] );
                      }]
                  }
                
                 
              })
               .state('app.type', {
                  url: '/type',
                  templateUrl: 'tpl/modules/news/type/index.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/types.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             

               .state('app.addSubCategory', {
                  url: '/subCategory/add',
                  templateUrl: 'tpl/modules/news/type/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/types.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

                

              .state('app.editSubCategory', {
                  url: '/subCategory/edit/:id',
                  templateUrl: 'tpl/modules/news/type/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/types.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              .state('app.formule', {
                  url: '/formule',
                  templateUrl: 'tpl/modules/formule/index.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/formules/formule.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })
               .state('app.addFormule', {
                  url: '/formule/add',
                  templateUrl: 'tpl/modules/formule/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/formules/formule.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              .state('app.editFormule', {
                  url: '/formule/edit/:id',
                  templateUrl: 'tpl/modules/formule/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/formules/formule.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

                .state('app.etablissement', {
                  url: '/etablissement',
                  templateUrl: 'tpl/modules/news/etablissement/index.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/etablissement.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

               .state('app.addEtablissement', {
                  url: '/etablissement/add',
                  templateUrl: 'tpl/modules/news/etablissement/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/etablissement.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


            .state('app.editEtablissement', {
                  url: '/etablissement/edit/:id',
                  templateUrl: 'tpl/modules/news/etablissement/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/news/etablissement.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            

            
                 .state('app.fonctionnaires', {
                  url: '/profs/index',
                  templateUrl: 'tpl/modules/agents/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT','AdminT','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/params/params.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

 
                .state('app.addFonctionnaires', {
                  url: '/profs/add',
                  templateUrl: 'tpl/modules/agents/addFonctionnaire.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT','AdminT','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/params/params.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

                .state('app.go', {
                  url: '/go',
                  templateUrl: 'tpl/go.php',
                   data: {
                      requireLogin: true, // this property will apply to all children of 'app'
                      requiredRole: ['admin','standard'],
                      requiredType: ['Superviseur','SuperviseurT','AdminT','Admin']
                    
                    },
                  resolve: {
                    deps: ['$ocLazyLoad',
                      function( $ocLazyLoad ){
                        return $ocLazyLoad.load(['js/controllers/chart.js']);
                    }]
                  }
              })

                .state('app.editFonctionnaire', {
                  url: '/profs/edit/:id',
                   templateUrl: 'tpl/modules/agents/editFonctionnaire.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','SuperviseurT','AdminT','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/params/params.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            
             
               
             .state('app.dashboard-v1', {
                  url: '/dashboard',
                  templateUrl: 'tpl/app_dashboard_v1.php',
                   data: {
                      requireLogin: true, // this property will apply to all children of 'app'
                      requiredRole: ['admin'],
                      requiredType: ['SuperviseurT','Superviseur' ,'Ministère']
                    },
                  resolve: {
                    deps: ['$ocLazyLoad',
                      function( $ocLazyLoad ){
                        return $ocLazyLoad.load(['js/controllers/chart.js']);
                    }]
                  }
              })
         
 
               .state('app.addHire', {
                  url: '/hires/add',
                  templateUrl: 'tpl/modules/hires/add.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Admin','paramsDroit.addHire']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

                 .state('app.editHire', {
                  url: '/hires/edit/:id',
                  templateUrl: 'tpl/modules/hires/edit.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


              .state('app.listes', {
                  url: '/hires/listes/:id',
                  templateUrl: 'tpl/modules/hires/listes/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/listes.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


                .state('app.results', {
                  url: '/hires/results/:id',
                  templateUrl: 'tpl/modules/hires/listes/results.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Superviseur','Admin']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/results.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            .state('app.hires', {
                  url: '/hires',
                  templateUrl: 'tpl/modules/hires/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Admin','Superviseur','Ministère']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              .state('app.commission', {
                  url: '/concours-commission',
                  templateUrl: 'tpl/modules/commission/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Commission']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/commission.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             .state('app.requests', {
                  url: '/requests/:id/:slug',
                  templateUrl: 'tpl/modules/hires/requests.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Admin','Superviseur','Ministère','Commission']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              .state('app.files', {
                  url: '/files/:id',
                  templateUrl: 'tpl/modules/hires/listFiles.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Admin','Superviseur','Ministère','Commission']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

              .state('app.my-files', {
                  url: '/my-files/:id_hire',
                  templateUrl: 'tpl/modules/candidat/fileList.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-Normale','Candidat-PESAF','Candidat-PESAM']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            .state('app.my-jury', {
                url: '/my-jury/:id_file',
                templateUrl: 'tpl/modules/candidat/addJury.php',
                  data: {
                    requireLogin: true,
                    requiredRole: ['standard'],
                    requiredType: ['Standard','Candidat-PESAF','Candidat-PESAM']
                  },
                  resolve: {
                      deps: ['uiLoad','$ocLazyLoad',
                        function( uiLoad ,$ocLazyLoad){

                           return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                  return uiLoad.load( ['js/controllers/chart.js',
                                                      'js/controllers/libs/modules/candidat/jury.js',
                                                      'vendor/libs/moment.min.js'] );
                              }
                            );
                      }]
                      
                  }
              
               
            })

           /* .state('app.membres-commission', {
                url: '/commissions/:hire_id',
                templateUrl: 'tpl/modules/commission/membres/index.php',
                  data: {
                    requireLogin: true,
                    requiredRole: ['admin'],
                    requiredType: ['Superviseur']
                  },
                  resolve: {
                      deps: ['uiLoad','$ocLazyLoad',
                        function( uiLoad ,$ocLazyLoad){

                           return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                  return uiLoad.load( ['js/controllers/chart.js',
                                                      'js/controllers/libs/modules/hires/commission.js',
                                                      'vendor/libs/moment.min.js'] );
                              }
                            );
                      }]
                      
                  }
              
               
            })*/

             .state('app.passing', {
                  url: '/passing/:id/:slug',
                  templateUrl: 'tpl/modules/hires/orale.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['admin'],
                      requiredType: ['Admin','Superviseur','Ministère','Commission']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/hires/posts/hires.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             .state('app.convocation', {
                  url: '/convocation/:id',
                  templateUrl: 'tpl/modules/candidat/convocation.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-Normale','Candidat-PESAF','Candidat-PESAM']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

            .state('app.profil', {
                  url: '/mon-profil',
                  templateUrl: 'tpl/modules/candidat/candidat.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })


             .state('app.candidats', {
                  url: '/candidats',
                  templateUrl: 'tpl/modules/news/candidats/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             .state('app.postuled', {
                  url: '/candidats/postuled/:id',
                  templateUrl: 'tpl/modules/news/candidats/postulation_logs.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['Superviseur','SuperviseurT']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             




            /* .state('app.profil', {
                  url: '/mon-profil',
                  templateUrl: 'tpl/modules/candidat/candidat.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-Normale','Candidat-PESAF','Candidat-PESAM']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             .state('app.mes-concours', {
                  url: '/mes-concours',
                  templateUrl: 'tpl/modules/candidat/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-Normale','Candidat-PESAF','Candidat-PESAM']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })*/

              .state('app.mes-concours', {
                  url: '/mes-concours',
                  templateUrl: 'tpl/modules/candidat/index.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })

             .state('app.mes-candidatures', {
                  url: '/mes-candidatures',
                  templateUrl: 'tpl/modules/candidat/myhires.php',
                    data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-Normale','Candidat-PESAF','Candidat-PESAM']
                    },
                    resolve: {
                        deps: ['uiLoad','$ocLazyLoad',
                          function( uiLoad ,$ocLazyLoad){

                             return $ocLazyLoad.load('angularFileUpload').then(
                                function(){
                                    return uiLoad.load( ['js/controllers/libs/modules/candidat/candidat.js',
                                                 'vendor/libs/moment.min.js'] );
                                }
                              );
                        }]
                          
                    }
                
                 
              })
            

             .state('app.404', {
                  url: '/404',
                  templateUrl: 'tpl/404.php'
              })

              .state('app.unauthorized',{
                url : '/unauthorized',
                templateUrl : 'tpl/page_unauthorized.php'
              })

              .state('app.serviceblocked',{
                url : '/ressource-not-found',
                templateUrl : 'tpl/page_service_blocked.php'
              })

            
    
              .state('app.chart', {
                  url: '/chart',
                  templateUrl: 'tpl/ui_chart.html',
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad){
                          return uiLoad.load('js/controllers/chart.js');
                      }]
                  }
              })
       
       

              .state('app.docpaexperience', {
                  url: '/documents-experience/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })


               .state('app.upload', {
                  url: '/upload/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })
               
                .state('app.upload-rest', {
                  url: '/upload-rest/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadRestPA.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadparest.js');
                              }
                          );
                      }]
                  }
              })
            /*  .state('app.upload', {
                  url: '/upload/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                   data: {
                      requireLogin: true,
                      requiredRole: ['standard'],
                      requiredType: ['Standard','Candidat-PESAF','Candidat-PESAM','Candidat-Normale']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })*/

              .state('app.docpadiplomes', {
                  url: '/documents-diplomes/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                  data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })

              .state('app.docpadiplomesadmin', {
                  url: '/documents-diplomes-adminstratifs/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                  data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })

              .state('app.docpapublication', {
                  url: '/documents-publication-communication/:slug/:id_hire',
                  templateUrl: 'tpl/modules/candidat/PA/uploadPA.php',
                  data: {
                      requireLogin: true,
                      requiredRole: ['standard']
                    },
                  resolve: {
                      deps: ['$ocLazyLoad',
                        function( $ocLazyLoad){
                          return $ocLazyLoad.load('angularFileUpload').then(
                              function(){
                                 return $ocLazyLoad.load('js/controllers/fileuploadpa.js');
                              }
                          );
                      }]
                  }
              })

              // pages
              .state('app.page', {
                  url: '/page',
                  template: '<div ui-view class="fade-in-down"></div>'
              })
            
            
              .state('app.docs', {
                  url: '/docs',
                  templateUrl: 'tpl/docs.php',
                  data: {
                    requireLogin: false
                  },
              })
              // others
              .state('lockme', {
                  url: '/lockme',
                  templateUrl: 'tpl/page_lockme.html'
              })
              .state('confirmation', {
                  url: '/confirmation?id&token&email',
                  templateUrl: 'tpl/page_confirmation_code.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                       resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signup.js'] );
                      }]
                  }
              })
              .state('access', {
                  url: '/access',
                  template: '<div ui-view class="fade-in-right-big smooth"></div>'
              })
              .state('access.signin', {
                  url: '/signin',
                  templateUrl: 'tpl/page_signin.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signin.js'] );
                      }]
                  }
              })
              .state('access.signup', {
                  url: '/signup',
                  templateUrl: 'tpl/page_signup.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signup.js'] );
                      }]
                  }
              })
              .state('access.forgotpwd', {
                  url: '/forgotpwd',
                  templateUrl: 'tpl/page_forgotpwd.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signup.js'] );
                      }]
                  }
              })
              .state('access.initializepw', {
                  url: '/initializePassword?id',
                  templateUrl: 'tpl/page_reset_pw.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signup.js'] );
                      }]
                  }
              })

              .state('access.confirmInitializepw', {
                  url: '/confirmationPassword?id&token&email',
                  templateUrl: 'tpl/page_conf_pw.php',
                   data: {
                      requireLogin: false // this property will apply to all children of 'app'
                    },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/signup.js'] );
                      }]
                  }
              })

 
 

               .state('app.modules', {
                  url: '/modules',
                  templateUrl: 'tpl/modules.php',
                   data: {
                      requireLogin: true, // this property will apply to all children of 'app'
                      requiredRole: ['admin']
                    },
                   resolve: {
                    deps: ['$ocLazyLoad',
                      function( $ocLazyLoad ){
                        return $ocLazyLoad.load(['js/controllers/modules.js']);
                    }]
                  }
              })

          
           
          
              .state('layout.app', {
                  url: '/app',
                  views: {
                      '': {
                          templateUrl: 'tpl/layout_app.html'
                      },
                      'footer': {
                          templateUrl: 'tpl/layout_footer_fullwidth.html'
                      }
                  },
                  resolve: {
                      deps: ['uiLoad',
                        function( uiLoad ){
                          return uiLoad.load( ['js/controllers/tab.js'] );
                      }]
                  }
              })
              .state('apps', {
                  abstract: true,
                  url: '/apps',
                  templateUrl: 'tpl/layout.html'
              })
             
           
             
              
      }





    ]
  );

 
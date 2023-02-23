app.controller('CandidatCtrl',['$scope','$filter', '$rootScope','$stateParams', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope,$filter, $rootScope,$stateParams, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    $rootScope.loader = false;
    
    $scope.checked =  function(){
      $rootScope.loader = true;
      $http.get(API_URL+'/candidat/checkPieces/'+$rootScope.user).
      success(function(data, status, headers, config) {
       
        $rootScope.loader = false;
        if(angular.isDefined(data.data)){
          $scope.piecesManqu = data.data;
        }else{
         $scope.piecesManqu = null;
         
       }


     }); 
    };

        $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          
          $scope.etablissements = data.data;
          
        });


        $scope.hires = {};
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

        /**
         * [load description]
         * @return {[type]} [description]
         */
         
         $scope.load = function(etab_id) {

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat/getListHires/'+$rootScope.user+'/'+etab_id).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.hires = data.data;
                        $scope.length = $scope.hires.length;
                        if(data.message != "" ){
                          //toaster.pop('danger', 'Message', data.message); 
                          $state.go('app.profil');
                        }
                        angular.copy($scope.hires, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = $scope.hires.length;
	                      $scope.totalItems = $scope.hires.length;
	                      $scope.currentPage = 1;
	                      $scope.itemsPerPage = $scope.viewby;
	                      $scope.maxSize = 5; //Number of pager buttons to show
	                      $scope.setPage = function (pageNo) {
                         $scope.currentPage = pageNo;
                        };
                        $scope.pageChanged = function() {
	                       // console.log('Page changed to: ' + $scope.currentPage);
                      };
                      $scope.setItemsPerPage = function(num) {
                       if(num === 'Tous'){
                        $scope.itemsPerPage = $scope.hires.length;
                      }else{
                        if($scope.viewby > $scope.hires.length ){

                          $scope.itemsPerPage =  $scope.hires.length;
                          
                        }else{
                         $scope.itemsPerPage = num;
                       }
                       
                     }
                   }
                 });
        }

       

 

         $http.get(API_URL+'/type/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          $scope.types = data.data;
        });





         var hiresOld = function() {

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat/getListHiresOld/'+$rootScope.user).success(function(data, status, headers, config) {

                      $rootScope.loader = false;
                      $scope.hiresOld = data.data;
                      $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
                      if(data.message != "" ){
                             // toaster.pop('danger', 'Message', data.message); 
                             $state.go('app.profil');
                           } 

                      //  console.info(data.data);
                        angular.copy($scope.hiresOld, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.hiresOld.length;
                        $scope.totalItems = $scope.hiresOld.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = 5; //Number of pager buttons to show
                        $scope.setPage = function (pageNo) {
                          $scope.currentPage = pageNo;
                        };
                        $scope.pageChanged = function() {
                         // console.log('Page changed to: ' + $scope.currentPage);
                       };
                       $scope.setItemsPerPage = function(num) {
                        if(num === 'Tous'){
                          $scope.itemsPerPage = $scope.hiresOld.length;
                        }else{
                          if($scope.viewby > $scope.hiresOld.length ){

                            $scope.itemsPerPage =  $scope.hiresOld.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
        };



        hiresOld();


          $scope.refR=function(){
             hiresOld();
           }


           $scope.candidat = {};
           var getCandidat  = function(){

             
            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

             $scope.candidat = response.data;
             
             

                 console.log(response.data);
                if(angular.isDefined(response.data)){

                  $scope.candidat.cin = response.data.cin;
                  $scope.candidat.nom = response.data.nom;
                  $scope.candidat.prenom = response.data.prenom;
                  $scope.candidat.nom_ar = response.data.nom_ar;
                  $scope.candidat.prenom_ar = response.data.prenom_ar;
                  $scope.candidat.tel = response.data.tel;
                  $scope.candidat.email = response.data.usr_email;
                  $scope.candidat.adresse_fr = response.data.adresse_fr;
                  $scope.candidat.adresse_ar = response.data.adresse_ar;
                  $scope.candidat.sexe = response.data.sexe;
                  $scope.candidat.date_naiss = new Date(response.data.date_naiss);
                  $scope.candidat.lieu_naiss = response.data.lieu_naiss;
                  $scope.candidat.diplome = response.data.diplome;
                  $scope.candidat.specialite = response.data.specialite;
                  $scope.candidat.date_obtention = response.data.date_obtention;
                  $scope.candidat.niveau = response.data.niveau;
                  $scope.candidat.mention = response.data.mention;
                  $scope.candidat.etablissement = response.data.etablissement;
                  $scope.candidat.parcours = response.data.parcours;
                  

                  if(response.data.etablissement == 'null' || response.data.etablissement == null || response.data.etablissement == '' ){
                    $scope.fonct = 'Non';
                  }else{
                    $scope.fonct = 'Oui';
                  }
                  
                  if(response.data.is_fonctionnaire == 1){
                   $scope.candidat.is_fonctionnaire = true;
                 }else{
                   $scope.candidat.is_fonctionnaire = false;
                 }


                 

               }

               

               

             });


          };


          getCandidat();

          //get Membres de jury de la thèse
          $scope.getThese = function(hire_id){

            $http.get(API_URL+'/file/getThese/'+$rootScope.user+'/'+hire_id)
            .success(function(response, status, headers, config) {

               if(angular.isDefined(response.data)){

                $state.go('app.my-jury',{id_file : response.data.id});
                

              }

              

              

            });


          };

          




          

          
          
         /**
          * [deleteCustomer description]
          * @return {[type]} [description]
          */
          $scope.deletePostuler = function() {

            $('#confirm-delete').on('click', '.btn-ok', function(e) {
              var $modalDiv = $(e.delegateTarget);
              var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({

                        method:'DELETE',
                        url:API_URL + '/postuler/delete/'+id

                      }).success(function(data, status, headers, config) {

                        
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)

                       $state.go('app.mes-concours');

                       $rootScope.loader = false;
                       
                       toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                       
                       

                     }).error(function(data, status, headers, config) {

                     });




                     
                   });
            $('#confirm-delete').on('show.bs.modal', function(e) {
              var data = $(e.relatedTarget).data();
              $('.title', this).text(data.recordTitle);
              $('.btn-ok', this).data('recordId', data.recordId);
            });
            
            
            
          }








       /**
        * 
        */

        $scope.getConvocation=function(hire){

         
         $state.go('app.convocation', { id : hire.id });

       };


        /**
         * [getElement description]
         * @param  {[type]} category [description]
         * @return {[type]}          [description]
         */
         $scope.getElement=function(hire){
           $state.go('app.editHire', { id : hire.id });
         };


       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveCandidat = function() {

          
         $rootScope.loader = true;
         
                    $scope.level = "";
                   
                   if($scope.candidat.diplome === 'Baccalauréat ou un diplôme équivalent'){

                    $scope.level = 'BAC';

                  }else if($scope.candidat.diplome === 'DTS,DUT,BTS,DEUG (3ème grade) ou un diplôme équivalent'){
                   
                    $scope.level = 'BAC+2';
                    
                  }else if($scope.candidat.diplome === 'Licence ou un diplôme équivalent'){
                    
                    $scope.level = 'BAC+3';
                    
                  }else if($scope.candidat.diplome === 'Master ou un diplôme équivalent'){
                    
                    $scope.level = 'BAC+5';
                    
                  }else if($scope.candidat.diplome === 'Ingénieur ou un diplôme équivalent'){

                   $scope.level = 'BAC+5I';
                   
                 }else if($scope.candidat.diplome === 'Diplôme de Technicien (4ème grade) ou un diplôme équivalent'){

                   $scope.level = '+2';
                   
                 }else if($scope.candidat.diplome === 'Doctorat ou un diplôme équivalent'){

                   $scope.level = 'BAC+8';

                 }else if($scope.candidat.diplome === 'Doctorat ou un diplôme équivalent (Médecine)'){
                  
                   $scope.level = 'BAC+8M';
                 }
                 
                 $http.post( API_URL + '/candidat/add', 
                 {
                  'usr_name' : $rootScope.user,
                  'cin' : $scope.candidat.cin,
                  'usr_nom': $scope.candidat.nom,
                  'usr_prenom':$scope.candidat.prenom,
                  'nom_ar':$scope.candidat.nom_ar,
                  'prenom_ar':$scope.candidat.prenom_ar,
                  'tel':$scope.candidat.tel,
                  'usr_email':$scope.candidat.email,
                  'adresse_fr':$scope.candidat.adresse_fr ,
                  'adresse_ar':$scope.candidat.adresse_ar,
                  'sexe':$scope.candidat.sexe,
                  'date_naiss': $filter('date')(new Date($scope.candidat.date_naiss), 'yyyy-MM-dd'),
                  'lieu_naiss':$scope.candidat.lieu_naiss ,
                  'diplome':$scope.candidat.diplome,
                  'specialite':$scope.candidat.specialite ,
                  'date_obtention':$scope.candidat.date_obtention,
                  'niveau':$scope.level,
                  'mention':$scope.candidat.mention,
                  'etablissement' : $scope.candidat.etablissement,
                  'is_fonctionnaire':$scope.candidat.is_fonctionnaire,
                  'parcours':$scope.candidat.parcours
                  

                }).success(function(data, status, headers, config) {

                  $rootScope.loader = false;

                  if(angular.isDefined(data.messageExiste)){

                    toaster.pop('danger', 'Message', data.messageExiste);

                  }else{

                   if(data.drap==true ){
                    
                    getCandidat();
                    
                    toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                    
                    
                  }
                }


              })
                .error(function(data, status, headers, config) {
                   $rootScope.loader = false;
                });

                


                
              };
              $scope.redirect = function(){
               $state.go('app.mes-concours');
               
             };

             $scope.redirectUpload = function(id_hire_param){
              var dialog = confirm('Voulez-vous vraiement postuler à ce poste ?');
              if(dialog){

                $state.go('app.upload', { slug : 'divers' , id_hire :  id_hire_param});

              }
                
            }; 
            
            $scope.getMesFiles = function(id_hire_param){
              $state.go('app.my-files', { id_hire :  id_hire_param});
              
            }; 


            $scope.savePostuler = function(hire) {

              var dialog = confirm('Voulez-vous postuler à ce poste ('+hire.type_name+' en '+hire.specialty_fr+') ?');
              
              if(dialog){
               
               $rootScope.loader = true;
               
               $http.post( API_URL + '/postuler/add',{
                'created_by' : $rootScope.user,
                'hire_id' : hire.id })
               .success(function(data, status, headers, config){

                if(data.drap == 1 ){
                              //toaster.pop('success', 'Message', data.message); 
                              $state.go('app.monespace');

                            }else if(data.drap == 2 || data.drap == 3){

                              toaster.pop('warning', 'Message', data.message); 

                            }else{
                              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                0, 'trustedHtml', null, "note-toaster-container");
                              load();
                              $state.go('app.candidat');
                            }

                            $rootScope.loader = false;

                          })
               .error(function(data, status, headers, config) {
               });
               
             }
             
           };
           

           
         }]);






app.controller('EditHiresCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  

  
  

  $http.get(API_URL+'/type/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    $scope.types = data.data;
  });

  

  $http.get(API_URL+'/hire/getHire/'+$stateParams.id)
  .success(function(response, status, headers, config) {


    $scope.hireEdit = response.data;
    $scope.hireEdit.hire_code = response.data.hire_code;
    $scope.hireEdit.session_date_begin =new Date(response.data.session_date_begin) ;
    $scope.hireEdit.session_date_end = new Date(response.data.session_date_end);
    $scope.hireEdit.hire_date = new Date(response.data.hire_date);
    $scope.hireEdit.specialty_fr = response.data.specialty_fr;
    $scope.hireEdit.color = response.data.color;
    $scope.hireEdit.post_number = response.data.post_number;
    $scope.hireEdit.type_id = response.data.type_id;

  });

  

       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveHire = function(id) {

          
         $rootScope.loader = true;
         
                     // console.log($scope.hire);

                     $http.post( API_URL + '/hire/edit/'+id, 
                     {
                      'hire_code':$scope.hireEdit.hire_code,
                      'session_date_begin':$filter('date')(new Date($scope.hireEdit.session_date_begin), 'yyyy-MM-dd'),
                      'session_date_end':$filter('date')(new Date($scope.hireEdit.session_date_end), 'yyyy-MM-dd'),
                      'hire_date':$filter('date')(new Date($scope.hireEdit.hire_date), 'yyyy-MM-dd'),
                      'specialty_fr':$scope.hireEdit.specialty_fr,
                      'color':$scope.hireEdit.color,
                      'created_by':$rootScope.user,
                      'post_number' : $scope.hireEdit.post_number,
                      'type_id' : $scope.hireEdit.type_id
                      

                    }).success(function(data, status, headers, config) {
                      $rootScope.loader = false;
                      if(data.drap==true){

                       
                        toaster.pop('warning','Information', '<br>'+"Le code du concours est existe déjà !"+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");



                      }else  if(data.drap==false ){
                        
                        load();
                        
                        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");
                        
                        $location.path('/app/hires');    

                      }
                    })
                    .error(function(data, status, headers, config) {
                    });
                    
                  };
                  
                }]);



app.controller('ConvocationCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  $scope.execute = false;
  
  var load = function(){
   $rootScope.loader = true;
   $http.get(API_URL+'/candidat/getConvocation/'+$stateParams.id+'/'+$rootScope.user)
   .success(function(response, status, headers, config) {
    $scope.convocation = response.data;
    $rootScope.loader = false;

               //console.log($scope.convocation);
               
               $scope.execute = true;

             });

 };

 load();
 


 var loadParams = function(){

  $rootScope.loader = true;
  
  $http.get(API_URL+'/param/getList')
  .success(function(response, status, headers, config) {
   
   $scope.params = response.data;
   $scope.params.isProf = response.data[0].isProf;
   $scope.params.etablissement = response.data[0].etablissement;
   
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
};


loadParams();






}]);










app.controller('FilesCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   
  
   if($stateParams.id_hire === ''){
     $state.go('app.mes-candidatures');
   }


   $scope.hireGet = {};
   $http.get(API_URL+'/hire/getHire/'+$stateParams.id_hire)
   .success(function(response, status, headers, config) {


     $scope.hireGet = response.data;
     $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');

   });
   $scope.postuled = {};
   $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
   .success(function(response, status, headers, config) {
     $scope.postuled = response.object;    


   });

   
   $scope.editerFiles = function(){
    $state.go('app.upload', { slug : 'divers' , id_hire :  $stateParams.id_hire});
    
  }; 


  $rootScope.loader = false;

  var loadFiles = function(){

    $scope.fileDatas = [];
    $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user+'/'+$stateParams.id_hire)
    .success(function(response, status, headers, config) {
     
     
                      if(angular.isDefined(response.dataFiles)){
                        
                        $scope.fileDatas = response.dataFiles;
                        
                      }else{
                        $scope.fileDatas = [];
                      }
                      //console.log($scope.fileDatas);
            
                        angular.copy($scope.fileDatas, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =  $scope.fileDatas.length;
                        $scope.totalItems = $scope.fileDatas.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = 5; //Number of pager buttons to show
                        $scope.setPage = function (pageNo) {
                          $scope.currentPage = pageNo;
                        };
                        $scope.pageChanged = function() {
                         // console.log('Page changed to: ' + $scope.currentPage);
                       };
                       $scope.setItemsPerPage = function(num) {
                        if(num === 'Tous'){
                          $scope.itemsPerPage = $scope.fileDatas.length;
                        }else{
                          if($scope.viewby > $scope.fileDatas.length ){

                            $scope.itemsPerPage =  $scope.fileDatas.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });


  };

  loadFiles();
  
  $http.get(API_URL+'/agent/getListAgents').success(function(data, status, headers, config) {

    $scope.tolist = data.data;
 //	console.log($scope.tolist);

 

});

  
  $scope.deleteFile = function() {

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
      $rootScope.loader = true;
      $http({
        method:'DELETE',
        url:API_URL + '/candidat/deleteFile/'+id+'/'+$rootScope.user

      }).success(function(data, status, headers, config) {

        
       $modalDiv.addClass('loading');
       setTimeout(function() {
        $modalDiv.modal('hide').removeClass('loading');
      }, 500)

       $state.go('app.my-files');
       loadFiles();
       $rootScope.loader = false;
       toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");

     }).error(function(data, status, headers, config) {
      $rootScope.loader = false;
    });




     
   });
    $('#confirm-delete').on('show.bs.modal', function(e) {
      var data = $(e.relatedTarget).data();
      $('.title', this).text(data.recordTitle);
      $('.btn-ok', this).data('recordId', data.recordId);
    });
    
    
    
  }




  $scope.deleteJury = function(id) {

    $('#confirm-delete-jury').on('click', '.btn-jury', function(e) {
      var $modalDiv = $(e.delegateTarget);
            //var id = $(this).data('recordId');
            //console.log(id);
            // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()
            $rootScope.loader = true;
            $http({

              method:'DELETE',
              url:API_URL + '/candidat/deleteJury/'+id+'/'+$rootScope.user

            }).success(function(data, status, headers, config) {

              
             $modalDiv.addClass('loading');
             setTimeout(function() {
              $modalDiv.modal('hide').removeClass('loading');
            }, 500)

             $state.go('app.my-files');
                        //loadFiles();
                        $rootScope.loader = false;
                        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");

                      }).error(function(data, status, headers, config) {
                        $rootScope.loader = false;
                      });




                      
                    });
    $('#confirm-delete-jury').on('show.bs.modal', function(e) {
      var data = $(e.relatedTarget).data();
      $('.title', this).text(data.recordTitle);
      $('.btn-ok', this).data('recordId', data.recordId);
    });
    

    
  }



  

  $scope.ROWID = null;
  $scope.file = {};

  $(document).ready(function(){
    $('#confirm').on('show.bs.modal', function (e) {
      $scope.ROWID = $(e.relatedTarget).data('recordId');

    });
  });

  /* !!!: Display data into data type */
  $scope.displayFile =  function(file_id){

    $rootScope.loader = true;
    $http.get(API_URL+'/candidat/getJury/'+$rootScope.user+'/'+file_id)
    .success(function(data, status, headers, config) {
      if(angular.isDefined(data.data)){
        $scope.jury = data.data;

                       // console.log($scope.jury);
                       $rootScope.loader = false;
                     }
                   });

  }; 
  /* !!!: END DATA DISPLAY */ 


  



  $scope.saveJury = function() {

    $('#confirm').on('click','.btn-conf', function(e) {
      
      $rootScope.loader = true;
      $http.post( API_URL + '/candidat/saveJury', 
        
      {
        'nom_complet':$scope.file.nom_complet,
        'etablissement':$scope.file.etablissement,
        'specialite':$scope.file.specialite,
        'discipline':null,
        'file_id' : $scope.ROWID,
        'status' : null,
        'mention':null,                  
        'created_by':$rootScope.user
        
      }).success(function(data, status, headers, config) {

        $state.go('app.my-files');
        $scope.file.nom_complet = null;
        $scope.file.etablissement =  null;
        $scope.file.specialite =  null;
        $scope.file.discipline =  null;
        $scope.file.status =  null;
        $scope.file.mention =  null;
        $rootScope.loader = false;
        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
        
      }).error(function(data, status, headers, config) {
        $rootScope.loader = false;
      });

    });

    $('#confirm').on('click','.btn-conf', function(e) {
      var data = $(e.relatedTarget).data();
      $('.title', this).text(data.recordTitle);
      $('.btn-conf', this).data('recordId', data.recordId);
    });

    

    
    
  };

  
  

  
}]);





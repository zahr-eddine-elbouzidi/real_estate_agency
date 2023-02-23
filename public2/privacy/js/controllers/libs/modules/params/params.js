app.controller('ParamsCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  

  var load = function(){

   $rootScope.loader = true;

   $http.get(API_URL+'/param/getList')
   .success(function(response, status, headers, config) {

    $scope.params = response.data;
    $scope.params.isProf = response.data[0].isProf;
    $scope.params.isAdministratif = response.data[0].isAdministratif;
    $scope.params.isProfM = response.data[0].isProfM;
    $scope.params.display_motif = response.data[0].display_motif;
    $scope.params.max_upload_file_pa = response.data[0].max_upload_file_pa;
    $scope.params.max_upload_file_admin = response.data[0].max_upload_file_admin;
    $scope.params.etablissement = response.data[0].etablissement;

    if($scope.params.isProf == 1){
      $scope.params.isProf = true;
      $rootScope.isProf = true;
    }else{
      $scope.params.isProf = false;
      $rootScope.isProf = false;
    }

    if($scope.params.isProfM == 1){
      $scope.params.isProfM = true;
      $rootScope.isProfM = true;
    }else{
      $scope.params.isProfM = false;
      $rootScope.isProfM = false;
    }
    if($scope.params.isAdministratif == 1){
      $scope.params.isAdministratif = true;
      $rootScope.isAdministratif = true;
    }else{
      $scope.params.isAdministratif = false;
      $rootScope.isAdministratif = false;
    }
   
   if($scope.params.display_motif == 1){
      $scope.params.display_motif = true;
      $rootScope.display_motif = true;
    }else{
      $scope.params.display_motif = false;
      $rootScope.display_motif = false;
    }


    $rootScope.loader = false;
       //  toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                 // '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                 // 0, 'trustedHtml', null, "note-toaster-container");
                // console.log($rootScope.isProf);

                
              });
 };


 	  load();




     var loadHistory = function(){

       $rootScope.loader = true;

       $http.get(API_URL+'/param/getHistory')
       .success(function(response, status, headers, config) {

        $rootScope.loader = false;
        $scope.history  = response.data;


                        //console.info( $scope.history);

                        

                       // console.info(data.data);
                       angular.copy($scope.history, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = 5;
                        $scope.totalItems = $scope.history.length;
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
                          $scope.itemsPerPage = $scope.history.length;
                        }else{
                          if($scope.viewby > $scope.history.length ){

                            $scope.itemsPerPage =  $scope.history.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }

                     
                   });
     };


     loadHistory();
     

       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveParam = function() {

          
         $rootScope.loader = true;
         
         
         $http.post( API_URL + '/param/add', 
         {
          'isProf':$scope.params.isProf,
          'isProfM':$scope.params.isProfM,
          'isAdministratif':$scope.params.isAdministratif,          
          'display_motif':$scope.params.display_motif,
          'created_by':$rootScope.user,
          'max_upload_file_admin' : $scope.params.max_upload_file_admin,
          'max_upload_file_pa' : $scope.params.max_upload_file_pa

        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          load();
          $rootScope.isProf = data.data.isProf
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
          
          
        })
        .error(function(data, status, headers, config) {
        });

        


        
      };
      

      
    }]);


app.controller('AgentCtrl',['$scope','$filter' ,'$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope,$filter, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   
   
   
     //getting file uploader
     var uploader = $scope.uploader = new FileUploader({
      url: API_URL+'/agent/upload/'+$rootScope.user
    });
     
     
     $scope.uploadImage = function (item) {
      item.upload();
    };
     // FILTERS 
     // a sync filter 
     uploader.filters.push({
       name: 'syncFilter',
       fn: function(item /*{File|FileLikeObject}*/, options) {
         return this.queue.length < 1;
       }
     });
     $scope.clearAll = function(){
      $("#file_upload").val(null);
      uploader.clearQueue();
      $scope.filename = undefined;
      $scope.invalidate = true;
      $scope.hasError = false;
    };
    uploader.clear = function(){
      $("#file_upload").val(null);
      uploader.clearQueue();
      $scope.filename = undefined;
      $scope.invalidate = true;
      $scope.hasError = false;
    }  
    $scope.hire = {}
    $scope.getHireId = function(hire){
      if(angular.isDefined(hire)){
        $scope.hire = hire;
      }else{
        $scope.hire = {}
      }
    }
    
    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
      
    };
    uploader.onAfterAddingFile = function(fileItem) {

    };
    uploader.onAfterAddingAll = function(addedFileItems) {
      // alert($scope.hire);
      var fd = new FormData();
      var file = addedFileItems[0]._file;
      fd.append('file' , file);
      
      
      
    };

    uploader.onBeforeUploadItem = function(item) {
        //console.info('onBeforeUploadItem', item);
      };
      uploader.onProgressItem = function(fileItem, progress) {
        //console.info('onProgressItem', fileItem, progress);
      };
      uploader.onProgressAll = function(progress) {
          //console.info('onProgressAll', progress);
          if(progress == 100){
            toaster.pop('success', 'E-Concours', "L'importation est terminée avec succès!");
          }   
        };
        uploader.onSuccessItem = function(fileItem, response, status) {
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
      // console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
      //  console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        //console.info('onCompleteItem', fileItem, response, status, headers);
      };
      uploader.onCompleteAll = function() {
      // console.info('onCompleteAll');
    };

    
    
    
    
    $scope.getElement=function(agent){

     
     $state.go('app.editFonctionnaire', { id : agent.idagent });

   };
   var load = function(){

     $rootScope.loader = true;

     $http.get(API_URL+'/agent/getListAgents/'+$rootScope.user)
     .success(function(response, status, headers, config) {

                        $scope.agents = response.data;
                        angular.copy($scope.agents, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = 20;
                        $scope.totalItems = $scope.agents.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = 20; //Number of pager buttons to show
                        $scope.setPage = function (pageNo) {
                          $scope.currentPage = pageNo;
                        };
                        $scope.pageChanged = function() {
                         // console.log('Page changed to: ' + $scope.currentPage);
                       };
                       $scope.setItemsPerPage = function(num) {
                        if(num === 'Tous'){
                          $scope.itemsPerPage = $scope.agents.length;
                        }else{
                          if($scope.viewby > $scope.agents.length ){
                            $scope.itemsPerPage =  $scope.agents.length;
                          }else{
                           $scope.itemsPerPage = num;
                         }
                       }
                     }
                     
                     $rootScope.loader = false;
                // console.log($rootScope.isProf);

                
              });
   };


   load();


   $scope.saveAgent = function() {
     $rootScope.loader = true;
     $http.post( API_URL + '/agent/add', 
     {
      
      'nom_complet':$scope.agent.nom_complet,
      'nom_complet_ar':$scope.agent.nom_complet_ar,
      'sexe':$scope.agent.sexe,
      'date_naiss': $filter('date')(new Date($scope.agent.date_naiss), 'yyyy-MM-dd'),
      'date_rec': $filter('date')(new Date($scope.agent.date_rec), 'yyyy-MM-dd'),
      'cin' : $scope.agent.cin,
      'etablissement_id' : $scope.agent.etab,
      'etablissement_ar' : $scope.agent.etab_ar,
      'grade_id' : $scope.agent.grade,
      'grade_ar' : $scope.agent.grade_ar,
      'specialite_ar' : $scope.agent.specialite_ar,
      'doti' : $scope.agent.doti,
      'created_by':$rootScope.user

    }).success(function(data, status, headers, config) {
      $rootScope.loader = false;
      toaster.pop('success','Information - status :'+status, '<br>'+data.messageShow+'<br><br>' + '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 0, 'trustedHtml', null, "note-toaster-container");

      
    })
    .error(function(data, status, headers, config) {
    });
    
  }
  

  



  
  
  
}]);

app.controller('AgentEditCtrl',['$scope', '$rootScope','$filter', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope,$filter, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;
  $scope.agent = {};


  $http.get(API_URL+'/agent/getAgentById/'+$stateParams.id)
  .success(function(response, status, headers, config) {
   

    $scope.agent.nom_complet = response.data.nom_complet;
    $scope.agent.idagent = $stateParams.id;
    $scope.agent.nom_complet_ar = response.data.nom_complet_ar; 
            //$scope.agent.type_agent = response.data.type_agent; 
           // $scope.agent.fonction = response.data.fonction; 
           $scope.agent.sexe = response.data.sexe; 
           $scope.agent.date_naiss =new Date(response.data.date_naiss) ; 
           $scope.agent.date_rec =new Date(response.data.date_rec) ; 
           $scope.agent.cin = response.data.cin; 
           $scope.agent.etab=  response.data.etablissement_id; 
           $scope.agent.etab_ar=  response.data.etablissement_ar; 
           $scope.agent.grade=  response.data.grade_id; 
           $scope.agent.grade_ar=  response.data.grade_ar; 
           $scope.agent.specialite_ar=  response.data.specialite_ar; 
           $scope.agent.doti=  response.data.doti; 
            //$scope.agent.email = response.usr_email;
            

          });

          /**
         *  Start saveChange function 
         *  saveChange function
         *  edit exists record
         *  id input param 
         **/
         $scope.saveChange=function(id){
          $rootScope.loader = true;
          $http({
            method:'POST',
            data:{

              'nom_complet':$scope.agent.nom_complet,
              'nom_complet_ar':$scope.agent.nom_complet_ar,
              'sexe':$scope.agent.sexe,
              'date_naiss': $filter('date')(new Date($scope.agent.date_naiss), 'yyyy-MM-dd'),
              'date_rec': $filter('date')(new Date($scope.agent.date_rec), 'yyyy-MM-dd'),
              'cin' : $scope.agent.cin,
              'etablissement_id' : $scope.agent.etab,
              'etablissement_ar' : $scope.agent.etab_ar,
              'grade_id' : $scope.agent.grade,
              'grade_ar' : $scope.agent.grade_ar,
              'specialite_ar' : $scope.agent.specialite_ar,
              'doti' : $scope.agent.doti,
              'created_by':$rootScope.user
            },
            url: API_URL + '/agent/edit/'+$stateParams.id
          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           toaster.pop('success','Information - status :'+status, '<br>'+data.messageShow+'<br><br>' + '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 0, 'trustedHtml', null, "note-toaster-container");


         })
          .error(function(data, status, headers, config) {
          });   
        }
         /**
         *  End saveChange function
         *
         **/

         
         
       }]);






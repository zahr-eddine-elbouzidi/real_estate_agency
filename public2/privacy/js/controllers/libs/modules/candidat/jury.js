app.controller('JuryCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   
  
   if($stateParams.id_hire === ''){
     $state.go('app.mes-candidatures');
   }

   /*$scope.tolist = [];
   $http.get(API_URL+'/agent/getListAgents').success(function(data, status, headers, config) {

    $scope.tolist = data.data;
    console.log($scope.tolist);



  });*/


  /* $scope.loadJury = function(){


     $http.get(API_URL+'/agent/getListAgents').success(function(data, status, headers, config) {

      $scope.tolist = data.data;
      console.log($scope.tolist);



    });

   };*/





   $scope.file = null;
   $scope.isEdited= false;


   $scope.getValue = function(){


    
    if($scope.file.idagent !== 0){


      $http.get(API_URL+'/agent/getAgentById/'+$scope.file.idagent).success(function(data, status, headers, config) {

        $scope.agent = data.data;
        $scope.file.nom_complet = data.data.nom_complet;
        $scope.file.etablissement = data.data.etablissement_id;
        $scope.file.specialite = data.data.specialite;
        if(data.data.nom_complet != null){
          $scope.isEdited= false;
        }else{
          $scope.isEdited= true;
        }
        


      });

      $scope.file.idagent = null;

    }
    

  };





  $scope.hireGet = {};
  $http.get(API_URL+'/hire/getHireByFile/'+$stateParams.id_file)
  .success(function(response, status, headers, config) {


   $scope.hireGet = response.data;
   $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');

 });


 /* $scope.postuled = {};
  $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
  .success(function(response, status, headers, config) {
   $scope.postuled = response.object;    


 });*/

  
  $scope.editerFiles = function(){
    $state.go('app.upload', { slug : 'divers' , id_hire :  $stateParams.id_hire});
    
  }; 


  $rootScope.loader = false;

  var loadFiles = function(){

    $scope.fileDatas = [];
    $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
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
                        $scope.viewby = 10;
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

  //loadFiles();
  


  
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

             $state.go('app.my-jury',{id_file : $stateParams.id_file});
             loadJurys();
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

  // /* !!!: Display data into data type  ERROOOOOOOOOOOOOOOOOOR*/
  // $scope.displayFile =  function(file_id){

  //   $rootScope.loader = true;
  //   $http.get(API_URL+'/candidat/getJury/'+$rootScope.user+'/'+file_id)
  //   .success(function(data, status, headers, config) {
  //     if(angular.isDefined(data.data)){
  //       $scope.jury = data.data;

  //                      // console.log($scope.jury);
  //                      $rootScope.loader = false;
  //       }
  //    });

  // }; 
  // /* !!!: END DATA DISPLAY */ 

  var loadJurys = function(){

    if($stateParams.id_file === ''){

         $state.go('app.mes-candidatures');

    }else{

     $http.get(API_URL+'/candidat/getJury/'+$rootScope.user+'/'+$stateParams.id_file)
      .success(function(data, status, headers, config) {

      if(angular.isDefined(data.data)){
        $scope.jury = data.data;
           $rootScope.loader = false;
        }
     }); 

    }
    

  };

  loadJurys();
  
  



  $scope.saveJury = function() {

   
    if($scope.file.nom_complet != null && $scope.file.nom_complet != ''){
      
      $rootScope.loader = true;
      $http.post( API_URL + '/candidat/saveJury', 
        
      {
        'nom_complet':$scope.file.nom_complet,
        'etablissement':$scope.file.etablissement,
        'specialite':$scope.file.specialite,
        'discipline':$scope.file.discipline,
        'file_id' : $stateParams.id_file,
        'status' : $scope.file.status,
        'mention':$scope.file.mention,                  
        'created_by':$rootScope.user
        
      }).success(function(data, status, headers, config) {

        $state.go('app.my-jury',{id_file : $stateParams.id_file});
        $scope.file.nom_complet = null;
        $scope.file.etablissement =  null;
        $scope.file.specialite =  null;
        $scope.file.discipline =  null;
        $scope.file.status =  null;
        $scope.file.mention =  null;
        $rootScope.loader = false;
        loadJurys();
        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
        
      }).error(function(data, status, headers, config) {
        $rootScope.loader = false;
      });
      
    }else{

      toaster.pop('error','Information', '<br>'+"Veuillez saisir les membre de jury"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      $rootScope.loader = false;
      

    }


    

    
    
  };

  
  

  
}]);


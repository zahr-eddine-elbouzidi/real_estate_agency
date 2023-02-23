 


app.controller('FiliereListCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
  
   $rootScope.loader = false;
   
   

   
   
   

   var load = function() {

    $rootScope.loader = true;


    $http.get(API_URL+'/filieres/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
                        $rootScope.loader = false;
                        $scope.filieres = data.data;
                        angular.copy($scope.filieres, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =  $scope.filieres.length;
                        $scope.totalItems = $scope.filieres.length;
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
                          $scope.itemsPerPage = $scope.filieres.length;
                        }else{
                          if($scope.viewby > $scope.filieres.length ){

                            $scope.itemsPerPage =  $scope.filieres.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }    
                     

                   });
  }


  $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
    
    $scope.etablissements = data.data;
    
  });
  
  


  load();

  $scope.deleteFiliere = function(id) {
    

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()

                      $rootScope.loader = true;    
                      $http({
                        method:'DELETE',
                        url: API_URL+ '/filieres/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        load();
                        $location.path('/app/filieres');
                        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");
                      })
                      .error(function(data, status, headers, config) {
                               //toaster.pop('error', 'Message', "Erreur détecté.");
                               $rootScope.loader = false;
                             });

                      $modalDiv.addClass('loading');
                      setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
      var data = $(e.relatedTarget).data();
      $('.title', this).text(data.recordTitle);
      $('.btn-ok', this).data('recordId', data.recordId);
    });
  }





  $scope.saveFiliere = function() {
   $rootScope.loader = true;
   



   if($scope.filiere.etablissement_id===undefined){
    
    toaster.pop('error', 'Message', "Veuillez séléctionner un établissement.");
    
  }else{

    $http.post(API_URL + '/filieres/add', 
    {

      'nom_filiere':$scope.filiere.nom_filiere,
      'etablissement_id':$scope.filiere.etablissement_id,
      'created_by':$rootScope.user

    }).success(function(data, status, headers, config) {

      $rootScope.loader = false;

      if(data.drap==false){

       toaster.pop('warning','Information', '<br>'+"Filière existe déjà !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");



     }else if(data.drap==true ){
      
      load();
      
      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      
      $location.path('/app/filieres');    

    }
  })
    .error(function(data, status, headers, config) {
     
      $rootScope.loader = false;
      toaster.pop('error','Information', '<br>'+"Erreur détecté !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
    });
  }

  

}




$scope.getElement=function(filiere){

 
  $state.go('app.editFiliere', { id : filiere.id_filiere });
 
 };

 $scope.getCalendrier=function(filiere){

 
  $state.go('app.calendrier', { id : filiere.id_filiere });
 
 };
  




}]);


 




 app.controller('FiliereEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
   'ServiceTranslate','FileUploader','API_URL','toaster', 
   function($scope, $rootScope, $http,$state,$stateParams, $location,
     $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
    
     $rootScope.loader = false;
     
     
     
     
     


     

     $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $scope.etablissements = data.data;
      
    });


     $http.get(API_URL+'/filieres/getFiliere/'+$stateParams.id)
     .success(function(response, status, headers, config) {
      $scope.filiereEdit = response.data;
      $scope.filiereEdit.nom_filiere = response.data.nom_filiere;
      $scope.filiereEdit.etablissement_id = response.data.etablissement_id;
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
              'nom_filiere':$scope.filiereEdit.nom_filiere,
              'etablissement_id':$scope.filiereEdit.etablissement_id,
              'created_by':$rootScope.user,
              'filename' : null
            },
            url: API_URL + '/filieres/edit/'+id

          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           if(data.drap==true){

             toaster.pop('warning','Information', '<br>'+"Sous-catégorie existe déjà !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");


           }else if(data.drap==false ){
            
            
            
            toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
            $state.go('app.filieres');

          }

        })
          .error(function(data, status, headers, config) {
           $rootScope.loader = false;
         });   
        }
         /**
         *  End saveChange function
         *
         **/


       }]);


 
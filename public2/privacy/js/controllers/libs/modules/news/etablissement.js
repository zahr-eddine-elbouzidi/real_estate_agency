 


app.controller('EtablissementListCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
  
   $rootScope.loader = false;
   
   

   
   
   

   var load = function() {

    $rootScope.loader = true;


    $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $rootScope.loader = false;

      $scope.etablissements = data.data;
      angular.copy($scope.etablissements, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = 5;
                        $scope.totalItems = $scope.etablissements.length;
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
                          $scope.itemsPerPage = $scope.etablissements.length;
                        }else{
                          if($scope.viewby > $scope.etablissements.length ){

                            $scope.itemsPerPage =  $scope.etablissements.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }    
                     

                   });
  }


  $http.get(API_URL+'/university/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
    
    $scope.universities = data.data;
    
  });
  
  


  load();

  $scope.deleteEtablissement = function(id) {
    

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()

                      $rootScope.loader = true;    
                      $http({
                        method:'DELETE',
                        url: API_URL+ '/etablissement/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        load();
                        $location.path('/app/etablissement');
                        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");
                      })
                      .error(function(data, status, headers, config) {
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





  $scope.saveEtablissement = function() {
   $rootScope.loader = true;
   



   if($scope.etablissement.university_id===undefined){
    
    
     toaster.pop('error','Information', '<br>'+"Veuillez séléctionner une université !"+'<br><br>' + 
      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
      0, 'trustedHtml', null, "note-toaster-container");
     
   }else{

    $http.post(API_URL + '/etablissement/add', 
    {

      'etablissement_code': $scope.etablissement.etablissement_code,
      'etablissement_name': $scope.etablissement.etablissement_name,
      'university_id':$scope.etablissement.university_id,
      'created_by':$rootScope.user
    }).success(function(data, status, headers, config) {

      $rootScope.loader = false;

      if(data.drap==false && data.mustUpload == true){

       
       
       
       toaster.pop('warning','Information', '<br>'+"Etablissement existe déjà !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");



     }else if (data.mustUpload == false){
      
       toaster.pop('warning','Information', '<br>'+"Veuillez importer une image !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
       
     }else if(data.drap==true && data.mustUpload == true ){
      
      load();
      
      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      
      $location.path('/app/etablissement');    

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




$scope.getElement=function(etablissement){

 
 $state.go('app.editEtablissement', { id : etablissement.etablissement_id });

};





}]);


 




 app.controller('EtablissementEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
   'ServiceTranslate','FileUploader','API_URL','toaster', 
   function($scope, $rootScope, $http,$state,$stateParams, $location,
     $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
    
     $rootScope.loader = false;
     
     
     
     
     


     

     $http.get(API_URL+'/university/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $scope.universities = data.data;
      
    });

     
     
     

     
     $http.get(API_URL+'/etablissement/getEtablissement/'+$stateParams.id)
     .success(function(response, status, headers, config) {
      $scope.etablissementEdit = response.data;
      $scope.etablissementEdit.etablissement_code = response.data.etablissement_code;
      $scope.etablissementEdit.etablissement_name = response.data.etablissement_name;
      $scope.etablissementEdit.university_id = response.data.university_id;
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
              'etablissement_code':$scope.etablissementEdit.etablissement_code,
              'etablissement_name':$scope.etablissementEdit.etablissement_name,
              'university_id':$scope.etablissementEdit.university_id,
              'created_by':$rootScope.user
            },
            url: API_URL + '/etablissement/edit/'+id

          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           if(data.drap==true && data.mustUpload == false){

             

             toaster.pop('warning','Information', '<br>'+"Etablissement existe déjà !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");



           }else if (data.mustUpload == true){
            
            toaster.pop('warning','Information', '<br>'+"Veuillez importer une image !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
          }else if(data.drap==false && data.mustUpload == false ){
            
            
            
           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
           
           $state.go('app.etablissement');

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


 
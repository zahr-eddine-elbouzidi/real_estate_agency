 


app.controller('SubCategoryListCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
  
   $rootScope.loader = false;
   
   

   
   
   

   var load = function() {

    $rootScope.loader = true;


    $http.get(API_URL+'/subcategory/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $rootScope.loader = false;

                        $scope.sub_categories = data.data;
                        angular.copy($scope.sub_categories, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =  $scope.sub_categories.length;
                        $scope.totalItems = $scope.sub_categories.length;
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
                          $scope.itemsPerPage = $scope.sub_categories.length;
                        }else{
                          if($scope.viewby > $scope.sub_categories.length ){

                            $scope.itemsPerPage =  $scope.sub_categories.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }    
                     

                   });
  }


  $http.get(API_URL+'/category/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
    
    $scope.categories = data.data;
    
  });
  
  


  load();

  $scope.deleteType = function(id) {
    

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()

                      $rootScope.loader = true;    
                      $http({
                        method:'DELETE',
                        url: API_URL+ '/subcategory/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        load();
                        $location.path('/app/type');
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





  $scope.saveType = function() {
   $rootScope.loader = true;
   



   if($scope.type.categorie_id===undefined){
    
    toaster.pop('error', 'Message', "Veuillez séléctionner une catégorie.");
    
  }else{

    $http.post(API_URL + '/subcategory/add', 
    {

      'sub_name_fr':$scope.type.sub_name_fr,
      'sub_name_eng':$scope.type.sub_name_eng,
      'sub_name_ar':$scope.type.sub_name_ar,
      'sub_level':$scope.type.sub_level,
      'sub_category_id':$scope.type.categorie_id,
      'sub_enabled':$scope.type.sub_enabled,
      'created_by':$rootScope.user

    }).success(function(data, status, headers, config) {

      $rootScope.loader = false;

      if(data.drap==false){

       toaster.pop('warning','Information', '<br>'+"Sous-catégorie existe déjà !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");



     }else if(data.drap==true ){
      
      load();
      
      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      
      $location.path('/app/type');    

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




$scope.getElement=function(type){

 
 $state.go('app.editSubCategory', { id : type.id });

};





}]);


 




 app.controller('SubCatEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
   'ServiceTranslate','FileUploader','API_URL','toaster', 
   function($scope, $rootScope, $http,$state,$stateParams, $location,
     $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
    
     $rootScope.loader = false;
     
     
     
     
     


     

     $http.get(API_URL+'/category/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $scope.categories = data.data;
      
    });


     $http.get(API_URL+'/subcategory/getSubCategory/'+$stateParams.id)
     .success(function(response, status, headers, config) {
      $scope.subCategoryEdit = response.data;
      $scope.subCategoryEdit.sub_name_fr = response.data.sub_name_fr;
      $scope.subCategoryEdit.sub_name_eng = response.data.sub_name_eng;
      $scope.subCategoryEdit.sub_name_ar = response.data.sub_name_ar;
      $scope.subCategoryEdit.sub_level = response.data.sub_level;
      if(response.data.sub_enabled ==="1"){
        $scope.subCategoryEdit.sub_enabled = true;
      }else{
        $scope.subCategoryEdit.sub_enabled = false;
      }
      $scope.subCategoryEdit.categorie_id = response.data.sub_category_id;
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
              'sub_name_fr':$scope.subCategoryEdit.sub_name_fr,
              'sub_name_eng':$scope.subCategoryEdit.sub_name_eng,
              'sub_name_ar':$scope.subCategoryEdit.sub_name_ar,
              'sub_level': $scope.subCategoryEdit.sub_level,
              'sub_category_id':$scope.subCategoryEdit.categorie_id,
              'created_by':$rootScope.user,
              'sub_enabled':$scope.subCategoryEdit.sub_enabled,
              'filename' : null
            },
            url: API_URL + '/subcategory/edit/'+id

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
            
            $state.go('app.type');

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


 
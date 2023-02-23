 


app.controller('FormuleListCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
  
   $rootScope.loader = false;
   
   

   
   
    

   var load = function() {

    $rootScope.loader = true;


    $http.get(API_URL+'/formule/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
                        $rootScope.loader = false;
                        $scope.formules = data.data;
                        angular.copy($scope.formules, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = 5;
                        $scope.totalItems = $scope.formules.length;
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
                          $scope.itemsPerPage = $scope.formules.length;
                        }else{
                          if($scope.viewby > $scope.formules.length ){

                            $scope.itemsPerPage =  $scope.formules.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }    
                     

                   });
  }


  $http.get(API_URL+'/categorie/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
    
    $scope.categories = data.data;
    
  });
  
  


  load();

  $scope.deleteFormule = function(id) {
    

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()

                      $rootScope.loader = true;    
                      $http({
                        method:'DELETE',
                        url: API_URL+ '/formule/delete/'+id+'/'+$rootScope.user
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





  $scope.saveFormule = function() {
   $rootScope.loader = true;
   



   if($scope.formule.category_id===undefined){
    
    toaster.pop('error', 'Message', "Veuillez séléctionner une catégorie.");
    
  }else{

    $http.post(API_URL + '/formule/add', 
    {

      'coeff_spe':$scope.formule.coeff_spe,
      'coeff_gen':$scope.formule.coeff_gen,
      'coeff_ora':$scope.formule.coeff_ora,
      'pass_note':$scope.formule.pass_note,
      'pass_note_finale':$scope.formule.pass_note_finale,
      'category_id':$scope.formule.category_id,
      'created_by':$rootScope.user

    }).success(function(data, status, headers, config) {

      $rootScope.loader = false;

      if(data.drap==false && data.mustUpload == true){

       

       
       
       toaster.pop('warning','Information', '<br>'+"Sous-catégorie existe déjà !"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");



     }else if (data.mustUpload == false){
      
       
       
      toaster.pop('warning','Information', '<br>'+"Veuillez importer une image!"+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      
      
    }else if(data.drap==true && data.mustUpload == true ){
      
      load();
      
      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
      
      $location.path('/app/formule');    

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




$scope.getElement=function(formule){

 
 $state.go('app.editFormule', { id : formule.id });

};





}]);


 




 app.controller('FormuleEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
   'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope, $http,$state,$stateParams, $location,
     $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
    
     $rootScope.loader = false;
     

     $http.get(API_URL+'/categorie/getList/'+$rootScope.user).success(function(data, status, headers, config) {
      
      
      $scope.categories = data.data;
      
    });

     
     
     

     
     $http.get(API_URL+'/formule/getFormule/'+$stateParams.id)
     .success(function(response, status, headers, config) {
      $scope.formuleEdit = response.data;
      $scope.formuleEdit.coeff_spe = response.data.coeff_spe;
      $scope.formuleEdit.coeff_gen = response.data.coeff_gen;
      $scope.formuleEdit.coeff_ora = response.data.coeff_ora;
      $scope.formuleEdit.pass_note = response.data.pass_note;
      $scope.formuleEdit.pass_note_finale = response.data.pass_note_finale;
      $scope.formuleEdit.categorie_id = response.data.category_id;
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
              'coeff_spe':$scope.formuleEdit.coeff_spe,
              'coeff_gen':$scope.formuleEdit.coeff_gen,
              'coeff_ora':$scope.formuleEdit.coeff_ora,
              'pass_note':$scope.formuleEdit.pass_note,
              'pass_note_finale':$scope.formuleEdit.pass_note_finale,
              'category_id':$scope.formuleEdit.categorie_id,
              'created_by':$rootScope.user
            },
            url: API_URL + '/formule/edit/'+id

          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           if(data.drap==true && data.mustUpload == false){

             

             toaster.pop('warning','Information', '<br>'+"Sous-catégorie existe déjà !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");


           }else if (data.mustUpload == true){
            
            toaster.pop('warning','Information', '<br>'+"Veuillez importer une image!"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
            
          }else if(data.drap==false && data.mustUpload == false ){
            
            
            
            toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
            $state.go('app.formule');

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


 
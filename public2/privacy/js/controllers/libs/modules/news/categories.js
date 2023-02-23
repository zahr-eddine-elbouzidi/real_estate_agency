 
 ////////////////////////////////////// BEGIN Add Caegory Controller ///////////////////////////////////////////////////////

 app.controller('CatListCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    $rootScope.loader = false;

    $scope.array = ServiceTranslate.personalTranslateLang();

        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
         $rootScope.loader = true;
         $http.get(API_URL+'/category/getList/'+$rootScope.user).
         success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        $scope.categories = data.data;
                        angular.copy($scope.categories, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = $scope.categories.length;
	                      $scope.totalItems = $scope.categories.length;
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
                        $scope.itemsPerPage = $scope.categories.length;
                      }else{
                        if($scope.viewby > $scope.categories.length ){
                          $scope.itemsPerPage =  $scope.categories.length;
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

        
         /**
         *
         * start deleteCategorie function
         *  delete record
         *  id input param
         **/ 
         $scope.deleteCategorie = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/category/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/categorie');

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
        /**
         *
         * End deleteCategorie function
         **/



         $scope.getElement=function(category){

           
           $state.go('app.editCategory', { id : category.id });

         };


        /**
        *
        * start saveCategorie function
        * add a new record 
        *
        **/
        $scope.saveCategorie = function() {
         $rootScope.loader = true;
         console.log($scope.cat);
         $http.post( API_URL + '/category/add', 
         {
          'name_fr':$scope.cat.name_fr,
          'name_eng':$scope.cat.name_eng,
          'name_ar':$scope.cat.name_ar,
          'level_cat':$scope.cat.level_cat,
          'enabled':$scope.cat.enabled,
          'created_by':$rootScope.user,
          'filename' : null
        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          if(data.drap==false && data.mustUpload == true){
           toaster.pop('warning','Information', '<br>'+"Catégorie existe déjà !"+'<br><br>' + 
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
          $location.path('/app/categorie');    
        }
      })
        .error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });
        
      }
         /**
         *  End saveCategorie function
         *
         **/

         
       }]);

 ////////////////////////////////////// END Add Caegory Controller ///////////////////////////////////////////////////////

////////////////////////////////////// BEGIN Edit Caegory Controller ///////////////////////////////////////////////////////

app.controller('CatEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;
  
  $http.get(API_URL+'/category/getCategory/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.categoryEdit = response.data;
    $scope.categoryEdit.name_fr = response.data.name_fr;
    $scope.categoryEdit.name_eng = response.data.name_eng;
    $scope.categoryEdit.name_ar = response.data.name_ar;
    $scope.categoryEdit.level_cat = response.data.level_cat;
    if(response.data.enabled === '1'){
      $scope.categoryEdit.enabled = true;
    }else{
      $scope.categoryEdit.enabled=false;
    }

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
              'name_fr':$scope.categoryEdit.name_fr,
              'name_eng':$scope.categoryEdit.name_eng,
              'name_ar':$scope.categoryEdit.name_ar,
              'level_cat':$scope.categoryEdit.level_cat,
              'enabled':$scope.categoryEdit.enabled,
              'created_by':$rootScope.user
            },
            url: API_URL + '/category/edit/'+id
          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           if(data.drap==true && data.mustUpload == false){
            toaster.pop('warning','Information', '<br>'+"Catégorie existe déjà !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
          }else if(data.drap==false && data.mustUpload == false ){
           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
           $state.go('app.categorie');
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



////////////////////////////////////// END Edit Caegory Controller ///////////////////////////////////////////////////////





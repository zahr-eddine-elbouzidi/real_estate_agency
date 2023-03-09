 


app.controller('FileCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
'ServiceTranslate','FileUploader','API_URL','toaster', 
function($scope, $rootScope, $http,$state,$stateParams, $location,
  $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
 

    $rootScope.loader = false;



  
  
  $scope.addImage=function(){

   
    $state.go('app.addFile',{id : $stateParams.id});

 } 
  
  
  

  var load = function() {

   $rootScope.loader = true;


   $http.get(API_URL+'/files/getListByPost/'+$stateParams.id).success(function(data, status, headers, config) {
     
     
                       $rootScope.loader = false;

                       $scope.files = data.data;
                       angular.copy($scope.files, $scope.copy);
                       $scope.sortType     = 'nom'; // set the default sort type
                       $scope.sortReverse  = false;  // set the default sort order
                       $scope.searchFish   = ''; 
                       $scope.viewby =  $scope.files.length;
                       $scope.totalItems = $scope.files.length;
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
                         $scope.itemsPerPage = $scope.files.length;
                       }else{
                         if($scope.viewby > $scope.files.length ){

                           $scope.itemsPerPage =  $scope.files.length;
                           
                         }else{
                          $scope.itemsPerPage = num;
                        }
                        
                      }
                    }    
                    

                  });
 }


  


 load();

 $scope.deleteImage = function(id) {
   

   $('#confirm-delete').on('click', '.btn-ok', function(e) {
     var $modalDiv = $(e.delegateTarget);
     var id = $(this).data('recordId');
                     //console.log(id);
                     // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                     // $.post('/api/record/' + id).then()

                     $rootScope.loader = true;    
                     $http({
                       method:'DELETE',
                       url: API_URL+ '/files/delete/'+id+'/'+$rootScope.user
                     }).success(function(data, status, headers, config) {
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/files');
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




 




$scope.getElement=function(type){


$state.go('app.editSubCategory', { id : type.id_subcat });

};





}]);



app.controller('AddFileCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', 
  function($scope, $rootScope, $http,$state,$stateParams, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   
    $rootScope.loader = false;
    
    
    
    
    
    //file uupload begin //


    var uploader = $scope.uploader = new FileUploader({
          
        url: API_URL+'/files/upload/'+$rootScope.user
  
  
   });
  
   $scope.uploadImage = function (item) {
    item.formData.push({title: 'my_custom_image'});
    item.upload();
  };
  
   // FILTERS
  
   // a sync filter
   uploader.filters.push({
       name: 'syncFilter',
       fn: function(item /*{File|FileLikeObject}*/, options) {
          // console.log('syncFilter');
           return this.queue.length < 1;
       }
   });
  
  
  
  uploader.clear = function(){
  
     $("#file_upload").val(null);
     uploader.clearQueue();
     $scope.filename = undefined;
     $scope.invalidate = true;
     $scope.hasError = false;
  
  
   }  
  
  
  
   // CALLBACKS
  
   uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
       //console.info('onWhenAddingFileFailed', item, filter, options);
   };
   uploader.onAfterAddingFile = function(fileItem) {
       
  
      //  console.info($scope.loading);
  
       ///$scope.invalidate = false;
    };
   uploader.onAfterAddingAll = function(addedFileItems) {
       
       //$scope.verifications = false;
      // console.info('onAfterAddingAll', addedFileItems[0]._file);
  
     
  
  
  
     var fd = new FormData();
  
       var file = addedFileItems[0]._file;
  
       fd.append('file' , file);
  
  
       
     
           //BEGIN
  
              $http.post( API_URL + '/files/checkUpload/'+$rootScope.user+'/my_custom_image', fd,
              {
              
              transformRequest: angular.identity,
  
              headers: {'Content-Type': undefined}
  
              }
          ).success(function(data, status, headers, config) {
  
  
                      if(data.messagefileImage == -1){
  
                        $scope.filename = null;	 
                        $scope.invalidate = true;
                              
                            if($rootScope.selectLang == 'French'){
                            toaster.pop('error', 'Message', "Type d'image est incorrect");
                          }else{
                            toaster.pop('error', 'Message', "Faild image type.");
                          }
                                    
  
                      }else{
                        $scope.invalidate = false;
                        $scope.filename = data.filename;
                      } 
  
                    //  console.log($scope.filename);
                    
          })
          .error(function(data, status, headers, config) {
  
                if($rootScope.selectLang == 'French'){
                        toaster.pop('error', 'Message', "Erreur");
                      }else{
                        toaster.pop('error', 'Message', "Error");
                      }
            });
  
      //END
  
  
     
  
     
  
   };
  
  
  
   
   uploader.onBeforeUploadItem = function(item) {
       //console.info('onBeforeUploadItem', item);
  
   };
   uploader.onProgressItem = function(fileItem, progress) {
       //console.info('onProgressItem', fileItem, progress);
        if(progress == 100){
           //messageBox('success', "L'importation s'est terminée avec succès.");
       }
   };
   uploader.onProgressAll = function(progress) {
         //load();
        // console.info('onProgressAll', progress);
   };
   uploader.onSuccessItem = function(fileItem, response, status, headers) {
       console.info('onSuccessItem', fileItem, response, status, headers);
      // console.log(response);
   };
   uploader.onErrorItem = function(fileItem, response, status, headers) {
      // console.info('onErrorItem', fileItem, response, status, headers);
   };
   uploader.onCancelItem = function(fileItem, response, status, headers) {
     //  console.info('onCancelItem', fileItem, response, status, headers);
   };
   uploader.onCompleteItem = function(fileItem, response, status, headers) {
       console.info('onCompleteItem', fileItem, response, status, headers);
   };
   uploader.onCompleteAll = function() {
      // console.info('onCompleteAll');
   };
  
  
      //end file upload //

     

    

        /**
        *  Start saveChange function 
        *  saveChange function
        *  edit exists record
        *  id input param 
        **/
        $scope.saveImage=function(){

         $rootScope.loader = true;
         $http({

           method:'POST',
           data:{
             'post_id':$stateParams.id,
             'created_by':$rootScope.user,
             'filename' : $scope.filename 
           },
           url: API_URL + '/files/add'

         }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          if(data.drap==false){

            toaster.pop('warning','Information', '<br>'+"Image existe déjà !"+'<br><br>' + 
             '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
             0, 'trustedHtml', null, "note-toaster-container");


          }else if(data.drap==false ){
           
           
           
           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
             '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
             0, 'trustedHtml', null, "note-toaster-container");
           
           $state.go('app.files');

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



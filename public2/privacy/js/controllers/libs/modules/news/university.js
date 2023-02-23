 
 ////////////////////////////////////// BEGIN Add Caegory Controller ///////////////////////////////////////////////////////

 app.controller('UniversityListCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    $rootScope.loader = false;

    $scope.array = ServiceTranslate.personalTranslateLang();

    var uploader = $scope.uploader = new FileUploader({
          
          url: API_URL+'/university/upload/'+$rootScope.user


     });

 
 
     // FILTERS
   
     // a sync filter
     uploader.filters.push({
         name: 'syncFilter',
         fn: function(item /*{File|FileLikeObject}*/, options) {
             console.log('syncFilter');
             return this.queue.length < 10;
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

          $http.post( API_URL + '/university/checkUpload/'+$rootScope.user, fd,
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

                             console.log($scope.filename);
                           
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
             load();
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

    // console.info('uploader', uploader);

        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
         $rootScope.loader = true;
         $http.get(API_URL+'/university/getList/'+$rootScope.user).
         success(function(data, status, headers, config) {
          $rootScope.loader = false;
          $scope.universities = data.data;
          angular.copy($scope.universities, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = 5;
	                      $scope.totalItems = $scope.universities.length;
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
                        $scope.itemsPerPage = $scope.universities.length;
                      }else{
                        if($scope.viewby > $scope.universities.length ){
                          $scope.itemsPerPage =  $scope.universities.length;
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
         $scope.deleteUniversity = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/university/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/university');

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



         $scope.getElement=function(university){

           
           $state.go('app.editUniversity', { id : university.university_id });

         };


        /**
        *
        * start saveCategorie function
        * add a new record 
        *
        **/
        $scope.saveUniversity = function() {
         $rootScope.loader = true;
         


         if($scope.filename == undefined || $scope.filename == ''){

                        if($rootScope.selectLang == 'French'){
                                     toaster.pop('warning', 'Message', "Veuillez choisir une image!");
                                }else{
                                     toaster.pop('warning', 'Message', "Please choose a image");
                                }


       }else{


         $http.post( API_URL + '/university/add', 
         {
          'university_code':$scope.university.university_code,
          'university_name':$scope.university.university_name,
          'university_name_ar':$scope.university.university_name_ar,
          'created_by':$rootScope.user,
          'filename' : $scope.filename
        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          if(data.drap==false && data.mustUpload == true){
           
            toaster.pop('warning','Information', '<br>'+"Université existe déjà !"+'<br><br>' + 
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
            $location.path('/app/university');    
          }
        })
        .error(function(data, status, headers, config) {
          $rootScope.loader = false;
        });

      }

        
      }
         /**
         *  End saveCategorie function
         *
         **/

         
       }]);

 ////////////////////////////////////// END Add Caegory Controller ///////////////////////////////////////////////////////

////////////////////////////////////// BEGIN Edit Caegory Controller ///////////////////////////////////////////////////////

app.controller('UniversityEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;

    var uploader = $scope.uploader = new FileUploader({
          
          url: API_URL+'/university/upload/'+$rootScope.user


     });

 
 
     // FILTERS
   
     // a sync filter
     uploader.filters.push({
         name: 'syncFilter',
         fn: function(item /*{File|FileLikeObject}*/, options) {
             console.log('syncFilter');
             return this.queue.length < 10;
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
         
        $scope.loading = true;

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

          $http.post( API_URL + '/university/checkUpload/'+$rootScope.user, fd,
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

    // console.info('uploader', uploader);

  
  $http.get(API_URL+'/university/getUniversity/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.universityEdit = response.data;
    $scope.universityEdit.university_code = response.data.university_code;
    $scope.universityEdit.university_name = response.data.university_name;
    $scope.universityEdit.university_name_ar = response.data.university_name_ar;

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
              'university_code':$scope.universityEdit.university_code,
              'university_name':$scope.universityEdit.university_name,
              'university_name_ar':$scope.universityEdit.university_name_ar,
              'created_by':$rootScope.user,
              'filename' : $scope.filename
            },
            url: API_URL + '/university/edit/'+id
          }).success(function(data, status, headers, config) {
           $rootScope.loader = false;
           if(data.drap==true && data.mustUpload == false){
             
             toaster.pop('warning','Information', '<br>'+"Université existe déjà !"+'<br><br>' + 
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
            
            $state.go('app.university');
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





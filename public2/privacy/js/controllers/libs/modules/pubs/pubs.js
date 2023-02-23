app.controller('PubsCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster','$sce','$filter', function($scope, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster,$sce,$filter) {
   

  $rootScope.loader = false;

    //file uupload begin //


    var uploader = $scope.uploader = new FileUploader({
          
      url: API_URL+'/posts/upload/'+$rootScope.user


 });

 $scope.uploadImage = function (item) {
  item.formData.push({title: $scope.pub.title});
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


     
    
    if($scope.pub.title === undefined || $scope.pub.title === ''){

    }else{
         //BEGIN

            $http.post( API_URL + '/posts/checkUpload/'+$rootScope.user+'/'+$scope.pub.title, fd,
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


    }

   

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


    //end file upload //





     $scope.returnText = function(post_content) {
        return $sce.trustAsHtml($filter('limitTo')(post_content, 200));
     };



     $http.get(API_URL+'/subcategory/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
      $scope.subcategories = data.data;
      
    });
    
  
  $scope.publications = {};
  var load = function(){

   $rootScope.loader = true;
 

   $http.get(API_URL+'/posts/getList/'+$rootScope.user)
    .success(function(response, status, headers, config) {
     
     
                        $scope.posts = response.data;
                        $rootScope.loader = false;
                        angular.copy($scope.posts, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.posts.length;
                        $scope.totalItems = $scope.posts.length;
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
                          $scope.itemsPerPage = $scope.posts.length;
                        }else{
                          if($scope.viewby > $scope.posts.length ){

                            $scope.itemsPerPage =  $scope.posts.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
 };


 
  
 load();

 


  $scope.tinymceOptions = {
          onChange: function(e) {
            // put logic here for keypress and cut/paste changes
          },
          inline: false,
          selector: "textarea",theme: "modern",height: 250,
          plugins : 'advlist autolink link image lists charmap print preview',
          skin: 'lightgray',
          theme : 'modern',
            plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youTube"
         ],
           relative_urls: false,
           remove_script_host : false,
           toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
           toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | youTube",
           image_advtab: true ,
           images_upload_base_path: API_URL+'/js/',
           external_filemanager_path:API_URL+"/js/filemanager/",
           filemanager_title:"Responsive Filemanager" ,
           external_plugins: { "filemanager" : API_URL+"/js/filemanager/plugin.min.js"}
      };

        /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.savePub = function() {

          
         $rootScope.loader = true;
         
         
         $http.post( API_URL + '/posts/add', 
         {
          'type':$scope.pub.type,
          'title':$scope.pub.title,
          'content':$scope.tinymceModel,                          
          'enabled':$scope.pub.enabled, 
          'level':$scope.pub.level, 
          'important_msg':$scope.pub.important_msg, 
          'subcategory_id' : $scope.pub.subcategory_id,                         
          'created_by':$rootScope.user,
          'filename' : $scope.filename
         }).success(function(data, status, headers, config) {

          $rootScope.loader = false;
          load();

          if(data.drap == true){
              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");    
          }else{
              toaster.pop('error','Duplication', '<br>'+"La publication est déjà existe !"+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");    
          }
          $location.path('/app/publications');
              
         })
         .error(function(data, status, headers, config) {
           $rootScope.loader = false;
         });

        


        
      };


      $scope.getElement=function(pub){

            $scope.currentPost= pub;
            $state.go('app.editpub',{id : pub.id_post});
 
         } 


  
         $scope.deletePub = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/posts/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/publications');

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
   
      

      
    }]);

 

 app.controller('EditPubsCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster','$sce','$filter', function($scope, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster,$sce,$filter) {
   

    $rootScope.loader = false;

    //file uupload begin //


    var uploader = $scope.uploader = new FileUploader({
          
      url: API_URL+'/posts/upload/'+$rootScope.user


 });

 $scope.uploadImage = function (item) {
  item.formData.push({title: $scope.pub.title});
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


     
    
    if($scope.pub.title === undefined || $scope.pub.title === ''){

    }else{
         //BEGIN

            $http.post( API_URL + '/posts/checkUpload/'+$rootScope.user+'/'+$scope.pub.title, fd,
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


    }

   

 };



 
 uploader.onBeforeUploadItem = function(item) {
     //console.info('onBeforeUploadItem', item);

 };
 uploader.onProgressItem = function(fileItem, progress) {
     //console.info('onProgressItem', fileItem, progress);
      if(progress == 100){
         //load();
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





     $scope.returnText = function(post_content) {
        return $sce.trustAsHtml($filter('limitTo')(post_content, 200));
     };





     $scope.returnText = function(post_content) {
        return $sce.trustAsHtml($filter('limitTo')(post_content, 200));
     };


     $http.get(API_URL+'/subcategory/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
      $scope.subcategories = data.data;
      
    });
    

  $scope.tinymceOptions = {
          onChange: function(e) {
            // put logic here for keypress and cut/paste changes
          },
          inline: false,
          selector: "textarea",theme: "modern",height: 250,
          plugins : 'advlist autolink link image lists charmap print preview',
          skin: 'lightgray',
          theme : 'modern',
            plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak",
             "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
             "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youTube"
         ],
           relative_urls: false,
           remove_script_host : false,
           toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
           toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | youTube",
           image_advtab: true ,
           images_upload_base_path: API_URL+'/js/',
           external_filemanager_path:API_URL+"/js/filemanager/",
           filemanager_title:"Responsive Filemanager" ,
           external_plugins: { "filemanager" : API_URL+"/js/filemanager/plugin.min.js"}
      };



       $scope.pub = {};

      $http.get(API_URL+'/posts/getPost/'+$stateParams.id)
        .success(function(response, status, headers, config) {


          $scope.pub = response.data;
          $scope.pub.type = response.data.type;
          $scope.pub.title = response.data.title;
          $scope.pub.content = response.data.content;
          $scope.pub.level = response.data.level;
          $scope.pub.important_msg = response.data.important_msg;

          if(response.data.enabled === "1"){
            $scope.pub.enabled = true;
          }else{
            $scope.pub.enabled = false;
          }

        });



        /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.savePub = function() {

          
         $rootScope.loader = true;
         
         
         $http.post( API_URL + '/posts/edit/'+$stateParams.id, 
         {
          'type':$scope.pub.type,
          'title':$scope.pub.title,
          'content':$scope.pub.content,                          
          'enabled':$scope.pub.enabled, 
          'level':$scope.pub.level, 
          'important_msg':$scope.pub.important_msg, 
          'subcategory_id' : $scope.pub.subcategory_id,                         
          'created_by':$rootScope.user,
          'filename' : $scope.filename
         }).success(function(data, status, headers, config) {

          $rootScope.loader = false;
          

          if(data.drap == true){
              toaster.pop('error','Duplication', '<br>'+"La charte est déjà existe !"+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");  
          }else{
             
              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");     
          }
          $location.path('/app/publications');
              
         })
         .error(function(data, status, headers, config) {
           $rootScope.loader = false;
         });

        


        
      };


      $scope.getElement=function(pub){

            $scope.currentPost= pub;
            $state.go('app.editpub',{id : pub.publication_id});
 
         } 

 

      
    }]);

 
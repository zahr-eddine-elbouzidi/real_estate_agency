app.controller('FileUploadCtrl', ['$scope', '$rootScope', '$http','$state', '$location','$timeout',
     'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope, $http,$state, $location,
             $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
     $rootScope.loader = false;

      $scope.array = ServiceTranslate.personalTranslateLang();



     /* $scope.uploadFile = function(){

         var fd = new FormData();

         var file = $scope.Lfile;

         fd.append('file' , file);

        alert(fd);

      }*/


 

     /* $scope.pdfName = 'Relativity: The Special and General Theory by Albert Einstein';
      $scope.pdfUrl = "zahrScan.PDF";
      $scope.pdfPassword = 'test';
      $scope.scroll = 0;
      $scope.loading = 'loading';

      $scope.getNavStyle = function(scroll) {
        if(scroll > 100) return 'pdf-controls fixed';
        else return 'pdf-controls';
      }

      $scope.onError = function(error) {
        console.log(error);
      }

      $scope.onLoad = function() {
        $scope.loading = '';
      }

      $scope.onProgress = function (progressData) {
        console.log(progressData);
      };

      $scope.onPassword = function (updatePasswordFn, passwordResponse) {
        if (passwordResponse === PDFJS.PasswordResponses.NEED_PASSWORD) {
            updatePasswordFn($scope.pdfPassword);
        } else if (passwordResponse === PDFJS.PasswordResponses.INCORRECT_PASSWORD) {
            console.log('Incorrect password')
        }
    };*/


 /* $scope.candidat = {};*/
  var getCandidat = function(){

            $rootScope.loader = true;

            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

                 

                 $scope.drap = false;
                 if(angular.isDefined(response.data)){
                   $scope.candidat = response.data;
                    $scope.candidat.filename_diplome = response.data.filename_diplome;
                    $scope.candidat.filename_cv= response.data.filename_cv;
                    $scope.candidat.filename_cin = response.data.filename_cin;
                    $scope.candidat.filename_autorisation = response.data.filename_autorisation;
                    $scope.candidat.filename_demande = response.data.filename_demande;
                    $scope.candidat.filename_autorisation_exceptionnelle = response.data.filename_autorisation_exceptionnelle;
                      $scope.candidat.filename_tassrih = response.data.filename_tassrih;
                    $scope.candidat.etablissement = response.data.etablissement;
                     $scope.drap = true;


                 }else{
                  $scope.drap = false;
                 }
                 
                
 
                $rootScope.loader = false;

              

           });


     };
    //call getCandidat() function
    getCandidat();

 

 
 
      /**
       * fonctionnaire 
       */
      $rootScope.fonctionnaire = true;


      
      var uploader = $scope.uploader = new FileUploader({
          url: API_URL+'/candidat/upload/'+$rootScope.user
     });


      $scope.uploadImage = function (item) {

        item.formData.push({type: $scope.type});
        item.upload();
       // $scope.refresh();
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

       //console.log($scope.type);
       //
       //
      $rootScope.loader = true;

            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

                 

                 $scope.drap = false;
                 if(angular.isDefined(response.data)){
                   $scope.candidat = response.data;
                    $scope.candidat.filename_diplome = response.data.filename_diplome;
                    $scope.candidat.filename_cv= response.data.filename_cv;
                    $scope.candidat.filename_cin = response.data.filename_cin;
                    $scope.candidat.filename_autorisation = response.data.filename_autorisation;
                    $scope.candidat.filename_demande = response.data.filename_demande;
                    $scope.candidat.filename_autorisation_exceptionnelle = response.data.filename_autorisation_exceptionnelle;
                    $scope.candidat.filename_tassrih = response.data.filename_tassrih;
                    $scope.candidat.etablissement = response.data.etablissement;
                     $scope.drap = true;


                 }else{
                  $scope.drap = false;
                 }
                 
                
 
                $rootScope.loader = false;

              

           });



     }  


     $scope.refresh = function(){


      getCandidat();

     };


     // CALLBACKS

     uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
         //console.info('onWhenAddingFileFailed', item, filter, options);

         

         $rootScope.type = $scope.type;
     };
     uploader.onAfterAddingFile = function(fileItem) {
         
 
        //  console.info($scope.loading);
    
         ///$scope.invalidate = false;

      };
     uploader.onAfterAddingAll = function(addedFileItems) {
         
         //$scope.verifications = false;
        // console.info('onAfterAddingAll', addedFileItems[0]._file);

       



        // $scope.pdfUrl = 'F:/full/zahrScan.pdf';

 
 
         var fd = new FormData();

         var file = addedFileItems[0]._file;

         fd.append('file' , file);
        
       /* if(uploader.queue.length > 1){
            for (var i = 0; i < uploader.queue.length; i++) {

            
              var fileItem = uploader.queue[i]._file;
              fd.append('file[]' , uploader.queue[i]._file);
            }
        }else{
           var fileItem = uploader.queue[i]._file;
            fd.append('file' , uploader.queue[i]._file);
        }*/

 
        if($scope.type === undefined){




           toaster.pop('error', 'Message', "Veuillez sélectionner un type d'importation !");

        }else{




                $http.post( API_URL + '/candidat/checkUpload/'+$rootScope.user+'/'+$scope.type, fd,{
                     
                     transformRequest: angular.identity,

                     headers: {'Content-Type': undefined}

                }).success(function(data, status, headers, config) {


                             if(data.messagefileImage == -1){

                               $scope.filename = null;   
                               $scope.invalidate = true;
                                    
                                  if($rootScope.selectLang == 'French'){
                                   toaster.pop('error', 'Message', "Type du fichier PDF est incorrect");
                                 }else{
                                   toaster.pop('error', 'Message', "Faild image type.");
                                 }
                                          

                             }else{
                                 $scope.invalidate = false;
                                 $scope.filename = data.filename;
                               
                              } 

                            
 
                             //console.log($scope.filename);
                           
                 }).error(function(data, status, headers, config) {

                       if($rootScope.selectLang == 'French'){
                               toaster.pop('error', 'Message', "Erreur");
                             }else{
                               toaster.pop('error', 'Message', "Error");
                             }
                });
        }
      
 
 
 

          //BEGIN

         

         //END
         //
         //
    

     };



     
     uploader.onBeforeUploadItem = function(item) {
         //console.info('onBeforeUploadItem', item);
        

     };
     uploader.onProgressItem = function(fileItem, progress) {
         //console.info('onProgressItem', fileItem, progress);

         //$scope.refresh();
        
          
     };
     uploader.onProgressAll = function(progress) {
           //load();
            //console.info('onProgressAll', progress);
           
           if(progress == 100){
            toaster.pop('success', 'E-Concours', "L'importation est terminée avec succès!");
            $scope.refresh();

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
        // console.info('onCompleteItem', fileItem, response, status, headers);
      };
     uploader.onCompleteAll = function() {
        // console.info('onCompleteAll');
       };

     // console.info('uploader', uploader);
}]);
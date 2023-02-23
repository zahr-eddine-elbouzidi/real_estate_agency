app.controller('FileUpProfRestCtrl', ['$scope','$filter', '$rootScope','$stateParams', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', function($scope,$filter , $rootScope,$stateParams, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   
  if($stateParams.id_hire === ''){
     $state.go('app.mes-concours');
  } 

  $rootScope.sizeFile = null;
  //function get size file by candidat type BEGIN
  $http.get(API_URL+'/param/getList').success(function(resp, status, headers, config) {
    if(angular.isDefined(resp.data[0])){
      $rootScope.sizeFile = resp.data[0].max_upload_file_admin;
    }
  });
  //function get size file by candidat type END

   $rootScope.loader = false;
 

   $scope.piecesManqu = null;
   $scope.messageTerminer = null;
   


 $http.get(API_URL+'/hire/getHireById/'+$stateParams.id_hire)
  .success(function(response, status, headers, config) {
    //$scope.hireEdit = response.data;
    $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
    $scope.hireEdit.type = response.data[0].type_name;
    $scope.hireEdit.hire_code = response.data[0].hire_code;
    $scope.hireEdit.specialty_fr = response.data[0].specialty_fr;
    $scope.hireEdit.hire_date = response.data[0].hire_date;
    $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data[0].session_date_end), 'yyyy-MM-dd');
    $scope.hireEdit.etablissement = response.data[0].etablissement_name;
    $scope.hireEdit.post_number = response.data[0].post_number;

  }); 

   $scope.theseUploaded = false;

   $scope.checked =  function(){
    $rootScope.loader = true;

  
    $http.get(API_URL+'/candidat/checkPieces/'+$rootScope.user+"/"+$stateParams.id_hire).
    success(function(data, status, headers, config) {

      $rootScope.loader = false;
      
      
      if(angular.isDefined(data.data)){
      
      
        $scope.piecesManqu = data.data;
      
      	$scope.nbre_files_without_hire = data.nbre_files_without_hire;
       //tester si la thèse est déjà importé pour compléter les membres de jury
        $scope.theseUploaded = data.theseIsUploaded;
       // console.log($scope.theseUploaded);       
      }else{
       $scope.piecesManqu = null;
     }

     if($scope.piecesManqu.length == 0){
      
       $scope.messageTerminer = "Votre dossier de candidature est complet.";
       toaster.pop('success','Information', '<br>'+ "Votre dossier de candidature est complet."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
     }else{
      $scope.messageTerminer = null;
    }


  }); 
  };




  //get files must be uploaded in database
  //by candidat profil informations
  //Candidat-PESAM = BAC+8M and Candidat-PESAF = BAC+8 else is administratif account

  $http.get(API_URL+'/registration/getUser/'+$rootScope.user)
  .success(function(response, status, headers, config) {

    $rootScope.user_fullname = response.user_fullname;
    $rootScope.email = response.usr_email;
    $rootScope.role = response.type;
        //console.log($rootScope.role);
       if(angular.isDefined($rootScope.role)){
         $scope.loadFileTypes();
       }
  });



    $scope.SLUG = "";
    $scope.candidat = {};
    $scope.types = [];
    
    $scope.loadFileTypes = function(){
     
      $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
      .success(function(response, status, headers, config) {

       
        if(angular.isDefined(response.data)){
                            
                 $scope.candidat = response.data;
                 
                 $scope.auth = response.auth;
                 
                 $scope.candidat.diplome = response.data.diplome;
                 
                 $scope.candidat.niveau = response.data.niveau;
                 
                 $scope.candidat.etablissement = response.data.etablissement;


                 if($stateParams.slug === "divers"){
                          
                   $scope.SLUG = "Les pièces à fournir";     

                  if(angular.isDefined($scope.candidat)){

                      
                    	if($scope.candidat.etablissement !== '' && $scope.candidat.etablissement !== null){
                        
                       $scope.types = [{ id: 1,      name: 'Autorisation de participation au concours (Fonctionnaires)' ,name_ar : 'الترخيص باجتياز المباراة بالنسبة للموظفين'}];
                      }
                       $scope.types.push({ id: 5, name: 'Demande manuscrite' , name_ar : 'طلب خطي'});

                 }
                   
                   
             }else{
                $scope.SLUG = "";
             }
     
   }

});
};


   



     /* $scope.uploadFile = function(){

         var fd = new FormData();

         var file = $scope.Lfile;

         fd.append('file' , file);

        alert(fd);

      }*/


      

  
      

      

      
      
      /**
       * fonctionnaire 
       */
      $rootScope.fonctionnaire = true;


       
      var uploader = $scope.uploader = new FileUploader({
        url: API_URL+'/candidat/upload/'+$rootScope.user+'/'+$stateParams.id_hire
      });

      $scope.up = {};
      $scope.uploadImage = function (item) {
        item.formData.push({type: $scope.type});
        item.formData.push({specialite_diplome: $scope.up.specialite_diplome });
        item.formData.push({mention : $scope.up.mention });
        item.formData.push({date_obt : $scope.up.date_obt});
        item.upload();
        $scope.checked();
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
       
       



     }  

     


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
     
        
            var fd = new FormData();

            var file = addedFileItems[0]._file;

            fd.append('file' , file);

          if($scope.type === undefined){


            toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type de document !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
            
            $scope.invalidate = true;

          }else{

            $http.post( API_URL + '/candidat/checkUpload/'+$rootScope.user+'/'+$scope.type+'/'+$stateParams.id_hire, fd,{
             
             transformRequest: angular.identity,

             headers: {'Content-Type': undefined}

           }).success(function(data, status, headers, config) {

             if(data.messagefileImage == -3){
              
               $scope.filename = null;   
               $scope.invalidate = true;
               
               toaster.pop('error','Information', '<br>'+"Vous n\'avez pas le droit de changer vos documents après la validation de votre dossier!"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");     
               
             }else if(data.messagefileImage == -2){
              
               $scope.filename = null;   
               $scope.invalidate = true;
               
               toaster.pop('error','Information', '<br>'+"Vous n\'avez pas le droit de changer vos documents due à l \'expiration de la date du dépôt de dossier !"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");     
               
             }else if(data.messagefileImage == -1){

               $scope.filename = null;   
               $scope.invalidate = true;
               
               toaster.pop('warning','Information', '<br>'+"Le type de fichier n'est pas autorisé !"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");     

             }else{
               $scope.invalidate = false;
               $scope.filename = data.filename;
               
             } 

             }).error(function(data, status, headers, config) {

                 toaster.pop('error','Information', '<br>'+"Erreur !"+'<br><br>' +  '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
             });
            }

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
             toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
          //  $scope.refresh();
          $scope.checked();
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
         //console.info('onCompleteItem', fileItem, response, status, headers);
       };
       uploader.onCompleteAll = function() {
        // console.info('onCompleteAll');
      };

      //console.info('uploader', uploader);
      //
      //
      //
      //

      $scope.redirectMesPieces = function(){
        $state.go('app.upload', { slug : 'divers' , id_hire :   $stateParams.id_hire});
        
      };


      $scope.redirectUploadDocDiplomesadmin = function(){
        $state.go('app.docpadiplomesadmin', { slug : 'diplomes-adminstratifs' , id_hire : null});
        
      };

      $scope.redirectUploadDocDossierScienti = function(){

        $state.go('app.docpapublication', { slug : 'publication' , id_hire :  $stateParams.id_hire});
        
      };

      $scope.redirectUploadDocAttestationExp = function(){
        
        $state.go('app.docpaexperience', { slug : 'experience' , id_hire :  $stateParams.id_hire});
        
      };

      

      $scope.redirectUploadDocPADiplomesadmin = function(){
        $state.go('app.docpadiplomes', { slug : 'diplomes' , id_hire :  $stateParams.id_hire});
        
      };

      $scope.redirectUploadDocDipAdmin = function(){
        $state.go('app.docpadiplomes', { slug : 'diplomes-adminstratifs' , id_hire :  null});
        
      };
      

      $scope.hireEdit = {};
      $http.get(API_URL+'/hire/getHire/'+$stateParams.id_hire)
      .success(function(response, status, headers, config) {



        $scope.hireEdit.hire_code = response.data.hire_code;
        $scope.hireEdit.session_date_begin =new Date(response.data.session_date_begin) ;
        $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data.session_date_end), 'yyyy-MM-dd');
        $scope.hireEdit.hire_date = new Date(response.data.hire_date);
        $scope.hireEdit.specialty_fr = response.data.specialty_fr;
        $scope.hireEdit.color = response.data.color;
        $scope.hireEdit.post_number = response.data.post_number;
        $scope.hireEdit.adresse = response.data.adresse;
        $scope.hireEdit.type_id = response.data.type_id;
        $scope.hireEdit.etablissement_id = response.data.etablissement_id;
        $scope.hireEdit.type_poste = response.data.type;
        $http.get(API_URL+'/type/getSubCategory/'+$scope.hireEdit.type_id)
        .success(function(response, status, headers, config) {



          $scope.hireEdit.nom_grade = response.data;
          

        });

      });


      $scope.isPostuled = false;
      $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
      .success(function(response, status, headers, config) {
       $scope.isPostuled = response.data;    

     });


 
      

      $scope.savePostuler = function() {

        var dialog = confirm('Voulez-vous postuler au poste ('+$scope.hireEdit.nom_grade.nom+' en '+$scope.hireEdit.specialty_fr+') ?');
        
        if(dialog){
          
          $rootScope.loader = true;
          
          $http.post( API_URL + '/postuler/add',{
            'created_by' : $rootScope.user,
            'hire_id' : $stateParams.id_hire })
          .success(function(data, status, headers, config){

            if(data.drap == 1 ){
             

                            }else if(data.drap == 2 || data.drap == 3 || data.drap == 4){

                              toaster.pop('warning', 'Message', data.message); 

                            }else{

                              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                0, 'trustedHtml', null, "note-toaster-container");

                              //load();
                              
                              $state.go('app.profil');
                            }

                            $rootScope.loader = false;

         })
          .error(function(data, status, headers, config) {
          });
          
        }
        
      };


 

   
 
      
}]);
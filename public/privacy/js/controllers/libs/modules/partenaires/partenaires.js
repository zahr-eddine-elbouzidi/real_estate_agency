 
 ////////////////////////////////////// BEGIN Add Partenaires Controller ///////////////////////////////////////////////////////

 app.controller('PartListCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    $rootScope.loader = false;

    var uploader = $scope.uploader = new FileUploader({
          
      url: API_URL+'/partenaires/upload/'+$rootScope.user


 });

 $scope.uploadImage = function (item) {
  item.formData.push({title: ''});
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

            $http.post( API_URL + '/partenaires/checkUpload/'+$rootScope.user, fd,
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
       load();
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





    $scope.array = ServiceTranslate.personalTranslateLang();

        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
         $rootScope.loader = true;
         $http.get(API_URL+'/partenaires/getList/'+$rootScope.user).
         success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        $scope.partenaires = data.data;
                        angular.copy($scope.partenaires, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = $scope.partenaires.length;
	                      $scope.totalItems = $scope.partenaires.length;
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
                        $scope.itemsPerPage = $scope.partenaires.length;
                      }else{
                        if($scope.viewby > $scope.partenaires.length ){
                          $scope.itemsPerPage =  $scope.partenaires.length;
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
         $scope.deletePartenaire = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/partenaires/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/partenaires');

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



         $scope.getElement=function(partenaire){

           
           $state.go('app.editPartenaires', { id : partenaire.id });

         };


        /**
        *
        * start saveCategorie function
        * add a new record 
        *
        **/
        $scope.savePartenaire = function() {
         $rootScope.loader = true;
         console.log($scope.partenaire);
         $http.post( API_URL + '/partenaires/add', 
         {
          'etablissement':$scope.partenaire.etablissement,
          'domaine':$scope.partenaire.domaine,
          'cycle':$scope.partenaire.cycle,
          'site_web':$scope.partenaire.site_web,
          'tel':$scope.partenaire.tel,
          'email':$scope.partenaire.email,
          'criteres':$scope.partenaire.criteres,
          'filiere_etude':$scope.partenaire.filiere_etude,
          'coordonateur':$scope.partenaire.coordonateur,
          'pays':$scope.partenaire.pays,
          'frais_inscription_annuel':$scope.partenaire.frais_inscription_annuel,
          'frais_traitement_dossier':$scope.partenaire.frais_traitement_dossier,
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
          $location.path('/app/partenaires');    
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

 ////////////////////////////////////// END Add Partenaires Controller ///////////////////////////////////////////////////////

////////////////////////////////////// BEGIN Edit Partenaires Controller ///////////////////////////////////////////////////////

app.controller('PartEditCtrl',['$scope', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope, $rootScope, $http,$state,$stateParams, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;
  
  $http.get(API_URL+'/partenaires/getPartenaire/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.partenaireEdit = response.data;
    $scope.partenaireEdit.etablissement = response.data.etablissement;
    $scope.partenaireEdit.domaine = response.data.domaine;
    $scope.partenaireEdit.cycle = response.data.cycle;
    $scope.partenaireEdit.site_web = response.data.site_web;
    $scope.partenaireEdit.tel = response.data.tel;
    $scope.partenaireEdit.email = response.data.email;
    $scope.partenaireEdit.criteres = response.data.criteres;
    $scope.partenaireEdit.filiere_etude = response.data.filiere_etude;
    $scope.partenaireEdit.coordonateur = response.data.coordonateur;
    $scope.partenaireEdit.pays = response.data.pays;
    $scope.partenaireEdit.frais_inscription_annuel = response.data.frais_inscription_annuel;
    $scope.partenaireEdit.frais_traitement_dossier = response.data.frais_traitement_dossier;


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
              'etablissement':$scope.partenaireEdit.etablissement,
              'domaine':$scope.partenaireEdit.domaine,
              'cycle':$scope.partenaireEdit.cycle,
              'site_web':$scope.partenaireEdit.site_web,
              'tel':$scope.partenaireEdit.tel,
              'email':$scope.partenaireEdit.email,
              'criteres':$scope.partenaireEdit.criteres,
              'filiere_etude':$scope.partenaireEdit.filiere_etude,
              'coordonateur':$scope.partenaireEdit.coordonateur,
              'pays':$scope.partenaireEdit.pays,
              'frais_inscription_annuel':$scope.partenaireEdit.frais_inscription_annuel,
              'frais_traitement_dossier':$scope.partenaireEdit.frais_traitement_dossier,
              'created_by':$rootScope.user
            },
            url: API_URL + '/partenaires/edit/'+id
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
           $state.go('app.partenaires');
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



////////////////////////////////////// END Edit Partenaires Controller ///////////////////////////////////////////////////////





app.controller('ResultsCtrl',['$scope','$filter' ,'$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {

  $rootScope.loader = false;

  $scope.candidatsAccepted = {};
  $scope.copy=null;
  $scope.sortType=null;
  $scope.sortReverse=null;
  $scope.searchFish=null;
  $scope.viewby=null;
  $scope.totalItems=null;
  $scope.currentPage=null;
  $scope.itemsPerPage=null;
  $scope.maxSize=null;
  $scope.category_id=null;
  $scope.profile=null;

 

  $http.get(API_URL+'/hire/getHireById/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.hireEdit = response.data;
    $scope.hireEdit.type = response.data[0].type_name;
    $scope.hireEdit.id = response.data[0].id;
    $scope.hireEdit.category_id = response.data[0].categorie_id;
    $scope.hireEdit.hire_code = response.data[0].hire_code;
    $scope.profile = response.data[0].type_profile;
    $scope.hireEdit.specialty_fr = response.data[0].specialty_fr;
    $scope.hireEdit.hire_date = response.data[0].hire_date;
    $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data[0].session_date_end), 'yyyy-MM-dd');
    $scope.hireEdit.etablissement = response.data[0].etablissement_name;
    $scope.hireEdit.post_number = response.data[0].post_number; 
    $scope.hireEdit.displayed = response.data[0].displayed; 
  });

 

 
  
  $http.get(API_URL+'/etablissement/checkAuth/'+$rootScope.user+'/'+$stateParams.id).
  success(function(data, status, headers, config) {
    if(angular.isDefined(data.data)){
      if(data.data == false && $rootScope.role=="Commission"){
        $location.path('/app/unauthorized'); 
      }
    }
  });
  
 

  //getting file uploader
     var uploader = $scope.uploader = new FileUploader({
      url: API_URL+'/hire/upload/'+$rootScope.user
    });
     $scope.uploadImage = function (item) {
      item.formData.push({type: $scope.type,hire_id : $stateParams.id , displayed : $scope.param,
      	description : $scope.description});
      item.upload();
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
    }  
    $scope.hire = {}
    $scope.getHireId = function(hire){
      if(angular.isDefined(hire)){
        $scope.hire = hire;
      }else{
        $scope.hire = {}
      }
    }
    
    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
      
    };
    uploader.onAfterAddingFile = function(fileItem) {

    };
    uploader.onAfterAddingAll = function(addedFileItems) {
      // alert($scope.hire);
      var fd = new FormData();
      var file = addedFileItems[0]._file;
      fd.append('file' , file);
      
      if($scope.type === undefined){
        
        toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type de document !"+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
        $scope.invalidate = true;
      }else{ 
        $http.post( API_URL + '/hire/checkUpload/'+$rootScope.user+'/'+$stateParams.id+'/'+$scope.type, fd,{
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
        }).success(function(data, status, headers, config) {
          if(data.messagefileImage == -1){
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
          
          toaster.pop('error','Information', '<br>'+"Erreur !"+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
        });     
      }
    };

    uploader.onBeforeUploadItem = function(item) {
        //console.info('onBeforeUploadItem', item);
      };
      uploader.onProgressItem = function(fileItem, progress) {
        //console.info('onProgressItem', fileItem, progress);
      };
      uploader.onProgressAll = function(progress) {
          //console.info('onProgressAll', progress);
          if(progress == 100){
            toaster.pop('success', 'E-Concours', "L'importation est terminée avec succès!");
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


    $scope.getChangeConcoursDisplayed = function(param_dis) {            
     $rootScope.loader = true;
     $http.post( API_URL + '/hire/getChangeDisplayed/'+$stateParams.id, 
     {
       'displayed':param_dis,
       'created_by':$rootScope.user
     }).success(function(data, status, headers, config) {
       $rootScope.loader = false;
     })
     .error(function(data, status, headers, config) {
     });  
   };


    $scope.initDisplayedResultats = function(type) {            

	    var dialog = confirm('Voulez-vous vraiement Supprimer ce fichier ?');
	    if(dialog){
	    		 $rootScope.loader = true;
	    	 	 $http.post( API_URL + '/hire/initAffichage/'+$stateParams.id, 
			     {
			       'type':type,
			       'created_by':$rootScope.user

			     }).success(function(data, status, headers, config) {

			       if(data.data == true){
			       	toaster.pop('success','Information', '<br>'+"L'opération effectuée avec succès!"+'<br><br>' + 
			            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
			            0, 'trustedHtml', null, "note-toaster-container");  
			       }	
			       $rootScope.loader = false;
			     })
			     .error(function(data, status, headers, config) {
			     });  
	    }

    
   };


                   
         
              
}]);







app.controller('ListesCtrl',['$scope','$filter' ,'$rootScope', '$http','$state', '$location','$timeout',
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


  $http.get(API_URL+'/type/getList/'+$rootScope.user).
  success(function(data, status, headers, config) {
    $scope.types = data.data;
  });

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
  });

 

 
  
  $http.get(API_URL+'/etablissement/checkAuth/'+$rootScope.user+'/'+$stateParams.id).
  success(function(data, status, headers, config) {
    if(angular.isDefined(data.data)){
      if(data.data == false && $rootScope.role=="Commission"){
        $location.path('/app/unauthorized'); 
      }
    }
  });
  
  $scope.getFilesForAccept=function(postuler_id , isMembre){
   
    $state.go('app.files', { id : postuler_id});
  };
  
 
 
var loadAccepted = function() {
    $rootScope.loader = true;
    $http.get(API_URL+'/hire/getCandidatsByHiresAccepted/'+$stateParams.id).success(function(data, status, headers, config) {
      $rootScope.loader = false;
      if(angular.isDefined(data.nbre_postuled[0])){
        if(data.nbre_postuled[0].nbre_postuled != 0){
          $scope.logoFilename = data.dataPost[0].filename;
          $scope.university_name = data.dataPost[0].university_name;
          $scope.candidatsAccepted = data.dataAccept;
          $scope.candidatsPostuled = data.dataPost;
          $scope.candidatsEcritOrdre = data.dataEcritNote;
          $scope.candidatsAuthorize = data.dataAuthorize;
          $scope.candidatsOralOrder = data.dataOralOrder;
          $scope.candidatsFinaleOrder = data.dataFinalOrder;
          $scope.candidatsFinaleAttenteOrder = data.dataAttenteOrder;
          $scope.hireForPv = data.hireTab;
          $scope.commissions = data.commissions;
          $scope.publication = data.publication;
          $scope.pvFirstExam = data.pvFirstExam;
          $scope.formule = data.formule;
          $scope.nbre_postuled=data.nbre_postuled;
        }else{
          $scope.logoFilename = null;
          $scope.university_name = null;
          $scope.candidatsAccepted =null;
          $scope.candidatsPostuled = null;
          $scope.candidatsEcritOrdre = null;
          $scope.candidatsAuthorize = null;
          $scope.candidatsOralOrder = null;
          $scope.candidatsFinaleOrder = null;
          $scope.candidatsFinaleAttenteOrder = null;
          $scope.hireForPv = null;
          $scope.commissions = null;
          $scope.publication = null;
          $scope.pvFirstExam = null;
          $scope.formule = null;
          $scope.nbre_postuled=null;
        }
      }else{
        $scope.logoFilename = null;
          $scope.university_name = null;
          $scope.candidatsAccepted =null;
          $scope.candidatsPostuled = null;
          $scope.candidatsEcritOrdre = null;
          $scope.candidatsAuthorize = null;
          $scope.candidatsOralOrder = null;
          $scope.candidatsFinaleOrder = null;
          $scope.candidatsFinaleAttenteOrder = null;
          $scope.hireForPv = null;
          $scope.commissions = null;
          $scope.publication = null;
          $scope.pvFirstExam = null;
          $scope.formule = null;
          $scope.nbre_postuled=null;
      }
     
      //console.log(data.nbre_postuled);
      //console.log($scope.commissions);
      //console.log($scope.publication);
      //console.log($scope.pvFirstExam);
                        
   });
}
 
 
loadAccepted();

$scope.clickLoad=function(){
   loadAccepted();
 }

 
 

               
                   
                  
                

 
  
 

                  $scope.export = function(type){
 
                  $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExport/'+$stateParams.id+'/'+type, 
                   {
                     
                    'created_by':$rootScope.user
                   
                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");

                   }else if(data.drap == 2){

                    toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");

                   }else{

                     toaster.pop('error','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                   }
                   
                 })
                  .error(function(data, status, headers, config) {
                   $rootScope.loader = false;
                 });

                    

                   

                }


                 $scope.exportOral = function(type){
 
                  $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExportOrale/'+$stateParams.id+'/'+type, 
                   {
                     
                    'created_by':$rootScope.user
                   
                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");

                   }else if(data.drap == 2){

                    toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                  }else{

                     toaster.pop('error','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                   }
                   
                 })
                  .error(function(data, status, headers, config) {
                   $rootScope.loader = false;
                 });

                    

                   

                }


                 $scope.exportJury = function(){
 
                  $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExportJury/'+$stateParams.id, 
                   {
                     
                    'created_by':$rootScope.user
                   
                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");

                   }else if(data.drap == 2){

                    toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                  }else{

                     toaster.pop('error','Information', '<br>'+data.message+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                   }
                   
                 })
                  .error(function(data, status, headers, config) {
                   $rootScope.loader = false;
                 });

                    

                   

                }
 


 

              
              
}]);



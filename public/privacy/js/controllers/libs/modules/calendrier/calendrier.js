 


app.controller('CalendrierListCtrl',['$scope','$filter', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
'ServiceTranslate','FileUploader','API_URL','toaster', 
function($scope,$filter, $rootScope, $http,$state,$stateParams, $location,
  $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
 
  $rootScope.loader = false;
  
 console.log($stateParams.id);

  var load = function() {

   $rootScope.loader = true;


   $http.get(API_URL+'/calendrier/getList/'+$rootScope.user+'/'+$stateParams.id).success(function(data, status, headers, config) {
     
     
                       $rootScope.loader = false;
                       $scope.calendriers = data.data;
                       angular.copy($scope.calendriers, $scope.copy);
                       $scope.sortType     = 'nom'; // set the default sort type
                       $scope.sortReverse  = false;  // set the default sort order
                       $scope.searchFish   = ''; 
                       $scope.viewby =  $scope.calendriers.length;
                       $scope.totalItems = $scope.calendriers.length;
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
                         $scope.itemsPerPage = $scope.calendriers.length;
                       }else{
                         if($scope.viewby > $scope.calendriers.length ){

                           $scope.itemsPerPage =  $scope.calendriers.length;
                           
                         }else{
                          $scope.itemsPerPage = num;
                        }
                        
                      }
                    }    
                    

                  });
 }


 $http.get(API_URL+'/sessions/getList/'+$rootScope.user).success(function(data, status, headers, config) {
   
   
   $scope.sessions = data.data;

   console.log($scope.sessions);
   
 });

 $http.get(API_URL+'/filieres/getFiliereEtab/'+$stateParams.id).success(function(data, status, headers, config) {
   
   
    $scope.filieres = data.data[0];

    console.log($scope.filieres);
    
  });
 
 


 load();

 $scope.deleteRecord = function(id) {
   

   $('#confirm-delete').on('click', '.btn-ok', function(e) {
     var $modalDiv = $(e.delegateTarget);
     var id = $(this).data('recordId');
                     //console.log(id);
                     // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                     // $.post('/api/record/' + id).then()

                     $rootScope.loader = true;    
                     $http({
                       method:'DELETE',
                       url: API_URL+ '/calendrier/delete/'+id+'/'+$rootScope.user
                     }).success(function(data, status, headers, config) {
                       $rootScope.loader = false;
                       load();
                       $state.go('app.calendrier', { id : $stateParams.id });
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





 $scope.saveCalendrier = function() {
  $rootScope.loader = true;
  



  if($scope.calendrier.session_id===undefined){
   
   toaster.pop('error', 'Message', "Veuillez séléctionner une session !");
   $rootScope.loader = false;
   
 }else{

   $http.post(API_URL + '/calendrier/add', 
   {

     'date_debut': $filter('date')(new Date( $scope.calendrier.date_debut), 'yyyy-MM-dd'),
     'date_fin': $filter('date')(new Date( $scope.calendrier.date_fin), 'yyyy-MM-dd'),
     'session_id':$scope.calendrier.session_id,
     'filiere_id':$stateParams.id,
     'created_by':$rootScope.user

   }).success(function(data, status, headers, config) {

     $rootScope.loader = false;

     if(data.drap==false){

      toaster.pop('warning','Information', '<br>'+"Calendrier  existe déjà !"+'<br><br>' + 
       '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
       0, 'trustedHtml', null, "note-toaster-container");



    }else if(data.drap==true ){
     
     load();
     
     toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
       '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
       0, 'trustedHtml', null, "note-toaster-container");
     
       $state.go('app.calendrier', { id : $stateParams.id }); 

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




$scope.getElement=function(filiere){


 $state.go('app.editFiliere', { id : filiere.id_filiere });

};

$scope.getCalendrier=function(filiere){


 $state.go('app.calendrier', { id : filiere.id_filiere });

};
 




}]);






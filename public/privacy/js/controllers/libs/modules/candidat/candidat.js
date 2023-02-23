app.controller('CandidatsListCtrl',['$scope','$filter', '$rootScope','$stateParams', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope,$filter, $rootScope,$stateParams, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  

        $rootScope.loader = false;




          /**
        * [exportData description]
        * @return {[type]} [description]
        */
           $scope.exportData = function() {

          
            $rootScope.loader = true;
            
            
            $http.post( API_URL + '/candidat_back/exportData', 
            {
        
             'created_by':$rootScope.user
   
           }).success(function(data, status, headers, config) {
             $rootScope.loader = false;
        
             toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
               '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
               0, 'trustedHtml', null, "note-toaster-container");
             
             
           })
           .error(function(data, status, headers, config) {
           });
   
           
   
   
           
         };




        $scope.candidats = {};
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

        /**
         * [load description]
         * @return {[type]} [description]
         */
         
         $scope.load = function() {

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat_back/getList/'+$rootScope.user).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.candidats = data.data;
                        console.log(data.data);
                        $scope.length = $scope.candidats.length;
                        angular.copy($scope.candidats, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = $scope.candidats.length;
	                      $scope.totalItems = $scope.candidats.length;
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
                        $scope.itemsPerPage = $scope.candidats.length;
                      }else{
                        if($scope.viewby > $scope.candidats.length ){

                          $scope.itemsPerPage =  $scope.candidats.length;
                          
                        }else{
                         $scope.itemsPerPage = num;
                       }
                       
                     }
                   }
                 });
        }

       

  
   $scope.getInscriptions = function(candidat){

    $state.go('app.inscriptions', { id : candidat.id_candidat });

   }
 

           
}]);

 
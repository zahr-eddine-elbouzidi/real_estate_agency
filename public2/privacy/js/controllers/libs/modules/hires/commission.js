/*
* @Author: zahr
* @Date:   2019-07-16 22:11:37
* @Last Modified by:   zahr
* @Last Modified time: 2020-08-15 03:10:34
*/



app.controller('CommissionCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  
  $scope.getRequests=function(hire){
   $state.go('app.requests', { id : hire.id , slug : hire.slug});
 };
 
 

 var load = function() {
  $rootScope.loader = true;
  $http.get(API_URL+'/etablissement/getHiresByCommission/'+$rootScope.user).success(function(data, status, headers, config) {

    $rootScope.loader = false;
    $scope.hiresCommission = data.data;
    

                       // console.info(data.data);

                       $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
                       

                       // console.info(data.data);
                       angular.copy($scope.hiresCommission, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = 5;
	                      $scope.totalItems = $scope.hiresCommission.length;
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
                        $scope.itemsPerPage = $scope.hiresCommission.length;
                      }else{
                        if($scope.viewby > $scope.hiresCommission.length ){

                          $scope.itemsPerPage =  $scope.hiresCommission.length;
                          
                        }else{
                         $scope.itemsPerPage = num;
                       }
                       
                     }
                   }
                 });
};

load();



$scope.typesComm = {};
$scope.changeTypeComm = function(){
  
 
  
  $scope.typesComm[0]='Président';
  $scope.typesComm[1]='Membre';
  
  
};
$scope.jury = [];
$scope.tolist = [];
  
var loadCommission = function() {
 
  
  
 
    $rootScope.loader = true;

     $http.get(API_URL+'/etablissement/getListJuryUniversity/'+$stateParams.hire_id+'/'+$rootScope.user)

     .success(function(data, status, headers, config) {
      
      
       $scope.jury = data.data;
       $scope.tolist = data.data; 

       $rootScope.loader = false;

      
      }).error(function(data, status, headers, config) {
       $rootScope.loader = false;
      });
 

};


$scope.getValue = function(){

  alert($scope.jurys.jury_id);
 
};

$scope.changer = function(){
loadCommission();
 
};

loadCommission();



var loadCommissionParConcours = function() {
 
                 $rootScope.loader = true;

                 $http.get(API_URL+'/agent/getMembres/'+$rootScope.user+'/'+$stateParams.hire_id)

                 .success(function(data, status, headers, config) {
                  
                  $scope.membres = data.data;
                  $rootScope.loader = false;

                  
                }).error(function(data, status, headers, config) {
                 $rootScope.loader = false;
               });
};

loadCommissionParConcours();


              
$scope.saveCommissionToHire = function(){

              //  alert($scope.jurys.jury_id);
                
               
                if($stateParams.hire_id != undefined && $stateParams.hire_id != null){
                  
                  $rootScope.loader = true;
                  
                  $http.post( API_URL + '/hire/confirmCommission/'+$stateParams.hire_id+'/'+$rootScope.user, 
                  {

                    'commission_id':$scope.jurys.jury_id,
                    'type' : $scope.jurys.typeComm

                  }).success(function(data, status, headers, config) {
                   $rootScope.loader = false;
                         //$scope.hire_id_actif = null;
                         if(data.data == true){
                           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                           loadCommissionParConcours();
                           loadCommission();
                         }else if(data.data == false){

                           toaster.pop('error','Erreur', '<br>'+"L'enregistrement existe déjà !"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");

                         }else{

                          toaster.pop('error','Erreur', '<br>'+"Le membre de commission ("+data.data[0].nom_complet+") est déjà existe dans les membres de jury du candidat "+data.data[0].nom+" "+data.data[0].prenom+"!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");

                        }
                        
                        
                      }).error(function(data, status, headers, config) {
                       $rootScope.loader = false;
                           //$scope.hire_id_actif = null;
                         });
                      
                    }else{
                     toaster.pop('error','Erreur', '<br>'+"Veuillez sélectionner un concours!"+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                   }
                   
                   
}



 $scope.deleteCommission = function() {

          $('#confirm-delete-jury').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
           // console.log(id);
            // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()
            $rootScope.loader = true;
            $http({

              method:'DELETE',
              url:API_URL + '/agent/desaffect/'+$rootScope.user+'/'+id

            }).success(function(data, status, headers, config) {

              
             $modalDiv.addClass('loading');
             setTimeout(function() {
              $modalDiv.modal('hide').removeClass('loading');
            }, 500)

             loadCommissionParConcours();
             loadCommission();
             $rootScope.loader = false;
             toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");

           }).error(function(data, status, headers, config) {
            $rootScope.loader = false;
          });




           
         });
          $('#confirm-delete-jury').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
          });

}

                


}]);

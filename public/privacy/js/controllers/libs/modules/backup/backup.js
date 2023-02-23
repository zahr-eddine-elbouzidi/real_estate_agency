 


 app.controller('BackupCtrl',['$scope', '$rootScope', '$http', '$location','API_URL','toaster','$timeout','ServiceTranslate'
    , function($scope, $rootScope, $http, $location,API_URL,toaster,$timeout,ServiceTranslate) {
 

     
 





        $scope.backup = function(){


        		 

        	  $http({

                      method:'POST',

                      data:{
                      		'module_id': 1,
                      		'created_by':$rootScope.user
                      	   },
                      url: API_URL + '/modulesapp/backup'

                    }).success(function(data, status, headers, config) {

                    	 		 
                    	 		 
	                            $location.path('/app/modules');
	                            if($rootScope.selectLang == 'French'){
                                  toaster.pop('success', 'Message', "L'installation du module a été bien effectuée.");
                                }else{
                                  toaster.pop('success', 'Message', "Module installed successfully.");
                                }
 
                    })
                    .error(function(data, status, headers, config) {

                    	 toaster.pop('danger', 'Message', ""+data);

                    });   
        };


 

    }]);


 


 
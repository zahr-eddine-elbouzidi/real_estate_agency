 


 app.controller('ModulesCtrl',['$scope', '$rootScope', '$http', '$location','API_URL','toaster','$timeout','ServiceTranslate'
    , function($scope, $rootScope, $http, $location,API_URL,toaster,$timeout,ServiceTranslate) {
 

     

      
        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
               $http.get(API_URL+'/modulesapp/getList/'+$rootScope.user).success(function(data, status, headers, config) {

                          $scope.modules = data.data;



                          angular.copy($scope.modules, $scope.copy);
                          $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 


	                      $scope.viewby = 5;
	                      $scope.totalItems = $scope.modules.length;
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
	                        $scope.itemsPerPage = num;
	                        $scope.currentPage = 1; //reset to first paghe
	                      }
                      
                    });
        }

         /**
        * End load function
        * 
        *
        **/


        load(); //Call load function




        var getModules =  function(){

        	 $http.get(API_URL+'/modulesapp/availablemodules/'+$rootScope.user).
		       success(function(data, status, headers, config) {
		            angular.forEach(data.modulesavailable , function(value , key){


		                if(value.module_code == "001"){

		                  $rootScope.isNewsModule = true;
		                
		                }else if(value.module_code == "002"){

		                  $rootScope.isScolaireModule = true;

		                }
		            });        

		         });
        };


      







        $scope.installModule = function(module_id){


        		 

        	  $http({

                      method:'POST',

                      data:{
                      		'module_id': module_id,
                      		'created_by':$rootScope.user
                      	   },
                      url: API_URL + '/modulesapp/install'

                    }).success(function(data, status, headers, config) {

                    	 		load();
                    	 		getModules();
	                            $location.path('/app/modules');
	                            if($rootScope.selectLang == 'French'){
                                  toaster.pop('success', 'Message', "L'installation du module a bien été effectuée.");
                                }else{
                                  toaster.pop('success', 'Message', "Module installed successfully.");
                                }
 
                    })
                    .error(function(data, status, headers, config) {

                    	 toaster.pop('danger', 'Message', ""+data);

                    });   
        };


 

    }]);


 


 
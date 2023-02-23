'use strict';

/* Controllers */ 




app
  // Flot Chart controller 
  .controller('FlotChartDemoCtrl', ['$scope','$window', '$rootScope', '$http', '$location','API_URL','toaster','$timeout'
    , function($scope,$window, $rootScope, $http, $location,API_URL,toaster,$timeout) {
     
      //console.log("test: "+ $rootScope.datamonths);
      


      $rootScope.loader = true;

      

      
      var loadCharts = function(){

       $rootScope.loader = true;
       $http.get(API_URL+'/dashboard/getList').
       success(function(data, status, headers, config) {

         
         $scope.datac = data.hire_by_cats;

         $scope.datasc = data.hire_by_sub_cat;

         $scope.datamonths = data.post_by_month;

         $scope.nbre_total = data.nbre_total[0].data;

         $scope.nbre_candidat = data.nbre_total_candidat[0].data;

         $scope.nbre_users = data.nbre_users[0].data;

                      // console.info($scope.datamonths);  

                      $rootScope.loader = false;

                    });


     };


     var state = function(){

      

      $rootScope.loader = true;

      $http.get(API_URL+'/hire/fetch').
      success(function(data, status, headers, config) {

        $scope.state = data.data;

        $scope.length = $scope.state.length;
        

        
        angular.copy($scope.state, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = 5;
                        $scope.totalItems = $scope.state.length;
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
                          $scope.itemsPerPage = $scope.state.length;
                        }else{
                          if($scope.viewby > $scope.state.length ){

                            $scope.itemsPerPage =  $scope.state.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }

                     $rootScope.loader = false;
                     

                   });

    }



    loadCharts();

    state();


    $scope.export = function(){

     $rootScope.loader = true;

     $http.post( API_URL + '/hire/getExportMinistry', 
     {
       
       
       
      'created_by':$rootScope.user
      
      

    }).success(function(data, status, headers, config) {
     
      $rootScope.loader = false;

      if(data.drap == true){

        toaster.pop('success', 'Message', data.message);

      }else{

       toaster.pop('danger', 'Message', data.message);
     }
     
   })
    .error(function(data, status, headers, config) {
    });

  }


  



  $scope.d = [ [1,6.5],[2,6.5],[3,7],[4,8],[5,7.5],[6,7],[7,6.8],[8,7],[9,7.2],[10,7],[11,6.8],[12,7] ];
   // console.log( $scope.d);
   $scope.d0_1 = [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ];

   $scope.d0_2 = [ [0,4],[1,4.5],[2,7],[3,4.5],[4,3],[5,3.5],[6,6],[7,3],[8,4],[9,3] ];

   $scope.d1_1 = [ [10, 120], [20, 70], [30, 70], [40, 60] ];

   $scope.d1_2 = [ [10, 50],  [20, 60], [30, 90],  [40, 35] ];

   $scope.d1_3 = [ [10, 80],  [20, 40], [30, 30],  [40, 20] ];

   $scope.d2 = [];

   for (var i = 0; i < 20; ++i) {
    $scope.d2.push([i, Math.sin(i)]);
  }   

  $scope.d3 = [ 
  { label: "iPhone5S", data: "40" }, 
  { label: "iPad Mini", data: "10" },
  { label: "iPad Mini Retina", data: "20" },
  { label: "iPhone4S", data: "12" },
  { label: "iPad Air", data: "18" }
  ];

   // console.info( $scope.d3);
   

   $scope.refreshData = function(){

    loadCharts();

    $scope.d0_1 = $scope.d0_2;
  };

  $scope.getRandomData = function() {
    var data = [],
    totalPoints = 150;
    if (data.length > 0)
      data = data.slice(1);
    while (data.length < totalPoints) {
      var prev = data.length > 0 ? data[data.length - 1] : 50,
      y = prev + Math.random() * 10 - 5;
      if (y < 0) {
        y = 0;
      } else if (y > 100) {
        y = 100;
      }
      data.push(y);
    }
      // Zip the generated y values with the x values
      var res = [];
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }
      return res;
    }

    $scope.d4 = $scope.getRandomData();
  }]);

 
 ////////////////////////////////////// BEGIN Add Caegory Controller ///////////////////////////////////////////////////////

 app.controller('SessListCtrl',['$scope', '$rootScope','$filter', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope, $rootScope,$filter, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    $rootScope.loader = false;

    $scope.array = ServiceTranslate.personalTranslateLang();

        /**
        * start load function
        * for load records 
        *
        **/
        var load = function() {
         $rootScope.loader = true;
         $http.get(API_URL+'/sessions/getList/'+$rootScope.user).
         success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        $scope.sessions = data.data;
                        ///console.log( $scope.sessions);
                        angular.copy($scope.sessions, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = 5;
	                      $scope.totalItems = $scope.sessions.length;
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
                        $scope.itemsPerPage = $scope.sessions.length;
                      }else{
                        if($scope.viewby > $scope.sessions.length ){
                          $scope.itemsPerPage =  $scope.sessions.length;
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
         $scope.deleteSession = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/sessions/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/sessions');

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



         $scope.getElement=function(session){

           
           $state.go('app.editSession', { id : session.id });

         };

 


        $scope.activerSession = function(){

         $rootScope.loader = true;
         $http.post( API_URL + '/sessions/activer', 
         {
          'session_date': $filter('date')(new Date( $scope.session.session_date), 'yyyy-MM-dd'),
          'created_by':$rootScope.user,

         }).success(function(data, status, headers, config) {
            $rootScope.loader = false;
            if (data.drap== 1){

              $scope.message_already = null;
              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/sessions'); 
            }


            
      })
        .error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });

        }

        $scope.session = {}; 

        $scope.selectedReport= function(value){

          $scope.session.is_report = value;

        }

        $scope.selectedOpen= function(id , value){


         $http.post( API_URL + '/sessions/open', 
         {
          
          'is_open' : value,
          'id' : id,
          'created_by':$rootScope.user,

        }).success(function(data, status, headers, config) {
              $rootScope.loader = false;


              if(data.drap== 1 ){

              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/sessions'); 

 
             }else{

               $scope.message_already = null;

            }
      })
        .error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });

        }


 $scope.selectedReport= function(id , value){


         $http.post( API_URL + '/sessions/report', 
         {
          
          'is_report' : value,
          'id' : id,
          'created_by':$rootScope.user,

        }).success(function(data, status, headers, config) {
              $rootScope.loader = false;


              if(data.drap== 1 ){

              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/sessions'); 

 
             }else{

               $scope.message_already = null;

            }
      })
        .error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });

        }
        $scope.saveSession = function() {

        

         $rootScope.loader = true;
         $http.post( API_URL + '/sessions/add', 
         {
          'session_date': $filter('date')(new Date( $scope.session.session_date), 'yyyy-MM-dd'),
          'session_end': $filter('date')(new Date( $scope.session.session_end), 'yyyy-MM-dd'),
          'is_deleted' : false,
          'created_by':$rootScope.user,

        }).success(function(data, status, headers, config) {
              $rootScope.loader = false;


              if(data.drap== 0 ){

               $scope.message_already = null;

               toaster.pop('warning','Information', '<br>'+"Session existe déjà !"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

             }else if (data.drap== 1){

              $scope.message_already = null;
              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/sessions'); 


             }else if(data.drap==2){

               $scope.message_already = "Session "+$filter('date')(new Date(data.session.session_date), 'dd-MM-yyyy')+" existe déjà! Voulez-vous restaurer la session ?";
              
             }else if(data.drap==3){

                $scope.message_already = null;
                toaster.pop('error','Attention', '<br>'+"Une erreur s'est produite lors de l'envoi de la commande au programme !"+'<br><br>' + 
                   '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                   0, 'trustedHtml', null, "note-toaster-container");   

             }else{

               $scope.message_already = null;

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

 ////////////////////////////////////// END Add Caegory Controller ///////////////////////////////////////////////////////

////////////////////////////////////// BEGIN Edit Caegory Controller ///////////////////////////////////////////////////////

app.controller('SessEditCtrl',['$scope', '$filter','$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope,$filter, $rootScope, $http,$state,$stateParams, $location,$timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;
  

        /**
        * get Session object
        *
        **/
        $http.get(API_URL+'/sessions/getSession/'+$stateParams.id)
        .success(function(response, status, headers, config) {

          $scope.sessionEdit = response.data;
          $scope.sessionEdit.session_date = new Date(response.data.session_date);
          $scope.sessionEdit.session_end = new Date(response.data.session_end);
          console.log($scope.sessionEdit);

        });


         /**
         *  Start saveChange function 
         *  saveChange function
         *  edit exists record
         *  id input param 
         **/
         $scope.saveChange=function(){
          $rootScope.loader = true;
          $http({


            method:'POST',
            data:{
              'session_date': $filter('date')(new Date( $scope.sessionEdit.session_date), 'yyyy-MM-dd'),
              'session_end': $filter('date')(new Date( $scope.sessionEdit.session_end), 'yyyy-MM-dd'),
              'created_by':$rootScope.user

          },
            url: API_URL + '/sessions/edit/'+$stateParams.id
          }).success(function(data, status, headers, config) {
          $rootScope.loader = false;


              if(data.drap== 0 ){

               $scope.message_already = null;

               toaster.pop('warning','Information', '<br>'+"Session existe déjà !"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

             }else if (data.drap== 1){

              $scope.message_already = null;
              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/sessions'); 


             }else if(data.drap==3){

                $scope.message_already = null;
                toaster.pop('error','Attention', '<br>'+"Une erreur s'est produite lors de l'envoi de la commande au programme !"+'<br><br>' + 
                   '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                   0, 'trustedHtml', null, "note-toaster-container");   

             }else{

               $scope.message_already = null;

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



////////////////////////////////////// END Edit Session Controller ///////////////////////////////////////////////////////





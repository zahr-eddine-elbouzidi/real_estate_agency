
 
 ////////////////////////////////////// BEGIN Add Caegory Controller ///////////////////////////////////////////////////////

 app.controller('ModeListCtrl',['$scope', '$rootScope','$filter', '$http','$state', '$location','$timeout',
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
         $http.get(API_URL+'/modes/getList/'+$rootScope.user).
         success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        $scope.modes = data.data;
                         angular.copy($scope.modes, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = 5;
	                      $scope.totalItems = $scope.modes.length;
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
                        $scope.itemsPerPage = $scope.modes.length;
                      }else{
                        if($scope.viewby > $scope.modes.length ){
                          $scope.itemsPerPage =  $scope.modes.length;
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
         $scope.deleteMode = function() {

          $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({
                        method:'DELETE',
                        url:API_URL + '/modes/delete/'+id+'/'+$rootScope.user
                      }).success(function(data, status, headers, config) {
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                       load();
                       $location.path('/app/modes-paiements');

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



         $scope.getElement=function(mode){

           
           $state.go('app.editMode', { id : mode.id_mode });

         };

 

 

        $scope.mode = {}; 
  

 
        $scope.saveMode = function() {

        

         $rootScope.loader = true;
         $http.post( API_URL + '/modes/add', 
         {
          'nom_mode':  $scope.mode.nom_mode,
          'created_by':$rootScope.user,

        }).success(function(data, status, headers, config) {
              $rootScope.loader = false;


              if(data.drap== 0 ){

               $scope.message_already = null;

               toaster.pop('warning','Information', '<br>'+"Mode de paiement existe déjà !"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

             }else if (data.drap== 1){

              $scope.message_already = null;
              
               toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");

              load();
              $location.path('/app/modes-paiements'); 


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

app.controller('ModeEditCtrl',['$scope', '$filter','$rootScope', '$http','$state','$stateParams', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', 
 function($scope,$filter, $rootScope, $http,$state,$stateParams, $location,$timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

  $rootScope.loader = false;
  

        /**
        * get Session object
        *
        **/
        $http.get(API_URL+'/modes/getMode/'+$stateParams.id)
        .success(function(response, status, headers, config) {

          $scope.modeEdit = response.data;
          $scope.modeEdit.nom_mode =  response.data.nom_mode;
           console.log($scope.modeEdit);

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
              'nom_mode':  $scope.modeEdit.nom_mode,
              'created_by':$rootScope.user

          },
            url: API_URL + '/modes/edit/'+$stateParams.id
          }).success(function(data, status, headers, config) {
          $rootScope.loader = false;

          if(data.drap==true && data.mustUpload == false){

             

            toaster.pop('warning','Information', '<br>'+"Session existe déjà !"+'<br><br>' + 
             '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
             0, 'trustedHtml', null, "note-toaster-container");



          }else if (data.mustUpload == true){
           
           toaster.pop('warning','Information', '<br>'+"Veuillez importer une image !"+'<br><br>' + 
             '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
             0, 'trustedHtml', null, "note-toaster-container");
           
         }else if(data.drap==false && data.mustUpload == false ){
           
           
           
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
           '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
           0, 'trustedHtml', null, "note-toaster-container");
          
          $state.go('app.modes');

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





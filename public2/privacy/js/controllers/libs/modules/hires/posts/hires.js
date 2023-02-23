app.controller('HiresCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster','$stateParams', function($scope,$filter, $rootScope, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster,$stateParams) {
   
  $scope.stateLoader = true;
   
    $scope.getHiresStates = function(id){
    
     $scope.states = {};
     $scope.stateLoader = true;

      $http.get(API_URL+'/hire/getStateHires/'+id).success(function(data, status, headers, config) {

          //console.log(data.data);
          $scope.states = data.data;
      	  $scope.stateLoader = false;

      });

      
    };

     $scope.getHiresWaitings = function(id){

      $http.get(API_URL+'/hire/getStateHires/'+id).success(function(data, status, headers, config) {

          //console.log(data.data);
          $scope.hiresWating = data.hiresWaiting;
      });

      
    };

    


    $scope.exportJury = function(id){

                   $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExportJury/'+id, 
                   {
                     
                     
                     
                    'created_by':$rootScope.user
                    
                    

                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
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
     //getting file uploader
     var uploader = $scope.uploader = new FileUploader({
      url: API_URL+'/hire/upload/'+$rootScope.user
    });
     $scope.uploadImage = function (item) {
      item.formData.push({type: $scope.type,hire_id : $scope.hire.id , displayed : $scope.param,description : $scope.description});
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
        $http.post( API_URL + '/hire/checkUpload/'+$rootScope.user+'/'+$scope.hire.id+'/'+$scope.type, fd,{
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


    $scope.getChangeConcoursDisplayed = function(id , param_dis) {            
     $rootScope.loader = true;
     $http.post( API_URL + '/hire/getChangeDisplayed/'+id, 
     {
       'displayed':param_dis,
       'created_by':$rootScope.user
     }).success(function(data, status, headers, config) {
       $rootScope.loader = false;
     })
     .error(function(data, status, headers, config) {
     });  
   };


   

   $rootScope.loader = false;
   
   
   $scope.typesComm = {};
   $scope.changeTypeComm = function(){
    
     
    
     $scope.typesComm[0]='Président';
     $scope.typesComm[1]='Membre';
     
     
   };

        /**
         * [load description]
         * @return {[type]} [description]
         */

         $scope.hire = [];
         $scope.hires = [];
         $scope.load = function(etab_id) {
          $rootScope.loader = true;
          
          $http.get(API_URL+'/hire/getList/'+$rootScope.user+"/"+etab_id).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.new_code = data.new_hire_code;
                        $scope.hires  = data.data;
                        $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
                      	  //console.info(data.data);
                        angular.copy($scope.hires, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
	                      $scope.sortReverse  = false;  // set the default sort order
	                      $scope.searchFish   = ''; 
	                      $scope.viewby = $scope.hires.length;
	                      $scope.totalItems = $scope.hires.length;
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
                        $scope.itemsPerPage = $scope.hires.length;
                      }else{
                        if($scope.viewby > $scope.hires.length ){

                          $scope.itemsPerPage =  $scope.hires.length;
                          
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



        $scope.load(); //Call load function

        $http.get(API_URL+'/type/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          $scope.types = data.data;
        });


        $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          
          
          $scope.etablissements = data.data;
          
           
        });
  
  
        $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          
          
          $scope.etablissementsScreen = data.data;
          $scope.etablissementsScreen.push({etablissement_id : -1,etablissement_name : "All"});
           
        });


        $http.get(API_URL+'/sessions/getListActive/'+$rootScope.user).success(function(data, status, headers, config) {
          
          
          $scope.sessions = data.data;
          
        });




        $scope.displayFile =  function(candidat_id){

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat/getJuryAdministration/'+candidat_id)
          .success(function(data, status, headers, config) {
            if(angular.isDefined(data.data)){
              $scope.jury = data.data;

                        //console.log($scope.jury);
                        $rootScope.loader = false;
                      }
                    });

        }; 

        $scope.accepted = $stateParams.accepted;
       


 



        
         /**
          * [deleteCustomer description]
          * @return {[type]} [description]
          */
          $scope.deleteHire = function() {

            $('#confirm-delete').on('click', '.btn-ok', function(e) {
              var $modalDiv = $(e.delegateTarget);
              var id = $(this).data('recordId');
                      //console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({

                        method:'DELETE',
                        url:API_URL + '/hire/delete/'+id+'/'+$rootScope.user

                      }).success(function(data, status, headers, config) {

                        
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)


                       $rootScope.loader = false;
                       $scope.load();
                                  //$location.path('/app/customers');
                       $state.go('app.hires');

                        if(data.drap==2 ){
                          
                   
                          
                          toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                          $location.path('/app/hires');    

                        }else{
                           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                    '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                    0, 'trustedHtml', null, "note-toaster-container");
                        }

                     




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
        */


        $scope.loadCommission = function(id) {
         
         $scope.hire_id_actif = id;
        // console.log($scope.hire_id_actif);
        
        $rootScope.loader = true;

        $http.get(API_URL+'/etablissement/getListJuryUniversity/'+id+'/'+$rootScope.user)

        .success(function(data, status, headers, config) {
          
          
         $scope.jury = data.data;
         $rootScope.loader = false;

         
       }).error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });

     }


     

     
     
     
     
     $scope.hire_id_actif = null;
     
     $scope.saveCommissionToHire = function(){
      
       
      if($scope.hire_id_actif != undefined && $scope.hire_id_actif != null){
        
        $rootScope.loader = true;
        
        $http.post( API_URL + '/hire/confirmCommission/'+$scope.hire_id_actif+'/'+$rootScope.user, 
        {

          'commission_id':$scope.jurys.jury_id,
          'type' : $scope.jurys.typeComm

        }).success(function(data, status, headers, config) {
         $rootScope.loader = false;
                         //$scope.hire_id_actif = null;
                         toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");
                         
                       }).error(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        	 //$scope.hire_id_actif = null;
                          });
                       
                     }
                     
                     
                   }
                   

        /**
         * [getElement description]
         * @param  {[type]} category [description]
         * @return {[type]}          [description]
         */
         $scope.getElement=function(hire){
           $state.go('app.editHire', { id : hire.id });
         };


         $scope.getImpression=function(hire){
           $state.go('app.listes', { id : hire.id });
         };

         $scope.getResults=function(hire){
           $state.go('app.results', { id : hire.id });
         };


         $scope.getCandidat=function(hire){
           $state.go('app.candidat', { id : hire.id });
         };

         $scope.getRequests=function(hire){
           $state.go('app.requests', { id : hire.id , slug : hire.slug});
         };
         
         $scope.getFilesForAccept=function(postuler_id , candidat_id){
          
           $state.go('app.files', { id : candidat_id , postuler_id : postuler_id });
         };
         
         
         $scope.accepter = function(){
           
           
           $rootScope.loader = true;
           
           
           $http.post( API_URL + '/postuler/accpted/'+$stateParams.postuler_id, 
           {
            'comment':$scope.comment,

            'dossier':$scope.dossier,

            'accepted' : 1,
            
            'accepted_by':$rootScope.user
            
            

          }).success(function(data, status, headers, config) {

            $scope.load();   
                   		// load();
                      
                       
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
          .error(function(data, status, headers, config) {
            $rootScope.loader = false;
          });


        }
        

        $scope.rejeter = function(){

          $rootScope.loader = true;

          
          $http.post( API_URL + '/postuler/accpted/'+$stateParams.postuler_id, 
          {
            'comment':$scope.comment,

            'dossier':$scope.dossier,

            'accepted' : 0,
            
            'accepted_by':$rootScope.user
            
            

          }).success(function(data, status, headers, config) {
            $scope.load();         
                    //load();
                    
                    $rootScope.loader = false;
                    toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                    
                  })
          .error(function(data, status, headers, config) {
            $rootScope.loader = false;
          });

        }
        
        
        $scope.annulerRejet = function(){

         $rootScope.loader = true;
         $http.post( API_URL + '/postuler/accpted/'+$stateParams.postuler_id, 
         {
          'comment':$scope.comment,

          'dossier':$scope.dossier,

          'accepted' : 2,
          
          'accepted_by':$rootScope.user
          
          

        }).success(function(data, status, headers, config) {
          $scope.load();   
          
          $rootScope.loader = false;
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
          
        })
        .error(function(data, status, headers, config) {
          $rootScope.loader = false;
        });

      }



       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveHire = function() {

          
         $rootScope.loader = true;
         
                      //console.log($scope.hire);

                   /* var session_date_begin = new Date($scope.hire.session_date_begin);
                    var session_date_end = new Date($scope.hire.session_date_end);
                    var hire_date = new Date($scope.hire.hire_date);

                    alert(session_date_begin.toISOString());

                    if(session_date_begin > session_date_end ){
                      alert('La date de session doit etre inferieur a la date de fin de dépôt de dossier !');
                    }else if(session_date_end > hire_date){
                      alert('La date de concours doit etre supérieur a la date de fin de dépôt de dossier !');
                    }else if(1==2){

                      */ 

                      $http.get(API_URL+'/hire/getList/'+$rootScope.user).
                        success(function(data, status, headers, config) {
                        $scope.hire.hire_code = data.new_hire_code;
                      

                      $http.post( API_URL + '/hire/add', 
                      {
                        
                        'hire_code':$scope.hire.hire_code,
                        //'session_date_end': $filter('date')(new Date( $scope.hire.session_date_end), 'yyyy-MM-dd'),
                        //'hire_date':$filter('date')(new Date( $scope.hire.hire_date), 'yyyy-MM-dd'),
                        'specialty_fr':$scope.hire.specialty_fr,
                        'color':$scope.hire.color,
                        'created_by':$rootScope.user,
                        'post_number' : $scope.hire.post_number,
                        //'adresse' : $scope.hire.adresse,
                        'type_id' : $scope.type.type_id,
                        'etablissement_id' : $scope.type.etablissement_id,
                        'session_id' : $scope.type.session_id,
                        'type_poste' : $scope.type_poste
                        

                      }).success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        if(data.drap==false){

                         

                          toaster.pop('warning','Information', '<br>'+"Le code du concours existe déjà !"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");



                        }else  if(data.drap==true ){
                          
                          $scope.load();   
                          
                          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                          $location.path('/app/hires');    

                        }
                        else  if(data.drap==2 ){
                          
                          $scope.load();   
                          
                          toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                          $location.path('/app/hires');    

                        }
                      })
                      .error(function(data, status, headers, config) {
                       $rootScope.loader = false;
                     });

                      });


                   // }

                   
                   


                   
                 };
                 

                 
               }]);






app.controller('EditHiresCtrl',['$scope', '$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  

  
  

  $http.get(API_URL+'/type/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    $scope.types = data.data;
  });

  $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
    
    
    $scope.etablissements = data.data;
    
  });



        $http.get(API_URL+'/sessions/getListActive/'+$rootScope.user).success(function(data, status, headers, config) {
          
          
          $scope.sessions = data.data;
          
        });


  $http.get(API_URL+'/hire/getHire/'+$stateParams.id)
  .success(function(response, status, headers, config) {


    $scope.hireEdit = response.data;
    $scope.hireEdit.hire_code = response.data.hire_code;
    $scope.hireEdit.session_date_begin =new Date(response.data.session_date_begin) ;
    $scope.hireEdit.session_date_end = new Date(response.data.session_date_end);
    $scope.hireEdit.hire_date = new Date(response.data.hire_date);
    $scope.hireEdit.specialty_fr = response.data.specialty_fr;
    $scope.hireEdit.color = response.data.color;
    $scope.hireEdit.post_number = response.data.post_number;
    $scope.hireEdit.adresse = response.data.adresse;
    $scope.hireEdit.type_id = response.data.type_id;
    $scope.hireEdit.etablissement_id = response.data.etablissement_id;
    $scope.hireEdit.session_id = response.data.session_id;
    $scope.hireEdit.type_poste = response.data.type;

  });

  

       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveHire = function(id) {

          
         $rootScope.loader = true;



         
         
         $http.post( API_URL + '/hire/edit/'+id, 
         {
          'hire_code':$scope.hireEdit.hire_code,
          'session_date_begin':null,
          'session_date_end':$filter('date')(new Date($scope.hireEdit.session_date_end), 'yyyy-MM-dd'),
          'hire_date':$filter('date')(new Date($scope.hireEdit.hire_date), 'yyyy-MM-dd'),
          'specialty_fr':$scope.hireEdit.specialty_fr,
          'color':$scope.hireEdit.color,
          'created_by':$rootScope.user,
          'post_number' : $scope.hireEdit.post_number,
          'adresse' : $scope.hireEdit.adresse,
          'type_id' : $scope.hireEdit.type_id,
          'type_poste':$scope.hireEdit.type_poste,
          'etablissement_id':$scope.hireEdit.etablissement_id,
          'session_id':$scope.hireEdit.session_id
          

        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          if(data.drap==true){

           

            toaster.pop('warning','Information', '<br>'+"Le code du concours existe déjà !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");


          }else  if(data.drap==false ){
            
           
           toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
           
           $state.go('app.hires');   

         }else  if(data.drap==2 ){
                          
           toaster.pop('error','Information', '<br>'+"Vous n'avez pas le droit d'effectuer cette opération!"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                          $location.path('/app/hires');    

                        }
       })
        .error(function(data, status, headers, config) {
         $rootScope.loader = false;
       });

        


        
      };
      

      
    }]);







app.controller('RequestsCtrl',['$scope','$filter' ,'$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {

  $rootScope.loader = false;

  $scope.candidatss = {};
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
    //console.log($scope.types);
  });

  $http.get(API_URL+'/hire/getHireById/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.hireEdit = response.data;
    $scope.hireEdit.type = response.data[0].type_name;
    $scope.hireEdit.category_id = response.data[0].categorie_id;
    $scope.hireEdit.hire_code = response.data[0].hire_code;
    $scope.profile = response.data[0].type_profile;
    $scope.hireEdit.specialty_fr = response.data[0].specialty_fr;
    $scope.hireEdit.hire_date = response.data[0].hire_date;
    $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data[0].session_date_end), 'yyyy-MM-dd');
    $scope.hireEdit.etablissement = response.data[0].etablissement_name;
    $scope.hireEdit.post_number = response.data[0].post_number; 
  	$scope.hireEdit.is_open = response.data[0].is_open;
 
  });
 


  $http.get(API_URL+'/hire/getStateHires/'+$stateParams.id).success(function(data, status, headers, config) {
    $scope.states = data.data;
  	$scope.hiresWating = null;
  	angular.forEach($scope.states, function(value, key) {
  		//console.log(key + ': ' + value);
    	if(value.type == 'Nbre candidats en attentes'){
        	$scope.hiresWating = value.nbre_wait;
        	return false;
        }
    });
  	
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
  
 
 
  
  
  

  var load = function() {
    $rootScope.loader = true;
    $http.get(API_URL+'/hire/getCandidatsByHires/'+$stateParams.id+'/'+$rootScope.user).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.candidatss = data.data;
                        angular.copy($scope.candidatss, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =$scope.candidatss.length;
                        $scope.totalItems = $scope.candidatss.length;
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
                          $scope.itemsPerPage = $scope.candidatss.length;
                        }else{
                          if($scope.viewby > $scope.candidatss.length ){

                            $scope.itemsPerPage =  $scope.candidatss.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
  }

  load();

 //validation finale des candidats 
 //
 $scope.validation = function(){

    var x = confirm('Étes-vous sûr?');
    if(x){
        $http.get(API_URL+'/hire/getValidationFinale/'+$stateParams.id).success(function(data, status, headers, config) {
	 	    toaster.pop('success','Information - status :'+status, '<br>L\'opération a bien été effectuée<br><br>' + '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 0, 'trustedHtml', null, "note-toaster-container");
       		load();
        });
    }
 } 

  
$scope.styleZone = {};
$scope.validated = false;

    $scope.analyze = function(value) {

      if(value > 20 || value < 0) {

       $scope.styleZone["border"] = "1px solid red";
       $scope.validated = false;

     } else  {
      $scope.styleZone["border"] = "1px solid green";
      $scope.validated = true;

    }
 };

 
var loadAccepted = function() {
    $rootScope.loader = true;
    $http.get(API_URL+'/hire/getCandidatsByHiresAccepted/'+$stateParams.id).success(function(data, status, headers, config) {
      $rootScope.loader = false;
      $scope.candidatsAccepted = data.data;
      $scope.candidatsAcceptedOrder = data.dataOrder;
   
                       
   });
}

  //$rootScope.selectedRow = null;  // initialize our variable to null
  
  $scope.setClickedRow = function(index){  //function that sets the value of selectedRow to current index
     $rootScope.selectedRow = index;
   
  }
 
  loadAccepted();

$scope.clickLoad=function(){
   loadAccepted();
 }

 $scope.getPassing = function(){

  $state.go('app.passing', { id : $stateParams.id },{slug : $stateParams.slug});


}

 




     $scope.candidat = {};
     $scope.confirmNoteEx1 = function(id_po) {

  
          $http.get(API_URL+'/postuler/getNote/'+id_po).
                     success(function(data, status, headers, config) {
                        $scope.note = data.data;
                        $scope.candidat.note_spe = $scope.note.note_spe;
                        $scope.candidat.note_gen = $scope.note.note_gen;
                        $scope.candidat.note_ex1 = $scope.note.note_ex1;
          });
          $('#confirm-note-ex1').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');

                      $rootScope.loader = true;
                      $http.post( API_URL + '/postuler/addNoteExamens/'+id, 
                      {
                        'note_spe' : $scope.candidat.note_spe,
                        'note_gen' : $scope.candidat.note_gen,
                        'note_ora' : null,
                        'note_ex1' : null,
                        'note_ex2' : null,
                        'note_finale' : null,
                        'created_by':$rootScope.user,
                       
                        

                      }).success(function(data, status, headers, config) {
     
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");

                      $scope.candidat.note_ex1 = null;
                      }).error(function(data, status, headers, config) {
                       $rootScope.loader = false;
                     });
                      
      

                   });
          $('#confirm-note-ex1').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
          });
        }

 

       





                    $scope.accepter = function(postuler_id,is_open){
                     
            
                    if(is_open == 1){
                    
                      $rootScope.loader = true;

                     
                     $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                     {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 1,
                      
                      'accepted_by':$rootScope.user
                      
                      

                    }).success(function(data, status, headers, config) {

                      load();
                      

                      $rootScope.loader = false;
                      
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                     $rootScope.loader = false;
                   });
                    
                    }else{
                    	alert("Vous n'avez pas le droit d'accepter les candidats après la validation finale ! Merci de votre compréhension.");
                    }
                     


                  }
                  

                  $scope.rejeter = function(postuler_id,session_date_end , is_open){

                   
                   if(is_open == 1){
                  
                   	$rootScope.loader = true;
                  
                  	 if($filter('date')(new Date(), 'yyyy-MM-dd') > session_date_end){
                     
                      $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                    {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 0,

                      'accepted_by':$rootScope.user



                    }).success(function(data, status, headers, config) {
                      load();

                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");

                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });
                     
                     }else{
                     	$rootScope.loader = false;
                     	alert("Vous n'avez pas le droit de rejeter les dossiers avant la date limite de dépôt, Cette opération accessible après la date limite de dépôt, Merci de votre compréhension.");
                     
                     }
                  	 
                   
                   
                   }else{
                  		alert("Vous n'avez pas le droit de rejeter les candidats après la validation finale ! Merci de votre compréhension.");
                   }
                    
               
                   

                  }
                  
                  
                  $scope.annulerRejet = function(postuler_id,is_open){

                  if(is_open == 1){
                    $rootScope.loader = true; 
                    $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                    {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 2,
                      
                      'accepted_by':$rootScope.user
                      
                      

                    }).success(function(data, status, headers, config) {
                      load();
                      
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });
                  }else{
                    	alert("Vous n'avez pas le droit d'annuler le rejet après la validation finale des candidats ! Merci de votre compréhension.");
                  }
                    

                  }


 
  
 

                  $scope.export = function(){

                    if($scope.type_expo == undefined){


                      toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type d'exportation !"+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");


                    }else{
                      $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExport/'+$stateParams.id+'/'+$scope.type_expo, 
                   {
                     
                     
                     
                    'created_by':$rootScope.user
                    
                    

                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
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

                   

                }

 

              
              
}]);




app.controller('RequestsOralCtrl',['$scope','$filter' ,'$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {

  $rootScope.loader = false;

  $scope.candidatss = {};
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


  
  $http.get(API_URL+'/type/getList/'+$rootScope.user).
  success(function(data, status, headers, config) {
    $scope.types = data.data;
  });

  $http.get(API_URL+'/hire/getHireById/'+$stateParams.id)
  .success(function(response, status, headers, config) {
    $scope.hireEdit = response.data;
    $scope.hireEdit.type = response.data[0].type_name;
    $scope.hireEdit.hire_code = response.data[0].hire_code;
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
  
 
 
  
  
   
  
$scope.styleZone = {};
$scope.validated = false;

    $scope.analyze = function(value) {

      if(value > 20 || value < 0) {

       $scope.styleZone["border"] = "1px solid red";
       $scope.validated = false;

     } else  {
      $scope.styleZone["border"] = "1px solid green";
      $scope.validated = true;

    }
 };

 
   var loadAccepted = function() {
    $rootScope.loader = true;
    $http.get(API_URL+'/hire/getCandidatsByHiresAccepted/'+$stateParams.id).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.candidatsAccepted = data.dataAuthorize;
                        $scope.candidatResOrauxOrdre = data.dataOrOrder;
                        $scope.candidatResFinaleOrdre = data.finalOrder;
                        console.log($scope.candidatsAccepted);
                        angular.copy($scope.candidatsAccepted, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.candidatsAccepted.length;
                        $scope.totalItems = $scope.candidatsAccepted.length;
                        $scope.currentPage = 1;
                        $scope.itemsPerPage = $scope.viewby;
                        $scope.maxSize = 5; //Number of pager buttons to show
                        $scope.setPage = function (pageNo) {
                          $scope.currentPage = pageNo;
                        };
                        $scope.pageChanged = function() {
                        };
                       $scope.setItemsPerPage = function(num) {
                        if(num === 'Tous'){
                          $scope.itemsPerPage = $scope.candidatsAccepted.length;
                        }else{
                          if($scope.viewby > $scope.candidatsAccepted.length ){

                            $scope.itemsPerPage =  $scope.candidatsAccepted.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
  }

  //$rootScope.selectedRow = null;  // initialize our variable to null
  
  $scope.setClickedRow = function(index){  //function that sets the value of selectedRow to current index
     $rootScope.selectedRow = index;
   
  }
 
  loadAccepted();

  $scope.clickLoad=function(){
   loadAccepted();
 }

 $scope.getPassing = function(){

  $state.go('app.passing', { id : $stateParams.id },{slug : $stateParams.slug});


}

 


    

    $scope.candidat = {};
     $scope.confirmNoteEx2 = function(id_po) {

               $http.get(API_URL+'/postuler/getNote/'+id_po).
                     success(function(data, status, headers, config) {
                        $scope.note = data.data;
                       
                         $scope.candidat.note_ora = $scope.note.note_ex2;
                         
                     });


          $('#confirm-note-ex2').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
                     //alert(id);


      

                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http.post( API_URL + '/postuler/addNoteExamens/'+id, 
                      {
                        'note_spe' : null,
                        'note_gen' : null,
                        'note_ora' : $scope.candidat.note_ora,
                        'note_ex1' : null,
                        'note_ex2' : null,
                        'note_finale' : null,
                        'created_by':$rootScope.user,
                       
                        

                      }).success(function(data, status, headers, config) {
     
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)
                       $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");

                      $scope.candidat.note_ex1 = null;
                      }).error(function(data, status, headers, config) {
                       $rootScope.loader = false;
                     });
                      
      

                   });
          $('#confirm-note-ex2').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
          });
        }

       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveHire = function(id) {

          
         $rootScope.loader = true;
         
                      //console.log($scope.hire);

                      $http.post( API_URL + '/hire/edit/'+id, 
                      {
                        'hire_code': $scope.hireEdit.hire_code,
                        'session_date_begin':$filter('date')(new Date($scope.hireEdit.session_date_begin), 'yyyy-MM-dd'),
                        'session_date_end':$filter('date')(new Date($scope.hireEdit.session_date_end), 'yyyy-MM-dd'),
                        'hire_date':$filter('date')(new Date($scope.hireEdit.hire_date), 'yyyy-MM-dd'),
                        'specialty_fr':$scope.hireEdit.specialty_fr,
                        'color':$scope.hireEdit.color,
                        'created_by':$rootScope.user,
                        'post_number' : $scope.hireEdit.post_number,
                        'type_id' : $scope.hireEdit.type_id
                        

                      }).success(function(data, status, headers, config) {
                        $rootScope.loader = false;
                        if(data.drap==true){

                         

                          toaster.pop('warning','Information', '<br>'+"Le code du concours existe déjà !"+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");


                        }else  if(data.drap==false ){
                          
                          load();
                          
                          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                            0, 'trustedHtml', null, "note-toaster-container");
                          
                          $location.path('/app/hires');    

                        }
                      })
                      .error(function(data, status, headers, config) {
                       $rootScope.loader = false;
                     });

                      


                      
                    };






                    $scope.accepter = function(postuler_id){
                     
                      

                     $rootScope.loader = true;

                     
                     $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                     {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 1,
                      
                      'accepted_by':$rootScope.user
                      
                      

                    }).success(function(data, status, headers, config) {

                      load();
                      

                      $rootScope.loader = false;
                      
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                     $rootScope.loader = false;
                   });


                  }
                  

                  $scope.rejeter = function(postuler_id){

                    $rootScope.loader = true;

                    
                    $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                    {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 0,
                      
                      'accepted_by':$rootScope.user
                      
                      

                    }).success(function(data, status, headers, config) {
                      load();
                      
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });

                  }
                  
                  
                  $scope.annulerRejet = function(postuler_id){

                    $rootScope.loader = true;

                    
                    $http.post( API_URL + '/postuler/accpted/'+postuler_id, 
                    {
                      'comment':$scope.comment,

                      'dossier':$scope.dossier,

                      'accepted' : 2,
                      
                      'accepted_by':$rootScope.user
                      
                      

                    }).success(function(data, status, headers, config) {
                      load();
                      
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });

                  }



                  $scope.passerOrale = function(postuler_id){

                    $rootScope.loader = true;

                    
                    $http.post( API_URL + '/postuler/passed/'+postuler_id, 
                    {
                      
                     
                      'passed' : 1,
                      'created_by' : $rootScope.user
                      
                      
                    }).success(function(data, status, headers, config) {
                      loadAccepted();
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });

                  }


                  $scope.annulerOrale = function(postuler_id){

                    $rootScope.loader = true;

                    
                    $http.post( API_URL + '/postuler/unPassed/'+postuler_id, 
                    {
                      
                     
                      'passed' : 0,
                      'created_by' : $rootScope.user
                      
                      
                    }).success(function(data, status, headers, config) {
                      loadAccepted();
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
                    .error(function(data, status, headers, config) {
                      $rootScope.loader = false;
                    });

                  }

 
 

                  $scope.export = function(){

                    if($scope.type_expo == undefined){


                      toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type d'exportation !"+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");


                    }else{
                      $rootScope.loader = true;

                   $http.post( API_URL + '/hire/getExport/'+$stateParams.id+'/'+$scope.type_expo, 
                   {
                     
                     
                     
                    'created_by':$rootScope.user
                    
                    

                  }).success(function(data, status, headers, config) {
                   
                    $rootScope.loader = false;

                    if(data.drap == true){

                      
                      
                     toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
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

                   

                }



                $scope.exportOrale = function(){

                  if($scope.type_expo == undefined){
                    toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type d'exportation !"+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                  }else{

                    $rootScope.loader = true;

                 $http.post( API_URL + '/hire/getExportOrale/'+$stateParams.id+'/'+$scope.type_expo, 
                 {
                   
                   
                   
                  'created_by':$rootScope.user
                  
                  

                }).success(function(data, status, headers, config) {
                 
                  $rootScope.loader = false;

                  if(data.drap == true){

                    toaster.pop('info','Information', '<br>'+data.message+'<br><br>' + 
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

                 

              }


              
              
            }]);





app.controller('ListFileAdministrationCtrl',['$scope', '$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   


             $scope.hireEdit = {};
             $scope.candidat = {};
             $scope.postuler = {};
             $http.get(API_URL+'/postuler/getPostuler/'+$stateParams.id)
             .success(function(response, status, headers, config) {
               
                //get hire object
                $scope.hireEdit = response.hire;
                $scope.hireEdit.type = response.hire[0].type_name;
                $scope.hireEdit.hire_code = response.hire[0].hire_code;
                $scope.hireEdit.specialty_fr = response.hire[0].specialty_fr;
                $scope.hireEdit.hire_date = response.hire[0].hire_date;
                $scope.hireEdit.session_date_end = $filter('date')(new Date(response.hire[0].session_date_end), 'yyyy-MM-dd');
                $scope.hireEdit.etablissement = response.hire[0].etablissement_name;
                $scope.hireEdit.post_number = response.hire[0].post_number;   

                //get candidat object
                $scope.candidat = response.candidat;

                //get postuled object
                $scope.postuler = response.postuler;


             });

        

        $scope.profile = null;
        $scope.files = {};
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

        var loading = function(){

          if(angular.isDefined($stateParams.id)){

            $http.get(API_URL+'/file/getList/'+$stateParams.id+'/'+$rootScope.user).success(function(data, status, headers, config) {
              
              
                        $scope.files = data.data;
                        if(angular.isDefined($scope.files)){
                         $scope.profile = $scope.files[0].niveau;
                       }else{
                         $scope.profile = null;
                       }
             
                        // console.log($scope.niveau);

                         // console.info(data.data);
                        angular.copy($scope.files, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.files.length;
                        $scope.totalItems = $scope.files.length;
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
                          $scope.itemsPerPage = $scope.files.length;
                        }else{
                          if($scope.viewby > $scope.files.length ){

                            $scope.itemsPerPage =  $scope.files.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }




                   });

          }

          

        };

        loading();

        $scope.refresh = function(){
          loading();
        };


        $scope.displayFile =  function(candidat_id){

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat/getJuryAdministration/'+candidat_id)
          .success(function(data, status, headers, config) {
            if(angular.isDefined(data.data)){
              $scope.jury = data.data;

                        //console.log($scope.jury);
                        $rootScope.loader = false;
                      }
                    });

        };





          $scope.accepter = function(){
           
           
           $rootScope.loader = true;
           
           
           $http.post( API_URL + '/postuler/accpted/'+$stateParams.id, 
           {
            'comment':$scope.comment,

            'dossier':$scope.dossier,

            'accepted' : 1,
            
            'accepted_by':$rootScope.user
            
            

          }).success(function(data, status, headers, config) {

            loading();      
                      // load();
                      
                       
                      $rootScope.loader = false;
                      toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                      
                    })
          .error(function(data, status, headers, config) {
            $rootScope.loader = false;
          });


        }
        

        $scope.rejeter = function(session_date_end){

          $rootScope.loader = true;
                  
                  	 if($filter('date')(new Date(), 'yyyy-MM-dd') > session_date_end){
                     
                     $http.post( API_URL + '/postuler/accpted/'+$stateParams.id, 
          {
            'comment':$scope.comment,

            'dossier':$scope.dossier,

            'accepted' : 0,
            
            'accepted_by':$rootScope.user
            
            

          }).success(function(data, status, headers, config) {
            loading();      
                    //load();
                    
                    $rootScope.loader = false;
                    toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                    
                  })
          .error(function(data, status, headers, config) {
            $rootScope.loader = false;
          });

                     
                     }else{
                     	$rootScope.loader = false;
                     	alert("Vous n'avez pas le droit de rejeter les dossiers avant la date limite de dépôt, Cette opération accessible après la date limite de dépôt, Merci de votre compréhension.");
                     
                     }
                  	 

          
         
        }
        
        
        $scope.annulerRejet = function(){

         $rootScope.loader = true;
         $http.post( API_URL + '/postuler/accpted/'+$stateParams.id, 
         {
          'comment':$scope.comment,

          'dossier':$scope.dossier,

          'accepted' : 2,
          
          'accepted_by':$rootScope.user
          
          

        }).success(function(data, status, headers, config) {
          loading();
          
          $rootScope.loader = false;
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
          
        })
        .error(function(data, status, headers, config) {
          $rootScope.loader = false;
        });

      }





  }]);
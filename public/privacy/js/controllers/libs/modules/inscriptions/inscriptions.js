 


app.controller('InscriptionsListCtrl',['$scope','$filter', '$rootScope', '$http','$state','$stateParams', '$location','$timeout',
'ServiceTranslate','FileUploader','API_URL','toaster', 
function($scope,$filter, $rootScope, $http,$state,$stateParams, $location,
  $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
 
  $rootScope.loader = false;
  
 console.log($stateParams.id);

  var load = function() {

   $rootScope.loader = true;


   $http.get(API_URL+'/inscriptions/getList/'+$rootScope.user+'/'+$stateParams.id).success(function(data, status, headers, config) {
     
     
                       $rootScope.loader = false;
                       $scope.inscriptions = data.data;
                       angular.copy($scope.inscriptions, $scope.copy);
                       $scope.sortType     = 'nom'; // set the default sort type
                       $scope.sortReverse  = false;  // set the default sort order
                       $scope.searchFish   = ''; 
                       $scope.viewby =  $scope.inscriptions.length;
                       $scope.totalItems = $scope.inscriptions.length;
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
                         $scope.itemsPerPage = $scope.inscriptions.length;
                       }else{
                         if($scope.viewby > $scope.inscriptions.length ){

                           $scope.itemsPerPage =  $scope.inscriptions.length;
                           
                         }else{
                          $scope.itemsPerPage = num;
                        }
                        
                      }
                    }    
                    

                  });
 }


 $http.get(API_URL+'/candidat_back/getCandidat/'+$stateParams.id).success(function(data, status, headers, config) {
   
   
   $scope.candidat = data.data;

   console.log($scope.candidat);
   
 });

 $http.get(API_URL+'/filieres/getList/'+$rootScope.user).success(function(data, status, headers, config) {
   
   
    $scope.filieres = data.data;

    console.log($scope.filieres);
    
  });
 

 $http.get(API_URL+'/modes/getList/'+$rootScope.user).success(function(data, status, headers, config) {
   
   
    $scope.modes = data.data;

    console.log($scope.modes);
    
  });



 $http.get(API_URL+'/paiements/getList/'+$rootScope.user+'/'+$stateParams.id).success(function(data, status, headers, config) {
   
   
    $scope.paiements = data.data;

    console.log($scope.paiements);
    
  });
 
  //$rootScope.selectedRow =null;
  $scope.setClickedRow = function(index){  //function that sets the value of selectedRow to current index
    $rootScope.selectedRow = index;
    console.log($rootScope.selectedRow);

    if($rootScope.selectedRow !== undefined && $rootScope.selectedRow != null && $rootScope.selectedRow != ""){


      $http.get(API_URL+'/paiements/getList/'+$rootScope.user+'/'+$rootScope.selectedRow).success(function(data, status, headers, config) {
   
   
        $scope.paiements = data.data;
     
        console.log($scope.paiements);
        
      });


    }
  

 }

 $scope.getPart = function(id){  //function that sets the value of selectedRow to current index
 

  if(id !== undefined && id != null && id != ""){


    $http.get(API_URL+'/inscriptions/getPartenaireByFiliere/'+id).success(function(data, status, headers, config) {
 
 
      $scope.partenaires = data.data;
   
      console.log($scope.partenaires);

      $scope.inscriptions.mt_reste_trait_dossier = data.data.frais_traitement_dossier;
      
    });


  }


}

 
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
                       url: API_URL+ '/inscriptions/delete/'+id+'/'+$rootScope.user
                     }).success(function(data, status, headers, config) {
                       $rootScope.loader = false;
                       load();
                       $state.go('app.inscriptions', { id : $stateParams.id });
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






$scope.deletePaiement = function(id) {
   

  $('#confirm-deletepaie').on('click', '.btn-paie', function(e) {
    var $modalDiv = $(e.delegateTarget);
    var id = $(this).data('recordId');
                    //console.log(id);
                    // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                    // $.post('/api/record/' + id).then()

                    $rootScope.loader = true;    
                    $http({
                      method:'DELETE',
                      url: API_URL+ '/paiements/delete/'+id+'/'+$rootScope.user
                    }).success(function(data, status, headers, config) {
                      $rootScope.loader = false;
                      load();
                      $scope.setClickedRow($rootScope.selectedRow);
                      $state.go('app.inscriptions', { id : $stateParams.id });
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
  $('#confirm-deletepaie').on('show.bs.modal', function(e) {
    var data = $(e.relatedTarget).data();
    $('.titlepaie', this).text(data.recordTitlepaie);
    $('.btn-paie', this).data('recordId', data.recordId);
  });
}






 $scope.saveInscription = function() {
    $rootScope.loader = true;
    
  
  
  
    if($scope.inscriptions.filiere_id===undefined){
     
     toaster.pop('error', 'Message', "Veuillez séléctionner une filière !");
     $rootScope.loader = false;
     
   }else{
  
     $http.post(API_URL + '/inscriptions/add', 
     {
  
       'date_inscription': $filter('date')(new Date( $scope.inscriptions.date_inscription), 'yyyy-MM-dd'),
       'candidat_id':$stateParams.id,
       'filiere_id':$scope.inscriptions.filiere_id,
       'mt_reste_trait_dossier' : $scope.inscriptions.mt_reste_trait_dossier,
       'mt_paye_trait_dossier' : 0,
       'created_by':$rootScope.user
  
     }).success(function(data, status, headers, config) {
  
       $rootScope.loader = false;
  
       if(data.drap==false){
  
        toaster.pop('warning','Information', '<br>'+"Candidat est déjà inscrit !"+'<br><br>' + 
         '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
         0, 'trustedHtml', null, "note-toaster-container");
  
  
  
      }else if(data.drap==true ){
       
       load();
       $scope.setClickedRow($rootScope.selectedRow);

       toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
         '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
         0, 'trustedHtml', null, "note-toaster-container");

       
         $state.go('app.inscriptions', { id : $stateParams.id }); 
  
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









 $scope.savePaiement = function() {
    $rootScope.loader = true;
    
  
  
  
    if($scope.paiement.mt_paye===undefined || $scope.paiement.mt_paye== 0 || $scope.paiement.mt_paye=='' || $scope.paiement.mt_paye===null){
     
      toaster.pop('error', 'Message', "Veuillez saisir le montant !");
      $rootScope.loader = false;
      
    }else if($scope.paiement.mode_id===undefined){
     
     toaster.pop('error', 'Message', "Veuillez séléctionner un mode de paiement !");
     $rootScope.loader = false;
     
   }else if($rootScope.selectedRow === undefined || $rootScope.selectedRow == null || $rootScope.selectedRow ==""){

    toaster.pop('error', 'Message', "Veuillez séléctionner une inscription !");
    $rootScope.loader = false;

   }else{
  
     $http.post(API_URL + '/paiements/add', 
     {
  
       'date_paiement': $filter('date')(new Date( $scope.paiement.date_paiement), 'yyyy-MM-dd'),
       'mt_paye':$scope.paiement.mt_paye,
       'type_paie':$scope.paiement.type_paie,
       'remise':$scope.paiement.remise,
       'inscription_id':$rootScope.selectedRow,
       'mode_id':$scope.paiement.mode_id,
       'created_by':$rootScope.user
  
     }).success(function(data, status, headers, config) {
  
       $rootScope.loader = false;
  
       if(data.drap==false){
  
        toaster.pop('warning','Information', '<br>'+"Vous devriez vérifier le montant! <br />Le reste à payer : "+data.reste+" DH."+'<br><br>' + 
         '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
         0, 'trustedHtml', null, "note-toaster-container");
  
  
  
      }else if(data.drap==true ){
       
       load();

         //$rootScope.selectedRow =null;
       $scope.setClickedRow($rootScope.selectedRow);
       
       toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
         '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
         0, 'trustedHtml', null, "note-toaster-container");
       
         $state.go('app.inscriptions', { id : $stateParams.id }); 
  
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






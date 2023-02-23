app.controller('CandidatCtrl',['$scope','$filter', '$rootScope','$stateParams', '$http','$state', '$location','$timeout',
  'ServiceTranslate','FileUploader','API_URL','toaster', function($scope,$filter, $rootScope,$stateParams, $http,$state, $location,
    $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   

    var getJuryNumbers = function(){
      $http.get(API_URL+'/candidat/getJuryNbres/'+$rootScope.user).
        success(function(data, status, headers, config) {
        if(angular.isDefined(data.data)){
          $scope.nbre_jury = data.data.nbre_jury;
        }else{
         $scope.nbre_jury = 0;
       }
     }); 
    };


   // getJuryNumbers();


    $rootScope.loader = false;
    
    $scope.checked =  function(){
      $rootScope.loader = true;
      $http.get(API_URL+'/candidat/checkPieces/'+$rootScope.user).
      success(function(data, status, headers, config) {
       
        $rootScope.loader = false;
        if(angular.isDefined(data.data)){
          $scope.piecesManqu = data.data;
        
        }else{
         $scope.piecesManqu = null;
         
       }


     }); 
    };

        $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          
          $scope.etablissements = data.data;
          
        });


        $scope.hires = {};
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
         
         $scope.load = function(etab_id) {

          $rootScope.loader = true;
          $http.get(API_URL+'/candidat/getListHires/'+$rootScope.user+'/'+etab_id).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.hires = data.data;
                        $scope.length = $scope.hires.length;
                        if(data.message != "" ){
                          //toaster.pop('danger', 'Message', data.message); 
                          $state.go('app.profil');
                        }
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

       

 

         /*$http.get(API_URL+'/type/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          $scope.types = data.data;
        });





     


           $scope.candidat = {};
           var getCandidat  = function(){

             
            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

             $scope.candidat = response.data;
             
             

                // console.log(response.data);
                if(angular.isDefined(response.data)){

                  $scope.candidat.cin = response.data.cin;
                  $scope.candidat.nom = response.data.nom;
                  $scope.candidat.prenom = response.data.prenom;
                  $scope.candidat.nom_ar = response.data.nom_ar;
                  $scope.candidat.prenom_ar = response.data.prenom_ar;
                  $scope.candidat.tel = response.data.tel;
                  $scope.candidat.email = response.data.usr_email;
                  $scope.candidat.adresse_fr = response.data.adresse_fr;
                  $scope.candidat.adresse_ar = response.data.adresse_ar;
                  $scope.candidat.sexe = response.data.sexe;
                  $scope.candidat.date_naiss = new Date(response.data.date_naiss);
                  $scope.candidat.lieu_naiss = response.data.lieu_naiss;
                  $scope.candidat.diplome = response.data.diplome;
                  $scope.candidat.specialite = response.data.specialite;
                  $scope.candidat.date_obtention = response.data.date_obtention;
                  $scope.candidat.niveau = response.data.niveau;
                  $scope.candidat.mention = response.data.mention;
                  $scope.candidat.etablissement = response.data.etablissement;
                  $scope.candidat.parcours = response.data.parcours;
                  

                  if(response.data.etablissement == 'null' || response.data.etablissement == null || response.data.etablissement == '' ){
                    $scope.fonct = 'Non';
                  }else{
                    $scope.fonct = 'Oui';
                  }
                  
                  if(response.data.is_fonctionnaire == 1){
                   $scope.candidat.is_fonctionnaire = true;
                 }else{
                   $scope.candidat.is_fonctionnaire = false;
                 }


                 

               }

               

               

             });


          };*/


         // getCandidat();

          //get Membres de jury de la thèse
         /* $scope.getThese = function(hire_id){

            $http.get(API_URL+'/file/getThese/'+$rootScope.user+'/'+hire_id)
            .success(function(response, status, headers, config) {

               if(angular.isDefined(response.data)){

                $state.go('app.my-jury',{id_file : response.data.id});
                

              }

              

              

            });


          };*/

 

       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveCandidat = function() {
                  $rootScope.loader = true;
 
                 $http.post( API_URL + '/candidat/add', 
                 {
                  'usr_name' : $rootScope.user,
                  'cin_candidat' : $scope.candidat.cin_candidat,
                  'nom_candidat': $scope.candidat.nom_candidat,
                  'prenom_candidat': $scope.candidat.prenom_candidat,
                  'date_naiss_candidat': $filter('date')(new Date($scope.candidat.date_naiss_candidat), 'yyyy-MM-dd'),  
                  'lieu_naiss_candidat': $scope.candidat.lieu_naiss_candidat,
                  'nationalite_candidat': $scope.candidat.nationalite_candidat,
                  'sexe_candidat': $scope.candidat.sexe_candidat,
                  'civilite_candidat': $scope.candidat.civilite_candidat,
                  'tel_candidat': $scope.candidat.tel_candidat,
                  'adresse_candidat': $scope.candidat.adresse_candidat,
                  'ville_candidat': $scope.candidat.ville_candidat,
                  'code_postal_candidat': $scope.candidat.code_postal_candidat,
                  'pays_candidat': $scope.candidat.pays_candidat,
                  'email_candidat': $scope.candidat.email_candidat,
                  'num_passport': $scope.candidat.num_passport,
                  'date_delivrance_passport': $filter('date')(new Date($scope.candidat.date_delivrance_passport), 'yyyy-MM-dd'),  
                  'date_dexpiration_passport': $filter('date')(new Date($scope.candidat.date_dexpiration_passport), 'yyyy-MM-dd'), 
                  'lieu_delivrance_passport': $scope.candidat.lieu_delivrance_passport,

                  /**
                   * parcours actuel
                   */
                  'diplome_obtenu': $scope.candidat.diplome_obtenu,
                  'option_diplome_candidat': $scope.candidat.option_diplome_candidat,
                  'annee_obtention_diplome_candidat': $scope.candidat.annee_obtention_diplome_candidat,
                  'etab_delivre_diplome_candidat': $scope.candidat.etab_delivre_diplome_candidat,

                  /**
                   * programme demandé
                   */
                  'pays_demande': $scope.candidat.pays_demande,
                  'ville_demande': $scope.candidat.ville_demande,
                  'etablissement_demande': $scope.candidat.etablissement_demande,
                  'discipline_demande': $scope.candidat.discipline_demande,
                  'specialite_demande': $scope.candidat.specialite_demande,
                  'qualification_demande': $scope.candidat.qualification_demande,
                  'langue_etude_demande': $scope.candidat.langue_etude_demande,
                  'niveau_linguistique_demande': $scope.candidat.niveau_linguistique_demande,
                  'diplome_langue_demande': $scope.candidat.diplome_langue_demande,



                  /**
                   * identification du père
                   */
                  'type_pere':$scope.candidat.type_pere,
                  'nom_pere':$scope.candidat.nom_pere,
                  'prenom_pere':$scope.candidat.prenom_pere,
                  'date_naiss_pere':$filter('date')(new Date($scope.candidat.date_naiss_pere), 'yyyy-MM-dd'), 
                  'nationalite_pere':$scope.candidat.nationalite_pere,
                  'lieu_naiss_pere':$scope.candidat.lieu_naiss_pere,
                  'cin_pere':$scope.candidat.cin_pere,
                  'tel_pere':$scope.candidat.tel_pere,
                  'code_postal_pere':$scope.candidat.code_postal_pere,
                  'adresse_pere':$scope.candidat.adresse_pere,
                  'ville_pere':$scope.candidat.ville_pere,
                  'pays_pere':$scope.candidat.pays_pere,
                  'email_pere':$scope.candidat.email_pere,
                  'profession_pere':$scope.candidat.profession_pere,

                  /**
                   * identification de la mère
                   */
                  'type_mere':$scope.candidat.type_mere,
                  'nom_mere':$scope.candidat.nom_mere,
                  'prenom_mere':$scope.candidat.prenom_mere,
                  'date_naiss_mere':$filter('date')(new Date($scope.candidat.date_naiss_mere), 'yyyy-MM-dd'),
                  'nationalite_mere':$scope.candidat.nationalite_mere,
                  'lieu_naiss_mere':$scope.candidat.lieu_naiss_mere,
                  'cin_mere':$scope.candidat.cin_mere,
                  'tel_mere':$scope.candidat.tel_mere,
                  'code_postal_mere':$scope.candidat.code_postal_mere,
                  'adresse_mere':$scope.candidat.adresse_mere,
                  'ville_mere':$scope.candidat.ville_mere,
                  'pays_mere':$scope.candidat.pays_mere,
                  'email_mere':$scope.candidat.email_mere,
                  'profession_mere':$scope.candidat.profession_mere,




             

                }).success(function(data, status, headers, config) {

                  $rootScope.loader = false;

                  if(angular.isDefined(data.messageExiste)){

                    toaster.pop('danger', 'Message', data.messageExiste);

                  }else{

                   if(data.drap==true ){
                    
                    getCandidat();
                    
                    toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                      '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
                    
                    
                  }
                }


              })
                .error(function(data, status, headers, config) {
                   $rootScope.loader = false;
                });

                


                
              };
            $scope.redirect = function(){
               $state.go('app.mes-concours'); 
            };

              
             $scope.redirectUploadRestFiles = function(id_hire_param){

              var dialog = confirm('Voulez-vous vraiement postuler à ce poste ?');
              if(dialog){

                $state.go('app.upload-rest', { slug : 'divers' , id_hire :  id_hire_param});

              }
                
            };  
       


         
           

           
}]);


app.controller('FilesCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
 

   /*$scope.hireGet = {};
   $http.get(API_URL+'/hire/getHire/'+$stateParams.id_hire)
   .success(function(response, status, headers, config) {
     $scope.hireGet = response.data;
     $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
   });

   $scope.postuled = {};
   $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
   .success(function(response, status, headers, config) {
     $scope.postuled = response.object;    
   });
*/
  $scope.editerFiles = function(){
    $state.go('app.upload', { slug : 'divers' , id_hire :  $stateParams.id_hire});
    
  }; 


  $rootScope.loader = false;

  var loadFiles = function(){

        $scope.fileDatas = [];
        $scope.fileDatasType = [];
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

    $http.get(API_URL+'/candidat/getFilesAll/'+$rootScope.user)
    .success(function(response, status, headers, config) {
     
     
                      if(angular.isDefined(response.dataFiles)){
                        
                        $scope.fileDatas = response.dataFiles;
                        
                       }else{

                        $scope.fileDatas = [];

                       }

                       if(angular.isDefined(response.dataFT)){
                         $scope.fileDatasType = response.dataFT;
                       }else{
                         $scope.fileDatasType = [];
                       }
             
                        angular.copy($scope.fileDatas, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =  $scope.fileDatas.length;
                        $scope.totalItems = $scope.fileDatas.length;
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
                          $scope.itemsPerPage = $scope.fileDatas.length;
                        }else{
                          if($scope.viewby > $scope.fileDatas.length ){

                            $scope.itemsPerPage =  $scope.fileDatas.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });


  };


//load files from databse 
$scope.loadFilesTab = function(){
 // loadFiles();
 
}


//check files
var checkFilesNotUploaded = function(){
  $http.get(API_URL+'/candidat/checkPieces/'+$rootScope.user+"/"+null).
      success(function(data, status, headers, config) {
        if(angular.isDefined(data.data)){
          $scope.piecesManqu = data.data;
        
        }else{
         $scope.piecesManqu = null;
       }
  
  });  
};

//checkFilesNotUploaded();
 

  //for referesh page
  $scope.refFiles = function(){
    //checkFilesNotUploaded();
  };   
   

  
  //delete file function json 
  $scope.deleteFile = function() {

    $('#confirm-delete').on('click', '.btn-ok', function(e) {
      var $modalDiv = $(e.delegateTarget);
      var id = $(this).data('recordId');
      $rootScope.loader = true;
      $http({
        method:'DELETE',
        url:API_URL + '/candidat/deleteFile/'+id+'/'+$rootScope.user

      }).success(function(data, status, headers, config) {

        $rootScope.loader = false;

        if(data.fileExists == false){

             $state.go('app.profil');
             loadFiles();
             
             toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");

              $modalDiv.addClass('loading');
               setTimeout(function() {
                $modalDiv.modal('hide').removeClass('loading');
              }, 500)


        }else{

            toaster.pop('error','Attention', '<br>'+"Vous n'avez pas le droit de supprimer un fichier obligatoire de vos candidatures N.B vous avez postulé "+data.numbers+" fois avec ce type du fichier ! <br /> Pour le supprimer définitivement,Premièrement il faut supprimer vos candidatures dans la rubrique (Mes Candidatures). <br /> Merci de votre compréhension."+'<br><br>' + 
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



  //delete jury function
  $scope.deleteJury = function(id) {

    $('#confirm-delete-jury').on('click', '.btn-jury', function(e) {
      var $modalDiv = $(e.delegateTarget);
            //var id = $(this).data('recordId');
            //console.log(id);
            // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()
            $rootScope.loader = true;
            $http({

              method:'DELETE',
              url:API_URL + '/candidat/deleteJury/'+id+'/'+$rootScope.user

            }).success(function(data, status, headers, config) {

              
             $modalDiv.addClass('loading');
             setTimeout(function() {
              $modalDiv.modal('hide').removeClass('loading');
            }, 500)

             $state.go('app.my-files');
                        //loadFiles();
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



  

  $scope.ROWID = null;
  $scope.file = {};

  $(document).ready(function(){
    $('#confirm').on('show.bs.modal', function (e) {
      $scope.ROWID = $(e.relatedTarget).data('recordId');

    });
  });

  /* !!!: Display data into data type */
 $scope.displayFile =  function(file_id){
    $rootScope.loader = true;
    $http.get(API_URL+'/candidat/getJury/'+$rootScope.user+'/'+file_id)
    .success(function(data, status, headers, config) {
      if(angular.isDefined(data.data)){
        $scope.jury = data.data;
          // console.log($scope.jury);
          $rootScope.loader = false;
          }
      });
  }; 
  /* !!!: END DATA DISPLAY */ 


  



  $scope.saveJury = function() {

    $('#confirm').on('click','.btn-conf', function(e) {
      
      $rootScope.loader = true;
      $http.post( API_URL + '/candidat/saveJury', 
        
      {
        'nom_complet':$scope.file.nom_complet,
        'etablissement':$scope.file.etablissement,
        'specialite':$scope.file.specialite,
        'discipline':null,
        'file_id' : $scope.ROWID,
        'status' : null,
        'mention':null,                  
        'created_by':$rootScope.user
        
      }).success(function(data, status, headers, config) {

        $state.go('app.my-files');
        $scope.file.nom_complet = null;
        $scope.file.etablissement =  null;
        $scope.file.specialite =  null;
        $scope.file.discipline =  null;
        $scope.file.status =  null;
        $scope.file.mention =  null;
        $rootScope.loader = false;
        toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
        
      }).error(function(data, status, headers, config) {
        $rootScope.loader = false;
      });

    });

    $('#confirm').on('click','.btn-conf', function(e) {
      var data = $(e.relatedTarget).data();
      $('.title', this).text(data.recordTitle);
      $('.btn-conf', this).data('recordId', data.recordId);
    });

    

    
    
  };

  
  

  
}]);



app.controller('JuryCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
 

   /*$scope.hireGet = {};
   $http.get(API_URL+'/hire/getHire/'+$stateParams.id_hire)
   .success(function(response, status, headers, config) {
     $scope.hireGet = response.data;
     $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
   });

   $scope.postuled = {};
   $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
   .success(function(response, status, headers, config) {
     $scope.postuled = response.object;    
   });*/

  $scope.editerFiles = function(){
    $state.go('app.upload', { slug : 'divers' , id_hire :  $stateParams.id_hire});
    
  }; 


  $rootScope.loader = false;

  var loadJurys = function(){

        $scope.jury = [];
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

    $http.get(API_URL+'/candidat/getJury/'+$rootScope.user)
    .success(function(data, status, headers, config) {
     
     
                      if(angular.isDefined(data.data)){
                        
                         $scope.jury = data.data;
                        
                       }else{

                        $scope.jury = [];

                       }
             
                        angular.copy($scope.jury, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =  $scope.jury.length;
                        $scope.totalItems = $scope.jury.length;
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
                          $scope.itemsPerPage = $scope.jury.length;
                        }else{
                          if($scope.viewby > $scope.jury.length ){

                            $scope.itemsPerPage =  $scope.jury.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });


  };


//load jury from databse 
$scope.loadJurysMembers= function(){
  loadJurys();
 
}


 
  
  
 $scope.candidat = {};
           var getCandidat  = function(){

             
            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

             $scope.candidat = response.data;
             
             

                // console.log(response.data);
                if(angular.isDefined(response.data)){

                  $scope.candidat.cin = response.data.cin;
                  $scope.candidat.nom = response.data.nom;
                  $scope.candidat.prenom = response.data.prenom;
                  $scope.candidat.nom_ar = response.data.nom_ar;
                  $scope.candidat.prenom_ar = response.data.prenom_ar;
                  $scope.candidat.tel = response.data.tel;
                  $scope.candidat.email = response.data.usr_email;
                  $scope.candidat.adresse_fr = response.data.adresse_fr;
                  $scope.candidat.adresse_ar = response.data.adresse_ar;
                  $scope.candidat.sexe = response.data.sexe;
                  $scope.candidat.date_naiss = new Date(response.data.date_naiss);
                  $scope.candidat.lieu_naiss = response.data.lieu_naiss;
                  $scope.candidat.diplome = response.data.diplome;
                  $scope.candidat.specialite = response.data.specialite;
                  $scope.candidat.date_obtention = response.data.date_obtention;
                  $scope.candidat.niveau = response.data.niveau;
                  $scope.candidat.mention = response.data.mention;
                  $scope.candidat.etablissement = response.data.etablissement;
                  $scope.candidat.parcours = response.data.parcours;
                  

                  if(response.data.etablissement == 'null' || response.data.etablissement == null || response.data.etablissement == '' ){
                    $scope.fonct = 'Non';
                  }else{
                    $scope.fonct = 'Oui';
                  }
                  
                  if(response.data.is_fonctionnaire == 1){
                   $scope.candidat.is_fonctionnaire = true;
                 }else{
                   $scope.candidat.is_fonctionnaire = false;
                 }


                 

               }

               

               

             });


          };


        //  getCandidat();

 
    $scope.ref = function(){
      //getCandidat();
    };
  

  
}]);





app.controller('PostulationCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {

        $rootScope.loader = false;
        $scope.postules = [];
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;
       // $scope.hire = {};
       // $scope.hire.prepared = false;


    var postuleHistory = function() {

        $http.get(API_URL+'/candidat/getFilesAll/'+$rootScope.user).success(
          function(response, status, headers, config) {

                      if(angular.isDefined(response.dataFiles)){
                        $scope.fileDatas = response.dataFT;;
                      }else{
                        $scope.fileDatas = null;
                      }
          });
     
     
                      

          $rootScope.loader = true;

          $http.get(API_URL+'/candidat/getListHiresOld/'+$rootScope.user).success(function(data, status, headers, config) {

                        $rootScope.loader = false;

                        if(angular.isDefined(data.data)){
                          
                          $scope.postules = data.data;

                          
                        }else{

                        $scope.postules = [];

                        }

                        $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');

                        angular.copy($scope.postules, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.postules.length;
                        $scope.totalItems = $scope.postules.length;
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
                          $scope.itemsPerPage = $scope.postules.length;
                        }else{
                          if($scope.viewby > $scope.postules.length ){

                            $scope.itemsPerPage =  $scope.postules.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
        };



      //  postuleHistory();


  $scope.refreshPostulation=function(){
      //postuleHistory();
  }

    $scope.candidat = {};
        var getCandidat  = function(){

             
            $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
            .success(function(response, status, headers, config) {

                $scope.candidat = response.data;
                // console.log(response.data);
                if(angular.isDefined(response.data)){

                  $scope.candidat.cin = response.data.cin;
                  $scope.candidat.nom = response.data.nom;
                  $scope.candidat.prenom = response.data.prenom;
                  $scope.candidat.nom_ar = response.data.nom_ar;
                  $scope.candidat.prenom_ar = response.data.prenom_ar;
                  $scope.candidat.tel = response.data.tel;
                  $scope.candidat.email = response.data.usr_email;
                  $scope.candidat.adresse_fr = response.data.adresse_fr;
                  $scope.candidat.adresse_ar = response.data.adresse_ar;
                  $scope.candidat.sexe = response.data.sexe;
                  $scope.candidat.date_naiss = new Date(response.data.date_naiss);
                  $scope.candidat.lieu_naiss = response.data.lieu_naiss;
                  $scope.candidat.diplome = response.data.diplome;
                  $scope.candidat.specialite = response.data.specialite;
                  $scope.candidat.date_obtention = response.data.date_obtention;
                  $scope.candidat.niveau = response.data.niveau;
                  $scope.candidat.mention = response.data.mention;
                  $scope.candidat.etablissement = response.data.etablissement;
                  $scope.candidat.parcours = response.data.parcours;
                  

                  if(response.data.etablissement == 'null' || response.data.etablissement == null || response.data.etablissement == '' ){
                    $scope.fonct = 'Non';
                  }else{
                    $scope.fonct = 'Oui';
                  }
                  
                  if(response.data.is_fonctionnaire == 1){
                   $scope.candidat.is_fonctionnaire = true;
                 }else{
                   $scope.candidat.is_fonctionnaire = false;
                 }


                 

               }

               

               

             });


          };


    //getCandidat();

 
    $scope.ref = function(){
      //getCandidat();
    };





    $scope.prepareRecu = function(postuler_id){


                 $http({

                      method:'POST',
                      data:{
                          'postuler_id': postuler_id,
                          'created_by': $rootScope.user
                      },
                      url: API_URL + '/candidat/preparePrint'

                    }).success(function(data, status, headers, config) {
                          postuleHistory();
                          $location.path('/app/mon-profil');
                          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                      0, 'trustedHtml', null, "note-toaster-container");
 
                    })
                    .error(function(data, status, headers, config) {

                       toaster.pop('error','Information', '<br>'+"Une erreur détectée"+'<br><br>' + 
                                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                      0, 'trustedHtml', null, "note-toaster-container");

                    });   
    };
  

          /**
          * [deletePostuler description]
          * @return {[type]} [description]
          */
          $scope.deletePostuler = function() {

            $('#confirm-delete-candidature').on('click', '.btn-ok', function(e) {
              var $modalDiv = $(e.delegateTarget);
              var id = $(this).data('recordId');
                      // console.log(id);
                      // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
                      // $.post('/api/record/' + id).then()
                      $rootScope.loader = true;
                      $http({

                        method:'DELETE',
                        url:API_URL + '/postuler/delete/'+id

                      }).success(function(data, status, headers, config) {

                        
                       $modalDiv.addClass('loading');
                       setTimeout(function() {
                        $modalDiv.modal('hide').removeClass('loading');
                      }, 500)

                       $state.go('app.profil');
                       postuleHistory();
                       $rootScope.loader = false;
                       
                       toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                        0, 'trustedHtml', null, "note-toaster-container");
                       
                       

                     }).error(function(data, status, headers, config) {

                     });




                     
                   });
            $('#confirm-delete-candidature').on('show.bs.modal', function(e) {
              var data = $(e.relatedTarget).data();
              $('.title', this).text(data.recordTitle);
              $('.btn-ok', this).data('recordId', data.recordId);
            });
            
            
            
          }
  
}]);




app.controller('CandidatsListCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
 
 
 
 		$http.get(API_URL+'/sessions/getListActive/'+$rootScope.user).success(function(data, status, headers, config) {

          $scope.sessions = data.data;
          //console.log($scope.sessions);
          
        });

 
 		 $scope.hire = [];
         $scope.hires = [];
 		 $scope.candidats = [];
         $scope.loadHiresByEtab = function(etab_id , session_id) {
         
          $rootScope.loader = true;
         $scope.candidats = [];
         $scope.hires = [];
          
          $http.get(API_URL+'/hire/getListHireByEtabAndSession/'+$rootScope.user+"/"+etab_id+'/'+session_id).success(function(data, status, headers, config) {

                          $rootScope.loader = false;
                          $scope.new_code = data.new_hire_code;
                          $scope.hires  = data.data;
          			      //console.log($scope.hires);
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



       
 


 
          
          
         $http.get(API_URL+'/etablissement/getList/'+$rootScope.user).success(function(data, status, headers, config) {
          
          
          $scope.etablissementsScreen = data.data;
          $scope.etablissementsScreen.push({etablissement_id : -1,etablissement_name : "All"});
          //console.log( $scope.etablissementsScreen);
           
        });

 
 
 
 

        $rootScope.loader = false;
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;


     $scope.candidatsListed = function(hire_id) {
	$scope.candidats = [];
    $rootScope.loader = true;
    $http.get(API_URL+'/hire/getCandidatsByHires/'+hire_id+'/'+$rootScope.user).success(function(data, status, headers, config) {

                        $rootScope.loader = false;
                        $scope.candidats = data.data;
    					//console.log(data.data);
                        angular.copy($scope.candidats, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby =$scope.candidats.length;
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

 



  $scope.refreshcandidatsListed=function(){
     // candidatsListed();
  }
 
  
  $scope.redirect = function(candidat){
    $state.go('app.postuled', { id : candidat.id_candidat});
  }

  
}]);


app.controller('CandidatPostuledLogListCtrl',['$scope','$filter', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope,$filter, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {

        $rootScope.loader = false;
        $scope.postules = [];
        $scope.copy=null;
        $scope.sortType=null;
        $scope.sortReverse=null;
        $scope.searchFish=null;
        $scope.viewby=null;
        $scope.totalItems=null;
        $scope.currentPage=null;
        $scope.itemsPerPage=null;
        $scope.maxSize=null;

 

 
 var loadFiles = function() {
 	$rootScope.loader = true;
 	$http.get(API_URL+'/candidat/getFilesAllById/'+$rootScope.user+'/'+$stateParams.id)
    .success(function(response, status, headers, config) {
     
      				   $rootScope.loader = false;
                       if(angular.isDefined(response.dataFT)){
                         $scope.fileDatasType = response.dataFT;
                       }else{
                         $scope.fileDatasType = [];
                       }
    });
 };
 
 //loadFiles();
 
 
 $scope.refFiles = function(){
 
 //loadFiles();
 
 };


             
    var postuleHistory = function() {

          $rootScope.loader = true;

          $http.get(API_URL+'/candidat/getListHiresOldById/'+$stateParams.id).success(function(data, status, headers, config) {

                        $rootScope.loader = false;

                        if(angular.isDefined(data.data)){
                          
                          $scope.postules = data.data;
                          
                        }else{

                        $scope.postules = [];

                        }

                        $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');

                        angular.copy($scope.postules, $scope.copy);
                        $scope.sortType     = 'nom'; // set the default sort type
                        $scope.sortReverse  = false;  // set the default sort order
                        $scope.searchFish   = ''; 
                        $scope.viewby = $scope.postules.length;
                        $scope.totalItems = $scope.postules.length;
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
                          $scope.itemsPerPage = $scope.postules.length;
                        }else{
                          if($scope.viewby > $scope.postules.length ){

                            $scope.itemsPerPage =  $scope.postules.length;
                            
                          }else{
                           $scope.itemsPerPage = num;
                         }
                         
                       }
                     }
                   });
        };



      //  postuleHistory();


  $scope.refreshPostulation=function(){
     // postuleHistory();
  }

    $scope.candidat = {};
        var getCandidat  = function(){

             
            $http.get(API_URL+'/candidat/getCandidat/'+$stateParams.id)
            .success(function(response, status, headers, config) {

                $scope.candidat = response.data;
                // console.log(response.data);
                if(angular.isDefined(response.data)){

                  $scope.candidat.cin = response.data.cin;
                  $scope.candidat.nom = response.data.nom;
                  $scope.candidat.prenom = response.data.prenom;
                  $scope.candidat.nom_ar = response.data.nom_ar;
                  $scope.candidat.prenom_ar = response.data.prenom_ar;
                  $scope.candidat.tel = response.data.tel;
                  $scope.candidat.email = response.data.usr_email;
                  $scope.candidat.adresse_fr = response.data.adresse_fr;
                  $scope.candidat.adresse_ar = response.data.adresse_ar;
                  $scope.candidat.sexe = response.data.sexe;
                  $scope.candidat.date_naiss = new Date(response.data.date_naiss);
                  $scope.candidat.lieu_naiss = response.data.lieu_naiss;
                  $scope.candidat.diplome = response.data.diplome;
                  $scope.candidat.specialite = response.data.specialite;
                  $scope.candidat.date_obtention = response.data.date_obtention;
                  $scope.candidat.niveau = response.data.niveau;
                  $scope.candidat.mention = response.data.mention;
                  $scope.candidat.etablissement = response.data.etablissement;
                  $scope.candidat.parcours = response.data.parcours;
                  

                  if(response.data.etablissement == 'null' || response.data.etablissement == null || response.data.etablissement == '' ){
                    $scope.fonct = 'Non';
                  }else{
                    $scope.fonct = 'Oui';
                  }
                  
                  if(response.data.is_fonctionnaire == 1){
                   $scope.candidat.is_fonctionnaire = true;
                 }else{
                   $scope.candidat.is_fonctionnaire = false;
                 }


                 

               }

               

               

             });


          };


   // getCandidat();

 
    $scope.ref = function(){
   //   getCandidat();
    };
  


  
}]);

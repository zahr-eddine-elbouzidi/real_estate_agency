
app.controller('FileUpProfCtrl', ['$scope','$filter', '$rootScope','$stateParams', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','toaster', function($scope,$filter , $rootScope,$stateParams, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,toaster) {
   
  /* if($stateParams.id_hire === '' && ){
     $state.go('app.mes-concours');
   }*/

    $rootScope.sizeFile = null;

   if($stateParams.id_hire === ''){
      $stateParams.id_hire = null;
  }
   $rootScope.loader = false;
   $scope.isPdf = false;
   
   $scope.array = ServiceTranslate.personalTranslateLang();

   $scope.piecesManqu = null;
   $scope.messageTerminer = null;
   


/*$http.get(API_URL+'/hire/getHireById/'+$stateParams.id_hire)
  .success(function(response, status, headers, config) {
    //$scope.hireEdit = response.data;
    $scope.date= $filter('date')(new Date(), 'yyyy-MM-dd');
    $scope.hireEdit.type = response.data[0].type_name;
    $scope.hireEdit.hire_code = response.data[0].hire_code;
    $scope.hireEdit.specialty_fr = response.data[0].specialty_fr;
    $scope.hireEdit.hire_date = response.data[0].hire_date;
    $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data[0].session_date_end), 'yyyy-MM-dd');
    $scope.hireEdit.etablissement = response.data[0].etablissement_name;
    $scope.hireEdit.post_number = response.data[0].post_number;

  });*/

   $scope.theseUploaded = false;

   $scope.checked =  function(){
    $rootScope.loader = true;

  
    $http.get(API_URL+'/candidat/checkPieces/'+$rootScope.user+"/"+$stateParams.id_hire).
    success(function(data, status, headers, config) {

      $rootScope.loader = false;
      
      
      if(angular.isDefined(data.data)){
        $scope.piecesManqu = data.data;
       //tester si la thèse est déjà importé pour compléter les membres de jury
        $scope.theseUploaded = data.theseIsUploaded;
       // console.log($scope.theseUploaded);

          

       
      }else{
       $scope.piecesManqu = null;

     }

     if($scope.piecesManqu.length == 0){
      
       $scope.messageTerminer = "Votre dossier de candidature est complet.";
       toaster.pop('success','Information', '<br>'+ "Votre dossier de candidature est complet."+'<br><br>' + 
        '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
        0, 'trustedHtml', null, "note-toaster-container");
     }else{
      $scope.messageTerminer = null;
    }


  }); 
  };




  //get files must be uploaded in database
  //by candidat profil informations
  //Candidat-PESAM = BAC+8M and Candidat-PESAF = BAC+8 else is administratif account

  $http.get(API_URL+'/registration/getUser/'+$rootScope.user)
  .success(function(response, status, headers, config) {

    $rootScope.user_fullname = response.user_fullname;
    $rootScope.email = response.usr_email;
    $rootScope.role = response.type;
        //console.log($rootScope.role);
       if(angular.isDefined($rootScope.role)){
         $scope.loadFileTypes();
       }
  });



    $scope.SLUG = "";
    $scope.candidat = {};
    $scope.types = [];
    
    $scope.loadFileTypes = function(){
     
      $http.get(API_URL+'/candidat/getCandidatUser/'+$rootScope.user)
      .success(function(response, status, headers, config) {

       
        if(angular.isDefined(response.data)){

                  //function get size file by candidat type BEGIN
                  $http.get(API_URL+'/param/getList').success(function(resp, status, headers, config) {
                    if(angular.isDefined(resp.data[0])){
                      if(response.data.niveau == 'BAC+8' || response.data.niveau == 'BAC+8M'){
                        $rootScope.sizeFile = resp.data[0].max_upload_file_pa;
                      }else{
                        $rootScope.sizeFile = resp.data[0].max_upload_file_admin;
                      }
                    }
                  });
                  //function get size file by candidat type END
                  

      
                  
                 $scope.candidat = response.data;
                 
                 $scope.auth = response.auth;
                 
                 $scope.candidat.diplome = response.data.diplome;
                 
                 $scope.candidat.niveau = response.data.niveau;
                 
                 $scope.candidat.etablissement = response.data.etablissement;


         if($stateParams.slug === "divers"){
                  
              
            $scope.SLUG = "Les pièces à fournir";

                  
                  
          if(angular.isDefined($scope.candidat)){

              
            	if($scope.candidat.etablissement !== '' && $scope.candidat.etablissement !== null){
                
               if($scope.candidat.niveau == "BAC+8M"){ //Candidat-PESAM = BAC+8M

                $scope.types = [

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
                { id: 6,      name: 'Attestation de résidanat' , name_ar:'شهادة الإقامة'},
                
                ];

              }else if($scope.candidat.niveau == "BAC+8"){ // Candidat-PESAF = BAC+8

               $scope.types = [

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
               
               
               ];

             }else{

               $scope.types = [

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
               
               ];
             }
             
             if($scope.candidat.is_fonctionnaire == 1){
               $scope.types.push({ id: 56,      name: 'Attestation du Handicap' ,name_ar : 'شهادة الإعاقة'});
             }
             
             
           }else{
            
            
            
            
            if($scope.auth === true){
              
             
             if($scope.candidat.niveau == "BAC+8M"){

              $scope.types = [

      

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 3,      name: 'Autorisation Exceptionnelle pour les candidats non fonctionnaire (Condition d\'âge)' ,name_ar : 'الترخيص باجتياز المباراة بالنسبة للمترشحين غير الموظفين معفى من شرط السن من رئاسة الحكوم'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
                { id: 6,      name: 'Attestation de résidanat' , name_ar:'شهادة الإقامة'},
              
              ];

            }else if($scope.candidat.niveau == "BAC+8"){

             $scope.types = [

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 3,      name: 'Autorisation Exceptionnelle pour les candidats non fonctionnaire (Condition d\'âge)' ,name_ar : 'الترخيص باجتياز المباراة بالنسبة للمترشحين غير الموظفين معفى من شرط السن من رئاسة الحكوم'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'}
              
             
             ];

           }else{

             $scope.types = [

                { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
                { id: 3,      name: 'Autorisation Exceptionnelle pour les candidats non fonctionnaire (Condition d\'âge)' ,name_ar : 'الترخيص باجتياز المباراة بالنسبة للمترشحين غير الموظفين معفى من شرط السن من رئاسة الحكوم'},
                { id: 4,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
                { id: 5,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
              
             ];
           }
           
           if($scope.candidat.is_fonctionnaire == 1){
             $scope.types.push({ id: 56,      name: 'Attestation du Handicap' , name_ar :'شهادة الإعاقة'});
           }
         }else{
           
           if($scope.candidat.niveau == "BAC+8M"){

            $scope.types = [

            { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
            { id: 3,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
            { id: 4,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
            { id: 5,       name: 'Attestation de résidanat' , name_ar:'شهادة الإقامة'}

 
            
            ];

          }else if($scope.candidat.niveau == "BAC+8"){

           $scope.types = [

            { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
            { id: 3,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
            { id: 4,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
           
           
           ];

         }else{

           $scope.types = [

            { id: 2,      name: 'Curriculum Vitae' , name_ar : 'السيرة الداتية'},
            { id: 3,      name: 'Carte d\'Identité Nationale' , name_ar : 'بطاقة التعريف الوطنية'},
            { id: 4,      name: 'Déclaration sur l\'honneur', name_ar : 'التصريح بالشرف'},
            
           ];
         }
         if($scope.candidat.is_fonctionnaire == 1){
           $scope.types.push({ id: 56,      name: 'Attestation du Handicap' , name_ar:'شهادة الإعاقة'});
         }
       }
       
     }
     
   }

   
   
   

   


   
 }else if($stateParams.slug =="diplomes-adminstratifs"){

   $scope.SLUG = "Dossier: Diplômes";
   
   $scope.change= function(value){

    
    if(angular.isDefined(value)){

      if($scope.candidat.niveau === 'BAC'){
        
        if(value ==="Marocain"){

          $scope.types = [
          
          
          { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'}
          ];

        }else{

          $scope.types = [
          
          { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
          { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
          { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'}
          

          ];

        }
        
        
      }else if($scope.candidat.niveau === 'BAC+2'){
        
       if(value ==="Marocain"){

        $scope.types = [
        
        { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
        { id: 2,      name: 'DUT,DTS,BTS,DEUG ou un diplôme équivalent' , name_ar : 'دبلوم تقني متخصص أو ما يعادله'}
        ];

      }else{

        $scope.types = [

        { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
        { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
        { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'},
        { id: 4,      name: 'DUT,DTS,BTS,DEUG ou un diplôme équivalent' , name_ar : 'دبلوم تقني متخصص أو ما يعادله'},
        { id: 5,      name: 'Arrêté d\'équivalence du DUT,DTS,BTS,DEUG ou un diplôme équivalent',name_ar : 'قرار المعادلة لدبلوم تقني متخصص أو ما يعادله'},
        { id: 6,      name: 'Lettre d\'équivalence du DUT,DTS,BTS,DEUG ou un diplôme équivalent',name_ar : 'رسالة المعادلة لدبلوم تقني متخصص أو ما يعادله'}
        

        ];

      }
      
      
    }else if($scope.candidat.niveau === '+2'){
     
     if(value ==="Marocain"){

      $scope.types = [
      
      
      { id: 1,      name: 'Diplôme de Technicien (4ème grade) ou un diplôme équivalent' , name_ar:'دبلوم تقني أو ما يعادله'}
      ];

    }else{

      $scope.types = [
      
      { id: 1,      name: 'Diplôme de Technicien (4ème grade) ou un diplôme équivalent', name_ar:'دبلوم تقني أو ما يعادله'},
      { id: 2,      name: 'Arrêté d\'équivalence du Diplôme de Technicien (4ème grade) ou un diplôme équivalentt', name_ar:'قرار المعادلة لشهادة دبلوم تقني أو ما يعادله'},
      { id: 3,      name: 'Lettre d\'équivalence du Diplôme de Technicien (4ème grade) ou un diplôme équivalent', name_ar:'رسالة المعادلة لشهادة دبلوم تقني أو ما يعادله'}
      

      ];

    }
    
    
  }else if($scope.candidat.niveau === 'BAC+3'){
    
    if(value ==="Marocain"){

      $scope.types = [
      
      { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
      { id: 2,      name: 'Licence ou un diplôme équivalent' , name_ar : 'دبلوم الإجازة أو ما يعادله'},
      ];

    }else{

      $scope.types = [

      { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
      { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
      { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'},
      { id: 4,      name: 'Licence ou un diplôme équivalent' , name_ar : 'دبلوم الإجازة أو ما يعادله'},
      { id: 5,      name: 'Arrêté d\'équivalence de la licence' , name_ar : 'قرار المعادلة لدبلوم الإجازة أو ما يعادلها'},
      { id: 6,      name: 'Lettre d\'équivalence de la licence' , name_ar : 'رسالة المعادلة لدبلوم الإجازة أو ما يعادلها'}
      

      ];

    }
    
    
  }else if($scope.candidat.niveau === 'BAC+5I'){
    
   if(value ==="Marocain"){

    $scope.types = [
    { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
    { id: 2,      name: 'Ingénierie ou un diplôme équivalent' , name_ar : 'دبلوم مهندس دولة أو ما يعادله'} 
    ];

  }else{

    $scope.types = [

    
    { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
    { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
    { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'},
    { id: 4,      name: 'Ingénierie ou un diplôme équivalent', name_ar : 'دبلوم مهندس دولة أو ما يعادله'},
    { id: 5,      name: 'Arrêté d\'équivalence du diplôme ingénieur', name_ar : 'قرار المعادلة لدبلوم مهندس دولة أو ما يعادله'},
    { id: 6,      name: 'Lettre d\'équivalence du diplôme ingénieur', name_ar : 'رسالة المعادلة لدبلوم مهندس دولة أو ما يعادله'} 

    ];

  }
  
}else if($scope.candidat.niveau === 'BAC+5'){
  
 if(value ==="Marocain"){

  $scope.types = [
  { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
  { id: 2,      name: 'Master ou un diplôme équivalent', name_ar : 'دبلوم الماستر أو ما يعادله'} 
  ];

}else{

  $scope.types = [

  { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
  { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
  { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'}, 
  { id: 4,      name: 'Master ou un diplôme équivalent', name_ar : 'دبلوم الماستر أو ما يعادله'},
  { id: 5,      name: 'Arrêté d\'équivalence du master', name_ar : 'قرار المعادلة لدبلوم الماستر أو ما يعادله'},
  { id: 6,      name: 'Lettre d\'équivalence du master', name_ar : 'رسالة المعادلة لدبلوم الماستر أو ما يعادله'} 

  ];

}

}




}


};

}else if($stateParams.slug === "diplomes"){

 $scope.SLUG = "Dossier: Diplômes";


 $scope.change= function(value){

   
  if(angular.isDefined(value)){

   
   if(value ==="Marocain"){

    if($scope.candidat.parcours == 'LMD'){
       $scope.types = [
          { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
          { id: 2,      name: 'Licence ou un diplôme équivalent', name_ar : 'دبلوم الإجازة أو ما يعادله'},
          { id: 3,      name: 'Master ou un diplôme équivalent', name_ar : 'دبلوم الماستر أو ما يعادله'},
          { id: 4,      name: 'Doctorat ou un diplôme équivalent', name_ar : 'دبلوم الدكتوراه أو ما يعادله'}

        ];
    }else{
       $scope.types = [
        { id: 1,      name: 'Baccalauréat ou un diplôme équivalent' , name_ar : 'شهادة البكالوريا أو ما يعادلها'},
        { id: 2,      name: 'Ingénierie ou un diplôme équivalent' , name_ar : 'دبلوم مهندس دولة أو ما يعادله'},
        { id: 3,      name: 'Doctorat ou un diplôme équivalent', name_ar : 'دبلوم الدكتوراه أو ما يعادله'}

        ];
    }

   

  }else{

   
     if($scope.candidat.parcours == 'LMD'){
       $scope.types = [

          { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
          { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
          { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'},
          { id: 4,      name: 'Licence ou un diplôme équivalent' , name_ar : 'دبلوم الإجازة أو ما يعادله'},
          { id: 5,      name: 'Arrêté d\'équivalence de la licence' , name_ar : 'قرار المعادلة لدبلوم الإجازة أو ما يعادلها'},
          { id: 6,      name: 'Lettre d\'équivalence de la licence' , name_ar : 'رسالة المعادلة لدبلوم الإجازة أو ما يعادلها'},
          { id: 7,      name: 'Master ou un diplôme équivalent', name_ar : 'دبلوم الماستر أو ما يعادله'},
          { id: 8,      name: 'Arrêté d\'équivalence du master', name_ar : 'قرار المعادلة لدبلوم الماستر أو ما يعادله'},
          { id: 9,      name: 'Lettre d\'équivalence du master', name_ar : 'رسالة المعادلة لدبلوم الماستر أو ما يعادله'},
          { id: 10,     name: 'Doctorat ou un diplôme équivalent', name_ar : 'دبلوم الدكتوراه أو ما يعادله'},
          { id: 11,     name: 'Arrêté d\'équivalence du doctorat', name_ar : 'قرار المعادلة لدبلوم الدكتوراه أو ما يعادله'},
          { id: 12,     name: 'Lettre d\'équivalence du doctorat', name_ar : 'رسالة المعادلة لدبلوم الدكتوراه أو ما يعادله'}

        ];
    }else{
       $scope.types = [
       

          { id: 1,      name: 'Baccalauréat ou un diplôme équivalent', name_ar : 'البكالوريا أو ما يعادلها'},
          { id: 2,      name: 'Arrêté d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'قرار المعادلة لشهادة البكالوريا أو ما يعادلها'},
          { id: 3,      name: 'Lettre d\'équivalence du Baccalauréat ou un diplôme équivalent', name_ar : 'رسالة المعادلة لشهادة البكالوريا أو ما يعادلها'},
          { id: 4,      name: 'Ingénierie ou un diplôme équivalent' , name_ar : 'دبلوم مهندس دولة أو ما يعادله'},
          { id: 5,      name: 'Arrêté d\'équivalence du diplôme ingénieur', name_ar : 'قرار المعادلة لدبلوم مهندس دولة أو ما يعادله'},
          { id: 6,      name: 'Lettre d\'équivalence du diplôme ingénieur', name_ar : 'رسالة المعادلة لدبلوم مهندس دولة أو ما يعادله'},
          { id: 7,     name: 'Doctorat ou un diplôme équivalent', name_ar : 'دبلوم الدكتوراه أو ما يعادله'},
          { id: 8,     name: 'Arrêté d\'équivalence du doctorat', name_ar : 'قرار المعادلة لدبلوم الدكتوراه أو ما يعادله'},
          { id: 9,     name: 'Lettre d\'équivalence du doctorat', name_ar : 'رسالة المعادلة لدبلوم الدكتوراه أو ما يعادله'}

        ];
    }

  }

}


};


}else if($stateParams.slug === "experience"){

 $scope.SLUG = "Dossier: Attestations";

 $scope.types = [
 { id: 1,      name: 'Attestations d\'expérience' , name_ar : 'شواهد الخبرة أو العمل'}
 
 ];

 

}else if($stateParams.slug === "publication"){

 $scope.SLUG = "Dossier: Thèse, Publications et Communications";
 $scope.types = [
 { id: 1,      name: 'These' , name_ar : 'الأطروحة'},
 { id: 2,      name: 'Publications'},
 { id: 3,      name: 'Communications'},
 { id: 4,      name: 'Autres'}
 
 ];

 
}else{

 $scope.SLUG = "";
}
}
});




     //console.log($scope.types);

   };


   



     /* $scope.uploadFile = function(){

         var fd = new FormData();

         var file = $scope.Lfile;

         fd.append('file' , file);

        alert(fd);

      }*/


      

     /* $scope.pdfName = 'Relativity: The Special and General Theory by Albert Einstein';
      $scope.pdfUrl = "zahrScan.PDF";
      $scope.pdfPassword = 'test';
      $scope.scroll = 0;
      $scope.loading = 'loading';

      $scope.getNavStyle = function(scroll) {
        if(scroll > 100) return 'pdf-controls fixed';
        else return 'pdf-controls';
      }

      $scope.onError = function(error) {
        console.log(error);
      }

      $scope.onLoad = function() {
        $scope.loading = '';
      }

      $scope.onProgress = function (progressData) {
        console.log(progressData);
      };

      $scope.onPassword = function (updatePasswordFn, passwordResponse) {
        if (passwordResponse === PDFJS.PasswordResponses.NEED_PASSWORD) {
            updatePasswordFn($scope.pdfPassword);
        } else if (passwordResponse === PDFJS.PasswordResponses.INCORRECT_PASSWORD) {
            console.log('Incorrect password')
        }
      };*/

      

      

      
      
      /**
       * fonctionnaire 
       */
      $rootScope.fonctionnaire = true;


       
      var uploader = $scope.uploader = new FileUploader({
        url: API_URL+'/candidat/upload/'+$rootScope.user+'/'+$stateParams.id_hire
      });

      $scope.up = {};
      $scope.uploadImage = function (item) {
        item.formData.push({type: $scope.type});
        item.formData.push({specialite_diplome: $scope.up.specialite_diplome });
        item.formData.push({mention : $scope.up.mention });
        item.formData.push({date_obt : $scope.up.date_obt});
        item.upload();
        $scope.checked();
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

       //console.log($scope.type);
       //
       //
       
       



     }  

     


     // CALLBACKS

     uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
         //console.info('onWhenAddingFileFailed', item, filter, options);

         

         $rootScope.type = $scope.type;
       };
       uploader.onAfterAddingFile = function(fileItem) {
         
         
        //  console.info($scope.loading);
        
         ///$scope.invalidate = false;

       };
       uploader.onAfterAddingAll = function(addedFileItems) {
     
        
            var fd = new FormData();

            var file = addedFileItems[0]._file;

            fd.append('file' , file);

          if($scope.type === undefined){


            toaster.pop('error','Information', '<br>'+"Veuillez sélectionner un type de document !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            
            
            $scope.invalidate = true;

          }else{

            $http.post( API_URL + '/candidat/checkUpload/'+$rootScope.user+'/'+$scope.type+'/'+$stateParams.id_hire, fd,{
             
             transformRequest: angular.identity,

             headers: {'Content-Type': undefined}

           }).success(function(data, status, headers, config) {

            if(data.fileExists == true){
                $scope.filename = null;   
                $scope.invalidate = true;
                toaster.pop('error','Information', '<br>'+"Vous n\'avez pas le droit de changer vos documents après la validation de votre dossier!"+'<br><br>' + 
                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                0, 'trustedHtml', null, "note-toaster-container");     
            }else{
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
            }

           
              
              
               
             
               
            

             }).error(function(data, status, headers, config) {

                 toaster.pop('error','Information', '<br>'+"Erreur !"+'<br><br>' +  '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                      0, 'trustedHtml', null, "note-toaster-container");
             });
            }

       };




       
       uploader.onBeforeUploadItem = function(item) {
         //console.info('onBeforeUploadItem', item);
         

       };
       uploader.onProgressItem = function(fileItem, progress) {
         //console.info('onProgressItem', fileItem, progress);

         //$scope.refresh();
         
         
       };
       uploader.onProgressAll = function(progress) {
           //load();
            //console.info('onProgressAll', progress);
            
            if(progress == 100){
             toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
          //  $scope.refresh();
          $scope.checked();
        }
        
        
      };
      uploader.onSuccessItem = function(fileItem, response, status) {
        //console.info('ddd', fileItem, response, status);
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

      //console.info('uploader', uploader);
      //
      //
      //
      //

      $scope.redirectMesPieces = function(){
        $state.go('app.upload', { slug : 'divers' , id_hire :   $stateParams.id_hire});
        
      };


      $scope.redirectUploadDocDiplomesadmin = function(){
        $state.go('app.docpadiplomesadmin', { slug : 'diplomes-adminstratifs' , id_hire :  $stateParams.id_hire});
        
      };

      $scope.redirectUploadDocDossierScienti = function(){

        $state.go('app.docpapublication', { slug : 'publication' , id_hire :  $stateParams.id_hire});
        
      };

      $scope.redirectUploadDocAttestationExp = function(){
        
        $state.go('app.docpaexperience', { slug : 'experience' , id_hire :  $stateParams.id_hire});
        
      };

      

      $scope.redirectUploadDocPADiplomesadmin = function(){
        $state.go('app.docpadiplomes', { slug : 'diplomes' , id_hire :  $stateParams.id_hire});
        
      };

      $scope.redirectUploadDocDipAdmin = function(){
        $state.go('app.docpadiplomes', { slug : 'diplomes-adminstratifs' , id_hire :  $stateParams.id_hire});
        
      };
      

      $scope.hireEdit = {};
      $http.get(API_URL+'/hire/getHire/'+$stateParams.id_hire)
      .success(function(response, status, headers, config) {



        $scope.hireEdit.hire_code = response.data.hire_code;
        $scope.hireEdit.session_date_begin =new Date(response.data.session_date_begin) ;
        $scope.hireEdit.session_date_end = $filter('date')(new Date(response.data.session_date_end), 'yyyy-MM-dd');
        $scope.hireEdit.hire_date = new Date(response.data.hire_date);
        $scope.hireEdit.specialty_fr = response.data.specialty_fr;
        $scope.hireEdit.color = response.data.color;
        $scope.hireEdit.post_number = response.data.post_number;
        $scope.hireEdit.adresse = response.data.adresse;
        $scope.hireEdit.type_id = response.data.type_id;
        $scope.hireEdit.etablissement_id = response.data.etablissement_id;
        $scope.hireEdit.type_poste = response.data.type;
        $http.get(API_URL+'/type/getSubCategory/'+$scope.hireEdit.type_id)
        .success(function(response, status, headers, config) {



          $scope.hireEdit.nom_grade = response.data;
          

        });

      });


      $scope.isPostuled = false;
      $http.get(API_URL+'/postuler/getPostulerByCandidatAndHire/'+$rootScope.user+"/"+$stateParams.id_hire)
      .success(function(response, status, headers, config) {
       $scope.isPostuled = response.data;    

     });


      $scope.getFileCandidat = function(){
          $http.get(API_URL+'/candidat/getFileTypeByCandidat/'+$rootScope.user+"/"+$scope.type)
          .success(function(response, status, headers, config) {
           $scope.dataFile = response.data;    
           $scope.up.specialite_diplome = $scope.dataFile.specialite_diplome;
           $scope.up.date_obt = $scope.dataFile.date_obt;
           $scope.up.mention = $scope.dataFile.mention;

         });
      };

      

      $scope.savePostuler = function() {

        var dialog = confirm('Voulez-vous postuler au poste ('+$scope.hireEdit.nom_grade.nom+' en '+$scope.hireEdit.specialty_fr+') ?');
        
        if(dialog){
          
          $rootScope.loader = true;
          
          $http.post( API_URL + '/postuler/add',{
            'created_by' : $rootScope.user,
            'hire_id' : $stateParams.id_hire })
          .success(function(data, status, headers, config){

            if(data.drap == 1 ){
                              //toaster.pop('success', 'Message', data.message); 
                             // $state.go('app.monespace');

                            }else if(data.drap == 2 || data.drap == 3 || data.drap == 4){

                              toaster.pop('warning', 'Message', data.message); 

                            }else{

                              toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                                '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                                0, 'trustedHtml', null, "note-toaster-container");

                              //load();
                              
                              $state.go('app.mes-candidatures');
                            }

                            $rootScope.loader = false;

         })
          .error(function(data, status, headers, config) {
          });
          
        }
        
      };


$scope.deleteJury = function(id) {

    $('#confirm-delete-jury').on('click', '.btn-jury', function(e) {
      var $modalDiv = $(e.delegateTarget);

            $rootScope.loader = true;
            $http({

              method:'DELETE',
              url:API_URL + '/candidat/deleteJury/'+id+'/'+$rootScope.user

            }).success(function(data, status, headers, config) {

              
            /* $modalDiv.addClass('loading');
             setTimeout(function() {
              $modalDiv.modal('hide').removeClass('loading');
            }, 500)*/

             //$state.go('app.my-files');
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
  $scope.displayFile =  function(){

    $rootScope.loader = true;
    $http.get(API_URL+'/candidat/getJury/'+$rootScope.user)
    .success(function(data, status, headers, config) {
      if(angular.isDefined(data.data)){
        
          // console.log($scope.jury);
          $rootScope.loader = false;

            if(data.data == -1){

              toaster.pop('error','Information', '<br>'+"Veuillez svp importer la thèse !"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");

            }else if(data.data == 0){
              toaster.pop('warning','Information', '<br>'+"Candidat est introuvable, Veuillez réssayer plus tard!"+'<br><br>' + 
              '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
              0, 'trustedHtml', null, "note-toaster-container");
            }else{

              $scope.jury = data.data;
            }  
      }
    });

  }; 
  /* !!!: END DATA DISPLAY */ 


  
  $scope.copyFilesInBackground = function() {

   
      
      $rootScope.loader = true;
      $http.post( API_URL + '/candidat/copyFiles', 
        
      {
        'id_hire':$stateParams.id_hire,                
        'created_by':$rootScope.user
        
      }).success(function(data, status, headers, config) {

        if(data.data == true){

          toaster.pop('success','Information', '<br>'+"Votre dossier de candidature est copié avec succès."+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
          $scope.checked();

        }

        
      }).error(function(data, status, headers, config) {
        $rootScope.loader = false;
      });

 
  };

//  $scope.copyFilesInBackground();



  $scope.saveJury = function() {

      $rootScope.loader = true;
      $http.post( API_URL + '/candidat/saveJury', 
        
      {
        'nom_complet':$scope.file.nom_complet,
        'etablissement':$scope.file.etablissement,
        'specialite':$scope.file.specialite,          
        'created_by':$rootScope.user
        
      }).success(function(data, status, headers, config) {

        //$state.go('app.my-files');
        $scope.file.nom_complet = null;
        $scope.file.etablissement =  null;
        $scope.file.specialite =  null;
        $rootScope.loader = false;

        if(data.data == -1){

          toaster.pop('error','Information', '<br>'+"Veuillez svp importer la thèse !"+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");

        }else if(data.data == 0){
          toaster.pop('warning','Information', '<br>'+"Candidat est introuvable, Veuillez réssayer plus tard!"+'<br><br>' + 
          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
          0, 'trustedHtml', null, "note-toaster-container");
        }else{

          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
                          '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
                          0, 'trustedHtml', null, "note-toaster-container");
        }  
        
        
      }).error(function(data, status, headers, config) {
        $rootScope.loader = false;
      });

 
  };

      
}]);
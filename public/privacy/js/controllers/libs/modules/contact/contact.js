app.controller('ContactCtrl',['$scope', '$rootScope', '$http','$state', '$location','$timeout',
 'ServiceTranslate','FileUploader','API_URL','$stateParams','toaster', function($scope, $rootScope, $http,$state, $location,
   $timeout,ServiceTranslate,FileUploader,API_URL,$stateParams,toaster) {
   

  $rootScope.loader = false;
  
  $scope.contact = {};
  var load = function(){

   $rootScope.loader = true;

   $http.get(API_URL+'/contact/getList/'+$rootScope.user)
   .success(function(response, status, headers, config) {

    $scope.contacts = response.data;
    $scope.contact.name = response.data.name;                
    $scope.contact.tel = response.data.tel;         		
    $scope.contact.gsm = response.data.gsm;         		
    $scope.contact.email = response.data.email;         		
    $scope.contact.address = response.data.address;
    $scope.contact.facebook_url = response.data.facebook_url;
    $scope.contact.instagram_url = response.data.instagram_url;
    $scope.contact.linkedin_url = response.data.linkedin_url;
    $scope.contact.tiktok_url = response.data.tiktok_url;
    $scope.contact.website = response.data.website;
				//console.log($scope.contacts);
        $rootScope.loader = false;

      });
 };

 load();

 
       /**
        * [saveCustomer description]
        * @return {[type]} [description]
        */
        $scope.saveContact = function() {

          
         $rootScope.loader = true;
         
         
         $http.post( API_URL + '/contact/add', 
         {
          'name':$scope.contact.name,
          'tel':$scope.contact.tel,                          
          'gsm':$scope.contact.gsm,                     	  
          'email':$scope.contact.email,                     	  
          'facebook_url':$scope.contact.facebook_url,                     	  
          'instagram_url':$scope.contact.instagram_url,                     	  
          'linkedin_url':$scope.contact.linkedin_url,                     	  
          'tiktok_url':$scope.contact.tiktok_url,                     	  
          'website':$scope.contact.website,                     	  
          'address':$scope.contact.address,
          'created_by':$rootScope.user

        }).success(function(data, status, headers, config) {
          $rootScope.loader = false;
          load();
          toaster.pop('success','Information', '<br>'+"L'opération a été bien effectuée."+'<br><br>' + 
            '<hr /><i style="font-size: 0.7em;">'+$scope.app.name+' - Version :'+$scope.app.version+'</i>', 
            0, 'trustedHtml', null, "note-toaster-container");
          
          
        })
        .error(function(data, status, headers, config) {
        });

        


        
      };
      

      
    }]);


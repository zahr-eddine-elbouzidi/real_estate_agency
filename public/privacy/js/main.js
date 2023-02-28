'use strict';

/* Controllers */

angular.module('app')
.controller('AppCtrl', ['$scope','$rootScope','$http', '$translate', '$localStorage', '$window','$state','API_URL', 
  function($scope,$rootScope, $http,  $translate,   $localStorage,   $window,$state ,API_URL) {
      // add 'ie' classes to html
      var isIE = !!navigator.userAgent.match(/MSIE/i);
      isIE && angular.element($window.document.body).addClass('ie');
      isSmartDevice( $window ) && angular.element($window.document.body).addClass('smart');

      $rootScope.loader = false;

          //console.log(API_URL);
          //
          $rootScope.BASE_URL = 'http://localhost/agence_im/public';
		 // $rootScope.BASE_URL = location.origin;
 
            if(angular.isDefined($rootScope.user) && $rootScope.user != ''){
            	
              $http.get(API_URL+'/registration/getUser/'+$rootScope.user)
              .success(function(response, status, headers, config) {
                $scope.users = response;

                if(angular.isDefined(response.data)){
                  if(response.data == null){
                     
                                    $rootScope.user="";
                                    sessionStorage.removeItem("keySessionPHP");
                                    $rootScope.user_admin = 'false';
                                    var now = new Date();
                                    var time = now.getTime();
                                    var expireTime = time + 1000*36000*18;
                                    now.setTime(expireTime);
                                    $window.document.cookie = "PHPCOOKIE=; expires="+now.toGMTString()+"; path=/";
                                    $rootScope.usr_full_name = null;
                                    $rootScope.user_fullname = null;
                                    $rootScope.email = null;
                                    $rootScope.loader = false;
                                    $rootScope.adminName = undefined;
                                    $rootScope.role = null;
                                    $state.go('access.signin');
                                  
                  }
                }

                $rootScope.user_fullname = $scope.users.user_fullname;
                $rootScope.email = $scope.users.usr_email;
                $rootScope.role = $scope.users.type;
                //size file from rule connected
             

              //ROLE => Candidat-Normale ou Candidat-Professeur

  
 
    

     $http.get(API_URL+'/registration/getUserRole/'+$rootScope.user)
            .success(function(response, status, headers, config) {
            $scope.users = response;
             $rootScope.paramsDroit = {};
            $rootScope.roles = response.roles;

      angular.forEach($rootScope.roles, function(value, key) {
             

        if(value.code == 'addCategory'){
           $rootScope.paramsDroit.addCategory = true;
        }else if(value.code == 'editCategory'){
            $rootScope.paramsDroit.editCategory = true;
        }else if(value.code == 'deleteCategory'){
            $rootScope.paramsDroit.deleteCategory = true;
        }else if(value.code == 'addGrade'){
            $rootScope.paramsDroit.addGrade = true;
        }else if(value.code == 'editGrade'){
            $rootScope.paramsDroit.editGrade = true;
        }else if(value.code == 'deleteGrade'){
            $rootScope.paramsDroit.deleteGrade = true;
        }else if(value.code == 'addHire'){
            $rootScope.paramsDroit.addHire = true;
        }else if(value.code == 'editHire'){
            $rootScope.paramsDroit.editHire = true;
        }else if(value.code == 'deleteHire'){
            $rootScope.paramsDroit.deleteHire = true;
        }else if(value.code == 'addSession'){
            $rootScope.paramsDroit.addSession = true;
        }else if(value.code == 'editSession'){
            $rootScope.paramsDroit.editSession = true;
        }else if(value.code == 'deleteSession'){
            $rootScope.paramsDroit.deleteSession = true;
        }else if(value.code == 'gestionNoteExOne'){
            $rootScope.paramsDroit.notes_ex1 = true;
        }else if(value.code == 'gestionNoteExTwo'){
            $rootScope.paramsDroit.notes_ex2 = true;
        }else if(value.code == 'exportListPostuled'){
            $rootScope.paramsDroit.exportPostuled = true;
        }else if(value.code == 'exportListEcrit'){
            $rootScope.paramsDroit.exportEcrit = true;
        }else if(value.code == 'exportListOral'){
            $rootScope.paramsDroit.exportOral = true;
        }else if(value.code == 'exportListFinale'){
            $rootScope.paramsDroit.exportFinale = true;
        }else if(value.code == 'gestionCommission'){
            $rootScope.paramsDroit.gestionComm = true;
        }else if(value.code == 'all'){
            $rootScope.paramsDroit.ctl_all = true;
        }else if(value.code == 'pvs'){
            $rootScope.paramsDroit.pvs = true;
        }else if(value.code == 'gestionRes'){
            $rootScope.paramsDroit.gestionR = true;
        }else if(value.code == 'exportJury'){
            $rootScope.paramsDroit.exportJur = true;
        }else if(value.code == 'traitAdmin'){
            $rootScope.paramsDroit.traitAdmin = true;
        }
 
 
         
            
     });
  //console.log( $rootScope.paramsDroit); 
      });



               //check that is admin
               if(response.usr_isSuper == 1){
                 $rootScope.user_admin = 'true';
                 $rootScope.admin = true;
                 $rootScope.adminName = 'admin';

               }else if(response.usr_isSuper == null){
                $state.go('access.signin');
              }else{
                $rootScope.user_admin = 'false';
                $rootScope.admin = false;
                $rootScope.adminName = 'standard';


              }

            });
}
              
              
              
  

 
    
    var loadCharts = function(){

     $rootScope.loader = true;
     $http.get(API_URL+'/dashboard/getList').
     success(function(data, status, headers, config) {

       
       $rootScope.datac = data.hire_by_cats;

       $rootScope.datasc = data.hire_by_sub_cat;

       $rootScope.datamonths = data.post_by_month;

       $rootScope.nbre_total = data.nbre_total[0].data;

       $rootScope.nbre_candidat = data.nbre_total_candidat[0].data;

       $rootScope.nbre_users = data.nbre_users[0].data;

        $rootScope.loader = false;

   });


   };


 
  
  
  
  
  
  

      // config
      $scope.app = {
        name: 'Student Housing',
        version: '1.0.1 Beta',
        // for chart colors
        color: {
          primary: '#7266ba',
          info:    '#23b7e5',
          success: '#27c24c',
          warning: '#fad733',
          danger:  '#f05050',
          light:   '#e8eff0',
          dark:    '#3a3f51',
          black:   '#1c2b36'
        },
        settings: {
          themeID: 14,
          navbarHeaderColor: 'bg-black',
          navbarCollapseColor: 'bg-white-only',
          asideColor: 'bg-black',
          headerFixed: true,
          asideFixed: false,
          asideFolded: false,
          asideDock: true,
          container: false
        }
      }

      // save settings to local storage
      if ( angular.isDefined($localStorage.settings) ) {
        $scope.app.settings = $localStorage.settings;
      } else {
        $localStorage.settings = $scope.app.settings;
      }
      $scope.$watch('app.settings', function(){
        if( $scope.app.settings.asideDock  &&  $scope.app.settings.asideFixed ){
          // aside dock and fixed must set the header fixed.
          $scope.app.settings.headerFixed = true;
        }
        // save to local storage
        $localStorage.settings = $scope.app.settings;
      }, true);

      // angular translate
      $scope.lang = { isopen: false };
      $scope.langs = {fr:'French' , en:'English'};
      $scope.selectLang = $scope.langs[$translate.proposedLanguage()] || "French";
      $rootScope.selectLang = $scope.langs[$translate.proposedLanguage()] || "French";
      $scope.setLang = function(langKey, $event) {
        // set the current lang
        $scope.selectLang = $scope.langs[langKey];
        $rootScope.selectLang = $scope.langs[langKey];
        // You can change the language during runtime
        $translate.use(langKey);
        $scope.lang.isopen = !$scope.lang.isopen;
      };

      function isSmartDevice( $window )
      {
          // Adapted from http://www.detectmobilebrowsers.com
          var ua = $window['navigator']['userAgent'] || $window['navigator']['vendor'] || $window['opera'];
          // Checks for iOs, Android, Blackberry, Opera Mini, and Windows mobile devices
          return (/iPhone|iPod|iPad|Silk|Android|BlackBerry|Opera Mini|IEMobile/).test(ua);
        }

      }]);



angular.module('app').service('ServiceTranslate' , function($rootScope,$http){

  this.personalTranslateLang =  function(){

   
    var dataTranslate = new Array();

    


    if($rootScope.selectLang == 'English'){

     
     $http.get('l10n/en.js').then(function (resp) {

      angular.forEach(resp.data.apps.messages , function(value , key){

        this.push(value);

      },dataTranslate);

      

    });
     
     
   }else{

     

     $http.get('l10n/fr.js').then(function (resp) {

      angular.forEach(resp.data.apps.messages , function(value , key){

        this.push(value);

      },dataTranslate);

      

    });

     

         // return $rootScope.datas;


       }
       

       return dataTranslate;

     };

   });

  /**
 * Binds a TinyMCE widget to <textarea> elements.
 */
angular.module('ui.tinymce', [])
  .value('uiTinymceConfig', {})
  .directive('uiTinymce', ['$rootScope', '$compile', '$timeout', '$window', '$sce', 'uiTinymceConfig', function($rootScope, $compile, $timeout, $window, $sce, uiTinymceConfig) {
    uiTinymceConfig = uiTinymceConfig || {};
    var ID_ATTR = 'ui-tinymce';
    if (uiTinymceConfig.baseUrl) {
      tinymce.baseURL = uiTinymceConfig.baseUrl;
    }

    return {
      require: ['ngModel', '^?form'],
      priority: 599,
      link: function(scope, element, attrs, ctrls) {
        if (!$window.tinymce) {
          return;
        }

        var ngModel = ctrls[0],
          form = ctrls[1] || null;

        var expression, options = {
          debounce: true
        }, tinyInstance,
          updateView = function(editor) {
            var content = editor.getContent({format: options.format}).trim();
            content = $sce.trustAsHtml(content);

            ngModel.$setViewValue(content);
            if (!$rootScope.$$phase) {
              scope.$digest();
            }
          };

        function toggleDisable(disabled) {
          if (disabled) {
            ensureInstance();

            if (tinyInstance) {
              tinyInstance.getBody().setAttribute('contenteditable', false);
            }
          } else {
            ensureInstance();

            if (tinyInstance && !tinyInstance.settings.readonly && tinyInstance.getDoc()) {
              tinyInstance.getBody().setAttribute('contenteditable', true);
            }
          }
        }

        // generate an ID
        attrs.$set('id', ID_ATTR + '-' + (new Date().valueOf()));

        expression = {};

        angular.extend(expression, scope.$eval(attrs.uiTinymce));

        //Debounce update and save action
        var debouncedUpdate = (function(debouncedUpdateDelay) {
          var debouncedUpdateTimer;
          return function(ed) {
          $timeout.cancel(debouncedUpdateTimer);
           debouncedUpdateTimer = $timeout(function() {
              return (function(ed) {
                if (ed.isDirty()) {
                  ed.save();
                  updateView(ed);
                }
              })(ed);
            }, debouncedUpdateDelay);
          };
        })(400);

        var setupOptions = {
          // Update model when calling setContent
          // (such as from the source editor popup)
          setup: function(ed) {
            ed.on('init', function() {
              ngModel.$render();
              ngModel.$setPristine();
                ngModel.$setUntouched();
              if (form) {
                form.$setPristine();
              }
            });

            // Update model when:
            // - a button has been clicked [ExecCommand]
            // - the editor content has been modified [change]
            // - the node has changed [NodeChange]
            // - an object has been resized (table, image) [ObjectResized]
            ed.on('ExecCommand change NodeChange ObjectResized', function() {
              if (!options.debounce) {
                ed.save();
                updateView(ed);
                return;
              }
              debouncedUpdate(ed);
            });

            ed.on('blur', function() {
              element[0].blur();
              ngModel.$setTouched();
              if (!$rootScope.$$phase) {
                scope.$digest();
              }
            });

            ed.on('remove', function() {
              element.remove();
            });

            if (uiTinymceConfig.setup) {
              uiTinymceConfig.setup(ed, {
                updateView: updateView
              });
            }

            if (expression.setup) {
              expression.setup(ed, {
                updateView: updateView
              });
            }
          },
          format: expression.format || 'html',
          selector: '#' + attrs.id
        };
        // extend options with initial uiTinymceConfig and
        // options from directive attribute value
        angular.extend(options, uiTinymceConfig, expression, setupOptions);
        // Wrapped in $timeout due to $tinymce:refresh implementation, requires
        // element to be present in DOM before instantiating editor when
        // re-rendering directive
        $timeout(function() {
          if (options.baseURL){
            tinymce.baseURL = options.baseURL;
          }
          var maybeInitPromise = tinymce.init(options);
          if(maybeInitPromise && typeof maybeInitPromise.then === 'function') {
            maybeInitPromise.then(function() {
              toggleDisable(scope.$eval(attrs.ngDisabled));
            });
          } else {
            toggleDisable(scope.$eval(attrs.ngDisabled));
          }
        });

        ngModel.$formatters.unshift(function(modelValue) {
          return modelValue ? $sce.trustAsHtml(modelValue) : '';
        });

        ngModel.$parsers.unshift(function(viewValue) {
          return viewValue ? $sce.getTrustedHtml(viewValue) : '';
        });

        ngModel.$render = function() {
          ensureInstance();

          var viewValue = ngModel.$viewValue ?
            $sce.getTrustedHtml(ngModel.$viewValue) : '';

          // instance.getDoc() check is a guard against null value
          // when destruction & recreation of instances happen
          if (tinyInstance &&
            tinyInstance.getDoc()
          ) {
            tinyInstance.setContent(viewValue);
            // Triggering change event due to TinyMCE not firing event &
            // becoming out of sync for change callbacks
            tinyInstance.fire('change');
          }
        };

        attrs.$observe('disabled', toggleDisable);

        // This block is because of TinyMCE not playing well with removal and
        // recreation of instances, requiring instances to have different
        // selectors in order to render new instances properly
        scope.$on('$tinymce:refresh', function(e, id) {
          var eid = attrs.id;
          if (angular.isUndefined(id) || id === eid) {
            var parentElement = element.parent();
            var clonedElement = element.clone();
            clonedElement.removeAttr('id');
            clonedElement.removeAttr('style');
            clonedElement.removeAttr('aria-hidden');
            tinymce.execCommand('mceRemoveEditor', false, eid);
            parentElement.append($compile(clonedElement)(scope));
          }
        });

        scope.$on('$destroy', function() {
          ensureInstance();

          if (tinyInstance) {
            tinyInstance.remove();
            tinyInstance = null;
          }
        });

        function ensureInstance() {
          if (!tinyInstance) {
            tinyInstance = tinymce.get(attrs.id);
          }
        }
      }
    };
  }]);
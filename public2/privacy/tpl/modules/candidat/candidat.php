<style>
  canvas {
    background-color: #f3f3f3;
    -webkit-box-shadow: 3px 3px 3px 0 #e3e3e3;
    -moz-box-shadow: 3px 3px 3px 0 #e3e3e3;
    box-shadow: 3px 3px 3px 0 #e3e3e3;
    border: 1px solid #c3c3c3;
    height: 100px;
    margin: 6px 0 0 6px;
  }

  /* Latest compiled and minified CSS included as External Resource*/

/* Optional theme */

/*@import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');*/
 
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}

.col-xs-3 {
  float : none;
}
</style> 


<div >
  
  <!--<toaster-container
    toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->



    <div class="bg-light lter b-b wrapper-md"  >
        
        <div class="wrapper-md bg-light dk b-b text-b">
        <!--<b><span class="pull-right m-t-xs">Nombre de poste(s) <b class="badge bg-dark">{{hireEdit.post_number}}</b></span></b>-->
          <h3 class="m-n font-thin text-primary">Informations Personnelles</h3>    
           <h5 class="text-center text-b text-info" style="text-decoration: underline;font-weight: bold;"><i class="icon icon-info"></i> Veuillez compléter votre profil et passer a importer vos pièces jointes. </h5>
          <h5 class="text-center text-b" style="text-decoration: underline;font-weight: bold;">المرجوا ادخال البيانات الشخصية و الانتقال الى رفع الوثائق  <i class="icon icon-info"></i> </h5> 
          <h4 class="m-n font-bold text-primary"></h4>  
        </div>
  </div>




  <div class="wrapper-md"  ng-init="steps={step1:true, step2:false, step3:false, step4:false}">

     <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3" > 
                <a  type="button"  class="btn btn-success btn-circle">1</a>
                <p><small>Les informations personnelles</small></p>
            </div>
            <div class="stepwizard-step" > 
                <a ui-sref="app.upload({slug: 'divers'})" type="button" ng-disabled="step1.$invalid" class="btn btn-default btn-circle" >2</a>
                <p><small>Mon dossier de base</small></p>
            </div>
           <!-- <div class="stepwizard-step col-xs-3" ng-if="isProf == true || isProfM == true"> 
                <a href="#step-3" type="button"  class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Jury de la thèse pour les PA</small></p>
            </div>-->
            <div class="stepwizard-step col-xs-3"> 
                <a ui-sref="app.mes-concours" type="button" class="btn btn-default btn-circle">3</a>
                <p><small>Concours</small></p>
            </div>
 
        </div>
    </div>


   <div class="panel panel-default"> 
     
<!--
  <div class="col-lg-6">
<div class="list-group-item">
  
   <progressbar value="advenced" class="progress-striped active progress-xs m-b-sm" animate="true" type="info"><span style="white-space:nowrap;">{{advenced}}%</span></progressbar>
</div>
</div>-->




 
<div class="panel panel-primary setup-content" id="step-1">
<tabset class="tab-container" justified="true" ng-init="steps={percent:20, step1:true, step2:false, step3:false}">
   
   
<tab heading="1 | Informations Personnelles - المعلومات الشخصية" ng-controller="CandidatCtrl">
   <!--<h4>Informations personnelles</h4>-->
    <form name="step1" class="form-validation" ng-submit="saveCandidat()">


      <center>
        <h4 class="alert alert-info">خانة إدارة المعلومات الشخصية</h4>
      </center>
     <div class="m-t m-b" >
     <center> <button type="submit"   ng-disabled="step1.$invalid" ng-click="steps.step2=false" class="btn btn-success btn-md" ><i class="fa fa-check"></i> Valider ma candidature | تأكيد المعلومات</button></center>
    </div> 

    
    <div class="panel-body">
      <div class="col-sm-12">
        
        <div class="col-sm-3">
          
          <p class="text-sm">C.I.N</p>
          <input type="text" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le N° de Carte d'identité Nationale المرجو إدخال رقم البطاقة الوطنية" name="cin" class="form-control input-md" ng-model="candidat.cin" required ng-change="step1.cin.$valid ? (steps.percent=30) : (steps.percent=20)" ng-pattern="/^[A-Z]{1,2}[0-9]+$/" placeholder="Exemple : XX000000">
          <br />


          <p class="text-sm">Nom</p>
          <input type="text" name="nom" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer votre nom de famille  المرجو إدخال الإسم العائلي" placeholder="Nom" class="form-control input-md" ng-model="candidat.nom"  required>
          <br />

          <p  class="text-sm">Prénom</p>
          <input type="text" name="prenom" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer votre prénom  المرجو إدخال الإسم الشخصي" placeholder="Prénom" class="form-control input-md" ng-model="candidat.prenom"  required>
          <br />

          <p  class="text-sm">Adresse</p>
          <textarea id="adresse_fr" name="adresse_fr" tooltip-trigger="focus"  ng-model="candidat.adresse_fr" tooltip-placement="top" tooltip="Entrer votre adresse  المرجو إدخال العنوان" class="form-control input-md"   required="true" placeholder="Adresse personnelle" >
          </textarea>
          


        </div>  

        <div class="col-sm-3">

          
         

         <p  class="text-sm" dir="rtl">الاسم العائلي</p>
         <input dir="rtl" type="text" name="nom_ar"  tooltip-trigger="focus"tooltip-placement="top" tooltip="Entrer votre nom de famille en arabe المرجو إدخال الإسم العائلي باللغة العربية" class="form-control input-md" ng-model="candidat.nom_ar" required ng-change="step1.nom_ar.$valid ? (steps.percent=30) : (steps.percent=20)" placeholder="الاسم العائلي">

         <br />
         <p  class="text-sm" dir="rtl" >الاسم الشخصي</p>
         <input  dir="rtl" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre prénom en arabe  المرجو إدخال الإسم الشخصي اللغة العربية" name="prenom_ar" placeholder="الاسم الشخصي" class="form-control input-md" ng-model="candidat.prenom_ar" required>
         <br />

         <p  class="text-sm">Date de naissance</p>
         <input type="date" name="date_naiss" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre date de naissance  المرجو إدخال تاريخ الازدياد" placeholder="dd/mm/yyyy" class="form-control input-md" ng-model="candidat.date_naiss" required>

         <br />

         

         <p  class="text-sm" dir="rtl" >العنوان الشخصي</p>
         <textarea  dir="rtl" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre adresse en arabe  المرجو إدخال العنوان باللغة العربية" id="adresse_ar" name="adresse_ar"  ng-model="candidat.adresse_ar"  class="form-control input-md"   required="true" placeholder="العنوان الشخصي" >
         </textarea>
         

       </div>


       <div class="col-sm-3">

        <p  class="text-sm">Lieu de naissance</p>
        <input type="text" name="lieu_naiss" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer le lieu de naissance المرجة ادخال مكان الازدياد" placeholder="Lieu de naissance" class="form-control input-md"  ng-model="candidat.lieu_naiss" required>
        <br />
        
        <p  class="text-sm">Sexe</p>
        <select id="sexe" name="sexe" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner le genre  المرجو اختيار الجنس" class="form-control input-md"  ng-model="candidat.sexe" required="true">
          <option>Homme</option>
          <option>Femme</option>
        </select>
        <br />

        <p  class="text-sm" >Tél</p>
        <input id="tel" type="text" name="tel" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer le Numéro de téléphone  المرجو إدخال رقم الهاتف" class="form-control input-md"   required placeholder="XXXXXXXXXX" ng-model="candidat.tel"  />
        <br />
        <br />

         <p  class="text-sm">Candidat Handicapé(e) ? 

          <input id="is_fonctionnaire" type="checkbox" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner cette case si vous êtes handicapé(e) المرجو اختيار هده الخانة ادا كنت شخصا معاقا"  name="is_fonctionnaire"   ng-model="candidat.is_fonctionnaire" /></p>
        

      </div>  


 <div class="col-sm-3">

      


         <p  class="text-sm">Diplôme</p>
         
        <!-- <a ui_sref="app.docs" class="label label-warning label-xs" style="float:left;">Plus d'info</a>--> <select id="diplome" name="diplome" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner votre diplôme de postulation  المرجو اختيار نوع الدبلوم الدي تريد أن تجتاز مباريات التوظيف من خلاله" class="form-control input-md" ng-model="candidat.diplome" required="true">
          <option ng-if="isAdministratif == true" value="Baccalauréat ou un diplôme équivalent">
          Baccalauréat ou un diplôme équivalent - البكالوريا أو ما يعادلها</option>   

          <option ng-if="isAdministratif == true" value="Diplôme de Technicien (4ème grade) ou un diplôme équivalent">Diplôme de Technicien (4ème grade) ou un diplôme équivalent - دبلوم تقني أو ما يعادله</option>

          <option ng-if="isAdministratif == true" value="DTS,DUT,BTS,DEUG (3ème grade) ou un diplôme équivalent">DTS,DUT,BTS,DEUG (3ème grade) ou un diplôme équivalent - دبلوم تقني متخصص أو ما يعادله</option>

          <option ng-if="isAdministratif == true" value="Licence ou un diplôme équivalent">
          Licence ou un diplôme équivalent - دبلوم الإجازة أو ما يعادلها</option>

          <option ng-if="isAdministratif == true" value="Master ou un diplôme équivalent">
          Master ou un diplôme équivalent - دبلوم الماستر أو ما يعادله</option>

          <option ng-if="isAdministratif == true" value="Ingénieur ou un diplôme équivalent">
          Ingénieur ou un diplôme équivalent - دبلوم مهندس دولة أو ما يعادله</option>

          <option ng-if="isProf == true" value="Doctorat ou un diplôme équivalent">Doctorat ou un diplôme équivalent - دبلوم الدكتوراه أو ما يعادها</option>

          <option ng-if="isProfM == true" value="Doctorat ou un diplôme équivalent (Médecine)">Doctorat ou un diplôme équivalent (Médecine) - (الطب) دبلوم الدكتوراه أو ما يعادها</option>

        </select>

         <br />

        <p  class="text-sm">Spécialité du diplôme</p>
        <input id="specialite" type="text" tooltip-placement="top" tooltip-trigger="focus" tooltip="Entrer votre spécialité du diplôme المرجو ادخال تخصص الدبلوم" name="specialite" class="form-control input-md"  required="true" placeholder="Spécialité du diplôme" ng-model="candidat.specialite" />

         <br />
          <p  class="text-sm">Fonctionnaire ? </p>
         <select class="form-control" tooltip-placement="top" tooltip-trigger="focus" tooltip="Sélectionner cette case si vous êtes fonctionnaire المرجو اختيار هده الخانة ادا كنت موظفا"  ng-model="fonct">
           <option value="Oui">Oui - نعم</option>
           <option value="Non">Non - لا</option>
         </select>
         <br />
         <p  ng-if="fonct == 'Oui'" class="text-sm">Remplir ce champ </p>
       
         <input ng-if="fonct == 'Oui'" id="etablissement" tooltip-trigger="focus" tooltip-placement="top" tooltip="Entrer votre administration المرجو ادخال المؤسسة التي تنتمي إليها"  type="text" name="etablissement" class="form-control"  placeholder="Administration - المؤسسة" ng-model="candidat.etablissement" />

        
         <br />
          <p  class="text-sm" ng-if="candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent'">Parcours LMD ? (Licence, Master, Doctorat) </p>
         <select class="form-control" ng-if="candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent'" ng-model="candidat.parcours">
           <option value="LMD">Oui - نعم</option>
           <option value="ING">Non - لا</option>
         </select>

      </div>  

      


    </div>

    
  </div>       
    <input type="hidden" name="filename_cv" />
    <input type="hidden" name="filename_diplome" />
    <input type="hidden" name="is_fonctionnaire" />
    <input type="hidden" name="created_by" />


</form>
</tab>


<tab heading="2 | Mes documents - الوثائق" ng-controller="FilesCtrl" ng-mouseenter="refFiles();" ng-init="loadFilesTab();" disabled="step1.$invalid" active="steps.step2" select="steps.percent=30">


<center>
  <h4 class="alert alert-info">خانة إدارة الملف التوظيفي</h4>
  <b class="text-danger">N.B: Vous n'avez pas le droit de supprimer un fichier déjà attaché a un concours postulé, si vous pouvez le supprimer il faut tout d'abord supprimer votre candidature a ce poste. </b>
  <p class="text-danger" style="font-weight: bold;">ملحوظة مهمة : ليس لديك الحق في حدف اي ملف من ملفاتك ادا كان هدا الملف وثيقة أساسية في أحد المباريات التي تقدمت اليها. فادا كنت تريد حدف هدا الملف فيجب عليك أن تحدف المباراة التي تقدمت اليها بهدا الملف أولا في <b class="text-primary"> (الخانة الرابعة المباريات التي ثم التقديم اليها)</b> ثم تقدم الى المباراة من جديد</p>
</center>
<center><a ui-sref="app.upload({slug: 'divers'})" ng-if="piecesManqu.length != 0 && piecesManqu.length != null" class="btn btn-danger btn-md">Votre dossier est incomplet! Veuillez terminer l'importation du dossier <hr />الملف ناقص , المرجو اتمام عملية رفع الملفات</a>  </center>

<br />

<div class="btn-toolbar">
     
    <div class="btn-group">
     <input type="text" ng-model="searchFile"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
    </div>
   <button class="btn btn-md btn-bg btn-info pull-right" ng-click="loadFilesTab();"><i class="fa fa-refresh"></i> Afficher les fichiers - إظهار الملفات</button> 
 </div>

<div class="row">
  <div class="col-lg-8">
  <!--TABLE D'AFFICHAGE -->
  <table  class="table table-bordered small" ng-mouseenter="refFiles();">

    <tr>
         <th data-toggle="true">
          <a    ng-click="sortType = 'file_type'; sortReverse = !sortReverse"  >
           <span  >Fichier - إظهار الملف</span>          
           <span ng-show="sortType == 'file_type' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'file_type' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th> 


       <th data-toggle="true">
            <a    ng-click="sortType = 'filename'; sortReverse = !sortReverse"  >
             <span  >Type du fichier - نوع الملف</span>
             <span ng-show="sortType == 'filename' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'filename' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>


       <th>
        Création - تاريخ رفع الملف
      </th>
      
      <th >
       Action - العملية
     </th>               
   </tr>
   
   <tr ng-repeat="file in fileDatas.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: searchFile | orderBy:sortType:sortReverse">

    <td>
        <a href="{{BASE_URL}}/uploadsFiles/{{file.usr_registration_token}}/files/{{file.filename}}" target="_blank" ><span class="label label-default"><i class="fa fa-download"></i> {{ file.filename }}</span></a>
    </td>
    <td>
        <span>{{file.type_file}}</span> 
    </td>  
    <td>{{file.created_at_file }}</td>
    <td> 
 

      <a data-record-id="{{file.id_file}}" data-record-title="{{file.type_file}}" title="{{ file.filename }}" data-toggle="modal" data-target="#confirm-delete"  ng-click="deleteFile()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i>
      </a>                 
    </td> 
   </tr>
</table>
</div>
<div class="col-lg-4">
  <table  class="table table-bordered small" ng-mouseenter="refFiles();">

    <tr>
         <th data-toggle="true">
          <a    ng-click="sortType = 'type'; sortReverse = !sortReverse"  >
           <span  >Type du fichier - نوع الملف</span>
           <span ng-show="sortType == 'type' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'type' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th> 


       <th data-toggle="true">
            <a    ng-click="sortType = 'nbre_files'; sortReverse = !sortReverse"  >
             <span  >Nbre de fichiers - عدد الملفات</span>
             <span ng-show="sortType == 'nbre_files' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'nbre_files' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>
          
   </tr>
   
   <tr ng-repeat="ft in fileDatasType.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | orderBy:sortType:sortReverse">
    <td>
        <span>{{ft.type}}</span> 
    </td>  
    <td>
        <span>{{ft.nbre_files}}</span> 
    </td>  
   </tr>
</table>
<!--Confirmation de dialogue Delete File BEGIN-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" >Confirmation</h4>
                </div>
                <div class="modal-body">
                 <p>
                   
                  Vous essayez de supprimer l'enregistrement <b class="label label-primary"><i class="title"></i></b>
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                
              </div>
            </div>
          </div>
</div> 
<!--Confirmation de dialogue Delete File END-->

</div>
</div>
</tab>

<tab heading="3 | Mes Jury - أعضاء اللجنة" ng-if="isProf == true || isProfM == true" ng-controller="JuryCtrl" ng-mouseenter="ref();"  ng-init="loadJurysMembers();" disabled="step1.$invalid" active="steps.step3" select="steps.percent=30">

 <center>
        <h4 class="alert alert-info">خانة إدارة أعظاء لجنة الأطروحة</h4>
</center>

<center class="alert alert-warning">
  <b ng-if="candidat.diplome !='Doctorat ou un diplôme équivalent (Médecine)' && candidat.diplome != 'Doctorat ou un diplôme équivalent'">
    Partie reservé aux candidats de type (Professeurs Assistants PA)
  </b><br />
  <b>هده الخانة مخصصة للمترشحين الاساتدة المساعدين</b>
</center>


 <table  class="table table-striped small" ng-if="candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent'" >

                <tr>
                  
                  <th data-toggle="true">
                    <a    ng-click="sortType = 'nom_complet'; sortReverse = !sortReverse"  >
                      <span  >Nom et Prénom </span>
                      <span ng-show="sortType == 'nom_complet' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'nom_complet' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

                  <th data-toggle="true">
                    <a    ng-click="sortType = 'etablissement'; sortReverse = !sortReverse"  >
                      <span  >Etablissement, Université </span>
                      <span ng-show="sortType == 'etablissement' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'etablissement' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

          
                  <th data-toggle="true">
                    <a    ng-click="sortType = 'specialite'; sortReverse = !sortReverse"  >
                      <span  >Spécialité  </span>
                      <span ng-show="sortType == 'specialite' && !sortReverse" class="fa fa-caret-down"></span>
                      <span ng-show="sortType == 'specialite' && sortReverse" class="fa fa-caret-up"></span>
                    </a>
                  </th>

           

                  <th >
                    Action
                  </th>                  
                </tr>
                <tr ng-repeat="file in jury | orderBy:sortType:sortReverse">
                 <td><span>{{file.nom_complet}}</span></td>  
                 <td><span>{{file.etablissement}}</span></td>  
                  <td><span>{{file.specialite}}</span></td>  

                 <td> 


                  <i  ng-if="date > hireEdit.session_date_end" class="glyphicon glyphicon-lock"></i>


                  <a  data-record-id="{{file.id}}" data-record-title="{{file.nom_complet}}" title="{{ file.nom_complet }}" data-dismiss="modal" data-toggle="modal" data-target="#confirm-delete-jury"
                  
                  ng-click="deleteJury(file.id)" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i></a>

                </td> 
              </tr>
            </table>

 

</tab>

  <tab heading="4 | Mes candidatures - المباريات التي ثم التقديم إليها" tooltip-placement="bottom" tooltip="هده الخانة مخصصة للمباريات التي ثم التقدم اليها" 
       ng-controller="PostulationCtrl" disabled="step1.$invalid" active="steps.step4" select="steps.percent=30">



  <div class="btn-toolbar">
     
    <div class="btn-group">
     <input type="text" ng-model="search" style="width: 500px;"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher..."> 
    </div>
   <button class="btn btn-md btn-bg btn-primary pull-right" ng-click="refreshPostulation();"><i class="fa fa-refresh"></i> Afficher</button> 
 </div>
    <div class="table table-responsive">
    <!--Table suivre ma candidature et historique de postulation -->
    <table  class="table table-striped small" >

         <tr>
          <!-- <th>
            <a    ng-click="sortType = 'num'; sortReverse = !sortReverse"  >
             <span  > N° d'inscription </span>
             <span ng-show="sortType == 'num' && !sortReverse" class="fa fa-caret-down"></span>
             <span ng-show="sortType == 'num' && sortReverse" class="fa fa-caret-up"></span>
           </a>
         </th>-->

        <th>
          <a    ng-click="sortType = 'type_name'; sortReverse = !sortReverse"  >
           <span  > Grade </span>
           <span ng-show="sortType == 'type_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'type_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
        </th>
        <th>
          <a    ng-click="sortType = 'etablissement_name'; sortReverse = !sortReverse"  >
           <span  > Etablissement </span>
           <span ng-show="sortType == 'etablissement_name' && !sortReverse" class="fa fa-caret-down"></span>
           <span ng-show="sortType == 'etablissement_name' && sortReverse" class="fa fa-caret-up"></span>
         </a>
       </th>
         
       <th>
        <a  ng-click="sortType = 'postuled_at'; sortReverse = !sortReverse" >
         <span > Date de postulation  </span>
         <span ng-show="sortType == 'postuled_at' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'postuled_at' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>

       <th>
        <a  ng-click="sortType = 'session_date_end'; sortReverse = !sortReverse" >
         <span > Date limite de dépôt</span>
         <span ng-show="sortType == 'session_date_end' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'session_date_end' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
       <th>
        <a  ng-click="sortType = 'hire_date'; sortReverse = !sortReverse" >
         <span > Date de concours  </span>
         <span ng-show="sortType == 'hire_date' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'hire_date' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th>
        <a  ng-click="sortType = 'etat'; sortReverse = !sortReverse" >
         <span > Etude préalable de mon dossier </span>
         <span ng-show="sortType == 'etat' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'etat' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th ng-if="display_motif == true">
        <a  ng-click="sortType = 'etatFinale'; sortReverse = !sortReverse" >
         <span > Etat finale de ma candidature </span>
         <span ng-show="sortType == 'etatFinale' && !sortReverse" class="fa fa-caret-down"></span>
         <span ng-show="sortType == 'etatFinale' && sortReverse" class="fa fa-caret-up"></span>
       </a>
      </th>
      <th>
        Reçu de dépôt
      </th>
      <th>Motif </th>
      <!--  <th>Convocation</th>  -->
      <th translate="categorie.titles.ACTIONS">
       Action
      </th>
  </tr>

  <tr ng-repeat="hire in postules.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
 
  	  <td>{{hire.type_name}} en <b>{{hire.specialty_fr }}</b></td>
      <td>{{hire.etablissement_name}}</td>
      <td>{{hire.postuled_at | date:'dd-MM-yyyy' }}</td>
      <td>{{hire.session_date_end | date:'dd-MM-yyyy' }}</td>
      <td>{{hire.hire_date | date:'dd-MM-yyyy' }}</td>
      <td>
      <span class="label label-danger label-xs"   ng-if="hire.accepted==0" ><i class="fa fa-ckeck"></i> Le dossier est étudié </span>  
       <span class="label label-success label-xs" ng-if="hire.accepted==1" ><i class="fa fa-ckeck"></i> Le dossier est étudié </span>
       <span class="label label-warning label-xs" ng-if="hire.accepted==2" >Le dossier est en cours d'étude par le service R.H... </span>
      </td>
  
  	 <td ng-if="display_motif == true">
      	<span class="label label-danger label-xs"   ng-if="hire.etatFinale==0" ><i class="fa fa-ckeck"></i> Candidature rejetée. </span>  
        <span class="label label-success label-xs" ng-if="hire.etatFinale==1" ><i class="fa fa-ckeck"></i> Candidature acceptée.</span>
        <span class="label label-warning label-xs" ng-if="hire.etatFinale==2 || hire.etatFinale== null " >Votre candidature est en cours de validation. </span>
      </td>
      <td>




              <form tooltip-placement="top" tooltip="Votre reçu de dépôt est prêt pour l'impression المرجو طباعة الوصل" ng-if="hire.prepared == true" method="POST" action="tpl/recu.php" target="_blank">

                <input type="hidden" name="hidden" value="{{hire}}" />
                <input type="hidden" name="candidat" value="{{candidat}}" />
                <input type="hidden" name="files" value="{{fileDatas}}">
                 <button type="submit" name="submit"  class="btn btn-success btn-md" ><i class="fa fa-print"></i> Imprimer le reçu de dépôt</button>

              </form>


                <button tooltip-placement="top" tooltip="Veuillez préparer votre reçu de dépôt du dossier المرجو تحظير الوصل بالنقر على هدا الزر" type="submit" ng-if="hire.prepared == false || hire.prepared == NULL" ng-click="prepareRecu(hire.postule_id)" class="btn btn-default btn-md font-bold"  ui-toggle-class="show inline" target="#{{hire.postule_id}}">
                <i ng-show="{{hire.prepared}}" class="fa  fa-check"></i>
                <span ng-if="hire.prepared == false || hire.prepared == NULL">Préparer le reçu de dépôt  </span>
                <i class="fa fa-spin fa-spinner hide" id="{{hire.postule_id}}"></i>
              </button>
      </td>
     
   
      <td>
         <p ng-if="hire.etatFinale == 0 && hire.dossier != null">{{hire.dossier }} <span class="label label-success label-xs">Par administrateur</span></p>
       </td>             
       <td>
          <i   ng-if="date > hire.session_date_end || hire.accepted == 1 || hire.accepted == 0" class="glyphicon glyphicon-lock"></i>
          <a tooltip-placement="top" tooltip="Supprimer votre candidature a ce poste حدف تقديمك لهدا المنصب"  ng-if="date <= hire.session_date_end && hire.accepted == 2" data-record-id="{{hire.postule_id}}" data-record-title="{{hire.type_name}} en {{hire.specialty_fr }} - Etablissement {{hire.etablissement_name}}" data-toggle="modal" data-target="#confirm-delete-candidature" ng-click="deletePostuler()" title="{{'operations.DELETEOP' | translate}}"><i class="glyphicon glyphicon-remove"></i>
          </a>
       </td>               
     </tr>
               
  </table>

  <div class="modal fade" id="confirm-delete-candidature" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel" >Confirmer la suppression</h4>
                </div>
                <div class="modal-body">
                 <p>
                  Vous essayez de supprimer votre candidature de : <br /><b class="text-primary font-bold"><i class="title"></i></b>
                 </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-ok btn-xs pull-left" translate="operations.DELETEOP">Delete</button>
                  <button type="button" class="btn btn-default btn-xs pull-left" data-dismiss="modal">X</button>
                </div>
              </div>
            </div>
  </div>

</div>

</tab>



</tabset>
</div>
</div>
</div>
</div>



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
</style> 


<div ng-controller="CandidatCtrl">
  
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




  <div class="wrapper-md">



   <div class="panel panel-default"> 
     
<!--
  <div class="col-lg-6">
<div class="list-group-item">
  
   <progressbar value="advenced" class="progress-striped active progress-xs m-b-sm" animate="true" type="info"><span style="white-space:nowrap;">{{advenced}}%</span></progressbar>
</div>
</div>-->





<tabset class="tab-container" ng-init="steps={percent:20, step1:true, step2:false, step3:false}">
     
    
   
    <!--<h4>Informations personnelles</h4>-->
    <form name="step1" class="form-validation" ng-submit="saveCandidat()">



     <div class="m-t m-b" >
      <button type="submit" ng-disabled="step1.$invalid" class="btn btn-primary btn-rounded" ng-click="steps.step2=true">Suivant</button>
    </div> 

    
    <div class="panel-body">
      <div class="col-sm-12">
        
        <div class="col-sm-3">
          
          <p class="text-sm">C.I.N</p>
          <input type="text" name="cin" class="form-control input-md" ng-model="candidat.cin" required ng-change="step1.cin.$valid ? (steps.percent=30) : (steps.percent=20)" ng-pattern="/^[A-Z]{1,2}[0-9]+$/" placeholder="Exemple : XX000000">
          <br />


          <p class="text-sm">Nom</p>
          <input type="text" name="nom" placeholder="Nom" class="form-control input-md" ng-model="candidat.nom"  required>
          <br />

          <p  class="text-sm">Prénom</p>
          <input type="text" name="prenom" placeholder="Prénom" class="form-control input-md" ng-model="candidat.prenom"  required>
          <br />

          <p  class="text-sm">Adresse</p>
          <textarea id="adresse_fr" name="adresse_fr"  ng-model="candidat.adresse_fr"  class="form-control input-md"   required="true" placeholder="Adresse personnelle" >
          </textarea>
          


        </div>  

        <div class="col-sm-3">

          
         

         <p  class="text-sm" dir="rtl">الاسم العائلي</p>
         <input dir="rtl" type="text" name="nom_ar" class="form-control input-md" ng-model="candidat.nom_ar" required ng-change="step1.nom_ar.$valid ? (steps.percent=30) : (steps.percent=20)" placeholder="الاسم العائلي">

         <br />
         <p  class="text-sm" dir="rtl" >الاسم الشخصي</p>
         <input  dir="rtl" type="text" name="prenom_ar" placeholder="الاسم الشخصي" class="form-control input-md" ng-model="candidat.prenom_ar" required>
         <br />

         <p  class="text-sm">Date de naissance</p>
         <input type="date" name="date_naiss" placeholder="dd/mm/yyyy" class="form-control input-md" ng-model="candidat.date_naiss" required>

         <br />

         

         <p  class="text-sm" dir="rtl" >العنوان الشخصي</p>
         <textarea  dir="rtl" id="adresse_ar" name="adresse_ar"  ng-model="candidat.adresse_ar"  class="form-control input-md"   required="true" placeholder="العنوان الشخصي" >
         </textarea>
         

       </div>


       <div class="col-sm-3">

        <p  class="text-sm">Lieu de naissance</p>
        <input type="text" name="lieu_naiss" placeholder="Lieu de naissance" class="form-control input-md"  ng-model="candidat.lieu_naiss" required>
        <br />
        
        <p  class="text-sm">Sexe</p>
        <select id="sexe" name="sexe" class="form-control input-md"  ng-model="candidat.sexe" required="true">
          <option>Homme</option>
          <option>Femme</option>
        </select>
        <br />

        <p  class="text-sm" >Tél</p>
        <input id="tel" type="text" name="tel" class="form-control input-md"   required placeholder="0XXXXXXXXX" ng-model="candidat.tel"  />
        <br />


         <p  class="text-sm">Candidat Handicapé(e) ? 
                    <input id="is_fonctionnaire" type="checkbox" name="is_fonctionnaire"   ng-model="candidat.is_fonctionnaire" /></p>
        

      </div>  


 <div class="col-sm-3">

      


         <p  class="text-sm">Diplôme</p>
         
        <!-- <a ui_sref="app.docs" class="label label-warning label-xs" style="float:left;">Plus d'info</a>--> <select id="diplome" name="diplome" class="form-control input-md" ng-model="candidat.diplome" required="true">
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

        S

         <br />
          <p  class="text-sm">Fonctionnaire ? </p>
         <select class="form-control" ng-model="fonct">
           <option value="Oui">Oui - نعم</option>
           <option value="Non">Non - لا</option>
         </select>
         <br />
         <p  ng-if="fonct == 'Oui'" class="text-sm">Remplir ce champ </p>
         <input ng-if="fonct == 'Oui'" id="etablissement" type="text" name="etablissement" class="form-control"  placeholder="Organisme" ng-model="candidat.etablissement" />

        

      </div>  

      


    </div>

    
  </div>


  



</form>
 
<tab heading="Diplôme" disabled="step1.$invalid" active="steps.step2" select="steps.percent=30">
  <form name="step2" class="form-validation" ng-submit="saveCandidat()">

    
    <div class="m-t m-b" >
      <button type="button" class="btn btn-default btn-rounded" ng-click="steps.step1=true">Précédent</button>
      <button type="submit" ng-disabled="step2.$invalid" class="btn btn-success btn-rounded" ng-click="redirect();" >Terminer</button>
    </div>

    <div class="panel-body">
      
      <div class="col-sm-12">
        
        <div class="col-sm-4">
         <p  class="text-sm">Diplôme</p>
         
         <a ui_sref="app.docs" class="label label-warning label-xs" style="float:left;">Plus d'info</a> <select id="diplome" name="diplome" class="form-control input-md" ng-model="candidat.diplome" required="true">
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Baccalauréat ou un diplôme équivalent</option>            
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Diplôme de Technicien (4ème grade) ou un diplôme équivalent</option>
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">DTS,DUT,BTS,DEUG (3ème grade) ou un diplôme équivalent</option>
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Licence ou un diplôme équivalent</option>
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Master ou un diplôme équivalent</option>
          <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Ingénieur ou un diplôme équivalent</option>
          <option ng-if="(isProf == true || isProfM == true) && ( role=='Candidat-PESAF' || role=='Candidat-PESAM')">Doctorat ou un diplôme équivalent</option>
        </select>


        <br />

        <p  class="text-sm">Spécialité du diplôme</p>
        <input id="specialite" type="text" name="specialite" class="form-control input-md"  required="true" placeholder="Spécialité du diplôme" ng-model="candidat.specialite" />


      </div>

      <div class="col-sm-4">
       <p  class="text-sm">Année d'obtention</p>
       <input id="date_obtention" type="text" name="date_obtention" class="form-control input-md"  required="true" placeholder="mm/aaaa" ng-model="candidat.date_obtention" />
       <br />


       <p  class="text-sm">Mention</p>
       <select id="mention" name="mention" class="form-control input-md" ng-model="candidat.mention" required="true">
        <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Passable</option>
        <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Assez-bien</option>
        <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Bien</option>
        <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Très Bien</option>
        <option ng-if="isAdministratif == true  && role=='Candidat-Normale' ">Excellent</option>
        <option ng-if="(isProf == true || isProfM == true) && ( role=='Candidat-PESAF' || role=='Candidat-PESAM')" >Honorable</option>
        <option ng-if="(isProf == true || isProfM == true) && ( role=='Candidat-PESAF' || role=='Candidat-PESAM')" >Très Honorable</option>
        <option ng-if="(isProf == true || isProfM == true) && ( role=='Candidat-PESAF' || role=='Candidat-PESAM')" >Très Honorable avec les félicitations du jury</option>
      </select>


      
    </div>

    <div class="col-sm-4">
           <!-- <p  class="text-sm">Niveau</p>
            <select id="niveau" name="niveau" ng-hide='true' class="form-control input-md" ng-model="candidat.niveau" required="true">
                      <option  ng-if="isAdministratif == true  && role=='Candidat-Normale' " value="BAC+2">DUT,DTS,BTS,DEUG ou un diplôme équivalent</option>
                      <option  ng-if="isAdministratif == true  && role=='Candidat-Normale' " value="BAC+3">Licence ou un diplôme équivalent</option>
                      <option  ng-if="isAdministratif == true  && role=='Candidat-Normale' "  value="BAC+5">Master ou un diplôme équivalent</option>
                      <option  ng-if="isAdministratif == true  && role=='Candidat-Normale' "  value="BAC+5">Ingénieur ou un diplôme équivalent</option>
                      <option ng-if="(isProf == true || isProfM == true) && ( role=='Candidat-PESAF' || role=='Candidat-PESAM')" value="BAC+8">Doctorat ou un diplôme équivalent</option>
                    </select>-->
                    


                    <p  class="text-sm">Si vous êtes un fonctionnaire ? informer ce champ </p>
                    <input id="etablissement" type="text" name="etablissement" class="form-control input-md"  placeholder="Organisme" ng-model="candidat.etablissement" />

                  </div>
                  <div class="col-sm-4">
                    <br />
                    <br />
                    <p  class="text-sm">Candidat Handicapé(e) ? 
                    <input id="is_fonctionnaire" type="checkbox" name="is_fonctionnaire"   ng-model="candidat.is_fonctionnaire" /></p>
                    
                  </div>
                  
                  <br />
                  
                  <input type="hidden" name="filename_cv" />
                  <input type="hidden" name="filename_diplome" />
                  <input type="hidden" name="is_fonctionnaire" />
                  <input type="hidden" name="created_by" />

                  

                </div>
              </div>

              
              
              
              
            </form>
          </tab>
          
        </tabset>
      </div>
    </div>

    
  </div>



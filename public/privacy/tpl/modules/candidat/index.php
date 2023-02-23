<?php 
  /**
 * @author ZAHR-EDDINE EL BOUZIDI
 * @copyright copyright ZAHR - DRH.ENSSUP 2019
 * @api Framework ZF
 * @version 2.4.1 - stable
 */


  ?>

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
  <h2 class="m-n font-thin text-primary">Liste des concours ouverts</h2>   <hr />    
  <h4 class="m-n font-bold text-danger">N.B: Veuillez Postuler aux concours correspondants à votre spécialité du diplôme !</h4>   
  <h4 class="m-n font-bold text-danger" ng-if="!admin && adminName=='standard' && (role=='Candidat-PESAF' || role=='Candidat-PESAM') ">N.B: Un dossier soumissioné sans membres de jury de la thèse ou incomplet sera rejeté automatiquement. !</h4>   
  <h4 class="m-n font-bold text-danger" ng-if="!admin && adminName=='standard' && (role=='Candidat-Normale') ">N.B: Un dossier soumissioné incomplet sera rejeté automatiquement. !</h4>   
   
  <input type="text" ng-model="search"  class="form-control input-lg bg-white rounded padder" placeholder="Rechercher">
  <br />
   <center> <button class="btn btn-md btn-bg btn-default" ng-click="refListHire();"><i class="fa fa-refresh"></i> Afficher les concours | عرض المباريات المفتوحة</button><br /><br />
 
                <h4 class="m-n font-bold text-primary">Veuillez sélectionner un établissement</h4>
               <select id="etablissement_id" style="width: 500px;" name="etablissement_id" ng-model="type.etablissement_id" class="form-control" ng-options="etablissement.etablissement_id as etablissement.etablissement_name group by 'Sélectionner une établissement...' for etablissement in etablissements" ng-change="load(type.etablissement_id)" id="type.etablissement_id" name="type.etablissement_id"  >
                <option></option>
              </select>
              
 
  </center>           
 
</div>

 <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : {{itemsPerPage}} / {{totalItems}} </span>
 <select style="float: right;" ng-model="viewby" ng-change="setItemsPerPage(viewby)">
   <option>5</option> <option>10</option> <option>20</option> <option>Tous</option>
 </select> 
</div>



<div class="wrapper-md" >
  
 
  
  <div class="panel panel-default">
   
 

   <div class="row row-sm">

    <div  style="width: 250px;">
      

      <p class="label label-info text-center" ng-if="length == 0"><i class="icon icon-info"></i> Aucun concours disponible !</p>


    </div>

    <div   class="col-sm-4 col-md-4 col-sm-6" ng-repeat="hire in hires.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">

      <div class="panel b-a">
        <div class="panel-heading wrapper-xs bg-success no-border" style="color: #f4f3f9;
        background-color: {{ hire.color }};">          
      </div>
      <sup class="label label-danger label-xs" style="float:right;" ng-show="date > hire.session_date_end" >Expiré</sup>
      <div class="wrapper text-center">
        
        <h4 class="text-u-c m-b-none text-ellipsis" ng-hide="date > hire.session_date_end">Recrutement - {{hire.type_name}}</h4>
        <h4 class="text-u-c m-b-none text-ellipsis" ng-hide="date > hire.session_date_end" dir="rtl">  مبارة توظيف {{hire.type_name_ar}}</h4>
        <h4 class="text-u-c m-b-none text-ellipsis text-l-t" ng-show="date > hire.session_date_end" >Recrutement - {{hire.type_name}}</h4>
        <h4 class="m-t-none">
         {{hire.post_number}} Poste(s) {{hire.type}}
        </h4>
        <h3 class="m-t-none text-ellipsis">
         {{hire.specialty_fr }}
        </h3>
      </div>
      

      <ul class="list-group">
        
        <li class="list-group-item">
          <center><u>
            <span class="text-md text-lt text-primary"> 
          Administration organisatrice : {{hire.university_name }} - {{hire.etablissement_name }}</span>
        </u></center>       
          <b> <small class="block m-t-xs text-ellipsis" ><i class="icon-check text-default m-r-xs"></i>Spécialité: {{hire.specialty_fr }}</small> </b>
          <b> <em class="text-xs text-ellipsis"><i class="fa fa-calendar text-default m-r-xs"></i>Publié le: <span class="text-dark">{{hire.session_date_begin | date:'dd-MM-yyyy' }}</span></em></b>
          <b><em class="text-xs text-ellipsis"><i class="fa fa-calendar text-default m-r-xs"></i>Date limite de dépôt du dossier: <span class="text-danger">{{hire.session_date_end | date:'dd-MM-yyyy' }}</span></em></b>
          <b><em class="text-xs text-ellipsis text-u-l"><i class="fa fa-calendar text-default m-r-xs"></i>Concours le: <span class="text-success">{{hire.hire_date | date:'dd-MM-yyyy' }}</span></em></b>

          <em class="text-xs text-ellipsis"><i class="fa fa-list text-default m-r-xs"></i>Nombre de poste(s): <span class="text-default">{{hire.post_number}}</span></em>           
        </li>
      </ul>
      
      <div class="panel-footer text-center" >
        <form method="post">
       
         <button type="submit" class="btn btn-primary font-bold m" ng-if="(candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent' && nbre_jury >= 3)" ng-click="redirectUploadRestFiles(hire.id);">Sélectionner </button>

         <p class="text-danger" ng-if="(candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent' && nbre_jury <= 3)">Veuillez compléter les membres de jury de la thèse <br /> Vous avez {{nbre_jury}} membre(s) de jury <br />! المرجوا ادخال اعظاء لجنة الأطروحة لديك {{nbre_jury}} أعضاء فقط </p>
         <a class="label label-primary label-xs" ng-if="(candidat.diplome =='Doctorat ou un diplôme équivalent (Médecine)' || candidat.diplome == 'Doctorat ou un diplôme équivalent' && nbre_jury <= 3)" ui-sref="app.upload({slug: 'divers'})">Cliquez ici - إظغط هنا</a>


         <button type="submit" class="btn btn-primary font-bold m" ng-if="candidat.diplome !='Doctorat ou un diplôme équivalent (Médecine)' && candidat.diplome != 'Doctorat ou un diplôme équivalent'" ng-click="redirectUploadRestFiles(hire.id);">Sélectionner </button>
         <!--<button type="submit" class="btn btn-primary font-bold m"  ng-click="savePostuler(hire)">Postuler</button>-->
       </form>
     </div>
   </div>
 </div>

 <!-- <div ng-init="checked();" ng-if="piecesManqu.length != 0" class="col-lg-8" >
        
        <span class="label label-danger">Veuillez complèter votre dossier avec des pièces manquantes à fournir !</span> <br />
        <p class="label label-primary"><i class="fa fa-info"></i> les pièces manquants :</p>
        <pre style="margin: 5px;">
          <li class="text-danger" ng-repeat="piece in piecesManqu">{{piece}}.</li>
        </pre>

      </div>-->



    </div>

    
  </div>


</div>


 

<script type="text/javascript">
  function generate() {
    var doc = new jsPDF('p', 'pt','A4');
    var res = doc.autoTableHtmlToJson(document.getElementById("basic-table"));
  //var info = doc.autoTableHtmlToJson(document.getElementById("info"));
  //doc.autoTable(res.columns, res.data, {margin: {top: 80}});
  var header = function(data) {

  };

  doc.setFontSize(18);
  doc.setTextColor(40);
  doc.setFontStyle('times');
  doc.addImage(document.getElementById("imgD"), 'JPEG', doc.autoTableEndPosY() + 40, 20, 50, 50);
  doc.text(250, 130, "Convocation");


   /*doc.fromHTML($(document.getElementById("pdfdiv")).html(), 15, 15, {
                    'width': 100,
                    'elementHandlers': specialElementHandlers
                  });*/

                  var options = {
                    beforePageContent: header,
                    margin: {
                      top: 500
                    },
                    startY: doc.autoTableEndPosY() + 415
                  };

                  
                  doc.fromHTML(
                   document.getElementById("imgD"),
                   doc.autoTableEndPosY() + 10,
                   50); 

                  doc.fromHTML(
                   document.getElementById("universite"),
                   doc.autoTableEndPosY() + 95,
                   10); 

                  doc.fromHTML(
                   document.getElementById("contentheight"),
                   doc.autoTableEndPosY() + 40,
                   156);

                  doc.fromHTML(
                   document.getElementById("content"),
                   doc.autoTableEndPosY() + 40,
                   230);

                  doc.fromHTML(
                   document.getElementById("convoque"),
                   doc.autoTableEndPosY() + 40,
                   430);

                  doc.fromHTML(
                   document.getElementById("note"),
                   doc.autoTableEndPosY() + 40,
                   740);

                  

      //doc.fromHTML(
      //document.getElementById("note"),
      //doc.autoTableEndPosY() + 40,
      //480);
  //doc.autoTable(null, null, options);

  doc.save("convocation.pdf");
}

</script>

<toaster-container toaster-options="{'position-class': 'toast-top-right', 'close-button':true}"></toaster-container>

<div ng-controller="ConvocationCtrl">
   <!--<toaster-container
    toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


    <div class="bg-light lter b-b wrapper-md"  >
      <div>
       <h4>Mes concours</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1" translate="operations.HOME"><i class="fa fa-home"></i> Accueil</a></li>
        <li class="active" >Mes concours</li>
      </ul>
    </div>
    
    <span class="btn btn-info btn-xs" style="float: right;" >Enregistrement(s) : 1 / 1 </span>
    
  </div>
  


  <div class="wrapper-md" >


   <!--<button onclick="generate()" ng-show="execute == true"  class="btn btn-primary btn-xs" ><i class="fa fa-print"></i> Imprimer</button> -->
   
   <pre id="universite" style="display: none;">
     Ministère de l'Education Nationale, de la Formation professionnelle<br />
     de l'Enseignement Supérieur et de la Recherche Scientifique<br />
     {{convocation[0].university_name}} - {{convocation[0].etablissement_name}}
   </pre> 
   
   
   <div class="panel panel-default">

    <img id="imgD" src="img/log20.png" style="display: none;">
    <div id="contentheight" class="panel panel-info" style="font-family: times;">
     <div class="panel-heading">

      <h5><b><u>Concours de recrutement - {{convocation[0].type_name}} ({{convocation[0].post_number}} poste(s))</u></b></h5>
      <h6>Spécialité :  {{ convocation[0].specialty_fr }}  </h6>
      <h6>Date du concours : {{convocation[0].hire_date | date:'dd-MM-yyyy'}}  </h6>
    </div>
  </div>
  <div id="content" class="panel panel-info" style="font-family: times;">
   
    
    <h5><u>Détails :</u></h5>

    <div class="panel-heading" ng-if="convocation[0].user_type == 'Candidat-Professeur'">
     
      <p>
        <b> <u>N° dinscription   :  {{ convocation[0].num }}</u></b>
      </p>

      <p>
       <u>Nom et Prénom        :  {{ convocation[0].nom }} {{ convocation[0].prenom }}</u>
     </p>

     <p>
       <u>C.I.N                :    {{ convocation[0].cin }} </u>
     </p>

     <p>
       <u>Né(e) le             :{{ convocation[0].date_naiss }} à {{ convocation[0].lieu_naiss }}</u>
     </p>
     

         <!-- <p>
            <u>Diplôme               :  {{ convocation[0].diplome }} </u>
          </p>

          <p>
            <u>Spécialité du diplôme :    {{ convocation[0].diplome_specialite }} </u>
          </p>

          <p>
            <u>Session du diplôme    :    {{ convocation[0].date_obtention  }} </u>
          </p>-->
          
        </div>

        <div class="panel-heading" ng-if="convocation[0].user_type != 'Candidat-Professeur'">
         
          <p>
            <b> <u>N° dinscription   :  {{ convocation[0].num }}</u></b>
          </p>

          <p>
           <u>Nom et Prénom        :  {{ convocation[0].nom }} {{ convocation[0].prenom }}</u>
         </p>

         <p>
           <u>C.I.N                :    {{ convocation[0].cin }} </u>
         </p>

         <p>
           <u>Né(e) le             :{{ convocation[0].date_naiss }} à {{ convocation[0].lieu_naiss }}</u>
         </p>
         

         <p>
          <u>Diplôme               :  {{ convocation[0].diplome }} </u>
        </p>

        <p>
          <u>Spécialité du diplôme :    {{ convocation[0].diplome_specialite }} </u>
        </p>

        <p>
          <u>Session du diplôme    :    {{ convocation[0].date_obtention  }} </u>
        </p>
        
      </div>

      

    </div>
    <div id="convoque" style="display: none;font-family:times;color: #000;">
     <p>
       Vous êtes prié(e) de vous présenter, muni(e) de cette convocation et d'une pièce d'identité,  le :{{convocation[0].hire_date | date:'dd-MM-yyyy'}} <br />
     </p>
     <ul>
       <li>
         
       </li>
       <li>
         À  : Lieu de l'épreuve écrite sera affiché sur les listes des candidats convoquées <br />dans la plateforme E-Concours et sur le site du ministère https://www.enssup.gov.ma/
       </li>
     </ul>
   </div>
   



   <pre id="note" style="display: none;font-family:times;font-size: 12px;"> 
    <p>N.B :</p>
    <li>Toute fausse information entraînera l'annulation de votre candidature.</li>
    <li>Tous les candidats doivent impérativement se présenter 30 minutes avant l'épreuve avec convocation et pièce d'identité.</li>
  </pre>
  <table id="basic-table"  class="table table-condensed">

    <thead>
      <tr>
        <td></td>
      </tr>
    </thead>
    <tbody>
      <tr><td></td></tr>
      
    </tbody>
    

    
  </table>
  
  <div class="row row-sm">
   




   



  </div>

  
</div>


</div>

</div>
<div class="hbox hbox-auto-xs hbox-auto-sm">
  <!-- .aside -->
  <div class="col w w-auto-xs bg-light inherit dk b-r">
    <div class="wrapper-md b-b">
      <a class="btn btn-link pull-right m-t-n-xs m-r-n-sm visible-sm visible-xs" ui-toggle-class="show" data-target="#nav-docs">
        <i class="fa fa-bars"></i>
      </a>
      <span class="h4 text-center">Guide d'utilisation de la plateforme {{app.name}}</span>
      <em class="padder b-b l-h-2x bg text-info">Version {{app.version}}</em>
    </div>
    <div class="hidden-sm hidden-xs" id="nav-docs">
      <ul class="nav">
        <li class="padder b-b l-h-2x bg text-info"><em>Comment postuler à un concours ?</em></li>
        <li><a ui-scroll="node-req">Mon Profil</a></li>
        <li><a ui-scroll="bower">Mes Pièces Jointes</a></li>
        <li><a ui-scroll="grunt">Mes concours</a></li>      
        <li><a ui-scroll="dev-server">Mes candidatures</a></li>
      </ul>
    </div>
  </div>
  <!-- /.aside -->
  <div class="col"> 
    <div class="clearfix padder-md">
      <h3 class="text-info m-t-xl font-thin m-b-none">Comment postuler à un concours ? </h3><br />
      <div>Pour postuler à un concours, merci de suivre les étapes suivantes:</div>

      <div id="node-req" class="wrapper"></div>
      <div class="line b-b"></div>
      <h4 class="m-t-xl font-bold">Mon profil</h4>
      <p>

        Avant de  postuler à un concours, le candidat est invité à saisir ses informations personnelles, Cliquez sur le lien  <a ui-sref="app.profil"  class="text-info font-bold">Mon profil</a> et compléter vos informations personnelles et diplôme.<br /> 
        
      </p>
      
      <p class="well b bg-light lt wrapper-sm m-t text-danger font-bold">
        N.B: Toute fausse information entraînera l'annulation de votre candidature.
      </p>

      <div id="bower" class="wrapper"></div>
      <div class="line b-b"></div>
      <h4 class="m-t-xl font-bold">Mes Pièces Jointes</h4>


      <p>
        Dans le volet <a ui-sref="app.upload({slug: 'divers'})"  class="text-info font-bold">Mes Pièces jointes</a>, le candidat doit scanner ses pièces jointes indiquées au niveau du type du pièce jointe en format PDF.<br />
        
      </p>


      <span  class="text-danger">N.B:</span>
      <ol>
       <li class="text-danger">Les documents illisibles, mal orientés ou bien scannés a l'aide d'un appareil photo ou Smartphone ne seront pas acceptés.</li>
       <li class="text-danger">Toute fausse information entraînera l'annulation de votre candidature.</li>
       <li class="text-danger">Toute candidature avec des documents non légalisés sera automatiquement rejetée.</li>
       <li class="text-danger"> Le candidat doit charger ou scanner :
        <ul>
          <li class="text-danger">Documents en format PDF.</li>
          <li class="text-danger">Déclaration sur l'honneur</li>
          <li class="text-danger">Autorisation de participation au concours (Fonctionnaires)</li>
          <li class="text-danger">Arrêté d'équivalence des diplômes étrangers (publié au bulletin officiel)</li>
        </ul>
      </li>
      
      
      
      
    </ol>



    <h4 class="">Les Administratifs</h4> 
    
    <ul>
      <li> 
        <a ui-sref="app.docpadiplomesadmin({slug: 'diplomes-adminstratifs'})"  class="text-info font-bold">Diplômes </a>
        
        <ul>
          <li>DT : Diplôme de Technicien (4ème grade) ou un diplôme équivalent.</li>
          <li>DTS : Diplôme de Technicien Spécialisé (3ème grade) ou un diplôme équivalent.</li>
          <li>DEUG : Diplôme d'Études Universitaires Générales (3ème grade) ou un diplôme équivalent.</li>
          <li>DUT : Diplôme Universitaire de Technologie (3ème grade) ou un diplôme équivalent.</li>
          <li>BTS : Brevet de Technicien Supérieur (3ème grade) ou un diplôme équivalent.</li>
          <li>LICENCE : Licence ou un diplôme équivalent.</li>
          <li>MASTER : Master ou un diplôme équivalent.</li>
          <li>INGENIRIE : Ingénieur ou un diplôme équivalent.</li>
        </ul>
        
        
      </li>
      <li> <a ui-sref="app.upload({slug: 'divers'})"  class="text-info font-bold">Les différents documents : </a> 
        <ul> 
          <li>Demande manuscrite</li>
          <li>Curriculum Vitae</li>
          <li>Autorisation de participation au concours (Fonctionnaires)</li>
          <li>Carte d'Identité Nationale (Recto-Verso)</li>
          <li>Déclaration sur l'honneur</li>
          <li>Autorisation Exceptionnelle de participation au concours (Condition d'âges)   الترخيص باجتياز المباراة استثناءا من شرط السن بالنسبة للمترشحين غير الموظفين من رئاسة الحكومة برسم السنة الجارية   </li>
          <span class="text-primary">N.B: Autorisation exceptionnelle pour les candidats non fonctionnaires et <ul>
          	<li>l'âge supérieur à 40 ans (Techniciens) </li>
            <li>l'âge supérieur à 45 ans (Administrateurs et Ingénieurs)</li>
          </ul></span>  
        </ul>
      </li>
    </ul>
    
    <h4 class="">Les Professeurs</h4>
    
    
    <ul>
      <li> 
        <a ui-sref="app.docpadiplomes({slug: 'diplomes'})"  class="text-info font-bold">Diplômes </a>
        
        <ul>
          <li>BACCALAURÉAT : Baccalauréat ou un diplôme équivalent.</li>
          <li>LICENCE : Licence ou un diplôme équivalent.</li>
          <li>MASTER : Master ou un diplôme équivalent.</li>
          <li>INGENIRIE : Ingénieur ou un diplôme équivalent.</li>        
          <li>DOCTORAT :  Doctorat ou un diplôme équivalent.</li>

          
        </ul>
        
        
      </li>
      <li> <a ui-sref="app.upload({slug: 'divers'})"  class="text-info font-bold">Les différents documents : </a> 
        <ul> 
          <li>Demande manuscrite</li>
          <li>Curriculum Vitae</li>
          <li>Autorisation de participation au concours (Fonctionnaires)</li>
          <li>Carte d'Identité Nationale (Recto-Verso)</li>
          <li>Déclaration sur l'honneur</li>
          <li>Autorisation Exceptionnelle de participation au concours (Condition d'âges)   الترخيص باجتياز المباراة استثناءا من شرط السن بالنسبة للمترشحين غير الموظفين من رئاسة الحكومة برسم السنة الجارية   </li>
          <span class="text-primary">N.B: Autorisation exceptionnelle pour les candidats non fonctionnaires et <ul>
          	<li>l'âge supérieur à 40 ans (Techniciens) </li>
            <li>l'âge supérieur à 45 ans (Administrateurs et Ingénieurs)</li>
          </ul></span>  
        </ul>
      </li>
      
      
      <li> <a ui-sref="app.docpapublication({slug: 'publication'})"  class="text-info font-bold">Les publications et Communications : </a> 
        <ul> 
          <li>La Thèse</li>
          <li>Les Publications</li>
          <li>Les Communications</li>
        </ul>
      </li>
      <li><a class="text-info font-bold">Attestation de résidanat (Professeurs de médecine).</a></li>
    </ul>
    

    <div id="grunt" class="wrapper"></div>
    <div class="line b-b"></div>
    <h4 class="m-t-xl font-bold">Mes Concours</h4>
    <p>
      Le candidat doit aller dans le volet  <a ui-sref="app.mes-concours"  class="text-info font-bold">Mes Concours</a> pour postuler à un ou plusieurs concours correspondant a son profil.
    </p>
    
    

    <div id="dev-server" class="wrapper"></div>
    <div class="line b-b"></div>
    <h4 class="m-t-xl font-bold">Mes Candidatures</h4>
    <p>
      Le volet <a ui-sref="app.mes-candidatures"  class="text-info font-bold">Mes Candidatures</a> permet aux candidats de suivre son candidatures et l'état d'avancement de son dossier.
    </p>

    <div id="css" class="wrapper"></div>
    <br />
    <br />
    <br />
    <br />
    
    
  </div>
</div>
</div>
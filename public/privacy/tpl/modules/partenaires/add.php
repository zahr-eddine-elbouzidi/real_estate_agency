 

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



<div class="bg-light lter b-b wrapper-md"  >
  <div>
   <h4>Gestion des partenaires</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.partenaires"> Gestion des partenaires</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="PartListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading">
      Partenaires
    </div>
   
           <div class="wrapper-md" >
 
             <form  class="form-horizontal"  >

             <div class="form-group">

             <div class="col-sm-12">
              <button ng-click="savePartenaire()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>

              <a href="#/app/partenaires"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>



               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
               <div class="form-group">
                <label class="col-lg-2 control-label"  >Etablissement</label>
                <div class="col-lg-8">
                 <input id="etablissement" type="text" name="partenaire.etablissement" class="form-control" placeholder="Nom de l'établissement" required="true" ng-model="partenaire.etablissement" />
                 
               </div>
             </div>

             <div class="form-group">
                <label class="col-lg-2 control-label"  >Domaine d'étude</label>
                <div class="col-lg-8">
                 <input id="domaine" type="text"   name="partenaire.domaine" class="form-control" placeholder="Domaine d'étude"  ng-model="partenaire.domaine" />
                 
               </div>
             </div>

              <div class="form-group">
                <label class="col-lg-2 control-label"  >Cycle d'étude</label>
                <div class="col-lg-8">
                 <input id="cycle" type="text"  name="partenaire.cycle" class="form-control" placeholder="Cycle d'étude"   ng-model="partenaire.cycle" />
                 
               </div>
             </div>


             <div class="form-group">
               <label class="col-lg-2 control-label"  >Site web </label>
               <div class="col-lg-8">
                <input id="site_web" type="text"  name="partenaire.siteweb" class="form-control"  placeholder="Site web"   ng-model="partenaire.site_web"  />
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Téléphone </label>
               <div class="col-lg-8">
                <input id="tel" type="text"  name="partenaire.tel" class="form-control"  placeholder="Téléphone"   ng-model="partenaire.tel"  />
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Email </label>
               <div class="col-lg-8">
                <input id="email" type="email"  name="partenaire.email" class="form-control"  placeholder="Adresse mail"   ng-model="partenaire.email"  />
              </div> 
            </div> 
            
            <div class="form-group">
               <label class="col-lg-2 control-label"  >Critères d'admission </label>
               <div class="col-lg-8">
                <textarea id="criteres"  name="partenaire.criteres" class="form-control"  
                placeholder="Critères d'admission"   ng-model="partenaire.criteres"  >
                </textarea>
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Filière d'étude </label>
               <div class="col-lg-8">
                <input id="filiere_etude" type="text"  name="partenaire.filiere_etude" class="form-control"  
                  placeholder="Filière d'étude"   ng-model="partenaire.filiere_etude"  />
              </div> 
            </div> 

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Coordonateur </label>
               <div class="col-lg-8">
                <input id="coordonateur" type="text"  name="partenaire.coordonateur" class="form-control"  
                  placeholder="Coordonateur"   ng-model="partenaire.coordonateur"  />
              </div> 
            </div> 

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Pays </label>
               <div class="col-lg-8">
                <input id="pays" type="text"  name="partenaire.pays" class="form-control"  
                  placeholder="Pays"   ng-model="partenaire.pays"  />
              </div> 
            </div> 

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Frais d'inscription Annuel </label>
               <div class="col-lg-8">
                <input id="pays" type="text"  name="partenaire.frais_inscription_annuel" class="form-control"  
                  placeholder="Frais d'inscription Annuel"   ng-model="partenaire.frais_inscription_annuel"  />
              </div> 
            </div> 

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Frais de traitement du dossier </label>
               <div class="col-lg-8">
                <input id="pays" type="text"  name="partenaire.frais_traitement_dossier" class="form-control"  
                  placeholder="Frais de traitement du dossier"   ng-model="partenaire.frais_traitement_dossier"  />
              </div> 
            </div> 

          
                        
            <input id="created_by" type="hidden"  name="created_by" />
            
            <br />
            <br />
           
         </form>


       </div>
       
       
     </div>
     

   </div>
   
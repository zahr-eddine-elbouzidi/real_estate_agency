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
       <h4 >Gestion des filières</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
        <li><a ui-sref="app.filieres" >Gestion des filières</a></li>
        <li class="active" >Modifier</li>
      </ul>
    </div>


  </div>

  <div class="wrapper-md" ng-controller="FiliereEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" >
      Filières
    </div>
    
    
    
    <form  class="form-horizontal"   >


    <div class="form-group">
             
             
             <div class="col-sm-12">
              <button ng-click="saveChange(filiereEdit.id_filiere)" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-edit"></i>Modifier</button>

              <a href="#/app/filieres"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>


      <div class="form-group">
        <label class="col-lg-2 control-label"  >Etablissements </label>
        <div class="col-lg-8">
         
         <select ng-model="filiereEdit.etablissement_id" class="form-control" ng-options="etablissement.id_etablissement as etablissement.nom_etablissement group by  ('Pays : '+etablissement.pays_etablissement+' | Type : '+etablissement.type_etablissement) for etablissement in etablissements" id="filiereEdit.etablissement_id" name="filiereEdit.etablissement_id" required>
          <option required="true">---</option>
        </select>   
      </div>
    </div>



    <div class="form-group">

     <label class="col-lg-2 control-label"  >Nom de la filière</label>

     <div class="col-lg-8">
       <input   type="text" id="nom_filiere"   class="form-control" ng-model="filiereEdit.nom_filiere" placeholder="Nom de la filière" required  />
     </div> 

   </div> 
 
   


 

</form>





</div>

</div>

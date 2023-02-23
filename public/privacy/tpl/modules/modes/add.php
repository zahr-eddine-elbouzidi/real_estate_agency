 

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
   <h4>Gestion des modes de paiement</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
     <li class="active" >Ajouter</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="ModeListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading" >
      Mode de paiement
    </div>
 
            
           
           <div class="wrapper-md" >

             
             
             
             
             <form  class="form-horizontal" ng-submit="saveMode()" >


               
               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
               <div class="form-group">
                <label class="col-lg-2 control-label"  >Mode de paiement</label>
                <div class="col-lg-8">
                 <input id="nom" type="text" name="mode.nom_mode" class="form-control"  required="true" ng-model="mode.nom_mode" />
                 
               </div>
             </div>

 
 


               
            <input id="created_by" type="hidden"  name="created_by" />
             
            <br />
            <br />
            <div class="form-group">
             
              <label class="col-lg-2 control-label"   ></label>
              <div class="col-sm-4">
               <input type="submit"  class="btn btn-info" value="Ajouter" />
               <a href="#/app/modes-paiements" class="btn btn-default">Annuler</a>
             </div>
           </div>
         </form>


       </div>
       
       
     </div>
     

   </div>
   
 

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
   <h4>Gestion des sessions</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
     <li class="active" >Ajouter</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="SessListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading" >
      Session
    </div>
    <p>
        <!--<button type="button" class="btn btn-success" 
                ng-click="addCategory()">
               <b class="icon-plus-sign"></b>Add Category
             </button>-->

           </p>
           
           
           <center> <a ng-if="message_already != '' && message_already != null"   ng-click="activerSession();" class="btn btn-danger btn-lg"><span class="text-white">{{message_already}}</span></a></center>
           
           
           <div class="wrapper-md" >

             
             
             
             
             <form  class="form-horizontal" ng-submit="saveSession()" >


               
               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
               <div class="form-group">
                <label class="col-lg-2 control-label"  >Session</label>
                <div class="col-lg-8">
                 <input id="nom" type="date" name="session.session_date" class="form-control"  required="true" ng-model="session.session_date" />
                 
               </div>
             </div>

   
              <div class="form-group">
                <label class="col-lg-2 control-label"  >Date Limite</label>
                <div class="col-lg-8">
                 <input id="nom" type="date" name="session.sessionn_end" class="form-control"  required="true" ng-model="session.session_end" />
                 
               </div>
             </div>
 


               
            <input id="created_by" type="hidden"  name="created_by" />
            <input id="is_deleted" type="hidden"  name="is_deleted" />
            
            <br />
            <br />
            <div class="form-group">
             
              <label class="col-lg-2 control-label"   ></label>
              <div class="col-sm-4">
               <input type="submit"  class="btn btn-info" value="Ajouter" />
               <a href="#/app/sessions" class="btn btn-default">Annuler</a>
             </div>
           </div>
         </form>


       </div>
       
       
     </div>
     

   </div>
   
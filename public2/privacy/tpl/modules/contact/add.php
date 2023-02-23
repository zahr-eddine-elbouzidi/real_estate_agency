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
   <h4>Contact</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active" >Contact</li>
  </ul>
</div>


</div>



<div class="wrapper-md" ng-controller="ContactCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->
  <div class="panel panel-default">

    <div class="wrapper-md" >

     
     
     
     
     <form  class="form-horizontal" ng-submit="saveContact()" >


       <div class="form-group">
        <label class="col-lg-2 control-label"  >Nom d'Entreprise</label>
        <div class="col-lg-8">
         <input  type="text" name="contact.name" class="form-control"  required="true" ng-model="contact.name" />
         
       </div>
     </div>
     
     <div class="form-group">
      <label class="col-lg-2 control-label"  >Tél</label>
      <div class="col-lg-8">
       <input  type="text" name="contact.tel" class="form-control"  required="true" ng-model="contact.tel" />
       
     </div>
   </div>

   
   <div class="form-group">
    <label class="col-lg-2 control-label"  >GSM</label>
    <div class="col-lg-8">
     <input  type="text" name="contact.gsm" class="form-control"  required="true" ng-model="contact.gsm" />
     
   </div>
 </div>

 <div class="form-group">
    <label class="col-lg-2 control-label"  >Site web</label>
    <div class="col-lg-8">
     <input  type="text" name="contact.website" class="form-control"  required="true" ng-model="contact.website" />
     
   </div>
 </div>
 
 
 <div class="form-group">
  <label class="col-lg-2 control-label"  >Email</label>
  <div class="col-lg-8">
   <input  type="email" name="contact.email" class="form-control"  required="true" ng-model="contact.email" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Facebook URL</label>
  <div class="col-lg-8">
   <input  type="facebook_url" name="contact.facebook_url" class="form-control"    ng-model="contact.facebook_url" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Instagram URL</label>
  <div class="col-lg-8">
   <input  type="text" name="contact.instagram_url" class="form-control"    ng-model="contact.instagram_url" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >LinkedIn URL</label>
  <div class="col-lg-8">
   <input  type="text" name="contact.linkedin_url" class="form-control"    ng-model="contact.linkedin_url" />
   
 </div>
</div>

<div class="form-group">
  <label class="col-lg-2 control-label"  >Tiktok URL</label>
  <div class="col-lg-8">
   <input  type="text" name="contact.tiktok_url" class="form-control"    ng-model="contact.tiktok_url" />
   
 </div>
</div>



<div class="form-group">
  <label class="col-lg-2 control-label"  >Adresse</label>
  <div class="col-lg-8">
    
    <textarea class="form-control" ng-model="contact.address" required="true" col="20" row="10">
      
    </textarea>
    
    
  </div>
</div>





<div class="form-group">
 
  <label class="col-lg-2 control-label"   ></label>
  <div class="col-sm-4">
   <input type="submit"  class="btn btn-success" value="Valider" />
   <a href="#/app/contact" class="btn btn-default">Annuler</a>
 </div>
</div>

</form>


</div>



</div>

</div>

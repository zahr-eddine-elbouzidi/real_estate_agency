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
     <h4 translate="categorie.titles.SUPTITLECAT">Gestion des catégories</h4>
     <ul class="breadcrumb bg-white b-a">
      <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
      <li><a ui-sref="app.categorie"> Gestion des catégories</a></li>
      <li class="active">Modifier</li>
    </ul>
  </div>


</div>

<div class="wrapper-md" ng-controller="CatEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" translate="categorie.titles.CAT">
      Catégories
    </div>
    
    <form  class="form-horizontal" ng-submit="saveChange(categoryEdit.id)" >
      
     
     <!-- BEGIN FILE UPLOAD TRAITEMENT -->
     

     
     <div class="form-group">

<div class="col-sm-12">
 <button ng-click="saveChange(categoryEdit.id)" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-edit"></i> Modifier</button>

 <a href="#/app/categorie"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>

</div>
</div>
     
     
     
    <div class="form-group">

      <label class="col-lg-2 control-label"  >Catégorie en (Français)</label>
      <div class="col-lg-8"  >
            <input   type="text" id="sub_name"   class="form-control" ng-model="categoryEdit.name_fr" 
                  placeholder="{{'categorie.titles.NAMECAT' | translate}}" required="true"   />
      </div> 

   </div>

   <div class="form-group">

<label class="col-lg-2 control-label"  >Catégorie (Englais)</label>
<div class="col-lg-8"  >
 <input   type="text" id="name_eng"   class="form-control" ng-model="categoryEdit.name_eng"   />
</div> 

</div>


   <div class="form-group">

      <label class="col-lg-2 control-label">Catégorie en (Arabe)</label>
      <div class="col-lg-8"  >
       <input   type="text" id="name_ar" style="text-align: right;"  class="form-control" ng-model="categoryEdit.name_ar"   />
     </div> 

   </div>
   <div class="form-group" > 

    <label class="col-lg-2 control-label" >Classement de catégorie</label>

    <div class="col-lg-8">
      
      <input   type="text"  id="level_cat"  class="form-control"  ng-model="categoryEdit.level_cat"  placeholder=""   />
    </div> 
  </div>

  <div class="form-group" > 

<label class="col-lg-2 control-label" >Active ?</label>

<div class="col-lg-8">
  
  <input   type="checkbox"  id="enabled"  class="form-control"  ng-model="categoryEdit.enabled"  placeholder=""   />
</div> 
</div>
  
  <input id="filename" type="hidden"  name="filename" />
  
  <input id="created_by" type="hidden"  name="created_by" />
  
  <div class="form-group">
   <label class="col-lg-2 control-label" ></label>
   <div class="col-lg-8">
     <input type="submit"  class="btn btn-info" value="Modifier" />
     <a href="#/app/categorie" class="btn btn-default">Annuler</a>
   </div>
 </div>
</form>




</div>

</div>

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
       <h4 >Gestion des sous catégories</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
        <li><a ui-sref="app.categorie">Catégories</a></li>
        <li><a ui-sref="app.type" >Gestion des sous-catégories</a></li>
        <li class="active" >Modifier</li>
      </ul>
    </div>


  </div>

  <div class="wrapper-md" ng-controller="SubCatEditCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->


  <div class="panel panel-default">



    <div class="panel-heading" >
      Sous catégories
    </div>
    
    
    
    <form  class="form-horizontal"   >


    <div class="form-group">
             
             
             <div class="col-sm-12">
              <button ng-click="saveChange(subCategoryEdit.id_subcat)" class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-edit"></i>Modifier</button>

              <a href="#/app/type"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>


      <div class="form-group">
        <label class="col-lg-2 control-label"  >Catégories </label>
        <div class="col-lg-8">
         
         <select ng-model="subCategoryEdit.categorie_id" class="form-control" ng-options="category.id as category.name_fr for category in categories" id="subCategoryEdit.categorie_id" name="subCategoryEdit.categorie_id" required>
          <option required="true">---</option>
        </select>   
      </div>
    </div>



    <div class="form-group">

     <label class="col-lg-2 control-label"  >Sous catégorie (FR)</label>

     <div class="col-lg-8">
       <input   type="text" id="sub_name_fr"   class="form-control" ng-model="subCategoryEdit.sub_name_fr" placeholder="{{'type.titles.NAMETYPE' | translate}}" required  />
     </div> 

   </div> 

   <div class="form-group">

<label class="col-lg-2 control-label"  >Sous catégorie (Eng)</label>

<div class="col-lg-8">
  <input   type="text" id="sub_name_eng"   class="form-control" ng-model="subCategoryEdit.sub_name_eng" placeholder="{{'type.titles.NAMETYPE' | translate}}" required  />
</div> 

</div> 

   <div class="form-group">

     <label class="col-lg-2 control-label"  >Nom (Arabe)</label>

     <div class="col-lg-8">
      
       <input   type="text" id="sub_name_ar" style="text-align: right;"  class="form-control" ng-model="subCategoryEdit.sub_name_ar"   required  />
     </div> 

   </div> 


   <div class="form-group">
               <label class="col-lg-2 control-label"  >Classement de sous catégorie</label>
               <div class="col-lg-8">
                <input id="subCategoryEdit" type="text"  name="subCategoryEdit.sub_level" class="form-control"  placeholder="Classement"   ng-model="subCategoryEdit.sub_level"  />
              </div> 
    </div>

    <div class="form-group">
               <label class="col-lg-2 control-label"  >Active ?</label>
               <div class="col-lg-8">
                <input type="checkbox" ng-model="subCategoryEdit.sub_enabled" class="form-control checkbox-xs" />
              </div> 
     </div>
 
 


 

</form>





</div>

</div>

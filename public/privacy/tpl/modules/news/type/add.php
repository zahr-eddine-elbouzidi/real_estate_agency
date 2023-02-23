  

<div class="bg-light lter b-b wrapper-md"  >
 <div>
   <h4 translate="type.titles.SUPTITLETYPE">Gestion des sous-catégories</h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.categorie" >Catégories</a></li>
    <li><a ui-sref="app.type" >Gestion des sous catégories</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>
</div>

<div class="wrapper-md" ng-controller="SubCategoryListCtrl">
 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">

         

          <div class="panel-heading" >
            Sous catégories
          </div>
     
    
           <form  class="form-horizontal"   >
           <div class="form-group">
             
             
             <div class="col-sm-12">
              <button ng-click="saveType()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>

              <a href="#/app/type"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>




             <div class="form-group">
              <label class="col-lg-2 control-label" >Catégorie </label>
              <div class="col-lg-8">
               
               <select ng-model="type.categorie_id" class="form-control" 
                  ng-options="category.id as category.name_fr for category in categories" 
                  id="type.categorie_id" name="type.categorie_id" required>
                <option required="true">---</option>
              </select>   
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-2 control-label" >Nom en (FR)</label>
            <div class="col-lg-8">
             
              <input id="sub_name_fr" type="text" name="type.sub_name_fr" class="form-control" placeholder="{{'type.titles.NAMETYPE' | translate}}" required ng-model="type.sub_name_fr" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Nom en (Eng)</label>
            <div class="col-lg-8">
             
              <input id="sub_name_eng" type="text" name="type.sub_name_eng" class="form-control" placeholder="{{'type.titles.NAMETYPE' | translate}}" required ng-model="type.sub_name_eng" />

            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-2 control-label" >Nom (Arabe)</label>
            <div class="col-lg-8">
             
              <input id="sub_name_ar" type="text" name="type.sub_name_ar" style="text-align: right;" class="form-control" required ng-model="type.sub_name_ar" />

            </div>
          </div>


          <div class="form-group">
               <label class="col-lg-2 control-label"  >Classement de sous catégorie</label>
               <div class="col-lg-8">
                <input id="sub_level" type="number"  name="type.sub_level" class="form-control"  placeholder="Classement"   ng-model="type.sub_level"  />
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Active ?</label>
               <div class="col-lg-8">
                <input type="checkbox" ng-model="type.sub_enabled" class="form-control checkbox-xs" />
              </div> 
            </div>

        
        
      </form>

      <!-- BEGIN PROGRAM -->


      <!-- END PROGRAM -->

      
    </div>

  </div>

  
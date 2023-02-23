 

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
    <li><a ui-sref="app.dashboard-v1" ><i class="fa fa-home"></i> Accueil</a></li>
    <li><a ui-sref="app.categorie"> Gestion des catégories</a></li>
    <li class="active" >Ajouter</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="CatListCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading" translate="categorie.titles.CAT">
      Catégories
    </div>
   
           <div class="wrapper-md" >
 
             <form  class="form-horizontal"  >

             <div class="form-group">

             <div class="col-sm-12">
              <button ng-click="saveCategorie()" class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-plus"></i>Ajouter</button>

              <a href="#/app/categorie"  class="btn m-b-xs btn-sm btn-default btn-addon pull-right"><i class="fa fa-mail-reply"></i> Annuler</a>
             
            </div>
          </div>



               <!-- BEGIN FILE UPLOAD TRAITEMENT -->
               <div class="form-group">
                <label class="col-lg-2 control-label"   translate="categorie.titles.NAMECAT">Nom de catégorie (En Français)</label>
                <div class="col-lg-8">
                 <input id="name_fr" type="text" name="cat.name_fr" class="form-control" placeholder="{{'categorie.titles.NAMECAT' | translate}}" required="true" ng-model="cat.name_fr" />
                 
               </div>
             </div>

             <div class="form-group">
                <label class="col-lg-2 control-label"  >Nom de catégorie (en Englais)</label>
                <div class="col-lg-8">
                 <input id="name_eng" type="text"   name="cat.name_eng" class="form-control" placeholder="Name here (Champs Optionnel)"  ng-model="cat.name_eng" />
                 
               </div>
             </div>

              <div class="form-group">
                <label class="col-lg-2 control-label"  >Nom de catégorie (en Arabe)</label>
                <div class="col-lg-8">
                 <input id="name_ar" type="text" style="text-align: right;" name="cat.name_ar" class="form-control" placeholder="الصنف"   ng-model="cat.name_ar" />
                 
               </div>
             </div>


             <div class="form-group">
               <label class="col-lg-2 control-label"  >Classement de catégorie</label>
               <div class="col-lg-8">
                <input id="level_cat" type="number"  name="cat.level_cat" class="form-control"  placeholder="Classement"   ng-model="cat.level_cat"  />
              </div> 
            </div>

            <div class="form-group">
               <label class="col-lg-2 control-label"  >Active ?</label>
               <div class="col-lg-8">
                <input type="checkbox" ng-model="cat.enabled" class="form-control checkbox-xs" />
              </div> 
            </div>
                        
            <input id="created_by" type="hidden"  name="created_by" />
            
            <br />
            <br />
           
         </form>


       </div>
       
       
     </div>
     

   </div>
   
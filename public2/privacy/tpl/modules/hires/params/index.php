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
       <h4 >Paramètres</h4>
       <ul class="breadcrumb bg-white b-a">
        <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
        <li class="active">Configuration</li>
      </ul>
    </div>


  </div>

  <div class="wrapper-md" ng-controller="ParamsCtrl">

 <!--<toaster-container
  toaster-options="{ 'toaster-id': 'note-toaster-container', 'close-button': true, 'position-class': 'toast-top-center' }"></toaster-container>-->

  <div class="panel panel-default">



    <div class="panel-heading"  >
      Paramètres
    </div>
    <p>
        <!--<button type="button" class="btn btn-success" 
                ng-click="addCategory()">
               <b class="icon-plus-sign"></b>Add Category
             </button>-->

           </p>
           
           

           
           
           <div class="wrapper-md" >

             
             
             
             
             <form  class="form-horizontal"  >


              <div class="form-group">
                <label class="i-switch m-t-xs m-r">
                  <input type="checkbox"  ng-model="params.isAdministratif"   ng-click="saveParam()">
                  <i></i>
                </label>
                <label class="col-sm-6 control-label">Activer/Désactiver les Administratifs et Techniques</label>
                
              </div>

              <div class="form-group">
                <label class="i-switch m-t-xs m-r">
                  <input type="checkbox"  ng-model="params.isProf"   ng-click="saveParam()">
                  <i></i>
                </label>
                <label class="col-sm-6 control-label">Activer/Désactiver les PESA </label>
                
              </div>
              
              <div class="form-group">
                <label class="i-switch m-t-xs m-r">
                  <input type="checkbox"  ng-model="params.isProfM"   ng-click="saveParam()">
                  <i></i>
                </label>
                <label class="col-sm-6 control-label">Activer/Désactiver les PESA Médecine</label>
                
              </div>
             
             <div class="form-group">
                <label class="i-switch m-t-xs m-r">
                  <input type="checkbox"  ng-model="params.display_motif"   ng-click="saveParam()">
                  <i></i>
                </label>
                <label class="col-sm-6 control-label">Afficher le motif de rejets</label>
                
              </div>



             

              <div class="form-group">
            <label class="col-lg-6 control-label" >Max upload file PA</label>
            <div class="col-lg-2">
             
              <input id="nom" type="text" name="params.max_upload_file_pa"  class="form-control"  required ng-model="params.max_upload_file_pa" />

            </div>
          </div>

              


          <div class="form-group">
            <label class="col-lg-6 control-label" >Max upload file Administratif</label>
            <div class="col-lg-2">
             
              <input id="nom" type="text" name="params.max_upload_file_admin"  class="form-control"  required ng-model="params.max_upload_file_admin" />

            </div>
          </div>
              
              
              
              <input id="created_by" type="hidden"  name="created_by" />
              <input id="id" type="hidden"  name="id" />
              
              <div class="form-group">
           <label class="col-lg-2 control-label"   ></label>
           <div class="col-sm-4">
            <div class="form-actions">      
              <input type="submit"  value="Valider" class="btn btn-primary" ng-click="saveParam();"/>
             </div>
          </div>  
        </div>
              
            </div>
            

          </div>
          
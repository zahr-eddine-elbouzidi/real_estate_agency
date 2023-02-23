<toaster-container toaster-options="{'position-class': 'toast-top-right', 'close-button':true}"></toaster-container>


<div class="bg-light lter b-b wrapper-md"  >
  <div>
   <h4>Sauvegarde.<i class="icon-cloud-download"></i></h4>
   <ul class="breadcrumb bg-white b-a">
    <li><a ui-sref="app.dashboard-v1"><i class="fa fa-home"></i> Accueil</a></li>
    <li class="active">Sauvegarde</li>
  </ul>
</div>


</div>

<div class="wrapper-md" ng-controller="BackupCtrl">


  <div class="panel panel-default">



    <div class="panel-heading">
      Backup
    </div>
    <p>
        <!--<button type="button" class="btn btn-success" 
                ng-click="addCategory()">
               <b class="icon-plus-sign"></b>Add Category
             </button>-->

           </p>
           <div class="table-responsive">

            <form method="post">
              
              <button ng-click="backup()">Backup</button>
            </form>
            

            
            <!-- Trigger the modal with a button -->
            
            <!-- Modal pour l'edition des information-->

            
            <!--fin modal d'edition des information -->
          </div>
        </div>

      </div>
      
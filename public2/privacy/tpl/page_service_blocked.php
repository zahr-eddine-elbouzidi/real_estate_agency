 <div class="container w-xxl w-auto-xs" ng-init="app.settings.container = false;">
  <div class="text-center m-b-lg">
    <h1 class="text-shadow text-white">404</h1>
  </div>

   <div class="list-group bg-info auto m-b-sm m-b-lg">
    <h5 class="list-group-item text-center">Ressource introuvable</h5>
    <a ui-sref="app.dashboard-v1" class="list-group-item">
       <i class="fa fa-fw fa-mail-forward m-r-xs"></i>Les modules que vous avez choisis sont inaccessible pour le moment.
    </a>
    
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'"></div>
</div>
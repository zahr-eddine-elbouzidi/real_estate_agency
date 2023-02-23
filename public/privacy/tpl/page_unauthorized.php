 <div class="container w-xxl w-auto-xs" ng-init="app.settings.container = false;">
  <div class="text-center m-b-lg">
    <h1 class="text-shadow text-white">401</h1>
  </div>

   <div class="list-group bg-danger auto m-b-sm m-b-lg">
    <h5 class="list-group-item text-center">Accès refusé.</h5>
    <a ui-sref="app.dashboard-v1" class="list-group-item">
       <i class="fa fa-fw fa-mail-forward m-r-xs"></i> Vous n'avez pas l'autorisation, Espace réservé à l'administrateur.
    </a>
    
  </div>
  <div class="text-center" ng-include="'tpl/blocks/page_footer.html'"></div>
</div>
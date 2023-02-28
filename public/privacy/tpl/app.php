  <!-- navbar -->
  <div data-ng-include=" 'tpl/blocks/header.php' " class="app-header navbar">
  </div>
  <!-- / navbar -->

  <!-- menu -->
  <div data-ng-include=" 'tpl/blocks/aside.php' " class="app-aside hidden-xs {{app.settings.asideColor}}">
  </div>
  <!-- / menu -->

  <!-- content -->
  <div class="app-content" >
    <div ui-butterbar></div>
    <a href class="off-screen-toggle hide" ui-toggle-class="off-screen" data-target=".app-aside" ></a>
    <div class="app-content-body fade-in-up" ui-view></div>
  </div>
  <!-- /content -->

  <!-- aside right -->
  <div class="app-aside-right pos-fix no-padder w-md w-auto-xs bg-white b-l animated fadeInRight hide">
    <div class="vbox">
     
     
     
    </div>
  </div>
  <!-- / aside right -->

  <!-- footer -->
  <div class="app-footer wrapper b-t bg-light">
    <span class="pull-right">{{app.version}} <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
    <span><small class="text-muted">Student Housing | Real Estate Agency</span><br><span> Tous droits réservés.</span> &copy; <?php echo date('Y'); ?> <br><span><small class="text-muted">Version {{app.version}}</small></span></small></span>
  </div>
  <!-- / footer -->

  <div data-ng-include=" 'tpl/blocks/settings.php' " class="settings panel panel-default">
  </div>
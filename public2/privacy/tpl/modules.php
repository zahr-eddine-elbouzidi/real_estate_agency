<div class="bg-light lter b-b wrapper-md hidden-print">
  <h1 class="m-n font-thin h3">Modules</h1>
  <blockquote>
    <input type="text" ng-model="search"  class="form-control input-sm bg-white rounded padder" placeholder="Rechercher...">         
  </blockquote>
</div>
<div class="wrapper-md" ng-controller="ModulesCtrl" >  
  <div class="row row-sm">
    <div class="col-sm-3" ng-repeat="module in modules.slice(((currentPage-1)*itemsPerPage), ((currentPage)*itemsPerPage)) | filter: search | orderBy:sortType:sortReverse">
      <div class="panel b-a"> 
        <div class="panel-heading wrapper-xs no-border" style="  color: #f4f3f9;
        background-color: {{ module.module_color }};">  
        
        <h2 class="m-t-none text-right">
          <h4 class="text-u-c m-b-none">{{module.module_name}}</h4>  
          <span class="text-xs"></span>
        </h2>   
      </div>
      <div class="wrapper text-left ">

       <h5 class="text m-b-none" style="color: gray;" >{{module.module_content | limitTo: 25 }}...</h5>    
     </div>
     <form method="post">

      <div class="panel-footer">
        <button type="submit"  ng-click="installModule(module.module_id)" class="btn btn-primary btn-xs font-bold"  style="color: #f4f3f9;background-color: {{ module.module_color }};" 
        ui-toggle-class="show inline" target="#{{module.module_name}}"
        ng-disabled="{{module.module_payed}}"><i ng-show="{{module.module_payed}}" class="fa  fa-check"></i><span ng-hide="{{module.module_payed}}" translate="header.params.INSTALL">Install  </span><span ng-show="{{module.module_payed}}" translate="header.params.INSTALLED">Installed </span>
        <i class="fa fa-spin fa-spinner hide" id="{{module.module_name}}"></i>
      </button>
      <button style="float: right;" type="submit" class="btn btn-default btn-xs" popover-trigger="mouseenter" popover-placement="bottom" popover="{{module.module_content}}"><i class="icon icon-info "></i> En savoir plus</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
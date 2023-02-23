<div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
app.settings.asideFolded = false; 
app.settings.asideDock = true;
"   ng-controller="FlotChartDemoCtrl" ng-init="refreshData();">
<!-- main -->
<div class="col">
  <!-- main header -->
  <div class="bg-light lter b-b wrapper-md">
    <div class="row">
      <div class="col-sm-6 col-xs-12">
        <h1 class="m-n font-thin h3 text-black" >Administration</h1>
        <small class="h5 text-muted" >Statistique <?php echo date('Y'); ?></small>

      </div>
      <div class="col-sm-6 text-right hidden-xs">
       <button class="btn btn-primary btn-xs" ng-click="refreshData();"><i class="icon icon-refresh"></i> Actualiser</button>
      

       <p></p>
     </div>
   </div>
 </div>
 <!-- / main header -->
 <div class="wrapper-md" >
 
  <!-- stats -->
  <div class="row">
    <div class="col-md-5">
      <div class="row row-sm text-center">
        <div class="col-xs-6">
          <div class="panel padder-v item">
            <div class="h1 text-info font-thin h1">{{ nbre_total_formation }}</div>
            <span class="text-muted text-xs" >Formations</span>
            <div class="top text-right w-full">
              <i class="fa fa-caret-down text-warning m-r-sm"></i>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <a href class="block panel padder-v bg-primary item">
            <span class="text-white font-thin h1 block">{{ nbre_candidat }}</span>
            <span class="text-muted text-xs" >Nombre de candidats inscrits</span>
            <span class="bottom text-right w-full">
              <i class="fa fa-cloud-upload text-muted m-r-sm"></i>
            </span>
          </a>
        </div>
        <div class="col-xs-12">
          <a ui-sref="app.categorie" class="block panel padder-v bg-info item">
            <span class="text-white font-thin h1 block">1 </span>
            <span class="text-muted text-xs">Module ITISDE </span>
            <span class="top text-left">
              <i class="fa fa-caret-up text-warning m-l-sm"></i>
            </span>
          </a>
        </div>
            <!--<div class="col-xs-6">
               <a ui-sref="app.niveau" ><div class="panel padder-v item">
                <div class="font-thin h1">Eco</div>
                <span class="text-muted text-xs">Module</span>
                <div class="bottom text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </div>
              </div></a>
            </div>-->
            <div class="col-xs-12 m-b-md">
              <div class="r bg-light dker item hbox no-border">
                <div class="col w-xs v-middle hidden-md">
                  <div ng-init="data1=[60,40]" ui-jq="sparkline" ui-options="{{data1}}, {type:'pie', height:40, sliceColors:['{{app.color.warning}}','#fff']}" class="sparkline inline"></div>
                </div>
                <div class="col dk padder-v r-r">
                  <div class="text-primary-dk font-thin h1"><span>{{nbre_users}}</span></div>
                  <span class="text-muted text-xs" >Utilisateurs Inscrits</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="panel wrapper">
            <label class="i-switch bg-warning pull-right" ng-init="showSpline=true">
              <input type="checkbox" ng-model="showSpline">
              <i></i>
            </label>
            <h4 class="font-thin m-t-none m-b text-muted">Répartition des inscrits par mois</h4>
            <div class="panel-body" >
              <div ng-if="datamonths != null" ui-jq="plot"  ui-options="
              [
              { data: {{datamonths}}, points: { show: true, radius:3 },lines: { show: true, fill: true, fillColor: { colors: [{ opacity: 0.1 }, { opacity: 0.1}] } }  }
              ], 
              {
                colors: ['{{app.color.info}}'],
                series: { shadowSize: 3 },
                xaxis:{ 
                  font: { color: '#a1a7ac' },
                  position: 'bottom',
                  ticks: [
                    [ 1, 'Janvier' ], [ 2, 'Février' ], [ 3, 'Mars' ], [ 4, 'Avril' ], [ 5, 'Mai' ], [ 6, 'Juin' ], [ 7, 'Juillet' ], [ 8, 'Août' ], [ 9, 'Septembre' ], [ 10, 'Octobre' ], [ 11, 'Novembre' ], [ 12, 'Décembre' ]
                  ]
              },
              grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#dce5ec' },
              tooltip: true,
              tooltipOpts: { content: 'Nombre des inscrits est %y',  defaultTheme: false, shifts: { x: 0, y: 20 } }
              
            }
            " style="height:240px" >
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <!-- / stats -->

  <!-- service -->
  
  <!-- / service -->

  <!-- tasks -->
  <div class="panel wrapper">
    <div class="row">
      <div class="col-md-4 b-r b-light no-border-xs"  >
        <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
        <h4 class="font-thin m-t-none m-b-md text-muted" > Répartition des inscrits par Google Search</h4>
        <div ng-if="datac != null" ui-jq="plot" ui-options="
        {{datac}},
        {
          series: { pie: { show: true, innerRadius: 0.4, stroke: { width: 0 }, label: { show: true, threshold: 0.06 } } },
          colors: ['#ddd','{{app.color.warning}}','{{app.color.danger}}','{{app.color.primary}}','{{app.color.info}}'],
          grid: { hoverable: true, clickable: true, borderWidth: 1, color: '#ccc' },   
          tooltip: true,
          tooltipOpts: { content: '%s: %p.0%',defaultTheme: false}
        }
        " style="height:300px"></div>
      </div>
      <div class="col-md-4 b-r b-light no-border-xs"  >
        <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
        <h4 class="font-thin m-t-none m-b-md text-muted" >Répartition des inscrits par Device</h4>
        <div ng-if="datasc != null" ui-jq="plot" ui-options="
        {{datasc}},
        {
          series: { pie: { show: true, innerRadius: 0.2, stroke: { width: 1 }, label: { show: true, threshold: 0.01 } } },
          colors: ['{{app.color.primary}}','{{app.color.info}}','{{app.color.warning}}','{{app.color.danger}}','{{app.color.success}}'],
          grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
          tooltip: true,
          tooltipOpts: { content: '%s: %p.0%' ,defaultTheme: false}
        }
        " style="height:300px"></div>
      </div>  


      <div class="col-md-4 b-r b-light no-border-xs"  >
        <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
        <h4 class="font-thin m-t-none m-b-md text-muted" >Répartition des inscrits par Pays</h4>
        <div ng-if="datacountry != null" ui-jq="plot" ui-options="
        {{datacountry}},
        {
          series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 1 }, label: { show: true, threshold: 0.04 } } },
          colors: ['{{app.color.primary}}','{{app.color.info}}','{{app.color.success}}','{{app.color.warning}}','{{app.color.danger}}'],
          grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#ccc' },   
          tooltip: true,
          tooltipOpts: { content: '%s: %p.0%' ,defaultTheme: false}
        }
        " style="height:300px"></div>
      </div>  
      
      
    </div>

    
  </div>
  
  <!-- / tasks -->


  <div class="row">
        <div class="col-md-12">
          <div class="panel no-border">
            <div class="panel-heading wrapper b-b b-light">
              <span class="text-xs text-muted pull-right">
                <i class="fa fa-circle text-primary m-r-xs"></i> Google and Other search
                <i class="fa fa-circle text-success m-r-xs m-l-sm"></i> Mobile Or WebSite Device
                <i class="fa fa-circle text-info m-r-xs m-l-sm"></i> BackLink and countries
              </span>
              <h4 class="font-thin m-t-none m-b-none text-muted">Statistiques</h4>              
            </div>
            <ul class="list-group list-group-lg m-b-none">
              <li class="list-group-item" ng-repeat="statistic in datagloab">
                <span class="pull-right label bg-primary inline m-t-sm" ng-if="statistic.label == 'Google search' || statistic.label == 'Other search'">{{statistic.data}} inscrit(s)</span>
                <span class="pull-right label bg-success inline m-t-sm" ng-if="statistic.label == 'Mobile' || statistic.label == 'Web Site'">{{statistic.data}} inscrit(s)</span>
                <span class="pull-right label bg-info inline m-t-sm" ng-if="statistic.label != 'Google search' && statistic.label != 'Other search' && statistic.label != 'Mobile' && statistic.label != 'Web Site'">{{statistic.data}} inscrit(s)</span>
                <a href>{{statistic.label}}</a>
              </li>
           
       
            </ul>
            <!--<div class="panel-footer">
        
            </div>-->
          </div>
        </div>
        </div>
     
  

  <!-- tasks -->
  
  <!-- / tasks -->
</div>
</div>
<!-- / main -->
<!-- right col -->

<!-- / right col -->
</div>
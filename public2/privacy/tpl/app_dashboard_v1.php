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
            <div class="h1 text-info font-thin h1">{{ nbre_total }}</div>
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
            <span class="text-muted text-xs">Module IEW </span>
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
              { data: {{datamonths}}, points: { show: true, radius: 2}, splines: { show: showSpline, tension: 0.4, lineWidth: 1, fill: 0.04 } }
              ], 
              {
                colors: ['{{app.color.info}}'],
                series: { shadowSize: 1 },
                xaxis:{ 
                font: { color: '#ccc' },
                position: 'bottom',
                ticks: [
                [ 1, 'Jan' ], [ 2, 'Fév' ], [ 3, 'Mar' ], [ 4, 'Avr' ], [ 5, 'Mai' ], [ 6, 'Jui' ], [ 7, 'Juil' ], [ 8, 'Aoû' ], [ 9, 'Sep' ], [ 10, 'Oct' ], [ 11, 'Nov' ], [ 12, 'Dec' ]
                ]
              },
              series: { shadowSize: 5 },
              
              yaxis:{ font: { color: '#a1a7ac' }},
              grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#dce5ec' },
              tooltip: true,
              tooltipOpts: { content: 'Nombre du concours est %y',  defaultTheme: false, shifts: { x: 10, y: -25 } }
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
      <div class="col-md-6 b-r b-light no-border-xs"  >
        <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
        <h4 class="font-thin m-t-none m-b-md text-muted" > Répartition des inscrits par formation</h4>
        <div ng-if="datac != null" ui-jq="plot" ui-options="
        {{datac}},
        {
          series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 0 }, label: { show: true, threshold: 0.06 } } },
          colors: ['{{app.color.primary}}','{{app.color.info}}','{{app.color.success}}','{{app.color.warning}}','{{app.color.danger}}'],
          grid: { hoverable: true, clickable: true, borderWidth: 3, color: '#ccc' },   
          tooltip: true,
          tooltipOpts: { content: '%s: %p.0%',defaultTheme: false}
        }
        " style="height:300px"></div>
      </div>
      <div class="col-md-6 b-r b-light no-border-xs"  >
        <a href class="text-muted pull-right text-lg"><i class="icon-arrow-right"></i></a>
        <h4 class="font-thin m-t-none m-b-md text-muted" >Répartition des inscrits ...</h4>
        <div ng-if="datasc != null" ui-jq="plot" ui-options="
        {{datasc}},
        {
          series: { pie: { show: true, innerRadius: 0.6, stroke: { width: 3 }, label: { show: true, threshold: 0.05 } } },
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

  

  <!-- tasks -->
  
  <!-- / tasks -->
</div>
</div>
<!-- / main -->
<!-- right col -->

<!-- / right col -->
</div>
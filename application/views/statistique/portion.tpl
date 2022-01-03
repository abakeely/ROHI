{literal}
	<script>
		$(document).ready(function () {
			$('#statistiqueTable').dataTable({ordering:false});
		})
	</script>
{/literal}
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>&nbsp;</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{$zBasePath}assets/common/statistique/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="{$zBasePath}assets/common/statistique/bower_components/Ionicons/css/ionicons.min.css">

  <script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
  <script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="{$zBasePath}assets/common/statistique/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{$zBasePath}assets/common/statistique/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Recherche</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <div class="navbar-custom-menu">
        
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
       
      </div>
	  <ul class="sidebar-menu" data-widget="tree">
        <li {if $zType=='par-departement'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-departement"><i class="la la-pie-chart text-green"></i> <span>Par département</span></a></li>
        <li {if $zType=='par-direction'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-direction"><i class="la la-pie-chart text-blue"></i> <span>Par Direction</span></a></li>
        <li {if $zType=='par-service'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-service"><i class="la la-pie-chart text-red"></i> <span>Par service</span></a></li>
		<li {if $zType=='par-statut'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-statut"><i class="la la-pie-chart text-white"></i> <span>Par statut</span></a></li>
        <li {if $zType=='par-corps'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-corps"><i class="la la-pie-chart text-yellow"></i> <span>Par corps</span></a></li>
        <li {if $zType=='par-grade'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-grade"><i class="la la-pie-chart text-aqua"></i> <span>Par grade</span></a></li>
		<li {if $zType=='par-indice'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-indice"><i class="la la-pie-chart text-red"></i> <span>Par indice</span></a></li>
        <li {if $zType=='par-sexe'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-sexe"><i class="la la-pie-chart text-green"></i> <span>Par sexe</span></a></li>
        <li {if $zType=='par-situation'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-situation"><i class="la la-pie-chart text-orange"></i> <span>Par situation matrimonial</span></a></li>
		<li {if $zType=='par-district'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-district"><i class="la la-pie-chart" style="color:#d517c1 !important"></i> <span>Par district</span></a></li>
        <li {if $zType=='par-region'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-region"><i class="la la-pie-chart" style="color:#c31bff !important"></i> <span>Par région</span></a></li>
        <li {if $zType=='par-province'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-province"><i class="la la-pie-chart" style="color:#11ef09 !important"></i> <span>Par province</span></a></li>
		<li {if $zType=='par-cadre'}class="active"{/if}><a href="{$zBasePath}statistique/statistic_main/par-cadre"><i class="la la-pie-chart" style="color:#c3176a !important"></i> <span>Par cadre</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Les Diagrammes
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Diagramme de surface</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="la la-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Diagramme circulaire</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="la la-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Résultat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="la la-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
			  <div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">Nombre total des agents du MFB inscrit sur ROHI</span>
					  <span class="info-box-number">{$oData.total}</span>
					</div>
			  </div>
              <div class="chart1">
					<table id="statistiqueTable" class="table table-bordered">
						<thead>
							<tr>
							    <th>Ordre</th>
								<th>Libelle</th>
								<th>Nombre</th>
								<th>Pourcentage</th>
							</tr>
						</thead>
						<tbody>
							{if sizeof($oData.data)>0}
							{assign var=iIncrement value="1"}
							{assign var=iTotal value=$oData.total}
							{foreach from=$oData.data item=toData }
							{assign var=iStat value=$toData.nb*100}
							{assign var=iStatPercent value=$iStat/$iTotal}
							<tr>
								<td>{$iIncrement}</td>
								<td style="width:70%!important;">{$toData.libele}</td>
								<td>{$toData.nb}</td>
								<td>{$iStatPercent|number_format:2:",":"."}&nbsp;%</td>
							</tr>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{else}
							<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
							{/if}
						</tbody>
					</table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="la la-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="la la-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- ChartJS -->

<script src="{$zBasePath}assets/common/statistique/bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="{$zBasePath}assets/common/statistique/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{$zBasePath}assets/common/statistique/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{$zBasePath}assets/common/statistique/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{$zBasePath}assets/common/statistique/dist/js/demo.js"></script>
<!-- page script -->
{literal}
<style>
.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
    color: #fff;
    background: #0b4960;
}

#dataTables-example-0_length {
	display:none!important;
}

#statistiqueTable_length {
	display:none!important;
}

.dataTables_filter, .dataTables_info { display: block; }

.dataTables_paginate {
	float:left;
}

.col-sm-6 {
	width:100%!important;
}

</style>
<script>
      
	  $(function () {

		var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

		var areaChart       = new Chart(areaChartCanvas)

		var areaChartData = {
		  labels  : [
		  
			{/literal}{$oData.absisse}{literal}
		  
		  ],
		  datasets: [
			{
			  label               : 'Diagramme',
			  fillColor           : 'rgba(60,141,188,0.9)',
			  strokeColor         : 'rgba(60,141,188,0.8)',
			  pointColor          : '#3b8bba',
			  pointStrokeColor    : 'rgba(60,141,188,1)',
			  pointHighlightFill  : '#fff',
			  pointHighlightStroke: 'rgba(60,141,188,1)',
			  data                : [{/literal}{$oData.ordonnee}{literal}]
			}
		  ]
		}

		var areaChartOptions = {
		  //Boolean - If we should show the scale at all
		  showScale               : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : true,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - Whether the line is curved between points
		  bezierCurve             : true,
		  //Number - Tension of the bezier curve between points
		  bezierCurveTension      : 0.3,
		  //Boolean - Whether to show a dot for each point
		  pointDot                : true,
		  //Number - Radius of each point dot in pixels
		  pointDotRadius          : 4,
		  //Number - Pixel width of point dot stroke
		  pointDotStrokeWidth     : 1,
		  //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
		  pointHitDetectionRadius : 20,
		  //Boolean - Whether to show a stroke for datasets
		  datasetStroke           : true,
		  //Number - Pixel width of dataset stroke
		  datasetStrokeWidth      : 2,
		  //Boolean - Whether to fill the dataset with a color
		  datasetFill             : true,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio     : true,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive              : true
		}

		//Create the line chart
		areaChart.Line(areaChartData, areaChartOptions)

		//-------------
		//- LINE CHART -
		//--------------
	   
		

		//-------------
		//- PIE CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		var pieChart       = new Chart(pieChartCanvas)
		var PieData        = {/literal}{$oData.toJson}{literal}
		var pieOptions     = {
		  //Boolean - Whether we should show a stroke on each segment
		  segmentShowStroke    : true,
		  //String - The colour of each segment stroke
		  segmentStrokeColor   : '#fff',
		  //Number - The width of each segment stroke
		  segmentStrokeWidth   : 2,
		  //Number - The percentage of the chart that we cut out of the middle
		  percentageInnerCutout: 50, // This is 0 for Pie charts
		  //Number - Amount of animation steps
		  animationSteps       : 250,
		  //String - Animation easing effect
		  animationEasing      : 'easeOutBounce',
		  //Boolean - Whether we animate the rotation of the Doughnut
		  animateRotate        : true,
		  //Boolean - Whether we animate scaling the Doughnut from the centre
		  animateScale         : false,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive           : true,
		  // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio  : true,
		  //String - A legend template
		  legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart.Doughnut(PieData, pieOptions)

		//-------------
		//- BAR CHART -
		//-------------
		var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
		var barChart                         = new Chart(barChartCanvas)
		var barChartData                     = areaChartData
		barChartData.datasets[1].fillColor   = '#00a65a'
		barChartData.datasets[1].strokeColor = '#00a65a'
		barChartData.datasets[1].pointColor  = '#00a65a'
		var barChartOptions                  = {
		  //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
		  scaleBeginAtZero        : true,
		  //Boolean - Whether grid lines are shown across the chart
		  scaleShowGridLines      : true,
		  //String - Colour of the grid lines
		  scaleGridLineColor      : 'rgba(0,0,0,.05)',
		  //Number - Width of the grid lines
		  scaleGridLineWidth      : 1,
		  //Boolean - Whether to show horizontal lines (except X axis)
		  scaleShowHorizontalLines: true,
		  //Boolean - Whether to show vertical lines (except Y axis)
		  scaleShowVerticalLines  : true,
		  //Boolean - If there is a stroke on each bar
		  barShowStroke           : true,
		  //Number - Pixel width of the bar stroke
		  barStrokeWidth          : 2,
		  //Number - Spacing between each of the X value sets
		  barValueSpacing         : 5,
		  //Number - Spacing between data sets within X values
		  barDatasetSpacing       : 1,
		  //String - A legend template
		  legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
		  //Boolean - whether to make the chart responsive
		  responsive              : true,
		  maintainAspectRatio     : true
		}

		barChartOptions.datasetFill = false
		barChart.Bar(barChartData, barChartOptions)
	  })
</script>
{/literal}
</body>
</html>

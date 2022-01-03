{include_php file=$zCssJs}
<script src="{$zBasePath}assets/light/assets/js/datedropper-javascript.js"></script>
<script src="{$zBasePath}assets/light/assets/js/datedropper-javascript-lang-FR.js"></script>
<input type="hidden" name="switchBadgePorte" id="switchBadgePorte" value="1">
<input type="hidden" name="isListeNoire" id="isListeNoire" value="0">
<input type="hidden" name="iRechercheId" id="iRechercheId" value="1">
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
								{* <ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Visualisations</li>
								</ul> *}
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="no-skin">
									<div class="main-content-inner1">
									{include_php file=$zTileHeader}
									</div>
									<div class="main-container ace-save-state" id="main-container">
										<script type="text/javascript">
											
										</script>

										

										<div class="main-content">
											<div class="main-content-inner">
												<div class="breadcrumbs ace-save-state" id="breadcrumbs">
													<ul class="breadcrumb">
														<li>
															<i class="ace-icon la la-home home-icon"></i>
															<a href="#">Accueil</a>
														</li>

														<li>
															<a href="#">Gestion des visiteurs</a>
														</li>
														<li class="active">Statistiques</li>
													</ul><!-- /.breadcrumb -->

													<div class="nav-search" id="nav-search">
														<form class="form-search">
															<span class="input-icon">
																<input type="text" placeholder="Recherche ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
																<i class="ace-icon la la-search nav-search-icon"></i>
															</span>
														</form>
													</div><!-- /.nav-search -->
												</div>
												<div class="row">
													<form name="recherche" id="recherche" method="POST" action="{$zBasePath}sau/statistiques/gestion-visiteur/index"> 
														<div class="col-sm-12">
															<h3 class="blue lighter smaller">
																<i class="ace-icon la la-calendar-o smaller-90"></i>
																RECHERCHE PAR DATE
															</h3>
															<div class="">
																<div class="col-xs-3 cellinfo">
																	<div class="input-group input-group-sm">
																		<input type="text" placeholder="Date début" name="zDateDebut" id="zDateDebut" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="12/01/2021" data-dd-opt-double-view="true" value="{$zDateDebut}" class="form-control datedropper-range-fiche obligatoire" />
																		<span class="input-group-addon">
																			<i class="ace-icon la la-calendar"></i>
																		</span>
																	</div>
																</div>
																<div class="col-xs-3 cellinfo">
																	<div class="input-group input-group-sm"> 
																		<input type="text" placeholder="Date fin" name="zDateFin" id="zDateFin" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="12/01/2021" data-dd-opt-double-view="true" value="{$zDateFin}" class="form-control datedropper-range-fiche obligatoire" />
																		<span class="input-group-addon">
																			<i class="ace-icon la la-calendar"></i>
																		</span>
																	</div>
																</div>
																<div class="col-xs-5 cellinfo">
																	<div class="input-group input-group-sm">
																		<button style="width:125px;margin-right:15px!important;" class="btn btn-xs btn-succes submitSearch">
																			Rechercher
																			<i class="ace-icon la la-arrow-right icon-on-right"></i>
																		</button>
																		
																		<button style="width:125px;background-color:green!important;border-color:green!important" class="btn btn-xs btn-succes sumbitRafraichir">
																			Rafraîchir
																			<i class="ace-icon la la-refresh"></i>
																		</button>
																	</div>
																</div>
															</div>
														</div><!-- ./span -->
													</form>
												</div>
												<div style="clear:both"><br/><br/></div>
												<div class="">
													<div class="space-6"></div>
													<div class="vspace-12-sm"></div>

													<div class="col-sm-12">
														<div class="widget-box">
															<div class="widget-header widget-header-flat widget-header-small">
																<h5 class="widget-title">
																	<i class="ace-icon fa"></i>
																	Visite par agent d'accueil {if $oData.zDateDebut != ''} du {$oData.zDateDebut}{/if} {if $oData.zDateFin != ''} au {$oData.zDateFin}{/if}
																</h5>
															</div>

															<div class="widget-body">
																<div class="widget-main">
																	<div id="piechart-placeholder" style="width: 90%; min-height: 250px; padding: 0px; position: relative;">
																		<canvas class="flot-base" width="471" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 471px; height: 150px;"></canvas><canvas class="flot-overlay" width="471" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 471px; height: 250px;"></canvas>
																	
																		<div class="legend">
																			<div style=""> </div>
																			<table style="position:absolute;top:15px;right:-30px;;font-size:smaller;color:#545454">
																				<tbody>
																					<tr>
																						<td>&nbsp;</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</div>

																	<div class="hr hr8 hr-double"></div>

																	<div class="clearfix">
																		<table>
																			<tbody>
																				<tr>
																					{foreach from=$oData.toStatistiqueCirculaire item=oListe }
																					<td class="legendColorBox" style="text-align:right;">
																						<div style="border:1px solid null;padding:1px">
																							<div style="width:4px;height:0;border:5px solid {$oListe.zColor};overflow:hidden">
																							</div>
																						</div>
																					</td>
																					<td class="legendLabel">{$oListe.iVisitId} Visiteur{if $oListe.iVisitId>1}s{/if} ajout&eacute;{if $oListe.iVisitId>1}s{/if}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
																					{/foreach}
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div><!-- /.widget-main -->
															</div><!-- /.widget-body -->
														</div><!-- /.widget-box -->
													</div><!-- /.col -->
												</div>
												<div style="clear:both"><br/><br/></div>
												<div class="">
													<div class="col-sm-12">
														<div id="chartContainer" style="height: 300px; width: 100%;">
														</div>
													</div>
													<div style="clear:both"><br/><br/></div>
													<div class="">
														<div class="col-sm-12">
															<div id="chartDepartement" style="height: 300px; width: 100%;">
															</div>
														</div>
														<div style="clear:both"><br/><br/></div>
														<div class="">
															<div class="col-sm-12">
																<div id="chartDirection" style="height: 300px; width: 100%;">
																</div>
															</div>
															<div style="clear:both"><br/><br/></div>
															<div class="">
																<div class="col-sm-12">
																	<div id="chartService" style="height: 300px; width: 100%;">
																	</div><!-- /.col -->
																</div>
															</div>
														</div>
													</div>
												</div>
															<!-- PAGE CONTENT ENDS -->
											</div><!-- /.col -->
										</div><!-- /.row -->
									</div><!-- /.page-content -->
								</div>
								<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
									<i class="ace-icon la la-angle-double-up icon-only bigger-110"></i>
								</a>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="dialog" title="Dialog Title"></div>		
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

		
		<!-- basic scripts -->

		<!--[if !IE]> -->
		
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="{$zBasePath}assets/sau/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		{literal}
		<style>
				
				@media only screen and (max-width: 1300px){
					form .cell {
						width: 100%;
						float: none;
						padding:10px!important;
					}

					form .col-xs-3 {
						width: 100%;
						float: none;
						padding:10px!important;
					}
				}
				.input-group-addon .fa {
					margin: 0px!important;
					position: static;
					height: 0px;
					width: inherit;
					font-size: 15px;
					padding-right: 11px;
				}

				.legend table{
					width:200px!important;
				}
		</style>
		{/literal}
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{$zBasePath}assets/sau/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<link rel="stylesheet" href="{$zBasePath}assets/sau/css/jquery-ui.min.css" />
		<script src="{$zBasePath}assets/sau/js/jquery.dataTables.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/dataTables.buttons.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.flash.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.html5.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.print.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/buttons.colVis.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/dataTables.select.min.js"></script>
		
		<!-- ace scripts -->
		<script src="{$zBasePath}assets/sau/js/ace-elements.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/ace.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/canvasjs.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="{$zBasePath}assets/sau/js/jquery-ui.custom.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.ui.touch-punch.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.easypiechart.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.sparkline.index.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.flot.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.flot.pie.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="{$zBasePath}assets/sau/js/ace-elements.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/ace.min.js"></script>
		<script src="{$zBasePath}assets/sau/js/jquery-ui.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
		{literal}
			
			$(document).ready (function ()
			{
				$( ".datepicker" ).datepicker({
					dateFormat: "dd/mm/yy",
					showOtherMonths: true,
					selectOtherMonths: false,

				});

				$(".submitSearch").on('click', function(e) {
					$("#recherche").submit();
				});

			});
			
			window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer",
				{
				  title:{
					text: "Statistique Visite du mois"
				},
				axisX:{
					title: "Date",
					valueFormatString: "DD/MM/YYYY" ,
					gridThickness: 2
				},
				axisY: {
					title: "Nombre"
				},
				data: [
				{        
					type: "area",
					dataPoints: [//array
					{/literal}
					{if sizeof($oData.toStatistiqueGraph)>0}
					{foreach from=$oData.toStatistiqueGraph item=oListe }
					{literal}
					{ x: new Date({/literal}{$oListe.visiteDate}{literal}, {/literal}{$oListe.visiteMois}{literal}, {/literal}{$oListe.visiteJour}{literal}), y: {/literal}{$oListe.iVisitId}{literal}},
					{/literal}
					{/foreach}
					{/if}
					{literal}

					]
				}
				]
			});
			
			var chartDepartement = new CanvasJS.Chart("chartDepartement",
				{
				  title:{
					text: "Nombre de visite par département {/literal}{if $oData.zDateDebut != ''} du {$oData.zDateDebut}{/if}{if $oData.zDateFin != ''} au {$oData.zDateFin}{/if}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatistiqueDepartement)>0}
						{foreach from=$oData.toStatistiqueDepartement item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iVisitId}{literal}, label: "{/literal}{$oListe.departement}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

			var chartDirection = new CanvasJS.Chart("chartDirection",
				{
				  title:{
					text: "Nombre de visite par direction {/literal}{if $oData.zDateDebut != ''} du {$oData.zDateDebut}{/if}{if $oData.zDateFin != ''} au {$oData.zDateFin}{/if}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatistiqueDirection)>0}
						{foreach from=$oData.toStatistiqueDirection item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iVisitId}{literal}, label: "{/literal}{$oListe.direction}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

			var chartService = new CanvasJS.Chart("chartService",
				{
				  title:{
					text: "Nombre de visite par service {/literal}{if $oData.zDateDebut != ''} du {$oData.zDateDebut}{/if}{if $oData.zDateFin != ''} au {$oData.zDateFin}{/if}{literal}"
				  },
				  data: [{
					type: "column",
					dataPoints: [
						{/literal}
						{if sizeof($oData.toStatistiqueService)>0}
						{foreach from=$oData.toStatistiqueService item=oListe }
						{literal}
						{ y: {/literal}{$oListe.iVisitId}{literal}, label: "{/literal}{$oListe.service}{literal}" },
						{/literal}
						{/foreach}
						{/if}
						{literal}
						
					]
				}]
			});

				chart.render();
				chartDepartement.render();
				chartDirection.render();
				chartService.render();
			}
			
			
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'250px'});
			  var data = [

				{/literal}
				{if sizeof($oData.toStatistiqueCirculaire)>0}
				{foreach from=$oData.toStatistiqueCirculaire item=oListe }
				{literal}

				{ label: "{/literal}{$oListe.visiteSaisie}{literal}",  data: {/literal}{$oListe.iVisitId}{literal}, color: "{/literal}{$oListe.zColor}{literal}"},

				{/literal}
				{/foreach}
				{/if}
				{literal}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				{/literal}
				{foreach from=$oData.toStatistiqueGraph item=oListe }
				{literal}
					d1.push([{/literal}{$oListe.visite_date}{literal}, {/literal}{$oListe.iVisitId}{literal}]);
				{/literal}
				{/foreach}
				{literal}
				/*for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}*/
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Visites", data: d1 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		{/literal}
		</script>

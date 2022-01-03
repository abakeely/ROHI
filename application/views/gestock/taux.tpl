{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Taux de consommation</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des stocks</a></li>
									<li class="breadcrumb-item">{$oData.zLibelle}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="tabs section" id="RevueBlock">
									<ul class="nav nav-tabs " role="tablist">
										<li class="active"><a href="#centerPar_tabshome1" role="tab" data-toggle="tab">Flux de consommation </a></li>
										<li class=""><a href="#centerPar_tabshome0" role="tab" data-toggle="tab">Taux de consommations </a></li>
										<li class=""><a href="#centerPar_tabshome2" role="tab" data-toggle="tab">Temps d'écoulement </a></li>
										<li class=""><a href="#" class="previsionTaux">Prévision</a></li>
									</ul>
									<!-- Tab panes -->
									<div class="tab-content" >
										<div class="tab-pane active" id="centerPar_tabshome1">
											<div class="3 parsys">
												<div class="accordion section">

													<div class="panel-group" id="accordioncenterPar_tabs_content_par_2_accordion_content_par_3_accordion">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a data-toggle="collapse" class="active collapsed"  data-parent="#accordioncenterPar_tabs_content_par_2_accordion_content_par_3_accordion" href="#collapsecenterPar_tabs_content_par_2_accordion_content_par_3_accordionhome0">Liste des flux</a>
																</h4>
															</div>
															<div id="collapsecenterPar_tabs_content_par_2_accordion_content_par_3_accordionhome0" class="panel-collapse collapse in" style="">
																<div class="panel-body">
																	<div class="parsys Pane_one_title0"><div class="parbase section list">
																		<div class="card punch-status">
																						<form action="{$zBasePath}critere/liste/agent-evaluation/a-evaluer" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block">
																						<input type="hidden" id="iPrenomNomId" name="iPrenomNomId">
																							<fieldset>
																								<div class="row1">
																									<div class="cell small" style="width:175px">
																										<div class="field">
																											<label>Date début</label>
																											<input type="text" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" name="zDate1" id="zDate1" class="withDatePicker obligatoire" readonly="readonly" style="width:150px">
																										</div>
																									</div>
																								</div>
																								<div class="row1">
																									<div class="cell small" style="width:175px">
																										<div class="field">
																											<label>Date fin</label>
																											<input type="text" name="zDate2" id="zDate2" data-dd-opt-format="dd/mm/y" data-dd-opt-default-date="{$smarty.session.zDateToDayDefault}" class="withDatePicker obligatoire" readonly="readonly" style="width:150px">
																										</div>
																									</div>
																								</div>
																								
																								<div class="row1">
																									<div class="cell small">
																										<div class="field">
																											<label>&nbsp;</label>
																											<input type="button" style="cursor:pointer" class="button getStatAjaxByCritere" value="Afficher">
																										</div>
																									</div>
																								</div>
																							</fieldset>
																						</form>
																				</div>
																		<div class="liststyle4">
																			<table id="table-liste-flux" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																				<thead>
																					<tr>
																						<th>N°</th>
																						<th>Date</th>
																						<th>Type article</th>
																						<th>Article</th>
																						<th>Quantité</th>
																						<th>Unité</th>
																						<th>Consommateur</th>
																					</tr>
																					<tr>
																						<td>&nbsp;</td>
																						<td>&nbsp;</td>
																						<td><input type="text" id="iType" class="searchCommande" placeholder="Recherche type" /></td>
																						<td><input type="text" id="zArticle" class="searchCommande" placeholder="Recherche article" /></td>
																						<td>&nbsp;</td>
																						<td>&nbsp;</td>
																						<td><input type="text" id="iAgent" class="searchCommande" placeholder="Recherche consommateur" /></td>
																					</tr>
																				</thead>
																			</table>
																		</div>
																	</div>
																	</div>
																</div>
															</div>

															<!----------------- ici statistique ----------------------------------->
															<div class="liststyle4" >
																<ul>
																	<li>
																		<div id="chartFlux" style="height:300px;width:100%;"></div>
																	</li>
																</ul>
															</div>
															<!----------------- fin statistique ----------------------------------->
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- tab pane 0 -->
											<div class="tab-pane" id="centerPar_tabshome0">
												<div class="2 parsys">
													<div class="accordion section">
														<div class="panel-group" id="accordioncenterPar_tabs_content_par_2_accordion">
															<div class="panel panel-default">
																<div class="panel-heading">
																	<h4 class="panel-title">
																		<a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_2_accordion" href="#collapsecenterPar_tabs_content_par_2_accordionhome0">Diagramme de baton</a>
																	</h4>
																</div>
																<div id="collapsecenterPar_tabs_content_par_2_accordionhome0" class="panel-collapse collapse in">
																	<div class="panel-body" style="min-height:250px!important;width:100%">
																		<div class="parsys Pane_one_title0">
																			<div class="parbase section list">
																				
																				<div class="card punch-status">
																						<form action="{$zBasePath}critere/liste/agent-evaluation/a-evaluer" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block">
																						<input type="hidden" id="iPrenomNomId" name="iPrenomNomId">
																							<fieldset>
																								<div class="row1">
																									<div class="cell small">
																										<div class="field">
																											<label>Consommateur</label>
																											<input type="text" name="zPrenomNom" id="zPrenomNom" style="width:250px">
																										</div>
																									</div>
																								</div>
																								<div class="row1">
																									<div class="cell small">
																										<div class="field">
																											<label>Article</label>
																											<select name="iArticleId" id="iArticleId">
																												<option  value="0">S&eacute;lectionner</option>
																												{foreach from=$oData.toGetFourniture item=oListe }
																												<option value="{$oListe.fourniture_id}">&nbsp;{$oListe.fourniture_article}</option>
																												{/foreach}
																											</select>
																										</div>
																									</div>
																								</div>
																								<div class="row1">
																									<div class="cell small">
																										<div class="field">
																											<label>&nbsp;</label>
																											<input type="button" style="cursor:pointer" class="button"
																														onclick="getStatAjaxByCritere()" id="" value="Afficher">
																										</div>
																									</div>
																								</div>
																							</fieldset>
																						</form>
																				</div>
																				<!--First tooltip-->
																				<div style="text-align:left;padding-left:100px;">
																					<table>
																						<tr>
																							<td style="border:none"><span class="spnDetails"><button>Voir détails Consommateurs</button></span>
																								<span class="spnTooltip" style="padding:15px;">
																									<table cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																											<thead>
																												<tr>
																													<th>Nom</th>
																													<th>Taux</th>
																												</tr>
																											</thead>
																											<tbody>
																												{foreach from=$oData.toStatistiqueCSTotal item=oListe }
																												<tr>
																													<td>{$oListe.nom}</td>
																													<td>{$oListe.fraction|string_format:"%.2f"}%</td>
																												</tr>
																												{/foreach}
																											</tbody>
																										</table>
																								</span>
																							</td>
																						</tr>
																					</table>
																				</div>
																				<div style="text-align:left;padding-left:100px;">
																					<table>
																						<tr>
																							<td style="border:none"><span class="spnDetails"><button>Voir détails Article</button></span>
																								<span class="spnTooltip" style="padding:15px;">
																										<table cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																												<thead>
																													<tr>
																														<th>Article</th>
																														<th>Taux</th>
																													</tr>
																												</thead>
																												<tbody>
																													{foreach from=$oData.toStatistiqueArticleSTotal item=oListe }
																													<tr>
																														<td>{$oListe.fourniture_article}</td>
																														<td>{$oListe.fraction|string_format:"%.2f"}%</td>
																													</tr>
																													{/foreach}
																												</tbody>
																											</table>
																								</span>
																							</td>
																						</tr>
																					</table>
																				</div>
																				<div class="liststyle4" style="text-align:center">
																					<ul>
																						<li>
																							<table border="0">
																								<tr>
																									<td style="width:50%">
																										<div id="chartDiagramme" style="height:200px;"></div>
																									</td>
																									<td style="width:50%">
																										<div id="chartDiagrammeArticle" style="height:200px;"></div>
																									</td>
																								</tr>
																							</table>
																						</li>
																					</ul>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>
										
										<!-- fin tab pane 0-->

										<!-- tab pane ecoulement -->
										<div class="tab-pane" id="centerPar_tabshome2">
												<div class="3 parsys">
													<div class="accordion section">
														<div class="panel-group" id="accordioncenterPar_tabs_content_par_33_accordion">
															<div class="panel panel-default">
																<div class="panel-heading">
																	<h4 class="panel-title">
																		<a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_33_accordion" href="#collapsecenterPar_tabs_content_par_32_accordionhome0">Consommation par article</a>
																	</h4>
																</div>
																<div id="collapsecenterPar_tabs_content_par_32_accordionhome0" class="panel-collapse collapse in">
																	<div class="panel-body" style="min-height:250px!important;width:100%">
																		<div class="parsys Pane_one_title00">
																			<!--First tooltip-->
																			<div style="text-align:center">
																			<table>
																				<tr>
																					<td style="border:none"><span class="spnDetails"><button>Voir détails</button></span>
																						<span class="spnTooltip" style="padding:15px;">
																	
																							<table cellpadding="0" cellspacing="0" border="0" style="padding:0px!important" class="display" width="90%">
																								<thead>
																									<tr>
																										<th>Article</th>
																										<th>Sotck Total</th>
																										<th>Consommation mensuelle</th>
																										<th>Valeur</th>
																									</tr>
																								</thead>
																								<tbody>
																									{foreach from=$oData.toStatistiqueTe item=oListe }
																									<tr>
																										<td>{$oListe.fourniture_article}</td>
																										<td>{$oListe.stockTotal}</td>
																										<td>{$oListe.consommationAnuel|string_format:"%.2f"}</td>
																										<td>{$oListe.fraction|string_format:"%.2f"}</td>
																									</tr>
																									{/foreach}
																								</tbody>
																							</table>
																	
																						</span>
																					</td>
																				</tr>
																			</table>
																			</div>
																			<div class="parbase section list">
																				<div class="liststyle4" style="text-align:center">
																					<ul>
																						<li>
																							<table border="0">
																								<tr>
																									<td style="width:100%">
																										<div id="chartDiagrammeTE" style="height:200px;"></div>
																									</td>
																								</tr>
																							</table>
																						</li>
																					</ul>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>

														</div>
													</div>
												</div>
										</div>
										<!-- fin tab ecoulement -->
										
									
									<!-- viva -->
									</div>
								</div>
								<div id="calendar"></div>

								<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
								</form>
								<div id="dialogflux" title="Dialog Title"></div>
								<div id="dialogTaux" title="Dialog Title"></div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
					
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}


<!-- ace scripts -->

<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->

<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->

<script src="{$zBasePath}assets/sau/js/canvasjs.min.js"></script>
{literal}
<style>
#RevueBlock .tab-content .panel .panel-body .parbase.section.list ul li a:after {
    content: '';
}

.searchCommande {
	width:100%;
}
.pagination > li > a, .pagination > li > span {
    position: relative!important;
    float: left!important;
    padding: 6px 12px!important;
    margin-left: -1px!important;
    line-height: 1.42857143!important;
    color: #6a6260!important;
    text-decoration: none!important;
    background-color: #ffffff!important;
    border: 1px solid #f4f4f4!important;
}

.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    z-index: 2!important;
    color: #ffffff!important;
    cursor: default!important;
    background-color: #6a6260!important;
    border-color: #6a6260!important;
}
.eq-c {
	font-size:14px;
}
.fraction {
    display: inline-block;
    vertical-align: middle; 
    margin: 0 0.2em 0.4ex;
    text-align: center;
	position:relative!important;
}
.fraction > span {
    display: block;
    padding-top: 0.15em;
	position:relative!important;
}
.fraction span.fdn {border-top: thin solid black;position:relative!important;}
.fraction span.bar {display: none;position:relative!important;}
.canvasjs-chart-canvas {}
</style>
<script>
var iWidth = $(window).width();
function getStatistqiue(){
	
	iWidth = iWidth/3;
	window.onload = function () {

		var chartDiagramme = new CanvasJS.Chart("chartDiagramme",
		{
		  title:{
			text: "T% de consommation par consommateur"
		  },
		  width: iWidth,
		  height:200,
		  dataPointWidth: 10,
		  data: [{
				type: "column",
				dataPoints: [
					{/literal}
					{if sizeof($oData.toStatistiqueCSTotal)>0}
					{foreach from=$oData.toStatistiqueCSTotal item=oListe }
					{literal}
					{ y: {/literal}{$oListe.fraction|string_format:"%.2f"}{literal}, label: "{/literal}{$oListe.nom}{literal}" },
					{/literal}
					{/foreach}
					{/if}
					{literal}
				]
			}]
		})

		var chartDiagrammeArticle = new CanvasJS.Chart("chartDiagrammeArticle",
		{
		  title:{
			text: "T% de consommation par article"
		  },
		  width: iWidth,
		  height:200,
		  dataPointWidth: 10,
		  data: [{
				type: "column",
				dataPoints: [
					{/literal}
					{if sizeof($oData.toStatistiqueArticleSTotal)>0}
					{foreach from=$oData.toStatistiqueArticleSTotal item=oListe }
					{literal}
					{ y: {/literal}{$oListe.fraction|string_format:"%.2f"}{literal}, label: "{/literal}{$oListe.fourniture_article}{literal}" },
					{/literal}
					{/foreach}
					{/if}
					{literal}
				]
			}]
		})

		var chartDiagrammeTE = new CanvasJS.Chart("chartDiagrammeTE",
		{
		  title:{
			text: "Taux d'écoulement du mois"
		  },
		  width: ($(window).width())*2.25/3,
		  height:200,
		  dataPointWidth: 20,
		  data: [{
				type: "column",
				dataPoints: [
					{/literal}
					{if sizeof($oData.toStatistiqueTe)>0}
					{foreach from=$oData.toStatistiqueTe item=oListe }
					{literal}
					{ y: {/literal}{$oListe.fraction|string_format:"%.2f"}{literal}, label: "{/literal}{$oListe.fourniture_article}{literal}" },
					{/literal}
					{/foreach}
					{/if}
					{literal}
				]
			}]
		})


		chartDiagramme.render();
		chartDiagrammeArticle.render();
		chartDiagrammeTE.render();
	}
}

function getStatAjaxByCritere(){
	
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}gestock/getStatCommandeConsommateur",
		type: 'post',
		data: {
			iUserId:$("#iPrenomNomId").val(),
			iArticleId:$("#iArticleId").val(),
		},
		success: function(data, textStatus, jqXHR) {

			var oReturn = jQuery.parseJSON(data);

			var oChartDiagramme = oReturn.consomateur;
			var oChartDiagrammeArticle = oReturn.article;

			
			var zData = "[";
			oChartDiagramme.forEach(function(oValue) {
				zNom = oValue.nom ;
				zData += "{y: "+oValue.fraction+" ,label: '"+zNom+"'},";
			})
			zData += "]";

			var chart = new CanvasJS.Chart("chartDiagramme",{
				title:{
					text:"T% de consommation par consommateur"
				},
				 width: iWidth,
				 height:200,
				 dataPointWidth: 10,
				 data: [{
					type: "column",
					dataPoints: eval(zData),
				}]
			});
			chart.render();

			var zDataArticle = "[";
			oChartDiagrammeArticle.forEach(function(oValue) {
				zArticle = oValue.fourniture_article ;
				zDataArticle += "{y: "+oValue.fraction+" ,label: '"+zArticle+"'},";
			})
			zDataArticle += "]";

			var chartDiagrammeArticle = new CanvasJS.Chart("chartDiagrammeArticle",{
				title:{
					text:"T% de consommation par Article"
				},
				 width: iWidth,
				 height:200,
				 dataPointWidth: 10,
				 data: [{
					type: "column",
					dataPoints: eval(zDataArticle),
				}]
			});
			
			chartDiagrammeArticle.render();
		},
		async: false
	})
}
$(document).ready(function() {
	
	getStatistqiue();

	$("#dialogTaux").dialog({
		autoOpen: false,
		width: '70%',
		modal:true,
		title: 'Prévision',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});

	$("#zPrenomNom").select2
	({
		allowClear: true,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
		url: "{/literal}{$zBasePath}{literal}gestock/getConsommateurDRHA/",
		dataType: 'jsonp',
		data: function (term)
		{
			return {q: term};
		},
		results: function (data)
		{
			return {results: data};
		}
		}
	})

	$("#zPrenomNom").on("change", function(e) { 
		$("#iPrenomNomId").val($(this).val());
	}).on("open", function() { 
		console.log("open"); 
	});

	$(".getStatAjaxByCritere").click ( function(){
		var iRet = 1 ;
		$(".obligatoire").each (function ()
		{
			$(this).parent().removeClass("error");
			if($(this).val()=="" && $(this).attr("name") != undefined)
			{
				$(this).parent().addClass("error");
				 iRet = 0 ;
			}
		}) ;

		if (iRet == 1){
			zListeflux.ajax.reload();
		}
	})

	$(".previsionTaux").click(function(event) {
		
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/previsionTaux",
			type: 'get',
			data: {
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogTaux").html(data);
				$("#dialogTaux").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});

	
	var zListeflux = $('#table-liste-flux').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/flux-consommation", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val(),
				d.zDate1 = $("#zDate1").val(),
				d.zDate2 = $("#zDate2").val(),
				d.iType = $("#iType").val(),
				d.zArticle = $("#zArticle").val(),
				d.iAgent = $("#iAgent").val()
			},
			type: "post",  // method  , by default get
			"dataSrc": function (json) {
				
				var oReturn = json.data;
				var iWidth = ($(window).width())*2.35/3;
				var zData = "[";
				oReturn.forEach(function(oValue) {

					zNom = oValue[6];
					zData += "{y: "+oValue[4]+" ,label: '"+zNom+"'},";
				})
				zData += "]";

				var chart = new CanvasJS.Chart("chartFlux",{
					title:{
						text:""
					},
					 width:iWidth,
					 height:300,
					 dataPointWidth: 20,
					 data: [{
						type: "column",
						dataPoints: eval(zData),
					}]
				});
				chart.render();
				
				return json.data;
			}
		}
    }); 

	$("#table-liste-flux").on("click", ".searchCommande", function(){
	    $( this ).on( 'keyup change', function () {
			zListeflux.ajax.reload();
        } );	
	});



	$(".dialog-add-flux").click(function(event) {
		
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gestock/edit/stock/flux",
			type: 'get',
			data: {
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogflux").html(data);
				$("#dialogflux").dialog("open");
				event.preventDefault()
			},
			async: false
		})
	});
})
</script>
<style>
#cssmenu li {font-size:1.2em;}
.ui-widget-overlay {
  /*opacity: 0.6!important;*/
  filter: Alpha(Opacity=50);
  background-color: gray;
}

a.tooltip {outline:none; }
a.tooltip strong {line-height:30px;}
a.tooltip:hover {text-decoration:none;} 
a.tooltip span {
    z-index:10;display:none; padding:14px 20px;
    margin-top:-30px; margin-left:28px;
    width:300px; line-height:16px;
}
a.tooltip:hover span{
    display:inline; position:absolute; color:#111;
    border:1px solid #DCA; background:#fffAF0;}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}
    
/*CSS3 extras*/
a.tooltip span
{
    border-radius:4px;
    box-shadow: 5px 5px 8px #CCC;
}


tr .spnTooltip {
    z-index:10;display:none; padding:9px 0px;
    margin-top:-30px; margin-left:28px;
    width:500px; line-height:16px;
	/*background:#3f3b3b;*/
	background: black; 
	background: -webkit-linear-gradient(white, #737272); 
	background: -o-linear-gradient(white, #737272); 
	background: -moz-linear-gradient(white, #737272); 
	background: linear-gradient(white, #737272); 
	-webkit-box-shadow: 2px 2px 6px 1px rgba(0,0,0,0.98);
    -moz-box-shadow: 2px 2px 6px 1px rgba(0,0,0,0.98);
    box-shadow: 2px 2px 6px 1px rgba(0,0,0,0.98);
}
tr:hover .spnTooltip{
    display:inline; position:absolute; color:#111;
    /*border:1px solid #DCA; background:#fffAF0;*/}
.callout {z-index:20;position:absolute;top:30px;border:0;left:-12px;}

.spnTooltip th {
    background:black;
	background: -webkit-linear-gradient(#7b7777a1 ,#c3c2c2);
	background: -o-linear-gradient(#7b7777a1 ,#c3c2c2);
	background: -moz-linear-gradient(#7b7777a1 ,#c3c2c2);
	background: linear-gradient(#7b7777a1 ,#c3c2c2); 
	color:black;
	text-align:center;
}

 .spnTooltip tr {
    background:#000000a1!important;
	color:#fff;
}

th, td {
    width: 0px!important;
}
</style>
{/literal}
<script src="{$zBasePath}assets/sau/js/canvasjs.min.js"></script>
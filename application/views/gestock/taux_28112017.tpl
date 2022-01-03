{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">Gestion des stocks</a><span>&gt;</span> {$oData.zLibelle} </div>
	
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
			{include_php file=$zMenu}	
			<h2> Taux de consommation</h2>
			{if $oData.iSessionCompte == COMPTE_AGENT}
			<div class="SSttlPage">
			<div class="cell">
				<div class="field text-center">
				<form action="#"  method="POST" name="formulaireTransaction" id="formulaireTransaction"  enctype="multipart/form-data">
					<fieldset>
						<div class="row1">
							<div class="cell" style="text-align:left;">
								<div class="field">
									<label>&nbsp;</label>
									<input type="button" class="button dialog-add-flux" value="Ajouter flux">
									
								</div>
							</div>
						</div>
					</fieldset>
				</form>
				</div>
				</div>
			</div>
			{/if}
			<div class="contenuePage">
			<!--*Debut Contenue*-->
			<div class="contenuePage">
                    <!--*Debut Contenue*-->
                    <div class="tabs section" id="RevueBlock">
                        <ul class="nav nav-tabs " role="tablist">
                            <li class="active"><a href="#centerPar_tabshome1" role="tab" data-toggle="tab">Flux de consommation </a></li>
							<li class=""><a href="#centerPar_tabshome0" role="tab" data-toggle="tab">Taux de consommations </a></li>
							<li class=""><a href="#centerPar_tabshome2" role="tab" data-toggle="tab">Temps d'écoulement </a></li>
							<li class=""><a href="#centerPar_tabshome3" role="tab" data-toggle="tab">Ratio de consommation </a></li>
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
																	</thead>
																</table>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>

												<!----------------- ici statistique ----------------------------------->
												<!----------------- fin statistique ----------------------------------->
                                            </div>


                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_2_accordion_content_par_3_accordion" href="#collapsecenterPar_tabs_content_par_2_accordion_content_par_3_accordionhome2">Statistiques</a>
                                                    </h4>
                                                </div>
                                                <div id="collapsecenterPar_tabs_content_par_2_accordion_content_par_3_accordionhome2" class="panel-collapse collapse" style="height: 0px;">
                                                    <div class="panel-body" style="height:400px!important;position:relative!important">
                                                        <div class="Mars2 parsys">
															<div class="parbase section list">
																<div id="searchAcc">
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
																								<label>Type de fourniture</label>
																								<select name="iTypeArticleId" id="iTypeArticleId">
																									<option  value="0">S&eacute;lectionner</option>
																									{foreach from=$oData.toGetTypeFourniture item=oListe }
																									<option value="{$oListe.typeFourniture_id}">&nbsp;{$oListe.typeFourniture_libelle}&nbsp;({$oListe.typeFourniture_sigle})</option>
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
																</div>
															<div class="liststyle4" >
																<ul>
																	<li>
																		<div id="chartFlux" style="height:300px;width:100%;"></div>
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
							<!-- tab pane 0 -->
								<div class="tab-pane" id="centerPar_tabshome0">
									<div class="2 parsys">
										<div class="accordion section">
											<div class="panel-group" id="accordioncenterPar_tabs_content_par_2_accordion">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_2_accordion" href="#collapsecenterPar_tabs_content_par_2_accordionhome0">Taux de consommation par consommateur</a>
														</h4>
													</div>
													<div id="collapsecenterPar_tabs_content_par_2_accordionhome0" class="panel-collapse collapse in">
														<div class="panel-body" style="min-height:250px!important;width:100%">
															<div class="parsys Pane_one_title0">
																<div class="parbase section list">
																	<div class="liststyle4" style="text-align:center">
																		<ul>
																			<li>
																				<div class="eq-c">
																					<i></i>T% CONSO/ConsoR = 
																					<div class="fraction">
																					<span class="fup"><i></i>Qté CONSOMMEE</span>
																					<span class="bar">/</span>
																					<span class="fdn"><i></i>Qté TOTAL CONSOMMEE</span>
																					</div>
																				</div>
																			</li>
																			<li>
																				<table border="0">
																					<tr>
																						<td style="width:70%">
																							<div id="chartDiagramme" style="height:200px;"></div>
																						</td>
																						<td style="width:30%">
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
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_2_accordion" href="#collapsecenterPar_tabs_content_par_3_accordionhome0">Taux de consommation par article</a>
														</h4>
													</div>
													<div id="collapsecenterPar_tabs_content_par_3_accordionhome0" class="panel-collapse collapse">
														<div class="panel-body" style="min-height:250px!important">
															<div class="parsys Pane_one_title0">
																<div class="parbase section list">
																	<div class="liststyle4" style="text-align:center;">
																		<ul>
																			<li>
																				<div class="eq-c">
																					<i></i>T% CONSO/article = 
																					<div class="fraction">
																					<span class="fup"><i></i>Qté TOTALE CONSOMMMEE</span>
																					<span class="bar">/</span>
																					<span class="fdn"><i></i>Qté TOTALE EN STOCK</span>
																					</div>
																				</div>
																			</li>
																			<li>
																				<table border="0">
																					<tr>
																						<td style="width:70%">
																							<div id="chartDiagrammeArticle" style="height:200px;"></div>
																						</td>
																						<td style="width:30%">
																							 <table cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																								<thead>
																									<tr>
																										<th>Nom</th>
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
																<div class="parbase section list">
																	<div class="liststyle4" style="text-align:center">
																		<ul>
																			<li>
																				<div class="eq-c">
																					<i></i>tE = 
																					<div class="fraction">
																					<span class="fup"><i></i>Stock total</span>
																					<span class="bar">/</span>
																					<span class="fdn"><i></i>CONSOMMATION ANUELLE</span>
																					</div>
																				</div>
																			</li>
																			<li>
																				<table border="0">
																					<tr>
																						<td style="width:70%">
																							<div id="chartDiagrammeTE" style="height:200px;"></div>
																						</td>
																						<td style="width:30%">
																							 <table cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																								<thead>
																									<tr>
																										<th>Article</th>
																										<th>Sotck Total</th>
																										<th>Consommation anuelle</th>
																										<th>Valeur</th>
																									</tr>
																								</thead>
																								<tbody>
																									{foreach from=$oData.toStatistiqueTe item=oListe }
																									<tr>
																										<td>{$oListe.fourniture_article}</td>
																										<td>{$oListe.stockTotal}</td>
																										<td>{$oListe.consommationAnuel}</td>
																										<td>{$oListe.fraction|string_format:"%.2f"}</td>
																									</tr>
																									{/foreach}
																								</tbody>
																							</table>
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
							<!-- tab pane ration de consommation -->
							<div class="tab-pane" id="centerPar_tabshome3">
									<div class="3 parsys">
										<div class="accordion section">
											<div class="panel-group" id="accordioncenterPar_tabs_content_par_44_accordion">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a data-toggle="collapse" class="active collapsed" data-parent="#accordioncenterPar_tabs_content_par_44_accordion" href="#collapsecenterPar_tabs_content_par_44_accordionhome0">Ration de consommation</a>
														</h4>
													</div>
													<div id="collapsecenterPar_tabs_content_par_44_accordionhome0" class="panel-collapse collapse in">
														<div class="panel-body" style="min-height:250px!important;width:100%">
															<div class="parsys Pane_one_title00">
																<div class="parbase section list">
																	<div id="searchAcc">
																		<div class="card punch-status">
																				<form action="#" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data" style="display:block">
																					<fieldset>
																						<div class="row1">
																							<div class="cell small">
																								<div class="field">
																									<label>Article</label>
																									<select name="iArticle2Id" id="iArticle2Id">
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
																												   onclick="getStatAjaxByCritereRatioCons()" id="" value="Afficher">
																								</div>
																							</div>
																						</div>
																					</fieldset>
																				</form>
																		</div>
																	</div>
																	<div class="liststyle4" style="text-align:center">
																		<ul>
																			<li>
																				<div class="eq-c">
																					<i></i>rC = 
																					<div class="fraction">
																					<span class="fup"><i></i>CONSOMMATION ANNUELLE</span>
																					<span class="bar">/</span>
																					<span class="fdn"><i></i>STOCK TOTAL</span>
																					</div>
																				</div>
																			</li>
																			<li>
																				<table border="0">
																					<tr>
																						<td style="width:70%">
																							<div id="chartDiagrammeRC" style="height:200px;"></div>
																						</td>
																						<td style="width:30%">
																							 <table cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
																								<thead>
																									<tr>
																										<th>Article</th>
																										<th>Sotck Total</th>
																										<th>Consommation anuelle</th>
																										<th>Valeur</th>
																									</tr>
																								</thead>
																								<tbody>
																									{foreach from=$oData.toStatistiqueRc item=oListe }
																									<tr>
																										<td>{$oListe.fourniture_article}</td>
																										<td>{$oListe.stockTotal}</td>
																										<td>{$oListe.consommationAnuel}</td>
																										<td>{$oListe.fraction|string_format:"%.2f"}%</td>
																									</tr>
																									{/foreach}
																								</tbody>
																							</table>
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
                    </div>
                    <!--*Fin Contenue*-->
                </div>
			<!---*fin Contenur*--->
			</div>
		</div>
		<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
<form name="formDelete" id="formDelete" action="{$zBasePath}reclassement/delete/gestion-reclassement/dossiers" method="POST">
<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet reclassement ?">
<input type="hidden" name="iElementId" id="iValueId" value="">
</form>
<div id="dialogflux" title="Dialog Title"></div>
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

/*
function getStatistqiue(){
	
	var iWidth = $(window).width();
	iWidth = iWidth/2;
	window.onload = function () {
		var chartFlux = new CanvasJS.Chart("chartFlux",
		{
		  title:{
			text: "Taux de consommation par Agent"
		  },
		  width: iWidth*1.5,
		  height:300,
		  dataPointWidth: 20,
		  data: [{
				type: "column",
				dataPoints: [
					{/literal}
					{if sizeof($oData.toGetListeStat)>0}
					{foreach from=$oData.toGetListeStat item=oListe }
					{literal}
					{ y: {/literal}{$oListe.commande_quantite}{literal}, label: "{/literal}{$oListe.nom} {/literal}{$oListe.prenom}{literal}" },
					{/literal}
					{/foreach}
					{/if}
					{literal}
					
				]
			}]
		})

		var chartDiagramme = new CanvasJS.Chart("chartDiagramme",
		{
		  title:{
			text: "Diagramme"
		  },
		  width: iWidth,
		  height:200,
		  dataPointWidth: 20,
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
			text: "Diagramme"
		  },
		  width: iWidth,
		  height:200,
		  dataPointWidth: 20,
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
			text: "Diagramme"
		  },
		  width: iWidth,
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

		var chartDiagrammeRC = new CanvasJS.Chart("chartDiagrammeRC",
		{
		  title:{
			text: "Diagramme"
		  },
		  width: iWidth,
		  height:200,
		  dataPointWidth: 20,
		  data: [{
				type: "column",
				dataPoints: [
					{/literal}
					{if sizeof($oData.toStatistiqueRc)>0}
					{foreach from=$oData.toStatistiqueRc item=oListe }
					{literal}
					{ y: {/literal}{$oListe.fraction|string_format:"%.2f"}{literal}, label: "{/literal}{$oListe.fourniture_article}{literal}" },
					{/literal}
					{/foreach}
					{/if}
					{literal}
				]
			}]
		})

		chartFlux.render();
		chartDiagramme.render();
		chartDiagrammeArticle.render();
		chartDiagrammeTE.render();
		chartDiagrammeRC.render();
		
	}

}

function getStatAjaxByCritereRatioCons(){
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}gestock/getStatRatioConsommation",
		type: 'post',
		data: {
			iArticleId:$("#iArticle2Id").val(),
		},
		success: function(data, textStatus, jqXHR) {

			var oReturn = jQuery.parseJSON(data);

			var zData = "[";
			oReturn.forEach(function(oValue) {
				zData += "{y: "+oValue.fraction+" ,label: '"+oValue.fourniture_article+"'},";
			})
			zData += "]";

			var chart = new CanvasJS.Chart("chartDiagrammeRC",{
				title:{
					text:""
				},
				 height:300,
				 dataPointWidth: 20,
				 data: [{
					type: "column",
					dataPoints: eval(zData),
				}]
			});
			chart.render();
		},
		async: false
	})
}

function getStatAjaxByCritere(){

	$.ajax({
		url: "{/literal}{$zBasePath}{literal}gestock/getStatCommandeConsommateur",
		type: 'post',
		data: {
			iUserId:$("#iPrenomNomId").val(),
			iArticleId:$("#iArticleId").val(),
			iTypeArticleId:$("#iTypeArticleId").val(),
		},
		success: function(data, textStatus, jqXHR) {

			var oReturn = jQuery.parseJSON(data);

			var zData = "[";
			oReturn.forEach(function(oValue) {
				zNom = oValue.nom + ' ' + oValue.prenom;
				zData += "{y: "+oValue.commande_quantite+" ,label: '"+zNom+"'},";
			})
			zData += "]";

			var chart = new CanvasJS.Chart("chartFlux",{
				title:{
					text:""
				},
				 height:300,
				 dataPointWidth: 20,
				 data: [{
					type: "column",
					dataPoints: eval(zData),
				}]
			});
			chart.render();
		},
		async: false
	})
}*/

$(document).ready(function() {
/*
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

	
	getStatistqiue();
	$("#dialogflux").dialog({
		autoOpen: false,
		width: '40%',
		modal:true,
		title: 'Formulaire ajout flux',
		close: 'X',
		open: function () {
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length;
			};
		},
		modal: true,
		buttons: [{
					text: "fluxr",
					click: function() {

						iRet = 1 ;
						$(".obligatoire").each (function ()
						{
							$(this).parent().removeClass("error");
							if($(this).val()=="")
							{
								$(this).parent().addClass("error");
								 iRet = 0 ;
							}
						}) ;

						$("#iArticleSearchMessage").parent().removeClass("error");
						if($("#iArticleId").select2 ('val') == '')
						{	
							iRet = 0 ;
							$("#iArticleSearchMessage").parent().addClass("error");
						}
						else
						{ 
							$("#iArticleSearchMessage").parent().removeClass("error");
						}

						
						if (iRet == 1){
							var $form = $("#formulaireEdit");
							var formdata = (window.FormData) ? new FormData($form[0]) : null;
							var data = (formdata !== null) ? formdata : $form.serialize();
							$.ajax({
								url: $form.attr('action'),
								type: $form.attr('method'),
								contentType: false, // obligatoire pour de l'upload
								processData: false, // obligatoire pour de l'upload
								dataType: 'json', // selon le retour attendu
								data: data,
								success: function (response) {

									if (response == 1){
										$("#dialogflux").dialog("close");
										zListeflux.ajax.reload();
									} else {
										alert("Rupture de stock pour l'article demandé mais votre demande est enregistrée");
										$("#dialogflux").dialog("close");
									} 
								}
							});
						}
					}
				},{
					text: "Fermer",
					click: function() {
						$(this).dialog("close")
					}
				}]
	});
*/

	var zListeflux = $('#table-liste-flux').DataTable( {
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :"{/literal}{$zBasePath}{literal}gestock/getAjax/stock/flux-consommation", // json datasource
			data: function ( d ) {
				d.zDate = $("#zDate").val()
			},
			type: "post",  // method  , by default get
			error: function(){  // error handling

			}
		}
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
</style>
{/literal}
<script src="{$zBasePath}assets/sau/js/canvasjs.min.js"></script>
{include_php file=$zFooter}
</div>

</body>
</html>
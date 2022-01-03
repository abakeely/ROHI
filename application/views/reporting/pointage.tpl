{include_php file=$zCssJs}
<script src="{$zBasePath}assets/message/js/mustache.js"></script><!--!-->
<link href="{$zBasePath}assets/common/css/enquete.css" rel="stylesheet">
<script src="{$zBasePath}assets/common/js/jquery.canvasjs.min.js"></script>

<link href="{$zBasePath}assets/easyweb/css/jquery-ui-1.10.4.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery_grid_customize.css" rel="stylesheet">
<link href="{$zBasePath}assets/easyweb/css/jquery.jqGrid.css" rel="stylesheet">
<script src="{$zBasePath}assets/easyweb/js/jquery.jqGrid.min.js"></script>
<script src="{$zBasePath}assets/easyweb/js/grid.locale-en.js"></script>

	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Visualisations</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Questionnaires</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div id="innerContent">
									<!--div class="panel-body">
										<h3>ENQUÊTE SUR LES CONDITIONS DE TRAVAIL DES AGENTS DE LA DGFAG</h3>
									</div-->
									<div class="onglet">
										<form id="myForm" action="{$zBasePath}Reporting/pointage" method="POST" role="form" data-toggle="validator">
											<input type="hidden" id="parent_id">
											<input type="hidden" name="structure_id" id="structure_id">
											<div class="panel-body">
												<div><p class="title-page">Télécharger le pointage de vos employés</p></div>
												<div class="panel-body">
													<div class="panel-body">
													
															<div class="row">
																<div class="row line">
																	<div class="form col-md-3">
																		<select name="mois" class="form-control" placeholder="Sélectionner mois"  data-toggle="tooltip"  id="mois">
																			<option value="0">Sélectionner mois</option>
																			<option  {if $oData.mois=="01"}selected="selected"{/if} value="01">01</option>
																			<option   {if $oData.mois=="02"}selected="selected"{/if} value="02">02</option>
																			<option   {if $oData.mois=="03"}selected="selected"{/if} value="03">03</option>
																			<option   {if $oData.mois=="04"}selected="selected"{/if} value="04">04</option>
																			<option   {if $oData.mois=="05"}selected="selected"{/if}value="05">05</option>
																			<option   {if $oData.mois=="06"}selected="selected"{/if}value="06">06</option>
																			<option   {if $oData.mois=="07"}selected="selected"{/if}value="07">07</option>
																			<option   {if $oData.mois=="08"}selected="selected"{/if}value="08">08</option>
																			<option   {if $oData.mois=="09"}selected="selected"{/if}value="09">09</option>
																			<option   {if $oData.mois=="10"}selected="selected"{/if}value="10">10</option>
																			<option   {if $oData.mois=="11"}selected="selected"{/if}value="11">11</option>
																			<option   {if $oData.mois=="12"}selected="selected"{/if}value="12">12</option>
																		</select>
																	</div>
																	<div class="form col-md-3">
																		<select name="annee" class="form-control" placeholder="Sélectionner annee"  data-toggle="tooltip"  id="annee">
																			<option   value="0">Sélectionner Année</option>
																			<option   {if $oData.annee=="2015"}selected="selected"{/if}value="2015">2015</option>
																			<option   {if $oData.annee=="2016"}selected="selected"{/if}value="2016">2016</option>
																			<option   {if $oData.annee=="2017"}selected="selected"{/if}value="2017">2017</option>
																			<option   {if $oData.annee=="2018"}selected="selected"{/if}value="2018">2018</option>
																			<option   {if $oData.annee=="2019"}selected="selected"{/if}value="2019">2019</option>
																			<option   {if $oData.annee=="2020"}selected="selected"{/if}value="2020">2020</option>
																			<option   {if $oData.annee=="2021"}selected="selected"{/if}value="2021">2021</option>
																			<option   {if $oData.annee=="2022"}selected="selected"{/if}value="2022">2022</option>
																		</select>
																	</div>
																	<div class="form col-md-3">
																		<button class="btn_forward">Voir</button>
																	</div>
																</div>
														</div>		
															<div class="row">
																<p>Nombre de lignes : {{$oData.total}}</p>
																<ul>
																{if $oData.numberRow > 0}
																	{for $index=0 to $oData.numberRow}
																		<li>
																			<a href="{$zBasePath}Reporting/setExcelRapports?line={$index}&mois={$oData.mois}&annee={$oData.annee}">Telecharger les lignes de {$index*2000} à {($index+1) * 2000}</a>
																		</li>
																	{/for}
																{/if}
																</ul>
															</div>
													</div>.
												</div>.
											</div>
										</form>
									</div>.               
								</div>

								<div style="display:none;" id="template_structure" >
									<div class="form col-md-3" id="structure_niveau_[[source.niveau]]">
										<div class="libele_form">
											<label class="control-label label_questionnaire " data-original-title="" title=""><b> [[source.libelle]](*) </b></label>
										</div>
										[[#source]]
										<select id="structure_de_rattachement" class="form-control structure"   onChange="getChild($(this),[[source.niveau]]);"   name="">
											<option  value="0">Sélectionner votre structure de rattachement</option> 
											[[#list]]
											<option value="[[child_id]]" style="background-color: #e85d09;color: #fff;">[[child_libelle]]</option>
											[[/list]]
										</select>
										[[/source]]
									</div>
								</div>
								<div style="display:none;" id="template_site" >
									<option  value="0">Sélectionner votre lieu de travail</option> 
									[[#source]]
										[[#list]]
											<option style="background-color: #e85d09;color: #fff;" value="[[site_id]]">[[site_libelle]]</option>
										[[/list]]
									[[/source]]
								</div>
								<div id="block_rattachement" style="display:none">
									
								</div>
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

{literal}

<script>

</script>
{/literal}
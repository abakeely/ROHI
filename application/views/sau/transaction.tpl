{include_php file=$zCssJs}
{literal}
		<style>
		.select2-container {
			width: 250px!important;
		}
		.select2-results li {
			font-size: 13px;
			padding: 10px;
		}
		.select2-container .select2-choice span {
			font-size:13px!important;
		}
		.select2-search input {
			font-size:13px!important;
		}

		@media only screen and (max-width: 1600px){
			.cellinfo {
				width: 100%!important;
				float: none!important;
				padding:10px!important;
			}
		}
		</style>
		<!-- inline scripts related to this page -->

		<script type="text/javascript">

			$(function () {
				$('.iCheck').iCheck({
				  checkboxClass: 'icheckbox_square-blue',
				  radioClass: 'iradio_square-blue',
				  increaseArea: '20%' // optional
				});
			});
		</script>
{/literal}
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
														<li class="active">Transactions</li>
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
															
												<!------------------------------- ici formualrie d'ajout ---------------------------->
													<form action="{$zBasePath}sau/transactions/gestion-visiteur/liste" method="POST" name="submitRecherche" id="submitRecherche">
														<input type="hidden" name="idSelect" id="idSelect" value="">
														<!--<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
																<div class="widget-box">
																	<div class="widget-header">
																		<h4 class="widget-title">
																			<i class="ace-icon la la-tint"></i>
																			Transactions
																		</h4>
																	</div>
																	
																	<div class="widget-body">
																		<div class="widget-main" style="padding-left:5%">

																			<div class="card punch-status">
																				<div class="row clearfix iCheck">
																					<div class="col-xs-3">
																						<div class="input-group input-group-sm">
																							<input type="text" placeholder="Date début" name="zDateDebut" id="zDateDebut" value="{$oData.zDateDebut}" class="form-control datepicker" />
																							<span class="input-group-addon">
																								<i class="ace-icon la la-calendar"></i>
																							</span>
																						</div>
																					</div>
																					<div class="col-xs-3">
																						<div class="input-group input-group-sm">
																							<input type="text" placeholder="Date fin" name="zDateFin" id="zDateFin" value="{$oData.zDateFin}" class="form-control datepicker" />
																							<span class="input-group-addon">
																								<i class="ace-icon la la-calendar"></i>
																							</span>
																						</div>
																					</div>
																				</div>
																				<div><p>&nbsp;</p></div>
																				<div class="row clearfix">
																					<div class="cell">
																						<div class="field" id="searchCandidat" style="display:block">
																							<input style="width:50%;font-size:13px" placeholder="Veuillez rechercher un badge" type="text" id="badge_id" name="badge_id">
																						</div>
																					</div>
																				</div>
																			</div>
																			<br/>
																			<div class="center" style="margin-bottom:0px;">
																				<button class="btn btn-info" id="submitVisiteur" type="button">
																					<i class="ace-icon la la-check bigger-110"></i>
																					Rechercher
																				</button>
																			</div>
																			
																		</div>
																		
																	</div>
																</div>
															</div>-->

															<div class="row">
																	<div class="col-sm-12">
																		<h3 class="blue lighter smaller">
																			<i class="ace-icon la la-calendar-o smaller-90"></i>
																			TRANSACTIONS
																		</h3>
																		<div class="">
																			<div class="col-xs-3 cellinfo">
																				<div class="input-group input-group-sm" style="width:25%;">
																					<input type="text" placeholder="Date début" name="zDateDebut" id="zDateDebut" value="{$oData.zDateDebut}" class="form-control datepicker" />
																					<span class="input-group-addon">
																						<i class="ace-icon la la-calendar"></i>
																					</span>
																				</div>
																			</div>
																			<div class="col-xs-3 cellinfo">
																				<div class="input-group input-group-sm" style="width:25%;">
																					<input type="text" placeholder="Date fin" name="zDateFin" id="zDateFin" value="{$oData.zDateFin}" class="form-control datepicker" />
																					<span class="input-group-addon">
																						<i class="ace-icon la la-calendar"></i>
																					</span>
																				</div>
																			</div>
																			<div class="col-xs-3 cellinfo">
																				<div class="input-group input-group-sm">
																					<div class="field" id="searchCandidat" style="display:block">
																						<input style="font-size:13px" placeholder="Veuillez rechercher un badge" type="text" id="badge_id" name="badge_id">
																					</div>
																				</div>
																			</div>
																			<div class="col-xs-2">
																				<div class="input-group input-group-sm">
																					<button style="width:125px;" id="submitVisiteur" class="btn btn-xs btn-succes submitSearch">
																						Rechercher
																						<i class="ace-icon la la-arrow-right icon-on-right"></i>
																					</button>
																				</div>
																			</div>
																		</div>
																	</div><!-- ./span -->
															</div>
													</form>
												<!------------------------------- fin formualrei d'ajout ---------------------------->
												<div class="row">
													<div class="col-xs-12">
														
														<div class="clearfix">
															<div class="pull-right tableTools-container"></div>
														</div>
														<div class="table-header">
															<span id="resultatPour">Résultat pour les transactions du {$oData.zDateDebut} au {$oData.zDateFin}</span>
														</div>

														<!-- table -->

														<div class="clear"></div>
														<table id="dynamic-table" style="font-size:12px;" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Jour</th>
																	<th>Date</th>
																	<th>Heure</th>
																	<th>Terminal</th>
																	<th>Visiteur</th>
																</tr>
															</thead>
															<tbody>
																{assign var=iIncrement value="0"}
																{if sizeof($oData.toGetAllTransaction)>0}
																{foreach from=$oData.toGetAllTransaction item=oListeTransaction }
																<tr {if $iIncrement%2 == 0} class="even" {/if}>
																	<td>{$oListeTransaction.time|date_format:"%A"|ucfirst}</td>
																	<td>{$oListeTransaction.time|date_format:"%d/%m/%Y"}</td>
																	<td>{$oListeTransaction.time|date_format:"%H:%M:%S"}</td>
																	<td>{$oListeTransaction.event_point_name|utf8}</td>
																	<td>
																	{foreach from=$oData.toAllVisiteur item=toAllVisiteur }
																		{if $toAllVisiteur.visite_heureSortie >= $oListeTransaction.time|date_format:"%H:%M:%S" }
																		{$toAllVisiteur.nomVisiteur}--{$toAllVisiteur.visite_heureSortie}--{$oListeTransaction.time}
																		{/if}
																	{/foreach}
																	</td>
																</tr>
																{assign var=iIncrement value=$iIncrement+1}
																{/foreach}
																{else}
																{if $oData.zMessage == ''}
																<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
																{else}
																<tr><td style="text-align:center;color:red" colspan="7"><strong>{$oData.zMessage}</strong></td></tr>
																{/if}
																{/if}
															</tbody>
														</table>
														

														<!-- fin table -->
														
													</div>
												</div>
												

												<!------------------------------- fin liste ----------------------------------------->

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
				
        </div>
		<!-- /Page Wrapper -->
		<div id="dialog" title="Dialog Title"></div>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

		<!-- basic scripts -->

		<!--[if !IE]> -->
		
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="{$zBasePath}assets/sau/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<link rel="stylesheet" href="{$zBasePath}assets/sau/css/jquery-ui.min.css" />
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
		<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
		<script src="{$zBasePath}assets/sau/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/select2.js"></script>
		<script src="{$zBasePath}assets/js/jquery.maskedinput.js"></script>
		{literal}
		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			$(document).ready (function ()
			{
				var dataArrayVille = [{id:1,text:'tojo'}];
				$("#visiteur_cin").mask("999 999 999 999");    

				$( ".datepicker" ).datepicker({
					dateFormat: "dd/mm/yy",
					showOtherMonths: true,
					selectOtherMonths: false,

				});
				{/literal}{if sizeof($oData.toGetAllTransaction)>0}{literal}
				var myTable = 
				$('#dynamic-table')
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					 null,null, null,null,null
					],
					"aaSorting": [],
					
					select: {
						style: 'multi'
					}
				} );
				{/literal}{/if}{literal}

				
				$( "#submitVisiteur" ).click(function( event ) {
					$("#submitRecherche").submit();
				});

				
				$("#badge_id").select2({
					initSelection: function (element, callback) {
						callback({id:'{/literal}{$oData.iBadgeId}{literal}',text:'{/literal}{$oData.zTextBadge}{literal}'});
					},
					allowClear: true,
					placeholder:"Sélectionnez",
					minimumInputLength: 1,
					multiple:false,
					formatNoMatches: function () { return $("#AucunResultat").val(); },
					formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
					formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
					formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
					formatSearching: function () { return "Recherche..."; },			
					ajax: { 
						url: "{/literal}{$zBasePath}{literal}sau/getBadgeSelect22/",
						dataType: 'jsonp',
						data: function (term)
						{
							return {q: term, iFiltre:1};
						},
						results: function (data)
						{
							return {results: data};
						}
					},
					dropdownCssClass: "bigdrop"
				}).select2('val','{/literal}{$oData.iBadgeId}{literal}') ;

				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			

			});

			{/literal}
		</script>
		{literal}
		<style>
				.input-group-addon .fa {
					margin: 0px!important;
					position: static;
					height: 0px;
					width: inherit;
					font-size: 15px;
					padding-right: 11px;
				}
		</style>
		{/literal}

{include_php file=$zCssJs}
{literal}
		<style>
		.select2-results li {
			font-size: 1.4em;
			padding: 10px;
		}
		.select2-container .select2-choice span {
			font-size:14px!important;
		}
		.select2-search input {
			font-size:14px!important;
		}
		.select2-container {
			width: calc(50% - 30px) !important;
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
														<li class="active">Badges</li>
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
													<div class="col-xs-12">
														
														<div class="clearfix">
															<div class="pull-right tableTools-container"></div>
														</div>
														<div class="table-header">
															<span id="resultatPour">Résultat pour les badges</span>
														</div>

														<!-- table -->

														<div class="clear"></div>
														<table id="dynamic-table" style="font-size:12px;" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Badge</th>
																	<th>Motif</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
																{assign var=iIncrement value="0"}
																{if sizeof($oData.toAllBadge)>0}
																{foreach from=$oData.toAllBadge item=oAllBadge }
																<tr {if $iIncrement%2 == 0} class="even" {/if}>
																	<td style="width:60%">{$oAllBadge.badge_nom}</td>
																	<td id="badgeMotif_{$oAllBadge.badge_id}" style="width:70%">{$oAllBadge.badge_motif}</td>
																	<td id="badgeValidation_{$oAllBadge.badge_id}">
																	{if $oAllBadge.badge_actif == 1}
																	<input  type="button" style="cursor:pointer;padding:0px;" class="btn btn-info" onclick="rendre({$oAllBadge.badge_id})" name="rendreLeBadge" iBadegId="{$oAllBadge.badge_id}" id="rendreLeBadge"  value="Désactivation Badge">
																	{else}
																	Désactivé
																	{/if}
																	</td>
																</tr>
																{assign var=iIncrement value=$iIncrement+1}
																{/foreach}
																{else}
																<tr><td style="text-align:center;" colspan="7">Aucun enregistrement correspondant</td></tr>
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
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon la la-angle-double-up icon-only bigger-110"></i>
			</a>		
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

			function rendre(_iBadgeId) {
				$("#dialog").html();
				var iBadegId = _iBadgeId;
				$.ajax({
					url: "{/literal}{$zBasePath}{literal}sau/getPopUpBadgeRetour",
					type: 'POST',
					data: {
						iBadegId: iBadegId
					},
					success: function(data, textStatus, jqXHR) {
						$("#dialog").html(data);
						$("#dialog").dialog("open");
						event.preventDefault()
					},
					async: !1
				})
			}

			function validerBadge(_iBadgeId) {
				$("#dialog").html();
				var iBadegId = _iBadgeId;
				$.ajax({
					url: "{/literal}{$zBasePath}{literal}pointage/getPopUpBadgeValidation",
					type: 'POST',
					data: {
						iBadegId: iBadegId
					},
					success: function(data, textStatus, jqXHR) {
						$("#dialog").html(data);
						$("#dialog").dialog("open");
						event.preventDefault()
					},
					async: false
				})
			}
			$(document).ready(function() {
				$("#dialog").dialog({
					autoOpen: false,
					width: '30%',
					title: 'Désactivation badge',
					close: 'X',
					modal:true,
					buttons: [{
						text: "Valider",
						click: function() {
							var zMessage = "";
							var iBadegId = $("#iBadegId").val();
							var zMotif = $("#zMotif").val();
							if (zMotif == '') {
								zMessage += "Veuillez entrer le motif de la désactivation"
							}
							if (zMessage != '') {
								alert(zMessage)
							} else {
								$.ajax({
									url: "{/literal}{$zBasePath}{literal}sau/saveBadgeValidation1/",
									type: 'Post',
									data: {
										iBadegId: iBadegId,
										zMotif: zMotif
									},
									success: function(data, textStatus, jqXHR) {
										var oReturn = jQuery.parseJSON(data);
										$("#badgeValidation_" + iBadegId).html("Désactivé");
										$("#badgeMotif_" + iBadegId).html(oReturn.zMotif);
										$("#dialog").html();
										$("#dialog").dialog("close");
										event.preventDefault()
									},
									async: false
								})
							}
						}
					}, {
						text: "Annuler",
						click: function() {
							$(this).dialog("close")
						}
					}]
				});
				
				
			})


			$(document).ready (function ()
			{
				
				{/literal}{if sizeof($oData.toAllBadge)>0}{literal}
				var myTable = 
				$('#dynamic-table')
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					 null,null,{ "bSortable": false }
					],
					"aaSorting": [],
					
					select: {
						style: 'multi'
					}
				} );
				{/literal}{/if}{literal}

			});

			{/literal}
		</script>

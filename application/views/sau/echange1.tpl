{include_php file=$zHeader }
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
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
	</div>
	<div id="innerContent">
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
							<li class="active">Ajout visiteur</li>
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
								<div class="col-xs-12">
								<div class="tabbable">
									<ul class="nav nav-tabs" id="myTab" style="font-size:17px">
										<li class="active">
											<a data-toggle="tab" href="#formulaire">
												<i class="green ace-icon la la-home bigger-120"></i>
												Formulaire
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#liste">
												<span id="titleVisiteur">Liste des visiteurs ajoutés aujourd'hui {$iCount}</span>
												<span id="countVisit" class="badge badge-danger">{if $oData.iCount>0}{$oData.iCount}{/if}</span>
											</a>
										</li>
									</ul>
								</div>
								</div><!-- /.col -->
								<!------------------------------- ici formualrie d'ajout ---------------------------->
									<form>
									<input type="hidden" name="idSelect" id="idSelect" value="">
									<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">
														<i class="ace-icon la la-tint"></i>
														Formulaire ajout visiteur
													</h4>
												</div>
												
												<div class="widget-body">
													<div class="widget-main" style="padding-left:5%">

														<div class="card punch-status">
															<div class="row clearfix iCheck">
																<div class="cell">
																	<label ><strong>Choix de recherche :</strong></label>
																	<div class="field">
																		<input type="radio" checked="checked" class="iClassificationClass" id="iRecherche" name="iRecherche" value="1">&nbsp;&nbsp;Nom&nbsp;&nbsp;/&nbsp;&nbsp;Pr&eacute;nom 
																		<span style="padding-left:5%!important;">&nbsp;</span>
																		<input type="radio" class="iClassificationClass" id="iRecherche" name="iRecherche" value="2">&nbsp;&nbsp;CIN 
																		<span style="padding-left:5%!important;">&nbsp;</span>
																		<input type="radio" class="iClassificationClass" id="iRecherche" name="iRecherche" value="3">&nbsp;&nbsp;Permis de conduire  
																		<span style="padding-left:5%!important;">&nbsp;</span>
																		<input type="radio" class="iClassificationClass" id="iRecherche" name="iRecherche" value="4">&nbsp;&nbsp;Autres  
																		<br/>
																	</div>
																</div>
															</div>
															<div><p>&nbsp;</p></div>
															<div class="row clearfix">
																<div class="cell">
																	<label>Recherche visiteur si existant en Base</label>
																	<div class="field" id="searchCandidat" style="display:block">
																		<input style="width:50%;font-size:13px" placeholder="Veuillez entrer le nom du visiteur" type="text" id="zCandidatInfo" name="zCandidatInfo">
																	</div>
																</div>
															</div>
														</div>
														<br/>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">CIN *:</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input  style="width: 20%;" id="visiteur_cin" name="visiteur_cin" type="text" class="input-small" />
															</div>
														</div>

														<br/>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Permis de conduire :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input  style="width: 20%;" id="visiteur_permis" name="visiteur_permis" type="text" class="input-small" />
															</div>
														</div>

														<br/>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Autres pièces justificatives:</label>
														</div>
														<br/>
														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<span style="color: #3d423e;font-size:13px">Intitulé : </span><input  style="width: 30%;" id="visiteur_autreIntitule" name="visiteur_autreIntitule" type="text" class="input-small" />
																<span style="color: #3d423e;font-size:13px">&nbsp;&nbsp;Numéro : </span><input  style="width: 30%;" id="visiteur_autreValue" name="visiteur_autreValue" type="text" class="input-small" />
															</div>
														</div>
														<br/><br/>

														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Nom * :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker" > 
																<input  style="width: 50%;" type="text" id="visiteur_nom" name="visiteur_nom" class="input-small" />
																<label style="display:inline!important">
																	&nbsp;&nbsp;<input name="form-field-checkbox" id="iNeantNom" name="iNeantNom" type="checkbox" class="ace" />
																	<!--<span class="lbl" style="font-size:13px">&nbsp;&nbsp;Cocher si Néant</span>-->
																</label>
															</div>
															
														</div>
														<br/>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Pr&eacute;nom * :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input  style="width: 40%;" id="visiteur_prenom" name="visiteur_prenom" type="text" class="input-small" />
																<label style="display:inline!important">
																	&nbsp;&nbsp;<input name="form-field-checkbox" id="iNeantPrenom" name="iNeantPrenom" type="checkbox" class="ace" />
																	<span class="lbl" style="font-size:13px">&nbsp;&nbsp;Cocher si Néant</span>
																</label>
															</div>
														</div>
														<br/>
														
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Porte :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input style="width:10%;font-size:13px" placeholder="Veuillez rechercher une porte" type="text" id="porte_id" name="porte_id">
															<button class="btn ajoutPorte">
																<i class="ace-icon la la-pencil align-top "></i>
																Ajout porte
															</button>
															</div>
														</div>
														
														<br/>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Badge *:</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input style="width:10%;font-size:13px" placeholder="Veuillez rechercher un badge" type="text" id="badge_id" name="badge_id">
															<button class="btn ajoutBadge">
																<i class="ace-icon la la-pencil align-top"></i>
																Ajout Badge
															</button>
															</div>
														</div>
														<br/>
														<div class="checkbox clearfix" style="margin-left:-10px;">
															<label>
																<input name="form-field-checkbox" id="listeNoire" name="listeNoire" type="checkbox" class="ace" />
																<span class="lbl" style="font-size:13px"> Ajouter à la liste noire</span>
															</label>
														</div>
														<div id="motifListeNoir" style="display:none">
															<br/>
															<div class="clearfix">
																<label for="colorpicker1" style="font-size:13px">Motifs Liste noire * :</label>
															</div>

															<div class="control-group">
																<div class="bootstrap-colorpicker"> 
																	<input  style="width: 50%;" type="text" id="visiteur_motifs" name="visiteur_motifs" class="input-small" />
																</div>
															</div>
														</div>
														<br/>
														<div class="checkbox clearfix" id="zMessageListeNoire" style="display:none">
															<label style="text-align:center;">
																<span class="lbl" style="font-size:16px;color:red;text-decoration: blink;"> <blink>Visteur déjà dans la liste noire!!!</blink></span>
															</label>
														</div>
													</div>
													<div class="form-actions center" style="margin-bottom:0px;">
														<button class="btn btn-info" id="submitVisiteur" type="button">
															<i class="ace-icon la la-check bigger-110"></i>
															Enregistrer
														</button>
													</div>
												</div>
											</div>
										</div>
										</form>
								<!------------------------------- fin formualrei d'ajout ---------------------------->
								<div class="row" id="liste" style="display:none;">
									<div class="col-xs-12">
										
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											<span id="resultatPour">Résultat pour les visiteurs du jour</span>
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">Nom</th>
														<th>Prénom</th>
														<th class="hidden-480">Porte</th>
														<th>
															<i class="ace-icon la la-clock-o bigger-110 hidden-480"></i>
															Badge
														</th>
														<th class="hidden-480">Heure d'entrée</th>
														<th class="center">
															Heure de sortie
														</th>
														<th></th>
													</tr>
												</thead>

												<tbody>
													{if sizeof($oData.oListe)>0}
													{foreach from=$oData.oListe item=oListe }
													<tr>
														<td>
															<a href="#">{$oListe.visiteur_nom}</a>
														</td>
														<td>{$oListe.visiteur_prenom}</td>
														<td class="hidden-480"><span class="label label-sm label-info arrowed arrowed-righ">{$oListe.porte_nom}</td>
														<td>{$oListe.badge_nom}</td>

														<td class="hidden-480">{$oListe.visite_heureEntree}</td>
														<td class="center">
															{$oListe.visite_heureSortie}
														</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="#">
																	<i class="ace-icon la la-pencil bigger-130"></i>
																</a>
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon la la-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon la la-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon la la-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon la la-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>
													{/foreach}
													{else}
													<tr><td style="text-align:center;border:none" colspan="12">Aucun enregistrement</td></tr>
													{/if}
												</tbody>
											</table>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon la la-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<!-- ui-dialog -->
		<div id="dialog" title="Dialog Title"></div>
		<div id="dialog2" title="Dialog Title">
			<table style="font-size:1.5em;">
				<tr style="height:30px;">
					<td>&nbsp;</td>
				</tr>
				<tr style="height:30px;">
					<td>
						<p>Agent qui a signalé : <label style="color:green" id="SignalAgent"></label></p>
					</td>
				</tr>
				<tr style="height:30px;">
					<td>
						<p>Motifs : <label style="color:red" id="motifAgent"></label></p>
					</td>
				</tr>
				<tr style="height:30px;">
					<td>
						<p>Porte : <label style="color:red" id="PorteAgent"></label></p>
					</td>
				</tr>
			</table>
		</div>
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
		<script src="{$zBasePath}assets/sau/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
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
		<script src="{$zBasePath}assets/sau/js/jquery-ui.min.js"></script>
		<script src="{$zBasePath}assets/js/jquery.maskedinput.js"></script>
		<script type="text/javascript" src="{$zBasePath}assets/sau/app/js/app/select2.min.js"></script>
		{literal}
		<!-- inline scripts related to this page -->
		<style>
		td {border:none!important;}
		</style>
		<script type="text/javascript">
			$(document).ready (function ()
			{
				$("#visiteur_cin").mask("999 999 999 999");    

				$( ".datepicker" ).datepicker({
					dateFormat: "dd/mm/yy",
					showOtherMonths: true,
					selectOtherMonths: false,

				});

				$("#dialog2").dialog({
					autoOpen: false,
					width: '30%',
					title: 'Notification Liste noire',
					close: 'X',
					modal:true,
					buttons: [{
						text: "OK",
						click: function() {
							$(this).dialog("close")
						}
					}]
					
				});

				$( "#visiteur_cin" ).focusout(function() {
					var zCinValue = $( "#visiteur_cin" ).val();
					var iRes = zCinValue.replace(/[^0-9]/g, '');
					iRes = iRes.trim();

					console.log( iRes.length );
					if (iRes.length == 12){
					
						$.ajax({
							url: "{/literal}{$zBasePath}{literal}sau/getInfoVisiteurByCin",
							method: "POST",
							data: { iCinVisiteur:iRes},
							success: function(data, textStatus, jqXHR) {
								var oReturn = jQuery.parseJSON(data);
								if (oReturn.visiteur_id > 0) {

									if (oReturn.visiteur_listeNoire == 1) {
										$("#submitVisiteur").hide();
										$("#zMessageListeNoire").show();
										$("#motifAgent").html(oReturn.visiteur_motifsListeNoire);
										$("#SignalAgent").html(oReturn.zNom);
										$("#PorteAgent").html(oReturn.zPoste);
										$("#dialog2").dialog("open");

									} else {

										$("#idSelect").val(oReturn.visiteur_id) ; 
										$("#visiteur_nom").val(oReturn.visiteur_nom);
										$("#visiteur_prenom").val(oReturn.visiteur_prenom);
										$("#visiteur_cin").val(oReturn.visiteur_cin);
										//$("#visiteur_nom").attr("disabled", "disabled") ; 
										if (oReturn.visiteur_prenom != ''){
											//$("#visiteur_prenom").attr("disabled", "disabled") ; 
										}
										//$("#visiteur_cin").attr("disabled", "disabled") ; 
										$("#visiteur_cin").mask("999 999 999 999");    

										$("#visiteur_permis").val(oReturn.visiteur_permis);
										$("#visiteur_autreIntitule").val(oReturn.visiteur_autreIntitule);
										$("#visiteur_autreValue").val(oReturn.visiteur_autreValue);

										$("#visiteur_nom").removeClass("obligatoire") ; 
										$("#visiteur_prenom").removeClass("obligatoire") ;  
										$("#visiteur_cin").removeClass("obligatoire") ; 
									}
									
								} else {
									$("#idSelect").val('') ;
								}
							},
							async: false
						});
					}
				})

				$( ".fa-calendar" ).datepicker({
					dateFormat: "dd/mm/yy",
					showOtherMonths: true,
					selectOtherMonths: false,

				});
				
				$( "input[name='iRecherche" ).on('ifChecked', function(event){
						var iValue = $(this).val();
						$("#iRechercheId").val(iValue);

				});
				
				$( ".ajoutPorte" ).click(function( event ) {
					
					$("#dialog").html();
					$("#switchBadgePorte").val("1");
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/getPorte" ,
						type: 'POST',
						data: { },
						success: function(data, textStatus, jqXHR) {
							
							$("#dialog").html(data);	
							$( "#dialog" ).dialog( "open" );
							
							event.preventDefault();
						},
						async: false
					});
				});

				$( ".ajoutBadge" ).click(function( event ) {
					
					$("#dialog").html();
					$("#switchBadgePorte").val("2");
					
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/getBadge" ,
						type: 'POST',
						data: { },
						success: function(data, textStatus, jqXHR) {
							
							$("#dialog").html(data);	
							$( "#dialog" ).dialog( "open" );
							
							event.preventDefault();
						},
						async: false
					});
				});
			
			});
			
			function listeVisiteToDay(_zDateDebut, _zDateFin){
				var zDateDebut = _zDateDebut ; 
				var zDateFin   = _zDateFin ; 
				$.ajax({
					url: "{/literal}{$zBasePath}{literal}sau/listeVisiteToDay" ,
					method: "POST",
					data: {zDateDebut:zDateDebut, zDateFin:zDateFin},
					success: function(data, textStatus, jqXHR) {
						var oReturn = jQuery.parseJSON(data);
						$("#liste").html(oReturn.zFormListeVisiteur);
						$("#countVisit").html(oReturn.iCount);
						$("#liste").show();
					},
					async: false
				});
			}
			
			jQuery(function($) {
				

				$( "#dialog" ).dialog({
					autoOpen: false,
					width: '50%',
					title: 'Gestion des visiteurs',
					close: 'X',
					modal: true,
					buttons: [
						{
							text: "Valider",
							click: function() {
								var iSwitchBadgePorte = $("#switchBadgePorte").val();
								var iTestValid = 1 ; 
								var zMessage = "";

								switch (iSwitchBadgePorte) {

									case "1" :
										
										var iDepartementId	= $('#iDepartementId').val();
										var iDirection		= $('#iOrganisation_1').val();
										var iService		= $('#iOrganisation_2').val();
										var zPorte			= $('#zPorte').val();

										if (iDepartementId == '' || iDepartementId ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez sélectionner un département\n" ; 
										}

										if (iDirection == '' || iDirection ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez sélectionner une direction\n" ; 
										}

										if (iService == '' || iService ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez sélectionner un service\n" ; 
										}

										if (zPorte == '' || zPorte ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir le nom de la porte\n" ; 
										}

										if (iTestValid == 1) {

													$.ajax({
														url: "{/literal}{$zBasePath}{literal}sau/savePorte/" ,
														method: "POST",
														data: { iDepartementId:iDepartementId, iDirection:iDirection, iService:iService, zPorte:zPorte},
														success: function(data, textStatus, jqXHR) {
															
															$("#porte_id").html(data);
															$( "#dialog" ).dialog( "close" );
														},
														async: false
													});

										} else {
											alert(zMessage);
										}
										break;

									case "2" :
										var zNumBadge		= $('#zNumBadge').val();
										var zNomBadge		= $('#zNomBadge').val();

										if (zNumBadge == '' || zNumBadge ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir le numéro du badge" ; 
										}

										if (zNomBadge == '' || zNomBadge ==0) {
											var iTestValid = 0 ; 
											zMessage += "- Veuillez remplir le nom du badge\n" ; 
										}

										if (iTestValid == 1) {

												$.ajax({
													url: "{/literal}{$zBasePath}{literal}sau/saveBadge/" ,
													method: "POST",
													data: { zNumBadge:zNumBadge, zNomBadge:zNomBadge},
													success: function(data, textStatus, jqXHR) {
														
														$("#badge_id").html(data);
														$( "#dialog" ).dialog( "close" );
													},
													async: false
												});

										} else {
											alert(zMessage);
										}
										break;
								}

							}
						},
						{
							text: "Annuler",
							click: function() {
								$( this ).dialog( "close" );
							}
						}
					]
				});

				

				$("#visiteur_nom").removeAttr("disabled") ; 
				$("#visiteur_prenom").removeAttr("disabled") ; 
				$("#visiteur_cin").removeAttr("disabled") ;

				$("#visiteur_nom").val('');
				$("#visiteur_prenom").val('');
				$("#visiteur_cin").val('');

				var dataArrayInfo = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
				
				$("#zCandidatInfo").select2
				({
					initSelection: function (element, callback)
					{
					},
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
						url: "{/literal}{$zBasePath}{literal}sau/getVisiteur/",
						dataType: 'jsonp',
						data: function (term)
						{
							return {q: term, iFiltre:1, iRechercheId:$("#iRechercheId").val()};
						},
						results: function (data)
						{
							return {results: data};
						}
					},
					dropdownCssClass: "bigdrop"
				}) ;

				$("#porte_id").select2
				({
					initSelection: function (element, callback)
					{
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
						url: "{/literal}{$zBasePath}{literal}sau/getPorteSelect2/",
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
				}) ;

				$("#badge_id").select2
				({
					initSelection: function (element, callback)
					{
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
						url: "{/literal}{$zBasePath}{literal}sau/getBadgeSelect2/",
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
				}) ;


				$("#zCandidatInfo").on('change', function (e) {
					var iCandidatInfo = $("#zCandidatInfo").val() ; 
					$("#idSelect").val(iCandidatInfo) ; 
					$("#submitVisiteur").show();
					$("#zMessageListeNoire").hide();
					

					if (iCandidatInfo == '') {
						$("#visiteur_nom").removeAttr("disabled") ; 
						$("#visiteur_prenom").removeAttr("disabled") ; 
						$("#visiteur_cin").removeAttr("disabled") ;

						$("#visiteur_nom").addClass("obligatoire") ; 
						$("#visiteur_prenom").addClass("obligatoire") ;  
						$("#visiteur_cin").addClass("obligatoire") ; 

						$("#visiteur_nom").val('');
						$("#visiteur_prenom").val('');
						$("#visiteur_cin").val('');

						$("#visiteur_permis").val('');
						$("#visiteur_autreIntitule").val('');
						$("#visiteur_autreValue").val('');
					} else {
						var idSelect = $("#idSelect").val();
						var iRechercheId = $("#iRechercheId").val();
						$.ajax({
							url: "{/literal}{$zBasePath}{literal}sau/getInfoVisiteur",
							method: "POST",
							data: { idSelect:idSelect, iRechercheId:iRechercheId},
							success: function(data, textStatus, jqXHR) {
								var oReturn = jQuery.parseJSON(data);
								if (oReturn.visiteur_id > 0) {

									$("#visiteur_nom").val(oReturn.visiteur_nom);
									$("#visiteur_prenom").val(oReturn.visiteur_prenom);
									$("#visiteur_cin").val(oReturn.visiteur_cin);
									$("#visiteur_nom").attr("disabled", "disabled") ; 
									$("#visiteur_prenom").attr("disabled", "disabled") ; 
									$("#visiteur_cin").attr("disabled", "disabled") ; 
									$("#visiteur_cin").mask("999 999 999 999");    

									$("#visiteur_permis").val(oReturn.visiteur_permis);
									$("#visiteur_autreIntitule").val(oReturn.visiteur_autreIntitule);
									$("#visiteur_autreValue").val(oReturn.visiteur_autreValue);

									$("#visiteur_nom").removeClass("obligatoire") ; 
									$("#visiteur_prenom").removeClass("obligatoire") ;  
									$("#visiteur_cin").removeClass("obligatoire") ; 
									if (oReturn.visiteur_listeNoire == 1) {
										$("#submitVisiteur").hide();
										$("#zMessageListeNoire").show();
										
									}
								}
							},
							async: false
						});
					}

				});

				$('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
					if($(e.target).attr('href') == "#formulaire"){
						$("#formulaire").show();
						$("#liste").hide();
					} else {
						$("#formulaire").hide();
						listeVisiteToDay('','');
						$("#liste").show();

					}
					
				})
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
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
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}

				$('#listeNoire').on('click', function(e) {
		
					var iValue = $('#listeNoire').is(':checked');  

					switch (iValue) {
						case true:
							$("#isListeNoire").val('1');
							$("#motifListeNoir").show();
							break;

						case false:
							$("#isListeNoire").val('0');
							$("#motifListeNoir").hide();
							break;
					}
				});


				$("#submitVisiteur").on('click', function(e) {
						
						var iTestValid = 1 ; 
						var zMessage = "";
						var visiteur_nom = $("#visiteur_nom").val();
						var visiteur_prenom = $("#visiteur_prenom").val();
						var visiteur_cin = $("#visiteur_cin").val();
						var porte_id = $("#porte_id").val();
						var badge_id = $("#badge_id").val();
						var listeNoire = $("#isListeNoire").val();
						var visiteur_motifs = $("#visiteur_motifs").val();

						var visiteur_permis = $("#visiteur_permis").val();
						var visiteur_autreIntitule = $("#visiteur_autreIntitule").val();
						var visiteur_autreValue = $("#visiteur_autreValue").val();


						
						if (document.getElementById('iNeantNom').checked == false){
							if (visiteur_nom == '' || visiteur_nom ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le nom du visiteur\n" ; 
							}
						}

						if (document.getElementById('iNeantPrenom').checked == false){
							if (visiteur_prenom == '' || visiteur_prenom ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le prénom du visiteur\n" ; 
							}
						}


						if ((document.getElementById('iNeantNom').checked == true) && (document.getElementById('iNeantPrenom').checked == true)){
							var iTestValid = 0 ; 
							zMessage += "- Nom ou Prénom est obligatoire\n" ; 
						}

						if (visiteur_cin == '' && visiteur_permis=='' && visiteur_autreValue=='') {
							var iTestValid = 0 ; 
							zMessage += "- Veuillez remplir le CIN ou Permis ou autre pièce justificative du visiteur\n" ; 
						}


						if (visiteur_cin != '') {
							var zCinValue = $( "#visiteur_cin" ).val();
							var iRes = zCinValue.replace(/[^0-9]/g, '');
							iRes = iRes.trim();
							if (iRes.length != 12) {
								zMessage += "- Veuillez remplir convenablement le CIN (9 chiffres)\n" ; 
							}
						}

						if (visiteur_autreIntitule != '' && visiteur_autreValue == '') {
							var iTestValid = 0 ; 
							zMessage += "- Veuillez remplir le numéro de '"+ visiteur_autreIntitule +"' \n" ; 
						}


						var bValueListeNoire = $('#listeNoire').is(':checked');  

						if (bValueListeNoire == false){

							if (badge_id == '' || badge_id ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez sélectionner un badge\n" ; 
							}

							
							if (porte_id == '' || porte_id ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le nom de la porte\n" ; 
							}
						}

						if (iTestValid == 1) {

									$.ajax({
										url: "{/literal}{$zBasePath}{literal}sau/save/gestion-visiteur/espace-echange" ,
										method: "POST",
										data: { visiteur_nom:visiteur_nom, visiteur_prenom: visiteur_prenom, visiteur_cin:visiteur_cin,porte_id:porte_id, badge_id:badge_id, listeNoire:listeNoire,visiteur_motifs:visiteur_motifs, visiteur_permis:visiteur_permis,visiteur_autreIntitule:visiteur_autreIntitule,visiteur_autreValue:visiteur_autreValue},
										success: function(data, textStatus, jqXHR) {
											
											$("#visiteur_nom").val('');
											$("#visiteur_prenom").val('');
											$("#visiteur_cin").val('');
											$("#porte_id").val('');
											$("#badge_id").val('');
											$("#zCandidatInfo").val('');
											$("#visiteur_motifs").val('');
											$("#visiteur_permis").val('');
											$("#visiteur_autreIntitule").val('');
											$("#visiteur_autreValue").val('');
											$("#motifListeNoir").hide();
											$('#listeNoire').removeAttr("checked");

											$("#visiteur_nom").removeAttr("disabled") ; 
											$("#visiteur_prenom").removeAttr("disabled") ; 
											$("#visiteur_cin").removeAttr("disabled") ; 

											$("#porte_id").select2("val", "");
											$("#badge_id").select2("val", "");

											if (data >= 1) {
												$("#countVisit").html(data);
											} 

											alert("Enregistrement effectué !");
										},
										async: false
									});

						} else {
							alert(zMessage);
						}
						
				});
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})

			
			{/literal}
		</script>
	</div>
	</div>
</section>
{include_php file=$zFooter}
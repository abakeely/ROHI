{include_php file=$zCssJs}
<input type="hidden" name="switchBadgePorte" id="switchBadgePorte" value="1">
<input type="hidden" name="isListeNoire" id="isListeNoire" value="0">
<input type="hidden" name="iRechercheId" id="iRechercheId" value="1">
{include_php file=$zHeader}
<div id="container">
 <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<div class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state navbar1">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				{include_php file=$zTileHeader}
			</div><!-- /.navbar-container -->
		</div>
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
				</div><!-- /.sidebar-shortcuts -->

				<!---- MENU ------------->
				{include_php file=$zSousHeader}
				<!---- FIN MENU --------->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon la la-angle-double-left ace-save-state" data-icon1="ace-icon la la-angle-double-left" data-icon2="ace-icon la la-angle-double-right"></i>
				</div>
			</div>

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
												<span id="titleVisiteur">Liste des visiteurs ajoutés aujourd'hui</span>
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
													<h2 style="margin: 0px -10px -4px -22px;">
														<i class="ace-icon la la-tint"></i>
														Formulaire ajout visiteur
													</h2>
												</div>
												
												<div class="widget-body">
													
													<div class="widget-main">
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">CIN *:</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input  style="width: 150px;" id="visiteur_cin" name="visiteur_cin" type="text" class="input-small" />
															</div>
														</div>

														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Nom * :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker" > 
																<input  style="width: 500px;text-transform:uppercase!important;" type="text" id="visiteur_nom" name="visiteur_nom" class="input-small" />
																
															</div>
															
														</div>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Pr&eacute;nom * :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input  style="width: 400px;" id="visiteur_prenom" name="visiteur_prenom" type="text" class="input-small" />
																
															</div>
														</div>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Porte :</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input style="width:100px!important;font-size:13px" placeholder="Veuillez rechercher une porte" type="text" id="porte_id" name="porte_id">
															</div>
														</div>
														<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Badge *:</label>
														</div>

														<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input style="width:100px!important;font-size:13px" placeholder="Veuillez rechercher un badge" type="text" id="badge_id" name="badge_id">
															</div>
														</div>
														<div class="control-group">
															<div class="clearfix">
																<label for="colorpicker1" style="font-size:13px;"><input type="checkbox" style="height:20px;width:20px;vertical-align:bottom" id="autreInfo" name="autreInfo" value="1">&nbsp;&nbsp;&nbsp; Autres informations</label>
																
															</div>
														</div>
														<!----------------->
																
														<div style="display:none" id="divAutreInfo">
															<div class="widget-box widget-color-dark">
																<div class="widget-header" style="margin-right:0px;margin-bottom:-20px;margin-left:0px!important;">
																	<h5 class="widget-title bigger lighter">Autres informations</h5>
																</div>

																<div class="widget-body">
																	<div class="widget-main">
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Permis de conduire :</label>
																	</div>

																	<div class="control-group">
																		<div class="bootstrap-colorpicker"> 
																			<input  id="visiteur_permis" name="visiteur_permis" type="text" class="input-small" />
																		</div>
																	</div>
																	<div class="clearfix">
																		<label for="colorpicker1" style="font-size:13px">Autres pièces justificatives:</label>
																	</div>
																	<div class="control-group">
																		<div class="bootstrap-colorpicker"> 
																			<span style="color: #3d423e;font-size:13px">Intitulé : </span><input  style="width: 30%;" id="visiteur_autreIntitule" name="visiteur_autreIntitule" type="text" class="input-small" />
																			<span style="color: #3d423e;font-size:13px">&nbsp;&nbsp;Numéro : </span><input  style="width: 30%;" id="visiteur_autreValue" name="visiteur_autreValue" type="text" class="input-small" />
																		</div>
																	</div>
																	</div>
																</div>
																
															</div>
														</div>

														<!------------------>

															<div class="clearfix" >
																<label>
																<input name="form-field-checkbox" id="listeNoire" style="height:20px;width:20px;vertical-align:bottom" name="listeNoire" type="checkbox" />&nbsp;&nbsp;&nbsp; 
																<span class="lbl" style="font-size:13px"> Ajouter à la liste noire </span>
																</label>
															</div>
															<div id="motifListeNoir" style="display:none;margin-left:10px;">
															<div class="clearfix">
															<label for="colorpicker1" style="font-size:13px">Motifs Liste noire * :</label>
															</div>

															<div class="control-group">
															<div class="bootstrap-colorpicker"> 
																<input style="width:90%" type="text" id="visiteur_motifs" name="visiteur_motifs" class="input-small" />
															</div>
															</div>
														</div>

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
														<button class="btn btn-inverse btn-primary ajoutPorte" type="button">
															<i class="ace-icon la la-pencil align-top "></i>
															Ajout porte
														</button>
														<button class="btn btn-inverse btn-primary ajoutBadge" type="button">
															<i class="ace-icon la la-pencil align-top"></i>
															Ajout Badge
														</button>
													</div>
												</div>
											</div>
										</div>
										</form>
								<!------------------------------- fin formualrei d'ajout ---------------------------->
								<div id="liste">
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
		<p class="hidden" id="AucunResultat">Aucun resultat trouvé, verifiez si le badge est déjà sorti ou rendu! :p</p>
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
		<style>
						
				#loading4 #innerCircle
				{
					display:block;
					position:absolute;
					margin:20px 0 0 20px;
					
					width:40px;
					height:40px;
					border-top:7px solid #06F;
					border-bottom:7px solid #06F;
					border-left:7px solid transparent;
					border-right:7px solid transparent;
					
					border-radius:40px;
					-moz-border-radius:40px;
					-webkit-border-radius:40px;
					-ms-border-radius:40px;
					-o-border-radius:40px;
					
					box-shadow:0 0 20px #06F;
					-webkit-box-shadow:0 0 20px #06F;
					-moz-box-shadow:0 0 20px #06F;
					-ms-box-shadow:0 0 20px #06F;
					-o-box-shadow:0 0 20px #06F;
					
					-webkit-animation: ccwSpin .555s linear .2s infinite;
					-moz-animation: ccwSpin .555s linear .2s infinite;
					-o-animation: ccwSpin .555s linear .2s infinite;
					-ms-animation: ccwSpin .555s linear .2s infinite;
					animation: ccwSpin .555s linear .2s infinite;
				}
				#loading4 #outerCircle1
				{
					display:block;
					position:absolute;
					margin:0 auto;

					width:80px;
					height:80px;
					border-top:7px solid #06F;
					border-bottom:7px solid transparent;
					border-left:7px solid transparent;
					border-right:7px solid 06F;
					
					border-radius:80px;
					-moz-border-radius:80px;
					-webkit-border-radius:80px;
					-ms-border-radius:80px;
					-o-border-radius:80px;
					
					-webkit-animation: cwSpin 1s linear .2s infinite;
					-moz-animation: cwSpin .666s linear .2s infinite;
					-o-animation: cwSpin .666s linear .2s infinite;
					-ms-animation: cwSpin .666s linear .2s infinite;
					animation: cwSpin .666s linear .2s infinite;
				}
				
				#loading4 #innerCircle
				{
					
					border-top:7px solid transparent;
					border-bottom:7px solid #06F;
					border-left:7px solid #06F;
					border-right:7px solid transparent;
					
					box-shadow:none;
					-moz-box-shadow:none;
					-ms-box-shadow:none;
					-o-box-shadow:none;
					-webkit-box-shadow:none;
				}

				@-webkit-keyframes cwSpin
				{
					0%{-webkit-transform:rotate(0deg);	}
					100%{-webkit-transform:rotate(360deg); }
				}
				@-moz-keyframes cwSpin
				{
					0%{-moz-transform:rotate(0deg);	}
					100%{-moz-transform:rotate(360deg); }
				}
				@-ms-keyframes cwSpin
				{
					0%{-ms-transform:rotate(0deg);	}
					100%{-ms-transform:rotate(360deg); }
				}
				@-o-keyframes cwSpin
				{
					0%{-o-transform:rotate(0deg);	}
					100%{-o-transform:rotate(360deg); }
				}
				@keyframes cwSpin
				{
					0%{transform:rotate(0deg);	}
					100%{transform:rotate(360deg); }
				}

				@-webkit-keyframes ccwSpin
				{
					0%{-webkit-transform:rotate(0deg);	}
					100%{-webkit-transform:rotate(-360deg); }
				}
				@-moz-keyframes ccwSpin
				{
					0%{-moz-transform:rotate(0deg);	}
					100%{-moz-transform:rotate(-360deg); }
				}
				@-ms-keyframes ccwSpin
				{
					0%{-ms-transform:rotate(0deg);	}
					100%{-ms-transform:rotate(-360deg); }
				}
				@-o-keyframes ccwSpin
				{
					0%{-o-transform:rotate(0deg);	}
					100%{-o-transform:rotate(-360deg); }
				}
				@keyframes ccwSpin
				{
					0%{transform:rotate(0deg);	}
					100%{transform:rotate(-360deg); }
				}
				
				
				.input-group-addon .fa {
					margin: 0px!important;
					position: static;
					height: 0px;
					width: inherit;
					font-size: 15px;
					padding-right: 11px;
				}

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

				$( "#visiteur_permis" ).focusout(function() {
					$( "#visiteur_nom" ).focus();
				})

				$( "#visiteur_autreIntitule" ).focusout(function() {
					$( "#visiteur_autreValue" ).focus();
				})

				$( "#visiteur_autreValue" ).focusout(function() {
					$( "#visiteur_nom" ).focus();
				})

				$('#porte_id').on('focus,blur,change', function(e){
					$( "#badge_id" ).focus();
				});

				$('#badge_id').on('focus,blur,change', function(e){
					$( "#submitVisiteur" ).focus();
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
				
				$( ".ajoutPorte" ).on('click', function(event) {
					
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
				$("#liste").html('<div id="beforeSend" style="height : 150px; margin-left: 40%;margin-top: 3%;display:block;"><span>Veuillez patienter....</span><br><br><span id="loading4" style="display:block;"><span id="outerCircle1"></span><span id="innerCircle"></span></span></div>');
				var zDateDebut = _zDateDebut ; 
				var zDateFin   = _zDateFin ; 
				$.ajax({
					url: "{/literal}{$zBasePath}{literal}sau/listeVisiteToDay?sdsdsds" ,
					method: "POST",
					data: {zDateDebut:zDateDebut, zDateFin:zDateFin},
					success: function(data, textStatus, jqXHR) {
						var oReturn = jQuery.parseJSON(data);
						$("#liste").html(oReturn.zFormListeVisiteur);
						$("#countVisit").html(oReturn.iCount);
						$("#liste").show();
					},
					async: true
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

				$("#visiteur_cin").focus();

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
					formatNoMatches: function () { return $("#AucunResultat").html(); },
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
						$("#visiteur_cin").focus();
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

				$('#autreInfo').on('click', function(e) {

					var iValue = $('#autreInfo').is(':checked');  

					switch (iValue) {
						case true:
							$("#divAutreInfo").show();
							break;

						case false:
							$("#divAutreInfo").hide();
							break;
					}
				});
			

				$('html').keypress(function(e){
					if( e.which == 13 ){
						$("#submitVisiteur").click();
						return false;
					}
				});


				$("#submitVisiteur").click(function() {
						
						
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
						var idSelect = $("#idSelect").val();


						
						/*if (document.getElementById('iNeantNom').checked == false){
							if (visiteur_nom == '' || visiteur_nom ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le nom du visiteur\n" ; 
							}
						}*/

						if (visiteur_nom == '' || visiteur_nom ==0) {
							var iTestValid = 0 ; 
							zMessage += "- Veuillez remplir le nom du visiteur\n" ; 
						}

						/*if (document.getElementById('iNeantPrenom').checked == false){
							if (visiteur_prenom == '' || visiteur_prenom ==0) {
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le prénom du visiteur\n" ; 
							}
						}*/


						/*if ((document.getElementById('iNeantNom').checked == true) && (document.getElementById('iNeantPrenom').checked == true)){
							var iTestValid = 0 ; 
							zMessage += "- Nom ou Prénom est obligatoire\n" ; 
						}*/

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

						if (bValueListeNoire == true){
							if (visiteur_motifs == ''){
								var iTestValid = 0 ; 
								zMessage += "- Veuillez remplir le motif \n" ; 
							}
						}

						if (iTestValid == 1) {

									$.ajax({
										url: "{/literal}{$zBasePath}{literal}sau/save/gestion-visiteur/espace-echange" ,
										method: "POST",
										data: { idSelect:idSelect,visiteur_nom:visiteur_nom, visiteur_prenom: visiteur_prenom, visiteur_cin:visiteur_cin,porte_id:porte_id, badge_id:badge_id, listeNoire:listeNoire,visiteur_motifs:visiteur_motifs, visiteur_permis:visiteur_permis,visiteur_autreIntitule:visiteur_autreIntitule,visiteur_autreValue:visiteur_autreValue},
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
											$("#isListeNoire").val('');

											$("#visiteur_nom").removeAttr("disabled") ; 
											$("#visiteur_prenom").removeAttr("disabled") ; 
											$("#visiteur_cin").removeAttr("disabled") ; 

											$("#porte_id").select2("val", "");
											$("#badge_id").select2("val", "");
											$("#idSelect").val('');

											if (data >= 1) {
												$("#countVisit").html(data);
											} 

											alert("Enregistrement effectué !");
										},
										async: false
									});

						} else {
							alert(zMessage);
							$( "#dialog" ).dialog( "close" );
							return false;
							
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
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
{include_php file=$zFooter}
</div>

</body>
</html>
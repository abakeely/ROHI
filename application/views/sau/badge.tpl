{include_php file=$zCssJs}
<input type="hidden" name="switchBadgePorte" id="switchBadgePorte" value="1">
<input type="hidden" name="isListeNoire" id="isListeNoire" value="0">
<input type="hidden" name="iUserId" id="iUserId" value="">
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
														<li class="active">Agent en situation irregulière</li>
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

												<div class="row" id="liste">
													<div class="col-xs-12">
														
														<div class="clearfix">
															<div class="pull-right tableTools-container"></div>
														</div>
														<div class="table-header">
															Agents en situation irregulière
														</div>

														<!-- div.table-responsive -->
														
														<input type="hidden" name="idSelect" id="idSelect" value="">
														<div class="col-xs-12" style="padding-right:0px;" id="formulaire" style="display:block;">
															<div class="widget-box">
																<div class="widget-header">
																	<h4 class="widget-title">
																		<i class="ace-icon la la-tint"></i>
																		Formulaire Badge provisoire
																	</h4>
																</div>
																
																<div class="widget-body">
																	<div class="widget-main" style="padding-left:5%">
																		<br/>
																		<div class="clearfix">
																			<label for="colorpicker1" style="font-size:13px">MATRICULE *:</label>
																		</div>
																		
																		<div class="control-group">
																			<div class="bootstrap-colorpicker"> 
																				<input  style="width: 20%;" id="agent_matricule" name="agent_matricule" type="text" class="input-small" />
																			</div>
																		</div>
																		<br/>
																		<div class="clearfix">
																			<label for="colorpicker1" style="font-size:13px">CIN * :</label>
																		</div>

																		<div class="control-group">
																			<div class="bootstrap-colorpicker" > 
																				<input  style="width: 20%;text-transform:uppercase!important;" type="text" id="agent_cin" name="agent_cin" class="input-small" />
																				
																			</div>
																			
																		</div>
																		<br/>
																		<div class="clearfix">
																			<label for="colorpicker1" style="font-size:13px">Nom et Prénom * :</label>
																		</div>
																		<div class="control-group">
																			<div class="bootstrap-colorpicker"> 
																				<input  style="width: 40%;" id="agent_nom" name="agent_nom" readonly="readonly" type="text" class="input-small" />
																				
																			</div>
																		</div>
																		<div id="photo" class="control-group">
																			
																		</div>

																		<br/>
																		<div class="clearfix">
																			<label for="colorpicker1" style="font-size:13px">Badge *:</label>
																		</div>

																		<div class="control-group">
																			<div class="bootstrap-colorpicker"> 
																				<input style="width:10%;font-size:13px" placeholder="Veuillez rechercher un badge" type="text" id="badge_id" name="badge_id">
																			</div>
																		</div>
																		<br/>
																		<br/>
																	</div>
																	<div class="" style="margin-bottom:0px;">
																		<button class="btn btn-info" style="margin:10px 0 10px 60px;" id="submitVisiteur" type="button">
																			<i class="ace-icon la la-check bigger-110"></i>
																			Valider
																		</button>
																	</div>
																</div>
																
															</div>
															<div class="widget-body">
																<div id="getTableBadge">			
																</div>
															</div>
														</div>
														
														<!-- div.dataTables_borderWrap -->
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
					
        </div>
		<!-- /Page Wrapper -->
		<div id="dialog" title="Dialog Title"></div>
		<p class="hidden" id="AucunResultat">Aucun resultat trouvé, verifiez si le badge est déjà sorti ou rendu! :p</p>
	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

		<!-- basic scripts -->

		<!--[if !IE]> -->
		
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="{$zBasePath}assets/sau/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{$zBasePath}assets/sau/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="{$zBasePath}assets/sau/js/jquery.dataTables.min.js"></script>
<script src="{$zBasePath}assets/sau/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="{$zBasePath}assets/sau/js/dataTables.buttons.min.js"></script>
<script src="{$zBasePath}assets/sau/js/jquery-ui.min.js"></script>
<script src="{$zBasePath}assets/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$zBasePath}assets/sau/app/js/app/select2.min.js"></script>
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

table {
font-size:1.4em!important;
}
#innerContent h4 {
    font-size: 1.3em!important;
    padding-bottom: 15px!important;
    padding-top: 0!important;
}

#innerContent h4 {
    text-transform: uppercase!important;
    padding: 10px 0 20px!important;
    color: #3d423e!important;
}

.widget-header {
	border-bottom: none!important;
    padding-top: 10px!important;
	margin:0!important;
	height:40px!important;
}
</style>
<script type="text/javascript">

			$("#agent_matricule").focus();
			$("#agent_matricule").mask("999 999");    
			$("#agent_cin").mask("999 999 999 999");    

			function getTableBadge(_iUserId) {

				var iUserId	 = eval(_iUserId);

				if (iUserId != '' || iUserId != 0 ){
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/GeTableBadge",
						method: "POST",
						data: { iUserId:iUserId},
						success: function(data, textStatus, jqXHR) {
							$("#getTableBadge").html(data);
						},
						async: false
					});
				}
			}
			$(document).ready (function ()
			{	
				
				getTableBadge(-1);

				$( "#agent_matricule" ).focusout(function() {
					var zMatriculeValue = $( "#agent_matricule" ).val();
					var iRes = zMatriculeValue.replace(/[^0-9]/g, '');
					iRes = iRes.trim();

					console.log( iRes.length );
					if (iRes.length == 6){
					
						$.ajax({
							url: "{/literal}{$zBasePath}{literal}sau/GetAgent?qqqq",
							method: "GET",
							data: { q:iRes},
							success: function(data, textStatus, jqXHR) {
								var oReturn = jQuery.parseJSON(data);
								if (oReturn.id > 0) {
									getTableBadge(oReturn.id);
									$("#iUserId").val(oReturn.id);
									$("#agent_nom").val(oReturn.text);
									$("#photo").html(oReturn.photo);
								} 
								if(oReturn.badgeNonRendu){
									$('#submitVisiteur').prop("disabled",true);
									alert("Cette personne n'a pas encore rendu le badge, vous ne pouvez pas valider");
								}else{
									if($('#submitVisiteur').is(':disabled'))
										$('#submitVisiteur').prop("disabled",false);
								}
							},
							async: false
						});
					}
				})

				$( "#agent_cin" ).focusout(function() {
					var zCinValue = $( "#agent_cin" ).val();
					var iRes = zCinValue.replace(/[^0-9]/g, '');
					iRes = iRes.trim();

					console.log( iRes.length );
					if (iRes.length == 12){
					
						$.ajax({
							url: "{/literal}{$zBasePath}{literal}sau/GetAgent?qqqq",
							method: "GET",
							data: { q:iRes},
							success: function(data, textStatus, jqXHR) {
								var oReturn = jQuery.parseJSON(data);
								if (oReturn.id > 0) {
									getTableBadge(oReturn.id);
									$("#iUserId").val(oReturn.id);
									$("#agent_nom").val(oReturn.text);
									$("#photo").html(oReturn.photo);
								} 
								if(oReturn.badgeNonRendu){
									$('#submitVisiteur').prop("disabled",true);
									alert("Cette personne n'a pas encore rendu le badge, vous ne pouvez pas valider");
								}else{
									if($('#submitVisiteur').is(':disabled'))
										$('#submitVisiteur').prop("disabled",false);
								}
							},
							async: false
						});
					}
				})


				// Link to open the dialog
				$( ".ModifNumBadge" ).click(function( ) {
					
					$("#dialog").html();
					var iAttributionId = $(this).attr("setId");
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}sau/getInfoNumBadge" ,
						type: 'POST',
						data: { iAttributionId:iAttributionId },
						success: function(data, textStatus, jqXHR) {
							
							$("#dialog").html(data);	
							$("#dialog").dialog( "open" );
							
							event.preventDefault();
						},
						async: false
					});
				});


				$("#submitVisiteur").click(function() {
						
						var iTestValid = 1 ; 
						var zMessage = "";
						
						var iUserId	 = $("#iUserId").val();
						var badge_id = $("#badge_id").val();
						
						if (iUserId == '' || iUserId ==0) {
							var iTestValid = 0 ; 
							zMessage += "- Veuillez entrer le CIN ou le Matricule de l'agent\n" ; 
						}

						if (badge_id == '' || badge_id==0) {
							var iTestValid = 0 ; 
							zMessage += "- Veuillez sélectionner un badge\n" ; 
						}

						if (iTestValid == 1) {

							$.ajax({
								url: "{/literal}{$zBasePath}{literal}sau/saveBadgeNumBadge" ,
								method: "POST",
								data: { iUserId:iUserId,iNumBadgeId:badge_id},
								success: function(data, textStatus, jqXHR) {
									getTableBadge(data);
									$("#iUserId").val('');
									$("#badge_id").val('');
									$("#agent_matricule").val('');
									$("#agent_cin").val('');
									$("#badge_id").select2("val", "");
									$("#agent_nom").val("");
									$("#photo").html("");

								},
								async: false
							});

						} else {
							alert(zMessage);
							$( "#dialog" ).dialog( "close" );
							return false;
						}
						
				});
				
				
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
		
			}) ;
				
		</script>
		{/literal}

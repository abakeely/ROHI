{include_php file=$zCssJs}
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<input type="hidden" name="switchBadgePorte" id="switchBadgePorte" value="1">
<input type="hidden" name="isListeNoire" id="isListeNoire" value="0">
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">Agents > Situation irrégulière</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Accueil</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">

								<!-- Here -->
								<div class="login-layout" style="min-height:500px!important;">
									<div class="main-container">
										<div class="main-content">
											<div class="row">
												<div class="col-sm-10 col-sm-offset-1">
													<div class="login-container" style="width:500px;">
														<div class="center" style="padding-top:50px">
															<h1 style="font-size:32px">
																<i class="ace-icon la la-users green"></i>
																<span class="white" id="id-text2">Gestion des visiteurs</span>
															</h1>
															<h4 class="blue" id="id-company-text">&copy; SAU / DRHA 2017</h4>
														</div>

														<div class="space-6"></div>

														<div class="position-relative">
															<div id="login-box" class="login-box visible widget-box no-border">
																<div class="widget-body">
																	<div class="widget-main">
																		<h4 class="blue lighter bigger">
																			<i class="ace-icon fa  fa-filter green"></i>
																			LOCALISATION POSTE
																		</h4>

																		<div class="space-6"></div>

																		<form method="POST" name="login" id="login" action="{$zBasePath}sau/login/gestion-visiteur/accueil/">
																			<fieldset>
																				<label class="block clearfix">
																					<span class="block input-icon input-icon-right">
																						<select id="iSiteId" name="iSiteId" class="form-control" placeholder="Username">
																							<option value="0">Veuillez s&eacute;l&eacute;ctionner</option>
																							{foreach from=$oData.toPoste item=toPoste }
																							<option value="{$toPoste.poste_id}">{$toPoste.poste_libelle}</option>
																							{/foreach}
																						</select>
																					</span>
																				</label>

																				<div class="space"></div>

																				<div class="clearfix">
																					<button type="button" class="width-35 pull-right btn btn-sm btn-primary btn-enter-login">
																						<i class="ace-icon la la-key"></i>
																						<span class="bigger-110">ENTRER</span>
																					</button>
																				</div>

																				<div class="space-4"></div>
																			</fieldset>
																		</form>
																		<div class="space-6"></div>
																	</div><!-- /.widget-main -->
																</div><!-- /.widget-body -->
															</div><!-- /.login-box -->
														</div>
													</div><!-- /.col -->
												</div><!-- /.row -->
											</div><!-- /.main-content -->
										</div><!-- /.main-container -->
									</div>
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

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="{$zBasePath}assets/js/jquery-2.1.4.min.js"></script>
		{literal}
		<style>
			.menu-rohi{
				display:none;
			}
		</style>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			$(document).ready (function ()
			{

				$( ".btn-enter-login" ).click(function( event ) {
					
					var iSiteId = $("#iSiteId").val();
					if (iSiteId == 0) {
						alert("Veuillez sélectionner votre localisation de poste");
					} else {
						$("#login").submit();
					}
				});
			
			});

		</script>
		{/literal}

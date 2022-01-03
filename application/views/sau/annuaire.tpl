{include_php file=$zCssJs}
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
															<a href="#">Annuaire agent MFB</a>
														</li>
														<li class="active">Liste</li>
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
														<div id="Grid"></div>
													</div>
												</div>
											</div><!-- /.row -->
										</div><!-- /.page-content -->
									</div>
								</div><!-- /.main-content -->
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

    <link href="{$zBasePath}assets/sau/themes/default-theme/ej.widgets.all.css?sdsds" rel="stylesheet" />
    <link href="{$zBasePath}assets/sau/themes/responsive-css/ej.responsive.css" rel="stylesheet" />


    <script src="{$zBasePath}assets/sau/scripts/jquery.easing.1.3.min.js"></script>
    <script src="{$zBasePath}assets/sau/scripts/jquery.globalize.min.js"></script>
    <script src="{$zBasePath}assets/sau/scripts/jsondata.min.js"></script>
    <script src="{$zBasePath}assets/sau/scripts/jsrender.min.js"></script>
    <script src="{$zBasePath}assets/sau/scripts/ej.web.all.js?sdfdfsd111"></script>
    <script src="{$zBasePath}assets/sau/scripts/properties.js" type="text/javascript"></script>
	<script type="text/javascript">
	{literal}
		
		$(function () {
            $("#Grid").ejGrid({
                dataSource: {/literal}{$oData.liste}{literal},
                commonWidth: 120,
                isResponsive: true,
				enableResponsiveRow: true,
                allowTextWrap : true,
                allowPaging: true,
				allowSorting: true,
				enableRowHover: true,
				enableHeaderHover: true,
				allowFiltering: true,
                toolbarSettings: {showToolbar: true, toolbarItems: [ej.Grid.ToolBarItems.Search] },
                columns: [
                                              { field: "matricule", headerText: "Matricule", textAlign: ej.TextAlign.Center, width: 60 },
                                              { field: "cin", headerText: "CIN", textAlign: ej.TextAlign.Center, width: 80},
                                              { field: "nom", headerText: "Nom", textAlign: ej.TextAlign.Center},
                                              { field: "prenom", headerText: "Prénom", textAlign: ej.TextAlign.Center },
											  { field: "lacalite_service", headerText: "Localité de service", textAlign: ej.TextAlign.Center },
											  { field: "porte", headerText: "Porte", textAlign: ej.TextAlign.Center , width: 50 }						  
                ]
            });
        });
	{/literal}
	</script>

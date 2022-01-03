{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">AUTRES ABSENCES</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Autres absences</li>
								</ul> *}
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{foreach from=$oData.oModuleActif item=oModuleActif }
									<h2>Accueil&nbsp;{$oModuleActif.module_libelle}</h1>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									<p>{$oModuleActif.module_descriptionPage}</p>
									
									{if $oData.iModuleId == 2}
										<ul>
											<li><a href="{$zBasePath}assets/Decret.pdf" style="color:blue;text-decoration:underline;" target="_blank">D&eacute;cret n° 2004-812 du 24 ao&ucirc;t 2004 fixant le r&eacute;gime des cong&eacute;s, des permissions et des autorisations d'absence des fonctionnaires.</a>&nbsp;&nbsp;&nbsp;
											<a id="zonemsbb" class="fade" rel="example_group" onmouseover="over()" onmouseout="out()" alt="starbox-MSBB" title="Cliquez pour agrandir">
												<i id="image2" style="display:inline-block;color:#0089DC;font-size:16px;" title="Modifier" alt="Modifier" class="la la-search"></i>
											</a>
											
											</li>
										</ul>
										<img id="image" src="{$zBasePath}assets/Decret-1.png" style="display:none;width:800px;z-index:10000;position:absolute">
									{/if}
								{/foreach}
								<link rel="stylesheet" href="{$zBasePath}assets/common/css/fullcalendar.min.css"/>
								<div id="calendar"></div>
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
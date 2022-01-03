{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Liste des Offres locales</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/menu/sfao/menu-principal">Menu principal</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/offre/sfao/divers-offres">Offres</a></li>
									<li class="breadcrumb-item">Offres locales</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div align="right">
									<a href="{$zBasePath}formation/offre/sfao/divers-offres" class="btn">Retour menu</a>
								</div>
								<div class="">

									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/page.css">
									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/portBox.css">
									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/pop/css/jquerysctipttop.css">

									<script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/jquery-ui-1.10.3.custom.min.js"></script>
									<script type="text/javascript" src="{$zBasePath}assets/common/css/formation/pop/js/portBox.slimscroll.min.js"></script>	


									<div class="">
										<br>
										<center>
											<table class="table table-striped table-bordered table-hover">
												<br>
												<tr>
													{assign var=i value=0}
													{if count ($oData.associer) > 0}
														{foreach from=$oData.associer  item=oAssocier}
															{assign var=i value=$i+1}
																<td class="zoom" align="center">
																	<br>
																	<a href="#" data-display="liste{$i}">
																		<img src="{$zBasePathBo}{$oAssocier.associer_photo}" width="250px" height="220px">
																		<a href="#" data-display="liste{$i}" class="field" style="color: white !important; "><button style="margin: 60px 0px; font-size: 12px; font-weight: bold; margin: 15px 5px !important">{$oAssocier.associer_sigle}</button></a>
																	</a>

																	<div id="liste{$i}" class="portBox" >
																		<div class="project">
																			<div class="project-info">
																				<div class="row col-md-8">
																					<table class="table table-bordered table-hover dataTable no-footer">
																						<thead>
																							<tr>
																								<th  style="text-align:center">Déscription</th>
																								<th  style="text-align:center">Fichier</th>
																							</tr>
																						</thead>
																						<tbody>
																							{foreach from=$oData.contenuformation  item=oContenu}	
																							
																								{if $oContenu.contenuformation_associerId == $oAssocier.associer_id}
																								<tr>
																									<td>{$oContenu.contenuformation_titre}</td>
																									<td class="zoom1" align="center">
																										<a title="Télécharger" href="{$zBasePathBo}{$oContenu.contenuformation_fichier_pdf}">
																											<img src="{$zBasePath}assets/img/img_sfao/down.png"  target="_blank" title="Télécharger le fichier" width="70px">
																										</a>
																									</td>
																								</tr>
																								{/if}
																							{/foreach}
																						</tbody>
																					</table>
																				</div>
																			<!-- Project Info Close --> 
																			</div>
																		<!-- Project Close --> 
																		</div>

																	</div>
																	<div class="panel-footer" style="display:none"></div>
																				
																</td>
															{if $i%4==0}</tr>{/if}
														{/foreach}
													{else}
														<br><br><br><br><br><br><br><br><br>
														<h3>AUCUNE &nbsp;&nbsp;&nbsp;&nbsp;INFORMATION &nbsp;&nbsp;&nbsp;&nbsp; DISPONIBLE</h3>
													{/if}
											</table> 
										</center>
									</div>
								</div>
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

{literal}

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

{/literal}

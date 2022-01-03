{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Revue de Presse</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Revue de Presse</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="row">
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
								<div class="SSttlPage">

									<h2>Bienvenue&nbsp;dans l'espace revue de presse</h2>
									<p>Souhaitez-vous connaître les actualités du MEF, vous êtes au bon endroit ! Les derniers communiqués sont là!</p>

								</div>
								
								
								<div class="contenuePage">
									<!--*Debut Contenue*-->

									<div class="tabs section" id="RevueBlock">


										<ul class="nav nav-tabs " role="tablist">
										   {foreach from=$oData.toDistinctAnnee item=oDistinctAnnee }
												<li style="" {if ($oDistinctAnnee.iAnnee==$oData.zDateEnCours|date_format:"%Y"|intval)} class="active"{/if}><a href="#centerPar_tabshome{$oDistinctAnnee.iAnnee}" role="tab" data-toggle="tab">{$oDistinctAnnee.iAnnee}</a></li>
											{/foreach}
										</ul>

										<!-- Tab panes -->
										{if sizeof($oData.toListe)>0}
										<div class="tab-content" >
											
											{assign var=iiiTest value=111}
											{foreach from=$oData.toDistinctAnnee item=oDistinctAnnee }
												{if ($iiiTest!=111)}
													</div>
													</div>
													</div>
													</div>
													</div>
													</div>
													</div>
													</div>
												{/if}
											<div class="tab-pane {if ($oDistinctAnnee.iAnnee==$oData.zDateEnCours|date_format:"%Y"|intval)}active{/if}" id="centerPar_tabshome{$oDistinctAnnee.iAnnee}">
												<div class="2 parsys">
													<div class="accordion section">

														<div class="panel-group" id="accordioncenterPar_tabs_content_par_{$oDistinctAnnee.iAnnee}_accordion">
														   

																{foreach from=$oData.toDistinctMois item=oDistinctMois }

																{assign var=iTestMois value=100000000}
																{assign var=iTestAnnee value=10000000}

																{assign var=iTestInitial value=0}
																{foreach from=$oData.toListe item=toListe}
																{assign var=iiiTestIncrement value=0}
																{assign var=zDateTest value=$toListe.revueCommunique_date|date_format:"%m"}
																{assign var=zDateTest2 value=$toListe.revueCommunique_date|date_format:"%Y"}

																{if ($iTestMois!=$zDateTest) and ($iTestAnnee!=$zDateTest2)}
																{assign var=iTestMois value=$zDateTest}
																{assign var=$iTestAnnee value=$zDateTest2}

																{if ($zDateTest==$oDistinctMois.iMonth) && ($zDateTest2==$oDistinctAnnee.iAnnee)}
																{if ($iiiTest!=$oDistinctAnnee.iAnnee)}
																{assign var=iiiTest value=$oDistinctAnnee.iAnnee}
																{else}
																	</ul>
																	</div>
																	</div>
																	</div>
																	</div>
																	</div>
																	
																{/if}
																<div class="panel panel-default">
																<div class="panel-heading">
																	<h4 class="panel-title">
																		<a data-toggle="collapse" {if ($oDistinctMois.iMonth==$oData.zDateEnCours|date_format:"%m"|intval)  and ($oDistinctAnnee.iAnnee==$oData.zDateEnCours|date_format:"%Y"|intval)}class="active collapsed"{else}class="active collapsed"{/if} data-parent="#accordioncenterPar_tabs_content_par_{$oDistinctAnnee.iAnnee}_accordion" href="#collapsecenterPar_tabs_content_par_2_accordionhome{$oDistinctAnnee.iAnnee}{$oDistinctMois.iMonth}">{$oDistinctMois.zMonth|utf8}</a>
																	</h4>
																</div>

																<div id="collapsecenterPar_tabs_content_par_2_accordionhome{$oDistinctAnnee.iAnnee}{$oDistinctMois.iMonth}" class="panel-collapse collapse {if ($oDistinctMois.iMonth==$oData.zDateEnCours|date_format:"%m"|intval)  and ($oDistinctAnnee.iAnnee==$oData.zDateEnCours|date_format:"%Y"|intval)}in{/if}">
																	<div class="panel-body">
																		<div class="parsys Pane_one_title0"><div class="parbase section list">
																			<div class="liststyle4">
																				<ul>
																{/if}
																{/if}
																{if ($zDateTest==$oDistinctMois.iMonth) && ($zDateTest2==$oDistinctAnnee.iAnnee)}
																<li>
																<a target="_blank" style="cursor:pointer;" href="{$zBasePath}assets/accueil/upload/{$toListe.revueCommunique_fichier}"> {$toListe.revueCommunique_titre}</a>
																</li>
																{/if}
																{assign var=iTestInitial value=1}
																{assign var=iiiTestIncrement value=1}
																{/foreach}

																{/foreach}                    
																			   
															</ul>
														</div>
														</div>
														</div>
														</div>
														</div>	
														</div>
														<div style="clear: both"></div>
														</div>
													</div>
												</div>
											</div>
										{/foreach}
										<!-- viva -->
									</div>
									{/if}

									<!--*Fin Contenue*-->
								</div>
							</div>
					</div></div>
				</div>
			</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
{literal}
<style>
ul li a:hover {
    color: #353434!important;
}
</style>
{/literal}
{include_php file=$zFooter}
		
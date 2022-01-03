{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Image et Vidéos</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Image et Videos</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{literal}	
								<style>
									.carousel-control.left, .carousel-control.right {
										background-image: none
									}
								</style>
								{/literal}

								<br>
								<!--*Debut Contenue*-->
								<div align="right">
									<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution" class="btn">Retour</a>
								</div>
								<div>
									<br><br>
									<div>
										<div id="carousel-documentaion1" class="carousel slide" data-ride="carousel">
											<div  class="a-section as-title-block">
												<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;" class="as-title-block-left" role="heading">
													<div align="center">S&eacute;lection des photos de restitution</div></h3>
												</h3>
											</div>
											
											<!-- Indicators -->
											<ol class="carousel-indicators">
												{assign var=iIncrement value="1"}
												{foreach from=$oData.liste_groupe item=group}
													<li data-target="#carousel-documentaion1" data-slide-to="{$i}"class="{if $iIncrement==1}active{/if}"></li>
												{assign var=iIncrement value=$iIncrement+1}
												{/foreach}
											</ol>
											
											<!-- Wrapper for slides -->
											<div class="carousel-inner" role="listbox" style="text-align: center;">
											
												{assign var=iIncrement value="1"}
												{foreach from=$oData.liste_groupe item=group}
													<div class="item {if $iIncrement==1}active{/if}">
														{foreach from=$group item=row}
														<li class="list-image-restitution" data-sgproduct="" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
														<a href="{$zBasePath}documentation/detail_restitution_image/sad/detail-restitution/{$row->restitution_id}">
														<img class="style_prevu_kit" src="{$zBasePath}assets/img/img_sad/restitution/image/{$row->restitution_icone_image}"  border="0" height="200" width="240">
														</a>	
														<p>{$row->restitution_annee}</p>
														</li>
														{/foreach}
													</div>
												{assign var=iIncrement value=$iIncrement+1}
												{/foreach}
											</div>

											<!-- Controls -->
											<a class="left carousel-control" href="#carousel-documentaion1" role="button" data-slide="prev">
												Precedent
											</a>
											<a class="right carousel-control" href="#carousel-documentaion1" role="button" data-slide="next">
												Suivant
											</a>
										</div>
										<br>
										
										<div class="row">
											<h3 style=" border-bottom: none; important! font-size: 1.1em; font-weight: bold; font-family: Lato;">
												<div align="center">S&eacute;lection des videos de restitution</div>
											</h3>
											
											<!-- Controls -->
											<div id="carousel-documentaion2" class="carousel slide" data-ride="carousel">	
												<ol class="carousel-indicators">
													{assign var=iIncrement value="1"} 
													{foreach from=$oData.liste_groupe item=group}
														<li data-target="#carousel-documentaion1" data-slide-to="{$i}"class="{if $iIncrement==1}active{/if}"></li>
													{assign var=iIncrement value=$iIncrement+1}
													{/foreach}
												</ol>
											
												<!-- Wrapper for slides -->
												<div class="carousel-inner" role="listbox" style="text-align: center;">
													{assign var=iIncrement value="1"} 
													{foreach from=$oData.liste_groupe item=group}
														<div class="item {if $iIncrement==1}active{/if}">
														{foreach from=$group item=row}
														<li class=" " data-sgproduct="" aria-setsize="18" aria-posinset="14" aria-hidden="false" role="listitem" style="display: inline-block;">
															<a href="{$zBasePath}documentation/detail_restitution_video/sad/detail-video/{$row->restitution_id}">
															<img  class="style_prevu_kit" src="{$zBasePath}assets/img/img_sad/restitution/video/{$row->restitution_icone_video}"  border="0" height="200" width="240">
															</a>
															<p>{$row->restitution_annee}</p>
														</li>
														{/foreach}
													</div>
													{assign var=iIncrement value=$iIncrement+1}
													{/foreach}	
												</div>
											
												<!-- Controls -->
												<a class="left carousel-control" href="#carousel-documentaion2" role="button" data-slide="prev">
													Precedent
												</a>
												<a class="right carousel-control" href="#carousel-documentaion2" role="button" data-slide="next">
													Suivant
												</a>
											</div>
										</div>
									</div>
								</div>

								<!--*Fin Contenue*-->
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
<style>
.list-image-restitution {
    width:200px;
}
</style>
{/literal}
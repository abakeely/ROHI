{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Album</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item">Formation</li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/programmeFormation/formation/programme-formation">Reporting</a></li>
									<li class="breadcrumb-item">Album</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">

									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/slide/css/bootstrap.css">
									<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/slide/css/flexslider.css">

									<br><br>

									<div class="container"> 
										<div id="slider">
											<div class="flexslider" align="center">
												<ul class="slides">
												{assign var=i value=0}
												{foreach from = $oData.photosfao item = oImg}
													<li>
													<img src="{$zBasePath}{$oImg.photo_url}" alt="" />
													</li>
												{if $i%3==0}{/if}
												{/foreach}
												</ul>
											</div>
										</div>
										<script src="{$zBasePath}assets/common/css/formation/slide/js/plugins.js"></script>
										<script src="{$zBasePath}assets/common/css/formation/slide/js/main.js"></script>
									</div>	

									<br><br>
									<section id="content">	
										<div id="innerContent">
											<div id="ContentBloc">
												<h2>Trombinoscope</h2>
												<br><br>
												<div id="slider">
													<div class="flexslider" align="center">
														<ul class="slides">
														{assign var=i value=0}
														{foreach from = $oData.trombinoscopesfao item = oImg}
															<li>
																<img src="{$zBasePath}{$oImg.photo_url}" alt="" />
															</li>
														{if $i%3==0}{/if}
														{/foreach}
														</ul>
													</div>
													<script src="{$zBasePath}assets/common/css/formation/slide/js/plugins.js"></script>
													<script src="{$zBasePath}assets/common/css/formation/slide/js/main.js"></script>
												</div>
											</div>
										</div>
									</section>
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
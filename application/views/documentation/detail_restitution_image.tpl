{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Images Restitution</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Images et Vidéos</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{literal}
								<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/slide/css/bootstrap.css">
								<link rel="stylesheet" href="{$zBasePath}assets/common/css/formation/slide/css/flexslider.css">
								{/literal}
								<br>
								<div align="right">	
									<a href="{$zBasePath}documentation/restitution/sad/video-annuel18/2018#carousel-documentaion1" class="btn">Retour</a>	
								</div>
								<br>

								<div class="container"> 
									<div id="slider">
										<div class="flexslider" align="center">
											<ul class="slides">
												{assign var=iIncrement value="1"}
												{foreach from=$oData.list_image item=img}
													<li><img src="{$zBasePath}assets/img/img_sad/restitution/image/{$img}" id="wows1_{$i}"/></li>	
													{assign var=iIncrement value=$iIncrement+1}
												{/foreach}			
											</ul>
											
										</div>
										
										<div class="ws_script" style="position:absolute;left:-99%"></div>
										<div class="ws_shadow"></div>
									</div>
									<script src="{$zBasePath}assets/common/css/formation/slide/js/plugins.js"></script>
									<script src="{$zBasePath}assets/common/css/formation/slide/js/main.js"></script>

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
{include_php file=$zCssJs}
<!-- Main Wrapper -->
	<div class="main-wrapper">
		{include_php file=$zHeader}

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Restitution : Images et Videos</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation">Archives et Documentations</a></li>
								<li class="breadcrumb-item">Restitution : Images et Videos</li>
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
								
								.style_prevu_kit
									{
										display:inline-block;
										border-radius: 20px;
										border:0;
										width:100%;
										height:230px;
										

									}
								.style_prevu_kit:hover
									{
										box-shadow: 0px 0px 150px #000000;
										
									}
								.style_prevu_kit a
									{
										outline:none;
									}
							
							</style> 
							{/literal}
							<br>
							<div align="right">
								<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution" class="btn">Retour</a>
							</div>
							<br><br><br>
							<div class="row">
								<div class="col-md-1"></div>
								<div class="col-md-10">
									<div class="row">
										<div class="col-md-3">
											<div class="style_prevu_kit" style="background-color:#FE642E;">
												<h3 style=" border-bottom: none; important! font-size: 1.5em; font-weight: bold; font-family: Lato;">
												<div align="center"><br><br><br><br>Images<br>et Videos </div></h3>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="style_prevu_kit" style="background-color:#FA8258;">
												<a href="{$zBasePath}documentation/restitution/sad/video-annuel18/2018">
												<h3 style=" border-bottom: none; important! font-size: 2em; font-weight: bold; font-family: Lato;">
												<div align="center"><br><br><br><br>2018</div></h3>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="style_prevu_kit" style="background-color:#F79F81;">
												<a href="{$zBasePath}documentation/restitution/sad/video-annuel17/2017">
												<h3 style=" border-bottom: none; important! font-size: 2em; font-weight: bold; font-family: Lato;">
												<div align="center"><br><br><br><br>2017</div></h3>
											</div>
										</div>
										
										<div class="col-md-3">
											<div class="style_prevu_kit" style="background-color:#F5BCA9;">
												<a href="{$zBasePath}documentation/restitution/sad/video-annuel16/2016">
												<h3 style=" border-bottom: none; important! font-size: 2em; font-weight: bold; font-family: Lato;">
												<div align="center"><br><br><br><br>2016</div></h3>
											</div>
										</div>
									</div>
								</div>
							<div class="col-md-1"></div>
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
{include_php file=$zCssJs}
<!-- Main Wrapper -->
	<div class="main-wrapper">
		{include_php file=$zHeader}

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Plan d'Acces</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation">Archives et Documentations</a></li>
								<li class="breadcrumb-item"><a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture">Informations Pratiques</a></li>
								<li class="breadcrumb-item">Plan d'Acces</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
						<div class="card-body">
							<br>
							<div align="right">
								<a href="{$zBasePath}documentation/info/sad/info-pratique-couverture" class="btn">Retour</a>
							</div>
							<br/> <br/>
							<div>
								<center>
								<a title=""> <img src="{$zBasePath}assets/img/plan_d_acces_sad_2018.jpg" border="0" height="830" width="720"></a>
								<br>
								</center>
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
	
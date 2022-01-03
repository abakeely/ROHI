{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Texte Reglementaire</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Texte Reglementaire</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
					{* <div id="breadcrumb">Fil d'ariane&nbsp;&nbsp;:&nbsp;&nbsp;<a href="{$zBasePath}">Accueil</a> <span>&gt;</span> 
					<a href="{$zBasePath}">RH</a> <span>&gt;</span> <a href="{$zBasePath}">Gestion des absences</a> <span>&gt;</span> Liste compte</div> *}
		
								{assign var=date_demande_livre value="date('d/m/Y')"}
								{assign var=theme_livre_edit value="0"}
								{assign var=auteur_livre_edit value="0"}
								{assign var=lieu_livre_edit value="0"}
								{assign var=langue_livre_edit value="0"}
								{assign var=id value=""}
								
								{assign var=titre_livre value=""}
								{assign var=cote_livre value=""}
								{assign var=edition_livre value=""}
								{assign var=format_livre value=""}
								{assign var=nombre_page_livre value=""}
								{assign var=nombre_explaire_livre value=""}
								{assign var=observation_livre value=""}
								
								{assign var=image_url value="base_url().'assets/upload_sad/default.jpg'"}
									
								<br>
								<div align="right">
									<a href="{$zBasePath}documentation/catalogueCouverture/documentation/catalogue-couverture" class="btn">Retour</a>
								</div>
								<br>	
								<table class="table table-striped table-bordered table-hover" id="table_loi">
								
								</table>
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
{include_php file=$zCssJs}
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">
									Textes de références{if $oData.iSessionCompte == COMPTE_AUTORITE || $oData.iSessionCompte == COMPTE_ADMIN}
									&agrave; finaliser
									{elseif $oData.iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
									&agrave; imprimer
									{/if}
								</!!-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}formation/menu/sfao/menu-principal">Menu principal</a></li>
									<li class="breadcrumb-item">Textes de références</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<!--div class="box"-->
							<!--div class="card-body"-->
								<!--div align="right">
									<a href="{$zBasePath}formation/offre/sfao/divers-offres" class="btn">Retour menu</a>
								</div-->
								<div class="">
									<div class="col-md-12">
										<br>
										<div class="row">
											<div id="refText" class="col-md-11" style="font-size:16px;"><br><br>
												{$oData.toGetAllData[0]->texte_contenu}
											</div>
										</div>
									</div>
								</div>
								<div id="calendar"></div>
							<!--/div-->
						<!--/div-->

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
#refText ul {
	list-style-type: square; color: rgb(103, 113, 10) !important;
}

#refText li {
	line-height:35px;
}

#refText a {
	color: rgb(103, 113, 10) !important;
}
</style>
{/literal}

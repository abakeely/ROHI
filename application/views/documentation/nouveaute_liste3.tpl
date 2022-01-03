{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Nouveautes (Nouveaux ouvrages)</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture">Nouveautes</a></li>
									<li class="breadcrumb-item">Nouveaux Ouvrages plus plus plus</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								{assign var=id value=""}
								{assign var=type_texte value=""}
								{assign var=sigle value=""}
								{assign var=date value=""}
								{assign var=intitule value=""}
								{assign var=lien value=""}

								<br>

								<div align="right">
									<a href="{$zBasePath}documentation/nouveaute_liste2/sad/collection-numerique-pdf-liste2" class="btn">Retour</a>
								</div><br>

								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3765"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.139.jpg" title="Comptabilité approfondie 2017/2018" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3763"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.011.jpg" title="Gestion des tests logiciels" border="0" height="220" width="140">
											</a>
										</td>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3761"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.002.jpg" title="Linux Maitrisez l'administration du système" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3762"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.006.jpg" title="Photoshop CC édition 2017" border="0" height="220" width="140">
											</a>
										</td>
										
										
										
										
									</tr>
									<!--1  -->
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3630"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.085.jpg" title="Droit constitutionnel 26e edition" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/3468"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.030.jpg" title="Savoir rediger" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/3519"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.033.jpg" title="Difficultés grammaticales" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3565"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.068.jpg" title="Le droit administratif" border="0" height="220" width="140">
												</a>
										</td>
											
									<tr>		
									</tr>		

										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3585"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.080.jpg" title="Droit budgétaire" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3618"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.083.jpg" title="Droit pénal et procédure pénale" border="0" height="220" width="140">
												</a>
										</td>
										
										
									</tr>

								</table>
								{/literal}
								<script type="text/javascript">

									$(document).ready(function() {	 
									$('#table_nouveau_liste').dataTable();
									});
								</script>		
								{/literal}

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
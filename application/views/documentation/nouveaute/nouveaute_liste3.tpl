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
									<li class="breadcrumb-item"><a href="{$zBasePath}">Archive et Documentation</a></li>
									<li class="breadcrumb-item">Nouveautes</li>
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
									.zoom {
									height:210px;
									margin:auto;
									}
									.zoom p {
									text-align:center;
									}
									.zoom img {
									width:180px;
									height:200px;
									}
									.zoom img:hover {
									width:460px;
									height:420px;
									}
								</style>
								{/literal}

								{assign var=id value=""}
								{assign var=type_texte value=""}
								{assign var=sigle value=""}
								{assign var=date value=""}
								{assign var=intitule value=""}
								{assign var=lien value=""}

								<br>
								<div id="content-wrap" class="row"> 
									<div align="right">
										<a href="{$zBasePath}documentation/pdf/sad/collection-numerique-pdf-liste2" class="btn">Retour</a>
									</div><br>
									<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
										<tr>

											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3786"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.092.jpg" title="DROIT ADMINISTRATIF GENERAL (5e édition)" border="0" height="220" width="140">
												</a>
											</td>
											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3787"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.093.jpg" title="LES EPREUVES DE DROIT PUBLIC AUX CONCOURS ADMINISTRATIFS" border="0" height="220" width="140">
												</a>
											</td>

											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3788"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.008.jpg" title="MECANIQUE AUTOMOBILE - ENTRETIEN GENERAL (2e édition)" border="0" height="220" width="140">
												</a>
											</td>
											
											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3789"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.009.jpg" title="LES RESEAUX POUR LES NULS (11e édition)" border="0" height="220" width="140">
												</a>
											</td>
											
											
											
											
										</tr>
										<!--1  -->
										<tr>

											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3790"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.142.jpg" title="LES STRATEGIES DES RESSOURCES HUMAINES" border="0" height="220" width="140">
												</a>
											</td>
											
											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3791"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.143.jpg" title="LA COMMUNICATION EXTERNE DES ENTREPRISES (4e édition)" border="0" height="220" width="140">
												</a>
											</td>
											
											<td class="zoom">
													<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3792"> 
														<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.144.jpg" title="LA GRH DANS LA FOCNTION PUBLIQUE" border="0" height="220" width="140">
													</a>
											</td>
											<td class="zoom">
													<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3793"> 
														<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.145.jpg" title="GUIDE DU PROTOCOLE ET DES USAGES" border="0" height="220" width="140">
													</a>
											</td>
												
										<tr>		
										</tr>		

											<td class="zoom">
													<a href="{$zBasePath}documentation/pret_livre/sad/pret-affairesocial/12/3794"> 
														<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.PAS.089.jpg" title="PLAN SECTORIEL de l'EDUCATION" border="0" height="220" width="140">
													</a>
											</td>
											<td class="zoom">
													<a href="{$zBasePath}documentation/pret_livre/sad/pret-affairesocial/12/3795"> 
														<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.PAS.090.jpg" title="POLITIQUE ENSEIGNANTE MADAGASCAR" border="0" height="220" width="140">
													</a>
											</td>
											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-affairesocial/12/3796"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.PAS.091.jpg" title="PLAN SECTORIEL DE L'EDUCATION (2018-2022)" border="0" height="220" width="140">
												</a>
											</td>
											
											<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-budget/6/3784"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.BDG.410.jpg" title="LOI DE FINANCES 2018 -LES ECHOS DES FINANCES ET DU BUDGET" border="0" height="220" width="140">
												</a>
											</td>
											<!--<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10/3785"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.TRS.208.jpg" title="GUIDE DE L'ADMINISTRATEUR DES SOCIETES ANONYMES A PARTICIPATION DE L'ETAT" border="0" height="220" width="140">
												</a>
											</td> -->
											
										</tr>

									</table>
								</div>
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
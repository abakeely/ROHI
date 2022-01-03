{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<!--h3 class="page-title">Nouveautes (Nouveaux ouvrages)</h3-->
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/infprat/sad/inf-prat">Archives et Documentations</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture">Nouveautes</a></li>
									<li class="breadcrumb-item">Nouveaux Ouvrages plus plus</li>
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
									<a href="{$zBasePath}documentation/nouveaute_liste3/sad/collection-numerique-pdf-liste3" class="btn">Voir Plus</a>
									<a href="{$zBasePath}documentation/nouveaute_liste1/sad/collection-numerique-pdf-liste2" class="btn">Retour</a>
								</div><br>

								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3768"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.010.jpg" title="Réseaux Informatiques - 7è édition" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3769"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.137.jpg" title="Les assises nationales du Financement du Long Terme" border="0" height="220" width="140">
											</a>
										</td>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3770"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.146.jpg" title="L'essentiel des Finances Publiques (4è édition)" border="0" height="220" width="140">
											</a>
										</td>
										<!-- mbola tsy vita !-->	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-banque/4/3771"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.BNQ.073.jpg" title="Bulletin de BFM" border="0" height="220" width="140">
											</a>
										</td>
									</tr>
									<!--1  -->
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/3772"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.093.jpg" title="Evaluer la performance economique, le bien-être et la soutenabilité" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/3773"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.094.jpg" title="La reveue MCI (2è trimestre 2017)" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10/3774"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.TRS.205.jpg" title="Exercices avec corrigés détaillés - comptabilité générale (15è édition)" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-politiqueeconomie/1/3775"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.POE.268.jpg" title="Rapport Economique et Financier 2016 - 2017" border="0" height="220" width="140">
												</a>
										</td>
											
									<tr>		
									</tr>		

										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3758"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.087.jpg" title="Droit du Commerce International" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/3760"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.067.jpg" title="Le Robert orthographe" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3759"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.088.jpg" title="Les principes généraux du droit administratif" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3764"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.138.jpg" title="Finances Publiques 2017" border="0" height="220" width="140">
											</a>
										</td>
										<!--<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10/3785"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.TRS.208.jpg" title="GUIDE DE L'ADMINISTRATEUR DES SOCIETES ANONYMES A PARTICIPATION DE L'ETAT" border="0" height="220" width="140">
											</a>
										</td> -->
										
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
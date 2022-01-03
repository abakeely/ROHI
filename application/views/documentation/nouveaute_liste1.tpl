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
									<li class="breadcrumb-item">Nouveaux Ouvrages plus</li>
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
									<a href="{$zBasePath}documentation/nouveaute_liste2/sad/collection-numerique-pdf-liste2" class="btn">Voir Plus</a>
									<a href="{$zBasePath}documentation/pdf/sad/collection-numerique-pdf-liste1" class="btn">Retour</a>
								</div><br>

								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10/3785"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.TRS.208.jpg" title="GUIDE DE L'ADMINISTRATEUR DES SOCIETES ANONYMES A PARTICIPATION DE L'ETAT" border="0" height="220" width="140">
											</a>
										</td> 
										
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3776"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.089.jpg" title="LA LETTRE ADMINISTRATIVE - GUIDE DE PRESENTATION ET DE REDACTION" border="0" height="220" width="140">
											</a>
										</td>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3777"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.090.jpg" title="M1 M2 COURS DALLOZ - DROIT DU COMMERCE INTERNATIONAL (2é édition)" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3778"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.004.jpg" title="MAINTENANCE ET DEPANNAGE D'UN PC EN RESEAU (5é édition)" border="0" height="220" width="140">
											</a>
										</td>
										
										
										
										
									</tr>
									<!--1  -->
									<tr>

										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3779"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.007.jpg" title="ILLUSTRATOR CC (édition 2007)" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3780"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.140.jpg" title="LE KIT DU CHEF DE PROJET (+ 20 000 PERSONNES FORMEES A LA METHODE 3P)" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/3781"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.141.jpg" title="COMMUNICATION INSTITUTIONNELLE" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-budget/6/3782"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.BDG.409.jpg" title="LE BUDGET DE L'ETAT" border="0" height="220" width="140">
												</a>
										</td>
											
									<tr>		
									</tr>		

										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-tresor/10/3783"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.TRS.207.jpg" title="GUIDE D'APPLICATION DES NORMES IAS/IFRS" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
												<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/3766"> 
													<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.091.jpg" title="Droit administratif génèral - Tome I 15è édition" border="0" height="220" width="140">
												</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/3767"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.005.jpg" title="Indesign CC (édition 2016)" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-budget/17/3768"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.010.jpg" title="Réseaux Informatiques - 7è édition" border="0" height="220" width="140">
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
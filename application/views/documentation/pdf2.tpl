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
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture">Nouveautés</a></li>
									<li class="breadcrumb-item">Nouveaux Ouvrages</li>
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
									<a href="{$zBasePath}documentation/pdf1/sad/collection-numerique-pdf" class="btn">Next</a>
									<a href="{$zBasePath}documentation/pdf/sad/collection-numerique-pdf" class="btn">Retour</a>
								</div><br>

								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<!--0  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.023.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.024.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-divers/17/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DVR.025.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-douane/7/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DOU.042.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.141.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.142.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.143.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<tr>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5163"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.120.jpg" title="GRANDS ARRETS:LES GRANDS ARRETS DE LA JURISPRUDENCE FINANCIERE " border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5164"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.121.jpg" title="CODE DE PROCEDURE CIVILE" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5165"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.122.jpg" title="CODE PETROLIER MALAGASY" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5166"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.123.jpg" title="CODE FONCIER" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5167"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.124.jpg" title="DROIT PENAL GENERAL MALGACHE (Le Delinquant les Sanctions de l'Infraction)" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5168"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.125.jpg" title="PROCEDURE PENALE TOME II" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5169"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.126.jpg" title="LOI CIVILES MALAGASY" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<tr>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5170"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.127.jpg" title="REVUE DE DROIT ET DE JURISPRUDENCE DE MADAGASCAR" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5174"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.128.jpg" title="DROIT PENALSPECIAL" border="0" height="220" width="140">
											</a>
										</td> 
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/5174"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.049.jpg" title="DICTIONNAIRE LAROUSSE DES SYNONYMES" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/5175"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.050.jpg" title="LAROUSSE ANGLAIS DICTIONNAIRE Fraçais-Anglais/Anglais-Français" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5157"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.157.jpg" title="MARKETING 4,0Le Passage au Digital" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5158"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.158.jpg" title="LE MANAGEMENT PUBLIC Organisation,Gestion et évaluation des politiques publiques" border="0" height="220" width="140">
											</a>
										</td> 	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5176"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.159.jpg" title="L'ART DES MEDIAS SOCIAUX" border="0" height="220" width="140">
											</a>
										</td>
									</tr>
									
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5177"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.160.jpg" title="LE NOUVEAU DROIT DES OBLIGATIONS 2è édition" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5178"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.161.jpg" title="MANAGEMENT/LEADERSHIP  CREATIVE ATTITUDE" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5179"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.162.jpg" title="LA BIBLE DE LA PETITE ENTREPRISE" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5180"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.163.jpg" title="DEVENIR LE MEILLEUR DE SOI-MEME" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5181"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.164.jpg" title="INTEGRITE MORALE ET VIE PUBLIQUE" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5182"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.165.jpg" title="90 JOURS POUR REUSSIR SA PRISE DE POSTE" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5183"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.166.jpg" title="L'EFFICACITE SANS STRESS  Mobiliser ses ressources pour mieux réussir" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5184"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.167.jpg" title="LE MARKETING DIGITAL pour LES NULS" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/5185"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.168.jpg" title="FINANCE 3e Edition" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/4426"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.047.jpg" title="L'ANTI-FAUTES DE FRANCAIS" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/13/5122"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DICO.048.jpg" title="DICTIONNAIRE DE LA CORRESPONDANCE DE TOUS LES JOURS" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/5125"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.099.jpg" title="NOUVELLES THEORIES ECONOMIQUES 3è édition" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/5126"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.100.jpg" title="L'ESSENTIEL DES MECANISMES DE L'ECONOMIE 6è édition" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/5127"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.101.jpg" title="L'ECONOMIE EN BD" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<!--5  -->
								</table>

								{literal}
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
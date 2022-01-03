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
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture">Nouveaux Ouvrages</a></li>
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
								</div><br>

								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<!--0  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.129.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.130.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.131.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.132.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.133.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.134.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>	
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.135.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<!--1  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.136.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.137.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.138.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.139.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.140.jpg" title="" border="0" height="220" width="140">
											</a>
										</td> 
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/8/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.141.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-dictionnaire/7/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DOU.041.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
									</tr> 

									<!--2  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/3/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.104.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/3/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.105.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.169.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.170.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.171.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.172.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.173.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<!--3  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.174.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.175.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.176.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.177.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.178.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.179.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom"> 
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.180.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
									</tr>

									<!--4  -->
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.181.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.182.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.183.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-gestion/11/"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.GST.184.jpg" title="" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/5160"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.102.jpg" title="L'ECONOMIE LA MICROECONOMIE EN BD" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-economie/3/5161"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.ECO.103.jpg" title="ECONOMIE INTERNATIONALE" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}documentation/pret_livre/sad/pret-droit/8/5162"> 
												<img class="p" id="cat_politique" src="{$zBasePath}assets/img/img_sad/nouv_/II.DRT.119.jpg" title="L'INDIVIDU FACE A LA LOI et aux PROBLEMES JURIDIQUES INHERENTS A LA VIE COURANTE" border="0" height="220" width="140">
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
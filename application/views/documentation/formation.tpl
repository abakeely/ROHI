{include_php file=$zCssJs}
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Liste des nouveaux ouvrages</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation">Archives et Documentations</a></li>
									<li class="breadcrumb-item">Nouveaux ouvrages</li>
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
									height:150px;
									margin:auto;
									}
									.zoom p {
									text-align:center;
									}
									.zoom img {
									width:200px;
									height:225px;
									}
									.zoom img:hover {
									width:230px;
									height:240px;
									}
								</style> 
								{/literal}
										
								<br>
								<div align="right">
									<a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture" class="btn">Retour</a>
								</div>
								
								<table class="table table-striped table-bordered table-hover" id="table_nouveau_liste">
									<tr>
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-commmarketing/1"> 
												<img class="normal" src="{$zBasePath}assets/img/img_sad/nouv_/comm_marketing.jpg" title="Communication Marketing" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-droitaffaire/2">
												<img class="p" src="{$zBasePath}assets/img/img_sad/nouv_/droit-des-affaires.jpg" title="Droit" border="0" height="220" width="140">
											</a>
										</td>
										
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-finance/3"> 
												<img class="p" src="{$zBasePath}assets/img/img_sad/nouv_/finance.jpg" title="Finance Gestion Management" border="0" height="220" width="140">
											</a>
										</td>
									</tr>
									<tr>	
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-impot/4"> 
												<img class="p" src="{$zBasePath}assets/img/img_sad/nouv_/dgi.jpg" title="Impôt" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-info/5">
												<img class="p" src="{$zBasePath}assets/img/img_sad/nouv_/mtech-lap-phone-tab-e1465304675985.jpg" title="Informatique" border="0" height="220" width="140">
											</a>
										</td>
										<td class="zoom">
											<a href="{$zBasePath}nouveaute/listeform/sad/formation-science/6"> 
												<img class="p" src="{$zBasePath}assets/img/img_sad/nouv_/science-03.png" title="Science" border="0" height="220" width="140">
											</a>
										</td>
									</tr>
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

{literal}
<script type="text/javascript">
    $(document).ready(function() {	 
	  	$('#table_nouveau_liste').dataTable();
    });
</script>
{/literal}




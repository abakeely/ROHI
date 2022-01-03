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
									<li class="breadcrumb-item"><a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture">Catalogues</a> </li>
									<li class="breadcrumb-item">Texte Reglementaire</li>
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
									
								<script type="text/javascript" language="javascript" src="{$zBasePath}/assets/common/css/sad/js/jquery.dataTables.js"></script>
								<script type="text/javascript" language="javascript" src="{$zBasePath}assets/common/css/sad/js/dataTables.pageResize.min.js"></script>		
								{literal}
								<style>
									.bouton5 {
									background: #d34836;
									border:none;
									color:#fff;
									font:bold 12px Verdana;
									padding:10px;
								}
								</style>
								{/literal}

								<div align="right">
									<a href="{$zBasePath}documentation/infprat/sad/inf-prat" class="btn">Retour</a>
								</div>
								<br><br>
								<marquee><font size="4"><font face="Arial"><font color="#A9A9A9">Les Répertoires Journal Officiel</font> <font color="Teal">concernent le MFB et le Min FOP</font></font></font></marquee>
								<br><br><br><br>

								<div>
									<h4>
									<a href="{$zBasePath}documentation/texte/sad/texte-lois/1" class="bouton5">&nbsp;&nbsp;LOIS</a>&nbsp;&nbsp;
									<a href="{$zBasePath}documentation/texte/sad/texte-ordonnances/2" class="bouton5">&nbsp;&nbsp;ORDONNANCES</a>&nbsp;&nbsp;
									<a href="{$zBasePath}documentation/texte/sad/texte-decrets/3" class="bouton5">&nbsp;&nbsp;D&Eacute;CRETS</a>&nbsp;&nbsp;
									<a href="{$zBasePath}documentation/texte/sad/texte-arretes/4" class="bouton5">&nbsp;&nbsp;ARR&Ecirc;t&Eacute;S</a>&nbsp;&nbsp;
									<a href="{$zBasePath}documentation/texte/sad/texte-circulaires/5" class="bouton5">&nbsp;&nbsp;CIRCULAIRES</a>
									<a href="{$zBasePath}documentation/texte/sad/texte-notes/6" class="bouton5">&nbsp;&nbsp;NOTES</a>
									<a href="{$zBasePath}documentation/texte/sad/texte-autres/7" class="bouton5">&nbsp;&nbsp;REPERTOIRE JORM</a>
									</h4>
								</div>

								<div>
									<div class="row">
										<form class="form-horizontal" role="form" name="documentation" id="documentation" action="{$zBasePath}documentaion/texte" method="POST">		
										</form>
									</div>

									<table class="table table-striped table-bordered table-hover" id="table_texte">
										<thead >
											<tr >
												<th>Ordre</th>
												<th>Acte</th>
												<th>Sigle</th>
												<th>Date</th>
												<th>Intitule</th>
												<th>T&eacute;l&eacute;charger</th>
											</tr>
										</thead>	
												
										<tbody>	
										{foreach from=$oData.liste_texte item=texte_reglementaire}	
											<tr>
												<td>{$texte_reglementaire->id}</td>
												<td>{$texte_reglementaire->acte}</td>
												<td>{$texte_reglementaire->sigle}</td>
												<td>{$texte_reglementaire->date}</td>
												<td>{$texte_reglementaire->intitule}</td>
												<td><a href="{$zBasePath}assets/pdf_sad/{$texte_reglementaire->contennue}" target="_blank"><i style="font-size:22px;" class="la la-print"></i></a></td>
											</tr>
										{/foreach}
										</tbody>
									</table>		
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

{literal}
<script>
	
    $(document).ready(function() {
       $('#table_texte').dataTable({
	   });	
	});
	
</script>
{/literal}
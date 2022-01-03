{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<!--h3 class="page-title">Aide rubrique</h3-->
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">liste rubrique</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
									<table class="rubrique">
									<tr>
									<td style="width:22%">
										<form action="">
											<fieldset>
												<table>
													{section name=i loop=$oData.toRubrique}
													{if $smarty.section.i.iteration <= 40}
													<tr>
														<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
														<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
													<tr>
													{/if}
													{/section}
												</table>
											</fieldset>
										</form>
									</td>
									<td style="width:22%">
										<form action="">
											<fieldset>
												<table>
													{section name=i loop=$oData.toRubrique}
													{if $smarty.section.i.iteration > 40 and  $smarty.section.i.iteration < 80}
													<tr>
														<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
														<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
													<tr>
													{/if}
													{/section}
												</table>
											</fieldset>
										</form>
									</td>
									<td style="width:25%">
										<form action="">
											<fieldset>
												<table>
													
													{section name=i loop=$oData.toRubrique}
													{if $smarty.section.i.iteration > 80 and  $smarty.section.i.iteration < 120}
													<tr>
														<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
														<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
													<tr>
													{/if}
													{/section}
												</table>
											</fieldset>
										</form>
									</td>
									<td style="width:25%">
										<form action="">
											<fieldset>
												<table>
													
													{section name=i loop=$oData.toRubrique}
													{if $smarty.section.i.iteration > 120}
													<tr>
														<td><strong>{$oData.toRubrique[i]->code} :</strong></td>
														<td><span> {$oData.toRubrique[i]->rubrique|utf8} </span></td>
													<tr>
													{/if}
													{/section}
												</table>
											</fieldset>
										</form>
									</td>
									</tr>
								</table>
							
							</div>
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<input type="hidden" name="zUrlFiche" id="zUrlFiche" value="{$zBasePath}avis/fiche/titre-de-paiement">
<input type="hidden" name="zUrlImpression" id="zUrlImpression" value="{$zBasePath}avis/imprimer/titre-de-paiement">
<script>

{literal}
$(document).ready(function() {
        $('#dataTables-example').dataTable();
	});
{/literal}
</script>
<style>
{literal}
td {
padding:5px;
}
{/literal}
</style>
{include_php file=$zFooter}
		
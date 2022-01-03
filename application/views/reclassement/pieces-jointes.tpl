{include_php file=$zCssJs}
<link rel="stylesheet" href="{$zBasePath}assets/reclassement/css/style.css" />
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
	<!-- Main Wrapper -->
        <div class="main-wrapper">
			{include_php file=$zHeader}

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								<h3 class="page-title">Les pièces jointes</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Reclassement</a></li>
									<li class="breadcrumb-item">Les pièces jointes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="">
									<table>
										<tr>
											<fieldset>
												<table>
													<tr class="notAffiche">
														<td style="color:green;"><i style="color:green;font-size:20px;" class="la la-hand-o-right" aria-hidden="true">&nbsp;</i><strong>Pièces jointes reçues </strong></td>
													</tr>
													{foreach from=$oData.oPiecesJointes item=oPiecesJointes1 }
													<tr class="notAffiche">
														<td><i style="color:blue;font-size:20px;" class="la la-paperclip" aria-hidden="true"></i>&nbsp;{$oPiecesJointes1->pieceJointe_libelle}</td>
													</tr>
													{/foreach}
												</table>
											</fieldset>
										</tr>
									</table>
								</div>
							</div>
						</div>

					</div>
				</div>
    		</div>
			<!-- /Page Content -->
			<div id="calendar"></div>		
        </div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

{include_php file=$zFooter}

{literal}
<script>

</script>
{/literal}
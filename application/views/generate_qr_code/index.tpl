{include_php file=$zCssJs}
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<link href="{$zBasePath}assets/gantt_new/css/style.css" type="text/css" rel="stylesheet">
<script src="{$zBasePath}assets/js/jquery.maskedinput.js?V2"></script>
	<!-- Main Wrapper -->
		<div class="main-wrapper">
			{include_php file=$zHeader}
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col-12">
								{* <h3 class="page-title">{$oData.zLibelle}</h3> *}
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Suivi des actes</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div id="innerContent">
									<div id="saisieActe">
										<div class="panel-body">
											<h3>Information de l'acte</h3>
										</div>
										<form action="{$zBasePath}GenerateQRCode/index" method="POST" name="formulaireQrCode" id="formulaireQrCode"  enctype="multipart/form-data">
											<div class="row">
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>Contenu du code QR</b></label>
													</div>
													<input type="text" class="form-control obligatoire" placeholder="Contenu du code QR"  name="qrcode_content" data-placement="top" data-toggle="tooltip" data-original-title="Numero"  id="qrcode_content" value="{$oData.qrcode_content}">
												</div>
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp;</b></label>
													</div>
													<input type="submit" class="form-control obligatoire" value="Generer">
												</div>
												<div class="form col-md-2">
													<div class="libele_form">
														<label class="control-label label_rohi " data-original-title="" title=""><b>&nbsp;</b></label>
													</div>
													<a href="{$oData.file}" download>Télécharger</a>
												</div>
											</div>
										</form>
									</div>
								</div>
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
	
});

</script>
{/literal}
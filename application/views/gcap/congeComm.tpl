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
								<h3 class="page-title">{$oData.zLibelle}</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
									<li class="breadcrumb-item"><a href="#">RH</a></li>
									<li class="breadcrumb-item"><a href="#">Gestion des absences</a></li>
									<li class="breadcrumb-item">Login et mot de passe</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="col-xs-12">
						<div class="box">
							<div class="card-body">
								<div class="clear"></div>
								<div class="SSttlPage">
									<div class="cell">
										<div class="field text-center">
											<form action="#" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
												<fieldset>
												<div class="row1">
													<div class="cell small">
														<div class="field">
															<label>Matricule</label>
															<input type="text" name="iMatricule" autocomplete="off" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
															<p class="message debut" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
													<div class="cell small">
														<div class="field">
															<label>CIN</label>
															<input type="text" name="iCin" id="iCin" autocomplete="off" value="{$oData.iCin}" placeholder="" >
															<p class="message fin" style="width:500px">&nbsp;</p>
														</div>
													</div>
												</div>
												<div class="row1" >
													<div class="cell">
														<div class="field">
															<input type="button" class="button" onClick="getAjaxLG()" name="" id="" value="Valider">
														</div>
													</div>
												</div>
												</fieldset>
											</form>
										</div>
									</div>
								</div>
		
								<div class="contenuePage" style="overflow: hidden;">
									<div class="" id="setLoginMpass">
											
									</div>		
								</div>
								<div id="calendar"></div>
								<div id="dialogGcap" title="Demande d'absence"></div>
								<form name="formDelete" id="formDelete" action="{$zBasePath}gcap/delete/{$oData.zHashModule}/{$oData.zHashUrl}" method="POST">
									<input type="hidden" name="zMessage" id="zMessage" value="&Ecirc;tes vous s&ucirc;r de vouloir supprimer cet enregistrement ?">
									<input type="hidden" name="azert" id="azert" value="&Ecirc;tes-vous s&ucirc;r de confirmer ">
									<input type="hidden" name="azerty" id="azerty" value="cong&eacute;?">
									<input type="hidden" name="iElementId" id="iValueId" value="">
									<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}gcap/extrants/{$oData.zHashModule}/{$oData.zHashUrl}">
								</form>
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

	$("#iCin").mask("999 999 999 999");
	$("#iMatricule").mask("999999"); 
	function getAjaxLG(){
		var iMatricule = $("#iMatricule").val();
		var iCin = $("#iCin").val();
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}gcap/commConge/gestion-absence/lg-pass-ajax",
			type: 'Post',
			data: {
				iMatricule: iMatricule,
				iCin: iCin
			},
			success: function(data, textStatus, jqXHR) {
				$("#setLoginMpass").html(data);
			},
			async: !1
		})
	}
</script>
{/literal}
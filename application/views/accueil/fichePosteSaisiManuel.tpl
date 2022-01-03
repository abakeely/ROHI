{include_php file=$zCssJs}
<body>
<!-- Main Wrapper -->
<div class="main-wrapper">
	{include_php file=$zHeader}
				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-12">
							<h3 class="page-title">Ajout / Modification fiche de poste d'un agent</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
								<li class="breadcrumb-item">Ajout / Modification fiche de poste d'un agent</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="col-xs-12">
					<div class="box">
							<div class="card-body">
									<form action="" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
										<fieldset>
											<div class="row1">
												<div class="cell small">
													<div class="field">
														<label>Matricule</label>
														<input class="form-control" type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
														<p class="message debut" style="width:500px">&nbsp;</p>
													</div>
												</div>
											</div>
											<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
												<div class="cell small">
													<div class="field">
														<label>CIN</label>
														<input class="form-control" type="text" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
														<p class="message fin" style="width:500px">&nbsp;</p>
													</div>
												</div>
											</div>
											<div class="row1" style="padding: 20px 0 20px;">
												<div class="cell">
													<div class="field">
														<input type="form-control button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
														{if $oData.iMatriculeDRHA == '389671' || $oData.iMatriculeDRHA == '307381' || $oData.iMatriculeDRHA == '351101' || $oData.iMatriculeDRHA == '355857' || $oData.iMatriculeDRHA == '355857' || $oData.iMatriculeDRHA == '332690' || $oData.iMatriculeDRHA == '332026'}
														<input type="button" class="form-control button" onClick="sendExport('1')" name="" id="" value="export/Département">
														<input type="button" class="form-control button" onClick="sendExport('2')" name="" id="" value="export/Direction">
														{/if}
													</div>
												</div>
											</div>
										</fieldset>
									</form>
							</div>
					</div>
				</div>
		</div>
		<!-- /Page Content -->
			
	</div>
	<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<form name="formDelete" id="formDelete" action="" method="POST">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}evaluation/liste/agent-evaluation/agents-rattaches/{$oData.iUserId}">
</form>
{literal}
<style>
form .select-multiple {
    height: 500px;
}
td {
    border-bottom: none; 
}

h1{
    text-align: center;
    font-size: 14px;
    color: #238846;
}

.entete {
	background:none;
	background-color: #69a26a!important;
    border-top: 1px solid #32a55b!important;
    border-bottom: 5px solid #5b825c!important;
	color:white!important;
}

th {
	background:none;
}
</style>
<script type="text/javascript">

	{/literal}{if $oData.suc==1}{literal}
	bootbox.alert("Enregistrement effectué avec succès. Merci!");
	{/literal}{/if}{literal}

	$("#getUserInfo").hide();
	$("#iCin").mask("999 999 999 999");
	function sendExport(_iType){

		switch(_iType){
			case '1':
				document.location.href="{/literal}{$zBasePath}{literal}accueil/setExportFichePosteByLocalite/departement";
			break;

			case '2':
				document.location.href="{/literal}{$zBasePath}{literal}accueil/setExportFichePosteByLocalite/direction";
			break;
		}
	}
	function sendSearch(){

		
		var iCin = $("#iCin").val();
		var iMatricule = $("#iMatricule").val();
		var iTest = 0;

		if (iCin == '' && iMatricule == '' ){
			iTest = 1;
		} 

		if (iTest == 0) {
			$("#getUserInfo").show();
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}accueil/modification/fiche-de-poste/ajax?dfdfdfd1111" ,
				method: "POST",
				data: { iCin: iCin, iMatricule: iMatricule},
				success: function(data, textStatus, jqXHR) {

					$("#getUserInfo").html(data);
					
					
				},
				async: false
			});
		} else {
			if (iCin == '' || iMatricule == ''){
				alert("Veuillez remplir le CIN ou le Matricule");
			} 
		}
	}
	
</script>
{/literal}
{include_php file=$zFooter}
		
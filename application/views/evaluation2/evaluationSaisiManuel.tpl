{include_php file=$zCssJs}
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.user_id}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">Saisie manuelle note evaluation des Agents &eacute;valu&eacute;s</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">RH</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Evaluation</a></li>
				<li class="breadcrumb-item">Saisie manuelle notes évaluations</li>
			</ul>
		</div>
	</div>
</div>
<div id="container">
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
			<div class="contenuePage">

			<!--*Debut Contenue*-->
			<div class="col-xs-12">
			<form action="" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
			<fieldset>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>Matricule</label>
							<input type="text" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
							<p class="message debut" style="width:500px">&nbsp;</p>
						</div>
					</div>
				</div>
				<div class="row1">
					<div class="cell small">
						<div class="field">
							<label>CIN</label>
							<input type="text" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
							<p class="message fin" style="width:500px">&nbsp;</p>
						</div>
					</div>
				</div>
				<div class="row1" style="padding: 20px 0 20px;">
					<div class="cell">
						<div class="field">
							<input type="button" class="button" onClick="sendSearch()" name="" id="" value="rechercher">
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		</div>
	</div>
	<div class="card punch-status" id="getUserInfo">&nbsp;</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
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
</style>
<script type="text/javascript">

	$("#getUserInfo").hide();
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
				url: "{/literal}{$zBasePath}{literal}critere/sendForSaisiManuel/{/literal}{$oData.oUser.id}{literal}" ,
				method: "POST",
				data: { iCin: iCin, iMatricule: iMatricule},
				success: function(data, textStatus, jqXHR) {

					/*$("#iCin").val("");
					$("#iMatricule").val("");*/
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
</div>

</body>
</html>
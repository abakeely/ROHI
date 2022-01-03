{include_php file=$zCssJs}
{include_php file=$zHeader}
<div class="page-header">
	<div class="row align-items-center">
		<div class="col-12">
			<h3 class="page-title">S&eacutel&eacute;ction des Agents &eacute;valu&eacute;s par</b> : {$oData.oUserEvaluateur.0->nom}&nbsp;{$oData.oUserEvaluateur.0->prenom} (IM : {$oData.oUserEvaluateur.0->matricule}) </h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{$zBasePath}">Accueil</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">RH</a></li>
				<li class="breadcrumb-item"><a href="{$zBasePath}">Evaluation</a></li>
				<li class="breadcrumb-item">{$oData.zLibelle}</li>
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
							<input type="text" class="form-control" name="iMatricule" id="iMatricule" value="{$oData.iMatricule}" placeholder="">
							<p class="message debut" style="width:500px">&nbsp;</p>
						</div>
					</div>
				</div>
				<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
					<div class="cell small">
						<div class="field">
							<label>CIN</label>
							<input type="text" class="form-control" name="iCin" id="iCin" value="{$oData.iCin}" placeholder="" >
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
		<div class="contenuePage">

		<!--*Debut Contenue*-->
		<div class="col-xs-12">
		<form id="evaluation" name="evaluation" action="{$zBasePath}evaluation/save" method="POST">
		  <input type="hidden" name="zListeAgent" id="zListeAgent" value="{$oData.zListeAgent}">  
		  <input type="hidden" name="iEvaluateurId" id="iEvaluateurId" value="{$oData.oUserEvaluateur.0->user_id}">  
		  <fieldset>
			<table>
				<tr>
					<td style="width:30%">
						<label>Agents Disponibles :</label>
						<select name="selectfrom" id="select-from" class="select-multiple" multiple size="10">
							{assign var=iIncrement value="0"}
							{if sizeof($oData.oListeIn)>0}
							{foreach from=$oData.oListeIn item=oListeCompte }
								<option value="{$oListeCompte.user_id}">{$oListeCompte.nom}&nbsp;{$oListeCompte.prenom} (IM : {$oListeCompte.matricule})</option>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{/if}
						</select>
					</td>
					<td style="width:10%;vertical-align:middle;padding-right:6%">
						<table>
							<tr>
								<td style="text-align:center"><img id="btn-add" style="height: 29px;" name="btn-add" src="{$zBasePath}/assets/evaluation2/images/arrow_right.png" alt=""></td>
							</tr>
							<tr>
								<td style="text-align:center"><img id="btn-remove" style="height: 29px;" name="btn-remove" src="{$zBasePath}/assets/evaluation2/images/arrow_left.png" alt=""></td>
							</tr>
						</table>
					</td>
					<td style="width:30%;vertical-align:middle">
						<label>Agents &agrave; Evaluer : </label>
						<select name="selectto" id="select-to" class="select-multiple" multiple size="10">
							{assign var=iIncrement value="0"}
							{if sizeof($oData.oListeNotIn)>0}
							{foreach from=$oData.oListeNotIn item=oListeCompte }
								<option value="{$oListeCompte.user_id}">{$oListeCompte.nom}&nbsp;{$oListeCompte.prenom} (IM : {$oListeCompte.matricule})</option>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{/if}
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="3"><input type="submit" class="button" name="" id="Envoyer" value="Valider"></td>
				</tr>
			</table>
		  </fieldset>
		</form>
		</div>
		</div>
	</div>
	<div id="calendar"></div>
	</div>
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
</style>
<script type="text/javascript">

	function sendSearch(){

		
		var iCin = $("#iCin").val();
		var iMatricule = $("#iMatricule").val();
		var iTest = 0;

		if (iCin == '' && iMatricule == '' ){
			iTest = 1;
		} 

		if (iTest == 0) {
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}critere/sendSearch/" ,
				method: "POST",
				data: { iCin: iCin, iMatricule: iMatricule},
				success: function(data, textStatus, jqXHR) {

					
					var oReturn = jQuery.parseJSON(data);
					
					if (oReturn.user_id > 0) {
						
						var iTest = 0;
						var statusto = document.evaluation.selectto;
						var statusFrom = document.evaluation.selectfrom;
						for (var i = 0; i < statusto.options.length; i++) {
							if (statusto.options[i].value == oReturn.user_id) {
								iTest = 1;
							}
						}

						for (var i = 0; i < statusFrom.options.length; i++) {
							if (statusFrom.options[i].value == oReturn.user_id) {
								iTest = 2;
							}
						}

						$("#iCin").val("");
						$("#iMatricule").val("");

						if (iTest == 1) {
							alert("l'agent recherché est déjà dans la liste des évalués")
						} 
						else if (iTest == 2) {
							alert("l'agent recherché est déjà dans la liste des Agents disponible")
						}
						else {
							$("#select-from").append(oReturn.affichage);
						}
						
						
					} else {

						if (oReturn.user_id == 0) {
							alert('Agent déjà évalué par ' + oReturn.message);
						} else {
							alert("L'agent n'est pas dans ROHI");
						}
					}
				},
				async: false
			});
		} else {
			if (iCin == '' || iMatricule == ''){
				alert("Veuillez remplir le CIN ou le Matricule");
			} 
		}
	}
	function ajaxmultiselect(){
		var input  = [];
		var select = document.evaluation.selectto;
		var status = document.evaluation.zListeAgent;

		for (var i = 0; i < select.options.length; i++) {
		  input.push(select.options[i].value);
		 }
		status.value = input.join("-");

	}

    $(document).ready(function() {
		
		$('#btn-add').click(function(){
			$('#select-from option:selected').each( function() {
				$('#select-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
				$(this).remove();
				ajaxmultiselect();
					
			});
		});
		$('#btn-remove').click(function(){
			$('#select-to option:selected').each( function() {
				$('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
				$(this).remove();
				ajaxmultiselect();
				
			});
		});
		$('#btn-up').bind('click', function() {
			$('#select-to option:selected').each( function() {
				var newPos = $('#select-to option').index(this) - 1;
				if (newPos > -1) {
					$('#select-to option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
					$(this).remove();
					ajaxmultiselect();
					
				}
			});
		});
		$('#btn-down').bind('click', function() {
			var countOptions = $('#select-to option').size();
			$('#select-to option:selected').each( function() {
				var newPos = $('#select-to option').index(this) + 1;
				if (newPos < countOptions) {
					$('#select-to option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
					$(this).remove();
					ajaxmultiselect();
				}
			});
		});

		function getMsg(selector) {
			return $(selector).attr('data-msg');
		}

    });
</script>
{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>
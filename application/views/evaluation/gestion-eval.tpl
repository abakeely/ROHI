{include_php file=$zCssJs}
	{include_php file=$zHeader}
<script type="text/javascript" src="{$zBasePath}assets/evaluation2/js/raterater.jquery.js?v2"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/vendor/jquery-ui.js"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.user_id}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="{$zBasePath}">RH</a> <span>&gt;</span> <a href="{$zBasePath}">Evaluation</a> <span>&gt;</span> Evaluateur / évalué</div>
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		 <h2>Evaluateur evalué</h2>

		  <div class="SSttlPage">
             <div id="searchAcc">
				<div class="card punch-status">
				<h2>RECHERCHE EVALUATEUR</h2>
				<form action="{$zBasePath}evaluation/liste/agent-evaluation/gestion-eval" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
					<input type="hidden" name="iSearch" id="iSearch" value="1">  
					<fieldset>
						<div class="row1">
							<div class="cell small">
								<div class="field">
									<label>Matricule</label>
									<input type="text" class="form-control" name="iMatriculeSearch" id="iMatriculeSearch" value="{$oData.iMatriculeSearch}" placeholder="">
									<p class="message debut" style="width:500px">&nbsp;</p>
								</div>
							</div>
						</div>
						<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
							<div class="cell small">
								<div class="field">
									<label>CIN</label>
									<input type="text" class="form-control" name="iCinSearch" id="iCinSearch" value="{$oData.iCinSearch}" placeholder="" >
									<p class="message fin" style="width:500px">&nbsp;</p>
								</div>
							</div>
						</div>
						<div class="row1" style="padding: 20px 0 0px;">
							<div class="cell">
								<div class="field">
									<input type="submit" class="button" name="" id="" value="rechercher">
								</div>
							</div>
						</div>
					</fieldset>
				</form>
				</div>
			
		{if $oData.oUserEvaluateur.0->user_id > 0}
		
				<div class="card punch-status">
				<h2> RECHERCHE AGENT DANS LA LISTE DISPONIBLE</h2>
				<form action="" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
				<fieldset>
					<div class="row1">
						<div class="cell small">
							<div class="field">
								<label>Matricule</label>
								<input type="text" class="form-control" name="iMatricule1" id="iMatricule1" value="{$oData.iMatricule}" placeholder="">
								<p class="message debut" style="width:500px">&nbsp;</p>
							</div>
						</div>
					</div>
					<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
						<div class="cell small">
							<div class="field">
								<label>CIN</label>
								<input type="text" class="form-control" name="iCin1" id="iCin1" value="{$oData.iCin}" placeholder="" >
								<p class="message fin" style="width:500px">&nbsp;</p>
							</div>
						</div>
					</div>
					<div class="row1" style="padding: 20px 0 0px;">
						<div class="cell">
							<div class="field">
								<input class="form-control" type="button" class="button" onClick="sendSearch(1)" name="" id="" value="rechercher">
							</div>
						</div>
					</div>
				</fieldset>
			</form>
			</div>
		
			<div class="card punch-status">
				<h2> RECHERCHE AGENT DANS LA LISTE DES EVALUES</h2>
				<form action="" method="POST" name="formulaireAjout" id="formulaireAjout" enctype="multipart/form-data">
				<fieldset>
					<div class="row1">
						<div class="cell small">
							<div class="field">
								<label>Matricule</label>
								<input type="text" class="form-control" name="iMatricule2" id="iMatricule2" value="{$oData.iMatricule}" placeholder="">
								<p class="message debut" style="width:500px">&nbsp;</p>
							</div>
						</div>
					</div>
					<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
						<div class="cell small">
							<div class="field">
								<label>CIN</label>
								<input type="text" class="form-control" name="iCin1" id="iCin1" value="{$oData.iCin}" placeholder="" >
								<p class="message fin" style="width:500px">&nbsp;</p>
							</div>
						</div>
					</div>
					<div class="row1" style="padding: 20px 0 0px;">
						<div class="cell">
							<div class="field">
								<input type="button" class="form-control" class="button" onClick="sendSearch(2)" name="" id="" value="rechercher">
							</div>
						</div>
					</div>
				</fieldset>
			</form>
			</div>
		
		{/if}
		 </div>
        </div>
		<!-- form -->
		{if $oData.oUserEvaluateur.0->user_id > 0}
		<h2> <b>S&eacutel&eacute;ction des Agents &eacute;valu&eacute;s par</b> : {$oData.oUserEvaluateur.0->nom}&nbsp;{$oData.oUserEvaluateur.0->prenom} (IM : {$oData.oUserEvaluateur.0->matricule}) </h2>
		<form id="evaluation" name="evaluation" action="{$zBasePath}evaluation/save" method="POST">
		  <input type="hidden" name="iRedirectAdmin" id="iRedirectAdmin" value="1">  
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
								<td style="text-align:center"><img id="btn-add" style="height: 29px;" name="btn-add" src="{$zBasePath}/assets/evaluation/images/arrow_right.png" alt=""></td>
							</tr>
							<tr>
								<td style="text-align:center"><img id="btn-remove" style="height: 29px;" name="btn-remove" src="{$zBasePath}/assets/evaluation/images/arrow_left.png" alt=""></td>
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
		{/if}
		<!---form -->

	</div>
	</div>
	<div id="calendar"></div>
	</div>
</section>
<section id="rightContent" class="clearfix">
	{include_php file=$zRight}
</section>
</form>
<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
	
</div>
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

	function sendSearch(_iSwitch){

		
		var iCin = $("#iCin" + _iSwitch).val();
		var iMatricule = $("#iMatricule" + _iSwitch).val();
		var iTest = 0;

		if (iCin == '' && iMatricule == '' ){
			iTest = 1;
		} 

		if (iTest == 0) {
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}evaluation/sendSearchAdmin/" ,
				method: "POST",
				data: { iCin: iCin, iMatricule: iMatricule},
				success: function(data, textStatus, jqXHR) {

					
					var oReturn = jQuery.parseJSON(data);
					
					if (oReturn.user_id > 0) {
						
						var iTest = 0;
						var statusto = document.evaluation.selectto;
						var statusFrom = document.evaluation.selectfrom;

						if (_iSwitch == 1) {
						
							for (var i = 0; i < statusFrom.options.length; i++) {
								statusFrom.options[i].selected = false;
								if (statusFrom.options[i].value == oReturn.user_id) {
									iTest = 2;
									statusFrom.options[i].selected = true;
									statusFrom.options[i].scrollIntoView();
								}
							}
						}


						if (_iSwitch == 2) {
						
							for (var i = 0; i < statusto.options.length; i++) {
								statusto.options[i].selected = false;
								if (statusto.options[i].value == oReturn.user_id) {
									iTest = 1;
									statusto.options[i].selected = true;
									statusto.options[i].scrollIntoView();
								}
							}
						}
						
						$("#iCin").val("");
						$("#iMatricule").val("");	
						

						if (iTest == 0) {

							$.ajax({
								url: "{/literal}{$zBasePath}{literal}evaluation/sendSearch/" ,
								method: "POST",
								data: { iCin: iCin, iMatricule: iMatricule},
								success: function(data, textStatus, jqXHR) {
										
										var oReturn = jQuery.parseJSON(data);
										if (oReturn.user_id == 0) {
											alert('Agent déjà évalué par ' + oReturn.message);
										} 
										else {

										if (_iSwitch == 1){
											alert("L'agent n'est pas dans la liste de gauche");
										}

										if (_iSwitch == 2){
											alert("L'agent n'est pas dans la liste de droite");
										}

											
										}
								},
								async: false
							});
						}
						
					} else {
						alert("L'agent n'est pas dans ROHI");
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
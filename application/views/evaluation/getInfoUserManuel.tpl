<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation/css/raterater.css?v1">
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation/js/jquery-ui.css?v1">
{*<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?v1" rel="stylesheet"/>*}
<script type="text/javascript" src="{$zBasePath}assets/evaluation/js/raterater.jquery.js?v1"></script>
<input type="hidden" name="iEvaluableValue" id="iEvaluableValue" value="1">
<p>&nbsp;</p>
<table id="evaluation-table">
	<tr>
		<td style="width:2%">
			<div class="left">
				<p class="photo"><img width="200" src="{$zPathWithPhoto}"/></p>
			</div>
		</td>
		<td style="width:30%;vertical-align:top">
			<table id="information-table">
				<tr>
					<td style="width:30%;vertical-align:top;border:none" colspan="2">
						<form enctype="multipart/form-data">
							<fieldset>
								<div class="row1" style="width:100%">
									<div class="cell">
										<div class="field">
											<label><b>Nom :</b> {$oCandidat.0->nom}</label>
											<label>Matricule : {$oCandidat.0->matricule}</label>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell small">
										<div class="field">
											<label>Pr&eacutenom(s) : {$oCandidat.0->prenom}</label>
										</div>
									</div>
								</div>
								<div class="row1 clearfix">
									<div class="cell">
										<div class="field">
											
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:65%">
										<div class="field"> 
											<label>Departement</label>
											<select id="iDepartementId" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
												{foreach from=$oDepartement item=oDepartement }
												<option {if $oDepartement.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Direction</label>
											<select id="iOrganisation_1" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner une direction</option>
												{foreach from=$oDirection item=oDirection }
												<option {if $oDirection.id == $oCandidat.0->direction} selected="selected" {/if} value="{$oDirection.id}">{$oDirection.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Service</label>
											<select id="iOrganisation_2" name="iServiceId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
												<option value="0">s&eacute;l&eacute;ctionner un service</option>
												{foreach from=$oService item=oService }
												<option {if $oService.id == $oCandidat.0->service} selected="selected" {/if} value="{$oService.id}">{$oService.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell"  style="width:50%">
										<div class="field"> 
											<label>Division</label>
											<select id="iOrganisation_3" name="iDivisionId" >
												<option value="0">s&eacute;l&eacute;ctionner une division</option>
												{foreach from=$oDivision item=oDivision }
												<option {if $oDivision.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision.id}">{$oDivision.libele}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								
								<div class="row1">
									<div class="cell" style="width:15%">
										<div class="field">
											<label>Mois</label>
											<select name="iMois" id="iMois">
												{assign var=iIncrement value="1"}
												{foreach from=$toMonth item=zMonth}
												{if $zAnneeAffiche == '2016'}
													{if $iIncrement > 7}
													<option value="{$iIncrement}">{$zMonth}</option>
													{/if}
												{else}
													<option value="{$iIncrement}">{$zMonth}</option>
												{/if}
												{assign var=iIncrement value=$iIncrement+1}
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:15%">
										<div class="field">
											<label>Ann&eacute;e</label>
											<select name="iAnnee" id="iAnnee">
												{assign var=iBoucle value=$zAnneeAffiche}
												{section name=iAnnee start=$iBoucle-$iLastBoucle loop=$iBoucle+1 step=1}
													<option {if iAnnee == $smarty.section.iAnnee.index}selected="selected"{/if} value="{$smarty.section.iAnnee.index}">{$smarty.section.iAnnee.index}</option>
												{/section}
											</select>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="color:red;">
										<label ><strong>Evaluable *</strong></label>
										<div class="field">
											Oui : <input type="radio" class="form-control evaluable" id="iCandidatEvaluable" name="iCandidatEvaluable" checked="checked"  value="1">
											Non : <input type="radio" class=" form-controlevaluable" id="iCandidatEvaluable" name="iCandidatEvaluable" value="0">
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell">
										<label>Nom evaluateur *</label>
										<div class="field" id="searchCandidat" style="display:block">
											<input class="form-control" placeholder="Veuillez entrer le nom de l'evaluateur" type="text" id="zCandidatSearch" name="zCandidatSearch">
										</div>
									</div>
								</div>
								<div id="blocEvaluable" style="display:block">
									
									<div class="row">
											<label>Note efficacit&eacute;: </label>
											<table>
											<tr>
												<td style="width:50px;border:none" id="1"><div class="ratebox" data-id="1" data-rating="0"></div></td>
												<td style="vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none" id="live-rating-efficacite"></td>
											</tr>
											</table>
									</div>
									<div class="row">
											<label>Note ponctualit&eacute;: </label>

											<div class="field">
												<p class="check"><input type="checkbox" id="iManuel" class="form-control"  name="iManuel" value="1"><label>Saisie manuelle (si decochée la note sera la moyenne dans le pointage électronique)</label></p>
											</div>
											<table id="noteManuel" style="display:none;">
											<tr>
												<td style="width:50px;border:none" id="2"><div class="ratebox" data-id="1" data-rating="0"></div></td>
												<td style="vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none" id="live-rating-Ponctualite"></td>
											</tr>
											</table>
									</div>
								</div>
								<div class="row1" style="padding: 20px 0 20px;">
									<div class="cell">
										<div class="field">
											<input type="button" class="button" onClick="validerNote()" name="" id="" value="Valider">
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="border:none" id="historiqueCandidat">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>Date</th>
						<th>Evaluateur</th>
						<th>Note efficacité</th>
						<th>Note Ponctualité</th>
						<th>Evaluable</th>
						<th>Mois</th>
						<th>Ann&eacute;e</th>
						<th>Fiche Evaluation</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oListeHistoriqueAgent)>0}
					{foreach from=$oListeHistoriqueAgent item=oListeHistorique }
					{assign var=iMois value=$oListeHistorique.noteEvaluation_moisNote}
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td>{$oListeHistorique.noteEvaluation_dateNotation|date_format:"%d/%m/%Y"}</td>
						<td>{$oListeHistorique.nomEvaluateur}</td>
						<td>{if $oListeHistorique.noteEvaluation_noteValue != ''}{$oListeHistorique.noteEvaluation_noteValue|replace:'.':','}/5{/if}</td>
						<td>{if $oListeHistorique.noteEvaluation_notePonctualite != ''}{$oListeHistorique.noteEvaluation_notePonctualite|replace:'.':','}/5{/if}</td>
						<td>{if $oListeHistorique.noteEvaluation_evaluable == 1}Oui{else}Non{/if}</td>
						<td>{$toMonth.$iMois}</td>
						<td>{$oListeHistorique.noteEvaluation_anneeNote}</td>
						<td><a href="{$zBasePath}cv/fpdf_fe/{$oListeHistorique.iCandidatId}?iDate={$oListeHistorique.noteEvaluation_id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title="Fiche Evaluation"></i></a></td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;border:none" colspan="6">Aucune note pour l'agent</td></tr>
					{/if}
				</tbody>
			</table>
			{$zPagination}
		</td>
	</tr>
</table>
{literal}
<style>
table { margin:0 }
</style>
<script>
function rateAlert(id, rating)
{
    
	var zRating = rating.toString(); ; 
	var oRating = zRating.split('.');
	var iDebut = oRating[0];
	var iFin = parseInt(oRating[1]);

	var zAffichageRating = "";
	var zAfterVirgule = "";
	if (iFin <=40) {
		zAfterVirgule = ".25";
	} else if (iFin > 40 && iFin <=60){
		zAfterVirgule = ".50";
	} else if (iFin > 60 && iFin <=90){
		zAfterVirgule = ".75";
	} else if (iFin > 90 && iFin <100){
			iDebut++;
	} 

	zAffichageRating = iDebut + zAfterVirgule ;

	switch (id) {
		case '1':
			$("#noteOfUserId").val(zAffichageRating);
			$("#live-rating-efficacite").html("<strong>" + zAffichageRating + " / 5</strong>");
			break;

		case '2':
			$("#notePonctualiteOfUserId").val(zAffichageRating);
			$("#live-rating-Ponctualite").html("<strong>" + zAffichageRating + " / 5</strong>");
			break;
	}
}

/* Here we initialize raterater on our rating boxes
 */
$(function() {
    $("#userANoteId").val({/literal}{$oCandidat[0]->user_id}{literal});
	$( '.ratebox' ).raterater( { 
        submitFunction: 'rateAlert', 
        allowChange: true,
        starWidth: 50,
        spaceWidth: 5,
        numStars: 5
    } );


	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatSearch").select2
	({
		initSelection: function (element, callback)
		{
			
			$(dataArrayVille).each(function()
			{
				if (this.id == element.val())
				{
					callback(this);
					return
				}
			})
		},
		allowClear: true,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		multiple:false,
		formatNoMatches: function () { return $("#AucunResultat").val(); },
		formatInputTooShort: function (input, min) { return "Veuillez saisir plus de " + (min - input.length) + " lettres"; },
		formatSelectionTooBig: function (limit) { return "Vous ne pouvez sélectionner que " + limit + " element" + (limit == 1 ? "" : "s"); },
		formatLoadMore: function (pageNumber) { return $("#chargement").val(); },
		formatSearching: function () { return "Recherche..."; },			
		ajax: { 
			url: "{/literal}{$zBasePath}{literal}gcap/candidat/",
			dataType: 'jsonp',
			data: function (term)
			{
				return {q: term, iFiltre:1};
			},
			results: function (data)
			{
				return {results: data};
			}
		},
		dropdownCssClass: "bigdrop"
	}) ;

	$("#zCandidatSearch").select2('val',$("#idSelect").val());

	$("#noteEvaluation_userSendNoteId").val($("#idSelect").val());
});

function validerNote() {

	iValueEvaluable = $("#iEvaluableValue").val();

	if (iValueEvaluable == 1) {

		if ($("#noteOfUserId").val() != "" && $("#userANoteId").val() != ""){
			
			if ($("#zCandidatSearch").val() != '') {
				if (confirm ("Êtes vous sûr de vouloir valider ce note ?")) {
					var noteEvaluation_userSendNoteId = $("#zCandidatSearch").val() ; 
					var fFloatNoteOfUser = $("#noteOfUserId").val() ; 
					var userANoteId = $("#userANoteId").val() ;
					
					iValue = $('#iManuel').is(':checked');
					fFloatNotePonctualiteOfUser = '';
					if (iValue == true){
						var fFloatNotePonctualiteOfUser = $("#notePonctualiteOfUserId").val() ; 
					}

					/*var fFloatNotePonctualiteOfUser = $("#notePonctualiteOfUserId").val() ; */

					var iMois = $("#iMois").val() ; 
					var iAnnee = $("#iAnnee").val() ; 

					var iDepartementId = $("#iDepartementId").val() ; 
					var iDirectionId = $("#iOrganisation_1").val() ; 
					var iServiceId = $("#iOrganisation_2").val() ; 
					var iDivisionId = $("#iOrganisation_3").val() ; 

					$.ajax({
						url: "{/literal}{$zBasePath}{literal}evaluation/notationUserSaisiManuel/{/literal}{$iUserSaisie}{literal}" ,
						method: "POST",
						data: { fFloatNoteOfUser: fFloatNoteOfUser, userANoteId: userANoteId,fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, iDepartementId:iDepartementId,iDirectionId:iDirectionId,iServiceId:iServiceId,iDivisionId:iDivisionId,iValueEvaluable:iValueEvaluable},
						success: function(data, textStatus, jqXHR) {
							if (data == 1) {
								alert("La note est enregistrée avec succès !");

								$.ajax({
									url: "{/literal}{$zBasePath}{literal}evaluation/getHistoriqueNoteAgent/"+ userANoteId ,
									method: "GET",
									success: function(data, textStatus, jqXHR) {
										$("#historiqueCandidat").html(data);
									},
									async: false
								});
								
							} else {
								alert("Une note est déjà attibuée sur le couple Mois/Année !");
							}
							$( "#dialog" ).dialog( "close" );
						},
						async: false
					});
				}
			} else {
				alert("Veuillez sélectionner l'Evaluateur!");
			}
		} else {
			alert("Veuillez sélectionner la note dans les étoiles !");
		}
	} else {

		if ($("#zCandidatSearch").val() != '') {

			if (confirm ("Êtes vous sûr de confirmer que cet agent n'est pas evaluable pour le couple mois/année ?")) {
				var noteEvaluation_userSendNoteId = $("#zCandidatSearch").val() ; 
				var fFloatNoteOfUser = '' ; 
				var userANoteId = $("#userANoteId").val() ; 
				var fFloatNotePonctualiteOfUser = '' ; 
				var iMois = $("#iMois").val() ; 
				var iAnnee = $("#iAnnee").val() ; 

				var iDepartementId = $("#iDepartementId").val() ; 
				var iDirectionId = $("#iOrganisation_1").val() ; 
				var iServiceId = $("#iOrganisation_2").val() ; 
				var iDivisionId = $("#iOrganisation_3").val() ; 

				$.ajax({
					url: "{/literal}{$zBasePath}{literal}evaluation/notationUserSaisiManuel/{/literal}{$iUserSaisie}{literal}" ,
					method: "POST",
					data: { fFloatNoteOfUser: fFloatNoteOfUser, userANoteId: userANoteId,fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, iDepartementId:iDepartementId,iDirectionId:iDirectionId,iServiceId:iServiceId,iDivisionId:iDivisionId,iValueEvaluable:iValueEvaluable},
					success: function(data, textStatus, jqXHR) {
						if (data == 1) {
							alert("Enregistrement effectué !");

							$.ajax({
								url: "{/literal}{$zBasePath}{literal}evaluation/getHistoriqueNoteAgent/"+ userANoteId ,
								method: "GET",
								success: function(data, textStatus, jqXHR) {
									$("#historiqueCandidat").html(data);
								},
								async: false
							});
							
						} else {
							alert("Une note est déjà attibuée sur le couple Mois/Année !");
						}
						$( "#dialog" ).dialog( "close" );
					},
					async: false
				});
			}
		} else {
			alert("Veuillez sélectionner l'Evaluateur!");
		}
	}

}

$(document).ready (function ()
{
	$('.evaluable').click(function(){
		
		var iValue = $(this).val();  

		switch (iValue) {
			case '1':
				$("#blocEvaluable").show();
				$("#iEvaluableValue").val('1');
				break;

			case '0':
				$("#blocEvaluable").hide();
				$("#iEvaluableValue").val('0');
				break;
		}

		
	});

	$('#iManuel').click(function(){
		
		var iValue = $('#iManuel').is(':checked');  

		switch (iValue) {
			case true:
				$("#noteManuel").show();
				break;

			case false:
				$("#noteManuel").hide();
				break;
		}

		
	});
	
})
</script>
{/literal}
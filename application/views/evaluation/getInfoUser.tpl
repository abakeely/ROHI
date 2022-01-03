<input type="hidden" name="iEvaluableValue" id="iEvaluableValue" value="1">
<input type="hidden" name="iEvaluateur" id="iEvaluateur" value="{$iEvaluateur}">
<p>&nbsp;</p>
<table id="evaluation-table">
	<tr>
		<td style="width:2%">
			<div>
				<p class="photo" style="text-align:center;"><img width="200" src="{$zPathWithPhoto}"/></p>
			</div>
		</td>
		<td style="width:30%;vertical-align:top">
			<table id="information-table">
				<tr>
					<td style="width:30%;vertical-align:top;border:none" colspan="2">
						<form enctype="multipart/form-data">
							<fieldset>
								<div class="row clearfix" style="width:100%">
									<div class="cell">
										<div class="field">
											<label><b>Nom :</b> {$oCandidat.0->nom}</label>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell" style="width:100%">
										<div class="field">
											<label>Pr&eacutenom : {$oCandidat.0->prenom}</label>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="cell">
										<div class="field">
											<label>Matricule : {$oCandidat.0->matricule}</label>
										</div>
									</div>
								</div>
								<div class="row1">
									<div class="cell">
										<div class="field">
											<label>Mois</label>
											<select name="iMois" id="iMois">
												{assign var=iIncrement value="1"}
												{foreach from=$toMonth item=zMonth}
												{if $zAnneeAffiche == '2016'}
													{if $iIncrement >7 and $iIncrement <= $zMoisAffiche}
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
									<div class="cell small">
										<div class="field">
											<label>Ann&eacute;e</label>
											<select name="iAnnee" id="iAnnee">
												{assign var=iBoucle value=$zAnneeAffiche}
												{section name=iAnnee start=$iBoucle-$oData.iLastBoucle loop=$iBoucle+1 step=1}
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
											Oui : <input type="radio" class="evaluable form-control" id="iCandidatEvaluable" name="iCandidatEvaluable" checked="checked"  value="1">
											Non : <input type="radio" class="evaluable form-control" id="iCandidatEvaluable" name="iCandidatEvaluable" value="0">
										</div>
									</div>
								</div>
								<div id="blocEvaluable" style="display:block">
									<!--<div class="row clearfix">
										<div class="cell">
											<label>Nom evaluateur *</label>
											<div class="field" id="searchCandidat" style="display:block">
												<input placeholder="Veuillez entrer le nom de l'evaluateur" type="text" id="zCandidatSearch" name="zCandidatSearch">
											</div>
										</div>
									</div>-->
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
												<p class="check"><input type="checkbox" id="iManuel"  name="iManuel" value="1"><label>Saisie manuelle (si decochée la note sera la moyenne dans le pointage électronique)</label></p>
											</div>
											<table id="noteManuel" style="display:none;">
											<tr>
												<td style="width:50px;border:none" id="2"><div class="ratebox" data-id="1" data-rating="0"></div></td>
												<td style="vertical-align:middle;font-weight:bold;text-align:left;padding-left:10px;border:none" id="live-rating-Ponctualite"></td>
											</tr>
											</table>
									</div>
									{if $iEvaluateur == 1}
									<div class="row clearfix">
										<div class="cell">
											<label>Nom evaluateur *</label>
											<div class="field" id="searchCandidat" style="display:block">
												<input placeholder="Veuillez entrer le nom de l'evaluateur" type="text" id="zCandidatInfo" name="zCandidatInfo">
											</div>
										</div>
									</div>
									{/if}
								</div>
							</fieldset>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="border:none">

			<!----------------- bloc Toogle ---------------->
			<div class="blocToggle">
			<div class="toggleBloc">
			<div class="row separateur separateur1"><div class="col-md-12">Les notes précédentes (cliquer ici)</div></div></div>
			<div class="child" style="display: none;"><br>
			<!----------------- bloc Toogle ---------------->
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
			{$oData.zPagination}
			<!----------------- Fin bloc Toogle ---------------->
			</div>
			</div>
			<!----------------- Fin bloc Toogle ---------------->
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

	$('#dialog').removeAttr('tabindex')

	var dataArrayVille = [{id:$("#idSelect").val(),text:$("#textSelect").val()}];
	
	$("#zCandidatInfo").select2
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
		allowClear: false,
		placeholder:"Sélectionnez",
		minimumInputLength: 3,
		multiple:true,
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

	$("#zCandidatInfo").select2('val',$("#idSelect").val());

	//$("#noteEvaluation_userSendNoteId").val($("#idSelect").val());
});

$(document).ready (function ()
{
	toggleBloc();
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

	function toggleBloc() {
		/*$(".blocToggle").eq(0).addClass("show");
		$(".blocToggle.show .child").show();

		$(".blocPartenaire .blocToggle").eq(0).removeClass("show");*/
		$(".blocPartenaire .blocToggle .child").hide();
		
		$(".toggleBloc").each(function () {
			$(this).click(function () {
				$(this).siblings(".child").slideToggle();
				$(this).parent().toggleClass("show");
			})
		})
	}
	
})
</script>
{/literal}
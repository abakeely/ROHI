<input type="hidden" name="iEvaluableValue" id="iEvaluableValue" value="1">
<input type="hidden" name="iClassificationValue" id="iClassificationValue" value="0">
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation2/css/raterater.css?v2">
<script type="text/javascript" src="{$zBasePath}assets/evaluation2/js/raterater.jquery.js?v2"></script>
<div id="evaluation-table">
<div id="information-table">

	<form enctype="multipart/form-data">
	<input type="hidden" name="iEvaluableValue" id="iEvaluableValue" value="1">
	<input type="hidden" name="iClassificationValue" id="iClassificationValue" value="0">
						<fieldset>
							<div class="headblock">

								<div class="left User-photo">
									<img src="{$zPathWithPhoto}" width="200">
								</div>
								<div class="User-details">
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
												<label>Prénom : {$oCandidat.0->prenom}</label>
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
								</div>
								<div class="clearfix"></div>
							</div>
							

							 <h3>Information administratives</h3>
							<div class="row1">
								<div class="cell" style="width:50%">
									<div class="field"> 
										<label>Province</label>
										<select id="iOrganisation_1" name="iProvinceId" onChange="getOrganisation('{$zBasePath}',1,this.value);">
											<option value="0">s&eacute;l&eacute;ctionner une province</option>
											{foreach from=$toProvince item=oProvince }
											<option {if $oProvince.id == $oCandidat.0->province_id} selected="selected" {/if} value="{$oProvince.id}">{$oProvince.libele}</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="cell" style="width:50%">
									<div class="field"> 
										<label>Région</label>
										<select id="iOrganisation_2" name="iRegionId" onChange="getOrganisation('{$zBasePath}',2,this.value);">
											<option value="0">s&eacute;l&eacute;ctionner une région</option>
											{foreach from=$toRegion item=oRegion }
											<option {if $oRegion.id == $oCandidat.0->region_id} selected="selected" {/if} value="{$oRegion.id}">{$oRegion.libele}</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row1">
								<div class="cell" style="width:50%">
									<div class="field"> 
										<label>District</label>
										<select id="iOrganisation_3" name="iDistrictId" onChange="getOrganisation('{$zBasePath}',3,this.value);">
											<option value="0">s&eacute;l&eacute;ctionner un district</option>
											{foreach from=$toDistrict item=oDistrict }
											<option {if $oDistrict.id == $oCandidat.0->district_id} selected="selected" {/if} value="{$oDistrict.id}">{$oDistrict.libele}</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="cell" style="width:50%">
									<div class="field"> 
										<label>Departement</label>
										<select id="iOrganisation_4" name="iDepartementId" onChange="getOrganisation('{$zBasePath}',4,this.value);">
											<option value="0">s&eacute;l&eacute;ctionner un d&eacute;partement</option>
											{foreach from=$oDepartement item=oDepartement }
											<option {if $oDepartement.id == $oCandidat.0->departement} selected="selected" {/if} value="{$oDepartement.id}">{$oDepartement.libele}</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row1">
								<div class="cell"  style="width:50%">
									<div class="field"> 
										<label>Direction</label>
										<select id="iOrganisation_5" name="iDirectionId" onChange="getOrganisation('{$zBasePath}',5,this.value);">
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
										<select id="iOrganisation_6" name="iServiceId" onChange="getOrganisation('{$zBasePath}',6,this.value);">
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
										<select id="iOrganisation_7" name="iDivisionId" >
											<option value="0">s&eacute;l&eacute;ctionner une division</option>
											{foreach from=$oDivision item=oDivision }
											<option {if $oDivision.id == $oCandidat.0->division} selected="selected" {/if} value="{$oDivision.id}">{$oDivision.libele}</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row ">
								<div class="cell">
									<div class="field">
										<label>Période</label>
										<select name="iMoisPost" id="iMoisPost" onChange="setAnneeEvaluation(this.value)">
												<!--
												<option {if $iMoisSelected == 3}selected="selected"{/if} value="3">3e Trimestre (Juillet, Août, Septembre)</option>-->
												<option value="4" {if $iMoisSelected == 4}selected="selected"{/if}>4e Trimestre (D&eacute;c,Janv,F&eacute;v)&nbsp;&nbsp;</option>
												<option {if $iMoisSelected == 1}selected="selected"{/if} value="1">1er Trimestre (Mars, Avril, Mai)&nbsp;&nbsp;</option>
												<option {if $iMoisSelected == 2}selected="selected"{/if} value="2">2e Trimestre (Juin, Juillet, Août)</option>
												
										</select>
									</div>
								</div>
							</div>
							<div class="clearfix">
								<div class="cell small">
									<div class="field">
										<label>Année</label>
										<select name="iAnneePost" id="iAnneePost" onChange="setMoisEvaluation(this.value)">
											{assign var=iAnneeMoinsUn value=$zAnneeAffiche-1}
											<option {if $iAnneeSelected == $iAnneeMoinsUn}selected="selected"{/if} value="{$iAnneeMoinsUn}">{$iAnneeMoinsUn}-{$zAnneeAffiche}&nbsp;&nbsp;&nbsp;&nbsp;</option>
											<option {if $iAnneeSelected == $zAnneeAffiche}selected="selected"{/if} value="{$zAnneeAffiche}">{$zAnneeAffiche}&nbsp;&nbsp;&nbsp;&nbsp;</option>
										</select>
									</div>
								</div>
							</div>
							<div class=" clearfix">
								<div class="cell" style="color:red;">
									<label><strong>Evaluable *</strong></label>

									<div class="field">
										Oui : <input class="evaluable" id="iCandidatEvaluable"
													 name="iCandidatEvaluable" checked="checked"
													 value="1" type="radio">
										Non : <input class="evaluable" id="iCandidatEvaluable"
													 name="iCandidatEvaluable" value="0"
													 type="radio">
									</div>
								</div>
							</div>

							<!--<div class="clearfix">
								<div class="cell">
									<label>Nom evaluateur *</label>

									<div class="field" id="searchCandidat"
										 style="display:block">
										<input
												placeholder="Veuillez entrer le nom de l'evaluateur"
												type="text" id="zCandidatSearch"
												name="zCandidatSearch">
									</div>
								</div>
							</div>-->

							<div id="blocEvaluable" style="display:block">

								<div class=" clearfix">
									<div class="cell">
										<label><strong>CATEGORIES *</strong></label>

										<div class="field">
											<input class="iClassificationClass"
												   id="iClassification" name="iClassification"
												   value="2" type="radio">Agent de surface
											<br>
											<input class="iClassificationClass"
												   id="iClassification" name="iClassification"
												   value="1" type="radio">Agent d'exécution
											<br>
											<input class="iClassificationClass"
												   id="iClassification" name="iClassification"
												   value="3" type="radio">Cadre supérieur
										</div>
									</div>
								</div>

								<div class="clearfix">
									<div class="cell">
										<label><i style="color:black;font-size:20px;"
												  class="la la-hand-o-right"
												  aria-hidden="true"></i>&nbsp;(Cliquer <a
												style="color:red;"
												href="{$zBasePath}critere/liste/agent-evaluation/classification"
												target="_blank">ici</a> pour voir les
											catégories)</label>
									</div>
								</div>

								<table id="noteCritere">
									
								</table>
							</div>
						</fieldset>
					</form>

</div>
<div id="historiqueCandidat">
		<!----------------- bloc Toogle ---------------->
		<div class="blocToggle">
			<div class="toggleBloc">
				<div class="row separateur separateur1">
					<div class="col-md-12">Les notes précédentes (cliquer ici)</div>
				</div>
			</div>
			<div class="child">
				<!----------------- bloc Toogle ---------------->
				<form>
					<table class="table table-striped table-bordered table-hover"
						   id="dataTables-example">
						<thead>
						<tr>
							<th>Date</th>
							<th>Evaluateur</th>
							<th>Moyenne</th>
							<th>Evaluable</th>
							<th>Période</th>
							<th>Année</th>
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
								<td>{if $oListeHistorique.fMoyenneNote!='0'}{$oListeHistorique.fMoyenneNote|number_format:1:",":"."} / 20{/if}</td>
								<td>{if $oListeHistorique.noteEvaluation_evaluable == 1}Oui{else}Non{/if}</td>
								<td>{$oListeHistorique.periode}</td>
								<td>{$oListeHistorique.noteEvaluation_anneeNote}</td>
								<td><a href="{$zBasePath}cv/fpdf_feNew/{$oListeHistorique.iCandidatId}?iDate={$oListeHistorique.noteEvaluation_id}" target="_blank"><i class="la la-file-pdf-o" aria-hidden="true" tada-toggle="tooltip" data-original-title="Fiche Evaluation"></i></a>
								&nbsp;&nbsp;<a href="#" title="" class="tooltip">
											Récapitulation
											<span style="width:500px;top:-350px;left:-300px;background: rgb(54, 133, 152);color:white;">	
													<h1 class="recap" style="text-align:center">{$oListeHistorique.periode}</h1>
													<br/>
													{$oListeHistorique.zCritereAndNote}
											</span>
										</a>
								</td>
							</tr>
							{assign var=iIncrement value=$iIncrement+1}
							{/foreach}
							{else}
							<tr><td style="text-align:center;border:none" colspan="7">Aucune note pour l'agent</td></tr>
							{/if}
						</tbody>
					</table>

				</form>
				<!----------------- Fin bloc Toogle ---------------->
			</div>
		</div>
		<!----------------- Fin bloc Toogle ---------------->
</div>
</div>
{literal}
<style>
h1.recap {
	font-size:1.4em;
	color:white;
	font-weight:blod;
	border-bottom:1px solid white;
	padding-bottom:12px;
}
#noteCritere th { 
	border: 1px solid #e2e2e2!important;
	text-align:center;
	background: #357c6e;
	font-weight:bold;
}

#noteCritere td { 
	border: 1px solid #e2e2e2!important;
	color: #3d423e;
}

#noteCritere {
	margin:0!important ;
	font-size:1em!important;
}
.notationCritere
{
	margin:0!important ;
	border:none!important;
}

.etoile
{
	padding:5px!important ;
}
input[type=radio] {
    height:20px;
	width:20px; 
	vertical-align: middle;
}
</style>
<script>
function rateAlert(id, rating)
{
	zAffichageRating = rating.toFixed(1) ; 

	$("#note-" + id).val(zAffichageRating);
	$("#live-rating-" + id).html("<strong>" + zAffichageRating + " / 5</strong>");
}


function setAnneeEvaluation(_iMois){
	switch(_iMois) {
		case '1':
			$("#iAnnee").val('{/literal}{$zAnneeAffiche}{literal}');
			break;

		case '2':
			$("#iAnnee").val('{/literal}{$zAnneeAffiche}{literal}');
			break;
		
		case '3':
			$("#iAnnee").val('{/literal}{$zAnneeAffiche}{literal}');
			break;
		
		case '4':
			$("#iAnnee").val('{/literal}{$iAnneeMoinsUn}{literal}');
			break;

	}
}

function setMoisEvaluation(_iAnnee){
	switch(_iAnnee) {
		case '{/literal}{$iAnneeMoinsUn}{literal}':
			$("#iMois").val('4');
			break;

		case '{/literal}{$zAnneeAffiche}{literal}':
			$("#iMois").val('1');
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

		iClassificationValue = $("#iClassificationValue").val();

		if (iClassificationValue == 0) {
			alert("Veuillez choisir une catégorie");
		} else {

			iTestNote = 1 ; 
			var zAllNote = "";
			var zMessageError = "";
			iValue = $('#iManuel').is(':checked');

			$('.lesNotes').each(function()
			{
				if (zAllNote == '') {
					zAllNote +=  $(this).attr("zCritereId") + "-" + $(this).val() ; 
				} else {
					zAllNote += ';' + $(this).attr("zCritereId") + "-" + $(this).val()
				}
				
				
				if ($(this).val() == '' && $(this).attr("zCritereId") != 7)
				{
					iTestNote = 0;
					zMessageError += "- Veuillez sélectionner la note : " + $(this).attr("zLibelle") + "\n" ; 
				}

				if ($(this).attr("zCritereId") == 7 && iValue == true && $(this).val() == '') 
				{
					iTestNote = 0;
					zMessageError += "- Veuillez sélectionner la note : " + $(this).attr("zLibelle") + "\n" ; 
				}
			})

			if (iTestNote == 1){
				
				if ($("#zCandidatSearch").val() != '') {
					if (confirm ("Êtes vous sûr de vouloir valider ce note ?")) {
						var noteEvaluation_userSendNoteId = $("#zCandidatSearch").val() ; 
						
						var userANoteId = $("#userANoteId").val() ;
						
						iValue = $('#iManuel').is(':checked');
						fFloatNotePonctualiteOfUser = '';
						if (iValue == true){
							fFloatNotePonctualiteOfUser = 1 ; 
						}

						

						var iMois = $("#iMois").val() ; 
						var iAnnee = $("#iAnnee").val() ; 

						var iDepartementId = $("#iDepartementId").val() ; 
						var iDirectionId = $("#iOrganisation_1").val() ; 
						var iServiceId = $("#iOrganisation_2").val() ; 
						var iDivisionId = $("#iOrganisation_3").val() ; 

						$.ajax({
							url: "{/literal}{$zBasePath}{literal}critere/notationUserSaisiManuel/{/literal}{$iUserSaisie}{literal}" ,
							method: "POST",
							data: { zAllNote:zAllNote, userANoteId: userANoteId, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, iDepartementId:iDepartementId,iDirectionId:iDirectionId,iServiceId:iServiceId,iDivisionId:iDivisionId,iValueEvaluable:iValueEvaluable, fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser,iClassificationValue:iClassificationValue},
							success: function(data, textStatus, jqXHR) {
								if (data == 1) {
									alert("La note est enregistrée avec succès !");

									$.ajax({
										url: "{/literal}{$zBasePath}{literal}critere/getHistoriqueNoteAgent/"+ userANoteId + "?sdsdsd"  ,
										method: "GET",
										success: function(data, textStatus, jqXHR) {
											$("#historiqueCandidat").html(data);
										},
										async: false
									});
									
								} else {
									alert("Une note est déjà attibuée sur le couple Période/Année !");
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
				alert(zMessageError);
			}
		}
	} else {

		if ($("#zCandidatSearch").val() != '') {

			if (confirm ("Êtes vous sûr de confirmer que cet agent n'est pas evaluable pour le trimestre de l'année ?")) {
				var noteEvaluation_userSendNoteId = $("#zCandidatSearch").val() ; 
				
				var userANoteId = $("#userANoteId").val() ; 
				//var fFloatNotePonctualiteOfUser = '' ; 
				var iMois = $("#iMois").val() ; 
				var iAnnee = $("#iAnnee").val() ; 
				zAllNote = "";

				var iDepartementId = $("#iDepartementId").val() ; 
				var iDirectionId = $("#iOrganisation_1").val() ; 
				var iServiceId = $("#iOrganisation_2").val() ; 
				var iDivisionId = $("#iOrganisation_3").val() ; 

				$.ajax({
					url: "{/literal}{$zBasePath}{literal}critere/notationUserSaisiManuel/{/literal}{$iUserSaisie}{literal}" ,
					method: "POST",
					data: { zAllNote:zAllNote, userANoteId: userANoteId, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, iDepartementId:iDepartementId,iDirectionId:iDirectionId,iServiceId:iServiceId,iDivisionId:iDivisionId,iValueEvaluable:iValueEvaluable},
					success: function(data, textStatus, jqXHR) {
						if (data == 1) {
							alert("Enregistrement effectué !");

							$.ajax({
								url: "{/literal}{$zBasePath}{literal}critere/getHistoriqueNoteAgent/"+ userANoteId ,
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
	
	toggleBloc();
	$("#noteCritere").hide();
	// Link to open the dialog
	$( ".dialog-link" ).click(function( event ) {
		$("#dialog").html();
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getRecapitulation/",
			type: 'get',
			data: { iEvaluateur:1},
			success: function(data, textStatus, jqXHR) {
				
				//$("#dialog").html(data);	
				$("#dialog").dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});
	
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

	/*$('.iClassificationClass').click(function(){
		
		var iClassification = $(this).val();  
		$("#iClassificationValue").val(iClassification);

		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getClassification/"+ iClassification + "?sdsdsds" ,
			method: "GET",
			success: function(data, textStatus, jqXHR) {
				$("#noteCritere").html(data);
				$("#noteCritere").show();
			},
			async: false
		});
		
	});*/

	$('.iClassificationClass').click(function(){
		
		var iClassification = $(this).val();  
		$("#iClassificationValue").val(iClassification);

		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getClassification/"+ iClassification + "?sdsdsds" ,
			method: "POST",
			data: {iUserANoteId:{/literal}{$oCandidat.0->user_id}{literal}},
			success: function(data, textStatus, jqXHR) {
				$("#noteCritere").html(data);
				$("#noteCritere").show();
			},
			async: false
		});

		
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
</script>
{/literal}
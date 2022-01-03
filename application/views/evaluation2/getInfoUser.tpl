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

							<div class="row1">
								<div class="cell">
									<div class="field">
										<label>Période</label>
										<select name="iMoisPost" id="iMoisPost" onChange="setAnneeEvaluationGetUser(this)">
											{foreach from=$toPeriode item=oPeriode}
												{if $oPeriode->periode_id==sizeof($toPeriode)} {assign var=iLastPeriode value=$oPeriode->periode_id} {/if}
												<option iAnnee="{$oPeriode->periode_annee}" {if $oPeriode->periode_id==$iMoisSelected} selected="selected" {/if} value="{$oPeriode->periode_id}">&nbsp;{$oPeriode->periode_libelle} {$oPeriode->periode_annee} (&nbsp;{$oPeriode->periode_mois}&nbsp;)&nbsp;&nbsp;</option>
											{/foreach}
										</select>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="cell small">
									<div class="field">
										<label>Année</label>
										<select name="iAnneePost" id="iAnneePost" onChange="setMoisEvaluationGetUser(this)">
											<option iPeriode="4" {if $iAnneeSelected == 2016}selected="selected"{/if} value="2016">&nbsp;2016 / 2017</option>
											<option iPeriode="3" {if $iAnneeSelected == 2017}selected="selected"{/if} value="2017">&nbsp;2017</option>
											<option iPeriode="5" {if $iAnneeSelected == 2018}selected="selected"{/if} value="2018">&nbsp;2018</option>
											<option iPeriode="6" value="2019">&nbsp;2019</option>
											<option iPeriode="{$iLastPeriode}" {if $iAnneeSelected == 2020}selected="selected"{/if} value="2020">&nbsp;2020</option>
											<option iPeriode="{$iLastPeriode}" {if $iAnneeSelected == 2021}selected="selected"{/if} value="2021">&nbsp;2021</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="cell" style="color:red;">
									<label><strong>Evaluable *</strong></label>

									<div class="field">
										Oui : <input class="evaluable" id="iCandidatEvaluable" class="form-control"
													 name="iCandidatEvaluable" checked="checked"
													 value="1" type="radio">
										Non : <input class="evaluable" id="iCandidatEvaluable" class="form-control"
													 name="iCandidatEvaluable" value="0"
													 type="radio">
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<input type="hidden" name="iNotePonctualiteAssign" id="iNotePonctualiteAssign" value="">
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

							<div id="blocEvaluable11" >

								<div class=" clearfix">
									<div class="cell">
										<label><strong>CATEGORIES *</strong></label>

										<div class="field">
											<input class="iClassificationClass"
												   id="iClassification" name="iClassification" value="2" type="radio">&nbsp;&nbsp;Agent de surface
											<br>
											<input class="iClassificationClass" id="iClassification" name="iClassification" value="1" type="radio">&nbsp;&nbsp;Agent d'exécution
											<br>
											<input class="iClassificationClass" id="iClassification" name="iClassification" value="3" type="radio">&nbsp;&nbsp;Cadre supérieur
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
								<div class="hidden" id="beforeSend" style="height : 150px; margin-left: 40%;margin-top: 3%;">
									<span>Veuillez patienter....</span><br><br>
									<span id="loading4">
										<span id="outerCircle1"></span>
										<span id="innerCircle"></span>
									</span>
								</div>
								<table id="noteCritere" style="width:90%;position:absolute">
									  
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
/*h1.recap {
	font-size:1.4em;
	color:white;
	font-weight:blod;
	border-bottom:1px solid white;
	padding-bottom:12px;
}
#noteCritere th { 
	border: 1px solid #e2e2e2;
	text-align:center;
	background: #357c6e;
	font-weight:bold;
}*/

#noteCritere td { 
	border: 1px solid #e2e2e2;
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

#loading4 #innerCircle
	{
		display:block;
		position:absolute;
		margin:20px 0 0 20px;
		
		width:40px;
		height:40px;
		border-top:7px solid #06F;
		border-bottom:7px solid #06F;
		border-left:7px solid transparent;
		border-right:7px solid transparent;
		
		border-radius:40px;
		-moz-border-radius:40px;
		-webkit-border-radius:40px;
		-ms-border-radius:40px;
		-o-border-radius:40px;
		
		box-shadow:0 0 20px #06F;
		-webkit-box-shadow:0 0 20px #06F;
		-moz-box-shadow:0 0 20px #06F;
		-ms-box-shadow:0 0 20px #06F;
		-o-box-shadow:0 0 20px #06F;
		
		-webkit-animation: ccwSpin .555s linear .2s infinite;
		-moz-animation: ccwSpin .555s linear .2s infinite;
		-o-animation: ccwSpin .555s linear .2s infinite;
		-ms-animation: ccwSpin .555s linear .2s infinite;
		animation: ccwSpin .555s linear .2s infinite;
	}
	#loading4 #outerCircle1
	{
		display:block;
		position:absolute;
		margin:0 auto;

		width:80px;
		height:80px;
		border-top:7px solid #06F;
		border-bottom:7px solid transparent;
		border-left:7px solid transparent;
		border-right:7px solid 06F;
		
		border-radius:80px;
		-moz-border-radius:80px;
		-webkit-border-radius:80px;
		-ms-border-radius:80px;
		-o-border-radius:80px;
		
		-webkit-animation: cwSpin 1s linear .2s infinite;
		-moz-animation: cwSpin .666s linear .2s infinite;
		-o-animation: cwSpin .666s linear .2s infinite;
		-ms-animation: cwSpin .666s linear .2s infinite;
		animation: cwSpin .666s linear .2s infinite;
	}
	
	#loading4 #innerCircle
	{
		
		border-top:7px solid transparent;
		border-bottom:7px solid #06F;
		border-left:7px solid #06F;
		border-right:7px solid transparent;
		
		box-shadow:none;
		-moz-box-shadow:none;
		-ms-box-shadow:none;
		-o-box-shadow:none;
		-webkit-box-shadow:none;
	}
	
	@-webkit-keyframes cwSpin
	{
		0%{-webkit-transform:rotate(0deg);	}
		100%{-webkit-transform:rotate(360deg); }
	}
	@-moz-keyframes cwSpin
	{
		0%{-moz-transform:rotate(0deg);	}
		100%{-moz-transform:rotate(360deg); }
	}
	@-ms-keyframes cwSpin
	{
		0%{-ms-transform:rotate(0deg);	}
		100%{-ms-transform:rotate(360deg); }
	}
	@-o-keyframes cwSpin
	{
		0%{-o-transform:rotate(0deg);	}
		100%{-o-transform:rotate(360deg); }
	}
	@keyframes cwSpin
	{
		0%{transform:rotate(0deg);	}
		100%{transform:rotate(360deg); }
	}

	@-webkit-keyframes ccwSpin
	{
		0%{-webkit-transform:rotate(0deg);	}
		100%{-webkit-transform:rotate(-360deg); }
	}
	@-moz-keyframes ccwSpin
	{
		0%{-moz-transform:rotate(0deg);	}
		100%{-moz-transform:rotate(-360deg); }
	}
	@-ms-keyframes ccwSpin
	{
		0%{-ms-transform:rotate(0deg);	}
		100%{-ms-transform:rotate(-360deg); }
	}
	@-o-keyframes ccwSpin
	{
		0%{-o-transform:rotate(0deg);	}
		100%{-o-transform:rotate(-360deg); }
	}
	@keyframes ccwSpin
	{
		0%{transform:rotate(0deg);	}
		100%{transform:rotate(-360deg); }
	}
</style>
<script>
function rateAlert(id, rating)
{
	zAffichageRating = rating.toFixed(1) ; 

	$("#note-" + id).val(zAffichageRating);
	$("#live-rating-" + id).html("<strong>" + zAffichageRating + " / 5</strong>");
}

function setAnneeEvaluationGetUser(_this){

	var zAnnee = $('option:selected', _this).attr('iAnnee');
    $("#iAnneePost").val(zAnnee);

	var iClassification = $('input[name=iClassification]:checked').val();
	if(iClassification){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getClassification/"+ iClassification + "?sdsdsds1111" ,
			method: "POST",
			data: {
				iUserANoteId:{/literal}{$oCandidat.0->user_id}{literal},
				iPeriode : $('#iMoisPost').val(),
				iAnnee : $('#iAnneePost').val()
			},
			beforeSend:function(){
				$("#beforeSend").removeClass('hidden');
				$("#noteCritere").hide();
			},
			success: function(data, textStatus, jqXHR) {
				$("#beforeSend").addClass('hidden');
				var oResult = $.parseJSON(data);
				$("#noteCritere").html(oResult.zInfoUser);
				$("#iNotePonctualiteAssign").val(oResult.iMoyenneUserInfoPointage);
				$("#noteCritere").show();
			},
			async: true
		});
	}
}

function setMoisEvaluationGetUser(_this){
	/*switch(_iAnnee) {
		case '{/literal}{$iAnneeMoinsUn}{literal}':
			$("#iMoisPost").val('4');
			break;

		case '{/literal}{$zAnneeAffiche}{literal}':
			$("#iMoisPost").val('1');
			break;
	}*/

	var iPeriode = $('option:selected', _this).attr('iPeriode');
    $("#iMoisPost").val(iPeriode);


	var iClassification = $('input[name=iClassification]:checked').val();
	if(iClassification){
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getClassification/"+ iClassification + "?sdsdsds" ,
			method: "POST",
			data: {
				iUserANoteId:{/literal}{$oCandidat.0->user_id}{literal},
				iPeriode : $('#iMoisPost').val(),
				iAnnee : $('#iAnneePost').val()
			},
			beforeSend:function(){
				$("#beforeSend").removeClass('hidden');
				$("#noteCritere").hide();
			},
			success: function(data, textStatus, jqXHR) {
				$("#beforeSend").addClass('hidden');
				$("#noteCritere").html(data);
				$("#noteCritere").show();
			},
			async: true
		});
	}
}

/* Here we initialize raterater on our rating boxes
 */
$(function() {
    $("#userANoteId").val({/literal}{$oCandidat.0->user_id}{literal});
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
});


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
			data: {
				iUserANoteId:{/literal}{$oCandidat.0->user_id}{literal},
				iPeriode : $('#iMoisPost').val(),
				iAnnee : $('#iAnneePost').val()
			},
			beforeSend:function(){
				$("#beforeSend").removeClass('hidden');
				$("#noteCritere").hide();
				$("#historiqueCandidat").hide();
			},
			success: function(data, textStatus, jqXHR) {
				$('#dialog').dialog({ height: 950 });
				$("#beforeSend").addClass('hidden');

				var oResult = $.parseJSON(data);
				$("#noteCritere").html(oResult.zInfoUser);
				$("#iNotePonctualiteAssign").val(oResult.iMoyenneUserInfoPointage);
				$("#noteCritere").show();
			},
			async: true
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

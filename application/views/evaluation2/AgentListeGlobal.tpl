{include_php file=$zCssJs}
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation2/css/raterater.css?v2">
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation2/js/jquery-ui.css?v2">
<script type="text/javascript" src="{$zBasePath}assets/evaluation2/js/raterater.jquery.js?v2"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.iUserId}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
{include_php file=$zHeader}
<div id="container">
	<div id="breadcrumb"><a href="{$zBasePath}">Accueil</a> <span>&gt;</span> <a href="#">RH</a> <span>&gt;</span> <a href="#">Evaluation</a> <span>&gt;</span>{$oData.zLibelle} </div>
	
    <section id="content">
        {include_php file=$zLeft}	
		<div id="innerContent">
		<div id="ContentBloc">
		<h2>Liste des Agents &agrave; Evaluer</h2>
		<div class="contenuePage">
		<!--*Debut Contenue*-->
		<div class="col-xs-12">
		<form action="{$zBasePath}evaluation/liste/agent-evaluation/a-evaluer" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
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
							<input type="submit" class="button" name="" id="" value="rechercher">
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		</div>
		</div>
		<div class="contenuePage">
		<!--*Debut Contenue*-->
		<div class="table-responsive">
								<table class="datatable table-bordered table-striped mb-0 ">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Pr&eacute;nom</th>
						<th>Matricule</th>
						<th class="center" width="100">Action</th>
					</tr>
				</thead>
				<tbody>
					{assign var=iIncrement value="0"}
					{if sizeof($oData.oListe)>0}
					{foreach from=$oData.oListe item=oListeAgent }
					<tr {if $iIncrement%2 == 0} class="even" {/if}>
						<td>{$oListeAgent.nom}</td>
						<td>{$oListeAgent.prenom}</td>
						<td>{$oListeAgent.matricule}</td>
						<td class="center">
							<a href="#" title="Note Evaluation" iAgentId="{$oListeAgent.user_id}" class="evaluer dialog-link"><i style="color:#12105A" title="Modifier" alt="Modifier" class="la la-newspaper-o"></i></a>
						</td>
					</tr>
					{assign var=iIncrement value=$iIncrement+1}
					{/foreach}
					{else}
					<tr><td style="text-align:center;" colspan="4">Aucun enregistrement correspondant</td></tr>
					{/if}
				</tbody>
			</table>
			{$oData.zPagination}
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
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}evaluation/liste/agent-evaluation/global">
</form>
<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
	
</div>
{literal}
	<style>

	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	.padding-info p{
		padding:5px;
	}
	.dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	select {
		width: 200px;
	}
	.ui-dialog .ui-dialog-content {
		position: relative;
		border: 0;
		padding: .5em 1em;
		background: none;
		overflow: auto;
	}
	</style>
<script>
$(document).ready (function ()
{
	$( "#dialog" ).dialog({
		autoOpen: false,
		width: '90%',
		height:850,
		title: 'Fiche note évaluation',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {
					//$( this ).dialog( "close" );

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
											var noteEvaluation_userSendNoteId = $("#noteEvaluation_userSendNoteId").val() ; 
											
											var userANoteId = $("#userANoteId").val() ;
											
											iValue = $('#iManuel').is(':checked');
											fFloatNotePonctualiteOfUser = '';
											if (iValue == true){
												fFloatNotePonctualiteOfUser = 1 ; 
											}

											var iMois = $("#iMois").val() ; 
											var iAnnee = $("#iAnnee").val() ; 

											$.ajax({
												url: "{/literal}{$zBasePath}{literal}critere/notationUser/{/literal}{$iUserSaisie}{literal}" ,
												method: "POST",
												data: { zAllNote:zAllNote, userANoteId: userANoteId, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser,iClassificationValue:iClassificationValue},
												success: function(data, textStatus, jqXHR) {
													if (data == 1) {
														alert("La note est enregistrée avec succès !");
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
									var noteEvaluation_userSendNoteId = $("#noteEvaluation_userSendNoteId").val() ; 
									
									var userANoteId = $("#userANoteId").val() ; 
									//var fFloatNotePonctualiteOfUser = '' ; 
									var iMois = $("#iMois").val() ; 
									var iAnnee = $("#iAnnee").val() ; 
									zAllNote = "";


									$.ajax({
										url: "{/literal}{$zBasePath}{literal}critere/notationUser/{/literal}{$iUserSaisie}{literal}" ,
										method: "POST",
										data: { zAllNote:zAllNote, userANoteId: userANoteId, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee, iValueEvaluable:iValueEvaluable},
										success: function(data, textStatus, jqXHR) {
											if (data == 1) {
												alert("Enregistrement effectué !");
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
			},
			{
				text: "Annuler",
				click: function() {
					$( this ).dialog( "close" );
				}
			}
		]
	});

	// Link to open the dialog
	$( ".dialog-link" ).click(function( event ) {
		$("#userANoteId").val("");
		$("#noteOfUserId").val("");
		$("#dialog").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoUser/" + iUserId ,
			type: 'get',
			data: { iEvaluateur:1},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog").html(data);	
				$( "#dialog" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	// Hover states on the static widgets
	$( ".dialog-link, #icons li" ).hover(
		function() {
			$( this ).addClass( "ui-state-hover" );
		},
		function() {
			$( this ).removeClass( "ui-state-hover" );
		}
	);
})
</script>
{/literal}
{include_php file=$zFooter}
</div>

</body>
</html>
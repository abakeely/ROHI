{include_php file=$zHeader }
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation/css/raterater.css?v1">
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation/js/jquery-ui.css?v1">
{* <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css?v1" rel="stylesheet"/> *}
<script type="text/javascript" src="{$zBasePath}assets/evaluation/js/raterater.jquery.js?v1"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.user_id}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
		
	</div>
	<div id="innerContent">
		<h2>Liste des Agents &agrave; Evaluer</h2>
		<div class="card punch-status">
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
		<div><p>&nbsp;</p></div>
		<table>
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
</section>
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
		width: '95%',
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
					
						if ($("#noteOfUserId").val() != "" && $("#userANoteId").val() != ""){
							
							if (confirm ("Êtes vous sûr de vouloir valider ce note ?")) {
								var noteEvaluation_userSendNoteId = $("#iEvaluateur").val() ; 
								var fFloatNoteOfUser = $("#noteOfUserId").val() ; 
								var userANoteId = $("#userANoteId").val() ; 

								iValue = $('#iManuel').is(':checked');
								fFloatNotePonctualiteOfUser = '';
								if (iValue == true){
									var fFloatNotePonctualiteOfUser = $("#notePonctualiteOfUserId").val() ; 
								}
								var iMois = $("#iMois").val() ; 
								var iAnnee = $("#iAnnee").val() ; 
								$.ajax({
									url: "{/literal}{$zBasePath}{literal}evaluation/notationUser/" ,
									method: "POST",
									data: { fFloatNoteOfUser: fFloatNoteOfUser, userANoteId: userANoteId,fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee,iValueEvaluable:iValueEvaluable  },
									success: function(data, textStatus, jqXHR) {
										if (data == 1) {
											//alert("La note est enregistrée avec succès !");
											
										} else {
											alert("Une note est déjà attibuée sur le couple Mois/Année !");
										}
										$( "#dialog" ).dialog( "close" );
									},
									async: false
								});
							}
						} else {
							alert("Veuillez sélectionner la note dans les étoiles !");
						}
					} else {
						if (confirm ("Êtes vous sûr de confirmer que cet agent n'est pas evaluable pour le couple mois/année ?")) {
							var noteEvaluation_userSendNoteId = '' ; 
							var fFloatNoteOfUser = '' ; 
							var userANoteId = $("#userANoteId").val() ; 

							iValue = $('#iManuel').is(':checked');
							fFloatNotePonctualiteOfUser = '';
							if (iValue == false){
								var fFloatNotePonctualiteOfUser = '' ; 
							}
							var iMois = $("#iMois").val() ; 
							var iAnnee = $("#iAnnee").val() ; 
							$.ajax({
								url: "{/literal}{$zBasePath}{literal}evaluation/notationUser/" ,
								method: "POST",
								data: { fFloatNoteOfUser: fFloatNoteOfUser, userANoteId: userANoteId,fFloatNotePonctualiteOfUser:fFloatNotePonctualiteOfUser, noteEvaluation_userSendNoteId:noteEvaluation_userSendNoteId,iMois:iMois, iAnnee:iAnnee,iValueEvaluable:iValueEvaluable  },
								success: function(data, textStatus, jqXHR) {
									if (data == 1) {
										alert("Enregistrement effectué!");
										
									} else {
										alert("Une note est déjà attibuée sur le couple Mois/Année !");
									}
									$( "#dialog" ).dialog( "close" );
								},
								async: false
							});
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
		noteEvaluation_userSendNoteId = $("#noteEvaluation_userSendNoteId").val();
		$("#dialog").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}evaluation/getInfoUser/" + iUserId,
			method: "POST",
			data: { iEvaluateur: noteEvaluation_userSendNoteId},
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
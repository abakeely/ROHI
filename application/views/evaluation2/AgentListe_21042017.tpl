{include_php file=$zHeader }
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation2/css/raterater.css?v2">
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/evaluation2/js/jquery-ui.css?v2">
<script type="text/javascript" src="{$zBasePath}assets/evaluation2/js/raterater.jquery.js?v2"></script>
<script src="{$zBasePath}assets/js/jquery.dataTables.js?V2"></script>
<script src="{$zBasePath}assets/js/dataTables.bootstrap.js?V2"></script>
<form name="notation" id="notation" method="post">
<input type="hidden" name="noteEvaluation_userSendNoteId" id="noteEvaluation_userSendNoteId" value="{$oData.iUserId}">
<input type="hidden" name="userANoteId" id="userANoteId" value="">
<input type="hidden" name="noteOfUserId" id="noteOfUserId" value="">
<input type="hidden" name="notePonctualiteOfUserId" id="notePonctualiteOfUserId" value="">
</form>
{literal}
	<style>
	.tab-link span {
		display: inline-block;
		width: 20px;
		/*height: 20px;*/
		background: #f02a2a;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
		-o-border-radius: 20px;
		border-radius: 20px;
		color: white;
		text-align: center;
		position: relative;
		top: -2px;
		line-height: 18px;
		margin: 0 0 0 5px;
		font-size: 0.8em;
	}
	.container{
		margin-top: 100px;
		margin-bottom:100px;
		line-height: 1.6;
		
		margin: 0 auto;
	}
	ul.tabs{
		margin: 0px;
		padding: 0px!important;
		list-style: none;
	}
	ul.tabs li{
		background: none;
		display: inline-block;
		padding: 10px 15px!important;
		cursor: pointer;
		border-radius: 10px 10px 0 0;
		font-size:1.4em!important;
		background: -webkit-gradient(linear,left top,left bottom,from(rgb(211, 224, 204)),to(#a2a7a0));
		color: #3d423e;
	}

	ul.tabs li.current{
		background: #ededed;
		color:#FFF;
		background: -webkit-gradient(linear,left top,left bottom,from(#5d919c),to(#1d3f46));
	}

	.tab-content{
		display: none;
		padding: 20px;
		padding-bottom: 50px;
		border: 2px solid #109ab8;
		border-radius: 0 30px 10px 10px;
	}

	.tab-content.current{
		display: inherit;
	}
	</style>
{/literal}
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
	</div>
	<div id="innerContent">
		<h2>Liste des Agents &agrave; Evaluer</h2>
		{*<div class="card punch-status">
		<form action="{$zBasePath}critere/liste/agent-evaluation/a-evaluer" method="POST" name="formulaireSearch" id="formulaireSearch" enctype="multipart/form-data">
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
				<div class="row1 {if $oData.iCompteActif == COMPTE_AGENT}clearfix{/if}">
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
							<input type="submit" class="button" name="" id="" value="rechercher">
						</div>
					</div>
				</div>
			</fieldset>
		</form>
		</div>
		<div>
		<p>&nbsp;</p> *}
		<div class="container">
		<ul class="tabs">
			<li class="tab-link current" iModeId="1" data-tab="tab-1">Les agents qui ne sont pas encore évalués pour le {$oData.zLibelle} <span id="span_1" {if $oData.iSpan1==0}style="display:none"{/if}>{$oData.iSpan1}</span></li>
			<li class="tab-link" iModeId="2" data-tab="tab-2">Les agents déjà évalués pour le {$oData.zLibelle}<span id="span_2" {if $oData.iSpan2==0}style="display:none"{/if}>{$oData.iSpan2}</span></li>
		</ul>

		<div id="tab-1" class="tab-content current">
				<table id="table-liste-evaluer-1">
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
								{if $oListeAgent.iLocaliteChange > 0}
								<span id="iLocalChangeAgentId_{$oListeAgent.user_id}">
								<a href="#" title="Changement localit&eacute; de service" iAgentId="{$oListeAgent.user_id}"  class="evaluer dialog-link-localite"><i style="color:#4d8d00;font-size:15px;" title="Modifier" alt="Modifier" class="la la-check-square-o"></i></a>&nbsp;&nbsp;</span>
								{/if}
								<a href="#" title="Note Evaluation" iAgentId="{$oListeAgent.user_id}" class="evaluer dialog-link"><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-newspaper-o"></i></a>&nbsp;&nbsp;
								<a href="#" title="Changement manuel localité service" iAgentId="{$oListeAgent.user_id}" class="evaluer dialog-link-manuel-localite"><i style="color:#12105A;font-size:15px;" title="changement localité service" alt="chagement localité service" class="la la-credit-card"></i></a>
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
		<div id="tab-2" class="tab-content">
			<table id="table-liste-evaluer-2">
					<thead>
						<tr>
							<th>Nom</th>
							<th>Pr&eacute;nom</th>
							<th>Matricule</th>
							<th class="center" width="100">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr><td style="text-align:center;" colspan="4">Aucun enregistrement correspondant</td></tr>
					</tbody>
				</table>

		</div>
		</div>
		
		<p>&nbsp;</p>
		<div class="card punch-status">
		<p style="color:red"> Les boutons actions : </p>
		<p><i style="color:#4d8d00;font-size:15px;" title="Modifier" alt="Modifier" class="la la-check-square-o"></i> : Validation changement localité de service (s'il y a une demande de l'agent)</p>
		<p><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-newspaper-o"></i> : Evaluation Agent</p>
		<p><i style="color:#12105A;font-size:15px;" title="Modifier" alt="Modifier" class="la la-credit-card"></i> : Changement manuel de la localité de service d'un agent / Supprimer un agent de la liste des évalués</p>
		</div>
		</div>
		<p>&nbsp;</p>
	</div>
</section>
</form>
<form name="formDelete" id="formDelete" action="" method="POST">
<input type="hidden" name="zUrl" id="zUrl" value="{$zBasePath}evaluation/liste/agent-evaluation/global">
</form>
<!-- ui-dialog -->
<div id="dialog" title="Dialog Title">
</div>
<div id="dialog2" title="Dialog Title">
</div>
<div id="dialog3" title="Dialog Title">
</div>
<div id="dialog4" title="Dialog Title" style="display:none;overflow-x: hidden;margin-top:2%;">
<p>&nbsp;</p>
<h2 style="font-size:22px;text-align:center;color:#538239;">Liste des agents qui ne sont pas encore évalués et de même direction que vous</h2>
<br/>
<h2 style="font-size:22px;text-align:center;color:#538239;text-decoration:blink">Si vous êtes son évaluateur, veuillez appouver. merci!</h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table class="table table-striped table-bordered table-hover" id="dataTables-dialog4">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Pr&eacute;nom</th>
			<th>Matricule</th>
			<th>D&eacute;partement</th>
			<th>Direction</th>
			<th>Service</th>
			<th>Approuver</th>
		</tr>
	</thead>
	<tbody>
		{assign var=iIncrement value="0"}
		{if sizeof($oData.toListeApprouver)>0}
		{foreach from=$oData.toListeApprouver item=oListeApprouver }
		<tr {if $iIncrement%2 == 0} class="even" {/if}>
			<td>{$oListeApprouver->nom}</td>
			<td>{$oListeApprouver->prenom}</td>
			<td>{$oListeApprouver->matricule}</td>
			<td>{$oListeApprouver->zDepartement}</td>
			<td>{$oListeApprouver->zDirection}</td>
			<td>{$oListeApprouver->zService}</td>
			<td style="text-align:center;"><input type="checkbox" class="approuver" getUserId="{$oListeApprouver->user_id}" id="iApprouver_{$oListeApprouver->user_id}" name="iApprouver_{$oListeApprouver->user_id}" value="1"></td>
		</tr>
		{assign var=iIncrement value=$iIncrement+1}
		{/foreach}
		{else}
		<tr><td style="text-align:center;border:none" colspan="7"></td></tr>
		{/if}
	</tbody>
</table>
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
	input[type=checkbox] {
		height: 18px;
		width: 18px;
		vertical-align: middle;
	}

	.btn {
		color: #FFF!important;
		text-shadow: 0 -1px 0 rgba(0,0,0,.25);
		background-image: none!important;
		border: 5px solid #FFF;
		border-radius: 0;
		box-shadow: none!important;
		-webkit-transition: background-color .15s,border-color .15s,opacity .15s;
		-o-transition: background-color .15s,border-color .15s,opacity .15s;
		transition: background-color .15s,border-color .15s,opacity .15s;
		vertical-align: middle;
		margin: 0;
		position: relative;
		width:500px;
	}
	</style>
<script>
function getTable(_iMode) {
	
	$(document).ready (function ()
	{
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getListeANoterOuDejaNoter" ,
			method: "POST",
			data: { iModeId:_iMode},
			success: function(data, textStatus, jqXHR) {
				var oReturn = jQuery.parseJSON(data);
				$("#tab-"+_iMode).html(oReturn.zHtmlReturn);
				if (oReturn.iSpan1 > 0) {
					$("#span_1").html(oReturn.iSpan1);
					$("#span_1").show();
				} else {
					$("#span_1").hide();
				}

				if (oReturn.iSpan2 > 0) {
					$("#span_2").html(oReturn.iSpan2);
					$("#span_2").show();
				} else {
					$("#span_2").hide();
				}
			},
			async: false
		});
	});
}
$(document).ready (function ()
{
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');
		var iModeId = $(this).attr('iModeId');
		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');
		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
		getTable(iModeId) ; 
		
	})

	

	$( "#dialog" ).dialog({
		autoOpen: false,
		width: '90%',
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
								iMoyenneUserInfoPointage = $("#iMoyenneUserInfoPointage").val();

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

									if (($(this).attr("zCritereId") == 7 && iValue == true && $(this).val() == '') || ($(this).attr("zCritereId") == 7 && iValue == false && iMoyenneUserInfoPointage=='' && $(this).val() == '')) 
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
														getTable(1);
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
											getTable(1);
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

	$( "#dialog2" ).dialog({
		autoOpen: false,
		width: '50%',
		title: 'Validation changement localité de service',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {

					var iUserId = $("#iUserId").val();
					$.ajax({
						url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteService/" ,
						type: 'Post',
						data: { iUserId:iUserId},
						success: function(data, textStatus, jqXHR) {
							
							$("#iLocalChangeAgentId_"+iUserId).hide();
							$( "#dialog2" ).html();
							$( "#dialog2" ).dialog( "close" );
							event.preventDefault();
						},
						async: false
					});
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
	$( "#dialog4" ).dialog({
		autoOpen: false,
		width: '60%',
		title: 'Notification',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {
						
						var iTest = 0;
						var zListe = "";
						$('.approuver').each(function()
						{
							
							var iValue = $(this).is(':checked'); 
							if (iValue == true) {
								
								iUserId = $(this).attr("getUserId");

								if (zListe == '') {
									zListe += iUserId;
									iTest = 1;
								} else {
									zListe += "-" + iUserId;
									iTest = 1;
								}
							}
							
						})

						if (iTest == 0) {
							alert("Veuillez cocher au moins un agent si vous voulez valider")
						} else {
							$.ajax({
								url: "{/literal}{$zBasePath}{literal}critere/saveUpdateUser/" ,
								method: "POST",
								data: { zListe:zListe},
								success: function(data, textStatus, jqXHR) {
									
									$( "#dialog4" ).dialog( "close" );
									document.location.href = '{/literal}{$zBasePath}{literal}critere/liste/agent-evaluation/a-evaluer/2';
									//window.location.reload();
								},
								async: false
							});
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

	$( "#dialog3" ).dialog({
		autoOpen: false,
		width: '75%',
		title: 'Changement manuel localité de service d\'un agent',
		close: 'X',
		modal: true,
		buttons: [
			{
				text: "Valider",
				click: function() {

					var iTestValid = 1 ; 
					var zMessage = "";
					var iUserId = $("#iUserId").val();
					var iDepartementId		= $('#iDepartementId').val();
					var iDirection			= $('#iOrganisation_1').val();
					var iService			= $('#iOrganisation_2').val();
					var iDivision			= $('#iOrganisation_3').val();
					var iDesevaluer			= $("#iDesevaluer").val();
					var zMotifSuppression	= $("#zMotifSuppression").val();

					if (iDepartementId == '' || iDepartementId ==0) {
						var iTestValid = 0 ; 
						zMessage += "- Veuillez sélectionner un département\n" ; 
					}

					if (iDirection == '' || iDirection ==0) {
						var iTestValid = 0 ; 
						zMessage += "- Veuillez sélectionner une direction\n" ; 
					}

					if (iService == '' || iService ==0) {
						var iTestValid = 0 ; 
						zMessage += "- Veuillez sélectionner un service\n" ; 
					}

					if (iDesevaluer == 1) {
						if (zMotifSuppression == ''){
							var iTestValid = 0 ; 
							zMessage += "- Veuillez remplir le motifs de la suppresion\n" ; 
						}
					}

					if (iTestValid == 1) {

							$.ajax({
								url: "{/literal}{$zBasePath}{literal}critere/saveLocaliteServiceEvaluateur/" ,
								method: "POST",
								data: { iUserId:iUserId,iDepartementId:iDepartementId, iDirection:iDirection, iService:iService, iDivision:iDivision, iDesevaluer:iDesevaluer,zMotifSuppression:zMotifSuppression},
								success: function(data, textStatus, jqXHR) {
									
									$( "#dialog3" ).dialog( "close" );
									window.location.reload();
								},
								async: false
							});

					} else {
						alert(zMessage);
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

	$( ".dialog-link-localite" ).click(function( event ) {
		$("#dialog2").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoUserChangeLocalite/" + iUserId ,
			type: 'get',
			data: { iEvaluateur:1},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog2").html(data);	
				$( "#dialog2" ).dialog( "open" );
				
				event.preventDefault();
			},
			async: false
		});
		
	});

	$( ".dialog-link-manuel-localite" ).click(function( event ) {
		$("#dialog3").html();
		var iUserId = $(this).attr("iAgentId");
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}critere/getInfoChangeManuel/" + iUserId ,
			type: 'get',
			data: { iEvaluateur:1},
			success: function(data, textStatus, jqXHR) {
				
				$("#dialog3").html(data);	
				$( "#dialog3" ).dialog( "open" );
				
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

	{/literal}
	{if sizeof($oData.toListeApprouver)>0 && $oData.iCurrPage ==1}
	{literal}
	$( "#dialog4" ).dialog( "open" );
	$("#dataTables-dialog4").dataTable();
	{/literal}
	{/if}
	{literal}

	{/literal}
	{if sizeof($oData.oListe)>0}
	{literal}
	$("#table-liste-evaluer-1").dataTable();
	{/literal}
	{/if}
	{literal}
})
</script>
{/literal}
{include_php file=$zFooter}
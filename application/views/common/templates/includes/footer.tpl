<script type="text/javascript">
{literal}
jQuery(document).ready(function() {
	var zBasePathTheme = "{/literal}{$zBasePath}{literal}assets/common/" ; 
	var zBasePath = "{/literal}{$zBasePath}{literal}";
});
{/literal}
</script>

<script src="{$zBasePath}assets/light/assets/js/popper.min.js"></script>
<script src="{$zBasePath}assets/light/assets/js/bootstrap.min.js"></script>

<script src="{$zBasePath}assets/light/assets/js/app.js"></script>
<script src="{$zBasePath}assets/gantt_new/js/jquery.fn.gantt.min.js"></script>
<script src="{$zBasePath}assets/light/assets/js/chaty-{$zChaty}.js"></script>
<script src="{$zBasePath}assets/light/assets/js/litespeed.js"></script> 
<script src="{$zBasePath}assets/light/assets/js/litespeed-media.js"></script>
<script src="{$zBasePath}assets/common/js/site.js?{$zClearCache}" type="text/javascript"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main.js?{$zClearCache}"></script>
<script type="text/javascript" src="{$zBasePath}assets/common/js/app/main_save.js?{$zClearCache}"></script>

<link rel="stylesheet" href="{$zBasePath}/assets/common/css/custom_rohi.css">

<div id="dialog88" title="Dialog Title"></div>
<div id="dialogVoting" style="" title="Dialog Title"></div>
<div id="dialogVotingDelegue" title="Dialog Title"></div>
<div class="dialog-link-voting" title="Dialog Title"></div>
<div class="dialog-link-voting-delegue" title="Dialog Title"></div>

{* For chat ui, please copy lines below to the same place in another file if this file's version is older than the existing *}
<input type="hidden" id="current_user_id_chat" value="{$oUser.id}"/>
<input type="hidden" id="current_user_matricule_chat" value="{$oUser.im}"/>
<div id="chat-app"></div>
<link href="{$zBasePath}assets/chat-ui/css/app.e512b202.css" rel=stylesheet as=style>
<link href="{$zBasePath}assets/chat-ui/css/chunk-vendors.7a827cf8.css" rel=stylesheet as=style>
<script src="{$zBasePath}assets/chat-ui/js/chunk-vendors.647d7b64.js"></script>
<script src="{$zBasePath}assets/chat-ui/js/app.11be00ba.js"></script>
{* end of chat ui Garina *}

{literal} 
<style>
@media only screen and (max-width: 775px){
	.stickymenu {
		display:none!important;
	}
}

{/literal}{if $bPhoto==0}{literal}
.ui-widget-overlay.custom-overlay
{
    background-color: grey!important;
    background-image: none!important;
    opacity: 1!important;
}

.myPosition {
    position: absolute;
    top: 100px!important; /* use a length or percentage */
}


/*.ui-dialog-titlebar-close{
	display:none;
}*/
{/literal}{/if} {literal}
</style>
<script>

$(document).ready (function ()
{
    $.getScript( "{/literal}{$zBasePath}{literal}assets/common/js/app/main_save.js");
	{/literal}{if $smarty.session.votingDelegue==100}{literal}
	$("#dialogVotingDelegue").dialog({
		autoOpen: true,
		width: '60%',
		height: 'auto',
		closeOnEscape: false,
		dialogClass: "noclose",
		dialogClass: 'myPosition',
		modal: !0,
		open: function() {
			$('.ui-widget-overlay').addClass('custom-overlay');
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length
			}
		},
		show: {
			effect: "slide",
			duration: 1000
		},
		hide: {
			effect: "drop",
			duration: 1000
		},
		buttons: [{
			id: 'id-envoyer',
			text: "Envoyer",
			click: function() {
				
				var iRet = 1 ; 

				var iCount = 0;
				$(".checkTest").each (function ()
				{
					if($(this).prop("checked") == true){
					   iCount++
					}
				})
				

				if(iCount==0){
					var iRet = 0 ; 
					var zMsg = "Veuillez cocher au moins un delegué";
					alert(zMsg);
				}

				if(iCount > 2 ){
					
					var iRet = 0 ; 
					var zMsg = "Veuillez cocher au plus deux delegués";
					alert(zMsg);
				}

				if (iRet == 1){	
					var $form = $("#votingMeriteAgent");
					var formdata = (window.FormData) ? new FormData($form[0]) : null;
					var data = (formdata !== null) ? formdata : $form.serialize();
					$.ajax({
						url: $form.attr('action'),
						type: $form.attr('method'),
						contentType: false, 
						processData: false, 
						data: data,
						success: function (response) {
							$("#dialogVotingDelegue").html("");
							$("#dialogVotingDelegue").dialog("close");
						}
					});
				} 
				
				
			}
		}]
	});
	$(".dialog-link-voting-delegue").click(function(event) {
		$("#dialogVotingDelegue").html();
		$('#dialogVotingDelegue').dialog({ height: 375 });
		var iUserTarget = "";
		var iUserId = "";
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}votingdelegue/getTemplateVoting",
			type: 'post',
			data: {
				iUserTarget: iUserTarget,
				iRedirect: 1
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialogVotingDelegue").html(data);
				$("#dialogVotingDelegue").dialog("open");
				event.preventDefault()
			},
			async: true
		})
	});
	$(".dialog-link-voting-delegue").click(); 
    {/literal}{/if} {literal}
	{/literal}{if $smarty.session.voting==1000}{literal}
	$("#dialogVoting").dialog({
		autoOpen: true,
		width: '80%',
		height: '600px',
		closeOnEscape: false,
		dialogClass: "noclose",
		dialogClass: 'myPosition',
		modal: !0,
		open: function() {
			$('.ui-widget-overlay').addClass('custom-overlay');
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length
			}
		},
		show: {
			effect: "slide",
			duration: 1000
		},
		hide: {
			effect: "drop",
			duration: 1000
		},
		buttons: [{
			id: 'id-envoyer',
			text: "Voter",
			click: function() {
				
				var iRet = 1 ; 
				

				var iCount = 0;
				$(".checkTest").each (function ()
				{
					if($(this).prop("checked") == true){
					   iCount++
					}
				})
				

				if(iCount==0){
					var iRet = 0 ; 
					var zMsg = "Veuillez cocher au moins un agent";
					alert(zMsg);
				}

				if(iCount > 1 ){
					
					var iRet = 0 ; 
					var zMsg = "Veuillez cocher au plus un agent";
					alert(zMsg);
				}

				if (iRet == 1){	

					if(confirm("Êtes-vous sûr de voter " + $(".checkTest:checked").attr("valeur")+ " ?")){
						var $form = $("#votingMeriteAgent");
						var formdata = (window.FormData) ? new FormData($form[0]) : null;
						var data = (formdata !== null) ? formdata : $form.serialize();
						$.ajax({
							url: $form.attr('action'),
							type: $form.attr('method'),
							contentType: false, 
							processData: false, 
							data: data,
							success: function (response) {
								$("#dialogVoting").html("");
								$("#dialogVoting").dialog("close");
							}
						});
					}
				} 
				
				
			}
		}]
	});
	$(".dialog-link-voting").click(function(event) {
		$("#dialogVoting").html();
		
		$('#dialogVoting').dialog({ height: 600 });
		var iUserTarget = "";
		var iUserId = "";
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}votingMerite/getTemplateVoting",
			type: 'post',
			data: {
				iUserTarget: iUserTarget,
				iRedirect: 1
			},
			success: function(data, textStatus, jqXHR) {
				var oReturn = $.parseJSON(data);
				$('#dialogVoting').dialog('option', 'title', 'Qui dans votre '+oReturn.title+' est le plus méritant ? Veuillez choisir un agent');
				$("#dialogVoting").html(oReturn.zSelect);
				$("#dialogVoting").dialog("open");
				event.preventDefault()
			},
			async: true
		})
	});
	$(".dialog-link-voting").click(); 
    {/literal}{/if} {literal}
	$("#dialog88").dialog({
		autoOpen: false,
		width: '60%',
		title: 'Fiche de poste',
		close: 'X',
		show: 'blind',
		modal: true,
		buttons: [{
			text: "Fermer",
			click: function() {
				$(this).dialog("close");
				$( '.bouton16' ).blur(); 
			}
		}]
	}); 

	$( ".dialog-link-fdp1" ).click(function( event ) {
		$('.bouton16').blur(); 
		var iSearchFicheDePoste = $(this).attr("iSearchFicheDePoste");

		if(iSearchFicheDePoste != ''){
			var iUserId = $(this).attr("iAgentId");
			$.ajax({
				url: "{/literal}{$zBasePath}{literal}accueil/getInfoUser/" + iUserId ,
				type: 'get',
				data: { 
				},
				success: function(data, textStatus, jqXHR) {
					
					$("#dialog88").html(data);	
					$( "#dialog88" ).dialog( "open" );
					$('html, body').animate({
						scrollTop: 0
					}, 750);
					$('.bouton16').blur(); 
					event.preventDefault();
				},
				async: false
			});
		}
	});
	
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Actuellement, tous les agents du MEF (ECD, ELD, EFA,Fonctionnaire) peuvent consulter leur fiche de paie sur ROHI</font></font></font></marquee>');*/
	//$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Chers collègues, afin de bénéficier de tous les services auprès du CMS, merci de déposer vos dossiers à la porte 41 du Ministère de l\'Economie et des Finances Antaninarenina</font></font></font></marquee>');
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">Contribution à la promotion de l\'éthique dans l\'Administration Publique: cas du Ministère de l\'Economie et des Finances présentée par Monsieur RAVELONANOSY Hoely Nambinina (Expert en Administration Publique) le Mercredi 18 Novembre 2020 à 10h à la Porte 303-Immeuble des Finances Antaninarenina</font></font></font></marquee>');*/

})

{/literal}{if $iAfficheMFBMM==1}{literal}
$(document).ready (function ()
{
	/*$("#breadcrumb").html('<marquee SCROLLAMOUNT="4"><font size="4"><font face="Lato"><font color="white">MFB-NC Miara Misôma 2e édition se tiendra le 19,20 et 21 Septembre 2018... Pour plus d\'informations veuillez consulter la page facebook "ASCAL MFB".</font></font></font></marquee>');*/

	function getExtension(chemin) {
	var regex = /[^.]*$/i;
	var resultats = chemin.match(regex);
	return resultats[0]
}
$(document).ready (function ()
{
	{/literal}{if $bPhoto==-100}{literal}
		$("#dialog88").dialog({
		autoOpen: true,
		width: '60%',
		closeOnEscape: true,
		dialogClass: "noclose",
		dialogClass: 'myPosition',
		modal: !0,
		open: function() {
			$('.ui-widget-overlay').addClass('custom-overlay');
			$.ui.dialog.prototype._allowInteraction = function(e) {
				return !!$(e.target).closest('.ui-dialog, .ui-datepicker, .select2-drop').length
			}
		},
		show: {
			effect: "slide",
			duration: 1000
		},
		hide: {
			effect: "drop",
			duration: 1000
		},
		buttons: [{
			text: 'Valider',
			"class": 'saveButtonClass',
			click: function() {
				var iMiseADispo = 0;
				var iTestValid = 1;
				var zMessage = "";
				var zPhoto = $('#photo').val();
				var zPhone = $('#zPhone').val();
				if (zPhoto == '') {
					var iTestValid = 0;
					zMessage += "- Veuillez insérer votre photo d'identité\n"
				} else {
					var ext = getExtension(zPhoto).toLowerCase();
					if (ext == "png" || ext == "gif" || ext == "jpg" || ext == "jpeg") {} else {
						var iTestValid = 0;
						zMessage += "Veuillez entrer le fichier ayant des extensions .jpeg/.jpg/.png/.gif.";
						$('#photo').val("")
					}
				}
				if (zPhone == '') {
					var iTestValid = 0;
					zMessage += "- Veuillez remplir le numéro de telephone\n";
				}
				if (iTestValid == 1) {
					$("#photoMAJ").submit()
				} else {
					alert(zMessage)
				}
			}
		}]
	});
	$(".dialog-link-manuel-localite89").click(function(event) {
		$("#dialog88").html();
		$('#dialog88').dialog('option', 'title', 'Afin de beneficier à l\'accès ROHI,Merci de mettre à jour votre photo et coordonnées');
		$('#buttonId').button('option', 'label', 'Valider');
		var iUserTarget = {/literal}{$oCand[0]->user_id}{literal};
		var iUserId = {/literal}{$oCand[0]->user_id}{literal};
		$.ajax({
			url: "{/literal}{$zBasePath}{literal}avis/getTemplatePhoto/" + iUserId,
			type: 'post',
			data: {
				iUserTarget: iUserTarget,
				iRedirect: 1
			},
			success: function(data, textStatus, jqXHR) {
				$("#dialog88").html(data);
				$("#dialog88").dialog("open");
				event.preventDefault()
			},
			async: true
		})
	});
	$(".dialog-link-manuel-localite89").click(); 
	{/literal}{/if} {literal}
})
})
{/literal}{/if}{literal}
</script>

{/literal}
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/li-scroller.css">
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/jquery.li-scroller.1.0.js"></script>

{if $iModuleActif == 2}
{if $iSessionCompte == COMPTE_AGENT}
{if !empty($iNotification) && !empty($iNotificationAffiche) && $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">NOTIFICATION</p>
	<p class="notif">Vous avez {$iNotification} valid&eacute;{if $iNotification>1}s{/if} : </p>
	{if $iNotificationDecision > 0}<p class="notif">- {$iNotificationDecision} d&eacute;cision{if $iNotificationDecision>1}s{/if}</p>{/if}
	{if $iNotificationConge > 0}<p class="notif">- {$iNotificationConge} Cong&eacute;{if $iNotificationConge>1}s{/if}</p>{/if}
	{if $iNotificationAbscence > 0}<p class="notif">- {$iNotificationAbscence} Autorisation{if $iNotificationAbscence>1}s{/if} d'abscence</p>{/if}
	{if $iNotificationPermission> 0}<p class="notif">- {$iNotificationPermission} Permission{if $iNotificationPermission>1}s{/if}</p>{/if}
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{else}
{if !empty($iNotification) && !empty($iNotificationAffiche) && $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">
	<span>
		NOTIFICATION
	</span>
	</p>
	<p class="notif">Vous avez {$iNotification} demande{if $iNotification>1}s{/if} &agrave; valider : </p>
	{if $iNotificationDecision > 0}<p class="notif">- {$iNotificationDecision} d&eacute;cision{if $iNotificationDecision>1}s{/if}</p>{/if}
	{if $iNotificationConge > 0}<p class="notif">- {$iNotificationConge} Cong&eacute;{if $iNotificationConge>1}s{/if}</p>{/if}
	{if $iNotificationAbscence > 0}<p class="notif">- {$iNotificationAbscence} Autorisation{if $iNotificationAbscence>1}s{/if} d'abscence</p>{/if}
	{if $iNotificationPermission> 0}<p class="notif">- {$iNotificationPermission} Permission{if $iNotificationPermission>1}s{/if}</p>{/if}
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{/if}
{/if}

{if !empty($iNotificationCarte) && $iNotificationCarte > 0}
<div class="notification">
	<p class="titre">
		<span>
			NOTIFICATION NOUVELLE CARTE ROHI
		</span>
	</p>
	<p class="notif">Votre carte ROHI est disponible.</p>
	<p class="notif">Veuillez vous adresser au responsable</p>
	<p class="notif">Porte 15 MFB Antaninarenina. Merci!</p>
	<p class="notif">&nbsp;</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
{*
{if sizeof($toReclassement) > 0}
<div class="notification" >
	<p class="titre">
	<span>
	Reclassement (Circuit et Suivi)
	</span>
	</p>
	<p class="notif">{$toReclassement.0.suivi_libelle}</p>
	<p class="notif">Date : {$toReclassement.0.suivi_libelle|date_format:"%d/%m/%Y"}</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
*}
{*$zSticky*}
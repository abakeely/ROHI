<div class="stickymenu">
<ul>
{if $oUser.im=='389671' || $oUser.id=='9961'}
<li><a href="{$zBasePath}accueil/tsilo/" title="cv des agents"><i class="ace-icon la la-users"></i>CV des agents</a></li>
{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }
<li><a href="{$zBasePath}gcap/congeCandidatPasse" title="Décision de congé"><i class="ace-icon la la-vcard"></i>Décision de congé</a></li>
{/if}{if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR}
<li><a href="{$zBasePath}critere/liste/agent-evaluation/fiche-de-poste-cv-notes" title="Fiche de poste / Cv / Note de mes agents"><i class="ace-icon la la-vcard"></i>Infos des agents</a></li>{/if}
<li><a href="{$zBasePath}formation/menu/sfao/menu-principal" title="Formation"><i class=" la la-edit"></i>Formation</a></li> 
<li> <a href="{$zBasePath}documentation/infprat/sad/inf-prat"title="Archive et Documentation"><i class="la la-book"></i>Archive et Documentation</a></li><li><a href="{$zBasePath}gcap/extrants/gestion-absence/demandes" title="Demande d'absence"><i class="la la-user-times"></i>Demande d'absence</a></li>
<li><a href="{$zBasePath}avis/fiche/titre-de-paiement" title=" Titre de paiement"><i class="la la-id-card-o"></i>Titre de paiement</a></li><li><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction" title="Ma transaction"><i class="la la-exchange"></i>Mes transactions</a></li>
<li><a href="{$zBasePath}pointage/liste/pointage-electronique/lg-pass" title="Login/Password"><i class="ace-icon la la-key"></i>Login / Password</a></li><li><a href="{$zBasePath}gcap/commConge/gestion-absence/fiche" title="Login/Password"><i class="ace-icon la la-vcard"></i>Suppression congé</a></li>
{else}
{if $oUser.im=='332026'}
<li><a href="{$zBasePath}accueil/cvAll/" title="cv des agents"><i class="ace-icon la la-vcard"></i>CV des agents</a></li>
{/if}


{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }  
<li><a href="{$zBasePath}gcap/congeCandidatPasse" title="Décision de congé"><i class="ace-icon la la-vcard"></i>Décision de congé</a></li>
{/if}
{if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
<li><a href="{$zBasePath}critere/liste/agent-evaluation/fiche-de-poste-cv-notes" title="Fiche de poste / Cv / Note de mes agents"><i class="ace-icon la la-vcard"></i>Infos des agents</a></li>
{/if}
<li><a href="{$zBasePath}formation/menu/sfao/menu-principal" title="Formation"><i class=" la la-mortar-board"></i>Formation</a></li> 
<li> <a href="{$zBasePath}documentation/infprat/sad/inf-prat"title="Archive et Documentation"><i class="la la-book"></i>Archive et Documentation</a></li><li><a href="{$zBasePath}gcap/extrants/gestion-absence/demandes" title="Demande d'absence"><i class="la la-user-times"></i>Demande d'absence</a></li>
<li><a href="{$zBasePath}avis/fiche/titre-de-paiement" title=" Titre de paiement"><i class="la la-id-card-o"></i>Titre de paiement</a></li><li><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction" title="Ma transaction"><i class="la la-exchange"></i>Mes transactions</a></li>
{if $oUser.id=='9961' || $oUser.id=='617' || $oUser.id=='11' || $oUser.id=='9312'}<li>
<a href="{$zBasePath}pointage/liste/pointage-electronique/lg-pass" title="Login/Password"><i class="ace-icon la la-key"></i>Login / Password</a></li>{/if}{if $oUser.id=='9961' || $oUser.id=='617' || $oUser.id=='4430'}
<li><a href="{$zBasePath}gcap/commConge/gestion-absence/fiche" title="Login/Password"><i class="ace-icon la la-vcard"></i>Suppression congé</a></li>{/if}{/if}
{*<li><a href="{$zBasePath}message/module/messagerie-instantanne/tchat"  title="Ma transaction"><i class="la la-wechat fa-lg " ><span style="font-size:18px;" id="tchat_notification">{$iNbMessage}</span></i>ROHI@TCHAT</a>
</li>*}
</ul>
</div>

<div id="dialog81" title="Fiche de poste"></div>

{literal}
<script>
$(document).ready(function() {
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}Tchat/getNbNouveauMessage",
		type: 'POST',
		data: {
			user_connected: "",
		},
		success: function(data, textStatus, jqXHR) {
			var nbMessage = parseInt(data) ;
			$("#tchat_notification").html(nbMessage) ;
		}
	});
	$(".class_nav a").click(function() {
		$(".wrap_nav").toggleClass("active");
	});
	$(".wrap_nav .dropdown a").click(function() {
		console.log("u");	
		$(".dropdown ul").slideUp("slow");
		$(this).next().toggle();
	});
	 
});
function majView(){
	$.ajax({
		url: "{/literal}{$zBasePath}{literal}Tchat/majView",
		type: 'POST',
		data: {
			user_connected: "",
		},
		success: function(data, textStatus, jqXHR) {
		}
	});
}
</script>
{/literal}
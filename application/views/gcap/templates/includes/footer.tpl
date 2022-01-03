<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/li-scroller.css">
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/jquery.li-scroller.1.0.js"></script>
<!-- ui-dialog -->
<footer id="mainFooter">
{*
<section class="gris2 ctaBot2">
	<div class="wrap">
		<form method="post" action="#" id="subscribeNewsForm" novalidate="novalidate">
			<span class="news">recevoir la newsletter</span>
			<br>
				<input type="email" class="mail br_24" required="" id="newsletter-mail" data-toggle="tooltip" name="mail" placeholder="votre e-mail" aria-required="true">
				<input type="hidden" name="action" value="registerAbonnes">
				<input type="submit" id="submit-news" value="ok" class="bt br_24">
				<img id="ajaxloadimg" alt="loader" src="http://pieces-jaunes.demo.typy.fr/wp-content/themes/fhp/images/ajax-loader.gif" style="vertical-align:bottom; display: none;">
			<br>
		</form>
	</div>
</section>
*}
	<div id="mainFooterTop">
		<p class="logo"><img src="{$zBasePath}assets/gcap/images/def1.jpg" alt=""></p>
	</div>
	<div id="mainFooterBottom">
		<p>&copy; 2015 - Minist&egrave;re des finances et du budget</p>    
	</div>
</footer>
{if $iModuleActif == 2}
{if $iSessionCompte == COMPTE_AGENT}
{if $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">
	NOTIFICATION<br/><br/><br/>
	Vous avez {$iNotification} valid&eacute;{if $iNotification>1}s{/if} : </p>
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
{if $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">
	NOTIFICATION<br/><br/><br/>
	Vous avez {$iNotification} demande{if $iNotification>1}s{/if} &agrave; valider : </p>
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

{if $iNotificationCarte > 0}
<div class="notification">
	<p class="titre">
	<span style="color:#FF0000; ">NOTIFICATION NOUVELLE CARTE ROHI<br/><br/><br/></span></p>
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

{if sizeof($toReclassement) > 0}
<div class="notification" style="background:#f3f3f3">
	<p class="titre">Reclassement (Circuit et Suivi)<br/><br/></p>
	<p class="notif">{$toReclassement.0.suivi_libelle}</p>
	<p class="notif">Date : {$toReclassement.0.circuitReclassement_date|date_format:"%d/%m/%Y"}</p>
	<p class="notif">&nbsp;</p>
	<p class="button">
		<a href="#" title=""><i style="color: #F10610;padding-left:240px;" class="la la-close"></i></a>
	</p>
</div>
{/if}
</body>
</html>
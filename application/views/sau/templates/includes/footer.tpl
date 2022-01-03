<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/li-scroller.css">
<script type="text/javascript" src="{$zBasePath}assets/gcap/js/app/jquery.li-scroller.1.0.js"></script>
<!-- ui-dialog -->
{literal}
<script>
$(document).ready (function ()
{
	setTimeout(function() { location.reload() },60000);
	$("ul#ticker01").show();
	$("ul#ticker01").liScroll();
	$("ul#ticker02").liScroll({travelocity: 0.15});
})
</script>
{/literal}
<footer id="mainFooter">
	<div id="mainFooterTop">
		<p class="logo"><img src="{$zBasePath}assets/gcap/images/def1.jpg" alt=""></p>
	</div>
	<div id="mainFooterBottom">
		<p>&copy; 2015 - Minist&egrave;re de l'économie et des finances</p>    
	</div>
</footer>
{if $iModuleActif == 2}
{if $iSessionCompte == COMPTE_AGENT}
{if $iNotification > 0 && $iNotificationAffiche==1}
<div class="notification">
	<p class="titre">
	NOTIFICATION<br/><br/><br/>
	Vous avez {$iNotification} validation{if $iNotification>1}s{/if} : </p>
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
</body>
</html>
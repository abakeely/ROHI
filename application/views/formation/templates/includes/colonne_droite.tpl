{literal}
<script type="text/javascript">
	var zBasePath = '{/literal}{$zBasePath}{literal}';
	var iUserIdConnect = {/literal}{$oUser.id}{literal};
</script>

{/literal}
<script src="{$zBasePath}assets/sau/js/moment.min.js"></script>
<script src="{$zBasePath}assets/sau/js/fullcalendar.min.js"></script>
<script src="{$zBasePath}assets/sau/js/bootbox.js"></script>
<script src="{$zBasePath}assets/sau/js/lang-all.js"></script>
<script src="{$zBasePath}assets/sau/js/getcalendar.js?sdsd"></script>
{literal}
<style>
@media only screen and (max-width: 1300px) {
	#mon-agenda{ display:none;};
	#mainContent { margin-right:15px:display:inline;};
}

@media only screen and (min-width: 1301px) {
	#mainContent { margin-right:260px};
}
</style>
<script>

$(document).ready (function ()
{
	 if ($( window ).width() <= 1300) { 
			$("#mon-agenda").hide();
			$("#mainContent").css( { marginRight : "15px" } );
	 } else {
		{/literal}{if $iAfficheAgenda==1}{literal}
		$("#mainContent").css( { marginRight : "260px" } );
		{/literal}{else}{literal}
		$("#mainContent").css( { marginRight : "15px" } );
		{/literal}{/if}{literal}
	 }

	$( window ).resize(function() {
		if ($( window ).width() <= 1300) { 
			$("#mon-agenda").hide();
			$("#mainContent").css( { marginRight : "15px" } );
		} else {
			$("#mon-agenda").show();
			{/literal}{if $iAfficheAgenda==1}{literal}
			$("#mainContent").css( { marginRight : "260px" } );
			{/literal}{else}{literal}
			$("#mainContent").css( { marginRight : "15px" } );
			{/literal}{/if}{literal}
		}
	});
})
</script>
{/literal}

<div id="dialogEvent" style="background: white url({$zBasePath}assets/gcap/css/wood2.jpg) 0 500px repeat-y;">
</div>



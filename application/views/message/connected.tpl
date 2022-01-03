{if $oData.oConnected==null}
	<span>Aucun agent connect&eacute;</span>
{else}
{foreach from=$oData.oConnected item=oConnected}
	{if $iUserId != $oConnected.iUserId}
	<li class="each_connected">
		
			<span class="connected_state online"></span>
			<img src="{$zBasePath}assets/upload/{$oConnected.idPhoto}.{$oConnected.typePhoto}"> 
			<span class="name">{$oConnected.zNomPrenom}</span>
			<input class="iUserId" value="{$oConnected.iUserId}" type="hidden"/>
		
	</li>
	{/if}
{/foreach}
{/if}
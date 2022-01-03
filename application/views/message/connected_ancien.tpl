<div class="connected_top">
	{*<span class="ls_connected">Listes des connect&eacute;es</span>
	<span class="ls_connected">Listes des personnes de la même service</span> *}
	<select id="select_connected" class="form-control">
		<option value="2">Listes des connect&eacute;es</option>
		<option value="1" >Listes des agents de la même service</option>
	</select>
</div>
<div class="bubble_connected hidden" data-connect = "1">
	{if $oData.oConnected==null}
		<span>Aucun agent connect&eacute;</span>
	{else}
		{foreach from=$oData.oMemeService item=oConnected}
			{if $iUserId != $oConnected.iUserId}
				<div class="connected_agent ">
					{if $oConnected.state == 1}
						<span class="connected_state">
							<img src="{$zBasePath}assets/message/image/connected.png"/>
						</span>
					{else}
						<span class="deconnected_state">
							<img src="{$zBasePath}assets/message/image/deconnected.png"/>
						</span>
					{/if}
					<span class="zNomPrenom">{$oConnected.zNomPrenom}</span>
					<input class="iUserId" value="{$oConnected.iUserId}" type="hidden"/>
				</div>
			{/if}
		{/foreach}
	{/if}
</div>
<div class="bubble_connected hidden" data-connect = "2">
	{if $oData.oConnected==null}
		<span>Aucun agent connect&eacute;</span>
	{else}
		{foreach from=$oData.oConnected item=oConnected}
			{if $iUserId != $oConnected.iUserId}
				<div class="connected_agent">
					<span class="connected_state">
						<img src="{$zBasePath}assets/message/image/connected.png"/>
					</span>
					<span class="zNomPrenom">{$oConnected.zNomPrenom}</span>
					<input class="iUserId" value="{$oConnected.iUserId}" type="hidden"/>
				</div>
			{/if}
		{/foreach}
	{/if}
</div>

{literal}
	<script>
		
			var selectedValue1 = '{/literal}{$iSelectedValue}{literal}';
			$('option[value='+selectedValue1+']').attr('selected','selected');
			$('.bubble_connected[data-connect='+selectedValue1+']').removeClass('hidden');
		
		
		$('#select_connected').change(function(){
			selectedValue = $(this).val();
			$('.bubble_connected').addClass('hidden');
			$('.bubble_connected[data-connect='+selectedValue+']').removeClass('hidden') ;
		});
	</script>
{/literal}
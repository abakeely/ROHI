<select id="{$iName}" name="{$iName}" onChange="getOrganisation('{$zBasePath}',1,this.value);">
	<option value="0">Service</option>
	{foreach from=$oAssignation item=oAssignation }
	<option value="{$oAssignation.id}">{$oAssignation.sigle_service}</option>
	{/foreach}
</select>
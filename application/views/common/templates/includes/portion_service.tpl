{if sizeof($toSousService)>0}
<div id="sousSousService">
	<div class="field">
		<label>Sous Service</label>
			<select class="form-control soussous" placeholder="Service" name="service" onChange="getLocaliteAffiche('{$zBasePath}',3,this.value);" data-toggle="tooltip" data-original-title= "Safidio  ny sampan-draharaha  misy anao " id="iServiceId11">
			<option value="0">s&eacute;l&eacute;ctionner un service</option>
			{foreach from=$toSousService item=oSousService }
				<option value="{$oSousService.id}">{$oSousService.libele}</option>
			{/foreach}
		</select>
		<p class="message debut" style="width:500px">&nbsp;</p>
	</div>
</div>
{/if}
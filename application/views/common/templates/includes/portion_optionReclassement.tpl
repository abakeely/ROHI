{if sizeof($toDirection)>0 || sizeof($toService)>0 || sizeof($toSousService)>0 || sizeof($toSousSousService)>0 || sizeof($toListe)>0}
{assign var=iIncrement value=$iType+1}
<div class="{if $iMode==2}row{/if} clearfix">
	<div class="cell"  style="width:50%">
			<div class="field"> 
				<label>RATTACHEMENT</label>
				<select name="iRattachement[]" onChange="getLocaliteCv('{$zBasePath}',{$iIncrement},this.value,{$iMode});" id="structure_{$iIncrement}">
					<option value="0">Veuillez s&eacute;l&eacute;ctionner</option>
					{foreach from=$toListe item=oListe }
						<option {if $iSelectedService==$oListe.id && $iType==2}selected="selected"{/if} {if $iSelectedDirection==$oListe.id && $iType==1}selected="selected"{/if} value="{$zUnderScore}{$oListe.id}" class="black">{$oListe.libele}</option>
					{/foreach}
					{foreach from=$toDirection item=oDirection} 
						<option {if $iSelectedDirection==$oDirection.id}selected="selected"{/if} value="DIR_{$oDirection.id}" class="blue">{$oDirection.libele}</option>
					{/foreach}
					{foreach from=$toService item=oService}
						<option {if $iSelectedService==$oService.id}selected="selected"{/if} value="SER_{$oService.id}" class="green">{$oService.libele}</option>
					{/foreach}
					{foreach from=$toSousService item=$oSousService}
						<option {if $iSelectedService==$oSousService.id}selected="selected"{/if} value="SER_{$oSousService.id}" class="magenta">{$oSousService.libele}</option>
					{/foreach}
					{foreach from=$toSousSousService item=$oSousSousService}
						<option {if $iSelectedService==$oSousSousService.id}selected="selected"{/if} value="SER_{$oSousSousService.id}" class="magenta">{$oSousSousService.libele}</option>
					{/foreach}
				</select>
		</div>
	</div>
</div>
<style>
.green {
    color:green;
}
.blue {
    color:blue;
}
.magenta {
    color:magenta;
}
</style>
<script>

</script>
{/if}
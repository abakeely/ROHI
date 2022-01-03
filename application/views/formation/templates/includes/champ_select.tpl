<select class='col-lg-6' id='_zChamp-{$iId}' name='{$iId}' style='float:right;width: 70%;' class='form-control' {$oRequired}>	
	<option value=''>...</option>
	{foreach from=$toListe item=oListe }
	<option {if $oListe.id == $iActif} selected='selected' {/if} value='{$oListe.id}'>{$oListe.libelle}</option>
	{/foreach}
</select>

<li class="mihamalefaka user2 dropdown-modal"><div class="form-group input-group">
<form name="setCompte" id="setCompte" action="{$zBasePath}gcap/setSessionCompte" method="POST">
<select name="iCompteId" id="iCompteId" class="form-control" onChange="document.setCompte.submit();" >
	<option {if $iSessionCompte == 1}selected="selected"{/if} value="4be4a3909d3c56ab612f4a639210a7b11">Compte agent</option>
	{foreach from=$toComptes item=oComptes }
		<option {if $iSessionCompte == $oComptes.compte_id}selected="selected"{/if} value="{$oComptes.compte_hash}">{$oComptes.compte_libelle}</option>
	{/foreach}
</select>
</form>
	<span class="input-group-addon">
	<i class="ace-icon la la-vcard"></i>
	</span>
</div>
</li>
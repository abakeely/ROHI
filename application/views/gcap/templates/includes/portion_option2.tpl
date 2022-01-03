{if $iType==0}
<option value="0">s&eacute;l&eacute;ctionner un departement</option>
{/if}
{if $iType==1}
<option value="0">s&eacute;l&eacute;ctionner une direction</option>
{/if}
{if $iType==2}
<option value="0">s&eacute;l&eacute;ctionner un service</option>
{/if}
{if $iType==3}
<option value="0">s&eacute;l&eacute;ctionner une division</option>
{/if}
{foreach from=$toListe item=oListe }
<option value="{$oListe.id}">{$oListe.libele}</option>
{/foreach}

<option value="0">Veuillez s&eacute;l&eacute;ctionner</option>
{foreach from=$toPorte item=toPorte}
<option value="{$toPorte.porte_id}">{$toPorte.porte_nom}</option>
{/foreach}
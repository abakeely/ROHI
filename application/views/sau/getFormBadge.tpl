<option value="">Veuillez s&eacute;l&eacute;ctionner</option>
{foreach from=$toBadge item=toBadge}
<option value="{$toBadge.badge_id}">{$toBadge.badge_nom}</option>
{/foreach}
<ul>
{foreach from=$oSexe item=oSex}
	<li>{if $oSex.sexe==1}Homme : {$oSex.nb}{else if $oSex.sexe==2}Femme : {$oSex.nb}{/if}<li>
{/foreach}
</ul>
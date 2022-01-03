{if sizeof($toComptes)>0}
<li class="count-list nav-item dropdown has-arrow flag-nav">
	{if $iSessionCompte == 1}
	<input type="hidden" name="iSessionCompteId" id="iSessionCompteId" value="4be4a3909d3c56ab612f4a639210a7b1r9">
	<a class="nav-link dropdown-toggle" data-ident="4be4a3909d3c56ab612f4a639210a7b1r9" data-toggle="dropdown" href="#" role="button">
		<span>Compte Agent</span>
	</a>
	{else}
		{foreach from=$toComptes item=oComptes }
			{if $iSessionCompte == $oComptes.compte_id}
			<input type="hidden" name="iSessionCompteId" id="iSessionCompteId" value="{$oComptes.compte_hash}">
			<a class="nav-link dropdown-toggle" data-ident="{$oComptes.compte_hash}" data-toggle="dropdown" href="#" role="button">
				<span>{$oComptes.compte_libelle}</span>
			</a>
			{/if}
		{/foreach}
	{/if}
	<div class="dropdown-menu dropdown-menu-right">
		{if $iSessionCompte > 1}
			<a href="javascript:void(0);" data-ident="4be4a3909d3c56ab612f4a639210a7b1r9" class="dropdown-item">
				<span>Compte Agent</span>
			</a>
		{/if}
		{foreach from=$toComptes item=oComptes }
			{if $iSessionCompte != $oComptes.compte_id}
				<a href="javascript:void(0);" data-ident="{$oComptes.compte_hash}" class="dropdown-item">
					{$oComptes.compte_libelle}
				</a>
			{/if}
		{/foreach}

	</div>
</li>
{else}
<li class="nav-item dropdown has-arrow flag-nav">
		<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
			<span>Compte Agent</span>
		</a>
</li>
{/if}


<form name="setCompte" id="setCompte" action="{$zBasePath}gcap/setSessionCompte" method="POST">
<input type="hidden" name="iCompteId" id="iCompteId" value="">
</form>
<ul class="nav nav-list">
		<li class="{if $iSousMenuActif == 1}active{/if}">
			<a href="{$zBasePath}sau/statistiques/gestion-visiteur/index?{$zClearCache}">
				<i class="menu-icon la la-tachometer"></i>
				<span class="menu-text"> Statistiques </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="{if $iSousMenuActif == 2}active{/if}">
			<a href="{$zBasePath}sau/visiteurs/gestion-visiteur/ajout?{$zClearCache}">
				<i class="menu-icon la la-desktop"></i>
				<span class="menu-text">
					Visiteurs
				</span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="{if $iSousMenuActif == 3}active{/if}">
			<a href="{$zBasePath}sau/listesNoires/gestion-visiteur/liste?{$zClearCache}">
				<i class="menu-icon la la-list"></i>
				<span class="menu-text"> Liste Noires </span>
			</a>
		</li>

		<li class="{if $iSousMenuActif == 4}active{/if}">
			<a href="{$zBasePath}sau/badge/gestion-visiteur/liste?{$zClearCache}">
				<i class="menu-icon la la-list"></i>
				<span class="menu-text"> Emprunt carte ROHI </span>
			</a>
		</li>

		<li class="{if $iSousMenuActif == 5}active{/if}">
			<a href="{$zBasePath}sau/annuaire/gestion-visiteur/liste?{$zClearCache}">
				<i class="menu-icon la la-list"></i>
				<span class="menu-text"> Annuaire agent MFB </span>
			</a>
		</li>

		<li class="{if $iSousMenuActif == 6}active{/if}">
			<a href="{$zBasePath}sau/transactions/gestion-visiteur/liste?{$zClearCache}">
				<i class="menu-icon la la-list"></i>
				<span class="menu-text"> Transactions  </span>
			</a>
		</li>

		<li class="{if $iSousMenuActif == 7}active{/if}">
			<a href="{$zBasePath}sau/badgeListing/gestion-visiteur/liste?{$zClearCache}">
				<i class="menu-icon la la-list"></i>
				<span class="menu-text"> Les badges  </span>
			</a>
		</li>
</ul><!-- /.nav-list -->

{literal}
<script>
$(document).ready (function ()
{
	//setTimeout(function() { location.reload() },300000);
})
</script>
{/literal}
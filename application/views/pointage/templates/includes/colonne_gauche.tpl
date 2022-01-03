<nav>
	<ul>
		<li><img src="{$zBasePath}assets/img/logo.png" alt="" width="200px" height="100px" align="center"/></li>
		{foreach from=$toModules item=oModules }

		{if $oModules.module_id < 4 || $oModules.module_id >= 6}
			<li {if $iModuleActif == $oModules.module_id} class="active" {/if} ><a href="{ if $oModules.module_id==1}{$zBasePath}cv/index {else}{$zBasePath}gcap/module/{$oModules.module_zHashUrl}{/if}">{$oModules.module_libelle}<span><i class="fa {$oModules.module_icone}"></i></span></a></li>
			{ if $oModules.module_id==1}
			<li {if $iModuleActif == 0} class="active" {/if} ><a href="{$zBasePath}cv/mon_cv">&nbsp;Mon CV<span><i class="la la-file-o"></span></i></a></li>
			{/if}
		{else}
			{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL && $oModules.module_id ==4}
				<li {if $iModuleActif == $oModules.module_id} class="active" {/if} ><a href="{$zBasePath}gcap/module/{$oModules.module_zHashUrl}">{$oModules.module_libelle}<span><i class="fa {$oModules.module_icone}"></i></span></a></li>
			{/if}
			{if ($iSessionCompte > 1)  && $oModules.module_id ==5}
				<li {if $iModuleActif == $oModules.module_id} class="active" {/if} ><a href="{$zBasePath}gcap/module/{$oModules.module_zHashUrl}">{$oModules.module_libelle}<span><i class="fa {$oModules.module_icone}"></i></span></a></li>
			{/if}
		{/if}
		{/foreach}
		{if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577'}
		<li {if $iModuleActif == -1} class="active" {/if}><a href="{$zBasePath}pointage/moderation/pointage-electronique/moderer">Moderation mot de passe<span><i class="la la-file-text"></i></span></a></li>
		<li {if $iModuleActif == -2} class="active" {/if}><a href="{$zBasePath}accueil/ficheCommunique">Communiqu&eacute;<span><i class="la la-file-text"></i></span></a></li>
		{/if}
		<li><a href="{$zBasePath}gcap/deconnexion">d&eacute;connexion<span><i class="la la-sign-out"></i></span></a></li>
	</ul>
</nav>

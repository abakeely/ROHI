<h2>Reclassement</h2>
<!--<div style="padding-top:6px;float:right!important;">
	<form id="searchbox">
		<input id="search" type="text" placeholder="recherche....">
		<i style="color:#6d7b95;font-size:22px;" class="la la-fw fa-search"></i>
	</form>
</div>
<div></div>-->
<div id="cssmenu">
  <ul>
	{if $iSessionCompte == COMPTE_AGENT}
	{if $iAfficheMenu == 1}
	<li {if $zHashUrl=='visualisation'}class="active active1"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i class="la la-fw fa-search"></i> Consultations</a></li>
	<li {if $zHashUrl=='pieces-jointes'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/pieces-jointes"><i class="la la-fw fa-paperclip"></i> Pièces jointes</a></li>
	{/if}
	{elseif ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL) || ($iSessionCompte == COMPTE_AUTORITE) || ($iSessionCompte == COMPTE_EVALUATEUR) || ($iSessionCompte == COMPTE_ADMIN)}
	<li {if $zHashUrl=='visualisation'}class="active active1"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i class="la la-fw fa-search"></i> Consultations</a></li>
	{elseif $iSessionCompte == COMPTE_RECLASSEMENT}
	<li {if $zHashUrl=='dossiers'}class="active active1"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/dossiers"><i class="la la-fw fa-search"></i> Dossiers</a></li>
	<li {if $zHashUrl=='reclassement'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/reclassement"><i class="la la-fw fa-search"></i> Formulaire ajout</a></li>
	<li {if $zHashUrl=='pieces-jointes'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/pieces-jointes"><i class="la la-fw fa-paperclip"></i> Pièces jointes</a></li>
	<li {if $zHashUrl=='suivis-circuits'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/suivis-circuits"><i class="la la-fw fa-exchange"></i> Suivis et Circuits</a></li>
	<li {if $zHashUrl=='archives'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/archives"><i class="la la-gift fa-lg"></i> Archives</a></li>
	<li {if $zHashUrl=='statistiques'}class="active"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/statistiques"><i class="la la-fw fa-bar-chart"></i> Statistiques</a></li>
	{/if}
	<li {if $zHashUrl=='notes-et-textes'}class="active {if $iAfficheMenu == 0}active1{/if}"{/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/notes-et-textes"><i class="la la-fw fa-file-o"></i> Notes et Textes</a></li>
</ul>
</div>
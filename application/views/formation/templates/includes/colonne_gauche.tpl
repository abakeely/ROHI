<link rel="stylesheet" href="{$zBasePath}assets/gcap/css/menuLeft.css" />
<nav class="leftMenuRohi">
<span class="retractLeftCont">
	<span class="left"><i class="fa fa-chevron-left"></i></span>
	<span class="right"><i class="fa fa-chevron-right"></i></span>
</span>
<!--<div class="stage" style="width: 110px; height: 110px">
	<div class="cubespinner">
	<div class="face1"><img src="{$zBasePath}assets/img/logo.png" alt="" width="100%" height="100" style="vertical-align:middle"></div>
	<div class="face2"><img src="{$zBasePath}assets/gcap/images/drha.png" width="118" height="118" alt="" style="vertical-align:top"></div>
	<div class="face3"><img src="{$zBasePath}assets/img/logo.png" alt="" width="100%" height="100" style="vertical-align:middle"></div>
	<div class="face4"><img src="{$zBasePath}assets/gcap/images/drha.png" width="118" height="118" alt="" style="vertical-align:top"></div>
	<div class="face5"><img src="{$zBasePath}assets/img/logo.png" alt="" width="100%" height="100" style="vertical-align:middle"></div>
	<div class="face6"><img src="{$zBasePath}assets/gcap/images/drha.png" width="118" height="118" alt="" style="vertical-align:top"></div>
	</div>
</div>-->
<div class="nav-side-menu">
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse in">
                <li {if $iModuleActif == 1} class="active" {/if}>
                  <a href="{$zBasePath}accueil/communique">
                  <i class="fa fa-home fa-lg"></i> Accueil
                  </a>
                </li>
				<li {if $iModuleActif == -1} class="active" {/if}>
                  <a href="{$zBasePath}formation/accueil_sfao">
                  <i class="fa fa-graduation-cap fa-lg"></i> Formation
                  </a>
                </li>
				<li {if $iModuleActif == -2} class="active" {/if}>
                  <a href="{$zBasePath}documentation/sad">
                  <i class="fa fa-archive fa-lg"></i> Archives et Documentation
                  </a>
                </li>
				{php}
					$toManagement = array(2,9,7,11,12);
					$this->assign("toManagement", $toManagement);
				{/php}
                <li  data-toggle="collapse" data-target="#products1" class="collapsed {if $iModuleActif|in_array:$toManagement}active{/if}">
                  <a href="#"><i class="fa fa-gift fa-lg"></i> Management des RH <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse {if $iModuleActif|in_array:$toManagement}in{/if}" id="products1">
                    <li {if $iModuleActif == 2} class="active" {/if}><a href="{$zBasePath}gcap/module/gestion-absence">Gestion des Absences</a></li>
					{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
						<li {if $iModuleActif == 4} class="active" {/if} ><a href="{$zBasePath}gcap/module/gestion-compte">Compte et congé</a></li>
					{/if}
                    <li {if $iModuleActif == 9} class="active" {/if}><a href="{$zBasePath}gcap/module/agent-evaluation">Evaluation</a></li>
					<li {if $iModuleActif == 11} class="active" {/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation">Reclassement</a></li>
                    <li {if $iModuleActif == 7} class="active" {/if}><a href="{$zBasePath}gcap/module/titre-de-paiement">Titre de paiement</a></li>
					<li {if $iModuleActif == 12} class="active" {/if}><a href="{$zBasePath}maintien/liste/maintien-liste/liste">Maintien en activité</a></li>
                </ul>
				{php}
					$toPointage = array(6,6);
					$this->assign("toPointage", $toPointage);
				{/php}
                <li data-toggle="collapse" data-target="#service1" class="collapsed {if $iModuleActif|in_array:$toPointage}active{/if}">
                  <a href="#"><i class="fa fa-exchange fa-lg"></i> Flux agents / visiteurs <span class="arrow"></span></a>
                </li>  
				
                <ul class="sub-menu collapse {if $iModuleActif|in_array:$toPointage}in{/if}" id="service1">
                  <li {if $iModuleActif == 6} class="active" {/if}><a href="{$zBasePath}gcap/module/pointage-electronique"">Pointage électronique</a></li>
                  <li><a href="#">Gestion des Visiteurs</a></li>
                </ul>

				{php}
					$toComm = array(-4,-5);
					$this->assign("toComm", $toComm);
				{/php}

				{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
                <li data-toggle="collapse" data-target="#new" class="collapsed  {if $iModuleActif|in_array:$toComm}active{/if}">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Infos et Comm <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse {if $iModuleActif|in_array:$toComm}in{/if}" id="new">
					<li {if $iModuleActif == -4} class="active" {/if}><a href="{$zBasePath}accueil/liste/communique/bo"><i class="fa fa-file-text"></i>Communiqu&eacute;</a></li>
					<li {if $iModuleActif == -5} class="active" {/if}><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><i class="fa fa-file-text"></i>Revue de presse</a></li>
                </ul>
				{/if}

				{if $iSessionCompte == COMPTE_AUTORITE || $oUser.im=='654321' ||  $oUser.im=='123456' || $oUser.im=='377036' || $oUser.im=='323939' || $oUser.im=='374986' ||  $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='307381' ||  $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939' }
				<li {if $iModuleActif == -13} class="active" {/if}><a href="{$zBasePath}gcap/respers"><i class="fa fa-user"></i>Modification DEP/DIR/SER</a></li>
				{/if}
				{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_ADMIN}
				<li {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="fa fa-file-text"></i>Moderation mot de passe</a></li>
				{/if}
				{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='374986' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}
				
				
				
            </ul>
     </div>
</div>
</nav>
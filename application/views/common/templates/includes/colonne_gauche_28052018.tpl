<div id="leftContent">
	<ul id="nav">
	<span class="retractLeftCont">
		<span class="left"><i class="la la-chevron-right"></i></span>
		<span class="right"><i class="la la-chevron-right"></i></span>
	</span>
	<span class="Fermer" >
		<span class="faClose">Faite <img src="{$zBasePath}assets/common/img/swipe.png" alt="" width="75px" height="50px" style="vertical-align:middle"/>&nbsp;pour fermer</span>
	</span>

	 <li cibleli="sipamAccueil" {if $iModuleActif == 1} class="active" {/if}>
	  <a href="{$zBasePath}accueil/communique">
	  <i class="la la-home fa-lg"></i><span class="sipam sipamAccueil">ACCUEIL</span></a>
	</li>

	{php}
		$toSfao = array(-4,-5);
		$this->assign("toSfao", $toSfao);
	{/php}

	<li cibleli="sipamFormation" {if $iModuleActif == 14} class="active" {/if}>
	  <a href="#" style="padding-top:7px!important"> 
	  <img src="{$zBasePath}assets/img/formation-icon.png" alt="" width="45px" height="35px" align="center"/><span class="sipam sipamFormation" >Formation</span></a>
		<div class="SSmenu">
			<div class="hasChild"><a href="{$zBasePath}formation/offre/sfao/divers-offres"><i class="la la-file-text-o"></i><span>OFFRES DE FORMATION</span></a></div>
			<div class="hasChild"><a href="{$zBasePath}formation/programme/sfao/programme-formation"><i class="la la-file-text-o"></i><span>REPORTING</span></a></div>
			<div class="hasChild"><a href="{$zBasePath}formation/texte/sfao/texte-reference"><i class="la la-file-text-o"></i><span>INFOS PRATIQUES</span></a></div>
			<div class="hasChild"><a href="{$zBasePath}formation/info/sfao/info-region"><i class="la la-file-text-o"></i><span>CALENDRIER DE FORMATION</span></a></div>
			<div class="hasChild"><a href="{$zBasePath}formation/bd/sfao/base-donnee-agent-forme"><i class="la la-file-text-o"></i><span>BASE DE DONNEES</span></a></div>

			{if $iSessionCompte == COMPTE_SFAO}
				<div><a href="{$zBasePath}formation/nomencl/sfao/"><span>TABLAU DE BORD</span></a></div>
			{/if}
		</div>
	</li>

	{php}
		$toSad = array(-4,-5);
		$this->assign("toSad", $toSad);
	{/php}

	<li cibleli="sipamSAD" {if $iModuleActif == 13} class="active" {/if}>
		<a href="#"><img src="{$zBasePath}assets/img/book.png" alt="" width="30px" height="30px" align="center"/>
		<span class="sipam sipamSAD">Archive et Documentation</span></a>
		<div class="SSmenu">
			<div class="hasChild">
				<a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture"><i class="la la-file-text-o"></i><span>INFOS PRATIQUES</span></a>
			</div>
			
			<div class="hasChild">
				<a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture"><i class="la la-file-text-o"></i><span>CATALOGUES</span></a>
			</div>
			
			<div class="hasChild">
				<a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture"><i class="la la-file-text-o"></i><span>NOUVEAUTES</span></a>
			</div>
			
			<div class="hasChild">
				<a href="{$zBasePath}documentation/service/sad/service-propose"><i class="la la-file-text-o"></i><span>SERVICES PROPOS&Eacute;S</span></a>
			</div>
			
			{if $iSessionCompte == COMPTE_SAD}
				<div><a href="{$zBasePath}tableau_bord/tableau/sad/tableau-bord"><span>TABLAU DE BORD</span></a></div>
			{/if}
			
			<div class="hasChild">
				<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution"><i class="la la-file-text-o"></i><span>RESTITUTION</span></a>
			</div>
		</div>
	  </span></a>
	</li>

	{php}
		$toManagement = array(2,9,7,11);
		$this->assign("toManagement", $toManagement);
	{/php}
	<li cibleli="sipamRH" class="{if $iModuleActif|in_array:$toManagement}active{/if}">
	  <a href="#"><i class="la la-gift fa-lg"></i><span class="sipam sipamRH">Management des RH</span></a>

		<div class="SSmenu">
			<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>GESTION DES ABSENCES</span></a>
				<div>
					<div><a href="{$zBasePath}gcap/liste/gestion-absence/decision"><span>LES DEMANDES</span></a>
					</div>
					<div><a href="{$zBasePath}gcap/extrants/gestion-absence/demande"><span>LES ARCHIVES</span></a></div>
					{if ($iSessionCompte != COMPTE_AUTORITE ||  $iSessionCompte != COMPTE_ADMIN )}
						<div><a href="{$zBasePath}gcap/etat/journal-planning/journal"><i class="la la-file-text-o"></i><span>JOURNAL ET PLANNING</span></a></div>
					{/if}
				</div>
			</div>
			{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
				<div><a href="{$zBasePath}gcap/module/gestion-compte"><i class="la la-file-text-o"></i><span>COMPTE ET CONGE</span></a></div>
			{/if}
			<div><a href="{$zBasePath}critere/liste/agent-evaluation/a-evaluer"><i class="la la-file-text-o"></i><span>EVALUATION</span></a></div>
			<div><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i class="la la-file-text-o"></i><span>RECLASSEMENT</span></a></div>
			<div><a href="{$zBasePath}avis/fiche/titre-de-paiement"><i class="la la-file-text-o"></i><span>TITRE DE PAIEMENT</span></a></div>
			<!--<div><a href="{$zBasePath}gestock/accueil/stock/home"><i class="la la-file-text-o"></i><span>GESTION DE STOCK</span></a></div>-->
			<!--<div><a href="{$zBasePath}gcourrier/liste/courrier/fonction-arrivee"><i class="la la-file-text-o"></i><span>GESTION DE COURRIER</span></a></div>-->
			<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>FICHE DE POSTE</span></a>
				<div>
					{php} 
					if ($_SESSION['iReturnAgent']==0){  
					{/php} 
					<div>
					<a href="{$zBasePath}accueil/ajout/fiche-de-poste/saisi"><span>MA FICHE DE POSTE</span></a>
					</div>
					{php} 
					}
					{/php} 
					{if $oUser.im=='389671' ||   $oUser.im=='307381' || $oUser.im=='287385' ||  $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='357018' || $oUser.im=='321684'}
					<div>
					<a  href="{$zBasePath}accueil/outils/fiche-de-poste/liste"><span>GESTION FICHE DE POSTE</span></a>
					</div>
					{/if}
					{if $oUser.im=='389671' ||   $oUser.im=='307381' || $oUser.im=='351101' || $oUser.im=='355857' ||  $oUser.im=='355857' ||  $oUser.im=='266661' ||  $oUser.im=='351275' ||  $oUser.im=='347592' ||  $oUser.im=='382791' ||  $oUser.im=='360085' ||  $oUser.im=='346035' ||  $oUser.im=='318697' ||  $oUser.im=='327024' ||  $oUser.im=='309458' ||  $oUser.im=='289399' ||  $oUser.im=='287385' || $oUser.im=='332690' || $oUser.im=='352600' || $oUser.im=='332026'}
					<div>
					<a  href="{$zBasePath}accueil/modification/fiche-de-poste/saisi"><span>MODERATION</span></a>
					</div>
					{/if}
				</div>
			</div>
		</div>
	</li>

	{php}
		$toPointage = array(6,6);
		$this->assign("toPointage", $toPointage);
	{/php}
	<li cibleli="sipamFlux" class="{if $iModuleActif|in_array:$toPointage}active{/if}">
		<a href="#"><i class="la la-exchange fa-lg"></i><span class="sipam sipamFlux">Flux agents / visiteurs</span></a>
		<div class="SSmenu">
		  <div><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction"><span>POINTAGE ELECTRONIQUE</span></a></div>
		  {if $iSessionCompte == COMPTE_SERVICE_ACCUIEL}
		  <div><a href="{$zBasePath}sau/login/gestion-visiteur/accueil"><span>GESTION DES VISITEURS</span></a></div>
		  {/if}
		</div>
	</li> 


	{php}
		$toComm = array(-4,-5);
		$this->assign("toComm", $toComm);
	{/php}

	{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
	<li cibleli="sipamInfoComm" class="{if $iModuleActif|in_array:$toComm}active{/if}">
		<a href="#"><i class="la la-globe fa-lg"></i><span class="sipam sipamInfoComm" >Infos et Comm</span></a>

		<div class="SSmenu">
			<div><a href="{$zBasePath}accueil/liste/communique/bo"><span>Communiqu&eacute;</span></a></div>
			<div><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><span>Revue de presse</span></a></div>
		</div>
	</li>
	{/if}

	{if $iSessionCompte == COMPTE_AUTORITE || $oUser.im=='654321' || $oUser.im=='355651' ||  $oUser.im=='123456' || $oUser.im=='332690'  || $oUser.im=='377036' || $oUser.im=='323939' || $oUser.im=='382791' || $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='389671' || $oUser.im=='307381' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im=='355857' || $oUser.im=='323939' || $oUser.im=='293785' || $oUser.im=='260942' || $oUser.im=='287385'}
	<li cibleli="sipamDep" {if $iModuleActif == -13} class="active" {/if}><a href="{$zBasePath}gcap/respers"><i class="la la-user"></i><span class="sipam sipamDep">Modification DIR/DEP/SER</span></a></li>
	{/if}
	{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_ADMIN}
	<li cibleli="sipamModeration" {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="la la-file-text"></i><span class="sipam sipamModeration">Moderation mot de passe</span></a></li>
	{/if}

	{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}
	{if $oCandidat[0]->direction == '3'}
	<li cibleli="sipamChat" {if $iModuleActif == 12} class="active" {/if}>
	  <a href="{$zBasePath}message/module/messagerie-instantanne/chat">
	  <i class="la la-wechat fa-lg"></i><span>Rohich@t </span>{if $iUnread}<span class="sipam sipamChat notification__chat">{$iUnread}</span>{/if}
	  </a>
	</li>
	{/if}
	{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='374986' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}

	</ul>
</div>

<div id="leftContent" class="nonvisible">
	<div class="nav-side-menu mobileMenu">
		<span class="retractLeftCont">
			<span class="left"><i class="la la-chevron-right"></i></span>
			<span class="right"><i class="la la-chevron-right"></i></span>
		</span>
		<span class="Fermer" >
			<span class="faClose">Faite <img src="{$zBasePath}assets/common/img/swipe.png" alt="" width="75px" height="50px" style="vertical-align:middle"/>&nbsp;pour fermer</span>
		</span>
		<i class="la la-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
			<div class="menu-list">
				<ul id="menu-content" class="menu-content collapse in">
					<li {if $iModuleActif == 1} class="active" {/if}>
					  <a href="{$zBasePath}accueil/communique">
					  <i class="la la-home fa-lg"></i> Accueil
					  </a>
					</li>
					<li data-toggle="collapse" data-target="#safao1" class="collapsed {if $iModuleActif|in_array:$toSfao}active{/if}">
					  <a href="#">
					  <i class="la la-graduation-cap fa-lg"></i> Formation <span class="arrow"></span></a>
					  </a>
					</li>
					<ul class="sub-menu collapse {if $iModuleActif|in_array:$toSfao}in{/if}" id="safao1">
						<li {if $iModuleActif == 125} class="active" {/if}><a href="{$zBasePath}formation/offre/sfao/divers-offres">Offres de formation</a></li>
						<li {if $iModuleActif == 214} class="active" {/if}><a href="{$zBasePath}formation/menu2/sfao/rapport-formation">Reporting </a></li>
						<li {if $iModuleActif == 118} class="active" {/if}><a href="{$zBasePath}formation/texte/sfao/texte-reference">Infos pratiques</a></li>
						<!--li {if $iModuleActif == 120} class="active" {/if}><a href="{$zBasePath}formation/calendrier/sfao/info-region">CALENDRIER DE FORMATION</a></li--->
						<li {if $iModuleActif == 225} class="active" {/if}><a href="{$zBasePath}formation/insc/sfao/inscription-ligne">Formations dispensées</a></li>
						{if $iSessionCompte == COMPTE_SFAO}
						<li {if $iModuleActif == 121} class="active" {/if}><a href="{$zBasePath}formation/nomencl/sfao/">Tablau de bord</a></li>
						{/if}
					</ul>
					<li data-toggle="collapse" data-target="#sad1" class="collapsed {if $iModuleActif|in_array:$toSad}active{/if}">
					  <a href="#">
					  <i class="la la-archive fa-lg"></i> Archives et documentation <span class="arrow"></span></a>
					  </a>
					</li>
					<ul class="sub-menu collapse {if $iModuleActif|in_array:$toSad}in{/if}" id="sad1">
						<li {if $iModuleActif == 91} class="active" {/if}><a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture">Infos pratiques</a></li>
						<li {if $iModuleActif == 96} class="active" {/if}><a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture">Catalogues</a></li>
						<li {if $iModuleActif == 191} class="active" {/if}><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture">Nouveautés</a></li>
						<li {if $iModuleActif == 207} class="active" {/if}><a href="{$zBasePath}documentation/service/sad/service-propose">Services propos&eacute;s</a></li>
						<li {if $iModuleActif == 208} class="active" {/if}><a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution">Restitution</a></li>
					</ul>
					<li  data-toggle="collapse" data-target="#products1" class="collapsed {if $iModuleActif|in_array:$toManagement}active{/if}">
					  <a href="#"><i class="la la-gift fa-lg"></i> Management des rh <span class="arrow"></span></a>
					</li>
					<ul class="sub-menu collapse {if $iModuleActif|in_array:$toManagement}in{/if}" id="products1">
						<li data-toggle="collapse" data-target="#gcap1" class="collapsed {if $iModuleActif|in_array:$toGcap}active{/if}"><a href="#">Gestions des absences <span class="arrow"></span></a></li>
						<ul class="sub-menu collapse {if $iModuleActif|in_array:$toGcap}in{/if}" id="gcap1">
							<li {if $iModuleActif == 4} class="active" {/if}><a href="{$zBasePath}gcap/extrants/gestion-absence/demande">Les demandes</a></li>
							<li {if $iModuleActif == 9} class="active" {/if}><a href="{$zBasePath}gcap/extrants/gestion-absence/decision">Les decisions</a></li>
							{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
								<li {if $iModuleActif == 4} class="active" {/if} ><a href="{$zBasePath}gcap/module/gestion-compte">Compte et conge</a></li>
							{/if}
						</ul>
						<li {if $iModuleActif == 9} class="active" {/if}><a href="{$zBasePath}gcap/module/agent-evaluation">Evaluation</a></li>
						<li {if $iModuleActif == 11} class="active" {/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation">Reclassement</a></li>
						<li {if $iModuleActif == 7} class="active" {/if}><a href="{$zBasePath}avis/fiche/titre-de-paiement">Titre de paiement</a></li>
						<li data-toggle="collapse" data-target="#fichePoste1" class="collapsed {if $iModuleActif|in_array:$toFiche}active{/if}"><a href="#">Fiche de poste <span class="arrow"></span></a></li>
						<ul class="sub-menu collapse {if $iModuleActif|in_array:$toFiche}in{/if}" id="fichePoste1">
							{if $iAfficheReturn ==0}
							<li {if $iModuleActif == 4} class="active" {/if}><a href="{$zBasePath}accueil/ajout/fiche-de-poste/saisi">Ma fiche de poste</a></li>
							{/if}
							{if $oUser.im=='389671' ||  $oUser.im=='355577' ||  $oUser.im=='287385' ||  $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='357018' || $oUser.im=='377036'}
							<li {if $iModuleActif == 9} class="active" {/if}><a href="{$zBasePath}accueil/listeFicheDePoste/module/liste">Gestion fiche de poste</a></li>
							{/if}
							{if $oUser.im=='389671' ||  $oUser.im=='355577' ||   $oUser.im=='307381' || $oUser.im=='351101' || $oUser.im=='355857' ||  $oUser.im=='355857' ||  $oUser.im=='266661' ||  $oUser.im=='351275' ||  $oUser.im=='347592' ||  $oUser.im=='382791' ||  $oUser.im=='360085' ||  $oUser.im=='346035' ||  $oUser.im=='318697' ||  $oUser.im=='327024' ||  $oUser.im=='309458' ||  $oUser.im=='289399' ||  $oUser.im=='287385' || $oUser.im=='332690' || $oUser.im=='352600' || $oUser.im=='332026'}
							<li {if $iModuleActif == 9} class="active" {/if}><a href="{$zBasePath}accueil/modification/fiche-de-poste/saisi">Moderation</a></li>
							{/if}
						</ul> 
					</ul>
					<li data-toggle="collapse" data-target="#service1" class="collapsed {if $iModuleActif|in_array:$toPointage}active{/if}">
					  <a href="#"><i class="la la-exchange fa-lg"></i> Flux agents / visiteurs <span class="arrow"></span></a>
					</li>  
					
					<ul class="sub-menu collapse {if $iModuleActif|in_array:$toPointage}in{/if}" id="service1">
					  <li {if $iModuleActif == 6} class="active" {/if}><a href="{$zBasePath}gcap/module/pointage-electronique"">Pointage electronique</a></li>
					  <li><a href="#">Gestion des visiteurs</a></li>
					</ul>

					

					{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
					<li data-toggle="collapse" data-target="#new" class="collapsed  {if $iModuleActif|in_array:$toComm}active{/if}">
					  <a href="#"><i class="la la-globe fa-lg"></i> Infos et comm <span class="arrow"></span></a>
					</li>
					<ul class="sub-menu collapse {if $iModuleActif|in_array:$toComm}in{/if}" id="new">
						<li {if $iModuleActif == -4} class="active" {/if}><a href="{$zBasePath}accueil/liste/communique/bo"><i class="la la-file-text"></i>Communique</a></li>
						<li {if $iModuleActif == -5} class="active" {/if}><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><i class="la la-file-text"></i>Revue de presse</a></li>
					</ul>
					{/if}

					{if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR || $oUser.im=='654321'  || $oUser.im=='355651' ||  $oUser.im=='123456' || $oUser.im=='377036' || $oUser.im=='323939' || $oUser.im=='382791' || $oUser.im=='374986' ||  $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='307381' ||  $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='357108' || $oUser.im =='STG_SGRH' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939' }
					<li {if $iModuleActif == -13} class="active" {/if}><a href="{$zBasePath}gcap/respers"><i class="la la-user"></i>Modification DEP/DIR/SER</a></li>
					{/if}
					{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_ADMIN}
					<li {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="la la-file-text"></i>Moderation mot de passe</a></li>
					{/if}
					{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='374986' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}
					{* {if $oCandidat[0]->direction == '190'} *}
					<li {if $iModuleActif == 12} class="active" {/if}>
					  <a href="{$zBasePath}message/module/messagerie-instantanne/tchat">
					  <i class="la la-wechat fa-lg"></i> ROHITCH@T {if !empty($iUnread)}<span class="notification__chat">{$iUnread}</span>{/if}
					  </a>
					</li>
					{* {/if} *}
				</ul>
		 </div>
	</div>
	<div class="DesktopMenu">
		<ul id="nav">
		<li cibleli="sipamAccueil" {if $iModuleActif == 1} class="active" {/if}>
		  <a href="{$zBasePath}accueil/communique">
		  <i class="la la-home fa-lg"></i><span class="sipam sipamAccueil">ACCUEIL</span></a>
		</li>
		<li cibleli="sipamFormation" {if $iModuleActif == 14} class="active" {/if}>
		  <a href="#" style="padding-top:7px!important"> 
		  <img src="{$zBasePath}assets/img/formation-icon.png" alt="" width="45px" height="35px" align="center"/><span class="sipam sipamFormation" >Formation</span></a>
			<div class="SSmenu">
				<div class="hasChild"><a href="{$zBasePath}formation/offre/sfao/divers-offres"><i class="la la-file-text-o"></i><span>Offres de formation</span></a></div>
				<!--div class="hasChild"><a href="{$zBasePath}formation/menu2/sfao/rapport-formation"><i class="la la-file-text-o"></i><span>REPORTING</span></a></div--->
				<div class="hasChild"><a href="{$zBasePath}formation/texte/sfao/texte-reference"><i class="la la-file-text-o"></i><span>Infos pratiques</span></a></div>
				<!---div class="hasChild"><a href="{$zBasePath}formation/calendrier/sfao/info-region"><i class="la la-file-text-o"></i><span>CALENDRIER DE FORMATION</span></a></div--->
				<div class="hasChild"><a href="{$zBasePath}formation/menu_base/sfao/menu-base"><i class="la la-file-text-o"></i><span>Formations DISPENSEES</span></a></div>

				{if $iSessionCompte == COMPTE_SFAO}
					<div><a href="{$zBasePath}formation/nomencl/sfao/"><span>Tablau de bord</span></a></div>
				{/if}
			</div>
		</li>
		<li cibleli="sipamSAD" {if $iModuleActif == 13} class="active" {/if}>
			<a href="#"><img src="{$zBasePath}assets/img/book.png" alt="" width="30px" height="30px" align="center"/>
			<span class="sipam sipamSAD">Archive et Documentation</span></a>
			<div class="SSmenu">
				<div class="hasChild">
					<a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture"><i class="la la-file-text-o"></i><span>Catalogues</span></a>
				</div>

				<div class="hasChild">
					<a href="{$zBasePath}documentation/texte/sad/texte-reglementaire"><i class="la la-file-text-o"></i><span>Textes reglementaires</span></a>
				</div>

				<div class="hasChild">
					<a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution"><i class="la la-file-text-o"></i><span>Restitution</span></a>
				
				</div>
				
				<div class="hasChild">
					<a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture"><i class="la la-file-text-o"></i><span>Infos pratiques</span></a>
				</div>
				{if ($iSessionCompte == COMPTE_SAD)}
				<div class="hasChild">
					<a href="{$zBasePath}documentation/service/sad/service-propose"><i class="la la-file-text-o"></i><span>Liste des prets</span></a>
				</div>
				{/if}
				
				
				<!--div class="hasChild">
					<a href="{$zBasePath}documentation/service/sad/service-propose"><i class="la la-file-text-o"></i><span>SERVICES PROPOS&Eacute;S</span></a>
				</div--->
				
			
			</div>
		  </span></a>
		</li>
		<li cibleli="sipamRH" class="{if $iModuleActif|in_array:$toManagement}active{/if}">
		  <a href="#"><i class="la la-gift fa-lg"></i><span class="sipam sipamRH">Management des RH</span></a>

			<div class="SSmenu">
				
				<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>Gestion des absences</span></a>
					<div>
						<div><a href="{$zBasePath}gcap/extrants/gestion-absence/demande"><span>Les demandes</span></a>
						</div>
						<div><a href="{$zBasePath}gcap/extrants/gestion-absence/decision"><span>Les decisions</span></a></div>
						{if ($iSessionCompte == COMPTE_AUTORITE ||  $iSessionCompte == COMPTE_ADMIN )}
							<div><a href="{$zBasePath}gcap/planningGantt/gestion-absence/planning"><i class="la la-file-text-o"></i><span>Journal et planning</span></a></div>
						{/if}
						<div><a href="{$zBasePath}Reporting/pointage"><span>Reporting Pointage</span></a>
						</div>
					</div>
				</div>
				{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
					<div><a href="{$zBasePath}gcap/module/gestion-compte"><i class="la la-file-text-o"></i><span>Compte et conge</span></a></div>
				{/if}
				<div><a href="{$zBasePath}critere/liste/agent-evaluation/a-evaluer"><i class="la la-file-text-o"></i><span>Evaluation</span></a></div>
				<div><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i class="la la-file-text-o"></i><span>Reclassement</span></a></div>
				<div><a {if $oUser.im=='ECD'}href="{$zBasePath}titre/fiche/titre-de-paiement"{else}href="{$zBasePath}avis/fiche/titre-de-paiement"{/if}><i class="la la-file-text-o"></i><span>Titre de paiement</span></a></div>
				{if $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='307381' || $oUser.im=='351101'}
				{* <div><a href="{$zBasePath}gestock/accueil/stock/home"><i class="la la-file-text-o"></i><span>Gestion de stock</span></a></div> *}
				{/if}
				<!--<div><a href="{$zBasePath}gcourrier/liste/courrier/fonction-arrivee"><i class="la la-file-text-o"></i><span>GESTION DE COURRIER</span></a></div>-->
				<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>fiche de poste</span></a>
					<div>
						{if $iAfficheReturn==0}
						<div>
						<a href="{$zBasePath}accueil/ajout/fiche-de-poste/saisi"><span>Ma fiche de poste</span></a>
						</div>
						{/if}

						{if $oUser.im=='389671' ||  $oUser.im=='355577' ||  $oUser.im=='287385' ||  $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='357018' || $oUser.im=='377036'}
						<div>
						<a  href="{$zBasePath}accueil/listeFicheDePoste/module/liste"><span>Gestion fiche de poste</span></a>
						</div>
						{/if}
						{if $oUser.im=='389671' ||  $oUser.im=='355577' ||   $oUser.im=='307381' || $oUser.im=='351101' || $oUser.im=='355857' ||  $oUser.im=='355857' ||  $oUser.im=='266661' ||  $oUser.im=='351275' ||  $oUser.im=='347592' ||  $oUser.im=='382791' ||  $oUser.im=='360085' ||  $oUser.im=='346035' ||  $oUser.im=='318697' ||  $oUser.im=='327024' ||  $oUser.im=='309458' ||  $oUser.im=='289399' ||  $oUser.im=='287385' || $oUser.im=='332690' || $oUser.im=='352600' || $oUser.im=='332026'}
						<div>
						<a  href="{$zBasePath}accueil/modification/fiche-de-poste/saisi"><span>Moderation</span></a>
						</div>
						{/if}
					</div>
				</div>
				{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
				<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>Traitement des actes</span></a>
					<div>
						<div><a href="{$zBasePath}traitementActe/preparationProjet"><span>Preparation du projet</span></a></div>
						<div><a href="{$zBasePath}traitementActe/saisieContenu"><span>Saisie de contenu du projet</span></a></div>
						<div><a href="{$zBasePath}traitementActe/suivi"><i class="la la-file-text-o"></i><span>Suivi d'un acte</span></a></div>
					</div>
				</div>
				{/if}
				{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
				<div class="hasChild"><a href="{$zBasePath}TelechargementLettreAdministrative/index"><i class="la la-file-text-o"></i><span>Télechargement des modèles lettres administratives</span></a>
				</div>
				{/if}
				{if $oUser.im=='332026' || $oUser.im=='355577'|| $oUser.im=='382791'|| $oUser.im=='351101'|| $oUser.im=='355857'}
				<div class="hasChild"><a href="#"><i class="la la-file-text-o"></i><span>D&eacute;claration de patrimoine</span></a>
					<div>
						<div><a href="{$zBasePath}DeclarationPatrimoine/declarerPatrimoine"><span>D&eacute;clarer mon patrimoine</span></a></div>
						<div><a href="{$zBasePath}DeclarationPatrimoine/telechargerFormulaire"><span>T&eacute;lecharger formulaire</span></a></div>
						<div><a href="{$zBasePath}DeclarationPatrimoine/etat"><span>Imprimer etat</span></a></div>
						<div><a href="{$zBasePath}DeclarationPatrimoine/statistique"><span>Statistiques</span></a></div>
						<div><a href="{$zBasePath}Criteres/index"><span>evaluation</span></a></div>
					</div>
				</div>
				{/if}
			</div>
		</li>
		<li cibleli="sipamFlux" class="{if $iModuleActif|in_array:$toPointage}active{/if}">
			<a href="#"><i class="la la-exchange fa-lg"></i><span class="sipam sipamFlux">Flux agents / visiteurs</span></a>
			<div class="SSmenu">
			  <div><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction"><span>Pointage electronique</span></a></div>
			  {if $iSessionCompte == COMPTE_SERVICE_ACCUIEL}
			  <div><a href="{$zBasePath}sau/login/gestion-visiteur/accueil"><span>Gestion des visiteurs</span></a></div>
			  {/if}
			</div>
		</li> 

		{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
		<li cibleli="sipamInfoComm" class="{if $iModuleActif|in_array:$toComm}active{/if}">
			<a href="#"><i class="la la-globe fa-lg"></i><span class="sipam sipamInfoComm" >Infos et Comm</span></a>

			<div class="SSmenu">
				<div><a href="{$zBasePath}accueil/liste/communique/bo"><span>Communiqu&eacute;</span></a></div>
				<div><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><span>Revue de presse</span></a></div>
			</div>
		</li>
		{/if}

		{if $iSessionCompte == COMPTE_AUTORITE || $oUser.im=='654321' ||  $oUser.im=='123456' || $oUser.im=='332690'  || $oUser.im=='377036' || $oUser.im=='323939' || $oUser.im=='382791' || $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='307381' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im=='355857' || $oUser.im=='323939' || $oUser.im=='293785' || $oUser.im=='357018' || $oUser.im=='260942' || $oUser.im=='287385'|| $oUser.im=='375206'}
		<li cibleli="sipamDep" {if $iModuleActif == -13} class="active" {/if}><a href="{$zBasePath}gcap/respers"><i class="la la-user"></i><span class="sipam sipamDep">Modification DIR/DEP/SER</span></a></li>
		{/if}
		{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_ADMIN || $oUser.im == '355651'}
		<li cibleli="sipamModeration" {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="la la-file-text"></i><span class="sipam sipamModeration">Moderation mot de passe</span></a></li>
		{/if}

		{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}
		{* {if $oCandidat[0]->direction == '190'} *}
		<li cibleli="sipamChat" {if $iModuleActif == 12} class="active" {/if}>
		  <a href="{$zBasePath}message/module/messagerie-instantanne/tchat">
		  <i class="la la-wechat fa-lg"></i><span>Rohitch@t </span>{if !empty($iUnread)}<span class="sipam sipamChat notification__chat">{$iUnread}</span>{/if}
		  </a>
		</li>
		{* {/if} *}
		{* {if $oUser.im=='307381' ||  $oUser.im=='332026' || $oUser.im=='389671' ||  $oUser.im=='355577' || $oUser.im=='353060' || $oUser.im=='377036' || $oUser.im=='374986' || $oUser.im=='355857' || $oUser.im=='357208' || $oUser.im=='355564' || $oUser.im =='351101' || $oUser.im =='STG_SGRH' || $oUser.im =='333583' || $oUser.im=='355857' || $oUser.im=='374987' || $oUser.im=='323939'} *}

		</ul>
	</div>
</div>
{literal}
<style>
.DesktopMenu{
	margin: -119px 0 0 0!important;
	position: absolute!important;
}
</style>
{/literal}
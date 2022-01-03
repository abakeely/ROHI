<div class="sidebar" id="sidebar" 
{if !empty($oRowUserTheme)>0}
{if $oRowUserTheme.0.fondPage_couleur !='' && $oRowUserTheme.0.fondPage_couleur != 'style-fond'}
style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, .3), rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.6)), url({$zBasePath}assets/common/img/{$oRowUserTheme.0.fondPage_photo}.jpg);background-position:left;"
{/if}
{/if}
>
	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: 100%; height: 100%;"><div class="sidebar-inner slimscroll" style="overflow: hidden; width: 100%; height: 100%">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul><!---GESTION DE COURRIER--->
				<input type="hidden" id="menu_active" value="menu_active_rh">
				<!---GESTION DES RESSOURCES HUMAINES--->
				<li class="menu-title"> 
					<span>Rohi</span>
				</li>
				<li class="submenu">
					<a href="#" {if $iModuleActif == 1}class="subdrop"{/if}>
						<i class="la la-phone"></i> <span>Communication</span>
						<span class="menu-arrow"></span>
					</a>
					<ul {if $iModuleActif == 1} style="display: block;" {else} style="display: none;" {/if} class="menu-content collapse in">
						<li {if $iModuleActif == 1} class="active" {/if}><a href="{$zBasePath}accueil/communique"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Accueil</span></a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" {if $iModuleActif|in_array:$toManagement}class="subdrop"{/if}>
						<i class="la la-users"></i> <span>Gestion des RH</span> 
						<span class="menu-arrow"></span>
					</a>
					<ul {if $iModuleActif|in_array:$toManagement} style="display: block;" {else} style="display: none;"{/if}>
						<li class="submenu">
							<a href="#" {if $iModuleActif|in_array:$toManagement}class="subdrop"{/if}><span>Gestions des absences</span><span class="menu-arrow"></span></a>
							<ul {if $iModuleActif|in_array:$toManagement} style="display: block;" {else} style="display: none;" {/if}>
								<li {if $oData.menu == 9} class="active" {/if}><a href="{$zBasePath}gcap/extrants/gestion-absence/demande"><i style="font-size: 16px;" class="la la-circle-o text-fuchsia"></i><span>Les demandes</span></a></li>
								<li {if $oData.menu == 8} class="active" {/if}><a href="{$zBasePath}gcap/congeCandidatPasse"><i style="font-size: 16px;" class="la la-circle-o text-purple"></i><span>Les décisions</span></a></li>
								{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
									<li {if $iModuleActif == 4} class="active" {/if} ><a href="{$zBasePath}gcap/congeCandidatPasse"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Compte et conge</span></a></li>
								{/if}
							</ul>
						</li>
						<li {if $iModuleActif == 9} class="active" {/if}><a {if $iSessionCompte == COMPTE_AGENT} href="{$zBasePath}critere/vosNotes/agent-evaluation/notes" {else} href="{$zBasePath}critere/liste/agent-evaluation/a-evaluer" {/if}><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Evaluation</span></a></li>
						<li {if $iModuleActif == 11} class="active" {/if}><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i style="font-size: 16px;" class="la la-circle-o text-blue"></i><span>Reclassement</span></a></li>
						<li {if $iModuleActif == 7} class="active" {/if}><a href="{$zBasePath}avis/fiche/titre-de-paiement"><i style="font-size: 16px;" class="la la-circle-o text-yellow"></i><span>Titre de paiement</span></a></li>
						<li data-toggle="collapse" data-target="#fichePoste1" class="collapsed {if $iModuleActif|in_array:$toFiche}active{/if}"><a href="#"><i style="font-size: 16px;" class="la la-circle-o text-green"></i><span>Fiche de poste</span><span class="arrow"></span></a></li>
					</ul>
				</li>
				
				<li class="submenu">
					<a href="#" {if $iModuleActif|in_array:$toSad}class="subdrop"{/if}>
						<i class="la la-book"></i> <span>Archives et Docs</span> 
						<span class="menu-arrow"></span>
					</a>
					<ul {if $oData.menu|in_array:$toSad} style="display: block;" {else} style="display: none;"{/if} id="menu_active_rh">
						<li {if $oData.menu == 91} class="active" {/if}><a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Infos pratiques</span></a></li>
						<li {if $oData.menu == 96} class="active" {/if}><a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture"><i style="font-size: 16px;" class="la la-circle-o text-blue"></i><span>Catalogues</span></a></li>
						<li {if $oData.menu == 191} class="active" {/if}><a href="{$zBasePath}documentation/couverture_nouveau/sad/collection-numerique-couverture"><i style="font-size: 16px;" class="la la-circle-o text-yellow"></i><span>Nouveautés</span></a></li>
						<li {if $oData.menu == 207} class="active" {/if}><a href="{$zBasePath}documentation/service/sad/service-propose"><i style="font-size: 16px;" class="la la-circle-o text-green"></i><span>Services propos&eacute;s</span></a></li>
						<li {if $oData.menu == 208} class="active" {/if}><a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution"><i style="font-size: 16px;" class="la la-circle-o text-orange"></i><span>Restitution</span></a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" {if $iModuleActif|in_array:(6)}class="subdrop"{/if}>
						<i class="la la-exchange"></i> <span>Flux agents/Visiteurs</span> 
						<span class="menu-arrow"></span>
					</a>
					<ul {if $iModuleActif|in_array:(6)}style="display: block;" {else} style="display: none;"{/if} id="menu_active_rh">
						<li {if $iModuleActif == 6} class="active" {/if}><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction"><i style="font-size: 16px;" class="la la-circle-o text-blue"></i><span>Pointage electronique</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" {if $oData.menu|in_array:$toSfao}class="subdrop"{/if}>
						<i class="la la-graduation-cap"></i> <span>Formations</span> 
						<span class="menu-arrow"></span>
					</a>
					<ul {if $oData.menu|in_array:$toSfao}style="display: block;" {else} style="display: none;"{/if} id="menu_active_rh">
						<li {if $oData.menu == 125} class="active" {/if}><a href="{$zBasePath}formation/offre/sfao/divers-offres"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Offres de formation</span></a></li>
						<li {if $oData.menu == 224} class="active" {/if}><a href="{$zBasePath}formation/menu2/sfao/rapport-formation"><i style="font-size: 16px;" class="la la-circle-o text-blue"></i><span>Reporting</span> </a></li>
						<li {if $oData.menu == 118} class="active" {/if}><a href="{$zBasePath}formation/texte/sfao/texte-reference"><i style="font-size: 16px;" class="la la-circle-o text-yellow"></i><span>Infos pratiques</span> </a></li>
						<!--li {if $iModuleActif == 120} class="active" {/if}><a href="{$zBasePath}formation/calendrier/sfao/info-region">CALENDRIER DE FORMATION</a></li--->
						<li {if $oData.menu == 124} class="active" {/if}><a href="{$zBasePath}formation/insc/sfao/inscription-ligne"><i style="font-size: 16px;" class="la la-circle-o text-green"></i><span> Formations dispensées</span></a></li>
						{if $iSessionCompte == COMPTE_SFAO}
						<li {if $oData.menu == 121} class="active" {/if}><a href="{$zBasePath}formation/nomencl/sfao/"><i style="font-size: 16px;" class="la la-circle-o text-orange"></i><span>Tablau de bord</span></a></li>
						{/if}
					</ul>
				</li>
				{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
					<li class="submenu">
							<a href="#" {if $iModuleActif|in_array:$toComm}active{/if}>
								<i class="la la-edit"></i> <span>Infos et comm</span> 
								<span class="menu-arrow"></span>
							</a>
						<ul class="sub-menu collapse {if $iModuleActif|in_array:$toComm}in{/if}" id="new">
							<li {if $iModuleActif == -4} class="active" {/if}><a href="{$zBasePath}accueil/liste/communique/bo"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Communique</span></a></li>
							<li {if $iModuleActif == -5} class="active" {/if}><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><i style="font-size: 16px;" class="la la-circle-o text-blue"></i><span>Revue de presse</span></a></li>
						</ul>
					</li>
				{/if}
				{* {if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_EVALUATEUR || $iSessionCompte == COMPTE_ADMIN || $oUser.im=='389671' || $oUser.im=='332026' }
				<li {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="la la-file-text"></i><span>Moderation mot de passe</span></a></li>
				{/if} *}

				
				<li {if $iModuleActif == -3} class="active" {/if}><a  href="{$zBasePath}votingmerite/tableaudebord"><i class="la la-dashboard"></i><span>Résultats de Vote</span></a></li>
				
				<!--li {if $iModuleActif == 12} class="active" {/if}>
				  <a href="{$zBasePath}message/module/messagerie-instantanne/tchat">
				  <!--i class="la la-wechat fa-lg"></i><span class="notification__chat">Mitafa Rohi {if !empty($iUnread)}{$iUnread}{/if}</span-->
				  </a>
				</li>
			</ul>
			{if $oUser.im=='389671' || $oUser.im=='332026' }
			<ul>
				<li class="menu-title"> 
					<span>RohiZara</span>
				</li>
				<li class="submenu">
					<a href="#" {if $iModuleActif == 17}class="subdrop"{/if}>
						<i class="la la-envelope"></i> <span>Gestion de courrier</span> 
						<span class="menu-arrow"></span>
					</a>
					<ul class="sub-menu collapse" {if $iModuleActif == 17} style="display: block;" {else} style="display: none;" {/if} id="menu_active_rh">
						<li {if $iModuleActif == 17} class="active" {/if}><a href="{$zBasePath}courrier/liste/"><i style="font-size: 16px;" class="la la-circle-o text-red"></i><span>Liste des courriers</span></a></li>
					</ul>
				</li>
			</ul>
			{/if}
		</div>
	</div><div class="slimScrollBar" style="background: rgb(204, 204, 204); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 694px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>
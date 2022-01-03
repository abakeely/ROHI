<div class="col-md-2">
	<div class="wrap_nav"> 
		<ul>
			<li><a href="{$zBasePath}accueil/communique"><i class="la la-home fa-lg"></i> Accueil</a></li>
			<li class="dropdown"><a href="#"><i class="la la-home fa-lg"></i>Formation</a>
				<ul>
					<li><a href="{$zBasePath}formation/offre/sfao/divers-offres"><i class="la la-file-text-o"></i>&nbsp;Offres de formation</a></li>
					<li><a href="{$zBasePath}formation/texte/sfao/texte-reference"><i class="la la-file-text-o"></i> Infos pratiques</a></li>
					<li><a href="{$zBasePath}formation/menu_base/sfao/menu-base"><i class="la la-file-text-o"></i>Formations Dispensées</a></li>
					{if $iSessionCompte == COMPTE_SFAO}
						<li><a href="{$zBasePath}formation/nomencl/sfao/"><i class="la la-file-text-o"></i>Tableau de bord</a></li>
					{/if}
				</ul>
			</li>
			<li class="dropdown"><a href="#"><img src="{$zBasePath}assets/img/book.png" alt="" width="30px" height="30px" align="center"/>Archive et Documentation</a>
				<ul>
					<li><a href="{$zBasePath}documentation/catalogue/sad/catalogue-couverture"><i class="la la-file-text-o"></i>&nbsp;Catalogues</a></li>
					<li><a href="{$zBasePath}documentation/texte/sad/texte-reglementaire"><i class="la la-file-text-o"></i> Textes reglementaires</a></li>
					<li><a href="{$zBasePath}documentation/planningRestitution/documentation/planning-restitution"><i class="la la-file-text-o"></i>Restitution</a></li>
					<li><a href="{$zBasePath}documentation/Info/sad/info-pratique-couverture"><i class="la la-file-text-o"></i>Infos pratiques</a></li>
					{if ($iSessionCompte == COMPTE_SAD)}
					<li><a href="{$zBasePath}documentation/service/sad/service-propose"><i class="la la-file-text-o"></i>Liste des prets</a></li>
					{/if}
				</ul>
			</li>
			<li class="dropdown"><a href="#"><i class="la la-gift fa-lg"></i>&nbsp;Management des RH</a>
				<ul>
					<li><a href="{$zBasePath}gcap/extrants/gestion-absence/decision"><i class="la la-file-text-o"></i>&nbsp;Les decisions</a></li>
					<li><a href="{$zBasePath}gcap/planningGantt/gestion-absence/planning"><i class="la la-file-text-o"></i> Journal et planning</a></li>
					<li><a href="{$zBasePath}critere/liste/agent-evaluation/a-evaluer"><i class="la la-file-text-o"></i>Evaluation</a></li>
					<li><a href="{$zBasePath}reclassement/gestion/gestion-reclassement/visualisation"><i class="la la-file-text-o"></i>Reclassement</a></li>
					{if ($iSessionCompte != COMPTE_AGENT && $iSessionCompte != COMPTE_EVALUATEUR && $iSessionCompte != COMPTE_COMMUNICATION && $iSessionCompte != COMPTE_RECLASSEMENT )}
						<li><a href="{$zBasePath}gcap/congeCandidatPasse"><i class="la la-file-text-o"></i>&nbsp;Ajout / Edition Décision</a></li>
						<li><a href="{$zBasePath}gcap/AssignCompte"><i class="la la-file-text-o"></i>&nbsp;Edition des comptes</a></li>
					{/if}
					{if ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL ||  $iSessionCompte == COMPTE_ADMIN || $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR) }
						<li><a href="{$zBasePath}gcap/extrants/gestion-absence/demande"><i class="la la-file-text-o"></i>&nbsp;Liste des demandes d'abscence</a></li>
						<li><a href="{$zBasePath}pointage/liste/gestion-absence/agents-rattaches"><i class="la la-file-text-o"></i>&nbsp;Saisie Entrée Sotrie</a></li>
					{/if}
					{if ($iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL ||  $iSessionCompte == COMPTE_ADMIN || $iSessionCompte == COMPTE_AUTORITE) }
						<li><a href="{$zBasePath}GestionStructure/index"><i class="la la-file-text-o"></i>&nbsp;Rapprochements des agents</a></li>
					{/if}
					{if ($iSessionCompte == COMPTE_EVALUATEUR ) }
						<li><a href="{$zBasePath}critere/liste/agent-evaluation/a-evaluer"><i class="la la-file-text-o"></i>&nbsp;Liste des agents à évaluer</a></li>
						<li><a href="{$zBasePath}critere/liste/agent-evaluation/classification"><i class="la la-file-text-o"></i>&nbsp;Catégorie évaluation</a></li>
					{/if}
				</ul>
			</li>
			{if $iSessionCompte == COMPTE_COMMUNICATION || $iSessionCompte == COMPTE_ADMIN}
				<li class="dropdown"><a href="#"><i class="la la-gift fa-lg"></i>&nbsp;Infos et Comm</a>
				<ul>
					<li><a href="{$zBasePath}accueil/liste/communique/bo"><i class="la la-file-text-o"></i>&nbsp;Communiqu&eacute;</a></li>
					<li><a href="{$zBasePath}accueil/liste/revue-de-presse/bo"><i class="la la-file-text-o"></i> Revue de presse</a></li>
				</ul>
			{/if}
			
			
			<li class="dropdown"><a href="#"><i class="la la-gift fa-lg"></i>&nbsp;Flux agents / visiteurs</a>
				<ul>
					<li><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction"><i class="la la-file-text-o"></i>&nbsp;Pointage electronique</a></li>
					{if $iSessionCompte == COMPTE_SERVICE_ACCUIEL || $iSessionCompte == COMPTE_ADMIN}
					<li><a href="{$zBasePath}sau/login/gestion-visiteur/accueil"><i class="la la-file-text-o"></i> Gestion des visiteurs</a></li>
					{/if}
				</ul>
			</li>
			{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_ADMIN}
				{if $oUser.im=='332026' || $oUser.im=='355577'|| $oUser.im=='355857'}
				<li class="dropdown"><a href="#"><i class="la la-gift fa-lg"></i>&nbsp;Traitement des actes</a>
					<ul>
						<li><a href="{$zBasePath}traitementActe/preparationProjet"><i class="la la-file-text-o"></i>&nbsp;Preparation du projet</a></li>
						<li><a href="{$zBasePath}traitementActe/suivi"><i class="la la-file-text-o"></i> Suivi d'un acte</a></li>
						<li><a href="{$zBasePath}traitementActe/saisieContenu"><i class="la la-file-text-o"></i> Saisie de contenu du projet</a></li>
						<li><a href="{$zBasePath}traitementActe/attributionVisaFinance"><i class="la la-file-text-o"></i> Attribution des visas finance</a></li>
						<li><a href="{$zBasePath}traitementActe/attributionVisaCf"><i class="la la-file-text-o"></i> Attribution des visas cf</a></li>
						<li><a href="{$zBasePath}traitementActe/mandatement"><i class="la la-file-text-o"></i> Mandatement</a></li>
					</ul>
				</li>
				{/if}
			{/if}
			{if $iSessionCompte == COMPTE_ADMIN}
				<li class="dropdown"><a href="#"><i class="la la-gift fa-lg"></i>&nbsp;Back Office</a>
				<ul>
					<li><a href="{$zBasePath}user/list_user_no_cv"><i class="la la-file-text-o"></i>&nbsp;Compte sans CV	</a></li>
					<li><a href="{$zBasePath}user/respers"><i class="la la-file-text-o"></i> Compte resp pers</a></li>
					<li><a href="{$zBasePath}user/list_respers"><i class="la la-file-text-o"></i> Liste Res pers</a></li>
					<li><a href="{$zBasePath}access/index"><i class="la la-file-text-o"></i> Donnée matricule	</a></li>
					<li><a href="{$zBasePath}access/ecd"><i class="la la-file-text-o"></i>Insertion ECD</a></li>
					<li><a  href="{$zBasePath}pointage/moderation/pointage-electronique/moderer"><i class="la la-file-text"></i>MODERATION MOT DE PASSE</a></li>
				</ul>
			{/if}
		</ul>
	</div>
</div>
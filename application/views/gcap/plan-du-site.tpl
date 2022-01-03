{include_php file=$zHeader }
<link rel="stylesheet" type="text/css" href="{$zBasePath}assets/gcap/css/app/slickmap.css">
<section id="mainContent" class="clearfix">
	<div id="leftContent">
		{include_php file=$zLeft}
	</div>
	<div id="innerContent">
		<div class="sitemap">

		<h2>PLAN DU SITE</h2>
		<!--
		<ul id="utilityNav">
			<li><a class="tooltip" href="/register">Register</a></li>
			<li><a class="tooltip" href="/login">Log In</a></li>
			<li><a class="tooltip" href="/sitemap">Site Map</a></li>
		</ul>
		-->
		<form>
		<ul id="primaryNav" class="col7">
			<li id="home"><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/">ROHI</a></li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/">Accueil</a>
				<ul>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/mon_cv">Mon CV&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Contenant les informations de l'agent :<br> 
								- Informations administratives <br> 
								- Etat civil<br> 
								- Adresse et contact<br> 
								- Formations<br> 
								- Parcours profesionnel<br> 
								- Possibilité de modification de CV"
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/index">Communiqué&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>

								Contenant les dernières informations au niveau du Ministère qui sont parvenues au niveau de la DRHA (Note, Communiqué, Appel à candidature interne et externe, Bourse d'études, candidature aux programmes de formation, …)
	
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/vosNotes">Vos notes d'évaluations&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Résume les notes d'évaluation obtenues par l'agent au cours des derniers mois	
						</span>
						</a>
					</li>
					{if $oData.iCompteActif > 1 && $oData.iCompteActif < 5}
					<li><a class="tooltip" href="#">Mouvement</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/mouvement">Historique des mouvements&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Historique des mouvements	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/histo_info_admin">Historique des informations admin&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Historique des informations admin	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/list_cv">Liste par directions&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Liste des agents par direction		
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/assets/pdf/FICHE_ROHI.pdf">Télécharger la fiche ROHI&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								<br/>
								<br/>		
						</span>
						</a>
					</li>
						</ul>
					</li>
					{/if}
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/module/formation">Formations</a>
				<ul>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/offres-locales">Offre de formations</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/offres-locales">Offre locales&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Offre de formation offerte par la DRHA au niveau du MFB, séminaire de formation offert sur le territoire malgache	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/bourses">Bourses&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Offre de formation gratuite, offerte par l'institut de formation		
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/concours">Concours&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Concours local comme Trésor, IMATEP, INFA,….	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/formations-payantes">Formations externes payantes&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Offre de de formations extérieures dont les coûts de formation sont à la charge du participant	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/rapports-de-formations">Reporting</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/rapports-de-formations">Rapport de formation&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Rapport de formation que ce soit externe ou externe	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/rapports-evaluation">Rapport d'evaluation&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Rapport d'évaluation		
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/textes-de-references">Lien utiles</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/textes-de-references">Textes de réference&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Les textes ayant rapport avec les formations	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/documents-points-focaux-formations">Document point focaux formations&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Le document point focaux formations		
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/info-com">Info comm&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/photos">Archives</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/photos">Photos&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Les photos de tous les formations que ce soit interne ou externe	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/sfao/page/trombinoscope">Trombinoscope&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Les photos de toutes les personnes ayant participés à la formation extérieure ayant fait la restitution	
						</span>
						</a>
					</li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/sad">ARCHIVES ET DOCUMENTATION</a>
				<ul>
					<li><a class="tooltip" href="/projects/finance">Infos Pratiques</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/reglement">Règlement&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Ensemble des prescriptions au sein du SAD que les usagers et les agents du MFB doivent suivre.			
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/guide">Guide du lecteur&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Conçu pour accompagner les usagers dans la découverte du Service et permet à la fois de les orienter.
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/plan_d_acces">Plan d'accès&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Indication détaillé du chemin pour aller au SAD.
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/assets/pdf/FICHE_ROHI.pdf">L'Equipe du SAD&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Ensemble des agents au sein du service.	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/catalogue_livre">Catalogues&nbsp;</a></li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/nouveaute_liste">Nouveautés&nbsp;</a></li>
					<li><a class="tooltip">Document numérisés</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/texte_reglementaire">Textes règlementaires&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Ensemble des actes du gouvernement et des décisions des exécutifs. ( loi,Ordonnances,Décrets, Arrêtés, Circulaires, Notes)
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/autre_numerise">Ouvrage numérisés&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Regroupe les ouvrages disponibles en version numérique.	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="/projects/industrial">Services proposés</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/liste_pret">Listes de prêts&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Consultation des ouvrages empruntés.	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/prolongation_pret">Prolonger un prêt&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Prolongement de prêt d'un ouvrage emprunté
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/besoin_livre">Besoin spécifiques&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Recensement des besoins en ouvrages non disponible dans le catalogue ou expression de divers besoins en rapport avec le service du SAD.
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/liste_besoin">Liste des besoins spécifiques&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Suivi des besoins exprimer (si besoins validés ou refusés).	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="/projects/commercial">Restitution</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/texte_reglementaire">Images et vidéos&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Ensemble des images et vidéos relatives aux séances de restitution.	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/documentation/autre_numerise">Planning de restitution&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Programme détaillé de restitution.		
						</span>
						</a>
					</li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/avis/fiche/titre-de-paiement">Titre de paiement</a>
				<ul>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/avis/fiche/titre-de-paiement">Fiche&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								- Consultation et/ou impression de la fiche de paie du mois en cours, et/ou des mois antérieurs
								- Recherche des fiches de paie des mois antérieurs
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/avis/rubrique/titre-de-paiement">Code rubrique&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Signification des codes rubriques dans la fiche de paie		
						</span>
						</a>
					</li>
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/">Gestion d'absence</a>
				<ul>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/decision">Les demandes</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/decision">Décisison&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour ajouter une demande de décision de congé
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/conge">Congé&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour ajouter une demande de congé	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/autorisation-abscence">Autorisation d'absence&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Ajout des demandes d'autorisation d'absence		
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/repos-medical">Permission&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour ajouter une demande de permission	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/liste/gestion-absence/permission">Repos médical&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour ajouter un repos médical	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/etat/gestion-absence/conge">Les etats</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/etat/gestion-absence/conge">Les etats de congés&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour voir les détails de départ en congé 
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/etat/gestion-absence/autorisation-abscence">Les états d'absence&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour voir les détails de l'autorisation d'absence 
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/etat/gestion-absence/permission">Les états de permission&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour voir les détails de la demande de permission 	
						</span>
						</a>
					</li>
						</ul>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/extrants/gestion-absence/decision">Les extrants</a>
						<ul>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/extrants/gestion-absence/decision">Décisions&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
							Pour voir l'historique des décisions de congé de l'agent
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/extrants/gestion-absence/demande">Demandes&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour voir l'historique des demandes déjà effectuées par l'agent (congé, autorisation d'absence, permission, repos médical)	
						</span>
						</a>
					</li>
							<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/extrants/gestion-absence/arretes">Arrêtés&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Pour voir l'historique des arrêtés concernant  l'agent	
						</span>
						</a>
					</li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/gcap/module/pointage-electronique">Pointage électronique</a>
				<ul>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/liste/pointage-electronique/transaction">Transaction&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Consultation des heures d' entrées et de sorties de l'agent
								(possibilité de consultation des jours et des mois antérieurs)
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/badge/pointage-electronique/saisie">Badge électronique&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Commande de badge electronique, en cas de:
								- Besoin de nouveau badge (pour les cas des nouveaux recrus)
								- Perte
								- Badge deffectueux
								- Transfert inter-départemental
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/liste/pointage-electronique/rang">Rang&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Consultation du rang de l'agent par rapport aux heures effectuées  au niveau de son département, de sa direction, de son service, et de sa divison 		
						</span>
						</a>
					</li>
					{if $oData.iCompteActif > 1 && $oData.iCompteActif < 5}
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/liste/pointage-electronique/agents-rattaches">Saisie entrée / sortie&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Possibilité pour le Responsable Personnel d'entrer manuellement les heures d'entrées et de sorties des agents sous sa responsabilité	
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/liste/pointage-electronique/les-conges">Saisie congé et autres&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								
						</span>
						</a>
					</li>
					{/if}
				</ul>
			</li>
			<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/">Evaluation</a>
				<ul>
					{if $oData.iCompteActif ==1}
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/cv/vosNotes">Vos notes d'évaluations&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Consultation des notes d'évaluation de l'agent concernant le mois en cours ainsi que des mois antérieurs
	
						</span>
						</a>
					</li>
					{/if}
					{if $oData.iCompteActif ==3}
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/evaluation/liste/agent-evaluation/agents-rattaches">Liste des agents rattachés&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso perso1">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
						Consultation de la liste des agents rattachés à un Responsable Personnel	
						</span>
						</a>
					</li>
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/evaluation/liste/agent-evaluation/global">Evaluation global des agents rattachés&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso perso1">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Visibilité d'un supérieur hiérarchique pour voir tous les agents qui lui sont rattachés (accessible uniquement à partir d'un compte autorité)		
						</span>
						</a>
					</li>
					{/if}
					{if $oData.iCompteActif ==2 || $oData.iCompteActif ==3}
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/pointage/liste/pointage-electronique/agents-rattaches">Saisie entrée / sortie&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso perso1">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								Possibilité pour le Responsable Personnel d'entrer manuellement les heures d'entrées et de sorties des agents sous sa responsabilité
						</span>
						</a>
					</li>
					{/if}
					{if $oData.iCompteActif ==5}
					<li><a class="tooltip" href="http://rohi.mefb.gov.mg:8088/ROHI/evaluation/liste/agent-evaluation/a-evaluer">Liste des agents à évaluer&nbsp;<i id="allToltip" class="la la-info-circle"></i>
						
						<span class="perso">	
								<h1 class="recap"><i style="color:black" class="la la-info-circle"></i>&nbsp;Aide&nbsp;</h1>
								- Consultation de la liste des agents à évaluer par un évaluateur 
								  (vous êtes un évaluateur si vous avez accès à ce type de compte , et avez accès à une liste d'agents à évaluer)
								- Possibilité de choisir un agent à évaluer dans la liste
						</span>
						</a>
					</li>
					{/if}
				</ul>
			
			</li>
		</ul>
		</form>
	</div>

	</div>
</section>
{literal}
<style>
h1.recap {
	font-size:1.2em;
	text-align:center;
	font-weight:blod;
	color:black;
	border-bottom:1px solid black;
	padding-bottom:12px;
}
form .tooltip span {
    display: block;
    position: absolute;
    top: -26px;
    left: 150px;
    width: 250px;
    padding: 15px;
	background: rgb(255, 219, 0);
    /*background: rgb(255, 255, 255);*/
	box-shadow: inset 0 0 20px rgba(0,0,0,.2);
	z-index:200000;
	color:white;
    border: 1px solid #e2e2e2;
    font-size: 1em;
    line-height: 1.2em;
    color: #000;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: all 0.25s ease;
    -moz-transition: all 0.25s ease;
    -o-transition: all 0.25s ease;
    transition: all 0.25s ease;
}
.perso1 {
	top: 55px!important;
    left: 10px!important;
}
</style>
{/literal}
{include_php file=$zFooter}
<div class="sticky_menu">
    <div class="list-group">

        {if $oUser.im=='332026'}
            <a href="{base_url('/accueil/cvAll/')}" class="list-group-item">
                <img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon1.png" /> <span class="menu-sticky-label">CV des agents</span>
            </a>
            {if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }
                <a href="{base_url('/gcap/congeCandidatPasse')}" class="list-group-item">
                    <img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon2.png" /> <span class="menu-sticky-label">Décision de congé</span>
                </a>
            {/if}
            {if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR}
                <a class="list-group-item" href="{base_url('/critere/liste/agent-evaluation/fiche-de-poste-cv-notes')}" title="Fiche de poste / Cv / Note de mes agents">
                    <img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon2.png" /> <span class="menu-sticky-label">Infos des agents</span>
                </a>
            {/if}
        <a class="list-group-item"  href="{base_url('formation/offre/sfao/divers-offres')}" title="Formation">
	<img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon3.png" />
	<span class="menu-sticky-label">Formation</span></a>
            <a class="list-group-item" href="{base_url('documentation/infprat/sad/inf-prat')}"title="Archive et Documentation"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon4.png" /><span class="menu-sticky-label">Archive et Documentation</span></a>
            <a class="list-group-item" href="{base_url('gcap/extrants/gestion-absence/demandes')}" title="Demande d'absence"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon5.png" /><span class="menu-sticky-label">Demande d'absence</span></a>
            <a class="list-group-item" href="{base_url('avis/fiche/titre-de-paiement')}" title=" Titre de paiement"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon6.png" /><span class="menu-sticky-label">Titre de paiement</span></a>
            <a class="list-group-item" href="{base_url('pointage/liste/pointage-electronique/transaction')}" title="Ma transaction"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon7.png" /><span class="menu-sticky-label">Mes transactions</span></a>
            <a class="list-group-item" href="{base_url('pointage/liste/pointage-electronique/lg-pass')}" title="Login/Password"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon8.png" /><span class="menu-sticky-label">Login / Password</span></a>
            <a class="list-group-item" href="{base_url('gcap/commConge/gestion-absence/fiche')}" title="Login/Password"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon9.png" /><span class="menu-sticky-label">Suppression congé</span></a>
            <a class="list-group-item" href="{base_url('message/module/messagerie-instantanne/tchat')}"  title="Ma transaction"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon10.png" /><span class="menu-sticky-label" id="tchat_notification">{$iNbMessage}</span></i><span class="menu-sticky-label">ROHI@TCHAT</span></a>
        {else}
			 {if $oUser.im=='332026' || $oUser.im=='353108' || $oUser.im=='322060' ||  $oUser.im=='322146'  || $oUser.im=='322509' || $oUser.im=='293785'}
					<a class="list-group-item" href="{base_url('accueil/cvAll/')}" title="cv des agents"><i class="fas fa-address-card"></i> <span class="menu-sticky-label">CV des agents</span>
            {/if}
            {if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }
                <a class="list-group-item" href="{base_url('gcap/congeCandidatPasse')}" title="Décision de congé"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon1.png" /> <span class="menu-sticky-label">Décision de congé</span></a>
            {/if}
            {if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR|| $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
                <a class="list-group-item" href="{base_url('critere/liste/agent-evaluation/fiche-de-poste-cv-notes')}" title="Fiche de poste / Cv / Note de mes agents"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon2.png" /> <span class="menu-sticky-label">Infos des agents</span></a>
            {/if}
            <a class="list-group-item" style="padding-top:4px;" href="{base_url('formation/menu/sfao/menu-principal')}" title="Formation"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon3.png" /></i>
                <span class="menu-sticky-label">Formation</span></a>
            <a class="list-group-item" href="{base_url('documentation/infprat/sad/inf-prat')}"title="Archive et Documentation"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon4.png" /><span class="menu-sticky-label">Archive et Documentation</span></a>
            <a class="list-group-item" href="{base_url('gcap/extrants/gestion-absence/demandes')}" title="Demande d'absence"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon5.png" /><span class="menu-sticky-label">Demande d'absence</span></a>
	<a class="list-group-item" href="{base_url('avis/fiche/titre-de-paiement')}" title=" Titre de paiement"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon6.png" /><span class="menu-sticky-label">Titre de paiement</span></a>
	<a class="list-group-item" href="{base_url('pointage/liste/pointage-electronique/transaction')}" title="Ma transaction"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon7.png" /><span class="menu-sticky-label">Mes transactions</span></a>
	{if $oUser.id=='617' || $oUser.id=='11' || $oUser.id=='9312' || $oUser.id=='3'}
		<a class="list-group-item" href="{base_url('pointage/liste/pointage-electronique/lg-pass')}" title="Login/Password"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon8.png" /><span class="menu-sticky-label">Login / Password</span></a>
	{/if}
	{if  $oUser.id=='11' || $oUser.id=='4430'|| $oUser.id=='3'}
		<a class="list-group-item" href="{base_url('gcap/commConge/gestion-absence/fiche')}" title="Login/Password"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon9.png" /><span class="menu-sticky-label">Suppression congé</span></a>
	{/if}
	<a class="list-group-item" href="{base_url('message/module/messagerie-instantanne/tchat')}"  title="Ma transaction"><img src="{base_url()}/application/modules/evaluations/assets/images/icons/icon10.png" /><span class="menu-sticky-label" id="tchat_notification">{$iNbMessage}</span><span class="menu-sticky-label">ROHI@TCHAT</span></a>

        {/if}

            <a class="list-group-item power-off" href="{base_url('/gcap/deconnexion')}"  title="Déconnexion"><i class="fas fa-power-off"></i><span class="menu-sticky-label">Déconnexion</span></a>

    </div>
</div>	
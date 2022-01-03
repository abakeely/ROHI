<div class="col-md-1">
	<div class="stickymenu">
			<h2>MES FAVORIS</h2>
			<ul>
				{if $oUser.im=='332026'}
					<li><a href="{$zBasePath}accueil/cvAll/" title="cv des agents"><i class="ace-icon la la-vcard"></i>CV des agents</a></li>
					{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }
						<li><a href="{$zBasePath}gcap/congeCandidatPasse" title="Décision de congé"><i class="ace-icon la la-vcard"></i>Décision de congé</a></li>
					{/if}
					{if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR}
					<li><a href="{$zBasePath}critere/liste/agent-evaluation/fiche-de-poste-cv-notes" title="Fiche de poste / Cv / Note de mes agents"><i class="ace-icon la la-vcard"></i>Infos des agents</a></li>
					{/if}
					<li><a style="padding-top:4px;" href="{$zBasePath}formation/offre/sfao/divers-offres" title="Formation"><i class="la la-book"></i>Formation</a></li>
					<li> <a href="{$zBasePath}documentation/infprat/sad/inf-prat"title="Archive et Documentation"><i class="la la-book"></i>Archive et Documentation</a></li>
					<li><a href="{$zBasePath}gcap/extrants/gestion-absence/demandes" title="Demande d'absence"><i class="la la-user-times"></i>Demande d'absence</a></li>
					<li><a href="{$zBasePath}avis/fiche/titre-de-paiement" title=" Titre de paiement"><i class="la la-id-card-o"></i>Titre de paiement</a></li><li><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction" title="Ma transaction"><i class="la la-exchange"></i>Mes transactions</a></li>
					<li><a href="{$zBasePath}pointage/liste/pointage-electronique/lg-pass" title="Login/Password"><i class="ace-icon la la-vcard"></i>Login / Password</a></li>
					<li><a href="{$zBasePath}gcap/commConge/gestion-absence/fiche" title="Login/Password"><i class="ace-icon la la-vcard"></i>Suppression congé</a></li>
					<li><a href="{$zBasePath}message/module/messagerie-instantanne/tchat"  title="Ma transaction"><i class="la la-wechat fa-lg " ><span style="font-size:18px;" id="tchat_notification">{$iNbMessage}</span></i>ROHI@TCHAT</a></li>
				{else}
					{if $oUser.im=='111111' || $oUser.im=='222222' || $oUser.im=='332026' ||  $oUser.im=='355577'  || $oUser.im=='307381' || $oUser.im=='377036' || $oUser.im=='357018' || $oUser.im=='351101' || $oUser.im=='355857' || $oUser.im=='332026' || $oUser.im=='' || $oUser.im=='320744' || $oUser.im=='224318' || $oUser.im=='262929' || $oUser.im=='353108'|| $oUser.im=='391620'|| $oUser.im=='374673'|| $oUser.im=='386308'|| $oUser.im=='280217' || $oUser.im=='338037' || $oUser.im=='374642'|| $oUser.im=='295622'|| $oUser.im=='289406'|| $oUser.im=='278203'}
					<li><a href="{$zBasePath}accueil/cvAll/" title="cv des agents"><i class="ace-icon la la-vcard"></i>CV des agents</a></li>
					{/if}
					{if $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL || $iSessionCompte == COMPTE_AUTORITE }
						<li><a href="{$zBasePath}gcap/congeCandidatPasse" title="Décision de congé"><i class="ace-icon la la-vcard"></i>Décision de congé</a></li>
					{/if}
					{if $iSessionCompte == COMPTE_AUTORITE || $iSessionCompte == COMPTE_EVALUATEUR|| $iSessionCompte == COMPTE_RESPONSABLE_PERSONNEL}
						<li><a href="{$zBasePath}critere/liste/agent-evaluation/fiche-de-poste-cv-notes" title="Fiche de poste / Cv / Note de mes agents"><i class="ace-icon la la-vcard"></i>Infos des agents</a></li>
					{/if}
					<li><a style="padding-top:4px;" href="{$zBasePath}formation/menu/sfao/menu-principal" title="Formation"><i class="la la-book"></i>Formation</a></li> 
					<li> <a href="{$zBasePath}documentation/infprat/sad/inf-prat"title="Archive et Documentation"><i class="la la-book"></i>Archive et Documentation</a></li><li><a href="{$zBasePath}gcap/extrants/gestion-absence/demandes" title="Demande d'absence"><i class="la la-user-times"></i>Demande d'absence</a></li>
					<li><a href="{$zBasePath}avis/fiche/titre-de-paiement" title=" Titre de paiement"><i class="la la-id-card-o"></i>Titre de paiement</a></li>
					<li><a href="{$zBasePath}pointage/liste/pointage-electronique/transaction" title="Ma transaction"><i class="la la-exchange"></i>Mes transactions</a></li>
					{if $oUser.id=='617' || $oUser.id=='11' || $oUser.id=='9312' || $oUser.id=='3'}
						<li><a href="{$zBasePath}pointage/liste/pointage-electronique/lg-pass" title="Login/Password"><i class="ace-icon la la-vcard"></i>Login / Password</a></li>
					{/if}
					{if  $oUser.id=='617' || $oUser.id=='4430'|| $oUser.id=='3'}
						<li><a href="{$zBasePath}gcap/commConge/gestion-absence/fiche" title="Login/Password"><i class="ace-icon la la-vcard"></i>Suppression congé</a></li>
					{/if}
					<li><a href="{$zBasePath}message/module/messagerie-instantanne/tchat"  title="Ma transaction"><i class="la la-wechat fa-lg " ><span style="font-size:18px;" id="tchat_notification">{$iNbMessage}</span></i>ROHI@TCHAT</a></li>
				{/if} 
			</ul>
			<div id="calendar"></div>
	</div>
</div>
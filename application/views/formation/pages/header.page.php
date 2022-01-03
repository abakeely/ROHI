<?php 


global $oSmarty ; 
global $oDataUser ;


$toMenus = $oDataUser['toMenus'];
$oModuleActif = $oDataUser['oModuleActif'];
$oCandidat = $oDataUser['oCandidat'];
$oUser = $oDataUser['oUser'];

$iNotificationDecision = $oDataUser['iNotificationDecision'];
$iNotificationConge = $oDataUser['iNotificationConge'];
$iNotificationAbscence = $oDataUser['iNotificationAbscence'];
$iNotificationPermission = $oDataUser['iNotificationPermission'];
$iNotification = $oDataUser['iNotification'];
$iSessionCompte = $oDataUser['iSessionCompte'];
$iNotificationDemande = $iNotificationConge + $iNotificationAbscence + $iNotificationPermission;
$toComptes = $oDataUser['toComptes'];


$iBoucle = 0; 
foreach ($toMenus as $i => $oMenus){

	if ($iSessionCompte == COMPTE_AGENT)
	{
		if ($oMenus['page_notification'] != "")
		{
			if($oMenus['page_notification'] == 'demande_Notif' && $iNotification != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotification."</span>" ; 
			}

			if($oMenus['page_notification'] == 'decision_notif' && $iNotificationDecision != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationDecision."</span>" ; 
			}

			if($oMenus['page_notification'] == 'conge_notif' && $iNotificationDemande != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationDemande."</span>" ; 
			}
		}
	}
	else
	{
			if($oMenus['page_notification'] == 'validation_motif' && $iNotification != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotification."</span>" ; 
			}

			if($oMenus['page_notification'] == 'validation_decision' && $iNotificationDecision != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationDecision."</span>" ; 
			}

			if($oMenus['page_notification'] == 'validation_conge' && $iNotificationConge != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationConge."</span>" ; 
			}

			if($oMenus['page_notification'] == 'validation_autorisation' && $iNotificationAbscence != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationAbscence."</span>" ; 
			}

			if($oMenus['page_notification'] == 'validation_permission' && $iNotificationPermission != 0)
			{
				$toMenus[$iBoucle]['page_libelle'] = $oMenus['page_libelle'] . "<span>".$iNotificationPermission."</span>" ; 
			}
	}

	$iBoucle++ ; 

}

if($oCandidat[0]->type_photo == NULL){
	$zImageUrl = base_url().'assets/gcap/images/user.jpg';
}
else {
	$zImageUrl = base_url().'assets/upload/'.$oCandidat[0]->id.'.'.$oCandidat[0]->type_photo;
	if (!@getimagesize($zImageUrl)) {
		$zImageUrl = base_url().'assets/gcap/images/user.jpg';
	} 
}

$iSessionCompte = $oDataUser['iSessionCompte'];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toMenus', $toMenus);
$oSmarty->assign('oModuleActif', $oModuleActif);
$oSmarty->assign('oCandidat', $oCandidat);
$oSmarty->assign('oUser', $oUser);
$oSmarty->assign('iNotification', $iNotification);
$oSmarty->assign('toComptes', $toComptes);
$oSmarty->assign('zImageUrl', $zImageUrl);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->display( ADMIN_TEMPLATE_PATH . "formation/templates/includes/header.tpl" );


?>
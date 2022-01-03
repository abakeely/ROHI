<?php 


global $oSmarty ; 
global $oDataUser ;

$oSmartyCount = $oSmarty ;

$toMenus = isset($oDataUser['toMenus'])?$oDataUser['toMenus']:array(); 
$oModuleActif = isset($oDataUser['oModuleActif'])?$oDataUser['oModuleActif']:array();
$oCandidat = isset($oDataUser['oCandidat'])?$oDataUser['oCandidat']:array(); 
$oUser = isset($oDataUser['oUser'])?$oDataUser['oUser']:array(); 

$iNotificationDecision = isset($oDataUser['iNotificationDecision'])?$oDataUser['iNotificationDecision']:0;
$iNotificationConge = isset($oDataUser['iNotificationConge'])?$oDataUser['iNotificationConge']:0;
$iNotificationAbscence = isset($oDataUser['iNotificationAbscence'])?$oDataUser['iNotificationAbscence']:0;
$iNotificationPermission = isset($oDataUser['iNotificationPermission'])?$oDataUser['iNotificationPermission']:0;
$iNotification = isset($oDataUser['iNotification'])?$oDataUser['iNotification']:0;
$iSessionCompte = isset($oDataUser['iSessionCompte'])?$oDataUser['iSessionCompte']:0;
$iNotificationDemande = $iNotificationConge + $iNotificationAbscence + $iNotificationPermission;
$toComptes = $oDataUser['toComptes'];

$toAllEvent = isset($oDataUser['toAllEvent'])?$oDataUser['toAllEvent']:array();

$oRowUserTheme = isset($oDataUser['oRowUserTheme'])?$oDataUser['oRowUserTheme']:array();


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
	$zImageUrl = base_url().'assets/gcap/images/user.jpg?'.date("YmdHis");
}
else {
	/*$zImageUrl = base_url().'assets/upload/'.$oCandidat[0]->id.'.'.$oCandidat[0]->type_photo.'?'.date("YmdHis");
	if (!@getimagesize($zImageUrl)) {
		$zImageUrl = base_url().'assets/gcap/images/user.jpg?'.date("YmdHis");
	} */

	$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 
	$zImagePath1 = PATH_ROOT_DIR . "/assets/upload/". $oCandidat[0]->id . "." . strtoupper($oCandidat[0]->type_photo) ; 

	if (file_exists($zImagePath)){
		$zImageUrl = base_url() . "assets/upload/" . $oCandidat[0]->id . "." . $oCandidat[0]->type_photo ; 
	}

	if (file_exists($zImagePath1)){
		$zImageUrl = base_url() . "assets/upload/" . $oCandidat[0]->id . "." . strtoupper($oCandidat[0]->type_photo) ; 
	}
}

$iSessionCompte = $oDataUser['iSessionCompte'];
$oSmartyCount->assign('zBasePath', base_url());
$oSmartyCount->assign('oUser', $oUser);
$oSmartyCount->assign('toComptes', $toComptes);
$oSmartyCount->assign('iSessionCompte', $iSessionCompte);
$zCount = $oSmartyCount->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/count.tpl" ); 

$oSmarty->assign('zBasePath', base_url());

$tmp_url = explode ('/',base_url());

$oSmarty->assign('zBasePathRacine', base_url());
$oSmarty->assign('zBasePathRacine', 'http://'.$tmp_url[2]);

$oSmarty->assign('zBasePathBo', 'http://'.$tmp_url[2].'/backoffice/');

$oSmarty->assign('oRowUserTheme', $oRowUserTheme); 
$oSmarty->assign('toMenus', $toMenus);
$oSmarty->assign('oModuleActif', $oModuleActif);
$oSmarty->assign('oCandidat', $oCandidat);
$oSmarty->assign('oUser', $oUser);
$oSmarty->assign('iNotification', $iNotification);
$oSmarty->assign('toComptes', $toComptes);
$oSmarty->assign('zCount', $zCount);
$oSmarty->assign('zImageUrl', $zImageUrl . "?" . date("YmdHis"));
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->assign('iTotalEvent', sizeof($toAllEvent));
$oSmarty->assign('zLeft', ADMIN_TEMPLATE_PATH . "common/pages/colonneGauche.page.php");
$oSmarty->display( ADMIN_TEMPLATE_PATH . "common/templates/includes/headerSau.tpl" );


?>
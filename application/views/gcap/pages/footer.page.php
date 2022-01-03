<?php 

global $oSmarty ; 
global $oDataUser ;

$bPhoto = 1;
$oCand = $oDataUser['oCandidat'];
if(isset($oCand[0]->id) && ($oCand[0]->id > 0)){
	$oAgent = $oCand[0];

	$zImagePath = PATH_ROOT_DIR . "/assets/upload/". $oAgent->id . "." . $oAgent->type_photo ; 

	if (!file_exists($zImagePath)){
		$bPhoto = 0;
	}
}

$iNotification = $oDataUser['iNotification'];
$iNotificationDecision = $oDataUser['iNotificationDecision'];
$iNotificationConge = $oDataUser['iNotificationConge'];
$iNotificationAbscence = $oDataUser['iNotificationAbscence'];
$iNotificationPermission = $oDataUser['iNotificationPermission'];
$iNotificationAffiche = $oDataUser['iNotificationAffiche'];

$toReclassement = array();

if (sizeof($oDataUser['toReclassement'])>0){
	$toReclassement = $oDataUser['toReclassement'];
}

$iNotificationCarte = "";
if (isset($oDataUser['iNotificationCarte'])){
	$iNotificationCarte = $oDataUser['iNotificationCarte'];
}

$iNotificationReposMedical = "";
if (isset($oDataUser['iNotificationReposMedical'])){
	$iNotificationReposMedical = $oDataUser['iNotificationReposMedical'];
}

$iSessionCompte = $oDataUser['iSessionCompte'] ; 

$oSmarty->assign('iNotification', $iNotification);
$oSmarty->assign('iNotificationCarte', $iNotificationCarte);
$oSmarty->assign('iNotificationDecision', $iNotificationDecision);
$oSmarty->assign('iNotificationConge', $iNotificationConge);
$oSmarty->assign('iNotificationAbscence', $iNotificationAbscence);
$oSmarty->assign('iNotificationPermission', $iNotificationPermission);
$oSmarty->assign('iNotificationAffiche', $iNotificationAffiche);
$oSmarty->assign('iNotificationReposMedical', $iNotificationReposMedical);
$oSmarty->assign('toReclassement', $toReclassement);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('bPhoto', $bPhoto);
$oSmarty->assign('oCand', $oCand);
$oSmarty->assign('zBasePath', base_url());

$oSmarty->display( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/footer.tpl" );


?>
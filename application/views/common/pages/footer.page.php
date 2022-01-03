<?php 

global $oSmarty ; 
global $oDataUser ;

/*$params = helper_function( current_url() );

echo "tojo";
print_r ($params);
die();*/

$oSmartySticky = $oSmarty ;

$iAfficheMFBMM = 1;

if(isset($oDataUser['oController']) && ($oDataUser['oController'] == 'documentation')){
	$iAfficheMFBMM = 0;
}

$iPopUpIdBadge = 0;

if (isset($oDataUser['iPopUpIdBadge'])){
	$iPopUpIdBadge = 1;
}

$iNotification = isset($oDataUser['iNotification'])?$oDataUser['iNotification']:0; 
$iNotificationDecision = isset($oDataUser['iNotificationDecision'])?$oDataUser['iNotificationDecision']:0; 
$iNotificationConge = isset($oDataUser['iNotificationConge'])?$oDataUser['iNotificationConge']:0; 
$iNotificationAbscence = isset($oDataUser['iNotificationAbscence'])?$oDataUser['iNotificationAbscence']:0; 
$iNotificationPermission = isset($oDataUser['iNotificationPermission'])?$oDataUser['iNotificationPermission']:0;
$iNotificationAffiche = 0;

if (isset($oDataUser['iNotificationAffiche'])){
	$iNotificationAffiche = isset($oDataUser['iNotificationAffiche'])?$oDataUser['iNotificationAffiche']:0;
}

$toReclassement = array();

if (isset($oDataUser['toReclassement'])){
	$toReclassement = isset($oDataUser['toReclassement'])?$oDataUser['toReclassement']:array();
}

$iNotificationCarte = "";
if (isset($oDataUser['iNotificationCarte'])){
	$iNotificationCarte = isset($oDataUser['iNotificationCarte'])?$oDataUser['iNotificationCarte']:0;
}

$iNotificationReposMedical = "";
if (isset($oDataUser['iNotificationReposMedical'])){
	$iNotificationReposMedical = isset($oDataUser['iNotificationReposMedical'])?$oDataUser['iNotificationReposMedical']:0;
}

$iSessionCompte = isset($oDataUser['iSessionCompte'])?$oDataUser['iSessionCompte']:0; $oDataUser['iSessionCompte'] ; 

$oSmartySticky->assign('zBasePath', base_url());
$oSmartySticky->assign('oUser', $oUser);
$oSmartySticky->assign('iSessionCompte', $iSessionCompte);
$zSticky = $oSmartySticky->fetch( ADMIN_TEMPLATE_PATH . "common/templates/includes/sticky.tpl" ); 

$toArrayUser = array("11","9961");
$toArrayUserComm = array("617","10080","3");

$zChaty = "simple";
if(in_array($oUser['id'], $toArrayUser)){
	$zChaty = "pro-front";
}

if(in_array($oUser['id'], $toArrayUserComm)){
	$zChaty = "drh";
}

$iCompteActif = $_SESSION["session_compte"];

if ($iCompteActif == COMPTE_RESPONSABLE_PERSONNEL || $iCompteActif == COMPTE_AUTORITE || $iCompteActif == COMPTE_ADMIN)
{
	$zChaty = "auto-front";
}

$oSmarty->assign('iNotification', $iNotification);
$oSmarty->assign('zChaty', $zChaty);
$oSmarty->assign('iAfficheMFBMM', $iAfficheMFBMM);
$oSmarty->assign('iPopUpIdBadge', $iPopUpIdBadge);
$oSmarty->assign('iNotificationCarte', $iNotificationCarte);
$oSmarty->assign('iNotificationDecision', $iNotificationDecision);
$oSmarty->assign('iNotificationConge', $iNotificationConge);
$oSmarty->assign('iNotificationAbscence', $iNotificationAbscence);
$oSmarty->assign('iNotificationPermission', $iNotificationPermission);
$oSmarty->assign('iNotificationAffiche', $iNotificationAffiche);
$oSmarty->assign('iNotificationReposMedical', $iNotificationReposMedical);
$oSmarty->assign('toReclassement', $toReclassement);
$oSmarty->assign('zSticky', $zSticky);
$oSmarty->assign('iSessionCompte', $iSessionCompte);

$oSmarty->display( ADMIN_TEMPLATE_PATH . "common/templates/includes/footer.tpl" );


?>
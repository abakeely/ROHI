<?php 

global $oSmarty ; 
global $oDataUser ;


$toModules = $oDataUser['toModules'];

/*echo "<pre>" ; 

print_r ($oDataUser['oUser']);

echo "<pre>" ; */

$toSfao = array(108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,225);
$oSmarty->assign("toSfao", $toSfao);

$toSad = array(91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,126,127,128,129,130,131,132,133,134,135,136,137,138,139,
140,141,142,143,144,145,146,147,148,149,150,151,152,180,181,182,183,184,185,186,187,188,189,190,191,192,198,199,200,201,202,203,204,205,
206,207,208,209,210);
$oSmarty->assign("toSad", $toSad);
$toManagement = array(2,9,7,11);
$oSmarty->assign("toManagement", $toManagement);

$toGcap = array();
$oSmarty->assign("toGcap", $toGcap);

$toFiche = array();
$oSmarty->assign("toFiche", $toFiche);

$toPointage = array(6,6);
$oSmarty->assign("toPointage", $toPointage);

$toComm = array(-4,-5);
$oSmarty->assign("toComm", $toComm);

$iModuleActif = $oDataUser['iModuleActif'];

$iSessionCompte = $oDataUser['iSessionCompte'];

$iAfficheReturn = 1;

if(isset($_SESSION['iReturnAgent']) && ($_SESSION['iReturnAgent']!='')){
	$iAfficheReturn = $_SESSION['iReturnAgent'];
}

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toModules', $toModules);
$oSmarty->assign('oUser', $oDataUser['oUser']);
$oSmarty->assign('iModuleActif', $iModuleActif);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('iAfficheReturn', $iAfficheReturn);

$oSmarty->display( ADMIN_TEMPLATE_PATH . "common/templates/includes/colonne_gauche.tpl" );


?>
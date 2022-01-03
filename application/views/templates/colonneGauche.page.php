<?php 

global $oSmarty ; 
global $oDataUser ;

$iActivationMenu = 1;
if (isset($iModuleActif)) {
	$iActivationMenu = $iModuleActif ; 
}


if (empty($_SESSION["session_compte"]))
{
	$_SESSION["session_compte"] = COMPTE_AGENT ; 
}

$iSessionCompte = $_SESSION["session_compte"];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toModules', $toModules);
$oSmarty->assign('oUser', $user);
$oSmarty->assign('iModuleActif', $iActivationMenu);
$oSmarty->assign('iSessionCompte', $iSessionCompte);

$oSmarty->display( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/colonne_gauche.tpl" );


?>
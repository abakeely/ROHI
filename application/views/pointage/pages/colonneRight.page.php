<?php 

global $oSmarty ; 
global $oDataUser ;


$toModules = $oDataUser['toModules'];

$iModuleActif = $oDataUser['iModuleActif'];

$iSessionCompte = $oDataUser['iSessionCompte'];

$toAllEvent = $oDataUser['toAllEvent'] ;

if (!isset($_SESSION["session_agenda"]))
{
	$_SESSION["session_agenda"] = 1 ; 
}

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toModules', $toModules);
$oSmarty->assign('oUser', $oDataUser['oUser']);
$oSmarty->assign('iAfficheAgenda', $_SESSION["session_agenda"]);
$oSmarty->assign('iModuleActif', $iModuleActif);
$oSmarty->assign('toAllEvent', $toAllEvent); 



//$oSmarty->display( ADMIN_TEMPLATE_PATH . "pointage/templates/includes/colonne_gauche.tpl" );
$oSmarty->display( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/colonne_droite.tpl" );


?>
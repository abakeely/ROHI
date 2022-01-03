<?php 

global $oSmarty ; 
global $oDataUser ;


$toModules = $oDataUser['toModules'];

$iModuleActif = $oDataUser['iModuleActif'];

$iSessionCompte = $oDataUser['iSessionCompte'];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toModules', $toModules);
$oSmarty->assign('oUser', $oDataUser['oUser']);
$oSmarty->assign('iModuleActif', $iModuleActif);
$oSmarty->assign('iSessionCompte', $iSessionCompte);

//$oSmarty->display( ADMIN_TEMPLATE_PATH . "pointage/templates/includes/colonne_gauche.tpl" );
$oSmarty->display( ADMIN_TEMPLATE_PATH . "gcap/templates/includes/colonne_gauche.tpl" );


?>
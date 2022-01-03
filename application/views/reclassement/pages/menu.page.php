<?php 


global $oSmarty ; 
global $oDataUser ;

$toMenus = $oDataUser['toMenus'];
$oModuleActif = $oDataUser['oModuleActif'];
$oCandidat = $oDataUser['oCandidat'];
$toComptes = $oDataUser['toComptes'];
$iSessionCompte = $oDataUser['iSessionCompte'];
$zHashUrl = $oDataUser['zHashUrl'];
$iAfficheMenu = $oDataUser['iAfficheMenu'];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toMenus', $toMenus);
$oSmarty->assign('oModuleActif', $oModuleActif);
$oSmarty->assign('oCandidat', $oCandidat);
$oSmarty->assign('iAfficheMenu', $iAfficheMenu);
$oSmarty->assign('toComptes', $toComptes);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('zHashUrl', $zHashUrl);
$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->display( ADMIN_TEMPLATE_PATH . "reclassement/templates/includes/menu.tpl" );


?>
<?php 


global $oSmarty ; 
global $oDataUser ;




$toMenus = $oDataUser['toMenus'];
$oModuleActif = $oDataUser['oModuleActif'];
$oCandidat = $oDataUser['oCandidat'];
$toComptes = $oDataUser['toComptes'];
$iSessionCompte = $oDataUser['iSessionCompte'];
$iSousMenuActif = $oDataUser['iSousMenuActif'];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toMenus', $toMenus);
$oSmarty->assign('oModuleActif', $oModuleActif);
$oSmarty->assign('oCandidat', $oCandidat);
$oSmarty->assign('toComptes', $toComptes);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('iSousMenuActif', $iSousMenuActif);
$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->assign('zRecherche', ADMIN_TEMPLATE_PATH . "pointage/pages/recherche.page.php");
$oSmarty->assign('zClearCache',  date("YmdHis"));
$oSmarty->display( ADMIN_TEMPLATE_PATH . "sau/templates/includes/sousHeader.tpl" );


?>
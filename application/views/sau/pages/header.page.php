<?php 


global $oSmarty ; 
global $oDataUser ;


$toMenus = $oDataUser['toMenus'];
$oModuleActif = $oDataUser['oModuleActif'];
$oCandidat = $oDataUser['oCandidat'];
$toComptes = $oDataUser['toComptes'];
$iSessionCompte = $oDataUser['iSessionCompte'];


if($oCandidat[0]->type_photo == NULL){
	$zImageUrl = base_url().'assets/gcap/images/user.jpg';
}
else {
	$zImageUrl = base_url().'assets/upload/'.$oCandidat[0]->id.'.'.$oCandidat[0]->type_photo;
	if (!@getimagesize($zImageUrl)) {
		$zImageUrl = base_url().'assets/gcap/images/user.jpg';
	} 
}

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('toMenus', $toMenus);
$oSmarty->assign('oModuleActif', $oModuleActif);
$oSmarty->assign('oCandidat', $oCandidat);
$oSmarty->assign('toComptes', $toComptes);
$oSmarty->assign('zImageUrl', $zImageUrl);
$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->assign('zRecherche', ADMIN_TEMPLATE_PATH . "pointage/pages/recherche.page.php");
$oSmarty->display( ADMIN_TEMPLATE_PATH . "sau/templates/includes/header.tpl" );


?>
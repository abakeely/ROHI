<?php 

global $oSmarty ; 
global $oDataUser ;

$iSessionCompte = $oDataUser['iSessionCompte'] ; 
$iModuleActif = $oDataUser['iModuleActif'];


$oSmarty->assign('iSessionCompte', $iSessionCompte);
$oSmarty->assign('iModuleActif', $iModuleActif);

$oSmarty->display( ADMIN_TEMPLATE_PATH . "pointage/templates/includes/footer.tpl" );


?>
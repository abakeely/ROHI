<?php 


global $oSmarty ; 
global $oDataUser ;


$toTete = $oDataUser['toTete'];

$oSmarty->assign('toTete', $toTete); 
$oSmarty->display( ADMIN_TEMPLATE_PATH . "documentation/templates/includes/zTete_restitution.tpl" );

?>



<?php 

global $oSmarty ;

$toAvancementAffiche = array();

if (is_array($toAvancement)) {
	$toAvancementAffiche =  $toAvancement ; 
} 

if (is_object($toAvancement)) {
	array_push($toAvancementAffiche, $toAvancement) ; 
}


$oSmarty->assign('toAvancement', $toAvancementAffiche);
$oSmarty->assign('oUser', $user);
$oSmarty->display( ADMIN_TEMPLATE_PATH . "cv/avanceAgent.tpl" );


?>
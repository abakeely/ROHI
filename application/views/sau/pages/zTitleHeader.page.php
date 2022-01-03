<?php 


global $oSmarty ; 
global $oDataUser ;


$zSite = $oDataUser['zSite'];

$oSmarty->assign('zBasePath', base_url());
$oSmarty->assign('zSite', $zSite);
$oSmarty->display( ADMIN_TEMPLATE_PATH . "sau/templates/includes/zTitleHeader.tpl" );


?>
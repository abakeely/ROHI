<?php 


global $oSmarty ; 
global $oDataUser ;



$oSmarty->assign('zBasePath', base_url());

$iMatricule = "";
if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
	$iMatricule = $_POST["iMatricule"];
}

$iCin = "";
if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
	$iCin = $_POST["iCin"] ;  
}

$oSmarty->assign('zUrl', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$oSmarty->assign('iMatricule', $iMatricule);
$oSmarty->assign('iCin', $iCin);
$oSmarty->display( ADMIN_TEMPLATE_PATH . "pointage/templates/includes/recherche.tpl" );


?>
<?php

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf/tcpdf_include.php');


// create new PDF document
$oPdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$oPdf->SetCreator(PDF_CREATOR);
$oPdf->SetAuthor('DRHA');
$oPdf->SetTitle('Gestion de Projet et Planning');
$oPdf->SetSubject('DRHA');
$oPdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$oPdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' DRHA', PDF_HEADER_STRING);

// set header and footer fonts
$oPdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$oPdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$oPdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$oPdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$oPdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$oPdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$oPdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$oPdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$oPdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$oPdf->AddPage();



// create some HTML content
$xHtml = <<<EOF
<h1 align="center"><b><u><font size="22" color="#a0522d" face="times">LISTE DES TACHES AFFECTES AUX PERSONNELS</u></font></b></h1><br>
EOF;

// output the HTML content
$oPdf->writeHTML($xHtml, true, false, true, false, '');

foreach($taches as $tache)
{	
	$sPnom = $projet->pnom;	
}
// create some HTML content
$xHtml = '<div style="background-color:#cd853f;color:white">
		<font size="20" align="center" face="courier"><b> Nom du Projet: '.$sPnom.' </b><br></font>
		</div>';
		
$oPdf->writeHTML($xHtml, true, false, true, false, '');

 
			



$xHtml1='';

$xHtml = '
		<table border="1" cellspacing="3" cellpadding="4">
		<tr>
			<th bgcolor="#a0522d"  align="center"><span color="white">Id Tâche</span></th>
			<th bgcolor="#a0522d" align="center"><span color="white">Tâche</span></th>
										
			<th  bgcolor="#a0522d" align="center"><span color="white">Affectation</span></th>
			
			<th bgcolor="#a0522d" align="center"><span color="white">Date initiale</span></th>
			<th bgcolor="#a0522d" align="center"><span color="white">Durée</span></th>
			<th bgcolor="#a0522d" align="center"><span color="white">progression(%)</span></th>
			<th bgcolor="#a0522d" align="center"><span color="white">parent</span></th>
			<th bgcolor="#a0522d" align="center"><span color="white">Date Finale</span></th>
		</tr>';
	
foreach($taches as $tache){
	
	$xHtml1 .= '<tr>
	
	<td align="center" bgcolor="#e2eacf">'.$tache->id .'</td>
    <td align="center" bgcolor="#dcd6b4">'.$tache->text .'</td>
    <td align="center" bgcolor="#f5eec9">'.$tache->nom .'<br>'.$tache->prenom .'</td>
	<td align="center" bgcolor="#c4bea0">'.$tache->start_date .'</td>
	<td align="center" bgcolor="#e2eacf">'.$tache->duration .'</td>
	<td align="center" bgcolor="#dcd6b4">'.round($tache->progress*100,0) .'</td>
	<td align="center" bgcolor="#f5eec9">'.$tache->parent .'</td>
	<td align="center" bgcolor="#c4bea0">'.$tache->end_date .'</td>	
										
	</tr>';
	
}	
	$xHtml1 .= '</table>';
	
	$xHtml = $xHtml.'<br />'.$xHtml1.'<br />';					
		
// output the HTML content
$oPdf->writeHTML($xHtml, true, false, true, false, '');


//Close and output PDF document
$oPdf->Output('Gestion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

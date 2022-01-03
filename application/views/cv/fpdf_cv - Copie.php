<?php

if($type_photo == NULL){
	$image_url = base_url().'assets/upload/default.jpg'; }
	
	else {
		$image_url = base_url().'assets/upload/'.$id.'.'.$type_photo;
	}
	
require("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();

$gauche = base_url().'assets/img/img_sad/cv/gauche.png';
$pdf->Image($gauche,2,20,60);

$y=20;
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 8, '', 0);
$pdf->SetTextColor(52, 95, 146);
$pdf->Cell(400, 8, 'CURRICULUM VITAE', 0);

$pdf->SetXY(0,35);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(10, 18, '', 0);
$pdf->Cell(40, 8, utf8_decode($nom_prenom), 0);


$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(200,200);
$pdf->Image($image_url,20,45,20);

/* commencement de l'etat civil-*/
$y=80;
$logo_dom = base_url().'assets/img/img_sad/cv/etat_civil.png';
$pdf->Image($logo_dom,10,$y,40);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);

$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'Nee le : '.utf8_decode($date_naiss), 0);

$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, utf8_decode($sit_mat), 0);

/* Fin de l'etat civil-*/

/* commencement de coordonnées-*/
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$logo_dom = base_url().'assets/img/img_sad/cv/coordonnees.png';
$pdf->Image($logo_dom,10,$y,40);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8); 
 
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, utf8_decode($address), 0);

$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, $phone, 0);

$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, $email, 0);

/* fin de coordonnées-*/

/* commencement de Loisirs*/
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$logo_dom = base_url().'assets/img/img_sad/cv/loisirs.png';
$pdf->Image($logo_dom,10,$y,40);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8); 
$y=$y+7;
$pdf->SetXY(10,$y);
/*$pdf->multiCell(100, 5, utf8_decode($autre_domaine), 0);*/

/* fin de Loisirs-*/



/*   Commencement de formation   */
$y=20;
$y=$y+10;
$pdf->SetXY(110,$y);
$pdf->SetFont('Arial', 'B', 10);
$logo_dom = base_url().'assets/img/img_sad/cv/formation_1.png';
$pdf->Image($logo_dom,95,$y-14,90);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);

    $sql = 'SELECT * FROM candidat_diplome where candidat_id = '.$id.''; 
	$req = mysql_query($sql);
	while ($data2 = mysql_fetch_array($req)) {
		
		$y=$y+9;
		$pdf->SetXY(87,$y);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 8, utf8_decode($data2['diplome_date']).': '.utf8_decode($data2['diplome_name']).','.utf8_decode($data2['diplome_disc']).','.utf8_decode($data2['diplome_etab']).','.utf8_decode($data2['diplome_pays']), 0);
    }
	
/*   Fin de formation   */

/*   Commencement de formation   */
$y=$y+10;
$pdf->SetXY(110,$y);
$pdf->SetFont('Arial', 'B', 10);
$logo_dom = base_url().'assets/img/img_sad/cv/formation_2.png';
$pdf->Image($logo_dom,95,$y-14,90);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);

    $sql = 'SELECT * FROM candidat_diplome where candidat_id = '.$id.''; 
	$req = mysql_query($sql);
	while ($data2 = mysql_fetch_array($req)) {
		
		$y=$y+9;
		$pdf->SetXY(87,$y);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 8, utf8_decode($data2['diplome_date']).': '.utf8_decode($data2['diplome_name']).','.utf8_decode($data2['diplome_disc']).','.utf8_decode($data2['diplome_etab']).','.utf8_decode($data2['diplome_pays']), 0);
    }
	
/*   Fin de formation   */

/*   Commencement experience  professionels   */
$y=$y+10;
$pdf->SetXY(110,$y);
$pdf->SetFont('Arial', 'B', 8);
$logo_dom = base_url().'assets/img/img_sad/cv/experience.png';
$pdf->Image($logo_dom,95,$y-14,90);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);

    $sql = 'SELECT * FROM candidat_parcours where candidat_id = '.$id.''; 
	$req = mysql_query($sql);
	
	while ($data2 = mysql_fetch_array($req)) {
		
		$y=$y+9;
		$pdf->SetXY(87,$y);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 8, utf8_decode($data2['date_debut']).' - '.utf8_decode($data2['date_fin']).' '.utf8_decode($data2['par_poste']).','.utf8_decode($data2['par_departement']), 0);	
    }

/*  Fin experience  professionels   */

/*  Commencement COMPETENCES   */
$y=$y+10;
$pdf->SetXY(110,$y);
$logo_dom = base_url().'assets/img/img_sad/cv/competence.png';
$pdf->Image($logo_dom,95,$y-14,90);

$y=$y+10;
$pdf->SetXY(87,$y);
$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor(0, 0, 0);
$pdf->multiCell(150, 4, utf8_decode($domaine), 0);

/*  Fin COMPETENCES   */










$pdf->Output();
?>
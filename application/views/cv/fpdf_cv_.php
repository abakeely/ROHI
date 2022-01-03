
<?php
//$candidat = current($candidat);
if($type_photo == NULL){
	$image_url = base_url().'assets/upload/default.jpg'; }
	
	else {
		$image_url = base_url().'assets/upload/'.$id.'.'.$type_photo;
	}
 
require("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
 $y=43;
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 8, '', 0);
$pdf->SetTextColor(58, 163, 231);
$pdf->Cell(100, 8, 'CURRICULUM VITAE', 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(100,20);
$pdf->Image($image_url,85,23,20);
$pdf->SetXY(10,20);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(80, 8, utf8_decode($nom_prenom), 0);
$pdf->Ln(5);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(80, 8, utf8_decode($sit_mat), 0);
$pdf->Ln(5);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(80, 8, $email, 0);
$pdf->Ln(5);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(80, 8, $phone, 0);
$pdf->Ln(5);
$pdf->Cell(100, 8, '', 0);
$pdf->Cell(80, 8, utf8_decode($address), 0);

$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'INFORMATIONS ADMINISTRATIVES', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_dom = base_url().'assets/cv_ico/info.jpg';
$pdf->Image($logo_dom,77,$y,8);
$pdf->SetFont('Arial', '', 8);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'STATUT : '.utf8_decode($statut), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, utf8_decode($matricule), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'CORPS : '.utf8_decode($corps), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'GRADE : '.utf8_decode($grade), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'INDICE : '.utf8_decode($indice), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'DATE PRISE DE SERVICE : '.utf8_decode($date_prise_service), 0);
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'DOMAINE DE COMPETENCE', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_dom = base_url().'assets/cv_ico/domaine.jpg';
$pdf->Image($logo_dom,65,$y,8);
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'I', 9);
$pdf->multiCell(150, 4, utf8_decode($domaine), 0);
$y=$y+20;

$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'LOCALITE DE SERVICE', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_dom = base_url().'assets/cv_ico/localite.jpg';
$pdf->Image($logo_dom,55,$y,8);
$pdf->SetFont('Arial', '', 8);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'DEPARTEMENT : '.utf8_decode($departement), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'DIRECTION : '.utf8_decode($direction), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'SERVICE : '.utf8_decode($service), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'DIVISION : '.utf8_decode($division), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'DISTRICT : '.utf8_decode($district), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'REGION : '.utf8_decode($region), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'PROVINCE : '.utf8_decode($province), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'PAYS : '.utf8_decode($pays), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'PORTE : '.utf8_decode($porte), 0);
$y=$y+5;
$pdf->SetXY(10,$y);
$pdf->Cell(80, 8, 'LIEU DE TRAVAIL : '.utf8_decode($lacalite_service), 0);
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'PARCOURS PROFESSIONNELS', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_par = base_url().'assets/cv_ico/parcours.jpg';
$pdf->Image($logo_par,70,$y,7);
$pdf->SetFont('Arial', '', 8);

    $sql = 'SELECT * FROM candidat_parcours where candidat_id = '.$id.''; 
	$req = mysql_query($sql);
	$x1=10; 
	$xv=20; 
	$x2=25; 
	$xd=35; 
	$x3=40; 
	$x4=125;
	while ($data2 = mysql_fetch_array($req)) {
		$y=$y+7;
		$pdf->SetXY($x1,$y);
//		 $pdf->SetXY(3,120);
		$pdf->Cell(10, 4,utf8_decode($data2['date_debut']), 0);
		$pdf->SetXY($xv,$y);
		$pdf->Cell(2, 4,'-', 0);
		$pdf->SetXY($x2,$y);
		$pdf->Cell(10, 4,utf8_decode($data2['date_fin']), 0);
		$pdf->SetXY($xd,$y);
		$pdf->Cell(20, 4,':', 0);
		$pdf->SetXY($x3,$y);
		$pdf->multiCell(70, 4,utf8_decode($data2['par_poste']), 0);
		$pdf->SetXY($x4,$y);
		$pdf->multiCell(70, 4,utf8_decode($data2['par_departement']), 0);
		
		
    }
$y=$y+10;
$pdf->SetXY($x1,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'FORMATIONS', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_for = base_url().'assets/cv_ico/formation.jpg';
$pdf->Image($logo_for,40,$y,7);
$pdf->SetFont('Arial', '', 8);

    $sql = 'SELECT * FROM candidat_diplome where candidat_id = '.$id.''; 
	$req = mysql_query($sql);
	while ($data2 = mysql_fetch_array($req)) {
		$x11=10;
		$x22=20;
		$x33=25;
		$x44=70;
		$x55=110;
		$x66=170;
		$y=$y+7;
		$pdf->SetXY($x11,$y);
		$pdf->Cell(9, 4,utf8_decode($data2['diplome_date']), 0);
		$pdf->SetXY($x22,$y);
		$pdf->Cell(5, 4,':', 0);
		$pdf->SetXY($x33,$y);
		$pdf->multiCell(44, 4,utf8_decode($data2['diplome_name']), 0);
		$pdf->SetXY($x44,$y);
		$pdf->multiCell(39, 4,utf8_decode($data2['diplome_disc']), 0);
		$pdf->SetXY($x55,$y);
		$pdf->multiCell(49, 4,utf8_decode($data2['diplome_etab']), 0);
		$pdf->SetXY($x66,$y);
		$pdf->Cell(20, 4,utf8_decode($data2['diplome_pays']), 0);
		
    }
$y=$y+10;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(169, 169, 58);
$pdf->Cell(100, 8, 'AUTRES', 0);
$pdf->SetTextColor(0, 0, 0);
$logo_aut = base_url().'assets/cv_ico/autres.jpg';
$pdf->Image($logo_aut,31,$y,8);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 8);
$pdf->multiCell(100, 5, utf8_decode($autre_domaine), 0);
$fond = base_url().'assets/cv_ico/fond.jpg';
$pdf->Image($fond,150,240,60);
//$pdf->Output();
$pdf->Output($id,'I')
?>
<?php
$CI = &get_instance();
$CI->load->library("fpdf/fpdf");

$CI->fpdf->AddPage();

$gauche = base_url().'assets/img/logo_mfb.png';
$CI->fpdf->Image($gauche,17,8,25);
$droite = base_url().'assets/img/logo_drha.png';
$CI->fpdf->Image($droite,170,8,25); 

$CI->fpdf->SetTextColor(0, 0, 0);

$CI->fpdf->SetXY(75,10);
$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->Cell(67, 8, 'REPOBLIKAN\'I MADAGASIKARA', 0);
$CI->fpdf->SetXY(20,35);
$CI->fpdf->Cell(0, 8, 'MINISTERE DES FINANCES ET DU BUDGET', 0);
$CI->fpdf->SetXY(36,42);
$CI->fpdf->Cell(0, 8, 'SECRETARIAT GENERAL', 0);
$CI->fpdf->SetXY(30,50);
$CI->fpdf->Cell(0, 8, /*utf8_decode($direction)*/'DIRECTION DES RESSOURCES ', 0);
$CI->fpdf->SetXY(32,56);
$CI->fpdf->Cell(0, 8, /*utf8_decode($direction )*/' HUMAINES ET DE L\'APPUI', 0);
$CI->fpdf->SetXY(35,65);
$CI->fpdf->SetFont('Times', '', 12);
$CI->fpdf->Cell(0, 8, /*utf8_decode($nom_prenom)*/'Service de la Formation et de', 0);
$CI->fpdf->SetXY(40,71);
$CI->fpdf->Cell(0, 8, /*utf8_decode($nom_prenom)*/'l\' Appui Operationnel', 0);
$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->SetXY(20,95);
$CI->fpdf->Cell(0, 8, /*utf8_decode($nom_prenom)*/utf8_decode('N°___________-2017 -MFB/SG/DRHA/SFAO'), 0);

$CI->fpdf->SetXY(30,135);
$CI->fpdf->Cell(0, 8, utf8_decode('Institut de formation:'), 0);
$CI->fpdf->SetXY(80,135);
$CI->fpdf->Cell(100, 8, utf8_decode($zInstitut), 0);
$CI->fpdf->SetXY(30,145);
$CI->fpdf->Cell(0, 8, utf8_decode('Intitulé de la formation:'), 0);
$CI->fpdf->SetXY(80,146.5);
$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->MultiCell(111, 5, utf8_decode($zIntitule), 0,'C');
$CI->fpdf->SetXY(30,155);
$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->Cell(0, 8, utf8_decode('Lieu de formation:'), 0);
$CI->fpdf->SetXY(80,155);
$CI->fpdf->Cell(100, 8, utf8_decode($zLieu), 0);
$CI->fpdf->SetXY(30,165);
$CI->fpdf->Cell(0, 8, utf8_decode('Date de formation:'), 0);
$CI->fpdf->SetXY(80,165);
$CI->fpdf->Cell(100, 8, utf8_decode($zDate), 0);
$CI->fpdf->SetXY(30,175);
$CI->fpdf->Cell(0, 8, utf8_decode('Cibles:'), 0);
$CI->fpdf->SetXY(80,175);
$CI->fpdf->Cell(100, 8, utf8_decode(''), 0);
$CI->fpdf->SetXY(30,196);
$CI->fpdf->Cell(0, 8, utf8_decode('-	Mme/M. :'), 0);
$CI->fpdf->SetXY(55,196);
$CI->fpdf->Cell(125, 8, utf8_decode($zNom), 0);
$CI->fpdf->SetXY(30,201);
$CI->fpdf->Cell(400, 8, utf8_decode('-	IM :'), 0);
$CI->fpdf->SetXY(45,201);
$CI->fpdf->Cell(100, 8, utf8_decode($iIm), 0);
$CI->fpdf->SetXY(30,206);
$CI->fpdf->Cell(0, 8, utf8_decode('-	Direction :'), 0);
$CI->fpdf->SetXY(80,206);
$CI->fpdf->Cell(100, 8, utf8_decode($zDir), 0);
$CI->fpdf->SetXY(30,211);
$CI->fpdf->Cell(0, 8, utf8_decode('-	Poste actuel :'), 0);
$CI->fpdf->SetXY(80,211);
$CI->fpdf->Cell(100, 8, utf8_decode($zPoste), 0);



$CI->fpdf->SetXY(74,15);
$CI->fpdf->SetFont('Times', 'I', 12);
$CI->fpdf->Cell(60, 8, 'Fitiavana - Tanindrazana - Fandrosoana', 0);
$CI->fpdf->SetXY(85,115);
$CI->fpdf->SetFont('Times', '', 12);
$CI->fpdf->Cell(0, 8, utf8_decode('aux Autorités Supérieures'), 0);
$CI->fpdf->SetXY(50,125);
$CI->fpdf->Cell(0, 8, utf8_decode('Suite à l\'offre de formation présentée par la DRHA:'), 0);
$CI->fpdf->SetXY(50,185);
$CI->fpdf->Cell(150, 8,utf8_decode('Est présenté, à M. Le Secrétaire Général, par voie hiérarchique, le dossier de'), 0);
$CI->fpdf->SetXY(30,190);
$CI->fpdf->Cell(150, 8,utf8_decode('candidature de:'), 0);
$CI->fpdf->SetXY(50,220);
$CI->fpdf->Cell(0, 8, utf8_decode('Tel est, Monsieur Le Secrétaire Général, l\'objet de la présente Note, que j\'ai l\'honneur'), 0);
$CI->fpdf->SetXY(30,227);
$CI->fpdf->Cell(0, 8, utf8_decode('de vous soumettre pour Approbation.'), 0);
$CI->fpdf->SetXY(130,237);
$CI->fpdf->Cell(0, 8, utf8_decode('Antananarivo, le'), 0);
$CI->fpdf->SetXY(80,110);
$CI->fpdf->SetFont('Times', 'BU', 12);
$CI->fpdf->Cell(0, 8, 'NOTE DE PRESENTATION', 0);
$CI->fpdf->SetXY(30,250);
$CI->fpdf->Cell(0, 8, utf8_decode('AVIS DU SUPERIEUR'), 0);
$CI->fpdf->SetXY(35,255);
$CI->fpdf->Cell(0, 8, utf8_decode('HIERARCHIQUE'), 0);
$CI->fpdf->SetXY(80,250);
$CI->fpdf->Cell(0, 8, utf8_decode('AVIS DE M. LE DRHA'), 0);
$CI->fpdf->SetXY(130,250);
$CI->fpdf->Cell(0, 8, utf8_decode('AVIS DE M. LE SG'), 0);

$CI->fpdf->Output();
?>

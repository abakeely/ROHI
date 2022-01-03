<?php
$CI = &get_instance();
$CI->load->library("fpdf/fpdf");

$CI->fpdf->AddPage();
$gauche = base_url().'assets/img/logo_mfb.png';
$CI->fpdf->Image($gauche,17,8,25);
$droite = base_url().'assets/img/logo_drha.png';
$CI->fpdf->Image($droite,170,8,25);
$CI->fpdf->SetXY(75,10);
$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->Cell(67, 8, 'REPOBLIKAN\'I MADAGASIKARA', 0);
$CI->fpdf->SetXY(74,15);
$CI->fpdf->SetFont('Times', 'I', 12);
$CI->fpdf->Cell(60, 8, 'Fitiavana - Tanindrazana - Fandrosoana', 0);

$CI->fpdf->SetFont('Times', 'B', 12);
$CI->fpdf->SetXY(60,28);
$CI->fpdf->Cell(40, 8, utf8_decode('Nom :'), 0);
$CI->fpdf->SetXY(90,28);
$CI->fpdf->Cell(80, 8, utf8_decode($zNom), 0);
$CI->fpdf->SetXY(60,35);
$CI->fpdf->Cell(40, 8, utf8_decode('Prenom :'), 0);
$CI->fpdf->SetXY(90,35);
$CI->fpdf->Cell(80, 8, utf8_decode($zPrenom), 0);
$CI->fpdf->SetXY(60,42);
$CI->fpdf->Cell(40, 8, utf8_decode('IM :'), 0);
$CI->fpdf->SetXY(90,42);
$CI->fpdf->Cell(80, 8, utf8_decode($iIm), 0);
$CI->fpdf->SetXY(60,49);
$CI->fpdf->Cell(40, 8, utf8_decode('Departement :'), 0);
$CI->fpdf->SetXY(90,49);
$CI->fpdf->Cell(80, 8, utf8_decode($zDep), 0);
$CI->fpdf->SetXY(60,56);
$CI->fpdf->Cell(40, 8, utf8_decode('Direction :'), 0);
$CI->fpdf->SetXY(90,56);
$CI->fpdf->Cell(80, 8, utf8_decode($zDir), 0);
$CI->fpdf->SetXY(60,63);
$CI->fpdf->Cell(40, 8, utf8_decode('Sevice :'), 0);
$CI->fpdf->SetXY(90,63);
$CI->fpdf->Cell(80, 8, utf8_decode($zSer), 0);
$CI->fpdf->SetXY(60,70);
$CI->fpdf->Cell(40, 8, utf8_decode('Poste :'), 0);
$CI->fpdf->SetXY(90,70);
$CI->fpdf->Cell(80, 8, utf8_decode($zPoste), 0);
/*$CI->fpdf->SetXY(90,30);
$CI->fpdf->Cell(30, 35, utf8_decode(''), 1);*/

$CI->fpdf->SetXY(25,80);
$CI->fpdf->SetFont('Times', 'B', 16);
$CI->fpdf->SetTextColor(0, 0, 0);
$CI->fpdf->Cell(165, 8, 'FORMULAIRE DE PRE-INSCRIPTION',0,1,'C');

$CI->fpdf->SetFont('Arial', 'B', 12);
$CI->fpdf->SetXY(25,90);
$CI->fpdf->Cell(165, 8, utf8_decode('FICHE INDIVIDUELLE DE COMPETENCES'), 1,0,'C');

$CI->fpdf->SetFont('Arial', '', 10);
$CI->fpdf->SetXY(30,102);
$CI->fpdf->Cell(0, 0, utf8_decode('Fonction d\'appartenance :'), 0);
$CI->fpdf->SetXY(30,105);
$CI->fpdf->Cell(155, 7, utf8_decode($zFonction), 1);

$CI->fpdf->SetXY(30,120);
$CI->fpdf->Cell(0, 0, utf8_decode('Famille professionnelle :'), 0);
$CI->fpdf->SetXY(30,123);
$CI->fpdf->Cell(155, 7, utf8_decode($zFamillepro), 1);


$CI->fpdf->SetXY(30,138);
$CI->fpdf->Cell(0, 0, utf8_decode('Sous famille professionnelle :'), 0);
$CI->fpdf->SetXY(30,141);
$CI->fpdf->Cell(155, 7, utf8_decode($zSousfamillepro), 1);

$CI->fpdf->SetXY(30,156);
$CI->fpdf->Cell(0, 1, utf8_decode('Emploi :'), 0);
$CI->fpdf->SetXY(30,159);
$CI->fpdf->Cell(155, 7, utf8_decode($zEmploi), 1);

$CI->fpdf->SetXY(30,174);
$CI->fpdf->Cell(0, 0, utf8_decode('Poste actuel :'), 0);
$CI->fpdf->SetXY(30,177);
$CI->fpdf->Cell(155, 7, utf8_decode($zPoste), 1);

$CI->fpdf->SetXY(30,192);
$CI->fpdf->Cell(0, 0, utf8_decode('Activités de l\'agent :'), 0);
$CI->fpdf->SetXY(30,195);
$CI->fpdf->Cell(155, 7, utf8_decode($zActivite), 1);

$CI->fpdf->SetXY(30,210);
$CI->fpdf->Cell(0, 0, utf8_decode('Tâches quotidiennes : '), 0);
$CI->fpdf->SetXY(30,213);
$CI->fpdf->Cell(155, 7, utf8_decode($zTaches), 1);

$CI->fpdf->SetXY(30,228);
$CI->fpdf->Cell(0, 0, utf8_decode('Postes de travail liés étroitement avec vous :'), 0);
$CI->fpdf->SetXY(30,231);
$CI->fpdf->Cell(155, 7, utf8_decode($zPosteDeTravail), 1);

$CI->fpdf->SetXY(30,246);
$CI->fpdf->Cell(0, 0, utf8_decode('Formations diplômantes :'), 0);
$CI->fpdf->SetXY(30,249);
$CI->fpdf->Cell(155, 7, utf8_decode($zFormationsDiplomantes), 1);

$CI->fpdf->SetXY(30,264);
$CI->fpdf->Cell(0, 0, utf8_decode('Formations de courte durée :'), 0);
$CI->fpdf->SetXY(30,267);
$CI->fpdf->Cell(155, 7, utf8_decode($zFormationCourteDuree), 1);

$CI->fpdf->AddPage();

$CI->fpdf->SetXY(30,25);
$CI->fpdf->Cell(0, 0, utf8_decode('Savoir (connaissances théoriques) requis pour le poste :'), 0);
$CI->fpdf->SetXY(30,28);
$CI->fpdf->Cell(155, 9, utf8_decode($zSavoir), 1);

$CI->fpdf->SetXY(30,43);
$CI->fpdf->Cell(0, 0, utf8_decode('Savoir faire (compétences techniques) requis pour le poste :'), 0);
$CI->fpdf->SetXY(30,46);
$CI->fpdf->Cell(155, 9, utf8_decode($zSavoirFaire), 1);

$CI->fpdf->SetXY(30,61);
$CI->fpdf->Cell(0, 0, utf8_decode('Savoir être (compétences comportementales) requis pour le poste :'), 0);
$CI->fpdf->SetXY(30,64);
$CI->fpdf->Cell(155, 9, utf8_decode($zSavoirEtre), 1);

$CI->fpdf->SetXY(30,79);
$CI->fpdf->Cell(0, 0, utf8_decode('Vos besoins en compétences :'), 0);
$CI->fpdf->SetXY(30,82);
$CI->fpdf->Cell(155, 9, utf8_decode($zBesoins), 1);

$CI->fpdf->SetFont('Arial', 'B', 12);
$CI->fpdf->SetXY(25,100);
$CI->fpdf->Cell(165, 8, utf8_decode('FICHE INDIVIDUELLE DE FORMATION'), 1,0,'C');

$CI->fpdf->SetFont('Arial', '', 10);
$CI->fpdf->SetXY(30,120);
$CI->fpdf->Cell(0, 0, utf8_decode('Type de formation :'), 0);
$CI->fpdf->SetXY(30,123);
$CI->fpdf->Cell(155, 7, utf8_decode($zFormation), 1);


$CI->fpdf->SetXY(30,138);
$CI->fpdf->Cell(0, 0, utf8_decode('Institut de formation :'), 0);
$CI->fpdf->SetXY(30,141);
$CI->fpdf->Cell(155, 7, utf8_decode($zInstitut), 1);

$CI->fpdf->SetXY(30,156);
$CI->fpdf->Cell(0, 1, utf8_decode('Lieu de formation :'), 0);
$CI->fpdf->SetXY(30,159);
$CI->fpdf->Cell(155, 7, utf8_decode($zLieu), 1);

$CI->fpdf->SetXY(30,174);
$CI->fpdf->Cell(0, 0, utf8_decode('Intitulé de formation :'), 0);
$CI->fpdf->SetXY(30,177);
$CI->fpdf->Cell(155, 7, utf8_decode($zIntitule), 1);

$CI->fpdf->SetXY(30,192);
$CI->fpdf->Cell(0, 0, utf8_decode('Date de formation :'), 0);
$CI->fpdf->SetXY(30,195);
$CI->fpdf->Cell(155, 7, utf8_decode($zDate), 1);


$CI->fpdf->Output();


<?php
$fond = PATH_ROOT_DIR .'/assets/img/FicheEvaluation.jpg';
//$fond2 = PATH_ROOT_DIR .'/assets/img/Fiche_d_evaluation-2.jpg';
if($type_photo == NULL){
$image_url = PATH_ROOT_DIR .'/assets/upload/default.jpg';
}
else {
$image_url = PATH_ROOT_DIR .'/assets/upload/'.$id.'.'.$type_photo;
}
require("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetXY(2,2);
$pdf->Image($fond,5,5,200);

$iMois = sprintf("%'.02d\n", $iMois);

$sz_nom = strlen($iMois);
$tb_nom = str_split($iMois);
for ($i = 1; $i <= $sz_nom; $i++) {
	$pdf->SetXY((5.7*$i),31);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(160, 8, '', 0);
	$pdf->Cell(160, 8, utf8_decode($tb_nom[$i-1]), 0);
}

$sz_nom = strlen($nom);
$tb_nom = str_split($nom);
for ($i = 1; $i <= $sz_nom; $i++) {
	$pdf->SetXY((5.7*$i),45);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_nom[$i-1]), 0);
}

//$prenom = incov('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $prenom), PHP_EOL;
$prenom = str_replace('é','e',$prenom);
$prenom = str_replace('è','e',$prenom);
$prenom = str_replace('à','a',$prenom);
$prenom = strtoupper($prenom);
$sz_prenom = strlen($prenom);
$tb_prenom = str_split($prenom);
for ($i = 1; $i <= $sz_prenom; $i++) {
	$pdf->SetXY((5.7*$i),51);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_prenom[$i-1]), 0);
}

$sz_date_naiss = strlen($date_naiss);
$tb_date_naiss = str_split($date_naiss);
for ($i = 1; $i <= $sz_date_naiss; $i++) {
	$pdf->SetXY((5.7*$i),57);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_date_naiss[$i-1]), 0);
}

if($sexe == "1"){
	$pdf->SetXY(28.5,63);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode('X'), 0);
}
else {
	$pdf->SetXY(57.5,63);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode('X'), 0);
}

$sz_matricule = strlen($matricule);
$tb_matricule = str_split($matricule);
for ($i = 1; $i <= $sz_matricule; $i++) {
	$pdf->SetXY((5.7*$i),68.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_matricule[$i-1]), 0);
}

$sz_grade = strlen($grade);
$tb_grade = str_split($grade);
for ($i = 1; $i <= $sz_grade; $i++) {
	$pdf->SetXY((5.7*$i),74.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_grade[$i-1]), 0);
}
$cin = str_replace(' ','',$cin);
$sz_cin = strlen($cin);
$tb_cin = str_split($cin);
/*if($matricule == "ECD"){*/
	for ($i = 1; $i <= $sz_cin; $i++) {
	if($tb_cin[$i-1] != " "){
	$pdf->SetXY((5.7*$i),68.5);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(91, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_cin[$i-1]), 0);
	}
}
/*}*/

$sz_departement = strlen($departement);
$tb_departement = str_split($departement);
for ($i = 1; $i <= $sz_departement; $i++) {
	if($i > "28"){
		$pdf->SetXY((5.7*($i-28)),86.5);
		// $pdf->SetXY((5.7*($i-29)),92.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_departement[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.7*$i),80.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_departement[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.7*$i),80.5);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);
	}
	}
}

$sz_direction = strlen($direction);
$tb_direction = str_split($direction);
for ($i = 1; $i <= $sz_direction; $i++) {
	if($i > "28"){
	$pdf->SetXY((5.7*($i-28)),98.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_direction[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.7*$i),92.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_direction[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.7*$i),92.5);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
}

$sz_service = strlen($service);
$tb_service = str_split($service);
for ($i = 1; $i <= $sz_service; $i++) {
	if($i > "28"){
	$pdf->SetXY((5.7*($i-28)),110.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_service[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.7*$i),104.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_service[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.7*$i),104.5);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
}

//$corps = incov('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $corps), PHP_EOL;
if($corps != "Sélectionner"){
	$corps_org = $corps;
	}
else{
	$corps = '';
	}
$corps = str_replace('é','e',$corps);
$corps = str_replace('è','e',$corps);
$corps = str_replace('à','a',$corps);
$sz_corps = strlen($corps);
$tb_corps = str_split($corps);
for ($i = 1; $i <= $sz_corps; $i++) {
	if($i > "28"){
	$pdf->SetXY((5.7*($i-28)),122.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_corps[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.7*$i),116.5);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_corps[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.7*$i),116.5);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
}
// for ($i = 1; $i <= $sz_corps; $i++) {

	// $pdf->SetXY((5.7*$i),116.5);
	// $pdf->SetFont('Arial', '', 10);
	// $pdf->Cell(34, 8, '', 0);
	// $pdf->Cell(30, 8, utf8_decode($tb_corps[$i-1]), 0);
	// }
$poste = str_replace('é','e',$poste);
$poste = str_replace('è','e',$poste);
$poste = str_replace('à','a',$poste);
$poste = strtoupper($poste);
$sz_poste = strlen($poste);
$tb_poste = str_split($poste);
for ($i = 1; $i <= $sz_poste; $i++) {
if($i > "28"){
	$pdf->SetXY((5.7*($i-28)),134);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.7*$i),128);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.7*$i),128);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
/*	$pdf->SetXY((5.7*$i),128);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);*/
}



if ($iEvaluableValue == 1) {

	if (sizeof($oCandidatEvaluateur) > 0) {

		$iStrlenNom = strlen($oCandidatEvaluateur[0]->nom);
		$toNom = str_split($oCandidatEvaluateur[0]->nom);

		for ($i = 1; $i <= $iStrlenNom; $i++) {
			$pdf->SetXY((5.7*$i),155);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toNom[$i-1]), 0);
		}


		$iStrlenPrenomNom = strlen($oCandidatEvaluateur[0]->prenom);
		$toPrenomNom = str_split($oCandidatEvaluateur[0]->prenom);

		for ($i = 1; $i <= $iStrlenPrenomNom; $i++) {
			$pdf->SetXY((5.7*$i),161.5);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toPrenomNom[$i-1]), 0);
		}

		$iStrlenMatricule = strlen($oCandidatEvaluateur[0]->matricule);
		$toMatricule = str_split($oCandidatEvaluateur[0]->matricule);
		for ($i = 1; $i <= $iStrlenMatricule; $i++) {

			$pdf->SetXY((5.7*$i),167.5);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toMatricule[$i-1]), 0);
		}

		$iStrlenGrade = strlen($oCandidatEvaluateur[0]->grade);
		$toGrade = str_split($oCandidatEvaluateur[0]->grade);
		for ($i = 1; $i <= $iStrlenGrade; $i++) {
			$pdf->SetXY((5.7*$i),173);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toGrade[$i-1]), 0);
		}

		$zPoste = str_replace('é','e',utf8_decode($oCandidatEvaluateur[0]->poste));
		$zPoste = str_replace('è','e',$zPoste);
		$zPoste = str_replace('à','a',$zPoste);
		$zPoste = strtoupper($zPoste);
		$iStrlenPoste = strlen($zPoste);
		$toPoste = str_split($zPoste);
		for ($i = 1; $i <= $iStrlenPoste; $i++) {
		if($i > "28"){
			$pdf->SetXY((5.7*($i-28)),185);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toPoste[$i-1]), 0);
		} else {
			$pdf->SetXY((5.7*$i),179.5);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toPoste[$i-1]), 0);
			if($i == "28"){
				$pdf->SetXY((5.7*$i),179.5);
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(39, 8, '', 0);
				$pdf->Cell(30, 8, utf8_decode('-'), 0);}
			}
		}

	}

	$sz_date_prise_service = strlen($date_prise_service);
	$tb_date_prise_service = str_split($date_prise_service);
	for ($i = 1; $i <= $sz_date_prise_service; $i++) {
		$pdf->SetXY((5.7*$i),140);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode($tb_date_prise_service[$i-1]), 0);
	}

	$iNoteEvaluation = 0 ; 
	$iDenominateurNoteEvaluation = 0;
	$iDenominateurNotePointage = 0 ; 

	$iNotePointage =0 ; 
	if ($iMoyenneUserInfoPointage != '' && $iMoyenneUserInfoPointage > 0)
	{
		$iNotePointage = $iMoyenneUserInfoPointage ; 
	}
	if (sizeof($toListeNoteAgent) > 0) {

		$iSetX = 60 ;
		$iSetDepart = 90 ;
		$iDenominateurNoteEvaluation = 10 ; 
		$iNoteEvaluation = $toListeNoteAgent[0]['noteEvaluation_noteValue'];
		$iNote = (int)$toListeNoteAgent[0]['noteEvaluation_noteValue'];

		if ($toListeNoteAgent[0]['noteEvaluation_notePonctualite'] != ""){
			$iNotePointage = $toListeNoteAgent[0]['noteEvaluation_notePonctualite'] ; 
		}
		//$iNote = 5;
		switch ($iNote) {

			case 0:
				$iSetX = 60;
				break;

			case 1:
				$iSetX = 71.5;
				break;

			case 2:
				$iSetX = 83;
				break;

			case 3:
				$iSetX = 94.5;
				break;

			case 4:
				$iSetX = 106;
				break;

			case 5:
				$iSetX = 117;
				break;
		}

		$pdf->SetXY($iSetX,215);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, '', 0);

		//$iNoteEvaluation++;
		
		for ($i=1; $i<=11.1*($iNoteEvaluation+1); $i++){
			$zImageLogoUrl = PATH_ROOT_DIR .'/assets/upload/logo/carre.png';
			$pdf->Image($zImageLogoUrl,$iSetDepart+$i,217,2);
		}

	}

	$iNoteAssuidite = 0;

	if (sizeof($oCandidatEvaluateur) > 0) {

		if ($iNotePointage != "") {

			$iSetX = 60 ;
			$iSetDepart = 90 ;
			$iDenominateurNotePointage = 10 ; 
			$iNoteAssuidite = floor($iNotePointage);
			//$iNote = 5;
			switch ($iNoteAssuidite) {

				case 0:
					$iSetX = 60;
					break;

				case 1:
					$iSetX = 71.5;
					break;

				case 2:
					$iSetX = 83;
					break;

				case 3:
					$iSetX = 94.5;
					break;

				case 4:
					$iSetX = 106;
					break;

				case 5:
					$iSetX = 117;
					break;
			}

			$pdf->SetXY($iSetX,222.5);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, '', 0);

			//$iMoyenneUserInfoPointage++;

			for ($i=1; $i<=11.1*($iNotePointage+1); $i++){
				$zImageLogoUrl = PATH_ROOT_DIR .'/assets/upload/logo/carre.png';
				$pdf->Image($zImageLogoUrl,$iSetDepart+$i,225,2);
			}

		}
	}

	$iNoteEvaluation = number_format($iNoteEvaluation, 2, ',','');

	
	$toNoteEvaluation = explode(',', $iNoteEvaluation) ; 

	$iAvantVirgule = $toNoteEvaluation[0] ; 
	if ($toNoteEvaluation[1] != "00"){

		if ($toNoteEvaluation[1] <= 25) {
			$iNoteEvaluation = $iAvantVirgule . ".25" ; 
		} elseif ($toNoteEvaluation[1] > 25 && $toNoteEvaluation[1] <=65) {
			$iNoteEvaluation = $iAvantVirgule . ".50" ; 
		} elseif ($toNoteEvaluation[1] > 65 && $toNoteEvaluation[1] <=80) {
			$iNoteEvaluation = $iAvantVirgule . ".75" ; 
		} elseif ($toNoteEvaluation[1] > 80 && $toNoteEvaluation[1] <=99) {
			$iNoteEvaluation++;
		} else {
			$iNoteEvaluation = number_format($iNoteEvaluation, 2, '.',''); 
		}
	} else {
		$iNoteEvaluation = $iAvantVirgule ; 
	}

	$iNotePointage = number_format($iNotePointage, 2, ',','');


	$toMoyenneUserInfoPointage = explode(',', $iNotePointage) ; 

	$iAvantVirgule = $toMoyenneUserInfoPointage[0] ; 
	if ($toMoyenneUserInfoPointage[1] != "00"){

		if ($toMoyenneUserInfoPointage[1] <= 25) {
			$iMoyenneUserInfoPointage = $iAvantVirgule . ".25" ; 
		} elseif ($toMoyenneUserInfoPointage[1] > 25 && $toMoyenneUserInfoPointage[1] <=65) {
			$iMoyenneUserInfoPointage = $iAvantVirgule . ".50" ; 
		} elseif ($toMoyenneUserInfoPointage[1] > 65 && $toMoyenneUserInfoPointage[1] <=80) {
			$iMoyenneUserInfoPointage = $iAvantVirgule . ".75" ; 
		} elseif ($toMoyenneUserInfoPointage[1] > 80 && $toMoyenneUserInfoPointage[1] <=99) {
			$iMoyenneUserInfoPointage++;
		} else {
			$iMoyenneUserInfoPointage = number_format($iNotePointage, 2, '.',''); 
		}
	} else {
		$iMoyenneUserInfoPointage = $iAvantVirgule ; 
	}

	$iNoteTotal = ($iNoteEvaluation * 2) + ($iMoyenneUserInfoPointage * 2) ;

	$iNoteTotalVirgule = str_replace (".", ",", $iNoteTotal) ; 
	
	$iNoteTotalAffiche = number_format($iNoteTotal, 2, ',','');
	$iNoteTotal = number_format($iNoteTotal, 2, ',','');
	$iDenominateur = $iDenominateurNoteEvaluation + $iDenominateurNotePointage ;

	$toNbrTotal = explode(',', $iNoteTotal) ; 

	if (sizeof($oCandidatEvaluateur) > 0) {

		if ($toNbrTotal[1] == "00") {

			$pdf->SetXY(143,215);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, $toNbrTotal[0] , 0);
		} else {

			$pdf->SetXY(140,215);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, $iNoteTotalVirgule , 0);
		}

		$pdf->SetXY(150,218);
		$pdf->SetFont('Arial', '', 10);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, '/', 0);

		if ($iDenominateur >  0) {
			$pdf->SetXY(153,222.5);
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, $iDenominateur, 0);
		}
	}

} else {

	$pdf->SetXY(138,215);
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, "Non Evaluable" , 0);
}




/*
$pdf->AddPage();
$pdf->SetXY(2,2);
$pdf->Image($fond2,15,5,180);*/

$pdf->Output();
?>

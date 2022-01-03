
<?php


switch ($oEvaluation['noteEvaluation_categorieId']) 
{
	case '1':
		$fond = base_url().'assets/img/FEAE.jpg';
		break;

	case '2':
		$fond = base_url().'assets/img/FEAS.jpg';
		break;

	case '3':
		$fond = base_url().'assets/img/FECS.jpg';
		break;
}

//$fond2 = base_url().'assets/img/Fiche_d_evaluation-2.jpg';
if($type_photo == NULL){
$image_url = base_url().'assets/upload/default.jpg';
}
else {
$image_url = base_url().'assets/upload/'.$id.'.'.$type_photo;
}
require("fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetXY(2,2);
$pdf->Image($fond,5,5,200);

/*$iMois = sprintf("%'.02d\n", $iMois);

$sz_nom = strlen($iMois);
$tb_nom = str_split($iMois);
for ($i = 1; $i <= $sz_nom; $i++) {
	$pdf->SetXY((5.6*$i),31);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(160, 8, '', 0);
	$pdf->Cell(160, 8, utf8_decode($tb_nom[$i-1]), 0);
}*/

$sz_nom = strlen($nom);
$tb_nom = str_split($nom);
for ($i = 1; $i <= $sz_nom; $i++) {
	$pdf->SetXY((5.6*$i),43);
	$pdf->SetFont('Arial', 'B', 9);
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
	$pdf->SetXY((5.6*$i),49);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_prenom[$i-1]), 0);
}

$sz_date_naiss = strlen($date_naiss);
$tb_date_naiss = str_split($date_naiss);
for ($i = 1; $i <= $sz_date_naiss; $i++) {
	$pdf->SetXY((5.6*$i),55);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);

	if ($tb_date_naiss[$i-1] != '/') {
		$pdf->Cell(30, 8, utf8_decode($tb_date_naiss[$i-1]), 0);
	}
}

if($sexe == "1"){
	$pdf->SetXY(84,60);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode('X'), 0);
}
else {
	$pdf->SetXY(106,60);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode('X'), 0);
}

$sz_matricule = strlen($matricule);
$tb_matricule = str_split($matricule);
for ($i = 1; $i <= $sz_matricule; $i++) {
	$pdf->SetXY((5.7*$i),60);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_matricule[$i-1]), 0);
}

$sz_grade = strlen($grade);
$tb_grade = str_split($grade);
for ($i = 1; $i <= $sz_grade; $i++) {
	$pdf->SetXY((139+5.6*$i),60);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_grade[$i-1]), 0);
}
$cin = str_replace(' ','',$cin);
$sz_cin = strlen($cin);
$tb_cin = str_split($cin);
/*if($matricule == "ECD"){*/
	for ($i = 1; $i <= $sz_cin; $i++) {
	if($tb_cin[$i-1] != " "){
	$pdf->SetXY(21+(5.6*$i),55);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(91, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_cin[$i-1]), 0);
	}
}
/*}*/

$sz_departement = strlen($departement);
$tb_departement = str_split($departement);
for ($i = 1; $i <= $sz_departement; $i++) {
	if($i > "28"){
		$pdf->SetXY((5.6*($i-28)),72);
		// $pdf->SetXY((5.6*($i-29)),92.5);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_departement[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.6*$i),66);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_departement[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.6*$i),66);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);
	}
	}
}

$sz_direction = strlen($direction);
$tb_direction = str_split($direction);
for ($i = 1; $i <= $sz_direction; $i++) {
	if($i > "28"){
	$pdf->SetXY((5.6*($i-28)),83);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_direction[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.6*$i),78);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_direction[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.6*$i),78);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
}

$sz_service = strlen($service);
$tb_service = str_split($service);
for ($i = 1; $i <= $sz_service; $i++) {
	if($i > "28"){
	$pdf->SetXY((5.6*($i-28)),94);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_service[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.6*$i),89);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_service[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.6*$i),89);
		$pdf->SetFont('Arial', '', 9);
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
	$pdf->SetXY((5.6*($i-28)),106);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_corps[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.6*$i),100);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_corps[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.6*$i),100);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
}
// for ($i = 1; $i <= $sz_corps; $i++) {

	// $pdf->SetXY((5.6*$i),116.5);
	// $pdf->SetFont('Arial', '', 9);
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
	$pdf->SetXY((5.6*($i-28)),118);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);
	}
	else {
	$pdf->SetXY((5.6*$i),112);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);
	if($i == "28"){
		$pdf->SetXY((5.6*$i),112);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(39, 8, '', 0);
		$pdf->Cell(30, 8, utf8_decode('-'), 0);}
	}
/*	$pdf->SetXY((5.6*$i),128);
	$pdf->SetFont('Arial', '', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, utf8_decode($tb_poste[$i-1]), 0);*/
}

$sz_date_prise_service = strlen($date_prise_service);
	$tb_date_prise_service = str_split($date_prise_service);
	for ($i = 1; $i <= $sz_date_prise_service; $i++) {
		$pdf->SetXY((5.6*$i),118);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(34, 8, '', 0);

		if ($tb_date_prise_service[$i-1] != '/') {
			$pdf->Cell(30, 8, utf8_decode($tb_date_prise_service[$i-1]), 0);
		}
	}



if ($iEvaluableValue == 1) {

	if (sizeof($oCandidatEvaluateur) > 0) {

		$iStrlenNom = strlen($oCandidatEvaluateur[0]->nom);
		$toNom = str_split($oCandidatEvaluateur[0]->nom);

		for ($i = 1; $i <= $iStrlenNom; $i++) {
			$pdf->SetXY((5.6*$i),132);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toNom[$i-1]), 0);
		}


		$iStrlenPrenomNom = strlen($oCandidatEvaluateur[0]->prenom);
		$toPrenomNom = str_split(utf8_decode($oCandidatEvaluateur[0]->prenom));

		for ($i = 1; $i <= $iStrlenPrenomNom; $i++) {
			$pdf->SetXY((5.6*$i),138);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, $toPrenomNom[$i-1], 0);
		}

		$iStrlenMatricule = strlen($oCandidatEvaluateur[0]->matricule);
		$toMatricule = str_split($oCandidatEvaluateur[0]->matricule);
		for ($i = 1; $i <= $iStrlenMatricule; $i++) {

			$pdf->SetXY((5.6*$i),143);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toMatricule[$i-1]), 0);
		}

		
		$cin = str_replace(' ','',$oCandidatEvaluateur[0]->cin);
		$sz_cin = strlen($cin);
		$tb_cin = str_split($cin);
		/*if($matricule == "ECD"){*/
			for ($i = 1; $i <= $sz_cin; $i++) {
			if($tb_cin[$i-1] != " "){
			$pdf->SetXY(21+(5.6*$i),143);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(91, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($tb_cin[$i-1]), 0);
			}
		}


		$iStrlenGrade = strlen($oCandidatEvaluateur[0]->grade);
		$toGrade = str_split($oCandidatEvaluateur[0]->grade);
		for ($i = 1; $i <= $iStrlenGrade; $i++) {
			$pdf->SetXY((5.6*$i),149);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toGrade[$i-1]), 0);
		}

		$zPoste = str_replace('é','e',$oCandidatEvaluateur[0]->poste);
		$zPoste = str_replace('è','e',$zPoste);
		$zPoste = str_replace('à','a',$zPoste);

		$zPoste = strtoupper($zPoste);
		$iStrlenPoste = strlen($zPoste);
		$toPoste = str_split($zPoste);

		for ($i = 1; $i <= $iStrlenPoste; $i++) {
		if($i > "28"){
			$pdf->SetXY((5.6*($i-28)),161);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toPoste[$i-1]), 0);
		} else {
			$pdf->SetXY((5.6*$i),155);
			$pdf->SetFont('Arial', '', 9);
			$pdf->Cell(34, 8, '', 0);
			$pdf->Cell(30, 8, utf8_decode($toPoste[$i-1]), 0);
			if($i == "28"){
				$pdf->SetXY((5.6*$i),155);
				$pdf->SetFont('Arial', '', 9);
				$pdf->Cell(39, 8, '', 0);
				$pdf->Cell(30, 8, utf8_decode('-'), 0);}
			}
		}

	}

	

	
} else {

	$pdf->SetXY(138,215);
	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(34, 8, '', 0);
	$pdf->Cell(30, 8, "Non Evaluable" , 0);
}

switch ($oEvaluation['noteEvaluation_categorieId']) 
{
	case '1': // Agent executant

		$toNoteAll = explode(";", $oEvaluation['noteEvaluation_NoteAll']) ; 
		$fMoyenneNote = 0;
		$iIncrement = 0;
		$zCritereAndNote = "";
		$iSetX = 0;
		$iInitial  = 174.5 ; 
		$iSetX2	   = 105 ; 
		$iInitial2  = $iInitial+5 ;
		$iInitial3  = $iInitial-60 ;
		$ftotal = 0;
		foreach ($toNoteAll as $oNoteAll){
			$toSplitNote = explode("-", $oNoteAll) ; 

			if (isset ($toSplitNote[1])) {

				if ($iIncrement == 6) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial-6;
				}
				
				if ($iIncrement > 6) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial2-6;
				}

				

				if ($iIncrement > 10) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial3-6;
				}

				$iStrlenNote = strlen($toSplitNote[1]);
				$iNote = str_split(sprintf("%'.02d\n",(round($toSplitNote[1]*2))));
				$ftotal += round($toSplitNote[1]*2);
				//$iNote = $toSplitNote[0] . " = " . $toSplitNote[1]*2;
				for ($iBoucle = 1; $iBoucle <= $iStrlenNote; $iBoucle++) {
					$pdf->SetXY($iSetX + (6.2*$iBoucle),$iInitial+$iIncrement*6);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(34, 8, '', 0);
					$pdf->Cell(30, 8, $iNote[$iBoucle-1], 0);
				}

				
				$iIncrement++; 
			}
		}


		$pdf->SetXY(151,206);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, $ftotal, 0);



		break;

	case '2': // Agent de surface

		$toNoteAll = explode(";", $oEvaluation['noteEvaluation_NoteAll']) ; 
		$fMoyenneNote = 0;
		$iIncrement = 0;
		$zCritereAndNote = "";
		$iSetX = 0;
		$iInitial  = 174.5 ; 
		$iSetX2	   = 105 ; 
		$iInitial2  = $iInitial+5 ;
		$iInitial3  = $iInitial-60 ;
		$ftotal = 0;
		foreach ($toNoteAll as $oNoteAll){
			$toSplitNote = explode("-", $oNoteAll) ; 

			if (isset ($toSplitNote[1])) {

				if ($iIncrement == 6) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial-6;
				}
				
				if ($iIncrement > 6) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial2-6;
				}

				

				if ($iIncrement > 9) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial3;
				}

				$iStrlenNote = strlen($toSplitNote[1]);
				$iNote = str_split(sprintf("%'.02d\n",(round($toSplitNote[1]*2))));
				//$iNote = $toSplitNote[1];
				$ftotal += round($toSplitNote[1]*2);
				//$iNote = $toSplitNote[0] . " = " . $toSplitNote[1]*2;
				for ($iBoucle = 1; $iBoucle <= $iStrlenNote; $iBoucle++) {
					$pdf->SetXY($iSetX + (6.2*$iBoucle),$iInitial+$iIncrement*6);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(34, 8, '', 0);
					$pdf->Cell(30, 8, $iNote[$iBoucle-1], 0);
				}

					/*$pdf->SetXY($iSetX + (6.2*$iBoucle),$iInitial+$iIncrement*6);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(34, 8, '', 0);
					$pdf->Cell(30, 8, $toSplitNote[0] . " = " . $iNote, 0);*/

				
				$iIncrement++; 
			}
		}


		$pdf->SetXY(151,206);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, $ftotal, 0);
		
		break;

	case '3': // Agent cadre supérieur
		
		$toNoteAll = explode(";", $oEvaluation['noteEvaluation_NoteAll']) ; 
		$fMoyenneNote = 0;
		$iIncrement = 0;
		$zCritereAndNote = "";
		$iSetX = 5.9;
		$iInitial  = 174 ; 
		$iSetX2	   = 110.9 ; 
		$iInitial2  = $iInitial-25 ;
		$iInitial3  = $iInitial-84 ;
		$ftotal = 0;
		foreach ($toNoteAll as $oNoteAll){
			$toSplitNote = explode("-", $oNoteAll) ; 

			if (isset ($toSplitNote[1])) {

				
				if ($iIncrement > 9) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial2;
				}

				if ($iIncrement > 13) {
					$iSetX = $iSetX2 ; 
					$iInitial = $iInitial3;
				}

				$iStrlenNote = strlen($toSplitNote[1]);
				$iNote = str_split(sprintf("%'.02d\n",(round($toSplitNote[1]*2))));
				//$iNote = $toSplitNote[1];
				$ftotal += round($toSplitNote[1]*2);
				//$iNote = $toSplitNote[0] . " = " . $toSplitNote[1]*2;
				for ($iBoucle = 1; $iBoucle <= $iStrlenNote; $iBoucle++) {
					$pdf->SetXY($iSetX + (6*$iBoucle),$iInitial+$iIncrement*6);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(34, 8, '', 0);
					$pdf->Cell(30, 8, $iNote[$iBoucle-1], 0);
				}

				/*	$pdf->SetXY($iSetX + (6.2*$iBoucle),$iInitial+$iIncrement*6);
					$pdf->SetFont('Arial', '', 9);
					$pdf->Cell(34, 8, '', 0);
					$pdf->Cell(30, 8, $toSplitNote[0] . " = " . $iNote, 0);
				*/

				
				$iIncrement++; 
			}
		}


		$pdf->SetXY(151,202);
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(34, 8, '', 0);
		$pdf->Cell(30, 8, $ftotal, 0);
		break;
}




/*
$pdf->AddPage();
$pdf->SetXY(2,2);
$pdf->Image($fond2,15,5,180);*/

$pdf->Output();
?>

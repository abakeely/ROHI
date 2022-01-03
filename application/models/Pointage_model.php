<?php
class Pointage_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	public function get_rang($date_debut,$date_fin,$child_id){
		$list_agent			=	$this->get_list_agent_rattache($child_id);
		$list_rang			=	array();
		foreach($list_agent as $key=>$agent){
			$total_heure_effectue			=	$this->calculTempsDeTravailMysql($date_debut,$date_fin,$agent["matricule"]);
			//$total_heure_effectue			=	8;
			$line							=	array();
			$line["matricule"]				=	$agent["matricule"];
			$line["nom"]					=	$agent["nom"];
			$line["prenom"]					=	$agent["prenom"];
			$line["path"]					=	$agent["path"];
			$line["total_heure_effectue"]	=	$total_heure_effectue;
			$line["nb_jour"]				=	$this->get_nb_open_days($date_debut,$date_fin);
			array_push($list_rang,$line);
			
		}
		return $list_rang;
	}
	
	public function get_rang_meme_structure($date_debut,$date_fin,$matricule,$child_id){
		$list_agent			=	$this->get_list_agent_meme_structure($child_id);
		$list_rang			=	array();
		foreach($list_agent as $key=>$agent){
			$total_heure_effectue			=	$this->calculTempsDeTravailMysql($date_debut,$date_fin,$agent["matricule"]);
			//$total_heure_effectue			=	8;
			$line							=	array();
			$line["matricule"]				=	$agent["matricule"];
			$line["nom"]					=	$agent["nom"];
			$line["prenom"]					=	$agent["prenom"];
			$line["path"]					=	$agent["path"];
			$line["total_heure_effectue"]	=	$total_heure_effectue;
			array_push($list_rang,$line);
			
		}
		//usort($list_rang, 'comparator'); 
		usort($list_rang, function($object1, $object2) {
				return $object1["total_heure_effectue"] < $object2["total_heure_effectue"]; 
		});
		//print_r($list_rang);die;
		$rang 	= 	array_search($matricule, array_column($list_rang, 'matricule') ); 
			//print_r($matricule);die;

		if(sizeof($list_rang[$rang ]) >0 ){
			$rang	=	$rang+1;
		}else{
			$rang	=	0;
		}
		$list_rang[$rang]["rang"]		=	$rang;
		$list_rang[$rang]["nb_jour"]	=	$this->get_nb_open_days($date_debut,$date_fin);
	
		return $list_rang[$rang];
	}
	
	public function get_rang_agent_rattache($date_debut,$date_fin,$matricule,$child_id){
		$list_agent			=	$this->get_list_agent_rattache($child_id);
		$list_rang			=	array();
		foreach($list_agent as $key=>$agent){
			$total_heure_effectue			=	$this->calculTempsDeTravailMysql($date_debut,$date_fin,$agent["matricule"]);
			//$total_heure_effectue			=	8;
			$line							=	array();
			$line["matricule"]				=	$agent["matricule"];
			$line["nom"]					=	$agent["nom"];
			$line["prenom"]					=	$agent["prenom"];
			$line["path"]					=	$agent["path"];
			$line["total_heure_effectue"]	=	$total_heure_effectue;
			array_push($list_rang,$line);
			
		}
		//print_r($list_rang);die;
		//usort($list_rang, 'comparator'); 
		usort($list_rang, function($object1, $object2) {
				return $object1["total_heure_effectue"] < $object2["total_heure_effectue"]; 
		});
		$rang 	= 	array_search($matricule, array_column($list_rang, 'matricule') ); 
		if(sizeof($list_rang[$rang ]) >0 ){
			$rang	=	$rang+1;
		}else{
			$rang	=	0;
		}
		$list_rang[$rang]["rang"]		=	$rang;
		$list_rang[$rang]["nb_jour"]	=	$this->get_nb_open_days($date_debut,$date_fin);
	
		return $list_rang[$rang];
	}
	
	public function get_repport($date_debut,$date_fin,$child_id){
		$list_agent			=	$this->get_list_agent_rattache($child_id);
		$list_rang			=	array();
				

		foreach($list_agent as $key=>$agent){
			$total_heure_effectue			=	$this->calculTempsDeTravailMysql($date_debut,$date_fin,$agent["matricule"]);
			$line							=	array();
			$line["matricule"]				=	$agent["matricule"];
			$line["nom"]					=	$agent["nom"];
			$line["prenom"]					=	$agent["prenom"];
			$line["path"]					=	$agent["path"];
			$line["total_heure_effectue"]	=	$total_heure_effectue;
			array_push($list_rang,$line);
		}
		//usort($list_rang, 'comparator'); 
		usort($list_rang, function($object1, $object2) {
				return $object1["total_heure_effectue"] < $object2["total_heure_effectue"]; 
		});
		
		return $list_rang;
	}
	
	public function get_list_agent_rattache($child_id){
		
		$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$child_id."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0";
		$query		=   $this->db->query($sqllist);
		$toList		=   $query->result_array();
		$tzLists	=	array() ;
		array_push($tzLists,"'".$child_id."'") ;
		foreach($toList as $oList){
			array_push($tzLists,"'".$oList["child_id"]."'") ;
		}
		$zList		=	implode(",",$tzLists);
		$sql= " select *
				from rohi.candidat a
				inner join rohi.t_structure b
				on a.structureId = b.child_id
				where structureId in ($zList) 
				AND		sanction IN('00','34','40')
			  ";
		$query 			= 	$this->db->query($sql);
		$list_agent		=	$query->result_array();
		return $list_agent;
		
		
	}
	
	public function get_list_agent_meme_structure($child_id){
		
		$sql= " select *
				from rohi.candidat a
				where structureId ='".$child_id."'
				AND		sanction IN('00','34','40')
			  ";
		$query 			= 	$this->db->query($sql);
		$list_agent		=	$query->result_array();
		return $list_agent;
		
		
	}
	
	public function calculTempsDeTravailMysql($zDateDebut,$zDateFin,$zMatricule) {
		$list_date				=	$this->get_list_date($zDateDebut,$zDateFin);
		$total_heure_travail	=	0;
		for($iIndex = 0;$iIndex <sizeof($list_date);$iIndex ++ ){
			$heure_entree	=	$this->calculPremierHeureEntreeMysql($list_date[$iIndex],$zMatricule);
			$heure_sortie	=	$this->calculDernierHeureSortieMysql($list_date[$iIndex],$zMatricule);

			if(!empty($heure_entree)){
				$heure_entree	=	$heure_entree;
			}else{
				//test congé
				$heure_entree	=	$this->calcul_mode_entree(null);
			}
			if(!empty($heure_sortie)){
				$heure_sortie	=	$heure_sortie;
			}else{
				//test congé
				$heure_sortie	=	$this->calcul_mode_sortie(null);
			}
			$durree_travail		=	strtotime($heure_sortie)-strtotime($heure_entree);
						//echo $heure_entree;
						//echo $heure_sortie;die;

			$durree_travail		=	round(abs($durree_travail)/3600,2);
			$total_heure_travail=	$total_heure_travail + $durree_travail	;
		}
			

		//echo $this->get_nb_open_days($zDateDebut,$zDateFin);die;
		return $total_heure_travail;
	} 
	
	public function calculPremierHeureEntreeMysql($zDate,$zMatricule) {
		$parts = explode('-', $zDate);
		$heure_entree	=	"";
				
		$sql= " SELECT id,
						min(a.time) time,
						pin,
						state,
						event_point_name
		          FROM Transactions.acc_monitor_log_".$parts[0]." a 
				WHERE a.pin='$zMatricule' 
				AND DATE(a.time)='$zDate' 
				AND a.state='10' 
				LIMIT 1 ";
		//echo $sql;die;
		$query	 			= $this->db->query($sql);
		$row_array			= $query->row_array();
		$row_array			= $row_array["time"];
		$row_array			= explode(" ",$row_array);
		$heure_entree		= $row_array[1];
		return $heure_entree;
	}
	
	public function calculDernierHeureSortieMysql($zDate,$zMatricule) {
		$parts = explode('-', $zDate);
		$heure_sortie	=	"";
		
		$sql= " SELECT id,
						max(a.time) time,
						pin,
						state,
						event_point_name
		          FROM Transactions.acc_monitor_log_".$parts[0]." a
				WHERE a.pin='$zMatricule' 
				AND DATE(a.time)='$zDate' 
				AND a.state='11' 
				LIMIT 1 ";
		$query	 			= $this->db->query($sql);
		$row_array			= $query->row_array();
		$row_array			= $row_array["time"];
		$row_array			= explode(" ",$row_array);
		$heure_sortie		= $row_array[1];
		
		return $heure_sortie;
		
	}
	
	public function get_list_date($date_debut,$date_fin){
		
		$list_date_debut	=	explode("-",$date_debut);
		$debut_jour 	= $list_date_debut[2];
		$debut_mois 	= $list_date_debut[1];
		$debut_annee 	= $list_date_debut[0];
		
		$list_date_fin	= explode("-",$date_fin);
		$fin_jour 		= $list_date_fin[2];
		$fin_mois 		= $list_date_fin[1];
		$fin_annee 		= $list_date_fin[0];
		
		$debut_date 	= mktime(0, 0, 0, $debut_mois, $debut_jour, $debut_annee);
		$fin_date 		= mktime(0, 0, 0, $fin_mois, $fin_jour, $fin_annee);
		$list_date		= array();
		for($i = $debut_date; $i <= $fin_date; $i+=86400){
			array_push($list_date,date("Y-m-d",$i));
		}
		
		return $list_date;
	}
	
	public function get_nb_open_days($date_start, $date_stop) {	
	
		$arr_bank_holidays = array(); // Tableau des jours feriés	
		
		// On boucle dans le cas où l'année de départ serait différente de l'année d'arrivée
		$diff_year = date('Y', $date_stop) - date('Y', $date_start);
		for ($i = 0; $i <= $diff_year; $i++) {			
			$year = (int)date('Y', strtotime($date_start)) + $i;
			// Liste des jours feriés
			$arr_bank_holidays[] = '1_1_'.$year; // Jour de l'an
			$arr_bank_holidays[] = '1_5_'.$year; // Fete du travail
			$arr_bank_holidays[] = '8_5_'.$year; // Victoire 1945
			$arr_bank_holidays[] = '14_7_'.$year; // Fete nationale
			$arr_bank_holidays[] = '15_8_'.$year; // Assomption
			$arr_bank_holidays[] = '1_11_'.$year; // Toussaint
			$arr_bank_holidays[] = '11_11_'.$year; // Armistice 1918
			$arr_bank_holidays[] = '25_12_'.$year; // Noel
					
			// Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote	
			$easter = easter_date($year);
			$arr_bank_holidays[] = date('j_n_'.$year, $easter + 86400); // Paques
			$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*39)); // Ascension
			$arr_bank_holidays[] = date('j_n_'.$year, $easter + (86400*50)); // Pentecote	
		}
		//print_r($arr_bank_holidays);
		$nb_days_open = 0;
		// Mettre <= si on souhaite prendre en compte le dernier jour dans le décompte	

		while ($date_start <= $date_stop) {
			// Si le jour suivant n'est ni un dimanche (0) ou un samedi (6), ni un jour férié, on incrémente les jours ouvrés	
			//echo date('j_n_'.date('Y', strtotime($date_start)));die;
			//echo date('w', strtotime($date_start));die;

			if (!in_array(date('w', strtotime($date_start)), array(0, 6)) 
			&& !in_array(date('j_n_'.date('Y', strtotime($date_start)), strtotime($date_start)), $arr_bank_holidays)) {
				$nb_days_open++;		
			}

			/*$date_start = mktime(date('H', strtotime($date_start)), date('i', strtotime($date_start)), date('s', strtotime($date_start)), date('m', strtotime($date_start)), date('d', strtotime($date_start)) + 1, date('Y', strtotime($date_start)));*/	

			$date_start	=	date_create($date_start);
			date_add($date_start,date_interval_create_from_date_string("1 days"));
			$date_start	=	date_format($date_start,"Y-m-d");
		}		
		return $nb_days_open;
	}
	
	
	public function check_conge(){
		
		
	}
	
	public function calcul_mode_entree($series_stat){
		$mode	=	"08:00";
		return $mode;
	}
	
	public function calcul_mode_sortie($series_stat){
		$mode	=	"16:00";
		return $mode;
	}
	
	
	
	public function print_report_excel ($_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("RADO ABRAHAM")
									 ->setLastModifiedBy("RADO ABRAHAM")
									 ->setTitle("POINTAGE ELECTRONIQUE")
									 ->setSubject("POINTAGE ELECTRONIQUE")
									 ->setDescription("POINTAGE ELECTRONIQUE")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("POINTAGE ELECTRONIQUE");


		$default_style = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			)
			 
		);


		$default_style_ligne2 = array(
			'font' => array(
				'name' => 'Verdana',
				'color' => array('rgb' => '000000'),
				'size' => 10
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			),
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
					'color' => array('rgb' => '000000')
				)
			),
			 'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'ABABAB')
			 )
			 
		);

		$tHead1 = array(						
						'RANG'							=> 	'RANG', 
						'MATRICULE'						=> 	'MATRICULE',
						'NOM'							=> 	'NOM', 
						'PRENOM'						=> 	'PRENOM',
						'DEPARTEMENT'					=> 	'DEPARTEMENT',
						'NBR DE JOUR'					=> 	'NBR DE JOUR', 
						'HEURES_TOT'					=> 	'HEURES TOTALES TRAVAILLEES',
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:I1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:I2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:I3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('POINTAGE ELECTRONIQUE DU ' . $_zDateDebut . " au " . $_zDateFin));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:I5')->applyFromArray($default_style_ligne2);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iCol, $iRow, utf8_encode($zValue));
			$iCol++;
		}


		$iRow0 = 2 ; 
		$iCol0 = 2;
		$oArrayColumn = array();

		for($col = 'A'; $col !== 'Z'; $col++) {
			$objPHPExcel->getActiveSheet()
				->getColumnDimension($col)
				->setAutoSize(true);
		}

		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				  'allborders' => array(
					  'style' => PHPExcel_Style_Border::BORDER_THIN
				  )
			  )
		);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$iRowDynamic = 6 ; 
		foreach ($_toListe as $key=>$oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, ($key+1));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['path']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, "1");
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['total_heure_effectue']);
			$iRowDynamic++;
		}

		$callStartTime = microtime(true);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=pointage-electronique_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}
	
	
	public function print_report_pdf ($_toListe, $_zDateDebut, $_zDateFin) {

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("L");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 26;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',8);
			//$oPdf->SetY($Y_Fields_Name_position);

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('trebuc','');
			$oPdf->Ln();

			$oPdf->SetFont('trebuc','',8);

			$oPdf->SetX(45);
			$oPdf->Cell(200,7,'POINTAGE ELECTRONIQUE DU ' . $_zDateDebut . " au " . $_zDateFin ,0,0,'C',1);
			
			$oPdf->Ln();



			//=================================================================
			$oPdf->SetFont('trebuc','',8);


			$oPdf->SetX(10);
			$oPdf->Cell(20,7,'RANG',1,0,'C',1);

			$oPdf->SetX(30);
			$oPdf->Cell(20,7,'Matricule',1,0,'C',1);

			$oPdf->SetX(50);
			$oPdf->Cell(60,7,'Nom',1,0,'C',1);

			$oPdf->SetX(110);
			$oPdf->Cell(50,7,utf8_decode('Prénom'),1,0,'C',1);

			$oPdf->SetX(160);
			$oPdf->Cell(25,7,utf8_decode('Département'),1,0,'C',1);

			$oPdf->SetX(185);
			$oPdf->Cell(25,7,'Nbr de jour',1,0,'C',1);

			$oPdf->SetX(210);
			$oPdf->Cell(30,7,utf8_decode('Heures Total Travaillées'),1,0,'C',1);

			$oPdf->Ln();

			$oPdf->SetFillColor(255,255,255);
			//=================================================================
			$oPdf->SetFont('trebuc','',8);

			$i=0;
			foreach ($_toListe as $key=>$oListe) {

				$zBorder = "LR" ; 
				if ($i == 0) {
					$zBorder = "TLR";
				}
				
				if ($i == sizeof($_toListe)-1) {
					$zBorder = "BLR";
				}

				$oPdf->SetX(10);
				$oPdf->Cell(20,7,($key+1),$zBorder,0,'C',1);

				$oPdf->SetX(30);
				$oPdf->Cell(20,7,$oListe['matricule'],$zBorder,0,'C',1);

				$oPdf->SetX(50);
				$oPdf->Cell(60,7,utf8_decode($oListe['nom']),$zBorder,0,'C',1);

				$oPdf->SetX(110);
				$oPdf->Cell(50,7,utf8_decode($oListe['prenom']),$zBorder,0,'C',1);

				$oPdf->SetX(160);
				$oPdf->Cell(25,7,utf8_decode($oListe['path']),$zBorder,0,'C',1);

				$oPdf->SetX(185);
				$oPdf->Cell(30,7,"",$zBorder,0,'C',1);

				$oPdf->SetX(210);
				$oPdf->Cell(30,7,$oListe['total_heure_effectue'],$zBorder,0,'C',1);

				$oPdf->Ln();
				
				$i++;
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}
	
	
}
?>
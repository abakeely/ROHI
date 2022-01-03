<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
class Reporting_model extends CI_Model {
	
	
	public function __construct(){
		$this->load->database();
	}
	
	public function numberRows($mois,$annee){
		/*$sql= " SELECT count(*) as total
				  FROM Transactions.acc_monitor_log_".$annee." a
				  INNER JOIN rohi.candidat b
				   ON ( a.pin= b.matricule OR a.pin= substr(replace(b.cin,' ',''),4,12) )
				  AND b.path LIKE '%DGEP%'
				  AND MONTH(a.time)='".$mois."'
			  ";*/
		$sql= " SELECT count(*) as total
				  FROM Transactions.acc_monitor_log_".$annee." a
				  INNER JOIN rohi.candidat b
				   ON  a.pin= b.matricule 
				  AND b.path LIKE '%DGEP%'
				  AND MONTH(a.time)='".$mois."'
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
	
	public function findBy($mois,$annee,$ofset,$limit){
		/*$sql= " SELECT * 
				  FROM Transactions.acc_monitor_log_".$annee." a
				  INNER JOIN rohi.candidat b
				  ON ( a.pin= b.matricule OR a.pin= substr(replace(b.cin,' ',''),4,12) )
				  AND b.path LIKE '%DGEP%'
				  AND MONTH(a.time)='".$mois."'
				  LIMIT $ofset,$limit
				   ";*/
		$sql= " SELECT * 
				  FROM Transactions.acc_monitor_log_".$annee." a
				  INNER JOIN rohi.candidat b
				  ON  a.pin= b.matricule 
				  AND b.path LIKE '%DGEP%'
				  AND MONTH(a.time)='".$mois."'
				  LIMIT $ofset,$limit
				   ";
		//echo $sql;die;
		$query = $this->db->query($sql);
		return $query->result_array();	
	}

	
	public function setExcelRapports ($mois,$annee,$ofset,$limit) {

		require(APPLICATION_PATH ."/Classes/PHPExcel.php");

		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');
		ini_set('memory_limit', '-1'); 
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

		$objPHPExcel = new PHPExcel();

		// Set document properties
		echo date('H:i:s') , " Set document properties" , EOL;
		$objPHPExcel->getProperties()->setCreator("ABRAHAM")
									 ->setLastModifiedBy("ABRAHAM")
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
						'IDENTIFIANT'					=> 	'IDENTIFIANT', 
						'TIME'							=> 	'TIME',
						'PIN'							=> 	'PIN', 
						'STATUT'						=> 	'STATUT',
						'EVENT_POINT_NAME'				=> 	'EVENT_POINT_NAME'
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:I1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:I2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:I3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:I3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('POINTAGE ELECTRONIQUE'));

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

		$_toListe			=	$this->findBy($mois,$annee,$ofset,$limit);
		//print_r($_toListe);die;
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$iRowDynamic = 4 ; 
		foreach ($_toListe as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $iRowDynamic);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['time']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['matricule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['state']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['event_point_name']);
	
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=pointage-electronique_".$ofset.".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}
	

}
?>

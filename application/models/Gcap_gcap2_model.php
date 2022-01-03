<?php
class Gcap_gcap2_model extends CI_Model {
	
	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($_oDataGcap)
	{
		global $db;
		$zBase = $db['gcap']['database'] ;
		$zTable = "gcap2";
		if($this->db->insert($zBase.".".$zTable, $_oDataGcap)){
			return $this->db->insert_id();
		}else return false;
	}

	public function getUserId($_iCin){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseRohi =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql= " SELECT user_id,REPLACE(cin,' ','') as iCin FROM $zDatabaseRohi.candidat WHERE 1 HAVING iCin= '".$_iCin."' LIMIT 0,1";

		$oRow = array();
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iUserId = 0;
		if(sizeof($toRow)>0){
			$iUserId = $toRow[0]['user_id'];
		}

		return $iUserId;

	}

	public function get_candidat_by_cin_matricule($_iCin = FALSE, $_iMatricule = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select candidat.nom, candidat.prenom, user_id as iUserId,cin from $zDatabaseOrigin.candidat WHERE 1=1 ";

		if($_iCin){
			$sql .= " AND 1 AND cin = '$_iCin' " ;
		}

		if($_iMatricule != ''){
			$sql .= " AND  matricule = '$_iMatricule'" ;
		}

		$sql .= " LIMIT 0,1" ; 

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function getCandidatCinMatricule($_iCin = FALSE, $_iMatricule = '',$_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select REPLACE(cin,' ','') AS cin,candidat.nom, candidat.prenom, user_id as iUserId,cin,id,type_photo from $zDatabaseOrigin.candidat WHERE 1=1 ";

		if($_iCin){
			$sql .= " HAVING 1 AND cin = '$_iCin' " ;
		}

		if($_iMatricule != ''){
			$sql .= " AND  matricule = '$_iMatricule'" ;
		}

		if($_zNom){
			$sql .= " AND lower(candidat.nom)  like '%".utf8_decode(strtolower($_zNom))."%' " ;
		}

		if($_zPrenom != ''){

			$toPrenom = explode(" ",$_zPrenom);
			if(sizeof($toPrenom)>0){
				$sql .= " AND lower(candidat.prenom) like '%".utf8_decode(strtolower($toPrenom[0]))."%' " ;
			} else {
				$sql .= " AND lower(candidat.prenom)  like '%".utf8_decode(strtolower($_zPrenom))."%' " ;
			}
		}

		$sql .= " LIMIT 0,1" ; 
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_TypeGcap_by_Libelle($_zLibelle){
		
		global $db;
		$zBase =  $db['gcap']['database'] ;
		$zTable = "typegcap";
		$zSql= "SELECT * FROM ".$zBase.".".$zTable." WHERE typeGcap_libelle ='$_zLibelle'";
		//print_r($zSql."<br>");
		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available
		return $oRow;
	}

	public function get_Type_by_Libelle($_zLibelle){
		
		global $db;
		$zBase =  $db['gcap']['database'] ;
		$zTable = "type";
		$zSql= "SELECT * FROM ".$zBase.".".$zTable." WHERE type_libelle ='$_zLibelle'";
		
		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available
		return $oRow;
	}

	public function testEnregistrement($_oInsertion){
		
		global $db;
		$zBase =  $db['gcap']['database'] ;
		$zTable = "gcap2";
		$zSql= "SELECT * FROM ".$zBase.".".$zTable." WHERE gcap_userSendId ='".$_oInsertion['gcap_userSendId']."' AND gcap_typeGcapId = '".$_oInsertion['gcap_typeGcapId']."' AND gcap_dateDebut = '".$_oInsertion['gcap_dateDebut']."' AND gcap_dateFin = '".$_oInsertion['gcap_dateFin']."' ";
		
		$oQuery = $this->db->query($zSql);
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available
		return $oRow;
	}


	public function getCandidatCinSANSLIKEMatricule($_iCin = FALSE, $_iMatricule = '',$_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select REPLACE(cin,' ','') AS cin,candidat.nom, candidat.prenom, user_id as iUserId,cin,id,type_photo from $zDatabaseOrigin.candidat WHERE 1=1 ";

		if($_iCin){
			$sql .= " HAVING 1 AND cin = '$_iCin' " ;
		}

		if($_iMatricule != ''){
			$sql .= " AND  matricule = '$_iMatricule'" ;
		} 

		if($_zNom){
			$sql .= " AND CONVERT(LOWER(`nom`) USING utf8) like '%".strtolower($_zNom)."%' " ;
		}

		if($_zPrenom != ''){

			$toPrenom = explode(" ",$_zPrenom);
			if(sizeof($toPrenom)>0){
				$sql .= " AND CONVERT(LOWER(`prenom`) USING utf8) like '%".strtolower($toPrenom[0])."%' " ;
			} else {
				$sql .= " AND CONVERT(LOWER(`prenom`) USING utf8)  like '%".strtolower($_zPrenom)."%' " ;
			}
		}

		$sql .= " LIMIT 0,1" ; 

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function getCandidatNomPrenom($_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select REPLACE(cin,' ','') AS cin,candidat.nom, candidat.prenom, user_id as iUserId,cin,id,type_photo from $zDatabaseOrigin.candidat WHERE 1=1 ";

		if($_zNom){
			$sql .= " AND lower(candidat.nom)  like '%".strtolower($_zNom)."%' " ;
		}

		if($_zPrenom != ''){

			$toPrenom = explode(" ",$_zPrenom);
			if(sizeof($toPrenom)>0){
				$sql .= " AND lower(candidat.prenom) like '%".strtolower($toPrenom[0])."%' " ;
			} else {
				$sql .= " AND lower(candidat.prenom)  like '%".strtolower($_zPrenom)."%' " ;
			}
		}

		$sql .= " LIMIT 0,1" ; 

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_by_gcap_id($_iGcapId){
        global $db;
        $zDatabaseOrigin =  $db['default']['database'] ; 
		$zBase = $db['gcap']['database'] ;
		$zSql= "select * from $zBase.gcap2 where gcap_id = $_iGcapId ORDER BY gcap_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	
	public function get_Gcap($iId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($iId === FALSE)
		{
			$zQuery = $DB1->get('gcap2');
			return $zQuery->result_array();
		}

		$zQuery = $DB1->get_where('gcap2', array('gcap_id' => $iId));
		return $zQuery->row_array();
	}

	public function get_Gcap_pagination(&$_iNbrTotal = 0)
	{
		global $db;
		$zBase =  $db['gcap']['database'] ;
		$zBaseOrigin =  $db['default']['database'] ;
		$zTableOrign = "candidat";
		$zTable = "gcap2";
		
		$oRequest = $_REQUEST;

		$zSql = "SELECT SQL_CALC_FOUND_ROWS g.*, c.nom, c.prenom,c.matricule,c.cin,tg.typeGcap_libelle,t.type_libelle,dep.sigle_departement,dir.sigle_direction ";  
		$zSql = $zSql."FROM $zBase.$zTable as g LEFT JOIN ";
		$zSql = $zSql."$zBaseOrigin.$zTableOrign as c ON c.user_id = g.gcap_userSendId LEFT JOIN ";
		$zSql = $zSql."$zBase.typegcap as tg ON tg.typeGcap_id = g.gcap_typeGcapId LEFT JOIN ";
		$zSql = $zSql."$zBase.type as t ON t.type_id = g.gcap_typeId LEFT JOIN ";
		$zSql = $zSql."$zBaseOrigin.departement as dep ON c.departement = dep.id LEFT JOIN ";
		$zSql = $zSql."$zBaseOrigin.direction as dir ON c.direction = dir.id";

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" WHERE ( c.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.matricule LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.cin LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR dep.sigle_departement LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR dir.sigle_direction LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR tg.typeGcap_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR t.type_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR g.gcap_motif LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR g.gcap_lieuJouissance LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR g.gcap_pieceJointe LIKE '%".$oRequest['search']['value']."%')";
		}
		
		if (sizeof($oRequest)>0)
		{
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir']))
			{
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} 
			else
			{
				$zSql.=" ORDER BY g.gcap_id DESC";
			}


			if (isset($oRequest['start']))
			{
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
			else
			{
				$zSql.=" LIMIT 0,10   ";
			}
		} 
		else 
		{
			$zSql.=" ORDER BY g.gcap_id DESC ";
			$zSql.=" LIMIT 0,10   ";
		}

		$zQuery = $this->db->query($zSql);
		$result = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $this->db->query($zQueryDataCount) ;
        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $result;
	}
	
	public function get_Gcap_UserId($iId, $sDateDebut, $sDateFin){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zQuery = $DB1->get_where('gcap2', array('gcap_userSendId' => $iId, 'gcap_dateDebut' => $sDateDebut, 'gcap_dateFin' => $sDateFin));
		return $zQuery->row_array();
    }


	public function setExcelExportFichePoste ($_toListe) {

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
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRHA")
									 ->setLastModifiedBy("TOJO MICHAEL DRHA")
									 ->setTitle("FICHE DE POSTE")
									 ->setSubject("FICHE DE POSTE")
									 ->setDescription("FICHE DE POSTE")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("FICHE DE POSTE");


		// Add some data

		/*$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A2', 'Client')
					->setCellValue('B2', 'Projet');*/


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
						'DIRECTION'						=> 	'DIRECTION', 
						'NOM'							=> 	'NOM', 
						'PRENOMS'						=> 	'PRENOMS',
						'IDENTIFIANT'					=> 	'IDENTIFIANT', 
						'INTITULE DE POSTE'				=> 	'INTITULE DE POSTE', 
						'MISSIONS'						=> 	'MISSIONS',
						'ACTIVITES'						=> 	'ACTIVITES', 
						'ENCADREMENT POSTE'				=> 	'EXIGENCE POSTE NIVEAU',
						'EXIGENCE POSTE NIVEAU'			=> 	'EXIGENCE POSTE NIVEAU',
						'EXIGENCE POSTE EXPERIENCCE'	=> 	'EXIGENCE POSTE EXPERIENCCE', 
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:J1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:J2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));


		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:J5')->applyFromArray($default_style_ligne2);
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

		//$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('E')->setWidth('900');

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
		foreach ($_toListe as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['direction']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['user_id']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['fichePoste_intitule']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['mission']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['Activite']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['encadrement']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $iRowDynamic, $oListe['ExigenceNiveau']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $iRowDynamic, $oListe['ExigenceExperience']);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('H'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('I'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('J'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=fiche-de-poste-".$oListe['departement']."-".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}



}
?>
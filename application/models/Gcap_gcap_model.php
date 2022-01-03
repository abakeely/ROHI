<?php
class Gcap_gcap_model extends CI_Model {
	
	public function __construct(){
		$this->load->database('gcap');
		$this->load->model('candidat_parcours_model','candidat_parcours');
	}
	
	public function insert($oDataGcap){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.gcap', $oDataGcap)){
			$iGcapId = $this->db->insert_id();
		//	$this->insertGcapZkGcap($iGcapId);
			return $iGcapId ;
		}else return false;
	}

	public function insertDetache($oDataDetache){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.detache', $oDataDetache)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertCodeCorps($oDataDetache){
		global $db;
		$zDatabaseRohi =  $db['default']['database'] ;
		if($this->db->insert($zDatabaseRohi.'.codecorps', $oDataDetache)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertevaluationNoteEtCadre($oData){
		global $db;
		$zDatabaseRohi =  $db['default']['database'] ;
		if($this->db->insert($zDatabaseRohi.'.evaluateurevaluer', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertSansPhoto($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.sansphoto', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function UpdateUserSansPhoto($_iSansId,$_iStatut){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSqlUpdate= " UPDATE $zDatabaseGcap.sansphoto SET sans_isSend = ".$_iStatut." WHERE sans_id = " . $_iSansId; 	

		$DB1->query($zSqlUpdate);
		

	}

	public function getUserSansPhotoSendMail(){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseRohi =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql= " SELECT sans_id,user_id,nom,prenom,sans_email,matricule FROM $zDatabaseGcap.sansphoto,$zDatabaseRohi.candidat WHERE sans_matricule = matricule AND sans_isSend = 0 LIMIT 0,10";

		$oRow = array();
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;

	}

	public function miseAJourConfirmationBadge(){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "SELECT * FROM rohi.confirmationbadge ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		foreach ($toRow as $oRow){
			$zSql  = " UPDATE rohi.candidat SET departement = '" . $oRow['confirmationBadge_departement'] . "', direction = '" . $oRow['confirmationBadge_direction'] . "'
			, service = '" . $oRow['confirmationBadge_service'] . "'
			WHERE user_id = " .$oRow['confirmationBadge_userId'] ;

			echo $zSql . "<br>" ; 
			$this->db->query($zSql);
		}

		return $toHome ; 

	}

	public function insertQuestionnaire($oQuestion){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.question', $oQuestion)){
			return $this->db->insert_id();
		}else return false;
	}

	public function updateQuestionnaire($oData, $_iQuestionId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.question', $oData, "question_id = $_iQuestionId");
	}

	/***************************************************/

	public function testChampFormulaire($_oFormulaire){

		$iSessionCaptcha = $_SESSION['user_phrase'];
		$zCaptcha = $_oFormulaire['zCaptcha'];

		if ($zCaptcha != $iSessionCaptcha){
			return 2;
		} else {
		}
	}

	public function testChampFicheDePoste($_oFormulaire){

		$iSessionCaptcha = $_SESSION['user_phrase'];
		$zCaptcha = $_oFormulaire['zCaptcha'];

		if ($zCaptcha != $iSessionCaptcha){
			return 2;
		} else {
		}
	}

	public function insertMission($oData, $_iMissionId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->insert($zDatabaseGcap.'.missionposte', $oData);
	}

	public function updateMission($oData, $_iMissionId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.missionposte', $oData, "missionPoste_id = $_iMissionId");
	}

	public function updateFicheDePoste($oData, $_iFichePosteId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.ficheposte', $oData, "fichePoste_id = $_iFichePosteId");
	}

	public function deleteMission($_iMissionId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->query('delete from '.$zDatabaseGcap.'.missionposte where missionPoste_id = '.$_iMissionId);
	}

	public function insertActivite($oData, $_iActiviteId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->insert($zDatabaseGcap.'.activiteposte', $oData);
	}

	public function updateActivite($oData, $_iActiviteId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.activiteposte', $oData, "activitePoste_id = $_iActiviteId");
	}

	public function deleteActivite($_iActiviteId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->query('delete from '.$zDatabaseGcap.'.activiteposte where activitePoste_id = '.$_iActiviteId);
	}

	public function insertEncadrement($oData, $_iEncadrementId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->insert($zDatabaseGcap.'.encadrementposte', $oData);
	}

	public function updateEncadrement($oData, $_iEncadrementId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.encadrementposte', $oData, "encadrementPoste_id = $_iEncadrementId");
	}

	public function deleteEncadrement($_iEncadrementId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->query('delete from '.$zDatabaseGcap.'.encadrementposte where encadrementPoste_id = '.$_iEncadrementId); 
	}

	public function insertExigence($oData, $_iExigenceId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->insert($zDatabaseGcap.'.exigenceposte', $oData);
	}

	public function updateExigence($oData, $_iExigenceId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap . '.exigenceposte', $oData, "exigencePoste_id = $_iExigenceId");
	}

	public function deleteExigence($_iExigenceId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->query('delete from '.$zDatabaseGcap.'.exigenceposte where exigencePoste_id = '.$_iExigenceId); 
	}

	public function insertFichePoste($oFormulaire){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$toFormulaire = array();
		array_push($toFormulaire, $oFormulaire);

		$oFichePoste = array();
		$oFichePoste['fichePoste_userId'] = $oFormulaire['fichePoste_userId'];
		$oFichePoste['fichePoste_date'] = date("Y-m-d H:i:s");
		$oFichePoste['fichePoste_intitule'] = $oFormulaire['question_a'];

		if($this->db->insert($zDatabaseGcap.'.ficheposte', $oFichePoste)){
			$iFichePosteId =  $this->db->insert_id();

			for($iIncrement=1;$iIncrement<=$oFormulaire['iIncrement_b'];$iIncrement++){
				$oMission = array();
				$oMission['missionPoste_fichePosteId'] = $iFichePosteId;
				$oMission['missionPoste_userId'] = $oFormulaire['fichePoste_userId'];
				$oMission['missionPoste_text'] = $oFormulaire['question_b_'.$iIncrement];
				$this->db->insert($zDatabaseGcap.'.missionposte', $oMission);
			}

			for($iIncrement=1;$iIncrement<=$oFormulaire['iIncrement_c'];$iIncrement++){
				$oActivite = array();
				$oActivite['activitePoste_fichePosteId'] = $iFichePosteId;
				$oActivite['activitePoste_userId'] = $oFormulaire['fichePoste_userId'];
				$oActivite['activitePoste_text'] = $oFormulaire['question_c_'.$iIncrement];
				$this->db->insert($zDatabaseGcap.'.activiteposte', $oActivite);
			}

			for($iIncrement=1;$iIncrement<=$oFormulaire['iIncrement_d'];$iIncrement++){
				$oEncadrement = array();
				$oEncadrement['encadrementPoste_fichePosteId'] = $iFichePosteId;
				$oEncadrement['encadrementPoste_userId'] = $oFormulaire['fichePoste_userId'];
				$oEncadrement['encadrementPoste_text'] = $oFormulaire['question_d_'.$iIncrement];
				$this->db->insert($zDatabaseGcap.'.encadrementposte', $oEncadrement);
			}

			for($iIncrement=1;$iIncrement<=$oFormulaire['iIncrement_e'];$iIncrement++){
				$oExigence = array();
				$oExigence['exigencePoste_fichePosteId'] = $iFichePosteId;
				$oExigence['exigencePoste_userId'] = $oFormulaire['fichePoste_userId'];
				$oExigence['exigencePoste_niveau'] = $oFormulaire['question_e_1_'.$iIncrement];
				$oExigence['exigencePoste_experience'] = $oFormulaire['question_e_2_'.$iIncrement];
				$this->db->insert($zDatabaseGcap.'.exigenceposte', $oExigence);
			}


		}else return false;
	}

	/***************************************************/

	public function insertMic($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.gcap_mic', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insert2($oDataGcap){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('gcap_autres', $oDataGcap)){
			return $DB1->insert_id();
		}else return false;
	}

	public function executeQueryZKGcap($_zSql){

		$oConnection	= $this->load->database('zKGcap', TRUE);
		$zError			= odbc_exec($oConnection->conn_id,$_zSql) or die('Maintenance '); 
	}

	function insertGcapPointage($_oGcapAll){

		$zSql = " INSERT INTO [ZKGcap].[dbo].[gcap] VALUES ( ";
		$zSql .= " '".$_oGcapAll['gcap_id']."', ";
		$zSql .= " '".$_oGcapAll['gcap_userSendId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_typeGcapId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_typeId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateDebut']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateFin']."', ";
		$zSql .= " '".utf8_decode(str_replace("'","''",$_oGcapAll['gcap_motif']))."', ";
		$zSql .= " '".utf8_decode(str_replace("'","''",$_oGcapAll['gcap_lieuJouissance']))."', ";
		$zSql .= " '".$_oGcapAll['gcap_statutId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_userValidId']."', ";
		$zSql .= " '".$_oGcapAll['gcap_dateValidation']."', ";
		$zSql .= " '".$_oGcapAll['gcap_valide']."', ";
		$zSql .= " '".$_oGcapAll['gcap_vue']."', ";
		$zSql .= " '".utf8_decode(str_replace("'","''",$_oGcapAll['gcap_autorisaionCaracteristique']))."', ";
		$zSql .= " '".$_oGcapAll['gcap_MatinSoir']."', ";
		$zSql .= " '".$_oGcapAll['gcap_demiJournee']."', ";
		$zSql .= " '".utf8_decode(str_replace("'","''",$_oGcapAll['conv_pers']))."', ";
		$zSql .= " '".$_oGcapAll['matricule']."') ";
		$this->executeQueryZKGcap($zSql);
	}

	function deleteGcapPointage($_iGcapId){

		$zSql = " DELETE FROM [ZKGcap].[dbo].[gcap] WHERE gcap_id = " . $_iGcapId;
		$this->executeQueryZKGcap($zSql);
	}

	function insertGcapZkGcap($_iGcapId){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= "SELECT g.*,IF(STRCMP(matricule,'ECD'),matricule,SUBSTRING(REPLACE(cin,' ',''), 4, 9)) AS matricule FROM $zDatabaseGcap.gcap g LEFT JOIN $zDatabaseOrigin.candidat c ON g.gcap_userSendId = c.user_id  WHERE gcap_id = " . $_iGcapId ;

		$zQuery = $this->db->query($zSql);
		$toGcapAll =  $zQuery->result_array();
		$zQuery->free_result(); 

		$iIncrement = 0;
		foreach ($toGcapAll as $oGcapAll){
			$this->insertGcapPointage($oGcapAll);
			$iIncrement++;
		}

		return $toGcapAll ; 
	}

	function getAllFichePoste($iDepartement=0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		/*$zSql= " SELECT candidat.nom,candidat.prenom,candidat.matricule,fichePoste_id, fichePoste_userId,fichePoste_intitule,missionPoste_text,activitePoste_text,encadrementPoste_text, exigencePoste_niveau,exigencePoste_experience
				FROM $zDatabaseGcap.ficheposte 
				INNER JOIN $zDatabaseOrigin.candidat ON fichePoste_userId = candidat.user_id 
				INNER JOIN $zDatabaseGcap.missionposte ON missionPoste_fichePosteId = fichePoste_id
				INNER JOIN $zDatabaseGcap.activiteposte ON activitePoste_fichePosteId = fichePoste_id
				INNER JOIN $zDatabaseGcap.encadrementposte ON  encadrementPoste_fichePosteId = fichePoste_id
				INNER JOIN $zDatabaseGcap.exigenceposte ON exigencePoste_fichePosteId = fichePoste_id 
				WHERE direction = 3 ";

		$zSql .= " ORDER BY fichePoste_id" ;
		echo $zSql;

		die();*/


		$zSql= " SELECT direction.libele as direction,departement.libele as departement,candidat.nom,candidat.prenom,candidat.user_id,fichePoste_id, fichePoste_userId,fichePoste_intitule,
				(SELECT GROUP_CONCAT(missionPoste_text SEPARATOR '\t\r\n') FROM $zDatabaseGcap.missionposte WHERE missionPoste_fichePosteId = fichePoste_id  ) AS mission,
				(SELECT GROUP_CONCAT(activitePoste_text SEPARATOR '\t\r\n') FROM $zDatabaseGcap.activiteposte WHERE activitePoste_fichePosteId = fichePoste_id  ) AS Activite,
				(SELECT GROUP_CONCAT(encadrementPoste_text SEPARATOR '\t\r\n') FROM $zDatabaseGcap.encadrementposte WHERE encadrementPoste_fichePosteId = fichePoste_id  ) AS encadrement,
				(SELECT GROUP_CONCAT(exigencePoste_niveau SEPARATOR '\t\r\n') FROM $zDatabaseGcap.exigenceposte WHERE exigencePoste_fichePosteId = fichePoste_id  ) AS ExigenceNiveau,
				(SELECT GROUP_CONCAT(exigencePoste_experience SEPARATOR '\t\r\n') FROM $zDatabaseGcap.exigenceposte WHERE exigencePoste_fichePosteId = fichePoste_id  ) AS ExigenceExperience
				FROM $zDatabaseGcap.ficheposte 
				INNER JOIN $zDatabaseOrigin.candidat ON fichePoste_userId = candidat.user_id 
				INNER JOIN $zDatabaseOrigin.departement ON departement.id = candidat.departement
				INNER JOIN $zDatabaseOrigin.direction ON direction.id = candidat.direction
				INNER JOIN $zDatabaseGcap.exigenceposte ON exigencePoste_fichePosteId = fichePoste_id WHERE candidat.service = 2  GROUP BY candidat.user_id ORDER BY direction.libele ASC ";


		$zQuery = $this->db->query($zSql);
		$togetAllFichePoste =  $zQuery->result_array();
		
		return $togetAllFichePoste ; 
	}


	function getAllFichePosteRecrutement(){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT direction.libele as direction,departement.libele as departement,candidat.nom,candidat.prenom,candidat.user_id,fichePoste_id, fichePoste_userId,fichePoste_intitule
				 FROM $zDatabaseOrigin.candidat 
				 LEFT JOIN $zDatabaseOrigin.departement ON departement.id = candidat.departement
				 LEFT JOIN $zDatabaseOrigin.direction ON direction.id = candidat.direction
				 LEFT JOIN $zDatabaseGcap.ficheposte ON fichePoste_userId = candidat.user_id  WHERE 
				 
				 
candidat.matricule IN (

372803,
373176,
373177,
374983,
374985,
374986,
374987,
382104,
382105,
382106,
382107,
382108,
382109,
382110,
382111,
295084,
374984,
374988,
318028,
375264,
375265,
393115,
407642,
407644,
407646,
407704,
386315,
372243,
382789,
289239,
310699,
314238,
329421,
334084,
375263,
375266,
407648,
387913,
270995,
290821,
305819,
323522,
330314,
334416,
334617,
334738,
345067,
353060,
354845,
355445,
355504,
356751,
357017,
357019,
357023,
357210,
357211,
357212,
357213,
357630,
357631,
357632,
357633,
357634,
357850,
357927,
370140,
370405,
371063,
371921,
372239,
372242,
372654,
372655,
372762,
372815,
373081,
373082,
373084,
373085,
373966,
374630,
374648,
374731,
374912,
374913,
374914,
375205,
375206,
375207,
375208,
375209,
375211,
375212,
375213,
375214,
375215,
375216,
375249,
375250,
375251,
375252,
375253,
375567,
375568,
375569,
375570,
375571,
375572,
375573,
375574,
375575,
375576,
375577,
375578,
375579,
375580,
375581,
375582,
375583,
375585,
375586,
375616,
376482,
376483,
376484,
376485,
376486,
376487,
376488,
376489,
376490,
376492,
376493,
376644,
376868,
376882,
376884,
376885,
376907,
376908,
376909,
376910,
376911,
376912,
377066,
377067,
377068,
377069,
377116,
377154,
377851,
377852,
377853,
377854,
377855,
377856,
377857,
382787,
382788,
382790,
382791,
382792,
382793,
382794,
382795,
384798,
384799,
384800,
384801,
384802,
384803,
386311,
386313,
386314,
386316,
386317,
386318,
386319,
386320,
386321,
387908,
387909,
387911,
387912,
388550,
389278,
389610,
390023,
390024,
390025,
390246,
390555,
390677,
391630,
391631,
391633,
391634,
391635,
391636,
391637,
391746,
391747,
391748,
391749,
391750,
391751,
391752,
392148,
392149,
392150,
404609,
404610,
409228,
409229,
409230,
409231,
409232,
409367,
409368,
409369,
375584,
245371,
356753,
378466,
409366,
368799,
299940,
353581,
374833,
275152,
357018,
357208,
387910,
337717,
372475,
372476,
372477,
372478,
372479,
372686,
372687,
372688,
372689,
372690,
372691,
372833,
372834,
372891,
372892,
372893,
372894,
372895,
372896,
372897,
372898,
372899,
372901,
372902,
372903,
372904,
373925,
373959,
373973,
373974,
373975,
374196,
374197,
374199,
374200,
374201,
374202,
374203,
374569,
374571,
374572,
374573,
374574,
374575,
374649,
374861,
374862,
375083,
375084,
375478,
390503,
330305,
374570,
309637,
311650,
328581,
330547,
352600,
354076,
356881,
357656,
357657,
357658,
357659,
357660,
357661,
357662,
357663,
357664,
357665,
357666,
357667,
357668,
357669,
357670,
357671,
357672,
357673,
357674,
357675,
357676,
357677,
374068,
374069,
374070,
374071,
374072,
374895,
374896,
374897,
374898,
374899,
374900,
374901,
374902,
374903,
374904,
374905,
374975,
374976,
374977,
374978,
374979,
374980,
374981,
374982,
375481,
375482,
375483,
375484,
375485,
377006,
379845,
379846,
371920,
372244,
250686,
278681,
283884,
290691,
297915,
301688,
302702,
304151,
323571,
339739,
343439,
354891,
355470,
360085,
371585,
371781,
371782,
371888,
372381,
372382,
372383,
372384,
372385,
372386,
372387,
372388,
372389,
372390,
372391,
372392,
372393,
372394,
372395,
372396,
372397,
372398,
372399,
372400,
372401,
372418,
372419,
372420,
372421,
372422,
372423,
372425,
372426,
372427,
372428,
372740,
372741,
372742,
372743,
372744,
372745,
372747,
372748,
372749,
372926,
372927,
372928,
372929,
372930,
372931,
372933,
372934,
372935,
372936,
373053,
373054,
373055,
373056,
373058,
373059,
373060,
373061,
373062,
373063,
373064,
373168,
373169,
373170,
373171,
373172,
373173,
373174,
373969,
374181,
374182,
374183,
374184,
374185,
374186,
374187,
374189,
374190,
374191,
374192,
374293,
374294,
374295,
374296,
374297,
374298,
374501,
374502,
374503,
374504,
374505,
374506,
374507,
374508,
374509,
374510,
374511,
374512,
374513,
374514,
374515,
374516,
374517,
374518,
374519,
374520,
374521,
374522,
374542,
374543,
374544,
374545,
374546,
374547,
374548,
374549,
374550,
374551,
374552,
374553,
374554,
374556,
374557,
374558,
374597,
374598,
374599,
374600,
374601,
374603,
374604,
374605,
374606,
374607,
374608,
374609,
374610,
374611,
374612,
374613,
374614,
374615,
374616,
374617,
374641,
374642,
374643,
374644,
374645,
374646,
374647,
374672,
374673,
374674,
374675,
374677,
374678,
374679,
374680,
374681,
374682,
374683,
374684,
374685,
374686,
374687,
374688,
374689,
374690,
374691,
374693,
374694,
374695,
374696,
374697,
374698,
374719,
374720,
374721,
374759,
374760,
374761,
374762,
374763,
374764,
374834,
374837,
374838,
374839,
374840,
374867,
374868,
374869,
374870,
374871,
374872,
374873,
374874,
374875,
374876,
374907,
374908,
374909,
374910,
374911,
374937,
374938,
374939,
374940,
374941,
374942,
374943,
374944,
374945,
374996,
374997,
375071,
375072,
375073,
375074,
375142,
375143,
375380,
375381,
375382,
375383,
375384,
375385,
375386,
375387,
375499,
375500,
375501,
375502,
375503,
375504,
375693,
375701,
375702,
375703,
375765,
376694,
376710,
376948,
377091,
377092,
377182,
380240,
380241,
380244,
380245,
380246,
380247,
380248,
380249,
380250,
380251,
380252,
380253,
380255,
380256,
380257,
380258,
380259,
380260,
380261,
380262,
380263,
380264,
380265,
383863,
383864,
383866,
383867,
384057,
384058,
384060,
384061,
384063,
384064,
384065,
384066,
384067,
384068,
384069,
384129,
384850,
384851,
384852,
384853,
386053,
386296,
386297,
386298,
386299,
386301,
386302,
386303,
386304,
386305,
386306,
386307,
386308,
386309,
386310,
386312,
386322,
388054,
388058,
388059,
389277,
389279,
389665,
389667,
389668,
389672,
389673,
389674,
389983,
391618,
391621,
391622,
391623,
391624,
391827,
392344,
392345,
392346,
392348,
402196,
405568,
405571,
405574,
405578,
405581,
405583,
405589,
405594,
405596,
405601,
405602,
405605,
405607,
405610,
405892,
405893,
405894,
405895,
405896,
405898,
405899,
405903,
405904,
405905,
405906,
405909,
405910,
405911,
405912,
405915,
405916,
405919,
405920,
405921,
405924,
405926,
405929,
405931,
405934,
405935,
405937,
407537,
407540,
407687,
407689,
407695,
407699,
407706,
407709,
407713,
407715,
407717,
407719,
407720,
407727,
407729,
408278,
408280,
408282,
408283,
408288,
408289,
408291,
408293,
408294,
408295,
408296,
408297,
408298,
408299,
408300,
408302,
408303,
408304,
408305,
408307,
408308,
408310,
408312,
408316,
408318,
408319,
408321,
408324,
408325,
408330,
408331,
408335,
408337,
408340,
408341,
408343,
408344,
408345,
408346,
408347,
408350,
408352,
408353,
408354,
408355,
408356,
408580,
408583,
408587,
408589,
324638,
389666,
389670,
389671,
355857,
391620,
282461,
282483,
285899,
290982,
294837,
294846,
294857,
294859,
294868,
295236,
302024,
302067,
303861,
304518,
305953,
306159,
306168,
317435,
317460,
317462,
318298,
318308,
318655,
318657,
318660,
318675,
318678,
318690,
318691,
318695,
324323,
324698,
329559,
333609,
333644,
333656,
333663,
335946,
336113,
337157,
339312,
339718,
342424,
343359,
348561,
352106,
352799,
353232,
355164,
355226,
355370,
356300,
356301,
356302,
356303,
356304,
356305,
356306,
356307,
356308,
356309,
356310,
356311,
357026,
357027,
362230,
362231,
362232,
362233,
362234,
368718,
370136,
370293,
370348,
370349,
370350,
370392,
372344,
372345,
372346,
372347,
372348,
372840,
372841,
372842,
372843,
372844,
372846,
372847,
372848,
372849,
373079,
373175,
374256,
374257,
374692,
376060,
376061,
376062,
376063,
376064,
376065,
376066,
376067,
376068,
376069,
376070,
376071,
376072,
376073,
376074,
376075,
376076,
376077,
376078,
376079,
376080,
376081,
376082,
376083,
376084,
376085,
376086,
376087,
376088,
376089,
376090,
376091,
376092,
376093,
376094,
376095,
376096,
376097,
376098,
376099,
376100,
376101,
376102,
376103,
376104,
376105,
376106,
376107,
376108,
376109,
376110,
376111,
376112,
376113,
376114,
376115,
376116,
376117,
376118,
376119,
376120,
376121,
376122,
376123,
376124,
376125,
376126,
376127,
376128,
376129,
376130,
376131,
376132,
376133,
376134,
376135,
376136,
376137,
376138,
376139,
376140,
376141,
376142,
376143,
376144,
376145,
376146,
376147,
376148,
376149,
376150,
376151,
376152,
376153,
376154,
376155,
376156,
376157,
376158,
376159,
376160,
376161,
376162,
376163,
376164,
376165,
376166,
376167,
376168,
376169,
376170,
376171,
376172,
376173,
376174,
376175,
376176,
376177,
376178,
376179,
376180,
376181,
376182,
376183,
376184,
376185,
376186,
376187,
376188,
376189,
376190,
376191,
376192,
376193,
376194,
376195,
376196,
376197,
376198,
376199,
376200,
376201,
376202,
376203,
376204,
376205,
376206,
376207,
376208,
376209,
376210,
376211,
376212,
376213,
376214,
376215,
376216,
376217,
376218,
376219,
376220,
376221,
376222,
376223,
376224,
376225,
376226,
376227,
376228,
376229,
376230,
376231,
376232,
376233,
376234,
376235,
376236,
376237,
376238,
376239,
376240,
376241,
376242,
376243,
376244,
376245,
376246,
376247,
376248,
376249,
376250,
376251,
376252,
376253,
376254,
376255,
376256,
376257,
376258,
376259,
376260,
376261,
376262,
376263,
376264,
376265,
376266,
376267,
376268,
376269,
376270,
376271,
376272,
376273,
376274,
376275,
376276,
376277,
376278,
376279,
376280,
376281,
376282,
376283,
376284,
376285,
376286,
376287,
376288,
376289,
376290,
376291,
376292,
376293,
376294,
376295,
376296,
376297,
376298,
376299,
376300,
376301,
376302,
376303,
376304,
376305,
376306,
376307,
376308,
376310,
376311,
376312,
376313,
376314,
376315,
376317,
376318,
376319,
376320,
376321,
376322,
376323,
376324,
376325,
376326,
376327,
376328,
376329,
376330,
376331,
376332,
376333,
376334,
376335,
376336,
376337,
376338,
376339,
376340,
376341,
376342,
376343,
376344,
376345,
376346,
376347,
376348,
376349,
376350,
376351,
376352,
376353,
376354,
376355,
376356,
376357,
376358,
376359,
376360,
376361,
376362,
376363,
376364,
376365,
376366,
376367,
376368,
376369,
376370,
376371,
376372,
376373,
376374,
376375,
376376,
376377,
376378,
376379,
376380,
376381,
376382,
376383,
376384,
376385,
376386,
376387,
376388,
376389,
376390,
376391,
376392,
376393,
376394,
376395,
376396,
376397,
376398,
376399,
376400,
376401,
376402,
376403,
376404,
376405,
376406,
376407,
376408,
376409,
376410,
376411,
376412,
376413,
376414,
376415,
376416,
376474,
391838,
391839,
391840,
391841,
391842,
391843,
391844,
391845,
391846,
391847,
391848,
391849,
391850,
391851,
391852,
391853,
391854,
391855,
391856,
391857,
391858,
391859,
391913,
391914,
391915,
391916,
391917,
391918,
391919,
391920,
391921,
391922,
391923,
391924,
391925,
391926,
391927,
391928,
391929,
391930,
391931,
391932,
391933,
391934,
391935,
391936,
391937,
391938,
391939,
391940,
391941,
391942,
392232,
392233,
392234,
392235,
392236,
392237,
392238,
392239,
392240,
392241,
392242,
392243,
392244,
392245,
392246,
392247,
392248,
392249,
392250,
392251,
392252,
392253,
392254,
392255,
392256,
392257,
392258,
392259,
392260,
392261,
392262,
392263,
392264,
392265,
392266,
392267,
392268,
392269,
392270,
392271,
392272,
392273,
392278,
392727,
410693,
410698,
410701,
410704,
410710,
410711,
410720,
410721,
410722,
410724,
410725,
281265,
282405,
307460,
319252,
322631,
322639,
322640,
323617,
325238,
327867,
328251,
330604,
333498,
334457,
334687,
335317,
337699,
342184,
346494,
348653,
349038,
355323,
355369,
368359,
370021,
372453,
372454,
372455,
372460,
372461,
372462,
372463,
372464,
372480,
374285,
374676,
374706,
374707,
374708,
374709,
374710,
374711,
374712,
374806,
374807,
374845,
374846,
374847,
374848,
374850,
374851,
374852,
374853,
374854,
374855,
374856,
374857,
374858,
374859,
374860,
374885,
374886,
374887,
374888,
374889,
374890,
374891,
374892,
374893,
374894,
375086,
375087,
375088,
375089,
375090,
375091,
375092,
375144,
375145,
375146,
375147,
375148,
375149,
375150,
375151,
375152,
375153,
375154,
375155,
375170,
375171,
375172,
375173,
375174,
375175,
375176,
375177,
375178,
375179,
375180,
375181,
375182,
375183,
375184,
375185,
375186,
375187,
375188,
375189,
375190,
375191,
375192,
375193,
375194,
375195,
375196,
375197,
375322,
375323,
375512,
375513,
375514,
375515,
375516,
375517,
375518,
375519,
375661,
375662,
375663,
375664,
375666,
375667,
375668,
375669,
375670,
375671,
375672,
375673,
375674,
375675,
375676,
375678,
375679,
375791,
375792,
375793,
375795,
375796,
375797,
375798,
375799,
375800,
375801,
375802,
375803,
375804,
375805,
375806,
376472,
376473,
376815,
376817,
376818,
376819,
376820,
376821,
376886,
376887,
376888,
376889,
376890,
376891,
376892,
376893,
376894,
376895,
376896,
376897,
376898,
376899,
376900,
376901,
376902,
376903,
376904,
376905,
376906,
382119,
382120,
382121,
382122,
382123,
382124,
382125,
382126,
382127,
382128,
382129,
382130,
382131,
382132,
387108,
387109,
387110,
387111,
387112,
387113,
387114,
387115,
387116,
387117,
387118,
387119,
387120,
387121,
387122,
387123,
387124,
387125,
388004,
388005,
388006,
388007,
388008,
388009,
388010,
388011,
388012,
388013,
388014,
388015,
388016,
388017,
388018,
388019,
389158,
389159,
389160,
389161,
389162,
389163,
389164,
389165,
389166,
389167,
389168,
389169,
389170,
389171,
389172,
389173,
389174,
389175,
389176,
389177,
389178,
389179,
389180,
389181,
389182,
389183,
389184,
389185,
389186,
390144,
390145,
390146,
390147,
390148,
390149,
390150,
390151,
390152,
390153,
390154,
390155,
390156,
390157,
390158,
390159,
390160,
390161,
390162,
390163,
390164,
391787,
391788,
391789,
391966,
391967,
391968,
391969,
391970,
391971,
391972,
391973,
391974,
391975,
391976,
391977,
391978,
391979,
391980,
391981,
391982,
391992,
392220,
392221,
392222,
392223,
392437,
392438,
392439,
392440,
392441,
392442,
392443,
392551,
392552,
392553,
392554,
392555,
392556,
392557,
392558,
392559,
392560,
392561,
392562,
392563,
392639,
392640,
392641,
392642,
392643,
392644,
392645,
392646,
392647,
392648,
408963,
408964,
409279,
409280,
409281,
409282,
409283,
409285,
409286,
409287,
409288,
409289,
409290,
409291,
409292,
409293,
409294,
409295,
409296,
409297,
409298,
409299,
409300,
409301,
409302,
409537,
409538,
409539,
409540,
266758,
389477,
17998,
274952,
280357,
282638,
283702,
285831,
286622,
289415,
289676,
290918,
304786,
306224,
308709,
308716,
322509,
323593,
327003,
332547,
333229,
333291,
336908,
337526,
338254,
338547,
339603,
339614,
339736,
341535,
341540,
341844,
349152,
350389,
351516,
354439,
354550,
355020,
355564,
355921,
355922,
356370,
356883,
356884,
356906,
356907,
356908,
356909,
356911,
356912,
356913,
357016,
357020,
357021,
357022,
357100,
357101,
357102,
357103,
357104,
357105,
357106,
357107,
357108,
357109,
357110,
357111,
357114,
357115,
357116,
357117,
357118,
357119,
357120,
357121,
357122,
357123,
357124,
357125,
357126,
357127,
357128,
357129,
357130,
357131,
357132,
357133,
357134,
357135,
357372,
357373,
357374,
357375,
357558,
357629,
357635,
357636,
357637,
357638,
357639,
357640,
357641,
357642,
357643,
357644,
357645,
357995,
358043,
367069,
367070,
367071,
367072,
367073,
367074,
367075,
367076,
367077,
367078,
367079,
367080,
367081,
367082,
367083,
367084,
367085,
367086,
367087,
367088,
367089,
367094,
371597,
371598,
371775,
371776,
371783,
371919,
372090,
372240,
372241,
372313,
372314,
372315,
372316,
372317,
372318,
372319,
372320,
372321,
372322,
372323,
372324,
372325,
372326,
372327,
372328,
372329,
372330,
372331,
372333,
372334,
372335,
372336,
372337,
372338,
372424,
372653,
372746,
372850,
372851,
372852,
372853,
372854,
372855,
372856,
372857,
372858,
372859,
372860,
372861,
372862,
372863,
372864,
372865,
372866,
372867,
372868,
372869,
372870,
372871,
372872,
372873,
372874,
372875,
372876,
372877,
372878,
372879,
372932,
373057,
373083,
373935,
373967,
373968,
374177,
374188,
374498,
374499,
374500,
374730,
374765,
374835,
374836,
374863,
374864,
374915,
374952,
374974,
374998,
375070,
375093,
375094,
375095,
375096,
375169,
375210,
375289,
375290,
375589,
375613,
375618,
375680,
375700,
375770,
375834,
375835,
375836,
376491,
376711,
376879,
376880,
376881,
376883,
377035,
377036,
377037,
377038,
377145,
377146,
377155,
377850,
378462,
378463,
378464,
378465,
378467,
379504,
380242,
380243,
380254,
380266,
383865,
384059,
384062,
384114,
384115,
384116,
384117,
384118,
384119,
384120,
384121,
384122,
384123,
384124,
384125,
384126,
384127,
384128,
384546,
384796,
384797,
385942,
386300,
388055,
388056,
388057,
388060,
389495,
389497,
389669,
390553,
391434,
391619,
391632,
391653,
392347,
392507,
392519,
393103,
401636,
401637,
401649,
401651,
405587,
405890,
405891,
405897,
405900,
405901,
405902,
405907,
405908,
405913,
405914,
405917,
405918,
405922,
405932,
406470,
407701,
407703,
407708,
407711,
407722,
408285,
408322,
408327,
408329,
408332,
408339,
408342,
408348,
408349,
408351,
408357,
409682,
409683,
409684,
409685,
409695,
409696,
409697,
409698,
409700,
409701,
409830,
410736,
410965,
410972,
422805,
422816,
422826,
422827)

GROUP BY candidat.matricule ORDER BY fichePoste_id ASC

LIMIT 0,20000";


		$zQuery = $this->db->query($zSql);
		$togetAllFichePoste =  $zQuery->result_array();
		
		return $togetAllFichePoste ; 
	}


	function getStatFichePoste($_zType="departement"){
		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT libele,COUNT(fichePoste_id) AS nombre FROM $zDatabaseGcap.ficheposte f
				 INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = f.fichePoste_userId
				 INNER JOIN $zDatabaseOrigin.$_zType d ON d.id = c.$_zType	
				 GROUP BY c.$_zType ORDER BY nombre DESC" ;

		$zQuery = $this->db->query($zSql);
		$togetAllFichePoste =  $zQuery->result_array();
		
		return $togetAllFichePoste ; 

	}

/**************************************** Fiche de Poste **********************************************/

	function getUserFichePoste($_iUserId=0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT f.*,c.cin,c.matricule,c.nom,c.prenom
				FROM $zDatabaseGcap.ficheposte f INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = f.fichePoste_userId WHERE 1  " ;

		
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			//$iCin = str_replace(" ","",$iCin);
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}

		if ($_iUserId != 0){
			$zSql .= " AND fichePoste_userId = '" . $_iUserId."'" ;
		}

		//echo $zSql;

		$zQuery = $this->db->query($zSql);
		$toGetUserFichePoste =  $zQuery->result_array();
		
		return $toGetUserFichePoste ; 
	}


	function getUserMission($_iUserId = 0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT m.*
				FROM $zDatabaseGcap.missionposte m INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = m.missionPoste_userId WHERE 1  " ;
		
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			//$iCin = str_replace(" ","",$iCin);
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}

		if ($_iUserId != 0){
			$zSql .= " AND missionPoste_userId = '" . $_iUserId."'" ;
		}

		//echo $zSql;

		$zQuery = $this->db->query($zSql);
		$toGetUserMission =  $zQuery->result_array();
		
		return $toGetUserMission ; 
	}

	function getUserActivite($_iUserId = 0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT a.*,c.cin,c.matricule,c.nom,c.prenom
				FROM $zDatabaseGcap.activiteposte a INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = a.activitePoste_userId WHERE 1  " ;

		
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			//$iCin = str_replace(" ","",$iCin);
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}

		if ($_iUserId != 0){
			$zSql .= " AND activitePoste_userId = '" . $_iUserId."'" ;
		}

		//echo $zSql;

		$zQuery = $this->db->query($zSql);
		$toGetUserActivite =  $zQuery->result_array();
		
		return $toGetUserActivite ; 
	}

	function getUserEncadrement($_iUserId = 0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT e.*,c.cin,c.matricule,c.nom,c.prenom
				FROM $zDatabaseGcap.encadrementposte e INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = e.encadrementPoste_userId WHERE 1  " ;

		
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			//$iCin = str_replace(" ","",$iCin);
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}

		if ($_iUserId != 0){
			$zSql .= " AND encadrementPoste_userId = '" . $_iUserId."'" ;
		}

		//echo $zSql;

		$zQuery = $this->db->query($zSql);
		$toGetUserEncadrement =  $zQuery->result_array();
		
		return $toGetUserEncadrement ; 
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

	public function get_login_by_cin_matricule($_iCin = FALSE, $_iMatricule = '',$iFlag=0){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql  = "SELECT user.id,login,AES_DECRYPT(PASSWORD,'".encrypt."') AS password FROM rohi.user ";

		if($iFlag == 0){
			$sql .= "LEFT JOIN rohi.candidat ON user.id = candidat.user_id ";
		}
		
		$sql .= " WHERE 1=1 ";

		if($_iCin != ''){
			$sql .= " AND 1 AND user.cin = '$_iCin' " ;
		}

		if($_iMatricule != ''){
			$sql .= " AND  im = '$_iMatricule'" ;
		}
		$sql .= " LIMIT 0,1" ; 

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function getCompteByHash($_iCompteHash=''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "select compte_id from $zDatabaseGcap.compte WHERE compte_hash = '".$_iCompteHash."'";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iCompte = 1;

		if(sizeof($oRow) && isset($oRow[0]->compte_id)){
			$iCompte = $oRow[0]->compte_id ; 
		}
		return $iCompte;
	}


	public function getCandidatCinMatricule($_iCin = FALSE, $_iMatricule = '',$_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select matricule,REPLACE(cin,' ','') AS cin,candidat.nom, candidat.prenom, user_id as iUserId,cin,id,type_photo from $zDatabaseOrigin.candidat WHERE 1=1 ";

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


	public function getRgaSansFraction($_iCin = FALSE, $_iMatricule = '',$_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "SELECT * FROM $zDatabaseGcap.decision WHERE decision_autoriteSaisi LIKE '%bezara%' AND decision_id NOT IN (SELECT decision_id FROM $zDatabaseGcap.decision INNER JOIN $zDatabaseGcap.fraction ON fraction_decisionId = decision_id WHERE decision_autoriteSaisi LIKE '%bezara%')";

		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function miseAJourDecisionRGA($_iCin = FALSE, $_iMatricule = '',$_zNom = FALSE, $_zPrenom = ''){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "SELECT * FROM $zDatabaseGcap.decision WHERE decision_autoriteSaisi LIKE '%bezara%' ";

		$query = $this->db->query($sql);
		$toAgent = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toAgent as $oAgent){
			$zDateDebut = $oAgent['decision_dateDebut'];
			$zDateFin = $oAgent['decision_dateFin'];

			$toDateDebut = explode("-",$zDateDebut);
			$toDateFin = explode("-",$zDateFin);

			if($toDateDebut[1]=='03'){
				$sql11= "Update $zDatabaseGcap.decision SET decision_dateDebut = '".$toDateDebut[2]."-01-".$toDateDebut[2]."' WHERE  decision_id = " . $oAgent['decision_id'];
				$this->db->query($sql11);
			}

			if($toDateFin[1]=='03' && $toDateFin[2]=='01'){
				$sql11= "Update $zDatabaseGcap.decision SET decision_dateFin = '".$toDateDebut[2]."-12-31' WHERE  decision_id = " . $oAgent['decision_id'];
				$this->db->query($sql11);
			}


		}
	}

	public function updateDebutFinRGA(){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "SELECT * FROM $zDatabaseGcap.decision WHERE decision_autoriteSaisi LIKE '%bezara%' ";

		$query = $this->db->query($sql);
		$toAgent = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available

		foreach ($toAgent as $oAgent){

			$sql11= "Update $zDatabaseGcap.decision SET decision_dateDebut = '".$oAgent['decision_annee']."-01-01' ,decision_dateFin = '".$oAgent['decision_annee']."-12-31' WHERE  decision_id = " . $oAgent['decision_id'];

			echo $sql11 . "\n<br>" ; 
			$this->db->query($sql11);
		

		}
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
			$sql .= " AND CONVERT(LOWER(nom) USING utf8) like '%".strtolower($_zNom)."%' " ;
		}

		if($_zPrenom != ''){

			$toPrenom = explode(" ",$_zPrenom);
			if(sizeof($toPrenom)>0){
				$sql .= " AND CONVERT(LOWER(prenom) USING utf8) like '%".strtolower($toPrenom[0])."%' " ;
			} else {
				$sql .= " AND CONVERT(LOWER(prenom) USING utf8)  like '%".strtolower($_zPrenom)."%' " ;
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



	function getUserExigence($_iUserId = 0){

		global $db;
		
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT ex.*,c.cin,c.matricule,c.nom,c.prenom
				FROM $zDatabaseGcap.exigenceposte ex INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = ex.exigencePoste_userId WHERE 1  " ;

		
		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			//$iCin = str_replace(" ","",$iCin);
			$zSql .= " AND cin = '" . $iCin . "'" ;
		}

		if ($_iUserId != 0){
			$zSql .= " AND exigencePoste_userId = '" . $_iUserId."'" ;
		}

		//echo $zSql;

		$zQuery = $this->db->query($zSql);
		$toGetUserExigence =  $zQuery->result_array();
		
		return $toGetUserExigence ; 
	}


/****************************************** Fiche de poste **************************************************/
	public function get_evaluateur_par_user_id($_oCandidat = 0) {
		
		$DB1					=	$this->load->database('gcap', TRUE);
		
		$evaluateur_id	=	0 ; 
		
		//testons si l'agent est premier responsable ou non
		$zSql  = "  SELECT premier_responsable_id
				      FROM rohi.t_structure
					 WHERE premier_responsable_id = '".$_oCandidat->user_id."'
				 " ;
				
		$zQuery				= $DB1->query($zSql);
		$oRowResult 		= $zQuery->row_array();
		
		//agent premier responsable
		if( $oRowResult['premier_responsable_id'] ){
			$zSql  = "  SELECT premier_responsable_id
							  FROM rohi.t_structure
							 WHERE child_id =(SELECT parent_id FROM rohi.t_structure WHERE child_id ='".$_oCandidat->structureId."')" ;
				
			$zQuery				= $DB1->query($zSql);
			$oRowResult 		= $zQuery->row_array();
			$evaluateur_id		= $oRowResult["premier_responsable_id"] ;
		}else{
			//si la structure n'a pas de premier responsable alors on prend le premier responsable du n-1, n-2, n-3
			$evaluateur_id		= $this->get_premier_responsable_structure($_oCandidat->structureId);
		}
		
		return $evaluateur_id;
	}
	
	public function get_premier_responsable_structure($structure_id = 0) {
		
		$DB1					=	$this->load->database('gcap', TRUE);
		$zSql  = "  SELECT premier_responsable_id
							  FROM rohi.t_structure
							 WHERE child_id = '".$structure_id."' " ;
				
		$zQuery				= $DB1->query($zSql);
		$oRowResult 		= $zQuery->row_array();
		$evaluateur_id		= $oRowResult["premier_responsable_id"] ;
		//echo "dddd";die;
		if($evaluateur_id){
			$evaluateur_id	= $oRowResult["premier_responsable_id"] ;
		}else{
			
			//parent division
			$sql_parent		= " SELECT  rohi.F_GET_ID_PARENT('".$structure_id."','DIV') parent_id" ;
			//echo $sql_parent;die;
			$query_parent	= $DB1->query($sql_parent);
			$result_parent 	= $query_parent->row_array();
			$parent_id		= $result_parent["parent_id"] ;
			
			$zSql  = "  SELECT premier_responsable_id
							  FROM rohi.t_structure
							 WHERE child_id = '".$parent_id."' " ;
				
			$zQuery				= $DB1->query($zSql);
			$oRowResult 		= $zQuery->row_array();
			$evaluateur_id		= $oRowResult["premier_responsable_id"] ;
			
			if($evaluateur_id){
				$evaluateur_id	= $oRowResult["premier_responsable_id"] ;
			}else{
				//parent service
				
				$sql_parent		= " SELECT  rohi.F_GET_ID_PARENT('".$structure_id."','SCE') parent_id" ;
				$query_parent	= $DB1->query($sql_parent);
				$result_parent 	= $query_parent->row_array();
				$parent_id		= $result_parent["parent_id"] ;
				
				$zSql  = "  SELECT premier_responsable_id
								  FROM rohi.t_structure
								 WHERE child_id = '".$parent_id."' " ;
					
				$zQuery				= $DB1->query($zSql);
				$oRowResult 		= $zQuery->row_array();
				$evaluateur_id		= $oRowResult["premier_responsable_id"] ;
				if($evaluateur_id){
					$evaluateur_id	= $oRowResult["premier_responsable_id"] ;
				}else{
					//parent direction
					
					$sql_parent		= " SELECT  rohi.F_GET_ID_PARENT('".$structure_id."','DIR') parent_id" ;
					$query_parent	= $DB1->query($sql_parent);
					$result_parent 	= $query_parent->row_array();
					$parent_id		= $result_parent["parent_id"] ;
					
					$zSql  = "  SELECT premier_responsable_id
									  FROM rohi.t_structure
									 WHERE child_id = '".$parent_id."' " ;
						
					$zQuery				= $DB1->query($zSql);
					$oRowResult 		= $zQuery->row_array();
					$evaluateur_id		= $oRowResult["premier_responsable_id"] ;
				}
				
			}
			
		}
		
		return $evaluateur_id;
		
	}

	public function get_agents_evalues_par_user_id($_iUserEvaluateurId = 0) {
		
		$DB1 			= $this->load->database('gcap', TRUE);
		
		$sql			= " SELECT child_id FROM rohi.t_structure WHERE premier_responsable_id = '".$_iUserEvaluateurId."'	 ";
		
		$query 			= $this->db->query($sql);
		$toRow 			= $query->result_array();
		
		$structures 	=  array();
		foreach ($toRow as $oRow){
			$child_id 	= $oRow["child_id"];
			array_push($structures, $child_id);
		}
		
		$zReturn 		= 	"";
		
		if( sizeof($structures) > 0 ){
			$structureId	=	implode("," , $structures) ;
			$zSql			= " SELECT user_id 
								  FROM rohi.candidat 
								 WHERE structureId IN (".$structureId.")
								 AND sanction IN ('00','34','40')
								UNION
								SELECT user_id 
								  FROM rohi.candidat 
								 WHERE user_id IN ( SELECT premier_responsable_id FROM rohi.t_structure WHERE parent_id IN (".$structureId.") ) 
								  AND sanction IN ('00','34','40')
							  ";
			

			$zQuery 		= $DB1->query($zSql);
			$toRow1 		= $zQuery->result_array();
			$zQuery->free_result(); 
			
			
			$i				=	0;
			$toReturnAll 	= 	array();
			foreach ($toRow1 as $oRow){
				$user_id 	= $oRow["user_id"];
				array_push($toReturnAll, $user_id);
			}
			$zReturn = implode("," , $toReturnAll) ;
		}else{
			$zReturn		=	$_iUserEvaluateurId;
		}
		
		return $zReturn;
	}
	
	public function get_agents_mef() {
		$DB1 			= $this->load->database('gcap', TRUE);
	
		$zSql			= " SELECT user_id 
		                      FROM rohi.candidat 
							 WHERE  sanction IN ('00','34','40')
						  ";
		

		$zQuery 		= $DB1->query($zSql);
		$toRow1 		= $zQuery->result_array();
		$zQuery->free_result(); 
		
		$zReturn 		= 	"";
		$i				=	0;
		$toReturnAll 	= 	array();
		foreach ($toRow1 as $oRow){
			$user_id 	= $oRow["user_id"];
			array_push($toReturnAll, $user_id);
		}
		$zReturn = implode("," , $toReturnAll) ;
		
	
		return $zReturn;
	}
	
	public function get_sous_ma_responsabilite($_oCandidat) {
		
		$DB1 			= $this->load->database('gcap', TRUE);
		
		//testons si l'utilisateur a un compte RESPERS MAJUSCULE, le compte comporte comme AUTORITE
		
		$zSql  = "  SELECT userCompte_compteId 
		             FROM gcap.usercompte 
					WHERE userCompte_userId ='".$_oCandidat[0]->user_id."' 
					  AND userCompte_compteId ='12'
				" ;
				
		$zQuery				= $DB1->query($zSql);
		$oRowResult 		= $zQuery->row_array();
		$compte 			= $oRowResult['userCompte_compteId'];
		
		if($compte){
			//get structure parent_id
			
			$sqlparent			= " SELECT min(child_id) child_id 
			                          FROM rohi.t_structure 
									WHERE ( 
										respers_id ='".$_oCandidat[0]->user_id."'
										OR respers_id LIKE '%,".$_oCandidat[0]->user_id.",%' 
										OR  respers_id LIKE '".$_oCandidat[0]->user_id.",%' 
										OR respers_id LIKE '%,".$_oCandidat[0]->user_id."'
									)
								";
			//echo $sqlparent;die;
			$zQuery				= $DB1->query($sqlparent);
			$oRowResult 		= $zQuery->row_array();
			$parent_id 			= $oRowResult['child_id'];
		
			$sqllist			=" SELECT  t_structure_new.child_id
								     FROM    (SELECT * FROM rohi.t_structure
											 ORDER BY parent_id, child_id) t_structure_new,
											(SELECT @pv := '".$parent_id."') initialisation
								    WHERE   FIND_IN_SET(parent_id, @pv)
									  AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
									union
									select child_id from rohi.t_structure where child_id ='".$parent_id."'
								";
			//echo $sqllist;die;
			$query		=   $this->db->query($sqllist);
			$toList		=   $query->result_array();
			$tzLists	=	array() ;
			array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
			foreach($toList as $oList){
				array_push($tzLists,"'".$oList["child_id"]."'") ;
			}
			$zList		=	implode(",",$tzLists);

			$zSql= "SELECT *
					FROM rohi.candidat a
					inner join rohi.t_structure b
					on a.structureId = b.child_id
					where structureId in ($zList) 
					AND		sanction IN('0','00','34','40')
					";
		
		}else{
			$zSql			= " SELECT * 
			                  FROM rohi.candidat a
						     WHERE a.structureId IN ( SELECT child_id FROM rohi.t_structure 
						        WHERE (
								    respers_id ='".$_oCandidat[0]->user_id."'
									OR respers_id LIKE '%,".$_oCandidat[0]->user_id.",%' 
									OR  respers_id LIKE '".$_oCandidat[0]->user_id.",%' 
									OR respers_id LIKE '%,".$_oCandidat[0]->user_id."'
								)
						   ) 
						  AND a.sanction='00' 
				        ";
		}
	
		
		$zQuery 		= $DB1->query($zSql);
		$toRow1 		= $zQuery->result_array();
		$zQuery->free_result(); 
		
		$zReturn 		= 	"";
		$i				=	0;
		$toReturnAll 	= 	array();
		foreach ($toRow1 as $oRow){
			$user_id 	= $oRow["user_id"];
			array_push($toReturnAll, $user_id);
		}
		$zReturn = implode("," , $toReturnAll) ;
	
		return $zReturn;
	}
	
	public function get_sous_mon_autorite($_oCandidat) {
		
		$DB1 			= $this->load->database('gcap', TRUE);
		
		//testons si l'utilisateur a un compte RESPERS MAJUSCULE, le compte comporte comme AUTORITE
					
		$sqllist			=" SELECT  t_structure_new.child_id
								 FROM    (SELECT * FROM rohi.t_structure
										 ORDER BY parent_id, child_id) t_structure_new,
										(SELECT @pv := '".$_oCandidat[0]->structureId."') initialisation
								WHERE   FIND_IN_SET(parent_id, @pv)
								  AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
								union
								select child_id from rohi.t_structure where child_id ='".$_oCandidat[0]->structureId."'
							";
		
		$query		=   $DB1->query($sqllist);
		$toList		=   $query->result_array();
		$tzLists	=	array() ;
		array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
		foreach($toList as $oList){
			array_push($tzLists,"'".$oList["child_id"]."'") ;
		}
		$zList		=	implode(",",$tzLists);
		$zReturn 	= 	"";
		
		if($zList){
		
			$zSql= "SELECT *
					FROM rohi.candidat a
					inner join rohi.t_structure b
					on a.structureId = b.child_id
					where structureId in ($zList) 
					AND		sanction IN('0','00','34','40')
					";
			
			$zQuery 		= $DB1->query($zSql);
			$toRow1 		= $zQuery->result_array();
			$zQuery->free_result(); 
			
			
			$i				=	0;
			$toReturnAll 	= 	array();
			foreach ($toRow1 as $oRow){
				$user_id 	= $oRow["user_id"];
				array_push($toReturnAll, $user_id);
			}
			$zReturn = implode("," , $toReturnAll) ;
		}
		return $zReturn;
	}
	
	
	
	
	public function get_agents_evalues_par_user_id_vavao($_iUserEvaluateurId = 0) {
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= " SELECT b.* 
				  FROM rohi.t_structure a
				  inner join rohi.candidat b
				  on a.child_id = b.structureId
				  WHERE (a.evaluateur_id ='".$_iUserEvaluateurId."' OR a.evaluateur_id LIKE '%,".$_iUserEvaluateurId.",%'  OR  a.evaluateur_id LIKE '".$_iUserEvaluateurId.",%'  OR a.evaluateur_id LIKE '%,".$_iUserEvaluateurId."')
				 union
				SELECT b.*
				  FROM rohi.t_structure a
				  inner join rohi.candidat b
				  on a.premier_responsable_id = b.user_id
				 where a.parent_id =(select structureId from rohi.candidat where user_id ='".$_iUserEvaluateurId."')
					" ;
		$zQuery		=	$DB1->query($zSql);
		$toRow		=	$zQuery->result_array();
		$zQuery->free_result(); 
		$zReturn	=	"";
		$toReturnAll=	array();
		if( sizeof($toRow) > 0){
			foreach ($toRow as $oRow){
				$user_id = $oRow["user_id"];
				array_push($toReturnAll, $user_id);
			}
			$zReturn .= implode (",", $toReturnAll);
		}else{
			$zReturn		=	$_iUserEvaluateurId;
		}
		return $zReturn;
	}



	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1					=	$this->load->database('gcap', TRUE);
		$zDatabaseOrigin		=	$db['default']['database'] ; 
		
		//echo $_iCompteActif;die;
		switch ($_iCompteActif){
			//echo $_iCompteActif;die;
			case COMPTE_AGENT :
				//tous les agent ayant même evaluateur KAKA
				$evaluateur_id		= $this->get_evaluateur_par_user_id ($_oCandidat[0]);
				//echo $evaluateur_id;die;
				$zUserId 			= $this->get_agents_evalues_par_user_id ($evaluateur_id);
				
				$zSql  				= "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE user_id IN (".$zUserId.") " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				
				$zQuery 					= $DB1->query($zSql);
				$toCandidatUser 			= $zQuery->result_array();
				$toCandidatUserMatricule 	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}else{
					$zUserId = $_iUserId;
				}
				
				break;
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE user_id IN (".$zUserId.") " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery 		= $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();
				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}else{
					$zUserId = $_iUserId;
				}
				
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
				///echo "AAA";die;
				//print_r();die;
				$zUserId = $this->get_sous_ma_responsabilite($_oCandidat);
				
				break;

			case COMPTE_AUTORITE :
				///echo COMPTE_AUTORITE;die;
				$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$_oCandidat[0]->structureId."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
						union
						select child_id from rohi.t_structure where child_id ='".$_oCandidat[0]->structureId."'
						";
				$query		=   $this->db->query($sqllist);
				$toList		=   $query->result_array();
				$tzLists	=	array() ;
				array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
				foreach($toList as $oList){
					array_push($tzLists,"'".$oList["child_id"]."'") ;
				}
				$zList		=	implode(",",$tzLists);

				$zSql= "select *
						from rohi.candidat a
						inner join rohi.t_structure b
						on a.structureId = b.child_id
						where structureId in ($zList) 
						AND		sanction IN('0','00','34','40')
						LIMIT 0,5000
						   ";
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"] );
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				//echo $zUserId;die;
				break;

			case COMPTE_ADMIN :
				$zSql  = " SELECT user_id FROM $zDatabaseOrigin.candidat WHERE 1=1  " ; 
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				break;
		}

		if ($_iCompteActif != COMPTE_ADMIN){
			$zUserId = ($zUserId=='')?-1:$zUserId; 
		}
		
		return $zUserId ; 
	}


	public function getAllUserSubordonnees_taloha ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1					=	$this->load->database('gcap', TRUE);
		$zDatabaseOrigin		=	$db['default']['database'] ; 
		switch ($_iCompteActif){
			
			case COMPTE_AGENT :
				$zSql  = "  SELECT evaluation_userEvalue
							 FROM gcap.evaluation
							 WHERE evaluation_userEvalue LIKE '%-".$_iUserId."-%'
							 OR evaluation_userEvalue LIKE '".$_iUserId."-%'
							 OR evaluation_userEvalue LIKE '%-".$_iUserId."'
							 LIMIT 1" ;
				
				$zQuery								= $DB1->query($zSql);
				$toUserAyantMemeEvaluateurs			= $zQuery->row_array();
				if(sizeof($toUserAyantMemeEvaluateurs) >0){
					$zUserAyantMemeEvaluateur		= $toUserAyantMemeEvaluateurs["evaluation_userEvalue"];
					$toUserAyantMemeEvaluateurs		= explode("-",$zUserAyantMemeEvaluateur);
					$zUserAyantMemeEvaluateur		= implode($toUserAyantMemeEvaluateurs,",");
				}else{
					$zUserAyantMemeEvaluateur		= $_iUserId;
				}
				$zUserId							= $zUserAyantMemeEvaluateur ; 
				//echo $zUserId;die;
				break;
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE user_id IN (".$zUserId.") " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();
				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}else{
					$zUserId = $_iUserId;
				}
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}


				} elseif ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." " ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				} else {
					
					if ($_oCandidat[0]->service != '') {
			
						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."'"  ;
						
					} elseif ($_oCandidat[0]->direction != '') {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."'" ;
					} else {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."' " ;
					}

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				}

				/*if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011' || $_oUser['im'] == '355857') {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2,3,4,5,6,7) " ;
				}*/

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;

				$zSql  .= " AND detache=0 " ;

				
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_AUTORITE :
				if ($_oUser['serv'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				} elseif ($_oUser['dir'] != 0 ) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." " ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} else {
	
					if ( $_oCandidat[0]->service != '' && $_oCandidat[0]->service != 0) {
						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."' "  ;
						
					} elseif ($_oCandidat[0]->direction != '' && $_oCandidat[0]->service != 0) {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."'" ;
					} else {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."'" ;
					}
					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				}

				if ($iAffiche == 0) {
					$zSql  .= " AND c12.user_id <> $_iUserId  " ;
				}

				$zUserId = $this->get_agents_evalues_par_user_id ($_oUser['id']);

				if($zUserId != ""){
					//$zSql  .= " AND c12.user_id IN (".$zUserId.")  " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;

				$zSql  .= " AND detache=0 " ;
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_ADMIN :
				$zSql  = " SELECT user_id FROM $zDatabaseOrigin.candidat WHERE 1=1  " ; 
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				break;
		}

		if ($_iCompteActif != COMPTE_ADMIN){
			$zUserId = ($zUserId=='')?-1:$zUserId; 
		}
		
		return $zUserId ; 
	}

	public function get_agents_ayant_meme_evaluateur_taloha ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		switch ($_iCompteActif){
			
			case COMPTE_AGENT :
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;
			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE user_id IN (".$zUserId.") " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				} elseif ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." AND c12.service='' AND c12.direction=''" ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} else {
					
					if ($_oCandidat[0]->service != '') {
			
						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."'" ;
						
					} elseif ($_oCandidat[0]->direction != '') {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.service=''" ;
					} else {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."'  AND c12.service='' AND c12.direction=''" ;
					}

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				}

				if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011' || $_oUser['im'] == '355857') {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2,3,4,5,6,7) " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;

				$zSql  .= " AND detache=0 " ;

				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_AUTORITE :

				if ($_oUser['serv'] != 0) {
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 
					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} elseif ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." AND c12.service='' AND c12.direction=''" ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
				} else {
					
					if ($_oCandidat[0]->service != '' && $_oCandidat[0]->service != 0) {
			
						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."'" ;
						
					} elseif ($_oCandidat[0]->direction != '' && $_oCandidat[0]->direction != 0) {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.service=''" ;
					} else {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."' AND c12.service='' AND c12.direction=''" ;
					}


					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}
					
				}

				if ($iAffiche == 0) {
					$zSql  .= " AND c12.user_id <> $_iUserId  " ;
				}

				$zUserId = $this->get_agents_evalues_par_user_id ($_oUser['id']);

				if($zUserId != ""){
					//$zSql  .= " AND c12.user_id IN (".$zUserId.")  " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;

				//$zSql  .= " AND detache=0 " ;



				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();

				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser)
				{
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}

				$zUserId = $_iUserId;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_ADMIN :

				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE 1=1 " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				
				break;
		}

		if ($_iCompteActif != COMPTE_ADMIN){
			$zUserId = ($zUserId=='')?-1:$zUserId; 
		}
		
		return $zUserId ; 
	}


	public function get_agents_ayant_meme_evaluateur ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		

		switch ($_iCompteActif){
			
			case COMPTE_AGENT :
			case COMPTE_SERVICE_ACCUIEL : 
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_iUserId);
				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE user_id IN (".$zUserId.") " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery = $DB1->query($zSql);
				$toCandidatUser = $zQuery->result_array();
				$toCandidatUserMatricule = array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {

					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				break;
			case COMPTE_RESPONSABLE_PERSONNEL :
				$zSql= " SELECT * 
			               FROM rohi.candidat a
						  WHERE a.structureId IN ( SELECT child_id FROM rohi.t_structure 
						        WHERE (
									respers_id LIKE '%,".$_oCandidat[0]->user_id.",%' 
									OR  respers_id LIKE '".$_oCandidat[0]->user_id.",%' 
									OR respers_id LIKE '%,".$_oCandidat[0]->user_id."'
								)
						   ) 
						  AND (a.sanction='0' || a.sanction='' || a.sanction='00' || a.sanction='34' || a.sanction IS NULL)
				       ";
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				break;
			case COMPTE_AUTORITE :
				/*$sqllist	=	"SELECT  t_structure_new.child_id
						FROM    (SELECT * FROM t_structure
								 ORDER BY parent_id, child_id) t_structure_new,
								(SELECT @pv := '".$_oCandidat[0]->structureId."') initialisation
						WHERE   FIND_IN_SET(parent_id, @pv)
						AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0";
				$query		=   $this->db->query($sqllist);
				$toList		=   $query->result_array();
				$tzLists	=	array() ;
				array_push($tzLists,"'".$_oCandidat[0]->structureId."'") ;
				foreach($toList as $oList){
					array_push($tzLists,"'".$oList["child_id"]."'") ;
				}
				$zList		=	implode(",",$tzLists);

				$zSql= " select *
						from rohi.candidat a
						inner join rohi.t_structure b
						on a.structureId = b.child_id
						where structureId in ($zList) 
						AND		sanction IN('0','00','34','40')
						   ";
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;*/
				
				
				$zSql  = "  SELECT a.*
							 FROM rohi.candidat a
							 INNER JOIN 
							 (SELECT  t_structure_new.child_id
								FROM    (SELECT * FROM rohi.t_structure
										 ORDER BY parent_id, child_id) t_structure_new,
										(SELECT @pv := '".$_oCandidat[0]->structureId."') initialisation
								WHERE   FIND_IN_SET(parent_id, @pv)
								AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0
								union
								select child_id from rohi.t_structure where child_id ='".$_oCandidat[0]->structureId."'
							 ) b
							 ON a.structureId = b.child_id 
							 INNER JOIN gcap.gcap c
							 ON a.user_id = c.gcap_userSendId
							 ORDER BY gcap_dateDebut DESC
							 LIMIT 1,1000" ;
				//$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				$zQuery						= $DB1->query($zSql);
				//print_r($zSql);die;
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				array_push ($toCandidatUserMatricule, (int)$_oCandidat[0]->user_id);
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}

				break;

			case COMPTE_ADMIN :

				$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE 1=1 " ;
				$zSql .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
				
				$zQuery						= $DB1->query($zSql);
				$toCandidatUser				= $zQuery->result_array();
				$toCandidatUserMatricule	= array();
				foreach ($toCandidatUser as $oCandidatUser){
					 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
				}
				$zUserId = -1;
				if (sizeof ($toCandidatUserMatricule) > 0) {
					$zUserId = implode(",", $toCandidatUserMatricule);
				}
				
				break;
		}

		if ($_iCompteActif != COMPTE_ADMIN){
			$zUserId = ($zUserId=='')?-1:$zUserId; 
		}
		
		return $zUserId ; 
	}

	public function getEvaluateurAgent($_iUserId = 0, $_this) {
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= " select * from $zDatabaseGcap.evaluation " ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iUserReturn = 0;
		$iTrouv=0;
		foreach ($toRow as $oRow){

			if ($iTrouv != 1) {
				$tzReturn = $oRow["evaluation_userEvalue"];
				$toReturn = explode("-", $tzReturn);
				
				foreach ($toReturn as $iReturn){
					if ($_iUserId == $iReturn) {
						$oCandidatEvaluateur = $_this->candidat->get_by_user_id($oRow["evaluation_userId"]);
						$iUserReturn = $oCandidatEvaluateur[0]->user_id ;
						$iTrouv  = 1;
					}
				}
			}
			
		}
		
		return $iUserReturn;
	}


	public function updateCategorieCadre() {
		global $db;
		$zDatabaseRohi =  $db['default']['database'] ; 

		$zSql= " SELECT c.id,c.nom,c.prenom,codeCorps_categorie,d.libele,

				CASE 
					WHEN codeCorps_categorie=1  THEN 'D'
					WHEN codeCorps_categorie=2  THEN 'C'
					WHEN codeCorps_categorie=3  THEN 'B'
					ELSE 'A'
				END AS Cadre
				FROM 
				$zDatabaseRohi.codecorps,$zDatabaseRohi.candidat c
				INNER JOIN $zDatabaseRohi.departement d ON d.id= c.departement
				WHERE codeCorps_code = corps
				LIMIT 0,160000" ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iUserReturn = 0;
		$iTrouv=0;
		$iBoucle = 0;
		foreach ($toRow as $oRow){
			$zSql  = " UPDATE $zDatabaseRohi.candidat SET categorie = '" . $toRow[$iBoucle]['codeCorps_categorie'] . "', cadre = '" . $toRow[$iBoucle]['Cadre'] . "' WHERE id = " .$toRow[$iBoucle]['id'] ;
			$this->db->query($zSql);
			$iBoucle++;
		}
		
		return $iUserReturn;
	}

	
	public function getAllChefHierarchique ($_this,$_oUser,$_oCandidat,$_iUserId, &$zNotIn="",$iAffiche=0,$iIsChefService=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$iEvaluateuruserId = $this->getEvaluateurAgent($_oCandidat['user_id'],$_this);

		if ($iEvaluateuruserId > 0){

			$zUserId = $iEvaluateuruserId ;

		} elseif ($iIsChefService == 1){

			$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 
			INNER JOIN $zDatabaseOrigin.direction d ON c12.direction = d.id
			INNER JOIN gcap.usercompte ON userCompte_userId = user_id AND userCompte_compteId = ".COMPTE_AUTORITE."
			WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat['id'].")   AND (fonction_actuel LIKE '%directeur%' OR poste LIKE '%directeur%')";

			if ($iAffiche == 0) {
				$zSql  .= " AND c12.user_id <> $_iUserId  " ;
			}

			$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
			$zSql  .= " AND detache=0 " ;

			$zQuery = $this->db->query($zSql);
			$toCandidatUser = $zQuery->result_array();

			$toCandidatUserMatricule = array();
			foreach ($toCandidatUser as $oCandidatUser)
			{
				 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
			}

			$zUserId = -1;
			if (sizeof ($toCandidatUserMatricule) > 0) {

				$zUserId = implode(",", $toCandidatUserMatricule);
			}		
		} else {

			/*if($_oCandidat['departement'] == '8'){
				$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 INNER JOIN $zDatabaseOrigin.departement s ON c12.departement = s.id
					WHERE s.id  = (SELECT departement FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") " ;
			} else {
			
				if ($_oCandidat['service'] < '700' && $_oCandidat['service'] != '') {
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 INNER JOIN $zDatabaseOrigin.service s ON c12.service = s.id
						WHERE s.id  = (SELECT service FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat['id'].") " ;
					
				} else {
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 INNER JOIN $zDatabaseOrigin.direction d ON c12.direction = d.id
						WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat['id'].") " ;
				}
			}

			if ($iAffiche == 0) {
				$zSql  .= " AND c12.user_id <> $_iUserId  " ;
			}

			$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction='34' || sanction IS NULL)  " ;
			$zSql  .= " AND detache=0 " ;

			$zQuery = $DB1->query($zSql);
			$toCandidatUser = $zQuery->result_array();

			$toCandidatUserMatricule = array();
			foreach ($toCandidatUser as $oCandidatUser)
			{
				 array_push ($toCandidatUserMatricule, (int)$oCandidatUser["user_id"]);
			}

			$zUserId = -1;
			if (sizeof ($toCandidatUserMatricule) > 0) {

				$zUserId = implode(",", $toCandidatUserMatricule);
			}*/
		}

		return $zUserId ; 
	}
	
	public function get_all_gcap($_zCandidat,$_oUser,$_oCandidat, $_iUserId, $_iTypeGcapId = 0, $_iCompteActif,$_iValid=0, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "gcap_id"){

		$DB1 = $this->load->database('gcap', TRUE);

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);

		$zSql= "SELECT SQL_CALC_FOUND_ROWS *, d.libele as zDirection, s.libele as zService, m.libele as zDivision,REPLACE(cin,' ','') as cin FROM gcap
				INNER JOIN type ON gcap_typeId = type_id
				INNER JOIN statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat ON candidat.user_id = gcap_userSendId 
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = candidat.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = candidat.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = candidat.division	
				WHERE 1";

		
		if ($_zCandidat != "")
		{
			$zSql .= " AND gcap_userSendId IN ($_zCandidat) " ;

		} else {

			if ($zUserId != "") {
				$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
			}
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if ($_iTypeGcapId != 0)
		{
			
			if ($_iTypeGcapId == CONGE) {
				$zSql .= " AND gcap_typeGcapId  IN (".CONGE.",".AUTORISATION_ABSENCE.") AND gcap_Id IN (SELECT fraction_congeId FROM fraction)" ; 
			} else {
				$zSql .= " AND gcap_typeGcapId = $_iTypeGcapId" ; 
			}
			
		}

		if ($_iValid != 0)
		{	
			$zSql .= " AND gcap_userValidId <> '' and gcap_dateValidation <> ''" ; 
		}
		else
		{
			//$zSql .= " AND gcap_statutId = " . STATUT_CREATION ; 
		}

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $_POST["iMatricule"]."'" ;
		}




		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;



		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		$iNombreConge = 0;
		$i = 0 ; 
		foreach ($oRow as $toRow1)
		{
			 $toRes = $this->getMotifLibelle ($toRow1["gcap_motif"]);

			 if (is_array($toRes) > 0) {
				if (isset($toRes[0]['motif_libelle'])){
					$oRow[$i]["gcap_motif"] = $toRes[0]['motif_libelle'] ; 
				}
			 }

			 if ($toRow1["gcap_typeGcapId"] == REPOS_MEDICAL) {

				/*$toFraction = $this->Fraction->get_fractions_by_conge_id ($toRow1["gcap_id"], $toRow1["gcap_userSendId"]);
				foreach ($toFraction as $oFraction){
					$iNombreConge += $oFraction['fraction_nbrJour'] ; 
				}*/
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 

			} else {
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 

				$iTestDayDeb1 = date("D", strtotime($toRow1['gcap_dateDebut']));
				$iTestDayFin1 = date("D", strtotime($toRow1['gcap_dateFin']));

				/* Test jour férié*/
					$zDateHierFerie = date("Y-m-d", strtotime($toRow1['gcap_dateDebut'] ."-1 days"));
					$zDateDemainFerie = date("Y-m-d", strtotime($toRow1['gcap_dateFin'] ."+1 days"));

					$toPasseFerie = $this->getJourFerie ($zDateHierFerie);

					if (sizeof($toPasseFerie)>0){
						foreach ($toPasseFerie as $oPasseFerie){
							switch($oPasseFerie['ferie_jour']) {
								case 'Mon':
									if (date("Y-m-d") <= '2018-09-24'){
										$iNombreConge += 3 ; 
										if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2){
											$iNombreConge -= 3 ; 
										}
									}
								break;

								default:
									if (date("Y-m-d") <= '2018-09-24'){
										$iNombreConge += 1 ; 
										if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2){
											$iNombreConge -= 1 ; 
										}
									}
									break;

							}
						}
					}

					$toDemainFerie = $this->getJourFerie ($zDateDemainFerie);

					if (sizeof($toDemainFerie)>0){
						foreach ($toDemainFerie as $oDemainFerie){
							switch($oDemainFerie['ferie_jour']) {
								case 'Fri':
									if (date("Y-m-d") <= '2018-09-24'){
										$iNombreConge += 3 ; 
										if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1){
											$iNombreConge -= 3 ; 
										}
									}
								break;

								default:
									if (date("Y-m-d") <= '2018-09-24'){
										$iNombreConge += 1 ; 
										if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1){
											$iNombreConge -= 1 ; 
										}
									}
									break;

							}
						}
					}

					$iTestDayFinFerie = date("D", strtotime($toRow1['gcap_dateFin']));

					if ($iTestDayFinFerie == 'Fri') {
						$zDateLundiFerie = date("Y-m-d", strtotime($toRow1['gcap_dateFin'] ."+3 days"));

						$toLundiFerie = $this->getJourFerie ($zDateLundiFerie);

						if (sizeof($toLundiFerie)>0){
							foreach ($toLundiFerie as $oLundiFerie){
								switch($oLundiFerie['ferie_jour']) {
									case 'Mon':
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 1 ; 

											$iTestDayFin = date("D", strtotime($toRow1['gcap_dateFin']));

											if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1 &&  $iTestDayFin == 'Fri') {
												$iNombreConge -= 1 ; 
											}
										}
									break;
								}
							}
						}
					}

					/* Test fin jour férié*/

				if ($iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iNombreConge += 2;
					}
				}

				if ($iTestDayFin1 == 'Fri') {
					$iNombreConge += 2;
				}

				if ($iTestDayFin1 == 'Sat') {
					$iNombreConge += 1;
				}

				if ($toRow1['gcap_demiJournee'] == 1) {
					$iNombreConge -= 0.5 ; 
				}

				if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iNombreConge -= 2;
					}
				}

				if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
					$iNombreConge -= 2;
				}

			}

			/*if ($toRow1["gcap_typeGcapId"] == CONGE) {

				$toFraction = $this->Fraction->get_fractions_by_conge_id ($toRow1["gcap_id"], $toRow1["gcap_userSendId"]);
				foreach ($toFraction as $oFraction){
					$iNombreConge += $oFraction['fraction_nbrJour'] ; 
				}

			} else {
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 

				$iTestDayDeb1 = date("D", strtotime($toRow1['gcap_dateDebut']));
				$iTestDayFin1 = date("D", strtotime($toRow1['gcap_dateFin']));

				if ($iTestDayDeb1 == 'Mon') {
					$iNombreConge += 2;
				}

				if ($iTestDayFin1 == 'Fri') {
					$iNombreConge += 2;
				}

				if ($toRow1['gcap_demiJournee'] == 1) {
					$iNombreConge -= 0.5 ; 
				}

				if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
					$iNombreConge -= 2;
				}

				if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
					$iNombreConge -= 2;
				}

			}*/
			$oRow[$i]["iNombreConge"] = $iNombreConge ; 

			 $i++ ; 
		}

		return $oRow;
	}


	public function get_all_gcap_extrants($_zCandidat,$_oUser,$_oCandidat, $_iUserId, $_iCompteActif,&$_iNbrTotal = 0){

		$DB1 = $this->load->database('gcap', TRUE);

		global $db;

		$toColumns = array( 
			0 => 'iGcapId', 
			1 => 'gcap_dateDebut',
			2 => 'gcap_dateFin',
			3 => 'matricule'
		);

		$oRequest = $_REQUEST;

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);

		$zSql= "SELECT  SQL_CALC_FOUND_ROWS *,
						gcap_id AS iGcapId,
						CONCAT(c.nom,' ',c.prenom) AS agent,
						(SELECT CONCAT(nom, '  ',prenom)  FROM rohi.candidat WHERE user_id =gcap_userValidId)nom_validateur
						FROM gcap a
					INNER JOIN gcap.type ON gcap_typeId = type_id
					INNER JOIN rohi.candidat c ON c.user_id = gcap_userSendId
					INNER JOIN statut ON  gcap_statutId = statut_id
					WHERE 1";

		
		if ($_zCandidat != "")
		{
			$zSql .= " AND gcap_userSendId IN ($_zCandidat) " ;

		} else {

			if ($zUserId != "") {
				$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
			}
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( type_libelle LIKE '%".$oRequest['search']['value']."%' ";
			/*$zSql.=" OR gcap_dateDebut LIKE '%".$oRequest['search']['value']."%' ";*/
			$zSql.=" OR statut_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.prenom LIKE '%".$oRequest['search']['value']."%' )";
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($oRequest["iMatricule"]) && $oRequest["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $oRequest["iMatricule"]."'" ;
		}

		if (isset($oRequest["iCin"]) && $oRequest["iCin"] != "") {
			
			$iCin = $oRequest["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY gcap_id DESC";
			}


			if (isset($oRequest['start'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			} else {
				$zSql.=" LIMIT 0,5   ";
			}
		} else {
			$zSql.=" ORDER BY gcap_id DESC ";
			$zSql.=" LIMIT 0,5   ";
		}

		/*die();*/


		$zQuery				= $DB1->query($zSql);
		$oRow				= $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount	= "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount		= $DB1->query($zQueryDataCount) ;
        $toRow				= $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal		= $toRow[0]['iNumRows'] ;
		}

		$iNombreConge		= 0;
		$i = 0 ; 
		foreach ($oRow as $toRow1){
			$iMotif = (int)$toRow1["gcap_motif"];
			if($iMotif > 0){
				 $toRes = $this->getMotifLibelle ((int)$toRow1["gcap_motif"]);
				 if (sizeof($toRes) > 0) {
					if (isset($toRes[0]['motif_libelle'])){
						$oRow[$i]["gcap_motif"] = $toRes[0]['motif_libelle'] ; 
					}
				 }
			 }
			if ($toRow1["gcap_typeGcapId"] == REPOS_MEDICAL) {
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 
			}else{
			
				$zDateDebut						= $toRow1["gcap_dateDebut"]; 
				$zDateFin						= $toRow1["gcap_dateFin"];  
				/*$zDateDebut					= $this->date_fr_to_en("06/08/2019",'/','-');
				$zDateFin						= $this->date_fr_to_en("05/08/2019",'/','-');*/

				//testons si le date debut est ferie
				$toDateDebutCongeFerie			= $this->Gcap->getJourFerie($zDateDebut);
				if( sizeof($toDateDebutCongeFerie) > 0){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
				}
				//testons si date fin est ferié
				$toDateFinCongeferie			= $this->Gcap->getJourFerie($zDateFin);
				if( sizeof($toDateFinCongeferie) > 0 ){
					$zDateFin					= date("Y-m-d", strtotime($zDateFin ."-1 days"));
				}
				//ajuster date debut vers lundi
				if( date("D", strtotime($zDateDebut ."+0 days")) =="Sat"){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+2 days"));
				}
				if( date("D", strtotime($zDateDebut ."+0 days")) =="Sun"){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
				}
				$iNombreConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;
				$zJourPriseService				= date("D", strtotime($zDateFin ."+1 days") );
				if( $iNombreConge > 0 && $iNombreConge <= 7  && $zJourPriseService =="Sun"){
						$iNombreConge			= $iNombreConge -1;
				}
				if( $iNombreConge > 0 && $iNombreConge <= 7  && $zJourPriseService =="Mon"){
					$iNombreConge				= $iNombreConge -2;
				}
				//demie journée
				$iDemiJournee					= $toRow1['gcap_demiJournee'];
				if ($iDemiJournee == 1) {
					$iNombreConge = $iNombreConge-0.5;
				}
				$oRow[$i]["iNombreConge"] = $iNombreConge ; 
				$iNombreConge = 0;
			} 
			
		    $i++ ; 
		}

		return $oRow;
	}

	public function get_mes_demandes_de_conge($criteriaSearch,$_zCandidat,$_oUser,$_oCandidat, $_iUserId, $_iCompteActif,&$_iNbrTotal = 0){

		$DB1 = $this->load->database('gcap', TRUE);

		global $db;

		$toColumns = array( 
			0 => 'iGcapId', 
			1 => 'gcap_dateDebut',
			2 => 'gcap_dateFin',
			3 => 'matricule'
		);

		$oRequest = $_REQUEST;

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zNotIn = "";
		switch ($_iCompteActif){
			case COMPTE_AGENT:
				$zUserId = $this->get_agents_ayant_meme_evaluateur ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);
				break;
			case COMPTE_RESPONSABLE_PERSONNEL:
				$zUserId = $this->Gcap->get_sous_ma_responsabilite($_oCandidat);
				break;
			case COMPTE_AUTORITE:
				$zUserId = $this->Gcap->get_sous_mon_autorite($_oCandidat);
				break;
			case COMPTE_ADMIN:
				$zUserId = $this->Gcap->get_agents_mef ();
				break;
			case COMPTE_EVALUATEUR:			
				$zUserId = $this->Gcap->get_agents_evalues_par_user_id ($_oUser['id']);
				break;
			default:
				
			break;
		}
		//$zUserId = $this->get_agents_ayant_meme_evaluateur ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);
		$zSql= "SELECT  SQL_CALC_FOUND_ROWS *,
						gcap_id AS iGcapId,
						c.id AS candidat_id,
						CONCAT(c.nom,' ',c.prenom) AS agent,
						(SELECT CONCAT(nom, '  ',prenom)  FROM rohi.candidat WHERE user_id =gcap_userValidId)nom_validateur
						FROM gcap a
					INNER JOIN gcap.type ON gcap_typeId = type_id
					INNER JOIN rohi.candidat c ON c.user_id = gcap_userSendId
					INNER JOIN statut ON  gcap_statutId = statut_id
					WHERE 1";
		if ($_zCandidat != ""){
			$zSql .= " AND gcap_userSendId IN ($_zCandidat) " ;

		} else {
			if ($zUserId != "") {
				$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
			}
		}

		if( !empty($criteriaSearch) ) {   
			$zSql.=" AND ( type_libelle LIKE '%".$criteriaSearch."%' ";
			$zSql.=" OR c.matricule LIKE '%".$criteriaSearch."%' ";
			$zSql.=" OR statut_libelle LIKE '%".$criteriaSearch."%' ";
			$zSql.=" OR c.nom LIKE '%".$criteriaSearch."%' ";
			$zSql.=" OR c.prenom LIKE '%".$criteriaSearch."%' ";
			$zSql.=" OR c.cin LIKE '%".$criteriaSearch."%' )";
		}

		if ($zNotIn != ""){
			$zSql .= $zNotIn ;
		}

		if (isset($oRequest["iMatricule"]) && $oRequest["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $oRequest["iMatricule"]."'" ;
		}

		if (isset($oRequest["iCin"]) && $oRequest["iCin"] != "") {
			
			$iCin = $oRequest["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY gcap_id DESC";
			}


			if (isset($oRequest['start'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			} else {
				$zSql.=" LIMIT 0,5   ";
			}
		} else {
			$zSql.=" LIMIT 0,5   ";
		}

		$zQuery				= $DB1->query($zSql);
		$oRow				= $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount	= "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount		= $DB1->query($zQueryDataCount) ;
        $toRow				= $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal		= $toRow[0]['iNumRows'] ;
		}

		$iNombreConge		= 0;
		$i = 0 ; 
		foreach ($oRow as $toRow1){
			$iMotif = (int)$toRow1["gcap_motif"];
			if($iMotif > 0){
				 $toRes = $this->getMotifLibelle ((int)$toRow1["gcap_motif"]);
				 if (sizeof($toRes) > 0) {
					if (isset($toRes[0]['motif_libelle'])){
						$oRow[$i]["gcap_motif"] = $toRes[0]['motif_libelle'] ; 
					}
				 }
			 }
			if ($toRow1["gcap_typeGcapId"] == REPOS_MEDICAL) {
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 
			}else{
				$zDateDebut						= $toRow1["gcap_dateDebut"]; 
				$zDateFin						= $toRow1["gcap_dateFin"];  
				//testons si le date debut est ferie
				$toDateDebutCongeFerie			= $this->Gcap->getJourFerie($zDateDebut);
				if( sizeof($toDateDebutCongeFerie) > 0){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
				}
				//testons si date fin est ferié
				$toDateFinCongeferie			= $this->Gcap->getJourFerie($zDateFin);
				if( sizeof($toDateFinCongeferie) > 0 ){
					$zDateFin					= date("Y-m-d", strtotime($zDateFin ."-1 days"));
				}
				//ajuster date debut vers lundi
				if( date("D", strtotime($zDateDebut ."+0 days")) =="Sat"){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+2 days"));
				}
				if( date("D", strtotime($zDateDebut ."+0 days")) =="Sun"){
					$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
				}
				$iNombreConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;
				$zJourPriseService				= date("D", strtotime($zDateFin ."+1 days") );
				if( $iNombreConge > 0 && $iNombreConge <= 7  && $zJourPriseService =="Sun"){
						$iNombreConge			= $iNombreConge -1;
				}
				if( $iNombreConge > 0 && $iNombreConge <= 7  && $zJourPriseService =="Mon"){
					$iNombreConge				= $iNombreConge -2;
				}
				//demie journée
				$iDemiJournee					= $toRow1['gcap_demiJournee'];
				if ($iDemiJournee == 1) {
					$iNombreConge = $iNombreConge-0.5;
				}
			} 
			$oRow[$i]["iNombreConge"] = $iNombreConge ; 
			$iNombreConge = 0;
		    $i++ ; 
		}

		return $oRow;
	}
	public function get_all_gcap_extrants_tojo($_zCandidat,$_oUser,$_oCandidat, $_iUserId, $_iCompteActif,&$_iNbrTotal = 0){

		$DB1 = $this->load->database('gcap', TRUE);

		global $db;

		$toColumns = array( 
			0 => 'iGcapId', 
			1 => 'gcap_dateDebut',
			2 => 'gcap_dateFin',
			3 => 'matricule'
		);

		$oRequest = $_REQUEST;

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);

		//echo $zUserId ; 

		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,gcap_id as iGcapId,CONCAT(c.nom,' ',c.prenom) as agent FROM gcap
				INNER JOIN type ON gcap_typeId = type_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				INNER JOIN statut ON  gcap_statutId = statut_id
				WHERE 1";

		
		if ($_zCandidat != "")
		{
			$zSql .= " AND gcap_userSendId IN ($_zCandidat) " ;

		} else {

			if ($zUserId != "") {
				$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
			}
		}

		if( !empty($oRequest['search']['value']) ) {   
			$zSql.=" AND ( type_libelle LIKE '%".$oRequest['search']['value']."%' ";
			/*$zSql.=" OR gcap_dateDebut LIKE '%".$oRequest['search']['value']."%' ";*/
			$zSql.=" OR statut_libelle LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.nom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.prenom LIKE '%".$oRequest['search']['value']."%' )";
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($oRequest["iMatricule"]) && $oRequest["iMatricule"] != "") {
			$zSql .= " AND matricule = '" . $oRequest["iMatricule"]."'" ;
		}

		if (isset($oRequest["iCin"]) && $oRequest["iCin"] != "") {
			
			$iCin = $oRequest["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			} else {
				$zSql.=" ORDER BY gcap_id DESC";
			}


			if (isset($oRequest['start'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			} else {
				$zSql.=" LIMIT 0,5   ";
			}
		} else {
			$zSql.=" ORDER BY gcap_id DESC ";
			$zSql.=" LIMIT 0,5   ";
		}

		//echo $zSql;
		/*die();*/


		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;
        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		$iNombreConge = 0;
		$i = 0 ; 
		foreach ($oRow as $toRow1)
		{
			 $iMotif = (int)$toRow1["gcap_motif"];

			if($iMotif > 0){
			 
				 $toRes = $this->getMotifLibelle ((int)$toRow1["gcap_motif"]);

				 if (sizeof($toRes) > 0) {
					if (isset($toRes[0]['motif_libelle'])){
						$oRow[$i]["gcap_motif"] = $toRes[0]['motif_libelle'] ; 
					}
				 }
			 }

			 if ($toRow1["gcap_typeGcapId"] == REPOS_MEDICAL) {

				/*$toFraction = $this->Fraction->get_fractions_by_conge_id ($toRow1["gcap_id"], $toRow1["gcap_userSendId"]);
				foreach ($toFraction as $oFraction){
					$iNombreConge += $oFraction['fraction_nbrJour'] ; 
				}*/
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 

			} else {
				$iNombreConge = floor($this->human_time_diff ($toRow1["gcap_dateDebut"], $toRow1["gcap_dateFin"])) ; 

				$iTestDayDeb1 = date("D", strtotime($toRow1['gcap_dateDebut']));
				$iTestDayFin1 = date("D", strtotime($toRow1['gcap_dateFin']));

				$toGcapWeekEnd = array(CONGE,AUTORISATION_ABSENCE,PERMISSION);

				
				/*if(in_array($iTypeGcapId, $toGcapWeekEnd)){*/

						/* Test jour férié*/
						$zDateHierFerie = date("Y-m-d", strtotime($toRow1['gcap_dateDebut'] ."-1 days"));
						$zDateDemainFerie = date("Y-m-d", strtotime($toRow1['gcap_dateFin'] ."+1 days"));

						$toPasseFerie = $this->getJourFerie ($zDateHierFerie);

						if (sizeof($toPasseFerie)>0){
							foreach ($toPasseFerie as $oPasseFerie){
								switch($oPasseFerie['ferie_jour']) {
									case 'Mon':
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 3 ; 
											if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2){
												$iNombreConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 1 ; 
											if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2){
												$iNombreConge -= 1 ; 
											}
										}
										break;

								}
							}
						}

						$toDemainFerie = $this->getJourFerie ($zDateDemainFerie);

						if (sizeof($toDemainFerie)>0){
							foreach ($toDemainFerie as $oDemainFerie){
								switch($oDemainFerie['ferie_jour']) {
									case 'Fri':
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 3 ; 
											if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1){
												$iNombreConge -= 3 ; 
											}
										}
									break;

									default:
										if (date("Y-m-d") <= '2018-09-24'){
											$iNombreConge += 1 ; 
											if($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1){
												$iNombreConge -= 1 ; 
											}
										}
										break;

								}
							}
						}

						$iTestDayFinFerie = date("D", strtotime($toRow1['gcap_dateFin']));

						if ($iTestDayFinFerie == 'Fri') {
							$zDateLundiFerie = date("Y-m-d", strtotime($toRow1['gcap_dateFin'] ."+3 days"));

							$toLundiFerie = $this->getJourFerie ($zDateLundiFerie);

							if (sizeof($toLundiFerie)>0){
								foreach ($toLundiFerie as $oLundiFerie){
									switch($oLundiFerie['ferie_jour']) {
										case 'Mon':
											if (date("Y-m-d") <= '2018-09-24'){
												$iNombreConge += 1 ; 

												$iTestDayFin = date("D", strtotime($toRow1['gcap_dateFin']));

												if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1 &&  $iTestDayFin == 'Fri') {
													$iNombreConge -= 1 ; 
												}
											}
										break;
									}
								}
							}
						}

					/* Test fin jour férié*/

					if ($iTestDayDeb1 == 'Mon') {
						if (date("Y-m-d") <= '2018-09-24'){
							$iNombreConge += 2;
						}
					}

					if ($iTestDayFin1 == 'Fri') {
						$iNombreConge += 2;
					}

					if ($iTestDayFin1 == 'Sat') {
						$iNombreConge += 1;
					}

					if ($toRow1['gcap_demiJournee'] == 1) {
						$iNombreConge -= 0.5 ; 
					}

					if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
						if (date("Y-m-d") <= '2018-09-24'){
							$iNombreConge -= 2;
						}
					}

					if ($toRow1['gcap_demiJournee'] == 1 && $toRow1['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
						$iNombreConge -= 2;
					}
				}

			/*}*/

			
			$oRow[$i]["iNombreConge"] = $iNombreConge ; 

			 $i++ ; 
		}

		return $oRow;
	}

	public function __getMotifLibelle($_iMotifId)
	{

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select * from motif where motif_id = '$_iMotifId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getMotifLibelle($_iMotifId)
	{

		$DB1 = $this->load->database('gcap', TRUE);

		$iTestMotif = (int)$_iMotifId ; 

		if ($iTestMotif > 0)
		{
			$zSql= "select * from motif where motif_id = '$_iMotifId'";
			$zQuery = $DB1->query($zSql);
			return $zQuery->result_array();
		} else {
			return $_iMotifId ; 
		}
	}

	public function TestDate($_iUserId, $_zDateDebut, $_zDateFin, $_iTypeId)
	{
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "select * from gcap where gcap_typeId = '$_iTypeId'";

		if ($_zDateDebut != $_zDateFin) {
			/*$zSql .= " AND gcap_dateDebut <= '$_zDateDebut' AND gcap_dateFin >='$_zDateDebut'" ; 
			$zSql .= " OR gcap_dateDebut <= '$_zDateFin' AND gcap_dateFin >='$_zDateFin'" ; */

			$zSql .= " AND ('$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin AND gcap_userSendId = '$_iUserId' AND gcap_valide<>2) " ; 
			$zSql .= " OR ('$_zDateFin' BETWEEN gcap_dateDebut AND gcap_dateFin AND gcap_userSendId = '$_iUserId' AND gcap_valide<>2) " ; 
		} else {
			//$zSql .= " AND gcap_dateDebut = '$_zDateDebut' AND gcap_dateFin ='$_zDateFin'" ; 
			$zSql .= " AND '$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin AND gcap_userSendId = '$_iUserId' AND gcap_valide<>2 " ; 
		}


		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		return $toRow;
	}
	
	public function testDoublonDemande($_zDateDebut, $_zDateFin, $_iUserId)
	{
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "select * from gcap.gcap where gcap_userSendId = '$_iUserId'";

		if ($_zDateDebut != $_zDateFin) {
			$zSql .= " AND ('$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin  " ; 
			$zSql .= " OR   '$_zDateFin' BETWEEN gcap_dateDebut AND gcap_dateFin  ) " ; 
		} else {
			$zSql .= " AND '$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin  " ; 
		}

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		return $toRow;
	}
	
	public function testInterim($_zDateDebut, $_zDateFin, $_iMatricule)
	{
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select * from gcap.gcap where gcap_interim like '%".$_iMatricule."%' ";

		if ($_zDateDebut != $_zDateFin) {
			$zSql .= " AND ('$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin  ) " ; 
			$zSql .= " OR ('$_zDateFin' BETWEEN gcap_dateDebut AND gcap_dateFin  ) " ; 
		} else {
			$zSql .= " AND '$_zDateDebut' BETWEEN gcap_dateDebut AND gcap_dateFin  " ; 
		}
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		return $toRow;
	}

	public function get_all_gcap_etat_journal_planning($oUser,$_oDataSearch=array(), $_oCandidat, $_iUserId, $_iTypeGcapId,$_iCompteActif, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "gcap_id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = ""; 

		//$zUserId = $_iUserId ;

		$iAffiche = 0;
		if ($_iCompteActif == COMPTE_AUTORITE) {
			$iAffiche = 1;
		}

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,0);


		$zSql= "SELECT SQL_CALC_FOUND_ROWS * FROM gcap
				INNER JOIN type ON gcap_typeId = type_id
				INNER JOIN statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				WHERE 1
				AND gcap_valide = 1";

		/*$zSql= "SELECT SQL_CALC_FOUND_ROWS *,REPLACE(cin,' ','') as cin FROM gcap
				INNER JOIN TYPE ON gcap_typeId = type_id
				INNER JOIN statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				WHERE 1 ";*/

		if ($_iTypeGcapId != 0)
		{
			$zSql .= " AND gcap_typeGcapId = $_iTypeGcapId" ; 
		}
		
		if ($zUserId != "")
		{
			$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if(isset($_oDataSearch["iDivisionId"]) && ($_oDataSearch["iDivisionId"] != 0)) {

			$zSql .= " AND c.division =  " . $_oDataSearch["iDivisionId"];

		}elseif(isset($_oDataSearch["iServiceId"]) && ($_oDataSearch["iServiceId"] != 0)){

			$zSql .= " AND c.service =  " . $_oDataSearch["iServiceId"];


		}elseif(isset($_oDataSearch["iDirectionId"]) && ($_oDataSearch["iDirectionId"] != 0)){

			$zSql .= " AND c.direction =  " . $_oDataSearch["iDirectionId"];


		}elseif(isset($_oDataSearch["iDepartementId"]) && ($_oDataSearch["iDepartementId"] != 0)){

			$zSql .= " AND c.departement =  " . $_oDataSearch["iDepartementId"];
		}


		if(isset($_oDataSearch["zLocalite"]) && ($_oDataSearch["zLocalite"] != '')) {

			$zSql .= " AND (c.porte like  '%" . $_oDataSearch["zLocalite"] . "%' OR c.lacalite_service like '%" . $_oDataSearch["zLocalite"] . "%')";

		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		
		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;


		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $oRow;
	}


	public function get_all_gantt_planning($oUser,$_oDataSearch=array(), $_oCandidat, $_iUserId, $_iTypeGcapId,$_iCompteActif, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "gcap_id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = ""; 

		$zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);
		$zSqlInsert = "";
		if(isset($_oDataSearch)){
			if ($_oDataSearch['zDateDebut'] != $_oDataSearch['zDateFin']) {
				$zSqlInsert .= " AND gcap_dateDebut >= '".$_oDataSearch['zDateDebut']."'" ; 
				$zSqlInsert .= " AND gcap_dateFin <= '".$_oDataSearch['zDateFin']."'" ; 
			} else {
				$zSqlInsert .= " AND gcap_dateDebut >= '".$_oDataSearch['zDateDebut']."'" ; 
			}
		}
		
		$zSql= "SELECT	DISTINCT c.nom,
						c.prenom,
						c.user_id as iUserId,
						(	SELECT GROUP_CONCAT(CONCAT(gcap_dateDebut,'/',gcap_dateFin,'/',gcap_typeGcapId,'/',gcap_demiJournee,'/',gcap_MatinSoir)			SEPARATOR ';') 
							FROM gcap 
							WHERE gcap_userSendId = c.user_id ".$zSqlInsert." 
							AND (gcap_valide IS NULL OR gcap_valide = 1)
						) as GcapDate 
				FROM $zDatabaseOrigin.candidat c
				LEFT JOIN gcap.gcap d
				ON c.user_id = d.gcap_userSendId
				WHERE c.user_id IN (".$zUserId.") 
				ORDER BY d.gcap_dateDebut DESC
				LIMIT 0, 5000";
				
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
	
		return $toRow;

	}

	public function get_all_gcap_etat($_oDataSearch=array(), $_oCandidat, $_iUserId, $_iTypeGcapId,$_iCompteActif, &$_iNbrTotal = 0, $_iValPerPage = NB_PER_PAGE, $_iCurrPage = 1, $_zSortSens = "DESC", $_zFieldOrder = "gcap_id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = ""; 

		$zUserId = $_iUserId ;


		$zSql= "SELECT SQL_CALC_FOUND_ROWS * FROM gcap
				INNER JOIN type ON gcap_typeId = type_id
				INNER JOIN statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				WHERE 1
				AND gcap_valide = 1";

		/*$zSql= "SELECT SQL_CALC_FOUND_ROWS *,REPLACE(cin,' ','') as cin FROM gcap
				INNER JOIN TYPE ON gcap_typeId = type_id
				INNER JOIN statut ON  gcap_statutId = statut_id
				INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = gcap_userSendId
				WHERE 1 ";*/

		if ($_iTypeGcapId != 0)
		{
			$zSql .= " AND gcap_typeGcapId = $_iTypeGcapId" ; 
		}
		
		if ($zUserId != "")
		{
			$zSql .= " AND gcap_userSendId IN ($zUserId) " ;
		}

		if ($zNotIn != "")
		{
			$zSql .= $zNotIn ;
		}

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
		}

		if(isset($_oDataSearch["iDivisionId"]) && ($_oDataSearch["iDivisionId"] != 0)) {

			$zSql .= " AND c.division =  " . $_oDataSearch["iDivisionId"];

		}elseif(isset($_oDataSearch["iServiceId"]) && ($_oDataSearch["iServiceId"] != 0)){

			$zSql .= " AND c.service =  " . $_oDataSearch["iServiceId"];


		}elseif(isset($_oDataSearch["iDirectionId"]) && ($_oDataSearch["iDirectionId"] != 0)){

			$zSql .= " AND c.direction =  " . $_oDataSearch["iDirectionId"];


		}elseif(isset($_oDataSearch["iDepartementId"]) && ($_oDataSearch["iDepartementId"] != 0)){

			$zSql .= " AND c.departement =  " . $_oDataSearch["iDepartementId"];
		}


		if(isset($_oDataSearch["zLocalite"]) && ($_oDataSearch["zLocalite"] != '')) {

			$zSql .= " AND (c.porte like  '%" . $_oDataSearch["zLocalite"] . "%' OR c.lacalite_service like '%" . $_oDataSearch["zLocalite"] . "%')";

		}

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		
		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;
		$zSql .= " LIMIT " . ($_iCurrPage - 1) * $_iValPerPage . ", " . $_iValPerPage ;

		//echo $zSql ; 


		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		// nombre des résultats trouvés
        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}


		return $oRow;
	}


	public function get_candidat($_iUserId){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		if ($_iUserId === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.candidat');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin.'.candidat', array('user_id' => $_iUserId));
		return $query->row_array();
	}

	public function get_candidat_object($_iUserId){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		if ($_iUserId === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.candidat');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin.'.candidat', array('user_id' => $_iUserId));
		return $query->result();
	}

	public function get_Organisation($id = FALSE, $_zNomOrganisation='departement', $_iTypeSearch = 0){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= 'select * from '.$zDatabaseOrigin.'.'.$_zNomOrganisation; 
		
		switch ($_iTypeSearch){
		
			case 0:
				if ($id === FALSE){
					$query  = $this->db->get($zDatabaseOrigin.'.'.$_zNomOrganisation);
					return $query->result_array();
				}
				$query		= $this->db->get_where($zDatabaseOrigin.'.'.$_zNomOrganisation, array('id' => $id));
				return $query->row_array();
				break;

			case 1:
				$zSql .= " where departement_id IN (".$id.") ORDER BY departement_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 2:
				$zSql .= " where direction_id IN (".$id.") ORDER BY direction_id,id ";
				$query = $this->db->query($zSql);
					
				return $query->result_array();
				break;

			case 3:
				$zSql .= " where service_id IN (".$id.") ORDER BY service_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;
		}

		
		return $query->row_array();
	}

	public function get_service($id = FALSE){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		if ($id === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.service');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin.'.service', array('id' => $id));
		return $query->row_array();
	}

	public function get_all_list_valide_same_service($service_id=false){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$sql= "select candidat.* from $zDatabaseOrigin.candidat,$zDatabaseOrigin.user where candidat.user_id = user.id and user.validate = true ";
		if($service_id){
			$sql .= " and service = $service_id" ;
		}

		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function setTestQuestionnaire($_iUserId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql = "select * from $zDatabaseGcap.question WHERE question_userId = " . $_iUserId;


		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof($oRow)>0){
			$iReturn = 1;
		}

		return $iReturn;
	}


	public function setTestQuestionnaireObject($_iUserId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql = "select * from $zDatabaseGcap.question WHERE question_userId = " . $_iUserId;


		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;
	}

	public function setFicheDePoste($_iUserId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql = "select * from $zDatabaseGcap.ficheposte WHERE fichePoste_userId = " . $_iUserId . " LIMIT 0,1";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof($oRow)>0){
			$iReturn = 1;
		}

		return $iReturn;
	}

	public function testAppartenance($_iUserId, $_iId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql = "select * from $zDatabaseGcap.gcap WHERE gcap_userSendId = ".$_iUserId."  AND gcap_id = " . $_iId . " LIMIT 0,1";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof($oRow)>0){
			$iReturn = 1;
		}

		return $iReturn;
	}



	public function setChef($_iUserId){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql = "SELECT * FROM $zDatabaseOrigin.candidat WHERE (
		fonction_actuel LIKE '%chef de division%' OR fonction_actuel LIKE '%chef de service%' OR fonction_actuel LIKE '%directeur%' OR poste LIKE '%chef de division%' OR poste LIKE '%chef de service%' OR poste LIKE '%directeur%' )  
		AND  user_id = " . $_iUserId;

		//echo $zSql ; 

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof($oRow)>0){
			$iReturn = 1;
		}

		return $iReturn;
	}

	
	public function setChefService($_iUserId){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE (fonction_actuel LIKE '%chef de service%' OR poste LIKE '%chef de service%')  AND  user_id = " . $_iUserId;
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof($oRow)>0){
			$iReturn = 1;
		}

		if ($iReturn == 0){
			$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat WHERE (fonction_actuel LIKE '%directeur%' OR poste LIKE '%directeur%')  AND  user_id = " . $_iUserId;
			$zQuery = $this->db->query($zSql);
			$oRow = $zQuery->result();
			$zQuery->free_result(); 

			$iReturn = 0;
			if (sizeof($oRow)>0){
				$iReturn = 2;
			}
		}



		return $iReturn;
	}

	public function getLocaliteService($_iUserId=0){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSigle = "";
		
		$zSql = "SELECT sigle_departement,sigle_direction,sigle_service,sigle_module,
				d.libele as departementNom,
				di.libele as directionNom,
				s.libele as serviceNom,
				m.libele as divisionNom,
				d.id as iDepartementId
				FROM $zDatabaseOrigin.candidat
				INNER JOIN $zDatabaseOrigin.departement d ON d.id = departement
				INNER JOIN $zDatabaseOrigin.direction di ON di.id = direction
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = service
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = division
				WHERE user_id = $_iUserId";
		
		$zQuery = $this->db->query($zSql);
		$toLocalite = $zQuery->result_array();

		return $toLocalite ; 
	}
	public function get_sigle($_this, $_iUserId=false, $_isSigle=1){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSigle = "";
		$zSql = " SELECT path FROM rohi.candidat WHERE user_id ='".$_iUserId."'";
		
		$zQuery = $this->db->query($zSql);
		$toSigle = $zQuery->row_array();
		$zPath		=	$toSigle["path"];
		$tzPath		=	explode("/",$zPath);
		$zSigle		=	"MINISTERE DE L'ECONOMIE ET DES FINANCES";
		$tzSigle	=	array();
		for($iIndex=0;$iIndex<=sizeof($tzPath);$iIndex++){
			$oLibelle	=	$this->get_libelle_by_sigle($tzPath[$iIndex]);
			$zSigle		=	$oLibelle["child_libelle"];
			array_push($tzSigle,$zSigle);
		}
		
		return $tzSigle;
	}
	
	public function get_libelle_by_sigle($_zSigle){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zSql = "  SELECT * FROM rohi.t_structure   WHERE sigle ='".addslashes($_zSigle)."' LIMIT 1 ";
		$zQuery = $this->db->query($zSql);
		$oLibelle = $zQuery->row_array();

		return $oLibelle;
	}

	public function get_sigle___($_this, $_iUserId=false, $_isSigle=1){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSigle = "";
		
		$zSql = "SELECT sigle_departement,sigle_direction,sigle_service,sigle_module,
				d.libele as departementNom,
				di.libele as directionNom,
				s.libele as serviceNom,
				m.libele as divisionNom,
				service,direction
				FROM $zDatabaseOrigin.candidat
				INNER JOIN $zDatabaseOrigin.departement d ON d.id = departement
				LEFT JOIN $zDatabaseOrigin.direction di ON di.id = direction
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = service
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = division
				WHERE user_id = $_iUserId";
		
		$zQuery = $this->db->query($zSql);
		$toSigle = $zQuery->result_array();

		if (sizeof ($toSigle)> 0)
		{
			foreach ($toSigle as $oSigle)
			{
				
				if ($_isSigle == 1) {
					if($oSigle['departementNom'] != ''){
						$zSigle .= $oSigle['sigle_departement'] ;
					}

					if($oSigle['directionNom'] != '' && ($oSigle['directionNom'] != $oSigle['departementNom'])){

						$tzDirectionSplit = explode("-",$oSigle['direction']);

						if(isset($tzDirectionSplit[1])){
							$oDirection = $_this->direction->get_direction($tzDirectionSplit[1]);
							$zSigle .= "/" .$oDirection['sigle_direction'];
						}

						$zSigle .= "/" . $oSigle['sigle_direction'];
					}

					if($oSigle['serviceNom'] != '' && ($oSigle['serviceNom'] != $oSigle['directionNom'])){

						$tzServiceSplit = explode("-",$oSigle['service']);

						if(isset($tzServiceSplit[1])){
							$oService = $_this->service->get_service($tzServiceSplit[1]);
							$zSigle .= "/" .$oService['sigle_service'];
						}
						
						$zSigle .= "/" .$oSigle['sigle_service'];

					} else {
						if ($oSigle['sigle_service'] == "DRH") {
							$zSigle .= "/SGRH";
						}
					}

					if ($oSigle['sigle_service'] != "DRH") {
						if($oSigle['divisionNom'] != '' && ($oSigle['divisionNom'] != $oSigle['serviceNom'])){
							$zSigle .= "/" .$oSigle['sigle_module'];
						}
					}
				} elseif ($_isSigle == 0) {

					if($oSigle['departementNom'] != ''){
						$zSigle .= $oSigle['departementNom']. "<br>";
					} else {
						$zSigle .= "Secretariat General<br>";
					}

					if($oSigle['directionNom'] != '' && ($oSigle['directionNom'] != $oSigle['departementNom'])){

						$tzDirectionSplit = explode("-",$oSigle['direction']);

						if(isset($tzDirectionSplit[1])){
							$oDirection = $_this->direction->get_direction($tzDirectionSplit[1]);
							$zSigle .= $oDirection['libele']. "<br>";
						}

						$zSigle .= $oSigle['directionNom']. "<br>";
					}

					if($oSigle['serviceNom'] != '' && ($oSigle['serviceNom'] != $oSigle['directionNom'])){

						$tzServiceSplit = explode("-",$oSigle['service']);

						if(isset($tzServiceSplit[1])){
							$oService = $_this->service->get_service($tzServiceSplit[1]);
							$zSigle .= $oService['libele'];
						}

						$zSigle .= "<p class='sm'>".$oSigle['serviceNom']."</p><br>";
					} else {
						if ($oSigle['sigle_service'] == "DRH") {
							$zSigle .= "<p class='sm'>Service de la Gestion des Ressources Humaines</p><br>";
						}
						
					}

					if ($oSigle['sigle_service'] != "DRH") {
						if($oSigle['divisionNom'] != '' && ($oSigle['divisionNom'] != $oSigle['serviceNom'])){
							$zSigle .= $oSigle['divisionNom']. "<br>";
						}
					}

				} else {
					$zSigle = $toSigle ; 
				}
			}
		}

		return $zSigle;
	}

	public function get_logo($_iUserId=false){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSigle = "";
		
		if($_iUserId!=""){
			
			$zSql = "SELECT sigle_direction,sigle_service
					FROM $zDatabaseOrigin.candidat
					INNER JOIN $zDatabaseOrigin.departement d ON d.id = departement
					INNER JOIN $zDatabaseOrigin.direction di ON di.id = direction
					LEFT JOIN $zDatabaseOrigin.service s ON s.id = service
					WHERE user_id = $_iUserId";
			
			$zQuery = $this->db->query($zSql);
			$toDepartement = $zQuery->result_array();
			$zLogo = "";
			if (sizeof ($toDepartement)> 0)
			{
				foreach ($toDepartement as $oDepartement)
				{
					if($oDepartement['logo'] != ''){
						$zLogo = $oDepartement['logo'] ;
					}

					if(($oDepartement['sigle_direction'] == 'DRH') || ($oDepartement['sigle_service'] == 'DRH')){
						$zLogo = "logo_DRH.png" ;
						
					}
				}
			}

			return $zLogo;
		}
	}
	
	public function get_all_list_valide_same_direction($direction_id=false){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$sql= "select candidat.* from $zDatabaseOrigin.candidat,$zDatabaseOrigin.user where candidat.user_id = user.id and user.validate = true ";
		if($direction_id){
			$sql .= " and direction = $direction_id" ;
		}
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}

	public function get_all_list_candidat($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,$zTerm= "aa",$_iFiltre=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "select candidat.* from $zDatabaseOrigin.candidat WHERE (nom LIKE '%$zTerm%' OR prenom LIKE '%$zTerm%')";

		if ($_iFiltre == 1 ) {
			
			$zNotIn = "";
			$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn, 1);

			if ($zUserId != ""){
				$zSql .= " AND user_id IN (".$zUserId.") " ; 
			}
		} else {
			$zSql .= " AND user_id NOT IN (select userCompte_userId FROM usercompte ) " ; 
		}
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function get_all_list_candidat1($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,$zTerm= "aa",$_iFiltre=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "select candidat.* from $zDatabaseOrigin.candidat WHERE (nom LIKE '%$zTerm%' OR prenom LIKE '%$zTerm%' OR cin LIKE '%$zTerm%'  OR matricule LIKE '%$zTerm%')";

		/*if ($_iFiltre == 1 ) {
			
			$zNotIn = "";
			//$zUserId = $this->getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn, 1);

			if ($zUserId != ""){
				$zSql .= " AND user_id IN (".$zUserId.") " ; 
			}
		} else {
			$zSql .= " AND user_id NOT IN (select userCompte_userId FROM usercompte ) " ; 
		}*/

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function get_all_list_MatriculeNom($_zMatricule, $_zCin){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "select candidat.*,candidat.nom as nomAgent,de.libele as zDepartement, d.libele as zDirection, s.libele as zService,REPLACE(cin,' ','') as cin2 from $zDatabaseOrigin.candidat 
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = candidat.service
		LEFT JOIN $zDatabaseOrigin.direction d ON d.id = candidat.direction
		LEFT JOIN $zDatabaseOrigin.departement de ON de.id = candidat.departement	
		WHERE 1 ";
		
		if ($_zMatricule != ""){
			$zSql .= " AND (candidat.nom LIKE '%$_zMatricule%' OR prenom LIKE '%$_zMatricule%' OR matricule LIKE '$_zMatricule%')";
		}

		if ($_zCin != ""){
			$iCin = $_zCin ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin2 = '" . $iCin . "'" ;

		}
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function get_all_list_institution($zTerm= "-111"){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$zSql= "select * from $zDatabaseGcap.institution WHERE (institution_libelle LIKE '%$zTerm%' OR ministere LIKE '%$zTerm%')";
		
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}
	
	public function getInstitutionByid($_institution_id){
		global $db;
		$DB1 			= $this->load->database('gcap', TRUE);
		$zDatabaseGcap 	=  $db['gcap']['database'] ;
		$sql			= "select * from $zDatabaseGcap.institution WHERE institution_id ='".$_institution_id."'";
		$query 			= $this->db->query($sql);
		return $query->row_array();
	}
	
	public function get_by_gcap_id($_iGcapId){
		$zSql= "select * from gcap where gcap_id = $_iGcapId ORDER BY gcap_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	public function notification_validate_Gcap($_oUser, $_oCandidat, $_iUserId, $_iTypeId, $_iSessionCompte){
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = ""; 
		switch ($_iSessionCompte)
		{
			case COMPTE_AGENT : 
			case COMPTE_SERVICE_ACCUIEL : 
				$zSql= " SELECT COUNT(gcap_id) as nb
				FROM gcap WHERE gcap_dateValidation <> '' AND gcap_userValidId <> '' AND gcap_vue = 0 AND gcap_userSendId = $_iUserId AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";

				break;
			
			case COMPTE_EVALUATEUR :
				$zUserId = $this->get_agents_evalues_par_user_id ($_oUser['id']);

				//echo $zUserId ; 

				if ($zUserId != '') {
					$zSql= " SELECT COUNT(gcap_id) as nb
					FROM gcap WHERE gcap_statutId = 1 AND gcap_userSendId IN ($zUserId) AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";
				} else {
					$zSql= " SELECT COUNT(gcap_id) as nb
					FROM gcap WHERE gcap_dateValidation = '' AND gcap_userValidId = '' AND gcap_vue = 0 AND gcap_userSendId = $_iUserId AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";
				}

				break;
			
			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv']!= '') {

						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.service = ".$_oUser['serv']." AND c.user_id <> $_iUserId " ; 


					} elseif ($_oUser['dir']!= '') {
						
						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.direction = ".$_oUser['dir']." AND c.user_id <> $_iUserId " ; 

					} elseif ($_oUser['dep']!= '') {

						$zUserId  = "SELECT user_id FROM $zDatabaseOrigin.candidat c WHERE c.departement = ".$_oUser['dep']." AND c.user_id <> $_iUserId " ;

					} else {
						
						/* même direction */
						/*$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.direction d ON c.direction = d.id
								WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.region_id = ".$_oCandidat[0]->region_id." 
								AND c.user_id <> $_iUserId " ;*/

						if ($_oCandidat[0]->service!='') {
					
							/* même service */
							$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.service s ON c.service = s.id
								WHERE s.id  = (SELECT service FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
							
						} else {
							/* même direction */
							$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.direction d ON c.direction = d.id
								WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
						}
					}

					$zSql= "SELECT COUNT(gcap_id) as nb
							FROM gcap WHERE gcap_statutId = ".STATUT_CREATION." AND gcap_userSendId IN ($zUserId) AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";

					break;

			case COMPTE_AUTORITE :

					if ($_oCandidat[0]->service!='') {
				
						/* même service */
						$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.service s ON c.service = s.id
							WHERE s.id  = (SELECT service FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
						
					} else {
						/* même direction */
						$zUserId = "SELECT user_id FROM $zDatabaseOrigin.candidat c INNER JOIN $zDatabaseOrigin.direction d ON c.direction = d.id
							WHERE d.id  = (SELECT direction FROM $zDatabaseOrigin.candidat WHERE id = ".$_oCandidat[0]->id.") AND c.user_id <> $_iUserId " ;
					}

					$zSql= "SELECT COUNT(gcap_id) as nb
							FROM gcap WHERE gcap_statutId IN (".STATUT_CREATION.",".STATUT_RECEPTION_RESP_PERSONNEL.") AND gcap_userSendId IN ($zUserId) AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";


				break;

			case COMPTE_ADMIN :	
				$zNotIn = " AND gcap_userSendId <> " . $_iUserId ;
				$zSql= "SELECT COUNT(gcap_id) as nb
							FROM gcap WHERE gcap_statutId IN (".STATUT_CREATION.",".STATUT_RECEPTION_RESP_PERSONNEL.") AND gcap_typeGcapId IN (".CONGE.",".AUTORISATION_ABSENCE.",".PERMISSION.",".MISSION.",".FORMATION.",".REPOS_MEDICAL.",".REPOS_MEDICAL_LUCIA.")";

				
				if ($zNotIn != "")
				{
					$zSql .= $zNotIn ;
				}
				break;
		
		}

		$zQuery = $DB1->query($zSql);

		$oResult = $zQuery->result_array(); 

		$iModuleId = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$iModuleId = $oResult[0]['nb'] ; 
		}
		return $iModuleId;
	}

	public function delete_gcap($_iGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('delete from gcap where gcap_id = '.$_iGcapId);
		
		//delete gcap pointage : supprimer les pointages dans SQL server
		//maj Abraham le 06/10/2021
		//$this->deleteGcapPointage($_iGcapId) ; 
	}

	public function delete_detache($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->query('delete from '.$zDatabaseGcap.'.detache where detache_userId = '.$_iUserId);
	}

	public function get_Gcap($iId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($iId === FALSE)
		{
			$zQuery = $DB1->get('gcap');
			return $zQuery->result_array();
		}

		$zQuery = $DB1->get_where('gcap', array('gcap_id' => $iId));
		return $zQuery->row_array();
	}


	public function nombreTotalPermissionAbscenceParAn($_iUserId, $iTypeGcapId){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "SELECT *,SUBSTRING(gcap_dateFin, 1, 4) AS annee FROM gcap 
				WHERE gcap_userSendId = $_iUserId
				AND gcap_typeGcapId = $iTypeGcapId
				HAVING annee = '".date("Y")."'";

		//echo $zSql ; 
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function nombreTotalPermissionParSixAn($_iUserId, $iTypeGcapId){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "SELECT *,SUBSTRING(gcap_dateFin, 1, 4) AS annee FROM gcap 
				WHERE gcap_userSendId = $_iUserId
				AND gcap_typeGcapId = $iTypeGcapId
				HAVING annee = '".date("Y")."'";

		//echo $zSql ; 
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function get_Gcap_motif($_iValueId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= " SELECT * from motif 
				 WHERE motif_autorisationId = " . $_iValueId;
		$zQuery = $DB1->query($zSql);

		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
 
	public function update_gcap($oData, $_iGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('gcap', $oData, "gcap_id = $_iGcapId");
		
		//NASORINA FA MISY BLEME 160
		///$this->updateGcapPointage($oData, $_iGcapId);
		return $_iGcapId ; 
	}

	function updateGcapPointage($_oGcapAll,$_iGcapId){

		
		$zSql = " Update [ZKGcap].[dbo].[gcap] SET  gcap_autorisaionCaracteristique = ''" ; 
		
		
		if (isset($_oGcapAll['gcap_userSendId'])){
			$zSql .= " , gcap_userSendId = '" . $_oGcapAll['gcap_userSendId'] . "'" ; 
		}

		if (isset($_oGcapAll['gcap_typeGcapId'])){
			$zSql .= " , gcap_userSendId = " . $_oGcapAll['gcap_typeGcapId'] . "'" ; 
		}

		if (isset($_oGcapAll['gcap_typeId'])){
			$zSql .= " , gcap_typeId = " . $_oGcapAll['gcap_typeId'] . "'" ;  
		}

		if (isset($_oGcapAll['gcap_dateDebut'])){
			$zSql .= " , gcap_dateDebut = " . $_oGcapAll['gcap_dateDebut'] . "'" ;  
		}

		if (isset($_oGcapAll['gcap_dateFin'])){
			$zSql .= " , gcap_dateFin = " . $_oGcapAll['gcap_dateFin'] . "'" ;  
		}

		if (isset($_oGcapAll['gcap_motif'])){
			$zSql .= " , gcap_motif = '" . str_replace("'","''",$_oGcapAll['gcap_motif']) . "'" ; 
		}

		if (isset($_oGcapAll['gcap_lieuJouissance'])){
			$zSql .= " , gcap_lieuJouissance = '" . str_replace("'","''",$_oGcapAll['gcap_lieuJouissance']) . "'" ; 
		}

		if (isset($_oGcapAll['gcap_statutId'])){
			$zSql .= " , gcap_statutId = '" . $_oGcapAll['gcap_statutId'] . "'" ; 
		}

		if (isset($_oGcapAll['gcap_userValidId'])){
			$zSql .= " , gcap_userValidId = '" . $_oGcapAll['gcap_userValidId'] . "'" ;  
		}

		if (isset($_oGcapAll['gcap_dateValidation'])){
			$zSql .= " , gcap_dateValidation = '" . $_oGcapAll['gcap_dateValidation']. "'" ; 
		}

		if (isset($_oGcapAll['gcap_valide'])){
			$zSql .= " , gcap_valide = '" . $_oGcapAll['gcap_valide'] . "'" ;  
		}

		if (isset($_oGcapAll['gcap_vue'])){
			$zSql .= " , gcap_vue = '" . $_oGcapAll['gcap_vue'] . "'" ; 
		}

		if (isset($_oGcapAll['gcap_autorisaionCaracteristique'])){
			$zSql .= " , gcap_autorisaionCaracteristique = '" . str_replace("'","''",$_oGcapAll['gcap_autorisaionCaracteristique']). "'" ;  
		}

		if (isset($_oGcapAll['gcap_MatinSoir'])){
			$zSql .= " , gcap_MatinSoir = '" . $_oGcapAll['gcap_MatinSoir']. "'" ;  
		}

		if (isset($_oGcapAll['gcap_demiJournee'])){
			$zSql .= " , gcap_demiJournee = '" . $_oGcapAll['gcap_demiJournee'] . "'" ; 
		}

		if (isset($_oGcapAll['conv_pers'])){
			$zSql .= " , gcap_convPers = '" . str_replace("'","''",$_oGcapAll['conv_pers']). "'" ; 
		}

		$zSql .= " WHERE gcap_id =  " . $_iGcapId ; 

		$this->executeQueryZKGcap($zSql);
	}

	public function update_gcap2($oData, $_iGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('gcap_autres', $oData, "gcap_id = $_iGcapId");
		return $_iGcapId ; 
	}

	public function setVue($_iGcapId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "update gcap SET gcap_vue = 1 WHERE gcap_id = " . $_iGcapId;
		$DB1->query($zSql);
	}

	 public function get_by_user_id($user_id){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		$sql= "select * from $zDatabaseOrigin.candidat where user_id = ".$user_id;
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}


	public function updateFunction($_iUserId, $_zFonction){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "update $zDatabaseOrigin.candidat SET fonction_actuel = '".$_zFonction."' WHERE user_id = " . $_iUserId;
		$this->db->query($zSql);
	}


	public function get_soa_by_service_id($service_id){
		
		$DB1 = $this->load->database('default', TRUE);
		if(empty($service_id))
			return null;
     	$sql= 'SELECT soa.* FROM soa,service_has_soa as serv where soa.id = serv.soa_id  and serv.service_id = '.$service_id;
     	$query = $DB1->query($sql);
     	$toRow = $query->result_array();

		$zSoa = "";

		foreach ($toRow as $oRow){
			$tozSoa = explode(":", $oRow['libele']);
			$zSoa = $tozSoa[1];
		}

		return $zSoa ; 
     }

	 public function get_motif_libelle($_iMotifId){
		$DB1 = $this->load->database('gcap', TRUE);
     	$zReturn = $_iMotifId ; 
		$_iMotifId = (int)$_iMotifId;
		if ($_iMotifId != 0){
			$sql= 'SELECT motif_libelle FROM motif WHERE motif_id = '.$_iMotifId;
     		$query = $DB1->query($sql);
     		$toRow = $query->result_array();
			foreach ($toRow as $oRow) {
				$zReturn = $oRow['motif_libelle'] ; 
			}
		}

		return $zReturn ; 
     }


	  public function getJourFerie($_zDate){
		$DB1 = $this->load->database('gcap', TRUE);
		$zSql	= "SELECT * FROM ferie WHERE ferie_date = '".$_zDate."'";
		$zQuery = $DB1->query($zSql);
		$toRow	= $zQuery->result_array();

		return $toRow ; 
     }

	 public function getDetacheId($_iUserId){
		
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql	= "SELECT * FROM $zDatabaseGcap.detache INNER JOIN $zDatabaseGcap.institution ON detache_institutionId = institution_id WHERE detache_userId = '".$_iUserId."'";
		$zQuery = $DB1->query($zSql);
		$toRow	= $zQuery->result_array();

		return $toRow ; 
     }


	 /**
	 * unix_timestamp()
	 * str date to timestamp
	 * @param mixed $zDate
	 * @return
	 */
	function human_time_diff($_zDateDebut, $_zDateFin) {

		$zDateDebut = $this->unix_timestamp( $_zDateDebut ) ; 

		$zDateFin = $this->unix_timestamp( $_zDateFin ) ; 

		//echo $zDateDebut . "--" . $zDateFin ; 

		$zDateDiff =  ($zDateFin - $zDateDebut)/86400 ;
		$zNombreJourConge = $zDateDiff + 1 ; 

		return $zNombreJourConge ; 
	}


	/**
	 * unix_timestamp()
	 * str date to timestamp
	 * @param mixed $zDate
	 * @return
	 */
	function unix_timestamp($zDate) {
		$zDate = str_replace(array(' ', ':'), '-', $zDate);
		$c    = explode('-', $zDate);
		$c    = array_pad($c, 6, 0);
		array_walk($c, 'intval');
		return mktime($c[3], $c[4], $c[5], $c[1], $c[2], $c[0]);
	}


	public function setImprimerPdf ($_oData, $_this) {

		$oCandidat	= $_oData["oCandidat"];
		$oService	= $_oData["oService"];
		$zService	= $_oData["zService"];
		$oGcap		= $_oData["oGcap"];
		$zLogo		= $_oData["getLogo"];
		$iTypeGcap  = $_oData['iTypeGcapId'] ; 

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("L");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 45;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);
			
			//$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iIncrement = 15 ; 
			$iLeft = 125 ; 
			$iRight = 145 ; 

			$iRight1 = 100 ; 
			$iRight2 = 60 ; 
			$iInterline = 6;

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

			$zImageLogoUrl =  base_url().'assets/gcap/images/def3.jpg';

			$oPdf->SetX(10);
			
			$oPdf->SetFont('Arial','I');
			$iMonth = (int)date("m");
			$zMonth = $toMonth[$iMonth];
			$oPdf->Cell($iLeft,$iInterline,' le, '.date('d').' '.$zMonth.' '.date('Y').'				',0,0,'R',1);
			
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight+15,$iInterline,'REPOBLIKAN\'I MADAGASIKARA' ,"L",0,'C',1);

			

			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->SetFont('Arial','I');
			$oPdf->Cell($iRight+15,$iInterline,'Fitiavana - Tanindrazana - Fandrosoana',"L",0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',"L",0,'C',1);


			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',"L",0,'C',1);
	
			$zSigle			=	$_oData["zSigle"];
			$tzSigles		=	explode(",",$zSigle);
			foreach($tzSigles as $zSigles){
				//ligne 01
				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'R',1);
				$oPdf->SetFont('Arial','B');
				$oPdf->Cell($iRight1,$iInterline,$zSigles,"L",1,'C',1);
				$oPdf->Cell($iRight2,$iInterline,' ',0,0,'C',1);
				$oPdf->Ln();
			}
			$zCongeSuite = "" ; 
			if ($_oData['iTypeGcapId'] == AUTORISATION_ABSENCE && $_oData['iNombreConge']){
				$iMax = 3;
				if ($_oData['oGcap']['gcap_typeId'] == AUTORISATION_ABSCENCE_SPECIAL){
					$iMax = 7;
				}
				if ($_oData['oGcap']['gcap_typeId'] == AUTORISATION_SPECIAL_ABSCENCE){
					$iMax = 20;
				}
				$iDiffAutorisation = $_oData['iNombreConge']-$iMax;
				$zSAlaFinDiffAutorisation = "";
				if ($iDiffAutorisation > 1) {
					$zSAlaFinDiffAutorisation = "s";
				}
				if ($iDiffAutorisation > 0){
					$zCongeSuite .=  "(dont ".$iDiffAutorisation." jour".$zSAlaFinDiffAutorisation." congé".$zSAlaFinDiffAutorisation.")";
				}
			}
			$zSuite = "";
			if ($oGcap['gcap_typeGcapId'] == CONGE) {
				$zSuite = "DE DEPART" ; 
			}
			if ($zCongeSuite !=""){
				
				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
				$oPdf->Cell($iRight1,$iInterline,'',"L",0,'C',1);
				$oPdf->Cell($iRight2,$iInterline,'ATTESTATION DE : ' . $zSuite,0,0,'C',1);

				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
				$oPdf->Cell($iRight1+10,$iInterline,'',"L",0,'C',1);
				$oPdf->Image(PATH_ROOT_DIR.'/assets/gcap/images/check1.jpg',$iLeft+115,$iInterline+63.5,4);
				$oPdf->Cell($iRight2,$iInterline,"CONGE",0,0,'L',1);

				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
				$oPdf->Cell($iRight1+10,$iInterline,'',"L",0,'C',1);
				$oPdf->Image(PATH_ROOT_DIR.'/assets/gcap/images/check1.jpg',$iLeft+115,$iInterline+69.5,4);
				$oPdf->Cell($iRight2,$iInterline,"AUTORISATION d'ABSENCE",0,0,'L',1);
			} else {
				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
				$oPdf->Cell($iRight1,$iInterline,'',"L",0,'C',1);
				$oPdf->Cell($iRight2,$iInterline,'ATTESTATION  ' . $zSuite,0,0,'C',1);
				
				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
				$oPdf->Cell($iRight1,$iInterline,'',"L",0,'C',1);
				$oPdf->Cell($iRight2,$iInterline,$_oData['zTitre2'],0,0,'C',1);
			}
			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',"L",0,'C',1);

			
			/*if ($zCongeSuite ==""){
				$iIncrement += 6 ; 
			}*/
			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$zNum = $_oData['iNumId'] ;

			$iPos = strpos($_oData['sigle'],"MEF");
			$zSigleCourt = "";

			/**********************************************************************************/
			$zSigleCourt		=	$oCandidat["path"] ;
			
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(1,$iInterline,'',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-1,$iInterline,'N° : '. $zNum. "/" . $zSigleCourt ,0,0,'L',1);
			
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iRight,$iInterline,'N° : '. $zNum. "/" . $zSigleCourt,"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			/**********************************************************************************/
			
			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);


			$oPdf->Cell($iRight,$iInterline,'		Je, soussigné, atteste que : ',"L",0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(30,$iInterline,'		Nom et Prénoms : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-30,$iInterline,utf8_decode($oCandidat["nom"]) . " " . utf8_decode($oCandidat["prenom"]) ,0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(30,$iInterline,'		Nom et Prénoms : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-30,$iInterline,utf8_decode($oCandidat["nom"]) . " " . utf8_decode($oCandidat["prenom"]),0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(18,$iInterline,'		Fonction : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$posteFonctionnelle			=	$this->candidat_parcours->getFonction($oGcap["gcap_userSendId"],$oGcap["gcap_dateValidation"]);
			$posteFonctionnelle			=   $posteFonctionnelle?$posteFonctionnelle:$oCandidat["poste"];
	
			$oPdf->Cell($iLeft-18,$iInterline,utf8_decode($posteFonctionnelle),0,0,'L',1);
			/**********************************************************************************/

			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(18,$iInterline,'		Fonction : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-18,$iInterline,utf8_decode($posteFonctionnelle),0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(8,$iInterline,'		IM : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-8,$iInterline,$oCandidat["matricule"],0,0,'L',1);
			/**********************************************************************************/

			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(8,$iInterline,'		IM : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-8,$iInterline,$oCandidat["matricule"],0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(15,$iInterline,'		Corps : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-15,$iInterline,$oCandidat["corps"],0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(15,$iInterline,'		Corps : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-15,$iInterline,$oCandidat["corps"],0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(15,$iInterline,'		Grade : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-15,$iInterline,$oCandidat["grade"],0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(15,$iInterline,'		Grade : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-15,$iInterline,$oCandidat["grade"],0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(34,$iInterline,'		Service ou Division : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			/*$zService = "" ;
			if (isset($oService["libele"])) {
				$zService =  $oService["libele"];
			}*/
			$iCountService = str_word_count($zService);
			if ($iCountService > 10){
				$zService =  $oService["sigle_service"];
			}

			$oPdf->SetFont('Arial','',8.5);
			$oPdf->Cell($iLeft-34,$iInterline,utf8_decode($zService),0,0,'L',1);
			$oPdf->SetFont('trebuc','',9);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(34,$iInterline,'		Service ou Division : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','',8.5);
			$oPdf->Cell($iRight-34,$iInterline,utf8_decode($zService),0,0,'L',1);
			$oPdf->SetFont('trebuc','',9);
		
			$zSuffixe = "";	
			if ($oCandidat['sexe'] == 0){
				$zSuffixe = "e";	
			}

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(72,$iInterline,'		est autorisé'.$zSuffixe.' à s\'absenter pour une durée de : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');

			$zSAlaFin = "";
			if ($_oData['iNombreConge'] > 1) {
				$zSAlaFin = "s";
			}
			$oPdf->Cell($iLeft-72,$iInterline,str_replace(".",",",$_oData['iNombreConge']) . ' jour' . $zSAlaFin . " " . $zCongeSuite,0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(72,$iInterline,'		est autorisé'.$zSuffixe.' à s\'absenter pour une durée de : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-72,$iInterline,str_replace(".",",",$_oData['iNombreConge']) . ' jour' . $zSAlaFin . " " . $zCongeSuite,0,0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(25,$iInterline,'		A compter du :',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$zDateDebut = $_this->date_fr_to_en($oGcap['gcap_dateDebut'],'-','/'); 
			$zDateFin = $_this->date_fr_to_en($oGcap['gcap_dateFin'],'-','/'); 
			$oPdf->Cell($iLeft-25,$iInterline,$zDateDebut . ' au ' . $zDateFin ,0,0,'L',1);

			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(25,$iInterline,'		A compter du : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-25,$iInterline,$zDateDebut . ' au ' . $zDateFin,0,0,'L',1);


			/**********************************************************************************/

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(25,$iInterline,'		Suppléant :',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$zDateDebut = $_this->date_fr_to_en($oGcap['gcap_dateDebut'],'-','/'); 
			$zDateFin = $_this->date_fr_to_en($oGcap['gcap_dateFin'],'-','/'); 
			$oPdf->Cell($iLeft-25,$iInterline,$_oData['oGcap']["gcap_interim"] ,0,0,'L',1);

			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(25,$iInterline,'		Suppléant : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-25,$iInterline,$_oData['oGcap']["gcap_interim"],0,0,'L',1);
			/**********************************************************************************/
			/**********************************************************************************/


			/*if ($zCongeSuite !=""){*/

				if ($_oData["zPieceJointe"] != ""){
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(23,$iInterline,'		Pièce jointe : ',0,0,'L',1);
					$oPdf->SetFont('Arial','');
					$oPdf->Cell($iLeft-23,$iInterline,$_oData["zPieceJointe"],0,0,'L',1);
					/**********************************************************************************/
					$oPdf->SetFont('Arial','B');
					$oPdf->Cell(23,$iInterline,'		Pièce jointe : ',"L",0,'L',1);
					$oPdf->SetFont('Arial','');
					$oPdf->Cell($iRight-23,$iInterline,$_oData["zPieceJointe"],0,0,'L',1);
				}
			/*}*/

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(13,$iInterline,'		Motif : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-13,$iInterline,utf8_decode($oGcap['motif_libelle']),0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(13,$iInterline,'		Motif : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-13,$iInterline,utf8_decode($oGcap['motif_libelle']),0,0,'L',1);

			if ($oGcap['conv_pers'] != '') {
				$zString = utf8_decode($oGcap['conv_pers']);
				$zStringPart1 = $zString;
				$zStringRightPart1 = $zString;
				$zStringPart2 = '';
				$zStringRightPart2 = '';
				if(strlen($zString) > 53){
					$zStringPart1 = substr($zString,0,52);
					if(strlen($zString) > 120) 
						$zStringPart2 = substr($zString,52,80).'...';
					else $zStringPart2 = substr($zString,52,strlen($zString));
					
				}
				if(strlen($zString) > 81){
					$zStringRightPart1 = substr($zString,0,70);
					if(strlen($zString) > 111) 
						$zStringRightPart2 = substr($zString,70,110).'...';
					else $zStringRightPart2 = substr($zString,70,strlen($zString));
					
				}
				$iIncrement += 6 ; 
				$iTempIncrement = $iIncrement;
				$oPdf->SetY($iIncrement);
				$oPdf->SetFont('Arial','B');
				$oPdf->Cell(46,$iInterline,'		Convenances personnelles : ',0,0,'L',1);
				$oPdf->SetFont('Arial','');
				$oPdf->Cell($iLeft-46,$iInterline,$zStringPart1,0,0,'L',1);
				
				$oPdf->SetFont('Arial','B');
				$oPdf->Cell(46,$iInterline,'		Convenances personnelles : ',"L",0,'L',1);
				$oPdf->SetFont('Arial','');
				/*$iTempIncrement += 6 ; 
				$oPdf->SetY($iTempIncrement);*/
				$oPdf->Cell($iRight-46,$iInterline,$zStringRightPart1,0,0,'L',1);
				if($zStringPart2){
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->SetFont('Arial','');
					$oPdf->Cell($iLeft,$iInterline,'		'.$zStringPart2,'R',0,'L',1);
					$oPdf->Cell($iRight,$iInterline,'		'.$zStringRightPart2,'L',0,'L',1);
				}
				//$oPdf->MultiCell($iRight,$iInterline,'		'.utf8_decode($oGcap['conv_pers']),'L','L',true);
			}

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(35,$iInterline,'		Lieu de jouissance : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-35,$iInterline,$oGcap['gcap_lieuJouissance'],0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(35,$iInterline,'		Lieu de jouissance : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-35,$iInterline,$oGcap['gcap_lieuJouissance'],0,0,'L',1);


			$zSAlafinDecision = "";
			$zArticleDecision = "la";

			if($_oData['toDataListeFraction'] >1) {
				$zSAlafinDecision = "s";
				$zArticleDecision = "les";
			}

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'		A défalquer sur '.$zArticleDecision.' Décision'.$zSAlafinDecision.' : ',0,0,'L',1);
			/**********************************************************************************/
			$oPdf->Cell($iRight,$iInterline,'		A défalquer sur '.$zArticleDecision.' Décision'.$zSAlafinDecision.' : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','');


			$iIteration = 1;
			/*if($oCandidat["user_id"] == "617" ){
				print_r($_oData["toDataListeFraction"]);die;
			}*/
			foreach ($_oData['toDataListeFraction'] as $oListe) {
				$iIncrement += 6 ; 
				
				$zSAlafinReste = "";

				$iReste = $this->getDecisonReste($oCandidat["user_id"],$oListe['decision_id'],$_oData["oGcap"]["gcap_dateFin"]);

				if($iReste >1) {
					$zSAlafinReste = "s";
				}
				$toDecisionNumero = explode ("/", $oListe['decision_numero']);

				if (sizeof($toDecisionNumero)>0 && isset($toDecisionNumero[1])) {
					$zSigleCourt = "";
				}
				$zDecision = "- N° " . $oListe['decision_numero'] . $zSigleCourt . " au titre de l'année ".$oListe['decision_annee']." (reste ".str_replace(".",",",$iReste)." jour". $zSAlafinReste . ")" ; 
				
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,"		" . $zDecision,0,0,'L',1);
				/**********************************************************************************/
				$oPdf->Cell($iRight,$iInterline,"		" . $zDecision,"L",0,'L',1);
				$oPdf->SetFont('Arial','');
				$iIteration++;
			}

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',"L",0,'C',1);
			
			if ($_oData["zPieceJointe"] != ""){
				$iIncrement += 5 ; 
			} else {
				$iIncrement += 10 ; 
			}
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-72,$iInterline,"		L'intéressé".$zSuffixe."",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->Cell($iLeft -10,$iInterline,"		Le Chef Hiérarchique",0,0,'L',1);
			$oPdf->Cell($iRight-100,$iInterline,"		Le responsable personnel",0,0,'R',1);
	
			$oPdf->SetFont('Arial','');
			$oDemandeur						=	$this->user->get_user($_oData["oGcap"]["gcap_userSendId"]);
			$zTextInteresse					=	" Conge numero :". $_oData["oGcap"]["gcap_id"]." au nom de ". $oDemandeur["nom"]. "  " . $oDemandeur["prenom"]." du ".$_oData["oGcap"]["gcap_dateDebut"]." au ".$_oData["oGcap"]["gcap_dateFin"];
			
			//INTERESSE
			//QRcode::png($zTextInteresse,"qrcode.png");
			//$oPdf->Image("qrcode.png", 13, 180,10, 10, "png");

			if($_oData["oGcap"]["gcap_userValidId"]){
					//CHEF HIERARCHIQUE
				$oValidateur				=	$this->user->get_user($_oData["oGcap"]["gcap_userValidId"]);
				$zTextChefHierachique		=	" Conge numero :". $_oData["oGcap"]["gcap_id"]." valide par ". $oValidateur["nom"] . "  " . $oValidateur["prenom"] ." le  " .$_oData["oGcap"]["gcap_dateValidation"] ;
				//echo $zTextChefHierachique;die;
				QRcode::png("interesse: " .$zTextInteresse ." chef hierarchique: " . $zTextChefHierachique,"qrcode1.png");
				$oPdf->Image("qrcode1.png", 120, 180,10, 10, "png");
			}
			
			//QRCODE RESPONSABLE PERSONNEL
			$zTextResponsablePersonnel		=$zTextInteresse ;
			QRcode::png("interesse: " .$zTextInteresse ." responsable personnel: " . $zTextResponsablePersonnel,"qrcode2.png");
			QRcode::png("ROHI_QR_CODE","qrcode.png");
			$oPdf->Image("qrcode.png", 280, 180,10, 10, "png");

			if ($zLogo != "") {
				$zImageLogoUrl = base_url().'assets/upload/logo/' . $zLogo;
			}
			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			

			$oPdf->Output();
	}

	public function getDecisonReste($_iUserId, $_iDecisionId,$_zDate){

		$DB1 = $this->load->database('gcap', TRUE);


		$iReste = 0;
		/*$zSql  = "select (decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId' AND fraction_date <'".$_zDate."' ),0))) AS reste
				FROM decision INNER JOIN type ON decision_typeId = type_id where decision_userId = '$_iUserId' AND decision_finalisation = 1 " ;*/
				
		$zSql  = "select (decision_nbrJour -(IFNULL((SELECT SUM(fraction_nbrJour) FROM fraction WHERE fraction_decisionId = decision_id AND fraction_userId = '$_iUserId'),0))) AS reste
				FROM decision INNER JOIN type ON decision_typeId = type_id where decision_userId = '$_iUserId' AND decision_finalisation = 1 " ; 

		$zSql .= " AND decision_id = " . $_iDecisionId . " LIMIT 0,1";

		//echo $zSql;die;
		$zQuery = $DB1->query($zSql);

		$toRow = $zQuery->result_array();

		if (sizeof($toRow)>0){
			$iReste = $toRow[0]['reste'];
		}
		return $iReste ; 
	}


	public function __setImprimerDecisionPdf ($_oData, $_this) {

		
		$oCandidat		= $_oData["oCandidat"];
		$oService		= $_oData["oService"];
		$oDecision		= $_oData["oDecision"];
		$oSignataire	= $_oData["oSignataire"];
		$zLogo		= "";

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("L");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 45;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iIncrement = 15 ; 
			$iLeft = 135 ; 
			$iRight = 135 ; 

			$iRight1 = 100 ; 
			$iRight2 = 60 ; 
			$iInterline = 6;

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

			$zImageLogoUrl = base_url().'assets/gcap/images/def3.jpg';

			$oPdf->SetX(10);
			
			$oPdf->SetFont('Arial','I');
			$iMonth = (int)date("m");
			$zMonth = $toMonth[$iMonth];
			//$oPdf->Cell($iLeft+,$iInterline,'Antananarivo le, '.date('d').' '.$zMonth.' '.date('Y').'				',0,0,'R',1);
			
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft + $iRight,$iInterline,'REPOBLIKAN\'I MADAGASIKARA' ,0,0,'C',1);

			

			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','I');
			$oPdf->Cell($iLeft + $iRight,$iInterline,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);


			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft,$iInterline,'  MINISTÈRE DE L\'ECONOMIE ET DES FINANCES',0,0,'C',1);

			$zSigleCourt = "/MEF";
			if ($_oData['sigle'] !=""){
				
				$zSigleCourt .= "/";
				$zSigleCourt .= $_oData['sigle'] ;
			}

			$iIteration = 1;
			foreach ($_oData['toSigle'] as $oSigle) {

				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,$oSigle['departementNom'],0,0,'C',1);

				if($oSigle['directionNom'] != '' && ($oSigle['directionNom'] != $oSigle['departementNom'])){
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->Cell($iLeft,$iInterline,$oSigle['directionNom'],0,0,'C',1);
					$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);
					$oPdf->Ln();
				}

				if ($oDecision['decision_annee'] < 2016){

					$toDecisionNumero = explode ("/", $oDecision['decision_numero']);
					if (sizeof($toDecisionNumero)>0 && isset($toDecisionNumero[1])) {
						$zSigleCourt = "";
					}
					$zDecisionLong = "Decision n° ".$oDecision['decision_numero']."-".$oDecision['decision_annee']." ".$zSigleCourt;
				} else {

					$zDecisionLong = "Decision n° ".$oDecision['decision_numero']."-".$oDecision['decision_annee']." ".$zSigleCourt." du " . $this->dateLong($oDecision['decision_dateValidation']);
				}

				if($oSigle['serviceNom'] != '' && ($oSigle['serviceNom'] != $oSigle['directionNom'])){
						
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->Cell($iLeft,$iInterline,$oSigle['serviceNom'],0,0,'C',1);
					$oPdf->SetFont('Arial','');
					$oPdf->Cell($iRight,$iInterline,$zDecisionLong,0,0,'C',1);
				} else {
					if ($oSigle['sigle_service'] == "DRH") {
						$iIncrement += 6 ; 
						$oPdf->SetY($iIncrement);
						$oPdf->Cell($iLeft,$iInterline,"Service de la Gestion des Ressources Humaines",0,0,'C',1);
						$oPdf->SetFont('Arial','');
						$oPdf->Cell($iRight,$iInterline,$zDecisionLong,0,0,'C',1);
					} else {

						$iIncrement += 6 ; 
						$oPdf->SetY($iIncrement);
						$oPdf->Cell($iLeft,$iInterline," ","L",0,'C',1);
						$oPdf->SetFont('Arial','');
						$oPdf->Cell($iRight,$iInterline,$zDecisionLong,0,0,'C',1);

					}
				}
			}

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','I');
			$oPdf->Cell($iLeft + $iRight,$iInterline,'Portant: Octroi '.strtolower(utf8_decode(html_entity_decode($oDecision['type_libelleImpression']))). ' au titre de l\'année ' . $oDecision['decision_annee'],0,0,'C',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$zNum = $_oData['iNumId'] ;
			$zSigleCourt = "/MEF";
			if ($_oData['sigle'] !=""){
				
				$zSigleCourt .= "/";
				$zSigleCourt .= $_oData['sigle'] ;
			}
			
			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(18,$iInterline,'		Matricule : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-18,$iInterline,$oCandidat["matricule"],0,0,'L',1);
			
			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(30,$iInterline,'		Nom et Prénoms : ',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-30,$iInterline,utf8_decode($oCandidat["nom"] . " " . $oCandidat["prenom"]) ,0,0,'L',1);
			/**********************************************************************************/

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell(18,$iInterline,'',0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-18,$iInterline,'',0,0,'L',1);


			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft,$iInterline,'ANCIENNE POSITION',1,0,'C',1);

			/**********************************************************************************/

			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight,$iInterline,'NOUVELLE POSITION',1,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(15,$iInterline,'		Budget : ','LT',0,'L',1);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-15,$iInterline,'GENERAL','TR',0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iRight,$iInterline,'',"LRT",0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(35,$iInterline,'		Imputation budgetaire : ','L',0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-35,$iInterline,$_oData['zChapitre'],0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iRight,$iInterline,'',"LR",0,'L',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(30,$iInterline,'		Grade ou emploi : ',"L",0,'L',1);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-30,$iInterline,$oCandidat["grade"],"R",0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft,$iInterline,'SANS CHANGEMENT',"LR",0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell(15,$iInterline,'		Indice : ',"LB",0,'L',1);
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-15,$iInterline,$oCandidat["indice"],"RB",0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft,$iInterline,'',"LRB",0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','');

			$zService = "" ;
			if (isset($oService["libele"])) {
				$zService =  $oService["libele"];
			}

			$zSAlafinDecision = "";

			if (sizeof($oDecision['decision_nbrJour'])>0){
				$zSAlafinDecision = "s";
			}
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft,$iInterline,' en service auprès de la ' . $zService,1,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','');
			/*$oPdf->Cell($iLeft,$iInterline,'Obtient un congé annuel de : '.$oDecision['decision_nbrJour'].' jour'.$zSAlafinDecision.'  au titre de l\'année ' . $oDecision['decision_annee'],1,1,'L',1);*/
			$oPdf->Cell($iLeft,$iInterline,'Obtient un congé annuel de : '.$oDecision['decision_nbrJour'].' jour'.$zSAlafinDecision.'  au titre de l\'année ' . $oDecision['decision_annee'],1,1,'L',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 15 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		A completer par les services, district ou l'interessé","LTR",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			
			$zDateLong = "";
			if ($oDecision['decision_numero'] != 0){
				$zDateLong = $this->dateLong(date("Y-m-d"));
			}

			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-50,$iInterline,"		Ampliation","LTR",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,"Signature de : ",0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$zSignataire = "";
			if ($oDecision['decision_autoriteSaisi'] != ""){
				$zSignataire = utf8_decode($oDecision['decision_autoriteSaisi']);
			}elseif ($oCandidat['id'] != $oSignataire[0]->id) {
				if ($oSignataire[0]->nom != "") {
					$zSignataire = utf8_decode($oSignataire[0]->nom . ' ' . $oSignataire[0]->prenom);
				}
			}

			$iIncrement += 5 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		Date de notification : ","LR",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft-50,$iInterline,"		le " . $zDateLong,"LR",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,$zSignataire,0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 5 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		Date de départ : ","LR",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-50,$iInterline,"		","LR",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 5 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		Date d'arrivée :  ","LR",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-50,$iInterline,"		","LR",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 5 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		Date de prise de service :  ","LR",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-50,$iInterline,"		","LR",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 5 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft-50,$iInterline,"		Date :  ","LRB",0,'L',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			/**********************************************************************************/
			$oPdf->SetFont('Arial','B');
			$oPdf->Cell($iLeft-50,$iInterline,"		","LRB",0,'C',1);
			$oPdf->Cell(5,$iInterline," ",0,0,'L',1);
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iRight-45,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$oPdf->Image($zImageLogoUrl,70,5,22.5);

			if ($zLogo != "") {
				$zImageLogoUrl = base_url().'assets/upload/logo/' . $zLogo;
				$oPdf->Image($zImageLogoUrl,30,5,20);
			}

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}

	function dateDiff($zDate1, $zDate2, $_iReturn=0){
		
		
		$iDiff = abs($zDate1 - $zDate2); 

		echo $iDiff ; 

		$oRetour = array();
	 
		$iTmp = $iDiff;
		$oRetour['second'] = $iTmp % 60;
	 
		$iTmp = floor( ($iTmp - $oRetour['second']) /60 );
		$oRetour['minute'] = $iTmp % 60;


		$iTmp2 = floor( ($iTmp - $oRetour['minute'])/60 );
		$oRetour['hour1'] = $iTmp2 % 24;
	 
		$iTmp2 = floor( ($iTmp2 - $oRetour['hour1'])  /24 );
		$oRetour['day1'] = $iTmp2;
	 
		$iTmp = floor( ($iTmp - $oRetour['minute'])/60 );
		$oRetour['hour'] = $iTmp % 8;
	 
		$iTmp = floor( ($iTmp - $oRetour['hour'])  /8 );
		$oRetour['day'] = $iTmp;


		switch ($_iReturn) {

			case 0:
				return $oRetour;
				break;

			case 1:
				return $oRetour['day1'];
				break;

			case 2:
				return $oRetour['hour'];
				break;

			case 3:
				return $oRetour['minute'];
				break;

			case 4:
				return $oRetour['second'];
				break;

			case 5:
			case 7:
				
				$zReturn = "";

				if ($oRetour['day']>0) {
					$zReturn .= $oRetour['day'] . "j " ; 
				}

				if ($oRetour['hour']>0) {
					$zReturn .= $oRetour['hour'] . "h " ; 
				}

				if ($oRetour['minute']>0) {
					$zReturn .= $oRetour['minute'] . "mn " ; 
				}

				if ($oRetour['second']>0) {
					$zReturn .= $oRetour['second'] . "s " ; 
				}

				return $zReturn;
				break;

			case 6:
				return $iDiff ; 
				break;

			case 8:
				return $oRetour['day'];
				break;
		}
	}

	function int2str($_iNombre)
	{
		$oConvert = explode('.',$_iNombre);
		if (isset($oConvert[1]) && $oConvert[1]!=''){
		return $this->int2str($oConvert[0]).' '.'virgule '.$this->int2str($oConvert[1]).'' ;
		}
		if ($_iNombre<0) return 'moins '.$this->int2str(-$_iNombre);
		if ($_iNombre<17){
		switch ($_iNombre){
		case 0: return '';
		case 1: return 'un';
		case 2: return 'deux';
		case 3: return 'trois';
		case 4: return 'quatre';
		case 5: return 'cinq';
		case 6: return 'six';
		case 7: return 'sept';
		case 8: return 'huit';
		case 9: return 'neuf';
		case 10: return 'dix';
		case 11: return 'onze';
		case 12: return 'douze';
		case 13: return 'treize';
		case 14: return 'quatorze';
		case 15: return 'quinze';
		case 16: return 'seize';
		}
		} else if ($_iNombre<20){
		return 'dix-'.$this->int2str($_iNombre-10);
		} else if ($_iNombre<100){
		if ($_iNombre%10==0){
		switch ($_iNombre){
		case 20: return 'vingt';
		case 30: return 'trente';
		case 40: return 'quarante';
		case 50: return 'cinquante';
		case 60: return 'soixante';
		case 70: return 'soixante-dix';
		case 80: return 'quatre-vingt';
		case 90: return 'quatre-vingt-dix';
		}
		} elseif (substr($_iNombre, -1)==1){
		if( ((int)($_iNombre/10)*10)<70 ){
		return $this->int2str((int)($_iNombre/10)*10).'-et-un';
		} elseif ($_iNombre==71) {
		return 'soixante-et-onze';
		} elseif ($_iNombre==81) {
		return 'quatre-vingt-un';
		} elseif ($_iNombre==91) {
		return 'quatre-vingt-onze';
		}
		} elseif ($_iNombre<70){
		return $this->int2str($_iNombre-$_iNombre%10).'-'.$this->int2str($_iNombre%10);
		} elseif ($_iNombre<80){
		return $this->int2str(60).'-'.$this->int2str($_iNombre%20);
		} else{
		return $this->int2str(80).'-'.$this->int2str($_iNombre%20);
		}
		} else if ($_iNombre==100){
		return 'cent';
		} else if ($_iNombre<200){
		return $this->int2str(100).' '.$this->int2str($_iNombre%100);
		} else if ($_iNombre<1000){
		return $this->int2str((int)($_iNombre/100)).' '.$this->int2str(100).' '.$this->int2str($_iNombre%100);
		} else if ($_iNombre==1000){
		return 'mille';
		} else if ($_iNombre<2000){
		return $this->int2str(1000).' '.$this->int2str($_iNombre%1000).' ';
		} else if ($_iNombre<1000000){
		return $this->int2str((int)($_iNombre/1000)).' '.$this->int2str(1000).' '.$this->int2str($_iNombre%1000);
		}
		else if ($_iNombre==1000000){
		return 'millions';
		}
		else if ($_iNombre<2000000){
		return $this->int2str(1000000).' '.$this->int2str($_iNombre%1000000).' ';
		}
		else if ($_iNombre<1000000000){
		return $this->int2str((int)($_iNombre/1000000)).' '.$this->int2str(1000000).' '.$this->int2str($_iNombre%1000000);
		}
	}


	public function setImprimerEtat ($_oData, $_this) {


		$oUser		= $_oData["oUser"];
		$oCandidat	= $_oData["oCandidat"];
		$oService	= $_oData["oService"];
		$toListe	= $_oData["toListe"];

		$zLogo		= "";

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			//Fields Name position
			$Y_Fields_Name_position = 20;
			//Table position, under Fie*lds Name
			$Y_Table_Position = 45;

			//First create each Field Name
			//Gray color filling each Field Name box

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			//Bold Font for Field Name
			$oPdf->SetFont('trebuc','',9);
			//$oPdf->SetY($Y_Fields_Name_position);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iIncrement = 15 ; 
			$iLeft = 100 ; 
			$iRight = 100 ; 

			$iRight1 = 0 ; 
			$iRight2 = 0 ; 
			$iInterline = 6;

			$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

			$zImageLogoUrl = PATH_ROOT_DIR.'/assets/gcap/images/def3.jpg';

			$oPdf->SetX(10);
			
			$oPdf->SetFont('Arial','I');
			$iMonth = (int)date("m");
			$zMonth = $toMonth[$iMonth];
			
			$oPdf->SetFont('Arial','');
			$oPdf->Cell($iLeft + $iRight,$iInterline,'REPOBLIKAN\'I MADAGASIKARA' ,0,0,'C',1);

			

			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','I');
			$oPdf->Cell($iLeft + $iRight,$iInterline,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);


			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->SetFont('Arial','B');
			/*$oPdf->Cell($iLeft,$iInterline,'  MINISTÈRE DE L\'ECONOMIE ET DES FINANCES',0,0,'C',1);*/
			$oPdf->Cell($iLeft,$iInterline,' ',0,0,'C',1);

			$zSigleCourt = "/MEF";
			if ($_oData['sigle'] !=""){
				
				$zSigleCourt .= "/";
				$zSigleCourt .= $_oData['sigle'] ;
			}

			$iIteration = 1;
			//print_r($_oData['tzSigle']);die;
			$zService	=	"";
			foreach ($_oData['tzSigle'] as $zSigle) {
				if ( $zSigle !="" ){
					$zService	=	 $zSigle;
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->Cell($iLeft,$iInterline,$zSigle,0,0,'C',1);
					$oPdf->SetFont('Arial','B',9);
				}
			}
			$oPdf->Cell($iRight,$iInterline,"ETAT DE CONGE",0,0,'C',1);
			$oPdf->SetFont('Arial','B',9);
			$zTitreUser = "Monsieur";

			if($oCandidat[0]->sexe == 0){
				$zTitreUser = "Madame";
			}
			$zDecisionLong = $zTitreUser . " " .utf8_decode($oCandidat[0]->nom)." " . utf8_decode($oCandidat[0]->prenom) . ". IM ".$oCandidat[0]->matricule.", ".utf8_decode($oCandidat[0]->poste).". ".utf8_decode($zService)." du Ministère de l'Economie et des Finances.";

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','');
			$oPdf->SetFont('Arial','',11);
			$oPdf->multicell($iRight,$iInterline,$zDecisionLong,0,'L',1);
			$oPdf->SetFont('Arial','',9);

			
			/*foreach ($_oData['toSigle'] as $oSigle) {

				$iIncrement += 6 ; 
				$oPdf->SetY($iIncrement);
				$oPdf->Cell($iLeft,$iInterline,$oSigle['departementNom'],0,0,'C',1);
				$oPdf->SetFont('Arial','B',15);
				$oPdf->Cell($iRight,$iInterline,"ETAT DE CONGE",0,0,'C',1);
				$oPdf->SetFont('Arial','B',9);

				if($oSigle['directionNom'] != '' && ($oSigle['directionNom'] != $oSigle['departementNom'])){
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->Cell($iLeft,$iInterline,$oSigle['directionNom'],0,0,'C',1);
					$oPdf->Cell($iRight,$iInterline,'',0,0,'C',1);
					$oPdf->Ln();
				}

				$zTitreUser = "Monsieur";

				if($oCandidat[0]->sexe == 0){
					$zTitreUser = "Madame";
				}

				$zService = "" ;
				if (isset($oService["libele"])) {
					$zService =  $oService["libele"];
				}

				$zDecisionLong = $zTitreUser . " " .utf8_decode($oCandidat[0]->nom)." " . utf8_decode($oCandidat[0]->prenom) . ". IM ".$oCandidat[0]->matricule.", ".utf8_decode($oCandidat[0]->poste).". ".utf8_decode($zService)." du Ministère de l'Economie et des Finances.";


				if($oSigle['serviceNom'] != '' && ($oSigle['serviceNom'] != $oSigle['directionNom'])){
						
					$iIncrement += 6 ; 
					$oPdf->SetY($iIncrement);
					$oPdf->Cell($iLeft,$iInterline,$oSigle['serviceNom'],0,0,'C',1);
					$oPdf->SetFont('Arial','');
					$oPdf->SetFont('Arial','',11);
					$oPdf->multicell($iRight,$iInterline,$zDecisionLong,0,'L',1);
					$oPdf->SetFont('Arial','',9);

				} else {
					if ($oSigle['sigle_service'] == "DRH") {
						$iIncrement += 6 ; 
						$oPdf->SetY($iIncrement);
						$oPdf->Cell($iLeft,$iInterline,"Service de la Gestion des Ressources Humaines",0,0,'C',1);
						$oPdf->SetFont('Arial','');
						$oPdf->SetFont('Arial','',11);
						$oPdf->multicell($iRight,$iInterline,$zDecisionLong,0,'L',1);
						$oPdf->SetFont('Arial','',9);
					} else {

						$iIncrement += 6 ; 
						$oPdf->SetY($iIncrement);
						$oPdf->Cell($iLeft,$iInterline," ","L",0,'C',1);
						$oPdf->SetFont('Arial','');
						$oPdf->SetFont('Arial','',11);
						$oPdf->multicell($iRight,$iInterline,$zDecisionLong,0,'L',1);
						$oPdf->SetFont('Arial','',9);

					}
				}
			}*/

			$iInterline += 3;

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(30,$iInterline,'ANNEES',1,0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(50,$iInterline,'DROITS EN JOURS',1,0,'C',1);

			$oPdf->SetX(90);
			$oPdf->Cell(46,$iInterline,'CONGES PRIS',1,0,'C',1);

			$oPdf->SetX(136);
			$oPdf->Cell(65,$iInterline,'RESTE EN PRENDRE EN JOURS',1,0,'C',1);

			$iTotal = 0;
			foreach ($toListe as $oListe){
				$oPdf->Ln();
				$oPdf->SetX(10);
				$oPdf->Cell(30,$iInterline,$oListe['decision_annee'],1,0,'C',1);

				$oPdf->SetX(40);
				$oPdf->Cell(50,$iInterline,$oListe['nbrJourCumule'] + $oListe['reste'],1,0,'C',1);

				$oPdf->SetX(90);
				$oPdf->Cell(46,$iInterline,($oListe['nbrJourCumule']!="")?$oListe['nbrJourCumule']:'00',1,0,'C',1);

				$oPdf->SetX(136);
				$oPdf->Cell(65,$iInterline,$oListe['reste'],1,0,'C',1);
				$iTotal += $oListe['reste'];
			}

			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(30,$iInterline,"",0,0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(50,$iInterline,"",0,0,'C',1);

			$oPdf->SetX(90);
			$oPdf->SetFont('Arial','B',12);
			$oPdf->Cell(46,$iInterline,"TOTAL",1,0,'C',1);
			$oPdf->SetFont('Arial','',9);
			$oPdf->SetX(136);
			
			$oPdf->Cell(65,$iInterline,$iTotal,1,0,'C',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);

			$zAvecS = "";
			if ($iTotal>1){
				$zAvecS = "s";
			}
			
			$oPdf->SetFont('Arial','',11);
			$oPdf->Cell(400,7," Arrêté le présent état au nombre de : ".$this->int2str($iTotal)." jour".$zAvecS." (".$iTotal.")" ,'R',0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetX(10);
			$oPdf->Cell(30,$iInterline,"",0,0,'C',1);

			$oPdf->SetX(40);
			$oPdf->Cell(50,$iInterline,"",0,0,'C',1);

			$oPdf->SetX(90);
			$oPdf->SetFont('Arial','B',12);
			$oPdf->Cell(46,$iInterline,"",0,0,'C',1);
			$oPdf->SetFont('Arial','',9);
			$oPdf->SetX(136);
			$oPdf->SetFont('Arial','I',11);
			$oPdf->Cell(65,$iInterline,"Antananarivo, le",0,0,'L',1);

			$oPdf->Ln();

			$iIncrement += 6 ; 
			$oPdf->SetY($iIncrement);
			$oPdf->Cell($iLeft,$iInterline,'',0,0,'C',1);
			$oPdf->SetFont('Arial','');

			/*$oPdf->Image($zImageLogoUrl,45,9,25);

			if ($zLogo != "") {
				$zImageLogoUrl = PATH_ROOT_DIR.'/assets/upload/logo/' . $zLogo;
				$oPdf->Image($zImageLogoUrl,20,5,20);
			}*/

			$oPdf->Ln();

			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}


	public function setImprimerDecisionPdf ($_oData, $_this, $_iId) {

		$iNombreConge = "";
		$oCandidat		= $_oData["oCandidat"];
		$oService		= $_oData["oService"];
		$toAnneeSigner	= $_oData["toAnneeSigner"];
				
		if($_iId > date("Y")){
			die("Une erreur dans la sélection, la date de décision est fausse");
		} else {
			/*if(in_array($_iId, $toAnneeSigner)){
				die("La décision de congé de l'année ".$_iId." a été déjà validé");
			}*/
			
			if(($_oData['iAnnePriseDecision'] == $_iId) || (date('Y') == $_iId)){

				$zDateDebut = $oCandidat['date_prise_service'];
				if (date('Y') == $_iId){
					$zDateDebut = date('Y') . "-01-01";
				}
				
				$zDateNow = date('Y') . "-" . date('m') . "-" . date("d");

				$datetime1 = date_create($zDateDebut); 
				$datetime2 = date_create($zDateNow); 
				  
				$oInterval = date_diff($datetime1, $datetime2); 
				$iReturn =  $oInterval->format('%R%a'); 

				$iNombreConge = round(($iReturn * 30) / 364);
				$iNombreConge = number_format($iNombreConge, 2, ',', '.');
				
				$iNombreConge = str_replace(',00','',$iNombreConge);

			} else {
				$iNombreConge = 30;	
			}
		}



		if ($iNombreConge> 30){
			$iNombreConge = 30;
		}
		
		////ETO OVAINA ISAKY NY OLONA
		//$iNombreConge = 10;
		
		$zLogo		= "";

		require(APPLICATION_PATH ."pdf/fpdf/fpdf.php");

			$oPdf=new FPDF();
			$oPdf->AddPage("P");

			$oPdf->SetAutoPageBreak(270);

			$Y_Fields_Name_position = 20;
			$Y_Table_Position = 45;

			$oPdf->SetFillColor(255,255,255);
			$oPdf->AddFont('trebuc','','trebuc.php');
			$oPdf->SetFont('trebuc','',9);
			
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('trebuc','',9);

			$iIncrement = 15 ; 
			$iLeft = 135 ; 
			$iRight = 135 ; 
			$iRight1 = 100 ; 
			$iRight2 = 60 ; 
			$iInterline = 6;

			$oPdf->SetX(10);
			$oPdf->Cell(200,2,'REPOBLIKAN\'I MADAGASIKARA',0,0,'C',1);
			$oPdf->Ln();

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I');
			$oPdf->Cell(200,5,'Fitiavana - Tanindrazana - Fandrosoana',0,0,'C',1);

			$oPdf->SetFont('Times','I');
			$oPdf->Ln();
			$oPdf->Ln();

			$zSigleCourt = " ";
			/*if ($_oData['sigle'] !=""){
				
				$zSigleCourt .= "/";
				$zSigleCourt .= $_oData['sigle'] ;
			}*/

			$oPdf->SetFont('Times','IB',14);
			
			$oPdf->Cell(80,7,'DECISION N°',0,0,'R',1);
			$oPdf->SetX(10);
			$oPdf->SetFont('Times','I',14);
			$oPdf->Cell(50,7,$zSigleCourt,0,0,'R',1);
			$oPdf->SetX(145);
			$oPdf->SetFont('Times','I',12);
			$oPdf->Cell(10,7,'du  ',0,0,'L',1);

			$oPdf->Ln();
			$oPdf->SetFont('Times','B',12);
			$oPdf->Cell(88,7,'Portant :',0,0,'R',1);
			$oPdf->SetX(98);
			$oPdf->SetFont('Times','I',10);
			$oPdf->Cell(50,7," Octroi d'un congé annuel",0,0,'L',1);

			$oPdf->Ln();
			$oPdf->Ln();
			$oPdf->SetFont('Times','',9);

			//=================================================================
			$oPdf->SetFont('Times','',9);

			$oPdf->SetX(10);
			$oPdf->Cell(60,7,'DIRECTION DE LA SOLDE ET DES','LTR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,'  NOM','LTR',0,'L',1);
			
			$oPdf->SetX(100);
			$oPdf->Cell(100,7," " . utf8_decode($oCandidat["nom"] . " " . $oCandidat["prenom"]),'LTR',0,'L',1);
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('Times','',9);
			$oPdf->SetX(10);
			$oPdf->Cell(60,7,'PENSIONS','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,'  ET PRENOMS','LR',0,'L',1);
			$oPdf->SetFont('Times','',9);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,"",'LR',0,'L',1);
		
			$oPdf->Ln();
			//=================================================================

			$oPdf->SetX(10);
			$oPdf->Cell(60,7,'....................................................................','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,'  ','TL',0,'L',1);
			$oPdf->SetFont('Times','',9);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'','TR',0,'C',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Bureau de la Solde et des Pensions','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,' MATRICULE ','TL',0,'L',1);
			$oPdf->SetFont('Times','',10);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,$oCandidat["matricule"],'LTR',0,'L',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Visa n° .................................................','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,' ','TL',0,'L',1);
			$oPdf->SetFont('Times','',9);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'','TR',0,'C',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Du ........................................................','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(40,7,' ','L',0,'L',1);
			$oPdf->SetFont('Times','',9);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'','R',0,'C',1);
		
			$oPdf->Ln();


			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Le Directeur de la Solde et des','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' ANCIENNE POSITION ','TLRB',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Pensions :','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' ','LRT',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' Budget : General ','L',0,'L',1);
			$oPdf->SetFont('Times','',11);
			$oPdf->SetX(100);
			
			$zIputation = "";
			$iIndice = "";
			$toCandidatAffiche		= $_oData["toCandidatAffiche"];

			/*if(sizeof($toCandidatAffiche)>0){
				$zSectionCode = $toCandidatAffiche->sectionCode ; 
				$zSectionCode = substr($zSectionCode, -3);
				$iIndice = $toCandidatAffiche->indice;
				$zChapitre = substr($toCandidatAffiche->ministereCode, 0,-1) . "-" . substr($toCandidatAffiche->ministereCode, -1);
				$zIputation = $toCandidatAffiche->budgetCode . "-" . $zChapitre . "-" . $zSectionCode;
			}*/
			$zSectionCode	= $oCandidat['section'] ; 
			$zSectionCode	= $oCandidat['section'] ; 
			$iIndice		= $oCandidat['indice'] ; 
			$zChapitre		= $oCandidat['soa'] ; 
			$zIputation		= $oCandidat['soa'] ; 
			$zBudget		= $oCandidat['budget'] ; 
		

			$oPdf->Cell(100,7,'Imputation budgetaire : ' . $zIputation,'R',0,'C',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' Grade ou emploi : ' .  $oCandidat["grade"],'LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'__________________________________','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' Indice : ' . $iIndice,'LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetFont('Times','U',10);

			$oPdf->SetX(10);
			$oPdf->Cell(60,7,'CONTROLE FINANCIER','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' ','TLR',0,'L',1);
			$oPdf->SetFont('Times','',11);
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Visa n° ................................................','LR',0,'C',1);

			$zService 		= "" ;
			$oStructure		=	$this->getStructure($oCandidat["structureId"]);
			$zService 		=  $oStructure["child_libelle"];
			$zString1 		= " En service auprès de la :" ;
			/*$zString 		= $zString . " du " ."\n";
			$zString 		= $zString . " Ministère de l'Economie et des Finances." ; */
			
			$zStringPart1 = $zString1;
			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(130,7,$zStringPart1 ,'LR',0,'L',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();
			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Du .......................................................','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,$zService,'LR',0,'L',1);
		
			$oPdf->Ln();
			
			
			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Du .......................................................','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7," du Ministère de l'Economie et des Finances.",'LR',0,'L',1);
		
			$oPdf->Ln();
			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Le Directeur du Contrôle','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' ','LR',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'Financier :','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' ','LR',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' ','LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' ','LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' ','LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','TLR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' NOUVELLE POSITION ','TLRB',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//=================================================================
			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' Budget : General ','TL',0,'L',1);
			$oPdf->SetFont('Times','',11);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'Imputation budgetaire : ','TR',0,'C',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(130,7,' Grade ou emploi : ' . '','LR',0,'L',1);
			$oPdf->SetFont('Times','',11);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1); 

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' Indice : ','L',0,'L',1);
			$oPdf->SetFont('Times','',13);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'" SANS CHANGEMENT "','R',0,'C',1);
		
			$oPdf->Ln();

			//=================================================================

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','B',11);
			$oPdf->Cell(130,7,' ','TLR',0,'C',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();


			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',12);
			$oPdf->Cell(130,7,' Obtient un congé annuel de ','LR',0,'L',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$zAvecS = "";
			if ($iNombreConge>1){
				$zAvecS = "s";
			}

			$oPdf->SetX(90);
			$oPdf->SetFont('Times','',12);
			$oPdf->Cell(110,7," - ".$iNombreConge." (".$this->int2str($iNombreConge).") jour".$zAvecS." au titre de l'année " . $_iId ,'R',0,'L',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(90);
			$oPdf->SetFont('Times','',12);
			$oPdf->Cell(110,7,"   avec solde entière." ,'R',0,'L',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LR',0,'C',1);

			$oPdf->SetX(90);
			$oPdf->SetFont('Times','',12);
			$oPdf->Cell(110,7,"   " ,'R',0,'L',1);
			$oPdf->SetFont('Times','',9);
		
			$oPdf->Ln();


			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','LRB',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' ','LB',0,'LB',1);
			$oPdf->SetFont('Times','',12);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,'Pour compter du ','RB',0,'C',1);
		
			$oPdf->Ln();



			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'POUR AMPLIATION CONFORME : ','T',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' - Dossier','T',0,'LB',1);
			$oPdf->SetFont('Times','',12);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,' ','T',0,'C',1);
		
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' - Chrono ',0,0,'LB',1);
			$oPdf->SetFont('Times','',12);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,' ',0,0,'C',1);
		
			$oPdf->Ln();

			//================================================================= 

			$oPdf->SetX(10);
			$oPdf->SetFont('Times','',10);
			$oPdf->Cell(60,7,'','',0,'C',1);

			$oPdf->SetX(70);
			$oPdf->SetFont('Times','',11);
			$oPdf->Cell(40,7,' - Interessé(e) ',0,0,'LB',1);
			$oPdf->SetFont('Times','',12);
			$oPdf->SetX(100);
			$oPdf->Cell(100,7,' ',0,0,'C',1);
		
			$oPdf->Ln();
		
			if ($oPdf->GetY()> 270){
				$oPdf->AddPage();
			}

			$oPdf->Output();
	}

	function dateLong($_zDate){
		$toDate = explode("-", $_zDate);

		$toMonth = array(
				 1 => 'Janvier',
				 2 => 'Février',
				 3 => 'Mars',
				 4 => 'Avril',
				 5 => 'Mai',
				 6 => 'Juin',
				 7 => 'Juillet',
				 8 => 'Août',
				 9=> 'Septembre',
				10=> 'Octobre',
				11 => 'Novembre',
				12 => 'Décembre'
			);

		$iMonth = (int)$toDate[1] ; 

		return $toDate[2].' '.$toMonth[$iMonth].' '.$toDate[0];
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
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRH")
									 ->setLastModifiedBy("TOJO MICHAEL DRH")
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
	

	public function setExcelExportFichePosteRecrutement ($_toListe) {

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
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRH")
									 ->setLastModifiedBy("TOJO MICHAEL DRH")
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
						'DEPARTEMENT'					=> 	'DEPARTEMENT', 
						'DIRECTION'						=> 	'DIRECTION', 
						'NOM'							=> 	'NOM', 
						'PRENOMS'						=> 	'PRENOMS',
						'USERID'						=> 	'USERID', 
						'ID FICHE DE POSTE'				=> 	'ID FICHE DE POSTE', 
						'INTITULE POSTE'				=> 	'INTITULE POSTE',
					  );


		$objPHPExcel->getActiveSheet()->mergeCells("A1:G1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:G2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:G2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));


		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:G5')->applyFromArray($default_style_ligne2);
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

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['departement']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['direction']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['prenom']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, $oListe['user_id']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['fichePoste_id']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['fichePoste_intitule']);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('B'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('C'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('D'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('E'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getStyle('G'.$iRowDynamic)->getAlignment()->setWrapText(true);
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=fiche-de-poste-recrutement-2015-2018-".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}





	public function setExcelFichePosteByLocalite ($_toListe, $_zType="departement") {

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
		$objPHPExcel->getProperties()->setCreator("TOJO MICHAEL DRH")
									 ->setLastModifiedBy("TOJO MICHAEL DRH")
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

		switch ($_zType) {
			case 'departement':
				$tHead1 = array(						
						'DEPARTEMENT'			=> 	'DEPARTEMENT', 
						'NOMBRE'				=> 	'NOMBRE',
					  );
				break;

			case 'direction':
				$tHead1 = array(						
						'DIRECTION'				=> 	'DIRECTION', 
						'NOMBRE'				=> 	'NOMBRE',
					  );
				break;
		}

		


		$objPHPExcel->getActiveSheet()->mergeCells("A1:C1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:C2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:C2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));


		$iRow = 5 ; 
		$iCol = 1;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:C5')->applyFromArray($default_style_ligne2);
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
		foreach ($_toListe as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, $oListe['libele']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nombre']);
			$iRowDynamic++;

		}

		

		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=fiche-de-poste_".$_zType."_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}

	public function getAllMatricule($_iMatriculeId)
	{
		global $db;
		$zDatabase =  $db['default']['database'] ;
		$zSql=" SELECT id,type_photo FROM $zDatabase.candidat WHERE matricule = " . $_iMatriculeId;

		$oQuery = $this->db->query($zSql);
				
        return $oQuery->row_array();
	}

	public function getAutorisationAbscence($_iUserId)
	{
		global $db;
		$zDatabase =  $db['default']['database'] ;
		$zSql=" SELECT	t.gcap_userSendId AS gcap_userSendId,
						(15-SUM(t.autorisation_restant)) AS autorisation_restant,
						t.exercice        AS exercice
				 FROM (SELECT
						gcap.gcap_userSendId AS gcap_userSendId,
						IF ( DATEDIFF(gcap.gcap_dateFin,gcap.gcap_dateDebut) =0,
							 IF(gcap_demiJournee=1,0.5,1),
							 DATEDIFF(gcap.gcap_dateFin,gcap.gcap_dateDebut)
						   )  AS autorisation_restant,
						YEAR(gcap.gcap_dateFin) AS exercice
					  FROM gcap.gcap
					  WHERE gcap.gcap_typeId = 18) t
				WHERE t.exercice = '".date("Y")."'
				AND   gcap_userSendId = $_iUserId
				GROUP BY t.gcap_userSendId,t.exercice";
		$oQuery = $this->db->query($zSql);
        return $oQuery->row_array();
	}

	public function ancienComptabilisation($zDateDebut,$zDateFin,$iDemiJournee,$matinSoir){
		
		$zNombreJourConge = 0 ; 

		if ($iDemiJournee == 1) {
			$oData["gcap_demiJournee"]	= $iDemiJournee ; 
			$oData["gcap_MatinSoir"]	= $matinSoir;
		}

		/* Test jour férié*/
		$zDateHierFerie = date("Y-m-d", strtotime($zDateDebut ."-1 days"));
		$zDateDemainFerie = date("Y-m-d", strtotime($zDateFin ."+1 days"));
		$toPasseFerie = $this->Gcap->getJourFerie ($zDateHierFerie);

		if (sizeof($toPasseFerie)>0){
			foreach ($toPasseFerie as $oPasseFerie){
				switch($oPasseFerie['ferie_jour']) {
					case 'Mon':
						if (date("Y-m-d") <= '2018-09-24'){
							$zNombreJourConge += 3 ; 
							if ($iDemiJournee == 1 && $iMatinSoir==2) {
								$zNombreJourConge -= 3 ; 
							}
						}
					break;

					default:
						if (date("Y-m-d") <= '2018-09-24'){
							$zNombreJourConge += 1 ; 
							if ($iDemiJournee == 1 && $iMatinSoir==2) {
								$zNombreJourConge -= 1 ; 
							}
						}
						break;

				}
			}
		}
		$toDemainFerie = $this->getJourFerie ($zDateDemainFerie);
		if (sizeof($toDemainFerie)>0){
			foreach ($toDemainFerie as $oDemainFerie){
				switch($oDemainFerie['ferie_jour']) {
					case 'Fri':
						if (date("Y-m-d") <= '2018-09-24'){
							$zNombreJourConge += 3 ; 
							if ($iDemiJournee == 1 && $iMatinSoir==1) {
								$zNombreJourConge -= 3 ; 
							}
						}
					break;

					default:
						if (date("Y-m-d") <= '2018-09-24'){
							$zNombreJourConge += 1 ; 
							if ($iDemiJournee == 1 && $iMatinSoir==1) {
								$zNombreJourConge -= 1 ; 
							}
						}
						break;

				}
			}
		}
		
		$iTestDayFinFerie = date("D", strtotime($zDateFin));
		if ($iTestDayFinFerie == 'Fri') {
			$zDateLundiFerie = date("Y-m-d", strtotime($zDateFin ."+3 days"));
			$toLundiFerie = $this->getJourFerie ($zDateLundiFerie);
			if (sizeof($toLundiFerie)>0){
				foreach ($toLundiFerie as $oLundiFerie){
					switch($oLundiFerie['ferie_jour']) {
						case 'Mon':
							if (date("Y-m-d") <= '2018-09-24'){
								$zNombreJourConge += 1 ; 

								$iTestDayDeb = date("D", strtotime($zDateDebut));
								$iTestDayFin = date("D", strtotime($zDateFin));

								if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
									$zNombreJourConge -= 1 ; 
								}
							}
						break;
					}
				}
			}
		}

		if($iTypeGcapId == AUTORISATION_ABSENCE && $iCompteActif == COMPTE_AGENT){

			$iType = $this->postGetValue ("type_id",0) ; 

			/* noombre de jour maximum à prendre */
			switch ($iType) {

				case AUTORISATION_ABSCENCE_ORDINAIRE:
					$iMax = 3; 
					break;

				case AUTORISATION_ABSCENCE_SPECIAL:
					$iMax = 7; 
					break;

				case AUTORISATION_SPECIAL_ABSCENCE:
					$iMax = 20;
					break;
			}

			
			$iTestDayDeb = date("D", strtotime($zDateDebut));
			$iTestDayFin = date("D", strtotime($zDateFin));
			

			$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

			if ($iDemiJournee == 1) {
				$zNombreJourConge = $zNombreJourConge-0.5;
			}

			/* test week end si ça commence par lundi */
			if ($iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge += 2;
				}
			}

			/* test week end si ça termine par vendredi */
			if ($iTestDayFin == 'Fri') {
				$zNombreJourConge += 2;
			}

			/* test week end si ça termine par Samedi */
			if ($iTestDayFin == 'Sat') {
				$zNombreJourConge += 1;
			}

			if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge -= 2;
				}
			}

			if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
				$zNombreJourConge -= 2;
			}

			$toNombreTotal = $this->nombreTotalPermissionAbscenceParAn ($oUser['id'], AUTORISATION_ABSENCE);

			$iDejaPris = 0;
			foreach ($toNombreTotal as $oNombreTotal){

			
				$iDifferenceAutorisation = floor($this->human_time_diff ($oNombreTotal['gcap_dateDebut'], $oNombreTotal['gcap_dateFin'])) ;

				if ($iDifferenceAutorisation>3){
					$iDejaPris +=3 ; 
				} else {
					$iDejaPris += $iDifferenceAutorisation ; 
				}

				$iTestDayDeb1 = date("D", strtotime($oNombreTotal['gcap_dateDebut']));
				$iTestDayFin1 = date("D", strtotime($oNombreTotal['gcap_dateFin']));
				
				if ($iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iDejaPris += 2;
					}
				}

				if ($iTestDayFin1 == 'Fri') {
					$iDejaPris += 2;
				}

				if ($iTestDayFin1 == 'Sat') {
					$iDejaPris += 1;
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1) {
					$iDejaPris -= 0.5 ; 
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iDejaPris -= 2;
					}
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
					$iDejaPris -= 2;
				}
			}

			if($zNombreJourConge > $iMax){
				$iDejaPris += $iMax ; 
			} else {
				$iDejaPris += $zNombreJourConge ; 
			}
			

			if ($iDejaPris > 15) {
				$iError = 4;
				
				redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
				
				die();
			}

			$oArrayFinalReste = array();
			if($zNombreJourConge > $iMax){

				/************** 29/09/2017 *****************/

				$iAutorisationDepassement = $zNombreJourConge - $iMax;

				$iType = $this->postGetValue ("type_id",0) ; 

				$toListe = $this->Decision->getDecisonValide($oUser['id'], 1);

				$iNombreTotalDispo = 0;

				foreach($toListe as $oListe){
					$iNombreTotalDispo += $oListe['reste'];
				}

				if ($iAutorisationDepassement > $iNombreTotalDispo){

					$iError = 3;
				
					redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
				
					die();
				}
			}
		}

		//echo $iAutorisationDepassement;

		//echo $zNombreJourConge ; 

		

		if($iTypeGcapId == PERMISSION && $iCompteActif == COMPTE_AGENT)
		{
			$toNombreTotal = $this->Gcap->nombreTotalPermissionAbscenceParAn ($oUser['id'], PERMISSION);

			$iDejaPris = 0;
			foreach ($toNombreTotal as $oNombreTotal){
				$iDejaPris += floor($this->human_time_diff ($oNombreTotal['gcap_dateDebut'], $oNombreTotal['gcap_dateFin'])) ;

				$iTestDayDeb1 = date("D", strtotime($oNombreTotal['gcap_dateDebut']));
				$iTestDayFin1 = date("D", strtotime($oNombreTotal['gcap_dateFin']));
				
				if ($iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iDejaPris += 2;
					}
				}

				if ($iTestDayFin1 == 'Fri') {
					$iDejaPris += 2;
				}

				if ($iTestDayFin1 == 'Sat') {
					$iDejaPris += 1;
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1) {
					$iDejaPris -= 0.5 ; 
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==2 &&  $iTestDayDeb1 == 'Mon') {
					if (date("Y-m-d") <= '2018-09-24'){
						$iDejaPris -= 2;
					}
				}

				if ($oNombreTotal['gcap_demiJournee'] == 1 && $oNombreTotal['gcap_MatinSoir']==1 &&  $iTestDayFin1 == 'Fri') {
					$iDejaPris -= 2;
				}
			}

			if ($iDejaPris > 20) {
				$iError = 5;
				
				redirect("gcap/edit/gestion-absence/autorisation-abscence?iError=".$iError);
				
				die();
			}

			$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

			/* test week end si ça commence par lundi */
			if ($iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge += 2;
				}
			}

			/* test week end si ça termine par vendredi */
			if ($iTestDayFin == 'Fri') {
				$zNombreJourConge += 2;
			}

			/* test week end si ça termine par samedi */
			if ($iTestDayFin == 'Sat') {
				$zNombreJourConge += 1;
			}

			if ($iDemiJournee == 1) {
				$zNombreJourConge -= 0.5;
			}

			if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge -= 2;
				}
			}

			if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
				$zNombreJourConge -= 2;
			}
		}

		


		if($iTypeGcapId == CONGE && $iCompteActif == COMPTE_AGENT)
		{

			$iType = $this->postGetValue ("type_id",0) ; 
			$zDateDebut = $this->date_fr_to_en($this->postGetValue ("date_debut"),'/','-'); 
			$zDateFin = $this->date_fr_to_en($this->postGetValue ("date_fin"),'/','-'); 

			$iTypeGcapDecision = $this->TypeGcap->get_TypeDecision_by_TypeGcapId ($iType);
			
			$iTestDayDeb = date("D", strtotime($zDateDebut));
			$iTestDayFin = date("D", strtotime($zDateFin));

			$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;

			/* test week end si ça commence par lundi */
			if ($iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge += 2;
				}
			}

			/* test week end si ça termine par vendredi */
			if ($iTestDayFin == 'Fri') {
				$zNombreJourConge += 2;
			}

			/* test week end si ça termine par Samedi */
			if ($iTestDayFin == 'Sat') {
				$zNombreJourConge += 1;
			}

			if ($iDemiJournee == 1) {
				$zNombreJourConge -= 0.5;
			}

			if ($iDemiJournee == 1 && $iMatinSoir==2 &&  $iTestDayDeb == 'Mon') {
				if (date("Y-m-d") <= '2018-09-24'){
					$zNombreJourConge -= 2;
				}
			}

			if ($iDemiJournee == 1 && $iMatinSoir==1 &&  $iTestDayFin == 'Fri') {
				$zNombreJourConge -= 2;
			}

			$toListe = $this->Decision->getDecisonValide($oUser['id'], $iTypeGcapDecision);

			$iNombreTotalDispo = 0;

			foreach($toListe as $oListe){
				$iNombreTotalDispo += $oListe['reste'];
			}

			$oArrayFinalReste = array();
			if($zNombreJourConge > $iNombreTotalDispo){

				if($iNombreTotalDispo == 0){
					//echo "Aucune décision n'a été créée concernant ce typy de congé<br />" ; 
					$iError = 1;
				} else {
					//echo "Le nombre de jour de demandé est supérieur au nombre de jour disponible.<br />" ; 
					$iError = 2;
				}
				
				redirect("gcap/edit/gestion-absence/conge?iError=".$iError);
				
				die();
			}
		}
	
	}

	public function nouveauComptabilisation($zDateDebut,$zDateFin,$iDemiJournee,$matinSoir){
		$zNombreJourConge				= 0 ; 
		if ($iDemiJournee == 1) {
			$oData["gcap_demiJournee"]	= $iDemiJournee ; 
			$oData["gcap_MatinSoir"]	= $matinSoir ;
		}

		//testons si le date debut est ferie
		$toDateDebutCongeFerie			= $this->Gcap->getJourFerie($zDateDebut);
		if( sizeof($toDateDebutCongeFerie) > 0){
			$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
		}
		//testons si date fin est ferié
		$toDateFinCongeferie			= $this->Gcap->getJourFerie($zDateFin);
		if( sizeof($toDateFinCongeferie) > 0 ){
			$zDateFin					= date("Y-m-d", strtotime($zDateFin ."-1 days"));
		}
		//ajuster date debut vers lundi
		if( date("D", strtotime($zDateDebut ."+0 days")) =="Sat"){
			$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+2 days"));
		}
		if( date("D", strtotime($zDateDebut ."+0 days")) =="Sun"){
			$zDateDebut					= date("Y-m-d", strtotime($zDateDebut ."+1 days"));
		}
		$zNombreJourConge += floor($this->human_time_diff ($zDateDebut, $zDateFin)) ;
		$zJourPriseService				= date("D", strtotime($zDateFin ."+1 days") );

		
		if( $zNombreJourConge > 0 && $zNombreJourConge <= 7  && $zJourPriseService =="Sun"){
			$zNombreJourConge			= $zNombreJourConge -1;
		}
		if( $zNombreJourConge > 0 && $zNombreJourConge <= 7  && $zJourPriseService =="Mon"){
			$zNombreJourConge			= $zNombreJourConge -2;
		}
		
		if ($iDemiJournee == 1) {
			$zNombreJourConge = $zNombreJourConge-0.5;
		}
	
	}

	public function getStructure($_child_id){
		$sql= " select * from t_structure where child_id = '".$_child_id."' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	
	public function get_gcap_dgep($matricule,$date_debut,$date_fin){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseRohi =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		
		$zSql= " SELECT b.matricule,
						c.typeGcap_libelle,
						gcap_dateDebut,
						gcap_dateFin,
						gcap_motif,
						gcap_interim,
						gcap_lieuJouissance,
						gcap_dateValidation
				 FROM gcap.gcap a
				 INNER JOIN rohi.candidat b
				 INNER JOIN gcap.typegcap c
				 ON a.gcap_userSendId = b.user_id
				 AND a.gcap_typeGcapId = c.typeGcap_id
				 WHERE b.path LIKE '%DGEP%'
			    ";
		if($matricule){
			$zSql= $zSql . " AND b.matricule='".$matricule."' ";
		}
		
		if($date_debut){
			$zSql= $zSql . " AND '".$date_debut."'<=gcap_dateDebut ";
		}
		
		if($date_fin){
			$zSql= $zSql . " AND gcap_dateFin<='".$date_fin."' ";
		}

		$oRow = array();
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;

	}
	
	public function get_gcap_dgfag($matricule){

		global $db;

		$DB1 			= 	$this->load->database('gcap', TRUE);
		$zDatabaseRohi 	=  	$db['default']['database'] ;
		$zDatabaseGcap 	=  	$db['gcap']['database'] ;
		
		$sqllist	=	" SELECT  t_structure_new.child_id
							FROM    (SELECT * FROM t_structure WHERE region_id =1
									 ORDER BY parent_id, child_id) t_structure_new,
									(SELECT @pv := '15') initialisation
							WHERE   FIND_IN_SET(parent_id, @pv)
							AND     LENGTH(@pv := CONCAT(@pv, ',', child_id))>0 ";
							
		$query		=   $this->db->query($sqllist);
		$toList		=   $query->result_array();
		$tzLists	=	array() ;
		
		array_push($tzLists,"15") ;
		foreach($toList as $oList){
			array_push($tzLists,"'".$oList["child_id"]."'") ;
		}
		$zList		=	implode(",",$tzLists);
		$zSql		= " SELECT  b.matricule,
								(SELECT typeGcap_libelle FROM gcap.typegcap WHERE typeGcap_id = a.gcap_typeGcapId) type_gcap,
								a.gcap_dateDebut,
								a.gcap_dateFin,
								a.gcap_motif,
								a.gcap_interim,
								a.gcap_lieuJouissance
						 FROM gcap.gcap a
						 INNER JOIN rohi.candidat b
						 ON a.gcap_userSendId = b.user_id
						 INNER JOIN rohi.t_structure c
						 ON b.structureId = c.child_id
						WHERE b.structureId IN ($zList) ";
				
		
		if($matricule){
			$zSql= $zSql . " AND b.matricule='".$matricule."' ";
		}
		
		$oRow 			= array();
		$zQuery 		= $DB1->query($zSql);
		$toRow 			= $zQuery->result_array();
		
		$zQuery->free_result(); 

		return $toRow;

	}
}
?>
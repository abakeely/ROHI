<?php
class Evaluation_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('evaluation', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertNoteEvaluation($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('noteevaluation', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertHistoriqueLocalisationByNotation($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('historiquecandidat', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function update_evaluation($oData, $_iUserId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('evaluation', $oData, "evaluation_userId = $_iUserId");
		return $_iGcapId ; 
	}

	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			case COMPTE_AGENT :
			case COMPTE_EVALUATEUR :
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :

				if ($_oUser['serv'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = ".$_oUser['serv']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

					if ($_oUser['reg'] != 0){
						$zSql .= " AND c12.region_id = ".$_oUser['reg']; 
					}

					 


				} elseif ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

					if ($_oUser['reg'] != 0){
						$zSql .= " AND c12.region_id = ".$_oUser['reg']; 
					}

				
				} elseif ($_oUser['dep'] != 0) {

					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = ".$_oUser['dep']." AND c12.service='' AND c12.direction=''" ;

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

					if ($_oUser['reg'] != 0){
						$zSql .= " AND c12.region_id = ".$_oUser['reg']; 
					}

				} else {
					
					if ($_oCandidat[0]->service != '') {
			
						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."' AND c12.region_id = ".$_oCandidat[0]->region_id." 
							" ;
						
					} elseif ($_oCandidat[0]->direction != '') {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.region_id = ".$_oCandidat[0]->region_id." 
							AND c12.service=''" ;
					} else {

						$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."' AND c12.region_id = ".$_oCandidat[0]->region_id." AND c12.service='' AND c12.direction=''" ;
					}


					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)  " ;


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
				}

				break;

			case COMPTE_AUTORITE :
					
				if ($_oCandidat[0]->service != '') {
			
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.service = '".$_oCandidat[0]->service."' AND c12.region_id = ".$_oCandidat[0]->region_id." 
						" ;
					
				} elseif ($_oCandidat[0]->direction != '') {

					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.region_id = ".$_oCandidat[0]->region_id." 
						AND c12.service=''" ;
				} else {

					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement = '".$_oCandidat[0]->departement."' AND c12.region_id = ".$_oCandidat[0]->region_id." AND c12.service='' AND c12.direction=''" ;
				}


				if ($iAffiche == 0) {
					$zSql  .= " AND c12.user_id <> $_iUserId  " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)  " ;


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
				}

				break;

			case COMPTE_ADMIN :
				$zUserId = "" ; 
				$zNotIn = " AND user_id <> " . $_iUserId . " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)"; 
				break;
		}

		return $zUserId ; 
	}

	public function get_agents_evalues_par_user_id($_iUserEvaluateurId = 0) {

		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= " select * from $zDatabaseGcap.evaluation WHERE 1" ;

		if ($_iUserEvaluateurId != 0) {
			$zSql .= " AND evaluation_userId = " . $_iUserEvaluateurId;
		}

		$zSql .= " AND evaluation_userEvalue <> '' ";

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$zReturn = "";
		$i=0;
		foreach ($toRow as $oRow){
			$tzReturn = $oRow["evaluation_userEvalue"];

			if ($i > 0) {
				$zReturn .= ",";
			}
			
			//$tzReturn = explode("-", $tzReturn);
			//$zReturn .= implode (",", $tzReturn);
			$tzReturn = explode("-", $tzReturn);
			$toReturnAll = array();
			foreach ($tzReturn as $izReturn) {
				if ($izReturn != ''){
					array_push($toReturnAll, $izReturn);
				}
			}
			$zReturn .= implode (",", $toReturnAll);
			$i++;
		}

		//$zReturn = str_replace(",,",",",$zReturn);
		
		return $zReturn;
	}
/***********************************************************Code Garina plus****************************************************************************/	
	public function get_count_each_periode($iPeriode){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zSql = "select COUNT(*) as total from $zDatabaseGcap.noteevaluation2 where noteEvaluation_periodeId = $iPeriode";
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();
		return $toRow[0]['total'];
	}
	
	public function get_count_by_region($iRegion=0 , $iPeriode=0){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zSql = "select COUNT(*) as total from $zDatabaseGcap.noteevaluation2 INNER JOIN $zDatabaseOrigin.candidat c on c.user_id = noteevaluation_userNoteId  where noteEvaluation_periodeId = $iPeriode 
				AND c.region_id = $iRegion";
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();
		return $toRow[0]['total'];
		
	}
	
	public function getPeriode (){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zSql = "select periode_id from $zDatabaseGcap.periode";
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();
		return $toRow;
	}
	
	public function get_liste_evaluateur_evalue(){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zSql= " select * from $zDatabaseGcap.evaluation " ;
		$oEvaluateurReturn = [];
		$oEvalueReturn = [];
		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		$iCond = 0;
		foreach ($toRow as $oRow){
			$oEvaluateurReturn[$iCond]=$oRow["evaluation_userId"];
			$zReturn = $oRow["evaluation_userEvalue"];
			$oEvalueReturn[$iCond] = explode("-", $zReturn);
			$iCond++;
		}
		$oReturn["oEvalueReturn"] = $oEvalueReturn;
		$oReturn["oEvaluateurReturn"] = $oEvaluateurReturn;
		
		return $oReturn;
	}
	
	public function get_liste_agent_stat($_iUserNoteId = 0){
		ini_set('MAX_EXECUTION_TIME', -1);
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		if ($_iUserNoteId != 0) {
			$zSql  = " select noteEvaluation_NoteAll, noteEvaluation_anneeNote, noteEvaluation_periodeId from noteevaluation2 " ;  
			$zSql .= " where noteEvaluation_userNoteId = " . $_iUserNoteId;
			

			$zQuery = $DB1->query($zSql);
			$toRow = $zQuery->result_array();
			$zQuery->free_result(); 
			$toResult = array();
			
			if(sizeof($toRow)>0){
				foreach ($toRow as $oRow){

					$toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ; 
					$fMoyenneNote = 0;
					$iIncrement = 0;
					foreach ($toNoteAll as $oNoteAll){
						$toSplitNote = explode("-", $oNoteAll) ; 

						if (isset ($toSplitNote[1])) {
							$fMoyenneNote += (double)$toSplitNote[1] ; 
							$iIncrement++; 
						}
					}
					if (sizeof($toNoteAll)>0 && $iIncrement>0){
						$fMoyenneNote = ($fMoyenneNote / $iIncrement) * 4; 
						$fMoyenneNote = number_format($fMoyenneNote,2);
					}

					$oResult['fMoyenneNote']				= $fMoyenneNote;
					//$oResult['noteEvaluation_periodeId']	= ;
					$oResult['noteEvaluation_anneeNote']	= $oRow['noteEvaluation_anneeNote'];
					$toResult[(int)$oRow['noteEvaluation_periodeId']] = $oResult;
				}
			}
			return $toResult;
		}else return false;
	}
	
	public function __get_liste_agent_stat(){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql  = " select noteevaluation2.*,(select periode_libelle from periode where periode_id = noteEvaluation_periodeId) as periode,(select CONCAT(nom,' ',prenom) FROM ".$zDatabaseOrigin.".candidat where user_id=noteevaluation_userSendNoteId) as nomEvaluateur,
		(select sigle_departement FROM ".$zDatabaseOrigin.".departement de where de.id=c.departement) as zSigleDepart,
		(select sigle_direction FROM ".$zDatabaseOrigin.".direction di where di.id=c.direction) as zSigleDirect,
		(select sigle_service FROM ".$zDatabaseOrigin.".service se where se.id=c.service) as zSigleService,
		c.id as iCandidatId 
		
		from noteevaluation2 INNER JOIN $zDatabaseOrigin.candidat c on c.user_id = noteevaluation_userNoteId where noteEvaluation_periodeId = 5 AND noteEvaluation_anneeNote like %2018%" ;  
		
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		$toResult = array();
		foreach ($toRow as $oRow){
			$oResult['noteEvaluation_id']			= $oRow['noteEvaluation_id'];
			$oResult['noteEvaluation_dateNotation'] = $oRow['noteEvaluation_dateNotation'];
			$oResult['nomEvaluateur']				= $oRow['nomEvaluateur'];
			$oResult['iCandidatId']					= $oRow['iCandidatId'];
			$oResult['zSigleDepart']				= $oRow['zSigleDepart'];
			$oResult['zSigleDirect']				= $oRow['zSigleDirect'];
			$oResult['zSigleService']				= $oRow['zSigleService'];
			$oResult['oEachNote']					= array();
			
			$toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ; 
			$fMoyenneNote = 0;
			$iIncrement = 0;
			$zCritereAndNote = "";
			foreach ($toNoteAll as $oNoteAll){
				$toSplitNote = explode("-", $oNoteAll) ; 
				array_push($oResult['oEachNote'], $toSplitNote);
				
				if (isset ($toSplitNote[1])) {
					$fMoyenneNote += (double)$toSplitNote[1] ; 
					$zCritereAndNote .= "- " . ucFirst($this->getCritereLibelle((int)$toSplitNote[0])) . " : " . (double)$toSplitNote[1] . "<br/>" ; 
					$iIncrement++; 
				}
			}

			if (sizeof($toNoteAll)>0){
				$fMoyenneNote = ($fMoyenneNote / $iIncrement) * 4 ; 
			}

			$oResult['fMoyenneNote']				= $fMoyenneNote;
			$oResult['noteEvaluation_evaluable']	= $oRow['noteEvaluation_evaluable'];
			$oResult['noteEvaluation_periodeId']	= $oRow['noteEvaluation_periodeId'];
			$oResult['periode']						= $oRow['periode'];
			$oResult['zCritereAndNote']				= $zCritereAndNote;
			$oResult['noteEvaluation_anneeNote']	= $oRow['noteEvaluation_anneeNote'];
			array_push($toResult, $oResult);

		}
		
		return $toResult;
	}
/************************************************************Fin Code Garina***************************************************************************/
	public function get_agents_deja_inclus($_iUserId = 0, $_this) {
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql= " select * from $zDatabaseGcap.evaluation " ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$zReturn = "";
		$iTrouv=0;
		foreach ($toRow as $oRow){

			if ($iTrouv != 1) {
				$tzReturn = $oRow["evaluation_userEvalue"];
				$toReturn = explode("-", $tzReturn);
				
				foreach ($toReturn as $iReturn){
					if ($_iUserId == $iReturn) {
						$oCandidatEvaluateur = $_this->candidat->get_by_user_id($oRow["evaluation_userId"]);
						$zReturn = $oCandidatEvaluateur[0]->nom . " " . $oCandidatEvaluateur[0]->prenom . " (" . $oCandidatEvaluateur[0]->matricule . ")";
						$iTrouv  = 1;
					}
				}
			}
			
		}
		
		return $zReturn;
	}


	public function notificationEvaluateur($_iUserId = 0, $_this) {
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 


		$iMois = (int)date("m");

		if ($iMois <=3){
			$iPeriodeTest = 3;
			$iAnneeTest = (int)date('Y');
		}elseif ($iMois > 3 && $iMois <=6) {
			$iPeriodeTest = 4;
			$iAnneeTest = date('Y')-1;
		}elseif ($iMois > 6 && $iMois <=9) {
			$iPeriodeTest = 1;
			$iAnneeTest = date('Y');
		}elseif ($iMois > 9 && $iMois <=12) {
			$iPeriodeTest = 2;
			$iAnneeTest = date('Y');
		}

		$iTrouv=0;

		$zSql= " SELECT * FROM $zDatabaseGcap.evaluation WHERE evaluation_userId = ".$_iUserId." "  ;

		$zQuery = $this->db->query($zSql);
		$toRowEvaluation = $zQuery->result_array();
		$zQuery->free_result();

		if (sizeof($toRowEvaluation)>0) {
			$iTrouv=1;

			if ($toRowEvaluation[0]["evaluation_userEvalue"] == 0){
				$iTrouv=0;
			}
		}

		$zSql= " SELECT * FROM $zDatabaseGcap.evaluation INNER JOIN $zDatabaseGcap.noteevaluation2 ON noteEvaluation_userSendNoteId = evaluation_userId
				 AND noteEvaluation_userSendNoteId = ".$_iUserId."  AND noteEvaluation_periodeId = ".$iPeriodeTest."  AND noteEvaluation_anneeNote = ".$iAnneeTest." "  ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		if (sizeof($toRow)>0) {
			$iTrouv=2;
		} 
		
		return $iTrouv;
	}

	public function get_note_all_agent($_iUserNoteId = 0) {

		global $db;

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseGcap =  $db['gcap']['database'] ;

		$zSql  = " select *,(select CONCAT(nom,' ',prenom) FROM ".$zDatabaseOrigin.".candidat where user_id=noteEvaluation_userSendNoteId) as nomEvaluateur,
		(select c.id FROM ".$zDatabaseOrigin.".candidat c where user_id=noteEvaluation_userNoteId) as iCandidatId
		
		from $zDatabaseGcap.noteevaluation " ;  

		if ($_iUserNoteId != 0) {
			$zSql .= " where noteEvaluation_userNoteId = " . $_iUserNoteId;
		}

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		
		return $toRow;
	}

	public function get_search_note_by_agent($_iUserNoteId, $_iMois, $_iAnnee) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select * from noteevaluation where noteEvaluation_userNoteId = " . $_iUserNoteId;
		$zSql .= " and noteEvaluation_moisNote = '" . (int)$_iMois . "'";
		$zSql .= " and noteEvaluation_anneeNote = '" . (int)$_iAnnee . "'";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		
		return $toRow;
	}
	

	public function get_all_User_rattache($_oDataSearch=array(),$oUser,$_oCandidat,$_iUserId,$_iCompteActif,$_iUserEvaluateurId,$zInEvaluation,$iTestInNotIn=1, $_zSortSens = "ASC", $_zFieldOrder = "c.id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$iAffiche = 0;
		if ($_iCompteActif == COMPTE_AUTORITE) {
			$iAffiche = 1;
		}

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);

		
		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,c.nom as nom,REPLACE(cin,' ','') as cin, c.prenom as prenom,c.id as id, d.libele as zDirection, s.libele as zService, m.libele as zDivision,c.user_id AS userId, IFNULL((select userCompte_compteId from usercompte WHERE userCompte_userId = userId AND userCompte_compteId = ".COMPTE_EVALUATEUR." LIMIT 0,1),0) as iCompte,
				(SELECT COUNT(decision_id) FROM decision WHERE decision_userId = userId AND decision_statutId = ".STATUT_CREATION.") As nbDecision
				FROM $zDatabaseOrigin.candidat c
				LEFT JOIN $zDatabaseOrigin.departement de ON de.id = c.departement
				LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
				LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division
				WHERE 1 ";

		

		if (isset($_POST["iMatricule"]) && $_POST["iMatricule"] != "") {
			$zSql .= " AND c.matricule = '" . $_POST["iMatricule"]."'" ;
		}

		$zSql .=  " AND (c.sanction='0' || c.sanction='34' || c.sanction='40' || c.sanction='' || c.sanction='00' || c.sanction IS NULL) "  ; 

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		if ($_iUserEvaluateurId != "")
		{
			$zSql .= " AND user_id NOT IN ($_iUserEvaluateurId) " ;
		}

		if ($iTestInNotIn == 1) {
			$iExexSql = 1; 
			if ($zUserId != "")
			{
				$zSql .= " AND user_id IN ($zUserId) " ;
			}

			if ($zInEvaluation != ""){
				$zSql .= " AND user_id NOT IN ($zInEvaluation) " ;
			}
		} else {
			
			if ($zInEvaluation != ""){
				$iExexSql = 1; 
				$zSql .= " AND user_id IN ($zInEvaluation) " ;
			} else {
				$iExexSql = 0; 
			}
		}

		$zSql .= " ORDER BY " . $_zFieldOrder . " " . $_zSortSens . " " ;

		$oRow = array();
		if ($iExexSql == 1) {
			$zQuery = $DB1->query($zSql);
			$oRow = $zQuery->result_array();
			$zQuery->free_result(); 
		}

		return $oRow;

	}


	public function get_candidat_by_cin_or_matricule($_iMatricule, $_iCin){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT user_id, REPLACE(cin,' ','') as cin,c.nom,c.prenom FROM ".$zDatabaseOrigin.".candidat c ";

		if (isset($_iMatricule) && $_iMatricule != 0) {
			$zSql .= " WHERE c.matricule = '" . $_iMatricule ."'" ;
		}

		if (isset($_iCin) && $_iCin != 0) {
			
			$iCin	= $_iCin ;  
			$iCin	= str_replace(" ","",$iCin);
			$zSql  .= " HAVING cin = '" . $iCin . "'" ;
		}

		//echo $zSql;
		$oRow = array();
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function get_user_by_cin_Matricule($_iCin,$_iMatricule, $_zNoteAgent=''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = "";
		
		
		$zSql= "SELECT user_id, nom,REPLACE(cin,' ','') as cin, prenom,matricule
				FROM $zDatabaseOrigin.candidat c
				WHERE 1 ";

		if ($_zNoteAgent != ""){
			$zSql .= " AND user_id NOT IN ($_zNoteAgent) " ;
		}

		if ($_iMatricule != "") {
			$zSql .= " AND c.matricule = '" . $_iMatricule ."'" ;
		}

		if ($_iCin != "") { 
			$iCin = str_replace(" ","",$_iCin);
			$zSql .= " HAVING cin = '" . $_iCin . "'" ;
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$oDataReturn = array();
		$oDataReturn['user_id'] = 0 ; 
		$zAffichage = "";
		foreach ($oRow as $oRow){
			$oDataReturn['user_id'] = $oRow['user_id'] ; 
			$oDataReturn['iUserId'] = $oRow['user_id'] ; 
			$oDataReturn['zName']	= $oRow['nom'] . " " . $oRow['prenom'] ;
			$zAffichage .= "<option value='".$oRow['user_id']."'>".$oRow['nom']."&nbsp;".$oRow['prenom']." (IM : ".$oRow['matricule'].")</option>"; 
		}

		$oDataReturn['affichage'] = $zAffichage ; 

		return $oDataReturn;

	}


	public function get_user_by_cin_Matricule_other($_iCin,$_iMatricule, $_zNoteAgent=''){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zNotIn = "";
		
		
		$zSql= "SELECT user_id, nom,REPLACE(cin,' ','') as cin, prenom,matricule
				FROM $zDatabaseOrigin.candidat c
				WHERE 1 ";

		if ($_zNoteAgent != ""){
			$zSql .= " AND user_id NOT IN ($_zNoteAgent) " ;
		}

		if ($_iMatricule != "") {
			$zSql .= " AND c.matricule = '" . $_iMatricule ."'" ;
		}

		if ($_iCin != "") { 
			$iCin = str_replace(" ","",$_iCin);
			$zSql .= " HAVING cin = '" . $_iCin . "'" ;
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;

	}

	function isPointage(){

		$DB1 = $this->load->database('gcap', TRUE);
		$zSql= "SELECT * from noteevaluation WHERE noteEvaluation_notePonctualite ='' ";

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();

		foreach ($toRow as $oRow){

			$oCandidat = $this->Gcap->get_by_user_id($oRow['noteEvaluation_userNoteId']);
			$zInMatriculeUser		  = $this->Transaction->getMatriculeAgent(1, $oRow['noteEvaluation_userNoteId'], $oCandidat);
			$iMoyenneUserInfoPointage11 = $this->Transaction->TempsDeTravailDunAgentAvecDenominateur($zInMatriculeUser, '01/08/2016', '12/10/2016', $iDenominateur,$this);

			if ($iMoyenneUserInfoPointage11 != ''){
			
				//$iMoyenneUserInfoPointage = $iMoyenneUserInfoPointage, 2, '.', ''));
				$notFloor1 = floor($iMoyenneUserInfoPointage11);
				$notFloor = number_format($iMoyenneUserInfoPointage11, 2, '.', '');


				$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage11, 2, ',','');


				$toMoyenneUserInfoPointage = explode(',', $iMoyenneUserInfoPointage) ; 

				$iAvantVirgule = $toMoyenneUserInfoPointage[0] ; 
				if ($toMoyenneUserInfoPointage[1] != "00"){

					if ($toMoyenneUserInfoPointage[1] <= 25) {
						$iMoyenneUserInfoPointage = $iAvantVirgule . ".25" ; 
					} elseif ($toMoyenneUserInfoPointage[1] > 25 && $toMoyenneUserInfoPointage[1] <=65) {
						$iMoyenneUserInfoPointage = $iAvantVirgule . ".50" ; 
					} elseif ($toMoyenneUserInfoPointage[1] > 65 && $toMoyenneUserInfoPointage[1] <=80) {
						$iMoyenneUserInfoPointage = $iAvantVirgule . ".75" ; 
					} elseif ($toMoyenneUserInfoPointage[1] > 80 && $toMoyenneUserInfoPointage[1] <=99) {
						$iAvantVirgule++ ; 
						$iMoyenneUserInfoPointage = $iAvantVirgule;
					} else {
						$iMoyenneUserInfoPointage = $iAvantVirgule;
						$iMoyenneUserInfoPointage = number_format($iMoyenneUserInfoPointage, 2, '.',''); 
					}
				} else {
					$iMoyenneUserInfoPointage = $iAvantVirgule ; 
				}

				$zSqlUpdate= "UPDATE gcap.noteevaluation SET noteEvaluation_isPointage = 1, noteEvaluation_notePonctualite = '".$iMoyenneUserInfoPointage."' WHERE noteEvaluation_id = " . $oRow['noteEvaluation_id'] ;

				echo $zSqlUpdate . "</br>" ; 
				$DB1->query($zSqlUpdate);
			}
			
		}
	}

	function date_fr_to_en($date_to_convert, $separator_fr, $separtor_en){
		if($date_to_convert && isset($date_to_convert)){
			$tab = explode($separator_fr, $date_to_convert);
			if (count($tab) == 3) {
				$res = $tab[2] . $separtor_en . $tab[1] . $separtor_en . $tab[0];
				return $res;
			}
		}
		return $date_to_convert;
	}

	function date_en_to_fr($date_to_convert, $separator_en, $separtor_fr){
		if($date_to_convert && isset($date_to_convert)){
			$tab = explode($separator_en, $date_to_convert);
			if (count($tab) == 3) {
				$res = $tab[2] . $separtor_fr . $tab[1] . $separtor_fr . $tab[0];
				return $res;
			}
		}
		return $date_to_convert;
	}

	public function getEvaluation_by_Id($_iEvaluationId){
		$DB1 = $this->load->database('gcap', TRUE);
		$zQuery = $DB1->get_where('noteevaluation', array('noteEvaluation_id' => $_iEvaluationId));
		return $zQuery->row_array();
	}

	
}
?>
<?php
class Evaluation2_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('evaluation', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertnoteevaluation2($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('noteevaluation2', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertDesevaluation($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('desevaluation', $oData)){
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
			case COMPTE_AUTORITE :

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

			case COMPTE_ADMIN :
				$zUserId = "" ; 
				$zNotIn = " AND user_id <> " . $_iUserId . " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)"; 
				break;
		}

		return $zUserId ; 
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
		
		$listStructure	=	implode("," , $structures) ;
			
		if( isset($listStructure) ){
			$zSql			= " SELECT user_id 
								  FROM rohi.candidat 
								 WHERE structureId IN ('".$listStructure."')
								UNION
								SELECT user_id 
								  FROM rohi.candidat 
								 WHERE user_id IN ( SELECT premier_responsable_id FROM rohi.t_structure WHERE parent_id IN ('".$listStructure."') ) ";
			
			$zQuery 		= $DB1->query($zSql);
			$toRow1 		= $zQuery->result_array();
			$zQuery->free_result(); 
		}
		$zReturn 		= 	"";
		$i				=	0;
		$toReturnAll 	= 	array();
		foreach ($toRow1 as $oRow){
			$user_id 	= $oRow["user_id"];
			array_push($toReturnAll, $user_id);
		}
		//echo "XYZ-OK";
		$zReturn = implode("," , $toReturnAll) ;
		//echo $zReturn;die;
		
		return $zReturn;
	}

	public function get_ALL_Agents_evalues_par_user_id($_iUserEvaluateurId = 0) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= " select * from evaluation WHERE 1" ;

		if ($_iUserEvaluateurId != 0) {
			$zSql .= " AND evaluation_userId = " . $_iUserEvaluateurId;
		}

		$zSql .= " AND evaluation_userEvalue <> '' ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$tzReturn = array();
		$i=0;
		foreach ($toRow as $oRow){
			$tzReturn = $oRow["evaluation_userEvalue"];
			$tzReturn = explode("-", $tzReturn);
		}

		return $tzReturn;
	}


	public function get_agents_deja_inclus($_iUserId = 0, $_this) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= " select * from evaluation " ;

		$zQuery = $DB1->query($zSql);
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
						$zReturn = $oCandidatEvaluateur[0]->nom . " " . $oCandidatEvaluateur[0]->prenom;
						$iTrouv  = 1;
					}
				}
			}
			
		}
		
		return $zReturn;
	}

	public function get_note_all_agent_sfao($_iUserNoteId = 0,$_iDebut,$_iFin) {

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$toDateDebut = explode("-",$_iDebut);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql  = " select *,noteEvaluation_userNoteId as iCandidatId,(select periode_libelle from periode where periode_id = noteEvaluation_periodeId) as periode,(select CONCAT(nom,' ',prenom) FROM ".$zDatabaseOrigin.".candidat where user_id=noteevaluation_userSendNoteId) as nomEvaluateur,
		(select c.id FROM ".$zDatabaseOrigin.".candidat c where user_id=noteevaluation_userNoteId) as iCandidatId
		
		from noteevaluation2 INNER JOIN `periode` ON noteEvaluation_periodeId = periode_id" ;  

		if ($_iUserNoteId != 0) {
			$zSql .= " where noteevaluation_userNoteId = " . $_iUserNoteId;
		}

		if (isset($toDateDebut[0]) && $toDateDebut[0]!=""){
			$zSql .= " AND periode_annee = " . $toDateDebut[0];
		}

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		$toResult = array();
		foreach ($toRow as $oRow){
			$oResult['noteEvaluation_id']			= $oRow['noteEvaluation_id'];
			$oResult['noteEvaluation_dateNotation'] = $oRow['noteEvaluation_dateNotation'];
			$oResult['nomEvaluateur']				= $oRow['nomEvaluateur'];
			$oResult['iCandidatId']					= $oRow['iCandidatId'];

			$toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ; 
			$fMoyenneNote = 0;
			$iIncrement = 0;
			$zCritereAndNote = "";
			foreach ($toNoteAll as $oNoteAll){
				$toSplitNote = explode("-", $oNoteAll) ; 

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


	public function get_note_all_agent($_iUserNoteId = 0) {

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql  = " select *,noteEvaluation_userNoteId as iCandidatId,(select periode_libelle from periode where periode_id = noteEvaluation_periodeId) as periode,(select CONCAT(nom,' ',prenom) FROM ".$zDatabaseOrigin.".candidat where user_id=noteevaluation_userSendNoteId) as nomEvaluateur,
		(select c.id FROM ".$zDatabaseOrigin.".candidat c where user_id=noteevaluation_userNoteId) as iCandidatId
		
		from noteevaluation2 " ;  

		if ($_iUserNoteId != 0) {
			$zSql .= " where noteevaluation_userNoteId = " . $_iUserNoteId;
		}

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		$toResult = array();
		foreach ($toRow as $oRow){
			$oResult['noteEvaluation_id']			= $oRow['noteEvaluation_id'];
			$oResult['noteEvaluation_dateNotation'] = $oRow['noteEvaluation_dateNotation'];
			$oResult['nomEvaluateur']				= $oRow['nomEvaluateur'];
			$oResult['iCandidatId']					= $oRow['iCandidatId'];

			$toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ; 
			$fMoyenneNote = 0;
			$iIncrement = 0;
			$zCritereAndNote = "";
			foreach ($toNoteAll as $oNoteAll){
				$toSplitNote = explode("-", $oNoteAll) ; 

				if (isset ($toSplitNote[1])) {
					$fMoyenneNote += (double)$toSplitNote[1] ; 
					$zCritereAndNote .= "- " . ucFirst($this->getCritereLibelle((int)$toSplitNote[0])) . " : " . (double)$toSplitNote[1] . "<br/>" ; 
					$iIncrement++; 
				}
			}

			if (sizeof($toNoteAll)>0){
				if($fMoyenneNote>0){
					$fMoyenneNote = ($fMoyenneNote / $iIncrement) * 4 ; 
				}
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


	public function getAgent ($_iUserId){
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql  = " select CONCAT(nom,' ',prenom, ' (',matricule,')') as compte FROM ".$zDatabaseOrigin.".candidat where user_id = " . $_iUserId  ; 

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zReturn = "";

		foreach ($toRow as $oRow) {
			$zReturn = $oRow['compte'];
		}

		return $zReturn;

	}


	public function get_all_note_export($_iCategorieId) {

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql  = " SELECT noteevaluation2.*, (select CONCAT(nom,' ',prenom, ' (',matricule,')') FROM ".$zDatabaseOrigin.".candidat where user_id=noteevaluation_userSendNoteId) as nomEvaluateur, (select CONCAT(nom,' ',prenom, ' (',matricule,')') FROM ".$zDatabaseOrigin.".candidat where user_id=noteEvaluation_userNoteId) as nomAgent FROM noteevaluation2
		INNER JOIN ".$zDatabaseOrigin.".candidat c ON c.user_id = noteEvaluation_userNoteId
		WHERE noteEvaluation_categorieId = ".$_iCategorieId." AND direction=54" ; 


		/*$zSql  = " SELECT noteevaluation2.*, candidat.nom, candidat.prenom, candidat.matricule,candidat.cin,0 as periode,0 as nomEvaluateur FROM noteevaluation2 INNER JOIN ".$zDatabaseOrigin.".candidat ON user_id = noteEvaluation_userNoteId AND 
		noteEvaluation_categorieId = ".$_iCategorieId."" ;*/

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		$toResult = array();
		foreach ($toRow as $oRow){
			$oResult['noteEvaluation_id']				= $oRow['noteEvaluation_id'];
			$oResult['noteEvaluation_dateNotation']		= $oRow['noteEvaluation_dateNotation'];
			$oResult['nomEvaluateur']					= $oRow['nomEvaluateur'];
			$oResult['nomAgent']						= $oRow['nomAgent'];
			$oResult['noteEvaluation_userSendNoteId']	= $oRow['noteEvaluation_userSendNoteId'];
			$oResult['noteEvaluation_userNoteId']		= $oRow['noteEvaluation_userNoteId'];
		
			$toNoteAll = explode(";", $oRow['noteEvaluation_NoteAll']) ; 
			$fMoyenneNote = 0;
			$iIncrement = 0;
			$zCritereAndNote = "";
			$toNote = array();
			foreach ($toNoteAll as $oNoteAll){
				$toSplitNote = explode("-", $oNoteAll) ; 

				if (isset ($toSplitNote[1])) {
					$fMoyenneNote += (double)$toSplitNote[1] ; 
					//$zCritereAndNote .= ucFirst($this->getCritereLibelle((int)$toSplitNote[0])) . " : " . (double)$toSplitNote[1] . "<br/>" ; 
					array_push ($toNote, (double)$toSplitNote[1]);
					$iIncrement++; 
				}
			}

			if (sizeof($toNoteAll)>0){
				$fMoyenneNote = ($fMoyenneNote / $iIncrement) * 4 ; 
			}

			$oResult['fMoyenneNote']				= $fMoyenneNote;
			$oResult['noteEvaluation_evaluable']	= $oRow['noteEvaluation_evaluable'];
			$oResult['noteEvaluation_periodeId']	= $oRow['noteEvaluation_periodeId'];
			$oResult['zCritereAndNote']				= $toNote;
			$oResult['noteEvaluation_anneeNote']	= $oRow['noteEvaluation_anneeNote'];
			array_push($toResult, $oResult);

		}
		
		return $toResult;
	}

	public function getCritereLibelle($_iCritereId) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select critere_libelle from critereevaluation where critere_id = " . $_iCritereId ;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 
		
		return $oRow[0]->critere_libelle;
	}

	public function get_Organisation($id = FALSE, $_zNomOrganisation='departement', $_iTypeSearch = 0,$_iDistrictId=0){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= 'select * from '.$zDatabaseOrigin.'.'.$_zNomOrganisation; 

		switch ($_iTypeSearch){
		
			case 1:
				$zSql .= " where province_id IN (0,".$id.") ORDER BY province_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 2:
				$zSql .= " where region_id IN (0,".$id.") ORDER BY region_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 3:
				//$zSql .= " INNER JOIN district_has_departement ON id_dep = id  where id_dist IN (0,".$_iDistrictId.") ORDER BY id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 4:
				//$zSql .= " INNER JOIN district_has_direction ON direction_id = id where district_id IN (0,".$_iDistrictId.") AND departement_id = ".$id." ORDER BY id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 5:
				//$zSql .= " INNER JOIN district_has_service ON service_id = id where district_id IN (0,".$_iDistrictId.") AND direction_id = ".$id." ORDER BY direction_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;

			case 6:
				$zSql .= " where service_id IN (0,".$id.") ORDER BY service_id,id ";
				$query = $this->db->query($zSql);
				return $query->result_array();
				break;
		}

		
		return $query->row_array();
	}

	public function getNotificationEvaluateurDesevaluateur($_oCandidat, $_zNotInEvaluation,$_oUser) {
		
		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSql  = " SELECT c.id,c.nom,c.prenom,c.matricule,c.user_id,de.sigle_departement as zDepartement,
				   di.sigle_direction as zDirection,
				   s.sigle_service as zService 
				   FROM $zDatabaseOrigin.candidat c
				   LEFT JOIN $zDatabaseOrigin.departement de ON de.id = c.departement
				   LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
				   LEFT JOIN $zDatabaseOrigin.direction di ON di.id = c.direction WHERE 1 " ;

		if ($_oCandidat[0]->region_id != '') {
			$zSql .= " AND region_id = ".$_oCandidat[0]->region_id ; 
		}

		if ($_oCandidat[0]->province_id != '') {
			$zSql .= " AND province_id = ".$_oCandidat[0]->province_id ; 
		}

		if ($_oCandidat[0]->departement != '') {
			$zSql .= " AND departement = ".$_oCandidat[0]->departement ; 
		}

		if ($_oCandidat[0]->direction != '') {
			$zSql .= " AND direction = ".$_oCandidat[0]->direction ; 
		}

		$zSql .= " AND user_id NOT IN ($_zNotInEvaluation) "  ;


		$zSql .= " AND user_id NOT IN (SELECT desevaluation_userId FROM ".$zDatabaseGcap.".desevaluation WHERE desevaluation_evaluateurId = ".$_oUser['id']." AND desevaluation_motifs IN ('3')) "  ;

		/* Sanction */
		$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)  " ;

		/* AND service = ".$_oCandidat[0]->service." */

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 
		
		return $toRow;
	}



	public function getPeriode($_iPeriodeId=0) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " SELECT * FROM periode " ; 

		if ($_iPeriodeId != 0){
			$zSql  .= " WHERE periode_id = " . $_iPeriodeId ;
		}

		$zSql  .= " ORDER BY periode_ordre ASC" ;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 
		
		return $oRow ;
	}


	public function get_agents_deja_inclus2($_iUserId = 0, $_this) {
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
						$zReturn = $oRow["evaluation_userId"];
						$iTrouv  = 1;
					}
				}
			}
			
		}
		
		return $zReturn;
	}


	public function getEvaluateur($_iEvaluateurId) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select * from evaluation where evaluation_userId = " . $_iEvaluateurId ;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		$iReturn = 0;
		if (sizeof ($oRow)>0){
			$iReturn = 1;
		}
	
		return $iReturn ;
	}

	public function get_search_note_by_agent($_iUserNoteId, $_iMois, $_iAnnee) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select * from noteevaluation2 where noteevaluation_userNoteId = " . $_iUserNoteId;
		$zSql .= " and noteEvaluation_periodeId = '" . (int)$_iMois . "'";
		$zSql .= " and noteEvaluation_anneeNote = '" . (int)$_iAnnee . "'";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		
		return $toRow;
	}


	public function getCritereEtGroup($_iClassificationId) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " select * from critereevaluation INNER JOIN groupecritere ON critere_groupeId = groupeCritere_id 
		
		INNER JOIN classification ON classification_critereId = critere_id 
		WHERE critere_actif = 1 AND classification_id = " . $_iClassificationId ;

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 
		
		return $toRow;
	}

	public function getPeriodeLibelle(){
		$DB1 = $this->load->database('gcap', TRUE);

		$iMois = (int)date("m");

		if ($iMois == 12 || $iMois <=2 ){
			$iPeriode = 4;
		}elseif ($iMois >= 3 && $iMois <6) {
			$iPeriode = 1;
		}elseif ($iMois >= 6 && $iMois <9) {
			$iPeriode = 2;
		}elseif ($iMois >= 9 && $iMois <12) {
			$iPeriode = 3;
		}

		/* à enlever */
		$iPeriode = 4;

		$zSql  = " SELECT * FROM periode WHERE periode_id = " . $iPeriode  ;

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$zLibelle = "";

		foreach($toRow as $oRow){
			$zLibelle = $oRow['periode_libelle']. " (" . $oRow['periode_mois'] . ")"  ; 
		}
		
		return $zLibelle;
	}
	

	public function get_all_User_rattache($_iPeriode=0,$_iAnnee=0,$_bHaving,$_oDataSearch=array(),$oUser,$_oCandidat,$_iUserId,$_iCompteActif,$_iUserEvaluateurId,$zInEvaluation,$iTestInNotIn=1, $_zSortSens = "ASC", $_zFieldOrder = "c.id"){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$iAffiche = 0;
		if ($_iCompteActif == COMPTE_AUTORITE) {
			$iAffiche = 1;
		}

		$zNotIn = "";
		$zUserId = $this->getAllUserSubordonnees ($oUser,$_oCandidat,$_iUserId, $_iCompteActif, $zNotIn,1);

		if ($_iPeriode != 0 && $_iAnnee != 0){
			$iPeriode = $_iPeriode;
			$iAnnee = $_iAnnee;
		} else {
			$iMois = (int)date("m");
			
			/*if ($iMois == 12 || $iMois <=2 ){
				$iPeriode = 3;
				$iAnnee = (int)date('Y');
			}elseif ($iMois >= 3 && $iMois <6) {
				$iPeriode = 4;
				$iAnnee = (int)date('Y')-1;
			}elseif ($iMois >= 6 && $iMois <9) {
				$iPeriode = 1;
				$iAnnee = date('Y');
			}elseif ($iMois >= 9 && $iMois <12) {
				$iPeriode = 2;
				$iAnnee = date('Y');
			}*/

			$iPeriode = 5;
			$iAnnee = date('Y');
			if ($iMois >=3 && $iMois <6){
				$iPeriode = 5;
			} elseif ($iMois >= 6 && $iMois <9) {
				$iPeriode = 1;
			} elseif ($iMois >= 9 && $iMois <12) {
				$iPeriode = 2;
			} elseif ($iMois >= 1 && $iMois <3) {
				$iPeriode = 3;
			}

			
		}

		/* à enlever */

		/*$iPeriode = 4;
		$iAnnee = (int)date('Y')-1;*/

		
		$zSql= "SELECT SQL_CALC_FOUND_ROWS *,c.nom as nom,REPLACE(cin,' ','') as cin, c.prenom as prenom,c.id as id, d.libele as zDirection, s.libele as zService, m.libele as zDivision,c.user_id AS userId, IFNULL((select userCompte_compteId from usercompte WHERE userCompte_userId = userId AND userCompte_compteId = ".COMPTE_EVALUATEUR." LIMIT 0,1),0) as iCompte,IFNULL((SELECT localite_id FROM $zDatabaseGcap.localite WHERE localite_userId = c.user_id AND localite_statut = 1 LIMIT 0,1 ), 0) as iLocaliteChange,
		ifnull((SELECT noteEvaluation_id FROM noteevaluation2 WHERE noteEvaluation_userNoteId = c.user_id AND noteEvaluation_periodeId = ".$iPeriode." AND noteEvaluation_anneeNote = ".$iAnnee." LIMIT 0,1),0) isNotePeriodeEnCours,
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

		$zSql .=  " AND (c.sanction='0' || c.sanction='' || c.sanction='00' || c.sanction IS NULL) "  ; 

		if (isset($_POST["iCin"]) && $_POST["iCin"] != "") {
			
			$iCin = $_POST["iCin"] ;  
			$iCin = str_replace(" ","",$iCin);
			$zSql .= " HAVING cin = '" . $iCin . "'" ;
		}

		if ($_iUserEvaluateurId != "")
		{
			$zSql .= " AND user_id NOT IN ($_iUserEvaluateurId) " ;
		}

		//echo $zSql ;

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

		if ($_bHaving == 1){
			$zSql .= " HAVING isNotePeriodeEnCours = 0" ;
		} elseif ($_bHaving == 2){
			$zSql .= " HAVING isNotePeriodeEnCours > 0" ;
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
		
		$zSql= "SELECT user_id, REPLACE(cin,' ','') as cin FROM ".$zDatabaseOrigin.".candidat c ";

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


	
	public function __getUserEvaluateurSendMail(){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= " SELECT user_id,nom,prenom,email,noteEvaluation_dateNotation,noteEvaluation_periodeId,noteEvaluation_anneeNote FROM noteevaluation2
				 INNER JOIN rohi.`candidat` ON noteEvaluation_userSendNoteId = user_id
				 WHERE noteEvaluation_id 
				 IN (
					SELECT MAX(noteEvaluation_id) FROM noteevaluation2 
					INNER JOIN rohi.`candidat` ON noteEvaluation_userSendNoteId = user_id 
					INNER JOIN `usercompte` ON noteEvaluation_userSendNoteId = userCompte_userId AND userCompte_compteId = ".COMPTE_EVALUATEUR."
					GROUP BY noteEvaluation_userSendNoteId
				)
				AND noteEvaluation_periodeId !='5' AND noteEvaluation_anneeNote != '2018'
				AND email != '' ORDER BY nom DESC ";

		$oRow = array();
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;

	}


	public function getUserEvaluateurSendMail(){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		
		/*$zSql= " SELECT user_id,nom,prenom,email,noteEvaluation_dateNotation,noteEvaluation_periodeId,noteEvaluation_anneeNote 
				 FROM ".$zDatabaseGcap.".noteevaluation2
				 INNER JOIN ".$zDatabaseGcap.".usercompte ON noteEvaluation_userSendNoteId = userCompte_userId AND userCompte_compteId = 5
				 INNER JOIN ".$zDatabaseOrigin.".candidat ON noteEvaluation_userSendNoteId = user_id
				 WHERE  email != ''
				 GROUP BY noteEvaluation_userSendNoteId
				 ORDER BY nom DESC 
				 LIMIT 0,10000";*/

		$zSql= "SELECT user_id,nom,prenom,email FROM ".$zDatabaseGcap.".usercompte 
				INNER JOIN ".$zDatabaseOrigin.".candidat ON userCompte_userId = user_id AND userCompte_compteId = ".COMPTE_EVALUATEUR."
				WHERE email != '' 
				ORDER BY nom DESC 
				LIMIT 0,1000000
				" ; 	

		$oRow = array();
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;

	}

	public function UpdateUserCompte($_iUserId,$_iStatut){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		$zDatabaseGcap =  $db['gcap']['database'] ; 

		$zSqlUpdate= " UPDATE usercompte SET userCompte_sendmail = 1,userCompte_statut = ".$_iStatut." WHERE userCompte_userId = ".$_iUserId." AND userCompte_compteId = 5" ; 	

		$DB1->query($zSqlUpdate);
		

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

		$zSql= "SELECT * from gcap.noteevaluation2 WHERE noteevaluation2_notePonctualite ='' ";

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();

		foreach ($toRow as $oRow){

			$oCandidat = $this->Gcap->get_by_user_id($oRow['noteevaluation2_userNoteId']);
			$zInMatriculeUser		  = $this->Transaction->getMatriculeAgent(1, $oRow['noteevaluation2_userNoteId'], $oCandidat);
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

				$zSqlUpdate= "UPDATE gcap.noteevaluation2 SET noteevaluation2_isPointage = 1, noteevaluation2_notePonctualite = '".$iMoyenneUserInfoPointage."' WHERE noteevaluation2_id = " . $oRow['noteevaluation2_id'] ;

				echo $zSqlUpdate . "</br>" ; 
				$this->db->query($zSqlUpdate);
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
		$zQuery = $DB1->get_where('noteevaluation2', array('noteEvaluation_id' => $_iEvaluationId));
		return $zQuery->row_array();
	}


	public function rechercheDoublon($_iUserId = 0, $_this) {
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= " select * from evaluation " ;

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$zReturn = "";
		$iTrouv=0;
		foreach ($toRow as $oRow){
			
			/*if ($iTrouv != 1) {*/
				$tzReturn = $oRow["evaluation_userEvalue"];
				$toReturn = explode("-", $tzReturn);
				
				foreach ($toReturn as $iReturn){
					if ($_iUserId == $iReturn) {
						$oCandidatEvaluateur = $_this->candidat->get_by_user_id($oRow["evaluation_userId"]);
						$zReturn .= $oCandidatEvaluateur[0]->nom . " " . $oCandidatEvaluateur[0]->prenom . " : " . $oRow["evaluation_userId"] .  "<br>\n";
						
						/*$iTrouv  = 1;*/
					}
				}
			/*}*/
			
		}


		$zSql= " SELECT noteEvaluation_userSendNoteId AS evaluateur,noteEvaluation_dateNotation FROM noteevaluation2 WHERE  noteEvaluation_userNoteId IN ($_iUserId) ORDER BY noteEvaluation_dateNotation DESC LIMIT 0,1 " ;

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();

		
		if(sizeof($toRow)>0){
			echo $toRow[0]->evaluateur . "  :   " . $toRow[0]->noteEvaluation_dateNotation;
		}
		
		
		return $zReturn;
	}

	public function getEvaluateurAll(){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zDatabaseRohi =  $db['default']['database'] ; 

		
		$zSql= "SELECT * from $zDatabaseGcap.evaluation ";

		$zQuery = $this->db->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result();
		
		$iIncrement = 0;
		$iTotal = 0;
		foreach ($toRow as $oRow) {

			$toUserId = explode("-", $oRow['evaluation_userEvalue']);

			$toRow[$iIncrement]['evaluation_userEvalueTraitement'] = "";

			if (sizeof($toUserId)>0){

				$toUserIdNonVide = array();
				foreach ($toUserId as $iUserId) {
					if($iUserId !=""){
						array_push($toUserIdNonVide, $iUserId);
					}
				}
				$zUserId = implode(",", $toUserIdNonVide);

				$zImplode = "";
				if ($zUserId != ''){

					$zSql= "SELECT user_id from $zDatabaseRohi.candidat where user_id IN (".$zUserId.") ";

					$zQuery = $DB1->query($zSql);
					$toRowTraitement = $zQuery->result_array();
					$zQuery->free_result();

					
					if (sizeof($toRowTraitement)>0){

						
						$toAssign = array();
						foreach ($toRowTraitement as $oRowTraitement) {
							array_push ($toAssign, $oRowTraitement['user_id']);
							$iTotal++;
							echo $oRowTraitement['user_id'] . "  : --- " . $iTotal . "<br>";
						}

						$zImplode = implode("-",$toAssign);
					}

					
				}

				$toRow[$iIncrement]['evaluation_userEvalueTraitement'] = $zImplode;
				/*$zSqlUpdate= "UPDATE $zDatabaseGcap.evaluation SET evaluation_userEvalue = '".$zImplode."' WHERE evaluation_userId = " . $toRow[$iIncrement]['evaluation_userId'] . " AND evaluation_userAutoriteId = " . $toRow[$iIncrement]['evaluation_userAutoriteId'] ;

				$this->db->query($zSqlUpdate);*/
			}

			$iIncrement++;
		}

		echo $iTotal ; 

		/*echo "<pre>";
		print_r ($toRow);
		echo "</pre>";*/

		return $oRow;

	}


	public function setExcelRapports () {

		$toResult = $this->get_all_note_export(1);
		$toResult3 = $this->get_all_note_export(3);
		$toResult2 = $this->get_all_note_export(2);

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
									 ->setTitle("POINTAGE ELECTRONIQUE")
									 ->setSubject("RAPPORT EXCEL")
									 ->setDescription("RAPPORT EXCEL")
									 ->setKeywords("office PHPExcel php")
									 ->setCategory("RAPPORT EXCEL");

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

		$toCritere = $this->getCritereEtGroup(2) ; 


		$tHead1 = array(						
						'USER_ID'				=> 	'USER_ID',
						'DATE NOTATION'			=> 	'DATE NOTATION', 
						'EVALUATEUR'			=> 	'EVALUATEUR',
						'AGENT'					=> 	'AGENT',
						'MOYENNE NOTE'			=> 	'MOYENNE NOTE',
						'EVALUABLE'				=> 	'EVALUABLE', 
						'PERIODE'				=> 	'PERIODE',
						'ANNEE NOTE'			=> 	'ANNEE NOTE'
					  );

		$toArrayCritere = array();

		foreach ($toCritere as $oCritere) {
			$toArrayCritere[$oCritere['critere_libelle']] = utf8_decode($oCritere['critere_libelle']);
		}

		$tHead1 +=  $toArrayCritere ; 

		$objPHPExcel->getActiveSheet()->mergeCells("A1:M1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:M2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:M3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('RAPPORT NOTE EVALUATION DES AGENTS DE SURFACE'));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:T5')->applyFromArray($default_style_ligne2);
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
		$oSheet = $objPHPExcel->setActiveSheetIndex(0);
		$oSheet->setTitle("Agent de surface");

		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic = 6 ; 
		
		foreach ($toResult2 as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['noteEvaluation_userNoteId']);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, date("d/m/Y", strtotime($oListe['noteEvaluation_dateNotation'])));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nomEvaluateur']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['nomAgent']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, number_format($oListe['fMoyenneNote'], 2, ',', ' '));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['noteEvaluation_evaluable']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['noteEvaluation_periodeId']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['noteEvaluation_anneeNote']);

			$iResultIncrement = 8 ; 
			foreach ($oListe['zCritereAndNote'] as $iCritereResult){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iResultIncrement, $iRowDynamic, $iCritereResult);
				$iResultIncrement++;
			}
			
			$iRowDynamic++;

		}

		$objPHPExcel->createSheet();
		$oSheet = $objPHPExcel->setActiveSheetIndex(1);
		$oSheet->setTitle("Agent Executant");


		$toCritere = $this->getCritereEtGroup(1) ; 


		$tHead1 = array(						
						'USER_ID'				=> 	'USER_ID',
						'DATE NOTATION'			=> 	'DATE NOTATION', 
						'EVALUATEUR'			=> 	'EVALUATEUR',
						'AGENT'					=> 	'AGENT',
						'MOYENNE NOTE'			=> 	'MOYENNE NOTE',
						'EVALUABLE'				=> 	'EVALUABLE', 
						'PERIODE'				=> 	'PERIODE',
						'ANNEE NOTE'			=> 	'ANNEE NOTE'
					  );

		$toArrayCritere = array();

		foreach ($toCritere as $oCritere) {
			$toArrayCritere[$oCritere['critere_libelle']] = utf8_decode($oCritere['critere_libelle']);
		}

		$tHead1 +=  $toArrayCritere ; 

		$objPHPExcel->getActiveSheet()->mergeCells("A1:M1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:M2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:M3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('RAPPORT NOTE EVALUATION DES AGENT EXECUTANTS '));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:V5')->applyFromArray($default_style_ligne2);
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


		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic = 6 ; 
		
		foreach ($toResult as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['noteEvaluation_userNoteId']);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, date("d/m/Y", strtotime($oListe['noteEvaluation_dateNotation'])));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nomEvaluateur']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['nomAgent']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, number_format($oListe['fMoyenneNote'], 2, ',', ' '));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['noteEvaluation_evaluable']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['noteEvaluation_periodeId']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['noteEvaluation_anneeNote']);

			$iResultIncrement = 8 ; 
			foreach ($oListe['zCritereAndNote'] as $iCritereResult){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iResultIncrement, $iRowDynamic, $iCritereResult);
				$iResultIncrement++;
			}
			
			$iRowDynamic++;

		}



		$objPHPExcel->createSheet();
		$oSheet1 = $objPHPExcel->setActiveSheetIndex(2);
		$oSheet1->setTitle("Cadre superieur");


		$toCritere = $this->getCritereEtGroup(3) ; 


		$tHead1 = array(						
						'USER_ID'				=> 	'USER_ID',
						'DATE NOTATION'			=> 	'DATE NOTATION', 
						'EVALUATEUR'			=> 	'EVALUATEUR',
						'AGENT'					=> 	'AGENT',
						'MOYENNE NOTE'			=> 	'MOYENNE NOTE',
						'EVALUABLE'				=> 	'EVALUABLE', 
						'PERIODE'				=> 	'PERIODE',
						'ANNEE NOTE'			=> 	'ANNEE NOTE'
					  );

		$toArrayCritere = array();

		foreach ($toCritere as $oCritere) {
			$toArrayCritere[$oCritere['critere_libelle']] = utf8_decode($oCritere['critere_libelle']);
		}

		$tHead1 +=  $toArrayCritere ; 

		$objPHPExcel->getActiveSheet()->mergeCells("A1:M1");
		$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($default_style_ligne2);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, utf8_encode('REPOBLIKAN\'I MADAGASIKARA'));

		$objPHPExcel->getActiveSheet()->mergeCells("A2:M2");
		$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, utf8_encode('Fitiavana - Tanindrazana - Fandrosoana'));

		$objPHPExcel->getActiveSheet()->mergeCells("A3:M3");
		$objPHPExcel->getActiveSheet()->getStyle('A3:M3')->applyFromArray($default_style);
		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, utf8_encode('RAPPORT NOTE EVALUATION DES CADRES SUPERIEURS '));

		$iRow = 5 ; 
		$iCol = 0;
		foreach ($tHead1 as $zValue) {
			$objPHPExcel->getActiveSheet()->getStyle('A5:X5')->applyFromArray($default_style_ligne2);
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


		setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

		$iRowDynamic = 6 ; 
		

		foreach ($toResult3 as $oListe) {

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $iRowDynamic, $oListe['noteEvaluation_userNoteId']);

			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $iRowDynamic, date("d/m/Y", strtotime($oListe['noteEvaluation_dateNotation'])));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $iRowDynamic, $oListe['nomEvaluateur']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $iRowDynamic, $oListe['nomAgent']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $iRowDynamic, number_format($oListe['fMoyenneNote'], 2, ',', ' '));
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $iRowDynamic, $oListe['noteEvaluation_evaluable']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $iRowDynamic, $oListe['noteEvaluation_periodeId']);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $iRowDynamic, $oListe['noteEvaluation_anneeNote']);

			$iResultIncrement = 8 ; 
			foreach ($oListe['zCritereAndNote'] as $iCritereResult){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($iResultIncrement, $iRowDynamic, $iCritereResult);
				$iResultIncrement++;
			}
			
			$iRowDynamic++;

		}


		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment; filename=rapport_evaluation_".date("YmdHms").".xlsx");
		header("Cache-Control: max-age=0");

		$objWriter->save("php://output");

		exit();
	}

	
}
?>
<?php
class Reclassement_sgrh_model extends CI_Model {

	public function __construct(){
		$this->load->database('reclassement');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('reclassement', TRUE);
		if($DB1->insert('reclassement', $oData)){
			return $DB1->insert_id();
		}else return false;
	}


	public function insertPJ($oData){ 
		$DB1 = $this->load->database('reclassement', TRUE);
		if($DB1->insert('reclasspiecejointe', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertInstitut($oData){
		$DB1 = $this->load->database('reclassement', TRUE);
		if($DB1->insert('institut', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertDiplome($oData){
		$DB1 = $this->load->database('reclassement', TRUE);
		if($DB1->insert('diplome', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertSuiviReclassement($oData){
		$DB1 = $this->load->database('reclassement', TRUE);
		if($DB1->insert('circuitreclassement', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function delete_reclassement($_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->query('delete from reclassement where reclassement_id = '.$_iReclassementId);
	}

	public function update($oData, $_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->update('reclassement', $oData, "reclassement_id = $_iReclassementId");
	}

	public function updatePJ($oData, $_iReclassementId, $_iPieceJointeId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->update('reclasspiecejointe', $oData, "reclassPieceJointe_reclassementId = $_iReclassementId AND reclassPieceJointe_pieceJointeId = $_iPieceJointeId");
	}

	public function deletePJ($_iReclassementId, $_toArray){

		$DB1 = $this->load->database('reclassement', TRUE);
		$zInArray = implode(",",$_toArray);
		$DB1->query('delete from reclasspiecejointe where reclassPieceJointe_reclassementId = '.$_iReclassementId .' AND reclassPieceJointe_pieceJointeId NOT IN ('.$zInArray.')');
	}

	public function updateEncryptReclassement($_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$zSql= "UPDATE reclassement SET reclassement_userId = AES_ENCRYPT(reclassement_userId,'CeNestPasParceQuilYADesDifficultesQueNousNosonsPas') WHERE reclassement_id = ".$_iReclassementId;
		$DB1->query($zSql);
	}

	public function updateEncryptSuiviReclassement($_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$zSql= "UPDATE circuitreclassement SET circuitReclassement_reference = AES_ENCRYPT(circuitReclassement_reference,'CeNestPasParceQuilYADesDifficultesQueNousNosonsPas') WHERE circuitReclassement_reclassementId = ".$_iReclassementId;
		$DB1->query($zSql);
	}


	public function updateSuiviReclassement($oData, $_iReclassementId, $_iSuiviId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->update('circuitreclassement', $oData, "circuitReclassement_reclassementId = $_iReclassementId AND circuitReclassement_suiviId = $_iSuiviId");
	}

	public function deleteSuiviReclassement($_iReclassementId, $_toArray){
		$DB1 = $this->load->database('reclassement', TRUE);
		$zInArray = implode(",",$_toArray);
		$DB1->query('delete from circuitreclassement where circuitReclassement_reclassementId = '.$_iReclassementId .' AND circuitReclassement_suiviId NOT IN ('.$zInArray.')');
	}

	public function deletePJSansArray($_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->query('delete from reclasspiecejointe where reclassPieceJointe_reclassementId = '.$_iReclassementId);
	}

	public function deleteSuiviReclassementSansArray($_iReclassementId){
		$DB1 = $this->load->database('reclassement', TRUE);
		$DB1->query('delete from circuitreclassement where circuitReclassement_reclassementId = '.$_iReclassementId);
	}


	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			
			case COMPTE_EVALUATEUR :
				$zUserId = $_iUserId ; 
				break;

			case COMPTE_RESPONSABLE_PERSONNEL :
			case COMPTE_AUTORITE :

				if ($_oUser['dir'] != 0) {
					
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = ".$_oUser['dir']." " ; 

					if ($iAffiche == 0) {
						$zSql  .= " AND c12.user_id <> $_iUserId  " ;
					}

					if ($_oUser['reg'] != 0){
						$zSql .= " AND c12.region_id = ".$_oUser['reg']; 
					}

				} else {
					
					$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' AND c12.region_id = ".$_oCandidat[0]->region_id." " ;
				}

				if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011') {
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2) " ;
				}

				$zSql  .= " AND (sanction='0' || sanction='' || sanction='00' || sanction IS NULL)  " ;

				//echo $zSql ; 


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


	public function getInfoReclassement($_iUserId,&$iReclassementId,&$_iNbrTotal = 0,$_zDate=''){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		$zDatabaseReclassement =  $db['reclassement']['database'] ; 

		/*$zSql= "select r.*,c.nom,c.prenom,c.user_id,c.matricule,d.libele as departement,di.libele as direction,s.libele as service,i.institut_libelle,dipl.diplome_libelle,
		sigle_departement,sigle_direction,sigle_service,AES_DECRYPT(reclassement_userId,'CeNestPasParceQuilYADesDifficultesQueNousNosonsPas') as zUserId,
		typeReclassement_libelle,(select CONCAT(c1.nom,' ',c1.prenom) from $zDatabaseOrigin.candidat c1 WHERE c1.user_id = reclassement_responsableUserId) responsable
		from $zDatabaseOrigin.candidat c
		INNER JOIN reclassement r ON AES_DECRYPT(reclassement_userId,'CeNestPasParceQuilYADesDifficultesQueNousNosonsPas') = c.user_id
		INNER JOIN $zDatabaseOrigin.departement d ON d.id = r.reclassement_departementId
		INNER JOIN $zDatabaseOrigin.direction di ON di.id = r.reclassement_directionId
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = r.reclassement_serviceId
		INNER JOIN institut i ON i.institut_id = r.reclassement_institutId
		INNER JOIN diplome dipl ON dipl.diplome_id = r.reclassement_diplomeId
		INNER JOIN typereclassement typ ON typ.typeReclassement_id = r.reclassement_typeReclassementId
		INNER JOIN session sess ON sess.session_id = r.reclassement_sessionId WHERE 1=1 "  ; 

		$zSql .= " AND session_annee = ".date('Y')." ";

		$zSql .= " GROUP BY c.user_id " ; 

		if ($_iUserId != -1){
			$zSql .= " HAVING zUserId IN (". $_iUserId .") " ;
		}*/

		$toColumns = array( 
			0 => 'matricule', 
			1 => 'nom',
			2 => 'sigle_departement',
			3 => 'sigle_direction',
			4 => 'sigle_service'
		);

		$oRequest = $_REQUEST;
		
		/*$zSql= "select SQL_CALC_FOUND_ROWS *,r.*,c.nom,c.prenom,c.user_id,c.matricule,d.libele as departement,di.libele as direction,s.libele as service,i.institut_libelle,dipl.diplome_libelle,
		sigle_departement,sigle_direction,sigle_service,i.institut_id,dipl.diplome_id,
		typeReclassement_libelle,(select CONCAT(c1.nom,' ',c1.prenom) from $zDatabaseOrigin.candidat c1 WHERE c1.user_id = reclassement_responsableUserId) responsable
		from $zDatabaseOrigin.candidat c
		INNER JOIN reclassement r ON reclassement_userId = c.user_id
		INNER JOIN $zDatabaseOrigin.departement d ON d.id = r.reclassement_departementId
		INNER JOIN $zDatabaseOrigin.direction di ON di.id = r.reclassement_directionId
		INNER JOIN $zDatabaseOrigin.service s ON s.id = r.reclassement_serviceId
		INNER JOIN institut i ON i.institut_id = r.reclassement_institutId
		INNER JOIN diplome dipl ON dipl.diplome_id = r.reclassement_diplomeId
		INNER JOIN typereclassement typ ON typ.typeReclassement_id = r.reclassement_typeReclassementId
		WHERE 1=1"  ; */

		$zSql = " SELECT SQL_CALC_FOUND_ROWS *,r.*,c.nom,c.prenom,c.user_id,c.matricule,i.*,dipl.*,typ.*,
		(SELECT d.sigle_departement FROM $zDatabaseOrigin.departement d WHERE d.id = c.departement) AS sigle_departement,
		(SELECT di.sigle_direction FROM $zDatabaseOrigin.direction di WHERE di.id = c.direction) AS sigle_direction,
		(SELECT s.sigle_service FROM $zDatabaseOrigin.service s WHERE s.id = c.service) AS sigle_service,
		(SELECT d.libele FROM $zDatabaseOrigin.departement d WHERE d.id = c.departement) AS departement,
		(SELECT di.libele FROM $zDatabaseOrigin.direction di WHERE di.id = c.direction) AS direction,
		(SELECT s.libele FROM $zDatabaseOrigin.service s WHERE s.id = c.service) AS service,
		(SELECT CONCAT(c1.nom,' ',c1.prenom) FROM $zDatabaseOrigin.candidat c1 WHERE c1.user_id = reclassement_responsableUserId) responsable ,
		ifnull((SELECT CONCAT(c2.nom,' ',c2.prenom) FROM $zDatabaseOrigin.candidat c2 WHERE c2.user_id = reclassement_userAutoriteId LIMIT 0,1),'') autorite 
		FROM $zDatabaseReclassement.institut i,diplome dipl,typereclassement typ,reclassement r LEFT JOIN $zDatabaseOrigin.candidat c ON reclassement_userId = c.user_id 
		WHERE i.institut_id = r.reclassement_institutId
		AND dipl.diplome_id = r.reclassement_diplomeId
		AND typ.typeReclassement_id = r.reclassement_typeReclassementId
		" ; 

		if ($_iUserId != -1){
			$zSql .= " AND reclassement_userId IN (". $_iUserId .") " ;
		}

		if( !empty($oRequest['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$zSql.=" AND ( c.nom LIKE '%".$oRequest['search']['value']."%' ";    
			$zSql.=" OR c.prenom LIKE '%".$oRequest['search']['value']."%' ";
			$zSql.=" OR c.matricule LIKE '%".$oRequest['search']['value']."%' )";
		}

		/*if ($_zDate != ""){
			$zSql .= " AND reclassement_session = '".$_zDate."'";
		} else {
			$iDatePlusUn = date('Y')+1;
			$zSql .= " AND reclassement_session IN ('".date('Y')."','".$iDatePlusUn."') ";
		}*/

		if (sizeof($oRequest)>0){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY c.matricule ASC  LIMIT 0,10   ";
		}

		//echo $zSql ; 


		$zQuery = $DB1->query($zSql);
		$toReclassement = $zQuery->result_array();
		$zQuery->free_result(); 


		// nombre des résultats trouvés
		$zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

		$toDataCount = $DB1->query($zQueryDataCount) ;

		$toRow = $toDataCount->result_array();

		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		return $toReclassement;
	}


	public function getPieceJointeReclassement($_iReclassementId, $_zMode="NOT"){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= " SELECT * FROM piecejointe WHERE pieceJointe_id $_zMode IN  (SELECT reclassPieceJointe_pieceJointeId FROM reclasspiecejointe WHERE reclassPieceJointe_reclassementId = ".$_iReclassementId.") ";

		if ($_zMode == "NOT"){
			$zSql .= " AND pieceJointe_id <> 12 " ; 
		}

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		
		return $toRow;
	}

	public function get_encrypt($_zChamp,$_zKey){
		$zSql = "SELECT AES_ENCRYPT('".$_zChamp."','".$_zKey."') as zChamp" ;
		$oQuery = $this->db->query($zSql);
		$oReturn = $oQuery->row_array();
		return $oReturn["zChamp"];
	}


	public function getAllPJReclassement($_iReclassementId){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= " SELECT *,ifnull(reclassPieceJointe_pieceJointeId,'') as reclassPieceJointe_pieceJointeId FROM piecejointe LEFT JOIN reclasspiecejointe ON reclassPieceJointe_pieceJointeId = pieceJointe_id AND reclassPieceJointe_reclassementId = " . $_iReclassementId . " ORDER BY PieceJointe_ordre ASC ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		
		return $toRow;
	}


	public function getAllCircuitDossier($_iReclassementId){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= " SELECT *,ifnull(circuitReclassement_suiviId,'') as circuitReclassement_suiviId,AES_DECRYPT(circuitReclassement_reference,'CeNestPasParceQuilYADesDifficultesQueNousNosonsPas') as circuitReclassement_reference FROM suivi LEFT JOIN circuitreclassement ON circuitReclassement_suiviId = suivi_id AND circuitReclassement_reclassementId = " . $_iReclassementId . " ORDER BY suivi_ordre ASC ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		
		return $toRow;
	}


	public function statistiqueParAnnee(){
		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(reclassement_id) as iNombre,reclassement_session FROM reclassement 
		WHERE 1=1 GROUP BY reclassement_session";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function statistiqueParDepartement($_iAnnee){
		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(reclassement_id) as iNombre,sigle_departement FROM reclassement
		LEFT JOIN $zDatabaseOrigin.departement ON id = reclassement_departementId
		WHERE 1=1 AND reclassement_session = '".$_iAnnee."' GROUP BY reclassement_departementId";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function statistiqueParDirection($_iAnnee){
		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(reclassement_id) as iNombre,sigle_direction FROM reclassement
		LEFT JOIN $zDatabaseOrigin.direction ON id = reclassement_directionId
		WHERE 1=1 AND reclassement_session = '".$_iAnnee."' GROUP BY reclassement_directionId";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function statistiqueParService($_iAnnee){
		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(reclassement_id) as iNombre,sigle_service FROM reclassement
		LEFT JOIN $zDatabaseOrigin.service ON id = reclassement_serviceId
		WHERE 1=1 AND reclassement_session = '".$_iAnnee."' GROUP BY reclassement_serviceId";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow;
	}

	public function getCircuitReclassement($_iReclassementId, $_zMode="NOT"){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= " SELECT suivi_libelle,circuitReclassement_date FROM circuitreclassement INNER JOIN suivi ON circuitReclassement_suiviId = suivi_id 
		WHERE circuitReclassement_reclassementId = ".$_iReclassementId." ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		
		return $toRow;
	}


	public function getDiplome($_iDiplomeId){

		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		
		$zSql= "SELECT * FROM diplome WHERE diplome_id = " . $_iDiplomeId;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function getInstitut($_iInstitutId){

		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);
		
		$zSql= "SELECT * FROM institut WHERE institut_id = " . $_iInstitutId;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function get_all_Table_Reclassement($_zTerm='', $_zType){

		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);	
		
		$zSql= "SELECT * from $_zType ";

		if ($_zTerm != '') {
			$zSql .= " WHERE ".$_zType."_libelle like '%". $_zTerm ."%'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function getUserByMatricule($_zMatricule=""){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "SELECT user_id,departement,direction,service from $zDatabaseOrigin.candidat  ";

		if ($_zMatricule != '') {
			$zSql .= " WHERE matricule = '" . $_zMatricule ."'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function getInstitutId($_zInstitut=""){

		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);	
		$_zInstitut = str_replace("'","\'",$_zInstitut);
		$zSql= "SELECT institut_id from institut WHERE institut_libelle = '". trim($_zInstitut) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 


		$iInstitutId = 0;
		if (sizeof($oRow)>0){
			$iInstitutId = $oRow[0]['institut_id'] ; 

		} else {
			$oDataInstitut = array();
			$oDataInstitut['institut_libelle'] = trim($_zInstitut) ; 
			if($DB1->insert('institut', $oDataInstitut)){
				$iInstitutId = $DB1->insert_id();
			}
		}
		return $iInstitutId;

	}

	public function getDiplomeId($_zDiplome=""){

		global $db;

		$DB1 = $this->load->database('reclassement', TRUE);	
		$_zDiplome = str_replace("'","\'",$_zDiplome);
		$zSql= "SELECT diplome_id from diplome WHERE diplome_libelle = '". trim($_zDiplome) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 


		$iDiplomeId = 0;
		if (sizeof($oRow)>0){
			$iDiplomeId = $oRow[0]['diplome_id'] ; 
		} else {
			$oDataDiplome = array();
			$oDataDiplome['diplome_libelle'] = $_zDiplome ; 
			if($DB1->insert('diplome', $oDataDiplome)){
				$iDiplomeId = $DB1->insert_id();
			}
		}
		return $iDiplomeId;

	}


	
}
?>
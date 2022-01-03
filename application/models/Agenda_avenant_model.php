<?php
class Agenda_avenant_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('evenement', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function delete($_iEvent){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->query('UPDATE evenement SET evenement_delete = 1 WHERE evenement_id = '.$_iEvent);
	}
	
	public function getRestitutionUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "" ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function getAbsenceUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "SELECT * FROM gcap 
				  INNER JOIN typegcap ON gcap_typeGcapId = typeGcap_id 
				  LEFT JOIN motif ON gcap_motif = motif_id	 
				  WHERE gcap_userSendId = '".$_iUserId."' AND gcap_valide = 1
				  AND '". date("Y-m-d")."' BETWEEN gcap_dateDebut AND gcap_dateFin
				  OR gcap_userSendId = '".$_iUserId."' AND gcap_valide = 1 AND  (gcap_dateDebut >= '". date("Y-m-d")."' OR gcap_dateFin >= '". date("Y-m-d")."')" ; 
				  

		$zQuery = $DB1->query($zSql);

		$toAbsenceUser = $zQuery->result_array();

		$toReturn = array();
		foreach ($toAbsenceUser as $oAbsenceUser){
			$oReturn = array();
			$oReturn['evenement_id'] = '' ; 
			$oReturn['evenement_intitule'] = $oAbsenceUser['typeGcap_libelle']; 
			$oReturn['evenement_degre'] = 1 ; 
			$oReturn['evenement_desccription'] = ($oAbsenceUser['motif_libelle']==null)?$oAbsenceUser['gcap_motif']:$oAbsenceUser['motif_libelle'];
			$oReturn['evenement_dateDeb'] = $oAbsenceUser['gcap_dateDebut'];
			$oReturn['evenement_dateFin'] = $oAbsenceUser['gcap_dateFin'];
			$oReturn['evenement_lieu'] = $oAbsenceUser['gcap_lieuJouissance'];
			array_push($toReturn, $oReturn);
		}
		return $toReturn ; 
	}

	public function getOuvertureInscriptonFormationUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "" ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getProcedureAvancementUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "" ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getRenouvellementContratUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "" ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function getEvaluationUser($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = "" ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function getDemandePretLivreUser($_iUserId){

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql  = "SELECT titre_livre,cote_livre,date_retour FROM ".$zDatabaseOrigin.".pret_livre INNER JOIN ".$zDatabaseOrigin.".livre ON livre.id =  pret_livre.livre_id WHERE user_id = '".$_iUserId."'
		AND date_retour >  '". date("Y-m-d")."' "; 		

		$zQuery = $DB1->query($zSql);

		$toPret = $zQuery->result_array();

		$toReturn = array();
		foreach ($toPret as $oPret){
			$oReturn = array();
			$oReturn['evenement_id'] = '' ; 
			$oReturn['evenement_intitule'] = 'Retour Livre'; 
			$oReturn['evenement_degre'] = 2 ; 
			$oReturn['evenement_desccription'] = $oPret['titre_livre'] . " " . $oAbsenceUser['cote_livre'];
			$oReturn['evenement_dateDeb'] = $oPret['date_retour'];
			$oReturn['evenement_image'] = '';
			$oReturn['evenement_lieu'] = 'DRHA/SAD porte 257';
			array_push($toReturn, $oReturn);
		}
		return $toReturn ; 
	}

	public function geTypeEvenement(){

		$DB1 = $this->load->database('gcap', TRUE);
		$zSql  = " Select * from typeevenement " ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function anniversaire($_iUserId){

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql  = " SELECT date_naiss,lacalite_service FROM ".$zDatabaseOrigin.".candidat WHERE MONTH(date_naiss) = MONTH(CURRENT_DATE) AND DAY(date_naiss) = DAY(CURRENT_DATE) 
		AND user_id = " . $_iUserId ; 		

		$zQuery = $DB1->query($zSql);
		$toAnniversaire = $zQuery->result_array();

		$toReturn = array();
		foreach ($toAnniversaire as $oAnniversaire){
			$oReturn = array();
			$oReturn['evenement_id'] = '' ; 
			$oReturn['evenement_intitule'] = 'Joyeux anniversaire'; 
			$oReturn['evenement_degre'] = 2 ; 
			$oReturn['evenement_desccription'] = '';
			$oReturn['evenement_dateDeb'] = $oAnniversaire['date_naiss'];
			$oReturn['evenement_dateFin'] = '';
			$oReturn['evenement_image'] = '<img src="'.base_url().'assets/accueil/ks7yexi9.gif" height="50" width="50">';
			$oReturn['evenement_lieu'] = $oAnniversaire['lacalite_service'];
			array_push($toReturn, $oReturn);
		}
		return $toReturn ; 
	}

	public function NotificationGestock($_iUserId){

		global $db;
		
		$oNotification = array();
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseGstock =  $db['gestock']['database'] ;

		$toMoisArray = array('03','06','09','11','12');


		if (in_array(date("m"), $toMoisArray)){

			$zSql  = " SELECT * FROM ".$zDatabaseGcap.".usercompte 
			
			INNER JOIN ".$zDatabaseGstock.".gestock_notification ON userCompte_userId = notification_userId
			WHERE userCompte_userId = " . $_iUserId . " AND userCompte_compteId = " . COMPTE_GESTIONNAIRE_STOCK . " AND notification_mois = '".date("m")."' AND notification_annee = '".date("Y")."'" ; 

			$zQuery = $this->db->query($zSql);
			$oNotification = $zQuery->result_array();
		}
		
		return $oNotification;
	}

	public function NotificationGestock2($_iUserId){

		global $db;
		
		$oNotification = array();
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseGstock =  $db['gestock']['database'] ;

		$zSql  = " SELECT * FROM ".$zDatabaseGcap.".usercompte INNER JOIN ".$zDatabaseGstock.".gestock_notification ON userCompte_userId = notification_userId  
		WHERE userCompte_userId = " . $_iUserId . " AND userCompte_compteId = " . COMPTE_GESTIONNAIRE_STOCK . " 
		AND (notification_dateRappel1 = '".date("Y-m-d")."' OR notification_dateRappel2 = '".date("Y-m-d")."')" ; 

		//echo $zSql ; 

		$zQuery = $this->db->query($zSql);
		$oNotification = $zQuery->result_array();
		
		return $oNotification;
	}

	public function NotificationPv($_iUserId){

		global $db;
		
		$iTestPv = 0;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zDatabaseGstock =  $db['gestock']['database'] ;

		$toMoisArray = array('03','06','09','11','12');


		if (in_array(date("m"), $toMoisArray)){

			$zSql  = " SELECT * FROM ".$zDatabaseGcap.".usercompte WHERE userCompte_userId = " . $_iUserId . " AND userCompte_compteId = " . COMPTE_GESTIONNAIRE_STOCK . "" ; 
			$zQuery = $this->db->query($zSql);
			if (sizeof($zQuery->result_array()) > 0){
				$iTestPv = 1;
				$zSql  = " SELECT * FROM ".$zDatabaseGstock.".gestock_pv WHERE DATE_FORMAT(pv_date,'%m/%Y') =  '" . date("m/Y") . "' " ; 
				$zQuery = $this->db->query($zSql);
				if(sizeof($zQuery->result_array())>0){
					$iTestPv = 2;
				} 
			}
		}
		
		return $iTestPv;
	}


	public function gestock(){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ; 
 
		$toReturn = array();
		$oReturn = array();
		$oReturn['evenement_id'] = '' ; 
		$oReturn['evenement_intitule'] = 'Gestion de stock'; 
		$oReturn['evenement_degre'] = 2 ; 
		$oReturn['evenement_desccription'] = 'Il est temps d\'effectuer un inventaire physique. Voulez vous le faire maintenant?';
		$oReturn['evenement_dateDeb'] = date("Y-m-d") ;
		$oReturn['evenement_dateFin'] = date("Y-m-d");
		$oReturn['evenement_image'] = '';
		$oReturn['evenement_lieu'] = '356';
		array_push($toReturn, $oReturn);

		return $toReturn ; 
	}



	public function reclassement($_iUserId,$iFlag=0){

		global $db;
		$zDatabaseReclassement =  $db['reclassement']['database'] ; 

		$zSql  = " SELECT * FROM ".$zDatabaseReclassement.".reclassement INNER JOIN ".$zDatabaseReclassement.".circuitreclassement ON circuitReclassement_reclassementId = reclassement_id 
		INNER JOIN ".$zDatabaseReclassement.".suivi ON circuitReclassement_suiviId = suivi_id 
		WHERE reclassement_userId = " . $_iUserId . " AND circuitReclassement_date <> '' ORDER BY circuitReclassement_date DESC LIMIT 0,1" ; 	

		$zQuery = $this->db->query($zSql);
		$toReclassement = $zQuery->result_array();

		$toReturn = array();

		if (sizeof($toReclassement)>0){
			foreach ($toReclassement as $oReclassement){
				$oReturn = array();
				$oReturn['evenement_id'] = '' ; 
				$oReturn['evenement_intitule'] = 'Reclassement'; 
				$oReturn['evenement_degre'] = 2 ; 
				$oReturn['evenement_desccription'] = $oReclassement['suivi_libelle'];
				if ($oReclassement['circuitReclassement_date']!=''){
					$oReturn['evenement_dateDeb'] = $oReclassement['circuitReclassement_date'];
				} else {
					$oReturn['evenement_dateDeb'] = $oReclassement['reclassement_dateArrivee'];
				}
				$oReturn['evenement_dateFin'] = '';
				$oReturn['evenement_image'] = '';
				$oReturn['evenement_lieu'] = 'DRHA/SGRH porte 351';
				array_push($toReturn, $oReturn);
			}
		} else {
			$iReclassementId = 0;
			$oInfoReclassement = $this->getInfoReclassement($_iUserId, $iReclassementId) ; 
			$oPiecesJointesManquante = $this->getPieceJointeReclassement($iReclassementId);

			if (sizeof($oPiecesJointesManquante)>0 && sizeof($oInfoReclassement)>0){
				$oReturn = array();
				$oReturn['evenement_id'] = '' ; 
				$oReturn['evenement_intitule'] = 'Reclassement'; 
				$oReturn['evenement_degre'] = 2 ; 
				$oReturn['evenement_desccription'] = "Dossier incomplet";
				$oReturn['evenement_dateDeb'] = $oInfoReclassement[0]['reclassement_dateArrivee'];
				$oReturn['evenement_dateFin'] = '';
				$oReturn['evenement_image'] = '';
				$oReturn['evenement_lieu'] = 'DRHA/SGRH porte 351';
				array_push($toReturn, $oReturn);
			}

		}
		if ($iFlag == 0) {
			return $toReturn ; 
		} else {

			if (sizeof($toReclassement)>0){
				return $toReclassement ; 
			}

			$toReturnIncomplet = array();
			if (sizeof($oPiecesJointesManquante)>0 && sizeof($oInfoReclassement)>0){
				$oReturn = array();
				$oReturn['suivi_libelle'] = "Dossier incomplet" ; 
				$oReturn['circuitReclassement_date'] = $oInfoReclassement[0]['reclassement_dateArrivee'] ; 
				array_push($toReturnIncomplet, $oReturn);
				return $toReturnIncomplet ; 
			}
		}
		
	}


	public function getPieceJointeReclassement($_iReclassementId, $_zMode="NOT"){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= " SELECT * FROM piecejointe WHERE pieceJointe_id $_zMode IN  (SELECT reclassPieceJointe_pieceJointeId FROM reclasspiecejointe WHERE reclassPieceJointe_reclassementId = ".$_iReclassementId.")";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result();
		$zQuery->free_result(); 

		
		return $toRow;
	}


	public function getInfoReclassement($_iUserId,&$iReclassementId,&$_iNbrTotal = 0,$_zDate=''){
		
		global $db;
		$DB1 = $this->load->database('reclassement', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

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
		(SELECT d.sigle_departement FROM rohi.departement d WHERE d.id = c.departement) AS sigle_departement,
		(SELECT di.sigle_direction FROM rohi.direction di WHERE di.id = c.direction) AS sigle_direction,
		(SELECT s.sigle_service FROM rohi.service s WHERE s.id = c.service) AS sigle_service,
		(SELECT d.libele FROM rohi.departement d WHERE d.id = c.departement) AS departement,
		(SELECT di.libele FROM rohi.direction di WHERE di.id = c.direction) AS direction,
		(SELECT s.libele FROM rohi.service s WHERE s.id = c.service) AS service,
		(SELECT CONCAT(c1.nom,' ',c1.prenom) FROM rohi.candidat c1 WHERE c1.user_id = reclassement_responsableUserId) responsable ,
		ifnull((SELECT CONCAT(c2.nom,' ',c2.prenom) FROM rohi.candidat c2 WHERE c2.user_id = reclassement_userAutoriteId),'') autorite 
		FROM reclassement.institut i,reclassement.diplome dipl,reclassement.typereclassement typ,reclassement.reclassement r LEFT JOIN rohi.candidat c ON reclassement_userId = c.user_id 
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

		if ($_zDate != ""){
			$zSql .= " AND reclassement_session = '".$_zDate."'";
		} else {
			$iDatePlusUn = date('Y')+1;
			$zSql .= " AND reclassement_session IN ('".date('Y')."','".$iDatePlusUn."') ";
		}

		if (sizeof($oRequest)>0 && isset($oRequest['order'])){
			
			if (isset($toColumns[$oRequest['order'][0]['column']]) && isset($oRequest['order'][0]['dir'])){
				$zSql.=" ORDER BY ". $toColumns[$oRequest['order'][0]['column']]."   ".$oRequest['order'][0]['dir']."    ";
			}

			if (isset($oRequest['start']) && isset($oRequest['order'][0]['dir'])){
				$zSql.= "  LIMIT ".$oRequest['start']." ,".$oRequest['length']." ";
			}
		} else {
			$zSql.=" ORDER BY c.matricule ASC  LIMIT 0,10   ";
		}

		/*$zQuery = $DB1->query($zSql);
		$toReclassement = $zQuery->result_array();
		$zQuery->free_result(); 

        $zQueryDataCount = "SELECT FOUND_ROWS() AS iNumRows" ;

        $toDataCount = $DB1->query($zQueryDataCount) ;

        $toRow = $toDataCount->result_array();
		
		if(sizeof($toRow)>0){
			$_iNbrTotal = $toRow[0]['iNumRows'] ;
		}

		foreach ($toReclassement as $oRow){
			$iReclassementId = $oRow['reclassement_id'] ; 
		}

		return $toReclassement;*/
	}



	public function geAllEvenement($_iUserId){

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql  = " Select *,(SELECT DATEDIFF( evenement_dateDeb, CURDATE() )) AS delai,'' as evenement_image, evenement_dateFin as dateFin from evenement 
		where evenement_userId =  "  . $_iUserId . " AND evenement_delete = 0 " ; 

		$zSql  .= " AND (evenement_dateDeb >= '". date("Y-m-d")."'"  ; 
		$zSql  .= " OR '". date("Y-m-d")."' <=  evenement_dateFin) "  ; 
		$zSql  .= " ORDER BY evenement_dateDeb ASC,evenement_degre DESC"; 	
		$zQuery = $DB1->query($zSql);
		$toEvent =  $zQuery->result_array();

		//print_r ($toEvent);
		$toReclassement = $this->reclassement($_iUserId) ; 
		$toAnniversaire = $this->anniversaire($_iUserId) ; 
		$toAbsence = $this->getAbsenceUser($_iUserId) ; 
		$toPret = $this->getDemandePretLivreUser($_iUserId) ; 
		//$toGestock = $this->gestock();

		//print_r ($toGestock);
		

		$toReturn = array();

		$toReturn = array_merge($toReclassement, $toAnniversaire) ; 
		$toReturn = array_merge($toReturn, $toAbsence) ; 
		$toReturn = array_merge($toReturn, $toPret) ; 
		$toReturn = array_merge($toReturn, $toEvent) ; 
		//$toReturn = array_merge($toReturn, $toGestock) ; 

		return $toReturn;
	}
	
}
?>
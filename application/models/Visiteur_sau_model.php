<?php
class Visiteur_sau_model extends CI_Model {

	public function __construct(){
		$this->load->database('sau');
	}
	
	public function updateAllVisite($oData){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('visite', $oData, "visite_id < 94523 AND visite_heureSortie IS NULL");
	}
	
	public function insertVisiteur($oData){
		$DB1 = $this->load->database('sau', TRUE);
		if($DB1->insert('visiteur', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertVisite($oData){
		$DB1 = $this->load->database('sau', TRUE);
		if($DB1->insert('visite', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertPorte($oData){
		$DB1 = $this->load->database('sau', TRUE);
		if($DB1->insert('porte', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertBadge($oData){
		$DB1 = $this->load->database('sau', TRUE);
		if($DB1->insert('badge', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateBadge($oData, $_iBadgeId){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('badge', $oData, "badge_id = $_iBadgeId");
	}

	public function insertAttribution($oData){
		$DB1 = $this->load->database('sau', TRUE);
		if($DB1->insert('attribution', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function update($oData, $_iVisiteurId){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('visiteur', $oData, "visiteur_id = $_iVisiteurId");
	}

	public function updateVisite($oData, $_iVisitId){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('visite', $oData, "visite_id = $_iVisitId");
	}

	public function updateAttribution($oData, $_iAttributionId){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('attribution', $oData, "attribution_id = $_iAttributionId");
	}

	public function updateVisiteurs($oData, $_iVisiteurId){
		$DB1 = $this->load->database('sau', TRUE);
		$DB1->update('visiteur', $oData, "visiteur_id = $_iVisiteurId");
		
	}


	public function get_all_list_candidat2($_oUser,$_oCandidat,$_iUserId, $_iCompteActif,$zTerm= "aa",$_iFiltre=0){
		
		global $db;
		$DB1 = $this->load->database('gcap', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		$zSql= "select candidat.nom,candidat.prenom,candidat.user_id,candidat.id,candidat.type_photo from $zDatabaseOrigin.candidat WHERE (matricule = '$zTerm' OR REPLACE(cin,' ','') = '$zTerm')";


		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}
	
	public function check_if_exist_badge_attribution($_iUserId){
		global $db;
		$DB1 = $this->load->database('sau', TRUE);
		$zSql="select * from attribution WHERE attribution_userId = $_iUserId AND attribution_heureSortie IS NULL";
		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		if(sizeof($oRow) > 0) return true;
		else return false;
	}


	public function getBadgeUser($_iUserId){

		global $db;
		$DB1 = $this->load->database('sau', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;
		
		/*$zSql= "select candidat.nom,candidat.prenom,candidat.user_id,badge_nom,attribution_dateSortie,attribution_heureSortie,attribution_id from $zDatabaseOrigin.candidat
		INNER JOIN attribution ON attribution_userId = candidat.user_id
		INNER JOIN badge ON badge_id = attribution_numBadgeId
		WHERE candidat.user_id = "._iUserId." ";*/


		/*$zSql= "select candidat.matricule,candidat.nom,candidat.prenom,candidat.user_id,
		badge_nom,attribution_dateSortie,attribution_dateEntree,attribution_heureEntree,attribution_heureSortie,attribution_id,
		(SELECT B.prenom from $zDatabaseOrigin.candidat B WHERE attribution_userSortieId IS NOT NULL AND B.user_id = attribution_userSortieId) as zPrenomSortie,  
		(SELECT A.prenom from $zDatabaseOrigin.candidat A WHERE A.user_id = attribution_userSaisieId) as zPrenomSaisie  
		from attribution
		LEFT JOIN $zDatabaseOrigin.candidat  ON candidat.user_id = attribution_userId 
		INNER JOIN badge ON badge_id = attribution_numBadgeId
		WHERE 1 ORDER BY attribution_dateSortie ASC,attribution_dateEntree DESC,attribution_heureEntree DESC  ";*/

		$zSql= "SELECT  candidat.matricule,
						candidat.nom,
						candidat.prenom,
						candidat.user_id,
						badge_nom,
						attribution_dateSortie,
						attribution_dateEntree,
						attribution_heureEntree,
						attribution_heureSortie,
						attribution_id,
						(SELECT B.prenom from $zDatabaseOrigin.candidat B WHERE attribution_userSortieId IS NOT NULL AND B.user_id = attribution_userSortieId) as zPrenomSortie,  
						(SELECT A.prenom from $zDatabaseOrigin.candidat A WHERE A.user_id = attribution_userSaisieId) as zPrenomSaisie  
					from attribution
					LEFT JOIN rohi.candidat  ON candidat.user_id = attribution_userId 
					INNER JOIN badge ON badge_id = attribution_numBadgeId
					WHERE year(attribution_dateEntree)=year(now())
					AND month(attribution_dateEntree) >MONTH(NOW())-6
					AND badge_posteId = " . $_SESSION["session_PosteSAU"]."
					ORDER BY attribution_dateSortie ASC,
							 attribution_dateEntree DESC,
							 attribution_heureEntree DESC ";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}
	
	public function get_all_visiteur($_zDateDebut='', $_zDateFin='',$_iTest=1){

		global $db;
		$DB1 = $this->load->database('sau', TRUE);

		$zDatabaseOrigin =  $db['default']['database'] ;

		$zSql= " SELECT visite_id,visite_date,visite_dateSortie,visite_heureEntree,visite_heureSortie,
				(SELECT badge_nom FROM badge WHERE badge_id = visite_badgeId LIMIT 0,1) AS badge_nom,
				(SELECT porte_nom FROM porte WHERE porte_id = visite_porteId LIMIT 0,1) AS porte_nom,
				(SELECT prenom FROM $zDatabaseOrigin.user WHERE id = visite_userSaisieId  LIMIT 0,1) AS zPrenom,
				(SELECT prenom FROM $zDatabaseOrigin.user WHERE id = visite_userSaisieSortieId  LIMIT 0,1) AS prenom,
				(SELECT visiteur_nom FROM visiteur WHERE visiteur_id = visite_visiteurId  LIMIT 0,1) AS visiteur_nom,
				(SELECT visiteur_prenom FROM visiteur WHERE visiteur_id = visite_visiteurId  LIMIT 0,1) AS visiteur_prenom,
				(SELECT visite_heureSortie FROM visiteur WHERE visiteur_id = visite_visiteurId  LIMIT 0,1) AS sortie
				FROM visite " ;
		

		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " WHERE visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " WHERE visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."'" ; 
			}
		} else {
			$zSql .= " WHERE (visite_dateSortie IS NULL || visite_date = '".date("Y-m-d")."') " ; 
		}
			
		$zSql .= "AND  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ; 

		$zSql .= "  GROUP BY visite_id " ;
		$zSql .= " ORDER BY visite_date DESC,visite_heureEntree DESC  ";

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}
	

	public function ___get_all_visiteur($_zDateDebut='', $_zDateFin='',$_iTest=1){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		/*$zSql= "SELECT *, IFNULL(visite_heureSortie,'') as sortie  from visite 
		INNER JOIN visiteur ON visite_visiteurId = visiteur_id
		INNER JOIN badge ON visite_badgeId = badge_id
		INNER JOIN porte ON visite_porteId = porte_id
		INNER JOIN poste ON visite_posteId = poste_id " ;
		if($_iTest == 1 || $_iTest == 3) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user ON id = visite_userSaisieId " ; 
		} else if ($_iTest == 2) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user ON id = visite_userSaisieSortieId " ; 
		}*/
		/*
		$zSql= "SELECT *, userA.prenom as zPrenom, IFNULL(visite_heureSortie,'') as sortie  from visite 
		INNER JOIN visiteur ON visite_visiteurId = visiteur_id
		INNER JOIN badge ON visite_badgeId = badge_id
		INNER JOIN porte ON visite_porteId = porte_id
		INNER JOIN poste ON visite_posteId = poste_id " ;
		if($_iTest == 1 || $_iTest == 3) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userA ON userA.id = visite_userSaisieId " ; 
		} else if ($_iTest == 2) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userA ON userA.id = visite_userSaisieSortieId " ; 
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userB ON userB.id = visite_userSaisieId " ; 
		}

		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " WHERE visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " WHERE visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."'" ; 
			}
		} else {
			$zSql .= " WHERE (visite_dateSortie IS NULL || visite_date = '".date("Y-m-d")."') " ; 
		}
			
		$zSql .= "AND  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ; 

		$zSql .= "  GROUP BY visite_id " ;

		if($_iTest == 1) {
			$zSql .= " HAVING sortie = '' " ; 
		} else if ($_iTest == 2) {
			$zSql .= " HAVING sortie <> '' " ; 
		}

		$zSql .= " ORDER BY visite_badgeId ASC ";*/
		
		$zSql= "SELECT visiteur_nom,visiteur_prenom,badge_nom,porte_nom,visite_id,visite_date,visite_dateSortie,visite_heureEntree,visite_heureSortie, userA.prenom as zPrenom  ";
		if($_iTest==2) $zSql .=" ,userB.prenom ";
		$zSql .="  from visite
		INNER JOIN poste ON visite_posteId = poste_id 
		INNER JOIN badge ON visite_badgeId = badge_id 
		INNER JOIN porte ON visite_porteId = porte_id 
		INNER JOIN visiteur ON visite_visiteurId = visiteur_id " ;
		
		if($_iTest == 1 || $_iTest == 3) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userA ON userA.id = visite_userSaisieId " ; 
		} else if ($_iTest == 2) {
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userA ON userA.id = visite_userSaisieSortieId " ; 
			$zSql .= " LEFT JOIN $zDatabaseOrigin.user userB ON userB.id = visite_userSaisieId " ; 
		}
		
		$zSql .= " WHERE  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ; 
		
		if($_iTest == 1) {
			$zSql .= " AND visite_heureSortie IS NULL " ; 
		} else if ($_iTest == 2) {
			$zSql .= " AND visite_heureSortie IS NOT NULL " ; 
		}
		
		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " AND visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " AND visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."' " ; 
			}
		} else {
			$zSql .= " AND (visite_dateSortie IS NULL || visite_date = '".date("Y-m-d")."') " ; 
		}

		//$zSql .= "  GROUP BY visite_id " ;


		$zSql .= " ORDER BY visite_badgeId ASC ";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function countAll($_zDateDebut='', $_zDateFin=''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		
		$zSql= "SELECT count(*) as iNb FROM visite ";
		
		$zSql .= " WHERE  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ; 
		
		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " AND visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " AND visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."' " ; 
			}
		} else {
			$zSql .= " AND (visite_dateSortie IS NULL || visite_date = '".date("Y-m-d")."') " ; 
		}

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iNombre = 0;

		foreach ($toRow as $oRow){
			$iNombre = $oRow["iNb"];
		}

		return $iNombre;

	}


	public function get_all_poste($_iUserId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		
		$zSql= "SELECT * FROM userposte INNER JOIN poste ON poste_id = userposte_posteId WHERE userposte_userId = $_iUserId";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}
	
	public function get_all_poste_ancien(){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		
		$zSql= "SELECT * FROM poste";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function getPoste($_iPosteId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		
		$zSql= "SELECT * FROM poste WHERE poste_id = " . $_iPosteId;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function getBadge($_iBadgeId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		
		$zSql= "SELECT * FROM badge WHERE badge_id = " . $_iBadgeId . " AND badge_actif = 1";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function getVisiteAllDateAndBadge($_iBadgeId=0, $_zDateDebut='', $_zDateFin=''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT visite_heureSortie, CONCAT(visiteur_nom,' ',visiteur_prenom) as nomVisiteur FROM visite INNER JOIN visiteur ON visite_visiteurId = visiteur_id WHERE 1=1 " ;


		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " AND visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " AND visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."'" ; 
			}
		} else {
			$zSql .= " AND visite_date = '".date("Y-m-d")."' " ; 
		}

		$zSql .= " AND visite_badgeId =  " . $_iBadgeId; 
		$zSql .= " GROUP BY visite_userSaisieId";
		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toRow ; 
	}




	public function statistiqueCirculaire($_zDateDebut='', $_zDateFin=''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(visite_id) as iVisitId,(SELECT u.prenom FROM $zDatabaseOrigin.user u where u.id = visite_userSaisieId) as visiteSaisie 
		
		FROM visite
		WHERE 1=1 AND  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ;


		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " AND visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " AND visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."'" ; 
			}
		} else {
			$zSql .= " AND visite_date = '".date("Y-m-d")."' " ; 
		}

		$zSql .= "GROUP BY visite_userSaisieId";

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$toRowAffiche = array();
		$tzColor = array ("#68BC31","#2091CF","#AF4E96", "#DA5430", "#FEE074", "#68BC31","#2091CF","#AF4E96", "#DA5430", "#FEE074", "#68BC31","#2091CF","#AF4E96", "#DA5430", "#FEE074");
		$iIncrement = 0;
		foreach ($toRow as $oRow){
			
			$oRowAssign = array();
			$oRowAssign['iVisitId']		= $oRow['iVisitId'] ; 
			$oRowAssign['visiteSaisie'] = ucwords(strtolower($oRow['visiteSaisie'])) ; 
			$oRowAssign['zColor']		= $tzColor[$iIncrement] ; 
			
			array_push($toRowAffiche, $oRowAssign) ; 
			$iIncrement++;
		}

		return $toRowAffiche;
	}

	public function statistiqueVisite(){
		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(visite_id) as iVisitId,visite_date FROM visite 
		WHERE 1=1 AND  visite_posteId = '".$_SESSION["session_PosteSAU"]."' 
		AND visite_date like '%" .date('Y-m') . "%'
		GROUP BY visite_date";

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$toRowAffiche = array();
		
		$iIncrement = 0;
		foreach ($toRow as $oRow){
			
			$oRowAssign = array();
			$toDate = explode("-", $oRow['visite_date']); 
			
			$oRowAssign['iVisitId']		= $oRow['iVisitId']; 
			$oRowAssign['visiteDate']	= $toDate[0] ; 
			$oRowAssign['visiteMois']	= (int)$toDate[1]-1 ; 
			$oRowAssign['visiteJour']	= $toDate[2] ; 
			
			array_push($toRowAffiche, $oRowAssign) ; 
			$iIncrement++;
		}


		return $toRowAffiche;
	}


	public function statistiqueLocalite($_zDateDebut='', $_zDateFin='',$_iGrouBy=1){
		global $db;

		$DB1 = $this->load->database('sau', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 
		
		$zSql= "SELECT COUNT(visite_id) as iVisitId,visite_date,d.sigle_departement as departement,di.sigle_direction as direction,s.sigle_service as service FROM visite 
		INNER JOIN porte ON visite_porteId = porte_id
		LEFT JOIN $zDatabaseOrigin.departement d ON d.id = porte_departementId
		LEFT JOIN $zDatabaseOrigin.direction di ON di.id = porte_directionId
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = porte_serviceId
		
		WHERE 1=1 AND  visite_posteId = '".$_SESSION["session_PosteSAU"]."' " ; 
		

		if ($_zDateDebut != '' && $_zDateFin != '') {
			if ($_zDateDebut == $_zDateFin){
				$zSql .= " AND visite_date = '".$_zDateDebut."' " ; 
			} else {
				$zSql .= " AND visite_date BETWEEN '".$_zDateDebut."' AND '".$_zDateFin."'" ; 
			}
		} else {
			$zSql .= " AND visite_date = '".date('Y-m-d')."' " ; 
		}


		if ($_iGrouBy == 1) {
			$zSql .= " GROUP BY porte_departementId ";
		} elseif ($_iGrouBy == 2) {
			$zSql .= " GROUP BY porte_directionId ";
		} else {
			$zSql .= " GROUP BY porte_serviceId ";
		}

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$toRowAffiche = array();
		
		$iIncrement = 0;

		return $toRow;
	}


	public function get_all_ListeNoirs(){
		global $db;
		$DB1				= $this->load->database('sau', TRUE);
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zSql				= "SELECT * from visiteur WHERE visiteur_listeNoire = 1 ";

		$zQuery				= $DB1->query($zSql);
		$oRow				= $zQuery->result_array();
		$zQuery->free_result(); 
		return $oRow;
	}

	public function get_all_list_visiteur($zTerm= "aa", $_iRechercheId = 1){
		
		global $db;

		$zDatabaseSau =  $db['sau']['database'] ;
		
		$zSql= "select * from $zDatabaseSau.visiteur WHERE 1 " ; 
		

		switch ($_iRechercheId){

			case '1':
				$zSql .= " AND (visiteur_nom LIKE '%$zTerm%' OR visiteur_prenom LIKE '%$zTerm%')";
				break;

			case '2':
				$zSql .= " AND visiteur_cin LIKE '%$zTerm%'";
				break;

			case '3':
				$zSql .= " AND visiteur_permis LIKE '%$zTerm%'";
				break;

			case '4':
				$zSql .= " AND visiteur_autreValue LIKE '%$zTerm%'";
				break;
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}

	public function getVisteurId($_iVisiteurId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from visiteur where visiteur_id = " . $_iVisiteurId;

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;
	}

	public function getVisteurByCin($_iCinVisiteur){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT *,REPLACE(visiteur_cin,' ','') AS visiteur_cin_trim FROM visiteur HAVING visiteur_cin_trim = '" . $_iCinVisiteur . "'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;
	}


	public function listeDesBadgesVisiteursEtProvisoires(){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from badge ";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;
	}


	public function getBadgeAttributionId($_iUserId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);	
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zSql= "SELECT * from attribution INNER JOIN  $zDatabaseOrigin.candidat c ON user_id = attribution_userId WHERE attribution_userId = " . $_iUserId . "
		AND attribution_dateSortie IS NULL";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();

		return $oRow;

	}

	public function import(){

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zDatabaseVisiteur	=  $db['sau']['database'] ; 
		
		$zSql= "SELECT ID_visiteur,Nom,Prenoms,REPLACE(cin,' ','') AS cinNew,cin FROM g_visiteur.visiteur WHERE CIN <> '' 
		AND ID_visiteur NOT IN ( SELECT visiteur_originalId FROM visiteurs.visiteur)
		GROUP BY CIN  ORDER BY cin ASC ";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		foreach ($toRow as $oRow){

			$oDataVisiteurNew = array();
			$oDataVisiteurNew["visiteur_userSendId"] = 9961 ; 
			if (strlen($oRow['cinNew']) == 11 || strlen($oRow['cinNew']) == 12) {
				$oDataVisiteurNew["visiteur_cin"]		= $oRow['cinNew'] ; 
			} else {
				$oDataVisiteurNew["visiteur_permis"]	= $oRow['cinNew'] ; 
			}

			$oDataVisiteurNew["visiteur_nom"]				= $oRow['Nom'] ; 
			$oDataVisiteurNew["visiteur_prenom"]			= $oRow['Prenoms'] ; 
			$oDataVisiteurNew["visiteur_posteId"]			= 1 ; 
			$oDataVisiteurNew["visiteur_originalId"]		= $oRow['ID_visiteur'] ; 
			

			$iVisiteurId = $this->Visiteur->insertVisiteur($oDataVisiteurNew);
		}

		return $toRow;

	}

	public function importPorte(){

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zDatabaseVisiteur	=  $db['sau']['database'] ; 
		
		$zSql= "SELECT p.*,CONCAT(Porte_ID,' (',IFNULL(s.libele,di.libele),')') AS Porte_ID,IFNULL(d.id,'') AS departement_id,IFNULL(di.id,'') AS direction_id,IFNULL(s.id,'') AS 			service_id FROM g_visiteur.porte AS p
				LEFT JOIN rohi_1411.departement AS d ON p.Departement = d.sigle_departement
				LEFT JOIN rohi_1411.direction AS di ON p.Direction = di.sigle_direction
				LEFT JOIN rohi_1411.service AS s ON p.Service = s.sigle_service
				GROUP BY p.Porte_ID
				ORDER BY p.Porte_ID ASC";

		$zQuery = $DB1->query($zSql);
		$toRow = $zQuery->result_array();
		$zQuery->free_result(); 

		foreach ($toRow as $oRow){

			$oDataPorte = array();
			$oDataPorte["porte_nom"]				= $oRow['Porte_ID'] ; 
			$oDataPorte["porte_departementId"]		= $oRow['departement_id'] ; 
			$oDataPorte["porte_directionId"]		= $oRow['direction_id'] ; 
			$oDataPorte["porte_serviceId"]			= $oRow['service_id'] ; 

			$this->Visiteur->insertPorte($oDataPorte);
		}

		return $toRow;

	}

	public function getBadgeAttributionLastId($_iAttributionId){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from attribution WHERE attribution_id = " . $_iAttributionId . "";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result();

		return $oRow;

	}

	public function get_all_porte($_zTerm=''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from porte ";
		$zSql .= " WHERE porte_posteId = " . $_SESSION["session_PosteSAU"] . " ";
		if ($_zTerm != '') {
			$zSql .= " AND porte_nom like '%". $_zTerm ."%'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function get_all_badge($_iBadgeId = 0){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from badge ";

		if ($_iBadgeId != 0) {
			$zSql .= " WHERE badge_id = " . $_iBadgeId ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function get_all_badgeDispo(){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from badge WHERE 1 ";
		//$zSql .= " WHERE badge_id IN (SELECT attribution_numBadgeId FROM attribution WHERE attribution_dateSortie IS NOT NULL)" ; 

		$zSql .= " AND NOT EXISTS (SELECT * FROM visite WHERE visite_badgeId = badge_id AND visite_heureSortie IS NULL) AND badge_actif = 1 " ; 
		/*la ligne après est à ctrl+z si il y a un problème*/
		//$zSql .= " AND badge_id NOT IN (SELECT visite_badgeId FROM visite WHERE visite_heureSortie IS NULL AND visite_date = '".date("Y-m-d")."') AND badge_actif = 1 " ; 

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function get_all_badgeDispoToDay($_zTerm = ''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);	
		
		$zSql= "SELECT badge_id,badge_nom from badge WHERE ";
		
		//$zSql .= " WHERE badge_id IN (SELECT attribution_numBadgeId FROM attribution WHERE attribution_dateSortie IS NOT NULL)" ; 
		$zSql .= " badge_posteId = " . $_SESSION["session_PosteSAU"] . " AND badge_actif = 1 ";
		if ($_zTerm != '') {
			$zSql .= " AND badge_nom like '%". $_zTerm ."%'" ; 
		}
		$zSql .= " AND NOT EXISTS (SELECT attribution_numBadgeId FROM attribution WHERE attribution_heureSortie IS NULL AND attribution_numBadgeId = badge_id) " ; 
		$zSql .= " AND NOT EXISTS (SELECT visite_badgeId FROM visite WHERE visite_heureSortie IS NULL AND visite_badgeId = badge_id) " ; 
		/*$zSql= "SELECT * from badge WHERE 1 ";
		//$zSql .= " WHERE badge_id IN (SELECT attribution_numBadgeId FROM attribution WHERE attribution_dateSortie IS NOT NULL)" ; 

		$zSql .= " AND NOT EXISTS (SELECT * FROM visite WHERE visite_badgeId = badge_id AND visite_heureSortie IS NULL) " ; 
		$zSql .= " AND NOT EXISTS (SELECT * FROM attribution WHERE attribution_numBadgeId = badge_id AND attribution_heureSortie IS NULL) " ;

		$zSql .= " AND badge_posteId = " . $_SESSION["session_PosteSAU"] . " AND badge_actif = 1 ";

		if ($_zTerm != '') {
			$zSql .= " AND badge_nom like '%". $_zTerm ."%'" ; 
		}*/

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}

	public function get_all_badgeTransaction($_zTerm = ''){

		global $db;

		$DB1 = $this->load->database('sau', TRUE);		
		$zSql= "SELECT * from badge WHERE 1";
		$zSql .= " AND badge_posteId = " . $_SESSION["session_PosteSAU"] . " AND badge_actif = 1 ";

		if ($_zTerm != '') {
			$zSql .= " AND badge_nom like '%". $_zTerm ."%'" ; 
		}

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow;

	}


	public function toGetBadge()
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zDatabaseVisiteur	=  $db['sau']['database'] ; 


		/*$zSql= "select *,badge_id AS iBadgeId,( SELECT bg.badge_nom FROM $zDatabaseVisiteur.badge bg INNER JOIN $zDatabaseVisiteur.attribution a ON a.attribution_numBadgeId = bg.badge_id WHERE a.attribution_demandeBadgeId = iBadgeId )  as badge_nom, ( SELECT attribution_dateSortie FROM $zDatabaseVisiteur.attribution WHERE attribution_demandeBadgeId = iBadgeId )  as attribution_dateSortie	
		from badge INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = badge_userId 
		GROUP BY badge_demandeType,badge_userId ORDER BY badge_date DESC";*/

		$zSql= "select *,user_id AS iUserId,( SELECT bg.badge_nom FROM $zDatabaseVisiteur.badge bg INNER JOIN $zDatabaseVisiteur.attribution a ON a.attribution_numBadgeId = bg.badge_id WHERE a.attribution_userId = iUserId )  as badge_nom, ( SELECT attribution_dateSortie FROM $zDatabaseVisiteur.attribution WHERE attribution_userId = iUserId )  as attribution_dateSortie  FROM $zDatabaseOrigin.candidat c LEFT JOIN $zDatabaseVisiteur.attribution ON attribution_userId = c.user_id WHERE isPointage = 1";

		//echo $zSql ; 

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function __getInfoBadgeId($_iUserId)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "select c.matricule,c.nom, c.prenom, d.libele as zDirection, s.libele as zService, m.libele as zDivision FROM $zDatabaseOrigin.candidat c 
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
		LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
		LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division	
		WHERE user_id = ".$_iUserId."";

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getInfoBadgeId($_iAttributionId)
	{

		global $db ; 
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "select c.matricule,c.nom, c.prenom, d.libele as zDirection, s.libele as zService, m.libele as zDivision from attribution INNER JOIN $zDatabaseOrigin.candidat c ON c.user_id = attribution_numBadgeId
		LEFT JOIN $zDatabaseOrigin.service s ON s.id = c.service
		LEFT JOIN $zDatabaseOrigin.direction d ON d.id = c.direction
		LEFT JOIN $zDatabaseOrigin.module m ON m.id = c.division	
		WHERE attribution_id = ".$_iAttributionId." ORDER BY badge_date DESC";

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>
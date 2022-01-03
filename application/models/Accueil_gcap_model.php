<?php
class Accueil_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		if($this->db->insert($zDatabaseGcap.'.revuecommunique', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertFicheDePoste($oData){
		global $db;
		$zDatabaseOrigin		=  $db['default']['database'] ; 
		if($this->db->insert($zDatabaseOrigin.'.fichedeposte', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function insertFichePosteFinale($oData){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		if($this->db->insert($zDatabaseGcap.'.fichedepostefinale', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function updateFichePosteFinale($oData, $_iFichePosteId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$this->db->update($zDatabaseGcap.'.fichedepostefinale', $oData, "ficheDePoste_id = $_iFichePosteId");
	}

	public function insertPopUp($oData){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		if($this->db->insert($zDatabaseGcap.'.popup', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update_ficheDePoste($oData, $_iFichePosteId){
		global $db;
		$zDatabaseOrigin		=  $db['default']['database'] ; 
		$this->db->update($zDatabaseOrigin.'.fichedeposte', $oData, "fichePoste_id = $_iFichePosteId");
	}

	public function update_rc($oData, $_iRcId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$this->db->update($zDatabaseGcap.'.revuecommunique', $oData, "revueCommunique_id = $_iRcId");
	}

	public function delete_rcCommunique($_iCommuniqueId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$this->db->query('delete from '.$zDatabaseGcap.'.revuecommunique where revueCommunique_id = '.$_iCommuniqueId);
	}

	public function delete_FicheDePosteR($_iFicheDePosteId){
		global $db;
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$this->db->query('delete from '.$zDatabaseOrigin.'.fichedeposte where fichePoste_id = '.$_iFicheDePosteId);
	}

	public function delete_FicheDePoste($_iFichePosteId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$this->db->query('delete from '.$zDatabaseGcap.'.fichedepostefinale where ficheDePoste_id = '.$_iFichePosteId);
	}
	
	public function getAllAccueil($_iTypeId, $_iCategorieId=0){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zSql= "select (select annee_max from ".$zDatabaseGcap.".annee limit 0,1) as annee,revueCommunique_id,categorieRc_id,revueCommunique_url,revueCommunique_type,categorieRc_libelle,revueCommunique_titre,revueCommunique_descCourt,CONCAT(candidat.nom,' ',candidat.prenom) as agent,categorieRc_libelle,revueCommunique_date,revueCommunique_urgent,
		revueCommunique_fichier,categorieRc_photo,revueCommunique_image,categorieRc_photoBg from ".$zDatabaseGcap.".revuecommunique 
		INNER JOIN ".$zDatabaseGcap.".categorierc ON categorieRc_id = revueCommunique_categorieRcId
		INNER JOIN ".$zDatabaseOrigin.".candidat ON user_id = revueCommunique_userId
		WHERE revueCommunique_typeRcId = " . $_iTypeId . "" ;

		if ($_iCategorieId > 0) {
			$zSql .= " AND revueCommunique_categorieRcId = " . $_iCategorieId; 
		}

		$zSql .= " ORDER BY revueCommunique_date DESC,revueCommunique_ordre ASC "; 
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function getAllFicheDePoste($_zTerm=''){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		$zSql  = "select * from ".$zDatabaseOrigin.".fichedeposte " ;

		if($_zTerm != ""){
			$zSql  .= " WHERE 1 AND fichePoste_intitule like '%" . $_zTerm . "%'" ;
		}
		$zSql .= " ORDER BY fichePoste_intitule ASC "; 

		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function getListeDivision($_oCandidat){
		global $db;
		$zDatabaseOrigin	=  $db['default']['database'] ; 
		
		$zSql  = "SELECT *,departement_id AS departementId,direction_id AS iDirectionId,service_id AS iServiceId, (SELECT libele FROM departement WHERE id = departementId) AS departement,
		(SELECT libele FROM direction WHERE id = iDirectionId) AS direction, (SELECT libele FROM service WHERE id = iServiceId LIMIT 0,1) AS service
		from ".$zDatabaseOrigin.".module WHERE module_dep = " . $_oCandidat[0]->departement ;

		
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 



	public function getAllUserSubordonnees ($_oUser,$_oCandidat,$_iUserId, $_iCompteActif, &$zNotIn="",$iAffiche=0) {

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		switch ($_iCompteActif)
		{
			
			case COMPTE_RESPONSABLE_PERSONNEL :
				
				/* même direction */
				$zSql = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.direction = '".$_oCandidat[0]->direction."' " ;
					

				if ($_oUser['im'] == '350210' ||  $_oUser['im'] == '260011') {
					$zSql  = "SELECT user_id FROM $zDatabaseOrigin.candidat c12 WHERE c12.departement IN (1,2) " ;
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

			
		}

		return $zUserId ; 
	}


	public function getPopUpId($_iUserId){

		global $db;

		$DB1 = $this->load->database('gcap', TRUE);	
		$zSql= "SELECT popup_userId from popup WHERE popup_userId = '". trim($_iUserId) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iPopUpId = 0;
		if (sizeof($oRow)>0){
			$iPopUpId = $oRow[0]['popup_userId'] ; 
		} 

		return $iPopUpId ; 


	}

	public function getPopNouveauBadge($_iUserId,$iReturn=0){

		global $db;

		$DB1 = $this->load->database('default', TRUE);	
		$zSql= "SELECT * from agent_demande WHERE demande_userId = '". trim($_iUserId) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iPopUpId = 0;
		if (sizeof($oRow)>0){
			$iPopUpId = $oRow[0]['demande_userId'] ; 
		} 

		if($iReturn==0){
			return $iPopUpId;
		} else {
			return $oRow ; 
		}

		

	}

	public function getPopConfirmationBadge($_iUserId){

		global $db;

		$DB1 = $this->load->database('default', TRUE);	
		$zSql= "SELECT confirmationBadge_userId from confirmationbadge WHERE confirmationBadge_userId = '". trim($_iUserId) ."'";

		$zQuery = $DB1->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		$iPopUpId = 0;
		if (sizeof($oRow)>0){
			$iPopUpId = $oRow[0]['confirmationBadge_userId'] ; 
		} 

		return $iPopUpId ; 

	}

	public function getHomeArticle(){

		global $db;

		$DB1 = $this->load->database('common', TRUE);	

		//$zSql= "SELECT * FROM common.home ORDER BY rand() LIMIT 0,1";
		$zSql= "SELECT * FROM common.home WHERE home_active=1 LIMIT 0,1";

		$zQuery = $DB1->query($zSql);
		$toHome = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toHome ; 

	}

	public function getBatiment(){

		global $db;

		$DB1 = $this->load->database('default', TRUE);	

		$zSql= "SELECT * FROM batiment_badge ORDER BY batiment_libelle ASC";

		$zQuery = $DB1->query($zSql);
		$toBatiment = $zQuery->result_array();
		$zQuery->free_result(); 

		return $toBatiment ; 

	}


	public function get_RevueCommuniqueId($iId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);

		if ($iId === FALSE)
		{
			$zQuery = $DB1->get('revuecommunique');
			return $zQuery->result_array();
		}

		$zQuery = $DB1->get_where('revuecommunique', array('revueCommunique_id' => $iId));
		return $zQuery->row_array();
	}

	public function getFicheDePosteId($iId = FALSE){
		
		$DB1 = $this->load->database('default', TRUE);

		if ($iId === FALSE)
		{
			$zQuery = $DB1->get('fichedeposte');
			return $zQuery->result_array();
		}

		$zQuery = $DB1->get_where('fichedeposte', array('fichePoste_id' => $iId));
		return $zQuery->row_array();
	}

	public function getDistinctAnnee($_iTypeId){

		$DB1 = $this->load->database('gcap', TRUE);
		$zSql  = " SELECT DISTINCT YEAR(revueCommunique_date) AS iAnnee FROM revuecommunique WHERE revueCommunique_typeRcId = " . $_iTypeId . " ORDER BY iAnnee ASC " ; 		

		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}

	public function getDistinctMois(){

		$DB1 = $this->load->database('gcap', TRUE);
		$zSql  = " SELECT DISTINCT MONTH(revueCommunique_date) AS iMonth FROM revuecommunique ORDER BY iMonth ASC " ; 		

		$zQuery = $DB1->query($zSql);
		$toMonth =  $zQuery->result_array();

		$iIncrement = 0;
		foreach ($toMonth as $oMonth){
			switch ($oMonth['iMonth']){
				case '1':
					$toMonth[$iIncrement]['zMonth'] = "Janvier";
					break;

				case '2':
					$toMonth[$iIncrement]['zMonth'] = "Février";
					break;

				case '3':
					$toMonth[$iIncrement]['zMonth'] = "Mars";
					break;

				case '4':
					$toMonth[$iIncrement]['zMonth'] = "Avril";
					break;

				case '5':
					$toMonth[$iIncrement]['zMonth'] = "Mai";
					break;

				case '6':
					$toMonth[$iIncrement]['zMonth'] = "Juin";
					break;

				case '7':
					$toMonth[$iIncrement]['zMonth'] = "Juillet";
					break;

				case '8':
					$toMonth[$iIncrement]['zMonth'] = "Août";
					break;

				case '9':
					$toMonth[$iIncrement]['zMonth'] = "Septembre";
					break;

				case '10':
					$toMonth[$iIncrement]['zMonth'] = "Octobre";
					break;

				case '11':
					$toMonth[$iIncrement]['zMonth'] = "Novrembre";
					break;

				case '12':
					$toMonth[$iIncrement]['zMonth'] = "Décembre";
					break;
			}
			$toMonth[$iIncrement]['iMonth2'] = sprintf("%'.02d\n", $oMonth['iMonth']);
			$toMonth[$iIncrement]['iMonth'] = $oMonth['iMonth'];
			$iIncrement++;
		}

		return $toMonth ; 
	}

	public function set_config (){
		
		global $db;
		$zDatabaseGcap	 =  $db['gcap']['database'] ;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$sql= "SELECT * FROM $zDatabaseGcap.annee LIMIT 0,1 ";

		$query = $this->db->query($sql);
		$oAgent = $query->row_array();
		$query->free_result(); // The $query result object will no longer be available

		if(sizeof($oAgent)>0){
			$iValue = ($oAgent["annee_max"]==0)?1:0;
			$zSql= "Update $zDatabaseGcap.annee SET annee_max = " . $iValue;
			$this->db->query($zSql);
		}
	}

	public function preRemplissage ($_iId){

		$oData = array();
		$oData["revueCommunique_typeRcId"]		= '' ; 
		$oData["revueCommunique_titre"]			= '' ; 
		$oData["revueCommunique_descCourt"]		= '' ; 
		$oData["revueCommunique_categorieRcId"] = '' ; 
		$oData["revueCommunique_image"]			= '' ; 
		$oData["revueCommunique_organeId"]		= '' ; 
		$oData["revueCommunique_pageParution"]	= '' ; 
		$oData["revueCommunique_journaliste"]	= '' ; 
		$oData["revueCommunique_tendance"]		= '' ; 
		$oData["revueCommunique_lien"]			= '' ; 
		$oData["revueCommunique_userId"]		= '' ; 
		$oData["revueCommunique_date"]			= ''; 
		$oData["revueCommunique_fichier"]			= ''; 
		$oData["revueCommunique_urgent"]			= ''; 
		$oData["revueCommunique_urgent"]			= ''; 
		$oData["revueCommunique_urgent"]			= ''; 
		

		if ($_iId > 0) {
			$toGet = $this->get_RevueCommuniqueId($_iId);
			$oData["revueCommunique_typeRcId"]		= $toGet['revueCommunique_typeRcId'] ; 
			$oData["revueCommunique_titre"]			= $toGet['revueCommunique_titre'] ; 
			$oData["revueCommunique_descCourt"]		= $toGet['revueCommunique_descCourt'] ; 
			$oData["revueCommunique_categorieRcId"] = $toGet['revueCommunique_categorieRcId'] ; 
			$oData["revueCommunique_image"]			= $toGet['revueCommunique_image'] ; 
			$oData["revueCommunique_organeId"]		= $toGet['revueCommunique_organeId'] ; 
			$oData["revueCommunique_pageParution"]	= $toGet['revueCommunique_pageParution'] ; 
			$oData["revueCommunique_journaliste"]	= $toGet['revueCommunique_journaliste'] ; 
			$oData["revueCommunique_tendance"]		= $toGet['revueCommunique_tendance'] ; 
			$oData["revueCommunique_lien"]			= $toGet['revueCommunique_lien'] ; 
			$oData["revueCommunique_userId"]		= $toGet['revueCommunique_userId'] ; 
			$oData["revueCommunique_date"]			= $toGet['revueCommunique_date']; 
			$oData["revueCommunique_fichier"]		= $toGet['revueCommunique_fichier']; 
			$oData["revueCommunique_urgent"]		= $toGet['revueCommunique_urgent']; 
			$oData["revueCommunique_type"]			= $toGet['revueCommunique_type']; 
			$oData["revueCommunique_url"]			= $toGet['revueCommunique_url']; 
		}

		return $oData ; 
	}

	public function preRemplissageFicheDePoste ($_iId){

		$oData = array();
		$oData["fichePoste_id"]	= '' ; 
		$oData["fichePoste_intitule"] = '' ; 
		$oData["fichePoste_mission"] = '' ; 
		$oData["fichePoste_activitePrinc"] = '' ; 
		$oData["fichePoste_activiteEncad"] = '' ; 
		$oData["fichePoste_exigenceNiveau"] = '' ; 
		$oData["fichePoste_exigenceDiplome"] = '' ; 
		

		if ($_iId > 0) {
			$toGet = $this->getFicheDePosteId($_iId);
			$oData["fichePoste_id"]	= $toGet['fichePoste_id'] ; 
			$oData["fichePoste_intitule"] = $toGet['fichePoste_intitule'] ; 
			$oData["fichePoste_mission"] = $toGet['fichePoste_mission'] ; 
			$oData["fichePoste_activitePrinc"] = $toGet['fichePoste_activitePrinc'] ; 
			$oData["fichePoste_activiteEncad"] = $toGet['fichePoste_activiteEncad'] ; 
			$oData["fichePoste_exigenceNiveau"] = $toGet['fichePoste_exigenceNiveau'] ; 
			$oData["fichePoste_exigenceDiplome"] = $toGet['fichePoste_exigenceDiplome'] ; 
		}

		return $oData ; 
	}

	public function getCategorieRc($_iTypeId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zSql= "select * from ".$zDatabaseGcap.".categorierc WHERE categorieRc_typeRcId = " . $_iTypeId . "" ;
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function getAllFichePoste(){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zDatabaseRohi		=  $db['default']['database'] ; 
		$zSql= "select fichePoste_id,fichePoste_intitule,nom,prenom from ".$zDatabaseGcap.".ficheposte INNER JOIN ".$zDatabaseRohi.".candidat ON fichePoste_userId = user_id " ;
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function getFichePoste($_iFichePostId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zSql= "select * from ".$zDatabaseGcap.".ficheposte where fichePoste_id =  " . $_iFichePostId ;
		$zQuery = $this->db->query($zSql);
		return $zQuery->row_array();
	} 

	public function getCategorieById($_iCategorieRcId){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zSql= "select categorieRc_libelle from ".$zDatabaseGcap.".categorierc WHERE categorieRc_id = " . $_iCategorieRcId . "" ;
		$zQuery = $this->db->query($zSql);
		$toCategorie =  $zQuery->result_array();

		$zCategorieLibelle = "";
		foreach ($toCategorie as $oCategorie){
			$zCategorieLibelle = $oCategorie['categorieRc_libelle'];
		}

		return $zCategorieLibelle ; 
	} 

	public function getOrganePresse(){
		global $db;
		$zDatabaseGcap		=  $db['gcap']['database'] ; 
		$zSql= "select * from ".$zDatabaseGcap.".organepresse " ;
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function delete_AllCompte($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$this->db->query('delete from '.$zDatabaseGcap.'.usercompte where userCompte_userId = '.$_iUserId);
	}
}
?>
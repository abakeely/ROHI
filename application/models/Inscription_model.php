<?php
class Inscription_model extends CI_Model {

	public function __construct(){
		$this->load->database('inscription');
	}

	public function insert($oData,$_zTable){
		$DB1 = $this->load->database('inscription', TRUE);
		if($DB1->insert($_zTable, $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function updateMultiple($oData,$_iInscriptionId,$_zTable){
		$zParamUpdate = $_zTable.'_id';
		$DB1 = $this->load->database('inscription', TRUE);
		$DB1->update($_zTable, $oData, "$zParamUpdate = $_iInscriptionId");
	}
	
	public function deleteMultiple($_param, $_zTable){
		global $db;
		$zParamDelete = $_zTable.'_inscriptionId';
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "DELETE FROM $zDatabaseInscription.$_zTable WHERE $zParamDelete = $_param";
		$this->db->query($zSql);
	}

	public function getInscription($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.inscriptionligne";
		if($_iParam) $zSql .=" WHERE inscriptionligne_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		if($_iParam) return $oRes[0];
		else return $oRes;
	}

	public function checkResponsable($_iCandidatId = false){
			global $db;
			$zDatabaseInscription =  $db['inscription']['database'] ;
			$zSql = "SELECT * FROM $zDatabaseInscription.responsable";
			if($_iCandidatId) $zSql .=" WHERE responsable_candidatId = $_iCandidatId";
			$zQuery = $this->db->query($zSql);
			$oRes =  $zQuery->result_array();
			if(sizeof($oRes) > 0) return true; else return false;
	}

	public function getMultipleInOne($_iInscriptionId = false, $_zTable = false, $_zParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.$_zTable WHERE $_zParam = $_iInscriptionId";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		$zQuery->free_result();
		return $oRes;
	}

	public function getAboutFormation($_iIntituleId){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.intitule I INNER JOIN $zDatabaseInscription.institut I2 on I2.institut_id = I.intitule_institutId
						INNER JOIN $zDatabaseInscription.formation F on F.formation_id = I2.institut_formationId WHERE I.intitule_id = $_iIntituleId";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		$zQuery->free_result();
		return $oRes[0];
	}

	public function getFonction($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.fonction";
		if($_iParam) $zSql .=" WHERE fonction_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}
	public function getInstitutFormation($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.institut";
		if($_iParam) $zSql .=" WHERE institut_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}

	public function getTypeFormation($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.formation";
		if($_iParam) $zSql .=" WHERE formation_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}

	public function getThemeFormation($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.theme";
		if($_iParam) $zSql .=" WHERE theme_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}
	
	public function getAttenteFormation($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.attente";
		if($_iParam) $zSql .=" WHERE attente_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}
	public function getOrganisme($_iParam = false){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.organisme";
		if($_iParam) $zSql .=" WHERE organisme_id = $_iParam";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		return $oRes;
	}

	public function getData($_zTable,$_zParam,$_iValeur){
		global $db;
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.$_zTable WHERE $_zParam = $_iValeur";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		$zQuery->free_result();
		return $oRes;
	}

	public function getLastDiplome($_iCandidatId = false){
		global $db;
		if($_iCandidatId){
			$zDatabaseOrigine =  $db['default']['database'] ;
			$zSql = "SELECT * FROM $zDatabaseOrigine.candidat_diplome WHERE id= (SELECT MIN(id) FROM $zDatabaseOrigine.candidat_diplome WHERE candidat_id = $_iCandidatId)";
			$zQuery = $this->db->query($zSql);
			$oRes =  $zQuery->result_array();
			return $oRes;
		}else return false;
	}

	public function getIntituleTheme($_iThemeId = false){
		global $db;
		if($_iThemeId){
			$zDatabaseInscription =  $db['inscription']['database'] ;
			$zSql = "SELECT theme_intitule FROM $zDatabaseInscription.theme WHERE theme_id = $_iThemeId";
			$zQuery = $this->db->query($zSql);
			$oRes =  $zQuery->result_array();
			return $oRes[0];
		}
	}

	public function getIntituleFormation($_iIntituleId = false){
		global $db;
		
		$zDatabaseInscription =  $db['inscription']['database'] ;
		$zSql = "SELECT * FROM $zDatabaseInscription.intitule";
		if($_iIntituleId) $zSql .=" WHERE intitule_id = $_iIntituleId";
		$zQuery = $this->db->query($zSql);
		$oRes =  $zQuery->result_array();
		if($_iIntituleId)return $oRes[0];
		else return $oRes;
		
	}

	public function getInfoCandidat($_iUserId = false){
		global $db;
		$zDatabaseOrigine =  $db['default']['database'] ;
		if($_iUserId){

			$zSql = "SELECT ca.*,de.sigle_departement as zDepartement,di.sigle_direction as zDirection,se.sigle_service as zService,re.libele as zRegion";
			$zSql .=" FROM $zDatabaseOrigine.candidat ca";
			$zSql .= " INNER JOIN $zDatabaseOrigine.departement de ON de.id = ca.departement";
			$zSql .= " INNER JOIN $zDatabaseOrigine.direction di ON di.id = ca.direction";
			$zSql .= " INNER JOIN $zDatabaseOrigine.service se ON se.id = ca.service";
			$zSql .= " INNER JOIN $zDatabaseOrigine.region re ON re.id = ca.region_id WHERE ca.user_id = $_iUserId";
			$zQuery = $this->db->query($zSql);
			$oRes =  $zQuery->result_array();
			return $oRes[0];
		}else return false;
	}

}
?>

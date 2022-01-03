<?php
class Inout_pointage_model extends CI_Model {

	public function __construct(){
		global $db;
		$this->load->database('gcap');
	}
	
	public function insert($oDataSaveInout){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('inout1', $oDataSaveInout)){
			return $DB1->insert_id();
		}else return false;
	}

	public function insertMission($oDataSaveInout){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('mission', $oDataSaveInout)){
			return $DB1->insert_id();
		}else return false;
	}
	
	public function insertFormation($oDataSaveInout){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('formation', $oDataSaveInout)){
			return $DB1->insert_id();
		}else return false;
	}

	public function update($oData, $_iInOutId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('inout1', $oData, "inOut_id = $_iInOutId");
		return $_iGcapId ; 
	}

	public function updateMission($oData, $_iMissionId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('mission', $oData, "mission_id = $_iMissionId");
		return $_iGcapId ; 
	}
	
	public function updateFormation($oData, $_iFormationId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('formation', $oData, "formation_id = $_iFormationId");
		return $_iGcapId ; 
	}


	public function updateBadgeObtention($oData, $_iBadgeId){
		$DB1 = $this->load->database('gcap', TRUE);
		$DB1->update('badge', $oData, "badge_id = $_iBadgeId");
		return $_iGcapId ; 
	}


	public function toGetInOut($_iUserId)
	{

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "select *, (select CONCAT(nom,' ',prenom) from $zDatabaseOrigin.candidat where user_id = inOut_userSendId) as nom from inout1 
		where inOut_userId = '$_iUserId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	

	public function toGetMission($_iUserId)
	{

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "select *, (select CONCAT(nom,' ',prenom) from $zDatabaseOrigin.candidat where user_id = mission_userSendId) as nom from mission 
		where mission_userId = '$_iUserId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
	public function toGetFormation($_iUserId)
	{

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "select *, (select CONCAT(nom,' ',prenom) from $zDatabaseOrigin.candidat where user_id = formation_userSendId) as nom from formation 
		where formation_userId = '$_iUserId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}


	public function toGetBadgePerdue($_iUserId)
	{

		global $db;
		$DB1 = $this->load->database('gcap', TRUE);
		$zDatabaseOrigin =  $db['default']['database'] ; 

		$zSql= "SELECT * FROM badge WHERE badge_demandeType = 2 AND badge_userId = ".$_iUserId." ORDER BY badge_datePerdue DESC";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
}
?>
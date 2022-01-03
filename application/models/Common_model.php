<?php
class Common_model extends CI_Model {

	public function __construct(){
		$this->load->database('common');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseCommon		=  $db['common']['database'] ; 
		if($this->db->insert($zDatabaseCommon.'.fondpage', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function saveConfiguration($_oData){
		
		global $db;
		$zDatabaseCommon		=  $db['common']['database'] ; 
		$oRow = $this->setConfigurationUser($_oData['fondPage_userId']);
		$iInstitutId = 0;
		if (sizeof($oRow)>0){
			$this->db->update($zDatabaseCommon.".fondpage", $_oData, "fondPage_userId = " . $_oData['fondPage_userId']);

		} else {
			$this->insert($_oData);
		}

	}

	public function setConfigurationUser($_iUserId){
		global $db;
		$zDatabaseCommon		=  $db['common']['database'] ; 
		$zSql= "SELECT fondPage_photo,fondPage_couleur from ".$zDatabaseCommon.".fondpage WHERE fondPage_userId = '". $_iUserId ."'";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); 

		return $oRow ; 
	}
}
?>
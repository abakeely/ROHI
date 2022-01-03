<?php
class Misedispo_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.misedispo', $oData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function getTrue($_iId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "select * from $zDatabaseGcap.misedispo where misedispo_userId = ".$_iId;
		$zQuery = $this->db->query($zSql);
		$res = $zQuery->result_array();
		if(sizeof($res) > 0) return true;
		else return false;
	}
	
	public function getMiseDispo($_zUserId)
	{

		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "select * from $zDatabaseGcap.misedispo where misedispo_userId = $_zUserId";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	public function update($oData, $_iUserId){
		
		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$this->db->update($zDatabaseGcap.'.misedispo', $oData, "misedispo_userId = $_iUserId");
		return $_iUserId ; 
	}
	
	public function delete($_iUserId){
		
		global $db ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "delete from $zDatabaseGcap.misedispo where misedispo_userId = $_iUserId";
		$zQuery = $this->db->query($zSql);
		return $_iUserId ; 
	}

	
	
	
}
?>
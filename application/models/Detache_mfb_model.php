<?php
class Detache_mfb_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.detachemfb', $oData)){
			return $this->db->insert_id();
		}else return false;
	}


	public function getDetacheMfb($_zUserId)
	{

		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "select * from $zDatabaseGcap.detachemfb where user_id = $_zUserId";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	public function update($oData, $_iUserId){
		
		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$this->db->update($zDatabaseGcap.'.detachemfb', $oData, "user_id = $_iUserId");
		return $_iUserId ; 
	}
	
	public function delete($_iUserId){
		
		global $db ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "delete from $zDatabaseGcap.detachemfb where user_id = $_iUserId";
		$zQuery = $this->db->query($zSql);
		return $_iUserId ; 
	}

	
	
	
}
?>
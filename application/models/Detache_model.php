<?php
class Detache_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		if($this->db->insert($zDatabaseGcap.'.detache', $oData)){
			return $this->db->insert_id();
		}else return false;
	}


	public function getDetache($_zUserId)
	{

		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "select * from $zDatabaseGcap.detache where detache_userId = $_zUserId";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}

	public function update($oData, $_iUserId){
		
		global $db ; 
		$zDatabaseGcap =  $db['gcap']['database'] ;
		
		$this->db->update($zDatabaseGcap.'.detache', $oData, "detache_userId = $_iUserId");
		return $_iUserId ; 
	}
	
	public function delete($_iUserId){
		
		global $db ;
		$zDatabaseGcap =  $db['gcap']['database'] ;
		$zSql = "delete from $zDatabaseGcap.detache where detache_userId = $_iUserId";
		$zQuery = $this->db->query($zSql);
		return $_iUserId ; 
	}
	
	
}
?>
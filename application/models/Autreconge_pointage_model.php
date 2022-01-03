<?php
class Autreconge_pointage_model extends CI_Model {

	public function __construct(){
		global $db;
		$this->load->database('gcap');
	}
	
	public function insert($oDataSaveAutreConge){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('AutreConge', $oDataSaveAutreConge)){
			return $this->db->insert_id();
		}else return false;
	}


	public function toGetAutreConge($_iUserId)
	{

		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select * from autreconge where autreConge_userId = '$_iUserId'";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>
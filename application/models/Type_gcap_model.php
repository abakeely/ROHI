<?php
class Type_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		$DB1 = $this->load->database('gcap', TRUE);
		if($DB1->insert('type', $oData)){
			return $DB1->insert_id();
		}else return false;
	}

	public function get_type_by_id($_iTypeId){
		
		$DB1 = $this->load->database('gcap', TRUE);

		$zSql= "select * from type where type_id = $_iTypeId";
		$zQuery = $DB1->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>
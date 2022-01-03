<?php
class Texteback_model extends CI_Model {
	private $texteback_table = 'texteback';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function insert($ocandidatData){
		if($this->db->insert($this->texteback_table, $ocandidatData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_all_list(){
		$zSql= "select * from ".$this->texteback_table;
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}
    
   
	
	public function get_by_type($id){
		$zSql= "select * from texteback where type = ".$id;
		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow[0];
	}

	
	public function update($ocandidatData,$candidat_id){
		$DB1 = $this->load->database('default', TRUE);
		$DB1->update($this->texteback_table, $ocandidatData, "type = $candidat_id");
	}
	
}
?>
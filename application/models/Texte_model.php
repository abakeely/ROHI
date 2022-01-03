<?php
class Texte_model extends CI_Model {
	private $texte_table = 'texte';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function insert($candidatData){
		if($this->db->insert($this->texte_table, $candidatData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_all_list(){
		$sql= "select * from ".$this->texte_table;
		$query = $this->db->query($sql);
		$row = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
    
   
	
	public function get_by_type($id){
		$sql= "select * from texte where type = ".$id;
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result(); // The $query result object will no longer be available
		return $row[0];
	}

	
	public function update($candidatData,$candidat_id){
		$DB1 = $this->load->database('default', TRUE);
		$DB1->update($this->texte_table, $candidatData, "type = $candidat_id");
	}
	
}
?>
<?php
class Enam_model extends CI_Model {

	public function insert($enamData){
		if($this->db->insert('enam', $enamData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_enam,$id){
		$this->db->update("enam", $data_enam, "id = $id");
	}
	
	public function get_enam($type_enam=false){
		if($type_enam){
			$query = $this->db->get_where('enam', array('type_enam' => $type_enam));
			
		}
		else 
			$query = $this->db->get_where('enam');
			
    
		return $query->result();
	}
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_enam_by_id($id);
		return (!empty($documentation));
	}
}
?>
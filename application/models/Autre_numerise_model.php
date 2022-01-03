<?php
class Autre_numerise_model extends CI_Model {

	public function insert($autre_numeriseData){
		if($this->db->insert('autre_numerise', $autre_numeriseData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_autre_numerise,$id){
		$this->db->update("autre_numerise", $data_autre_numerise, "id = $id");
	}
	
	public function get_autre_numerise($theme_livre=false){
		if($theme_livre){
			$query = $this->db->get_where('autre_numerise', array('theme_livre' => $theme_livre));
		}
		else 
			$query = $this->db->get_where('autre_numerise');
		
		
		return $query->result();
	}
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_autre_numerise_by_id($id);
		return (!empty($documentation));
	}
	
}
?>
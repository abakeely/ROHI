<?php
class Catalogue_livre_model extends CI_Model {

	public function insert($catalogue_livreData){
		if($this->db->insert('catalogue_livre', $catalogue_livreData, 0, 1)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_catalogue_livre,$id){
		$this->db->update("catalogue_livre", $data_catalogue_livre, "id = $id", 0, 1);
	}
	
	public function get_catalogue_livre($theme_livre=false){
		if($theme_livre){
			$query = $this->db->get_where('catalogue_livre', array('theme_livre' => $theme_livre), 0, 1);
		}
		else 
			$query = $this->db->get_where('catalogue_livre', 0, 1);
		
		
		return $query->result();
	}
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_catalogue_livre_by_id($id);
		return (!empty($documentation));
	}
	
}
?>
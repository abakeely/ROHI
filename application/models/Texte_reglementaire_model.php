<?php
class Texte_reglementaire_model extends CI_Model {

	public function insert($texte_reglementaireData){
		if($this->db->insert('texte_reglementaire', $texte_reglementaireData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_texte_reglementaire,$id){
		$this->db->update("texte_reglementaire", $data_texte_reglementaire, "id = $id");
	}
	
	public function get_texte_reglementaire($_iType=false){
		if($_iType){
			$query = $this->db->get_where('texte_reglementaire', array('type_texte' => $_iType));
		}
		else 
			$query = $this->db->get_where('texte_reglementaire');
		
		
		return $query->result();
	}
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_texte_reglementaire_by_id($id);
		return (!empty($documentation));
	}
	
}
?>
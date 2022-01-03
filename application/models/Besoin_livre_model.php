<?php
class Besoin_livre_model extends CI_Model {

	public function insert($besoin_livreData){
		if($this->db->insert('besoin_livre', $besoin_livreData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_besoin_livre,$id){
		$this->db->update("besoin_livre", $data_besoin_livre, "id = $id");
	}
	
	public function get_besoin_livre_by_user_id($user_id){
		$query = $this->db->get_where('besoin_livre', array('user_id' => $user_id));
		return $query->result();
	}
	
	public function get_all_besoin(){
		$query = $this->db->get_where('besoin_livre');
		return $query->result();
	}
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_besoin_livre_by_id($id);
		return (!empty($documentation));
	}
	
}
?>
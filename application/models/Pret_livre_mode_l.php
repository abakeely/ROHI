<?php
class Pret_livre_model extends CI_Model {

	public function insert($pret_livreData){
		if($this->db->insert('pret_livre', $pret_livreData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_pret_livre,$id){
		$this->db->update("pret_livre", $data_pret_livre, "id = $id");
	}
	
	public function get_pret_livre_by_user_id($user_id){
		$query = $this->db->get_where('pret_livre', array('user_id' => $user_id));
		return $query->result();
	}
		
	public function get_all_pret_livre(){
    $this->db->from('pret_livre');
    $this->db->order_by("date_reservation", "desc");
    $query = $this->db->get();
    return $query->result();
	}
	public function get_all_pret_valide(){
		$query = $this->db->get_where('pret_livre', array('statut' => 1));
		return $query->result();
	}


	public function get_pret_valide_by_user_id($user_id){
		$query = $this->db->get_where('pret_livre', array('statut' => 1,'user_id' => $user_id));
		return $query->result();
	}
	
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_pret_livre_by_id($id);
		return (!empty($documentation));
	}
	
	public function get_nombre_by_intervalle($debut,$fin){
		$sql = "SELECT count(*) as nb FROM pret_livre where date('$debut')<=date_reservation and date_reservation<date('$fin')";
		$query = $this->db->query($sql);
		$result = $query->row();
		$query->free_result(); 
		return $result;
	}
	
}
?>
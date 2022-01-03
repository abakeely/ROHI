<?php
class Consultation_sur_place_model extends CI_Model {

	public function insert($consultation_sur_placeData){
		if($this->db->insert('consultation_sur_place', $consultation_sur_placeData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_consultation_sur_place,$id){
		$this->db->update("consultation_sur_place", $data_consultation_sur_place, "id = $id");
	}
	
	public function get_consultation_sur_place_by_id($id){
		$query = $this->db->get_where('consultation_sur_place', array('id' => $id));
		return $query->result();
	}
	
	public function get_all_consultation(){
		$query = $this->db->get_where('consultation_sur_place');
		return $query->result();
	}
	
	public function get_all_consultation_affiche(){
		$sql = "SELECT c.statut,c.nom_prenom,c.cote_livre,r.nom as responsable ,c.date_lecture,c.etablissement FROM consultation_sur_place c,responsable_biblio r where c.responsable=r.id";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); 
		return $result;
	}
	

	public function is_exist_tableau_bord_by_id($id){
		$tableau_bord = $this->get_consultation_sur_place_by_id($id);
		return (!empty($tableau_bord));
	}
	
	public function get_nombre_by_intervalle($debut,$fin){
		$sql = "SELECT count(*) as nb FROM consultation_sur_place where date('$debut')<=date_lecture and date_lecture<date('$fin')";
		$query = $this->db->query($sql);
		$result = $query->row();
		$query->free_result(); 
		return $result;
	}
	
}
?>
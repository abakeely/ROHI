<?php
class Connexion_internet_model extends CI_Model {

	public function insert($consultation_sur_placeData){
		if($this->db->insert('connexion_internet', $consultation_sur_placeData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_all_connexion_internet_affiche(){
		$sql = "SELECT c.statut,c.nom_prenom,c.titre_recherche,r.nom as responsable ,c.date_lecture,c.etablissement FROM connexion_internet c,responsable_biblio r where c.responsable=r.id";
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); 
		return $result;
	}
	
	public function get_nombre_by_intervalle($debut,$fin){
		$sql = "SELECT count(*) as nb FROM connexion_internet where date('$debut')<=date_lecture and date_lecture<date('$fin')";
		$query = $this->db->query($sql);
		$result = $query->row();
		$query->free_result();
		return $result;
	}
	
}
?>
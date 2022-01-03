<?php
class Demande_formation_model extends CI_Model {

	public function insert($demande_formationData){
		if($this->db->insert('demande_formation', $demande_formationData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_demande_formation,$user_id){
		$this->db->update("demande_formation", $data_demande_formation, "user_id = $user_id");
	}
	
	public function get_demande_formation_by_user_id($x){
		$query = $this->db->get_where('demande_formation', array('user_id' => $x));
		return $query->row_array();
	}
	
	public function is_exist_formation_by_user_id($user_id){
		$formation = $this->get_demande_formation_by_user_id($user_id);
		return (!empty($formation));
	}
	
	public function get_nbr_rest_by_user_id($user_id){
		$sql = "SELECT count(*) as nb FROM demande_formation d join candidat c on c.user_id = d.user_id ";
		$sql .= " where c.region_id in (select region_id FROM candidat where user_id = ".$user_id.")";
		$query = $this->db->query($sql);
		$nbr = $query->row_array();
		return $nbr['nb'];
	}
	
	public function get_list_demande(){
		$sql = "SELECT df.id id,df.date_creation,tf.libele theme,c.matricule,c.nom,c.prenom,r.libele region,c.id candidat_id";
		$sql .= " FROM demande_formation df";
		$sql .= " JOIN theme_formation tf on df.theme_formation = tf.id";
		$sql .= " JOIN candidat c on c.user_id = df.user_id";
		$sql .= " JOIN region r on r.id = c.region_id";
		$sql .= " order by df.id";
		$query = $this->db->query($sql);
		$res = $query->result();
		return $res;
	}
}
?>
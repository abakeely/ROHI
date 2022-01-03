<?php
class Pret_livre_model extends CI_Model {

	public function insert($pret_livreData){
		if($this->db->insert('pret_livre', $pret_livreData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($oData_pret_livre,$id){
		$this->db->update("pret_livre", $oData_pret_livre, "id = $id");
	}
	
	public function get_pret_livre_by_user_id($user_id){
		$zQuery = $this->db->get_where('pret_livre', array('user_id' => $user_id));
		return $zQuery->result();
	}
		
	public function get_all_pret_livre(){
    $this->db->from('pret_livre');
    $this->db->order_by("date_reservation", "desc");
    $zQuery = $this->db->get();
    return $zQuery->result();
	}
	public function get_all_pret_valide(){
		$zQuery = $this->db->get_where('pret_livre', array('statut' => 1));
		return $zQuery->result();
	}


	public function get_pret_valide_by_user_id($user_id){
		$zQuery = $this->db->get_where('pret_livre', array('statut' => 1,'user_id' => $user_id));
		return $zQuery->result();
	}
	
	
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_pret_livre_by_id($id);
		return (!empty($documentation));
	}
	
	public function get_nombre_by_intervalle($debut,$fin){
		$zSql = "SELECT count(*) as nb FROM pret_livre where date('$debut')<=date_reservation and date_reservation<date('$fin')";
		$zQuery = $this->db->query($zSql);
		$result = $query->row();
		$zQuery->free_result(); 
		return $result;
	}


	public function get_pret_en_pret(){
			$this->db->from('pret_livre');
			$this->db->order_by("statut", "asc");
			$statut = array('0', '1', '3');
			$this->db->where_in('statut', $statut);
			$query = $this->db->get();
			return $query->result();
	}
		

	public function get_pret_en_attente(){
			$this->db->from('pret_livre');
			$this->db->order_by("statut", "desc");
			  $this->db->where('statut =2');
			$query = $this->db->get();
			return $query->result();
	}

	}
?>
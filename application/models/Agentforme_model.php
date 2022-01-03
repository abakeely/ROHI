<?php
class Agentforme_model extends CI_Model {

	public function insert($agentformeData){
		if($this->db->insert('agentforme', $agentformeData)){
			return $this->db->insert_agentforme_id();
		}else return false;
	}
	
	public function update($data_agentforme,$agentforme_id){
		$this->db->update("agentforme", $data_agentforme, "agentforme_id = $agentforme_id");
	}
	public function get_agentformelocale_by_annee($annee=false){
		if($annee){
			$query = $this->db->query("SELECT * FROM agentforme WHERE agentforme_date like '%$annee' and agentforme_madagascar = 1 ORDER BY agentforme_lieu ASC , agentforme_nomprenom ASC , agentforme_fonction ASC ");
			return $query->result();
		}
	}
	public function get_agentformeetranger_by_annee($annee=false){
		if($annee){
			$query = $this->db->query("SELECT * FROM agentforme WHERE agentforme_date like '%$annee'  and agentforme_madagascar = 0 ORDER BY agentforme_lieu ASC , agentforme_nomprenom ASC, agentforme_fonction ASC ");
			return $query->result();
		}
	}
	public function get_agentforme_by_annee($annee=false){
		if($annee){
			$query = $this->db->query("SELECT * FROM agentforme WHERE agentforme_date like '%$annee' ORDER BY agentforme_lieu ASC , agentforme_nomprenom ASC, agentforme_fonction ASC ");
			return $query->result();
		}
	}
	
	public function get_agentforme($type_agentforme=false){
		if($type_agentforme){
			$this->db->get_where('agentforme', array('type_agentforme' => $type_agentforme));
			$this->db->order_by("agentforme_id","desc");
			$query = $this->db->get();
		}
		else {
			$this->db->from('agentforme');
			$this->db->order_by("agentforme_id","desc");
			$query = $this->db->get();
		}
		
		return $query->result();
	}
	public function is_exist_formation_by_user_id($agentforme_id){
		$formation = $this->get_agentforme_by_id($agentforme_id);
		return (!empty($formation));
	}
}
?>
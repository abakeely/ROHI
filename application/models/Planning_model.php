<?php
class Planning_model extends CI_Model {

	public function insert($planningData){
		if($this->db->insert('planning', $planningData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_planning,$id){
		$this->db->update("planning", $data_planning, "id = $id");
	}
	public function get_planning_by_annee($annee=false){
		if($annee){
			$query = $this->db->select('*')->from('planning')->where("date_restitution LIKE '$annee%'")->order_by("id","desc")->get();
			return $query->result();
		}
	}
	public function get_planning($type_planning=false){
		if($type_planning){
			$this->db->get_where('planning', array('type_planning' => $type_planning));
			$this->db->order_by("id","desc");
			$query = $this->db->get();
		}
		else {
			$this->db->from('planning');
			$this->db->order_by("id","desc");
			$query = $this->db->get();
		}
		$ret = $query->result();
		return $ret;
	}
	public function is_exist_documentation_by_user_id($id){
		$documentation = $this->get_planning_by_id($id);
		return (!empty($documentation));
	}
	
	public function get_tete_restitution(){
		$sql = "SELECT date_restitution, heure_restitution, lieu_restitution1, intitule_restitution, nom_prenom_restitution  FROM planning
				WHERE date_restitution >= CURRENT_DATE ";
				
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$query->free_result(); 
		return $result;
	}
}
?>
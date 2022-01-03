<?php
class Conge_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($congeData){
		if($this->db->insert('conge', $congeData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_conge($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from conge order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('conge', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_by_user_id($user_id){
		$sql= "select * from conge where user_id = $user_id ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function conge_valide_get_by_user_id($user_id){
		$sql= "select * from conge where user_id = $user_id and etat = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function validate_conge($id){
		$congeData = array();
		$congeData['etat'] = 1;
		$this->db->update('conge', $congeData, "id = $id");
	}
	
	public function refuse_conge($id){
		$congeData = array();
		$congeData['etat'] = 2;
		$this->db->update('conge', $congeData, "id = $id");
	}
	
	public function get_nbr_jour_consomme($user_id,$decision_id){
		$sql= "select sum(nbr_jour) as nbr from conge where user_id = ".$user_id." and decision_id = ".$decision_id." and etat = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	public function get_conge_by_decision_id($decision_id){
		$sql= "select * from conge where decision_id = $decision_id and etat = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

?>
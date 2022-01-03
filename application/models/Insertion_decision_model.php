<?php
class Insertion_decision_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($insertion_decisionData){
		if($this->db->insert('insertion_decision', $insertion_decisionData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_insertion_decision($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('insertion_decision');
			return $query->result_array();
		}

		$query = $this->db->get_where('insertion_decision', array('id' => $id));
		return $query->row_array();
	}
        
    public function get_by_user_id($user_id){
			$sql= "select * from insertion_decision where user_id = $user_id ORDER BY id";
			$query = $this->db->query($sql);
			return $query->result_array();
    }
    
    public function get_decision_encours($user_id){
    	$sql= "select * from insertion_decision where user_id = $user_id and etat = 0 ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    public function get_decision_valide($user_id){
    	$sql= "select * from insertion_decision where user_id = $user_id and etat = 1 ORDER BY id";
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
}
?>
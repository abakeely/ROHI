<?php
class Absence_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($absenceData){
		if($this->db->insert('absence', $absenceData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_absence($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from absence order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('absence', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_by_user_id($user_id){
		$sql= "select * from absence where user_id = $user_id ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_abs_valid_by_user_id($user_id){
		$sql= "select * from absence where user_id = $user_id and etat = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_abs_ordinaire_valid_by_user_id($user_id){
		$sql= "select * from absence where user_id = $user_id and etat = 1 and type_autorisation_absence = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function validate_absence($id){
		$data = array();
		$data['etat'] = 1;
		$this->db->update('absence', $data, "id = $id");
	}
	
	public function refuse_absence($id){
		$data = array();
		$data['etat'] = 2;
		$this->db->update('absence', $data, "id = $id");
	}
	
	public function get_nombre_jour_restant($user_id=false){
		$ret = 15;
		if($user_id){
			$list_abs = $this->get_abs_ordinaire_valid_by_user_id($user_id);
			foreach($list_abs as $abs){
				$ret = $ret - $abs['nbr_jour'];
			}
		}
		return $ret;
	}
}
?>
<?php
class Type_conge_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_type_conge($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from type_conge order by id";
            $query = $this->db->query($sql);
			$row = $query->result_array();
            $query->free_result(); // The $query result object will no longer be available
            return $row;
		}
		$query = $this->db->get_where('type_conge', array('id' => $id));
		return $query->row_array();
	}
}
?>
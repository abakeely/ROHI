<?php
class Type_contrat_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_type_contrat($id = FALSE){
		
		if ($id === FALSE)
		{
			$query = $this->db->get('type_contrat');
			//var_dump($query);
			return $query->result_array();
		}

		$query = $this->db->get_where('type_contrat', array('id' => $id));
		return $query->row_array();
	}
}
?>
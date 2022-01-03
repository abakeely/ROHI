<?php
class Domaine_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_domaine($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('domaine');
			return $query->result_array();
		}
		$query = $this->db->get_where('domaine', array('id' => $id));
		return $query->row_array();
	}
}
?>
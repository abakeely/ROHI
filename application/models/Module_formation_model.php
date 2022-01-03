<?php
class Module_formation_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_module_formation($id = FALSE){
		
		if ($id === FALSE)
		{
			$query = $this->db->get('module_formation');
			//var_dump($query);
			return $query->result_array();
		}

		$query = $this->db->get_where('module_formation', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_module_formation_by_theme($theme_id = FALSE){
		$query = $this->db->get_where('module_formation', array('theme_id' => $theme_id));
		return $query->result_array();
	}
}
?>
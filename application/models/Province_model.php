<?php
class Province_model extends CI_Model {

	public function __construct(){
		$this->load->database('default');
	}
	
	public function get_province($id = FALSE){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		if ($id === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.province');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin.'.province', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_province_by_pays_id($id = FALSE){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		if ($id === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin.'.province');
			return $query->result_array();
		}
	
		$query = $this->db->get_where($zDatabaseOrigin.'.province', array('pays_id' => $id));
		return $query->result_array();
	}
}
?>
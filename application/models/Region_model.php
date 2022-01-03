<?php
class Region_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_region($id = FALSE){
		$DB1 = $this->load->database('default', TRUE);
		if ($id === FALSE){
			$query = $DB1->get('region');
			$query = $DB1->get_where('region', array('statut' => 1));
			return $query->result_array();
		}

		$query = $DB1->get_where('region', array('id' => $id));
		return $query->row_array();
	}
	
	public function  get_region_by_province_id($id = FALSE){
		$DB1 = $this->load->database('default', TRUE);
		if ($id === FALSE)
		{
			$query = $DB1->get('region');
			return $query->result_array();
		}

		$query = $DB1->get_where('region', array('province_id' => $id));
		return $query->result_array();
	}
}
?>
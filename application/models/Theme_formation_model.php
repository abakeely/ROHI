<?php
class Theme_formation_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_theme_formation($id = FALSE){
		
		if ($id === FALSE)
		{
			$query = $this->db->get('theme_formation');
			//var_dump($query);
			return $query->result_array();
		}

		$query = $this->db->get_where('theme_formation', array('id' => $id));
		return $query->row_array();
	}

	public function get_theme_formation_by_region_id($region_id){

		if ($region_id != '') {

			$sql = 'SELECT t.* FROM theme_formation t ';
			$sql .= 'join formation_for_region f on t.id = f.theme_formation_id ';
			$sql .= 'where f.region_id = '.$region_id;
			$query = $this->db->query($sql);
			return $query->result_array();
		} else {
			return array();
		}
	}
}
?>
<?php
class Division_model extends CI_Model {
        private $division_table = 'module';
        
	public function __construct(){
		$this->load->database();
	}
	
	public function get_division($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get($this->division_table);
			return $query->result_array();
		}

		$query = $this->db->get_where($this->division_table, array('id' => $id));
		return $query->row_array();
	}
        
        public function get_by_post($post = FALSE){
                $sql= "select module.* from module,grade_has_module where module.id = grade_has_module.module_id and grade_has_module.grade_id = $post";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
        
        public function  get_division_by_service_id($service_id = FALSE){
			global $db;
			$zDatabaseOrigin =  $db['default']['database'] ;

			if ($service_id === FALSE)
			{
				$query = $this->db->get($zDatabaseOrigin.'.'.$this->division_table);
				return $query->result_array();
			}

		$query = $this->db->get_where($zDatabaseOrigin.'.'.$this->division_table, array('service_id' => $service_id));
		return $query->result_array();
	}
}
?>
<?php
class Direction_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_direction($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('direction');
			return $query->result_array();
		}

		$query = $this->db->get_where('direction', array('id' => $id));
		return $query->row_array();
	}
        
        public function get_by_departement($dep){

			$sql= 'select * from direction where departement_id IN (0,'.$dep.') ORDER BY departement_id,id';
			$query = $this->db->query($sql);
			return $query->result_array();
        }
}
?>
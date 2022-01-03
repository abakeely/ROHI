<?php
class Type_autorisation_absence_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_type_autorisation_absence($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from type_autorisation_absence order by id";
            $query = $this->db->query($sql);
			$row = $query->result_array();
            $query->free_result(); // The $query result object will no longer be available
            return $row;
		}
		$query = $this->db->get_where('type_autorisation_absence', array('id' => $id));
		return $query->row_array();
	}
}
?>
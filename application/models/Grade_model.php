<?php
class Grade_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_grade($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from grade order by libele";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('grade', array('id' => $id));
		return $query->row_array();
	}
}
?>
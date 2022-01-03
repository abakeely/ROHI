<?php
class Corps_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_corps($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from corps order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('corps', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_corps_libelle($corps_code = FALSE){
		if ($corps_code === FALSE)
		{
			$sql= "select * from sgrh.t_corps order by corps_code";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('sgrh.t_corps', array('corps_code' => $corps_code));
		return $query->row_array();
	}
}
?>
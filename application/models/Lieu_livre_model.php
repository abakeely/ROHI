<?php
class Lieu_livre_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_lieu_livre($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from lieu_livre order by id , 0, 1";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('lieu_livre', array('id' => $id));
		return $query->row_array();
	}
}
?>
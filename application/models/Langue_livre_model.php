<?php
class Langue_livre_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_langue_livre($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from langue_livre order by id , 0, 1";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result();
                        return $row;
		}

		$query = $this->db->get_where('langue_livre', array('id' => $id));
		return $query->row_array();
	}
}
?>
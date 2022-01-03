<?php
class Theme_livre_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_theme_livre($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from theme_livre order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('theme_livre', array('id' => $id));
		return $query->row_array();
	}
}
?>
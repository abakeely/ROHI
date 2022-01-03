<?php
class Statut_model extends CI_Model {

	private $table = 'statut';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_statut($id = FALSE){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table );
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('id' => $id));
            return $query->row_array();
	}
}
?>
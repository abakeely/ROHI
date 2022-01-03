<?php
class Motif_absence_model extends CI_Model {

	private $table = 'motif_absence';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_motif_absence($id = FALSE){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table );
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('id' => $id));
            return $query->row_array();
	}
	
	public function get_by_type($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get($this->table );
			return $query->result_array();
		}
		$query = $this->db->get_where($this->table, array('type' => $id));
		return $query->result_array();
	}
}
?>
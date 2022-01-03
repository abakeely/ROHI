<?php
class Responsable_biblio_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_all_responsable(){
        $query = $this->db->get_where('responsable_biblio');
        return $query->result();
	}
}
?>
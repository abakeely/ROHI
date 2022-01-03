<?php
class Error_user_historique_model extends CI_Model {

	private $table = 'error_user_historique';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_user_historique($id = FALSE){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table);
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('id' => $id));
            return $query->row_array();
	}
        
	public function create_error($histo){
		if($this->db->insert($this->table, $histo)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
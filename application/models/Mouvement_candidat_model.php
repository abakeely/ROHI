<?php
class Mouvement_candidat_model extends CI_Model {

	private $table = 'mouvement_candidat';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_mouvement_candidat_id($candidat_id = FALSE){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table);
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('$candidat_id' => $id));
            return $query->row_array();
	}
	
	public function get_mouvement_by_resp_id($resp_id = FALSE){
		if ($resp_id === FALSE)
		{
			$query = $this->db->get($this->table);
			return $query->result_array();
		}
		$query = $this->db->get_where($this->table, array('$resp_id' => $resp_id));
		return $query->row_array();
	}
        
	public function create_mouvement($histo){
		$histo['date_operation'] =  date('Y-m-d\TH:i:s');
		if($this->db->insert($this->table, $histo)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
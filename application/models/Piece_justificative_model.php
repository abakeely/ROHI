<?php
class Piece_justificative_model extends CI_Model {

	private $table = 'piece_justificative';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_piece_justificative_by_candidat_id($candidat_id = FALSE){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table);
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('$candidat_id' => $id));
            return $query->row_array();
	}
	
	public function get_piece_justificative_by_resp_id($resp_id = FALSE){
		if ($resp_id === FALSE)
		{
			$query = $this->db->get($this->table);
			return $query->result_array();
		}
		$query = $this->db->get_where($this->table, array('resp_id' => $resp_id));
		return $query->row_array();
	}
	
	public function get_piece_justificative_by_resp_id_and_type($resp_id = FALSE,$type=false){
		if ($resp_id === FALSE)
		{
			$query = $this->db->get($this->table);
			return $query->result_array();
		}
		$query = $this->db->get_where($this->table, array('resp_pers_id' => $resp_id,'type' => $type));
		return $query->result_array();
	}
        
	public function create_piece_justificative($histo){
		$histo['date_operation'] =  date('Y-m-d\TH:i:s');
		if($this->db->insert($this->table, $histo)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
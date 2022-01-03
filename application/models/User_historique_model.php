<?php
class User_historique_model extends CI_Model {

	private $table = 'user_historique';
	
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
	
	
	public function get_last_by_user_id($user_id){
		$sql= "select * from user_historique where user_id = $user_id order by date desc";
		$query = $this->db->query($sql);
		$row = current($query->result());
		$query->free_result(); // The $query result object will no longer be available
		return $row;
	}
        
	public function create_user_historique($histo){
		if($this->db->insert($this->table, $histo)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
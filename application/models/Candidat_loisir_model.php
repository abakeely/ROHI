<?php
class Candidat_loisir_model extends CI_Model {
	private $table = 'candidat_loisir';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_loisir_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table);
                    return $query->result_array();
            }
            $query = $this->db->get_where($this->table, array('candidat_id' => $id));
            return $query->result_array();
	}
        
        public function insert($loisirData){
            if($this->db->insert($this->table, $loisirData)){
                    return $this->db->insert_id();
            }else return false;
	}
        
        public function delete_all_loisir_candidat($id){
            $this->db->query('delete from '.$this->table.' where candidat_id = '.$id);
        }
}
?>
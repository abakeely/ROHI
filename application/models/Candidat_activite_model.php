<?php
class Candidat_activite_model extends CI_Model {
	private $table = 'candidat_activite';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function get_activite_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get($this->table);
                    return $query->result_array();
            }
			//$this->db->from($this->table);
			//$this->db->order_by("date_debut","desc");
            $query = $this->db->get_where($this->table, array('candidat_id' => $id));
            return $query->result_array();
	}
        
        public function insert($parcoursData){
            if($this->db->insert($this->table, $parcoursData)){
                    return $this->db->insert_id();
            }else return false;
	}
        
        public function delete_all_activite_candidat($id){
            $this->db->query('delete from '.$this->table.' where candidat_id = '.$id);
        }
}
?>
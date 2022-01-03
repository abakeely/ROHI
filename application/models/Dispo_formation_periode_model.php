<?php
class Dispo_formation_periode_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_parcours_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get('dispo_formation_periode');
                    return $query->result_array();
            }
            $query = $this->db->get_where('dispo_formation_periode', array('candidat_id' => $id));
            return $query->result_array();
	}
        
        public function insert($parcoursData){
            if($this->db->insert('candidat_parcours', $parcoursData)){
                    return $this->db->insert_id();
            }else return false;
	}
        
        public function delete_all_parcours_candidat($id){
            $this->db->query('delete from dispo_formation_periode where candidat_id = '.$id);
        }
}
?>
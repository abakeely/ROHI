<?php
class Candidat_stage_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_stage_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get('candidat_stage');
					return $query->result_array();
					
            }
			$this->db->from($this->candidat_stage);
			$this->db->order_by("stage_annee","desc");
            $query = $this->db->get_where('candidat_stage', array('candidat_id' => $id));
            return $query->result_array();
	}
        
        public function insert($stageData){
            if($this->db->insert('candidat_stage', $stageData)){
                    return $this->db->insert_id();
            }else return false;
	}
        
        public function delete_all_stage_candidat($id){
            $this->db->query('delete from candidat_stage where candidat_id = '.$id);
        }
}
?>
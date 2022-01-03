<?php
class Candidat_diplome_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_diplome_candidat($id = false){
            if ($id === FALSE)
            {
                    $query = $this->db->get('candidat_diplome');
					return $query->result_array();
					/*
					$this->db->from($this->candidat_diplome);
					$this->db->order_by("diplome_date","asc");
					$query = $this->db->get();
					return $query->result();
					*/
                    
            }
			$this->db->from($this->candidat_diplome);
			$this->db->order_by("diplome_date","desc");
            $query = $this->db->get_where('candidat_diplome', array('candidat_id' => $id));
            return $query->result_array();
			/*
					$this->db->from($this->candidat_diplome);
					$this->db->order_by("diplome_date","asc");
					$query = $this->db->get();
					return $query->result();
					*/
	}
        
        public function insert($diplomeData){
            if($this->db->insert('candidat_diplome', $diplomeData)){
                    return $this->db->insert_id();
            }else return false;
	}
        
    public function delete_all_diplome_candidat($id){
            $this->db->query('delete from candidat_diplome where candidat_id = '.$id);
    }
	
	public function getDiplome($candidat_id){
		$sql= " select group_concat(diplome_name) as diplome from candidat_diplome where candidat_id='".$candidat_id."'";

		$query = $this->db->query($sql);
		return $query->row_array();
	}
}
?>
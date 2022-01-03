<?php
class Contenu_champ_formation_model extends CI_Model { // table contenu formation

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($parcoursData){
		if($this->db->insert('contenu_champ_formation', $parcoursData)){
			return $this->db->insert_id();
		}
		else return false;
	}
	
	public function get_contenu_champ_formation($id_formation,$id_champ){
            $query = $this->db->get_where('contenu_champ_formation', array('id_formation' => $id_formation,'id_champ'=> $id_champ));
            return $query->result_array();
	 }
        
     public function delete_all_contenu_champ_formation($id_formation,$id_champ){
            $this->db->query('delete from contenu_champ_formation where id_formation = '.$id_formation.' and id_champ='.$id_champ);
     }
}
?>
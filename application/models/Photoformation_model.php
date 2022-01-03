<?php
class Photoformation_model extends CI_Model {

	public function insert($photoformationData){
		if($this->db->insert('photoformation', $photoformationData)){
			return $this->db->insert_photoformation_id();
		}else return false;
	}
	
	public function update($data_photoformation,$photoformation_id){
		$this->db->update("photoformation", $data_photoformation, "photoformation_id = $photoformation_id");
	}
	public function get_photoformation_by_photoformation_annee($photoformation_annee=false){
		if($photoformation_annee){
			$query = $this->db->get_where('photoformation', array('photoformation_annee' => $photoformation_annee));
			return $query->result();
		}
		else{
			$query = $this->db->get('photoformation');
			return $query->result();
		}
	}
	public function is_exist_formation_by_user_id($photoformation_id){
		$formation = $this->get_restitution_by_photoformation_id($photoformation_id);
		return (!empty($formation));
	}
	
	public function get_photoformation_by_id($id){
		$query = $this->db->get_where('photoformation', array('photoformation_id' => $id));
		return current($query->result());
	}
}
?>
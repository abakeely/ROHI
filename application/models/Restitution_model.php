<?php
class Restitution_model extends CI_Model {

	public function insert($restitutionData){
		if($this->db->insert('restitution', $restitutionData)){
			return $this->db->insert_restitution_id();
		}else return false;
	}
	
	public function update($data_restitution,$restitution_id){
		$this->db->update("restitution", $data_restitution, "restitution_id = $restitution_id");
	}

	public function get_all_restitution(){
		$sql = " select * from rohi.restitution order by restitution_annee desc";
		
		$query = $this->db->query($sql);
		$row = $query->result_object();
		$query->free_result(); 
		return $row;
	}

	public function get_restitution_by_restitution_annee($restitution_annee=false){
		if($restitution_annee){
			$query = $this->db->get_where('restitution', array('restitution_annee' => $restitution_annee));
			return $query->result();
		}
		else{
			$query = $this->db->get('restitution');
			return $query->result();
		}
	}
	public function is_exist_documentation_by_user_id($restitution_id){
		$documentation = $this->get_restitution_by_restitution_id($restitution_id);
		return (!empty($documentation));
	}
	
	public function get_restitution_by_id($id){
		$query = $this->db->get_where('restitution', array('restitution_id' => $id));
		return current($query->result());
	}

	public function getPhotoRestitution()
	{
		global $db;
 		$zDatabaseBO =  $db['backoffice']['database'] ;

		$zSql= " SELECT * FROM $zDatabaseBO.photosad WHERE photo_flag = 2 AND photo_type = 0 ORDER BY photo_ordre";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result_array();
		$zQuery->free_result();
		
		return $oRow;
	}
	
	
	public function get_tete_restitution(){
		$sql = "SELECT date_restitution, heure_restitution, lieu_restitution1, intitule_restitution, nom_prenom_restitution  FROM planning
				WHERE date_restitution > CURRENT_DATE ";
				
		$query = $this->db->query($sql);
		$result = $query->row();
		$query->free_result(); 
		return $result;
	}
}
?>
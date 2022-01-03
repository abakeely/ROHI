
<?php
class Candidat_recu_formation_model extends CI_Model {

	public function insert($candidat_recu_formationData){
		if($this->db->insert('candidat_recu_formation', $candidat_recu_formationData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function update($data_candidat_recu_formation,$id){
		$this->db->update("candidat_recu_formation", $data_candidat_recu_formation, "id = $id");
	}
	
	public function get_candidat_recu_formation($type_candidat_recu_formation=false){
		if($type_candidat_recu_formation){
			//$query = $this->db->order_by('candidature_ordre', 'ASC')->get_where('candidat_recu_formation', array('type_candidat_recu_formation' => $type_candidat_recu_formation));

			$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM candidat_recu_formation WHERE 1 AND candidature_actif = 1 AND type_candidat_recu_formation = ".$type_candidat_recu_formation." 
			ORDER BY id DESC,date_formation DESC " ; 
			$zQuery = $this->db->query($zSql);
			
		}
		else {
			$zSql = " SELECT SQL_CALC_FOUND_ROWS * FROM candidat_recu_formation WHERE 1 AND candidature_actif = 1 ORDER BY id DESC,date_formation DESC " ; 
			$zQuery = $this->db->query($zSql);

		}
			
    
		return $zQuery->result();
	}
	public function is_exist_formation_by_user_id($id){
		$formation = $this->get_candidat_recu_formation_by_id($id);
		return (!empty($formation));
	}
}
?>
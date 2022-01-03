<?php
class Candidat_enfant_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	

	public function enfants($user_id){
		
		$sql = "select distinct user_id,nom,prenoms,date_naiss from candidat_enfant where user_id='".$user_id."'" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function conjoint($user_id){
		
		$sql =  "
					SELECT DISTINCT b.matricule, b.nom, b.prenom 
					  FROM candidat_enfant a 
					 INNER JOIN candidat b 
					 ON (a.matricule_pere = b.matricule)
					 WHERE a.user_id ='".$user_id."'
				" ;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function conjointe($user_id){
		
		$sql =  "
					SELECT DISTINCT b.matricule, b.nom, b.prenom 
					  FROM rohi.candidat_enfant a 
					 INNER JOIN rohi.candidat b 
					 ON (a.matricule_mere = b.matricule)
					 WHERE a.user_id ='".$user_id."'
				" ;
		$query = $this->db->query($sql);
		$result=	 $query->result_array();
				
		return $result ;
	}
}
?>
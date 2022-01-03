<?php
class Compte_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('compte', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_compte($_iCompteId = FALSE){
		
		$DB1 = $this->load->database('gcap', TRUE);
		if ($_iCompteId === FALSE)
		{
			$zSql= "select * from compte order by compte_id";
                        $zQuery = $DB1->query($zSql);
                        $oRow = $zQuery->result_array();
                        $zQuery->free_result(); 
                        return $oRow;
		}

		$zQuery = $DB1->get_where('compte', array('compte_id' => $_iCompteId));
		return $zQuery->row_array();
	}
	
	public function get_by_compte_UserId($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zSql= "select * 
		          from ".$zDatabaseGcap.".compte 
				  INNER JOIN ".$zDatabaseGcap.".usercompte 
				  ON userCompte_compteId = compte_id 
				  where userCompte_userId = $_iUserId 
				  AND compte_id > 1
				  AND userCompte_actif =0";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function get_by_compte_evaluateur_UserId($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zSql= "select * 
		          from ".$zDatabaseGcap.".compte 
				  INNER JOIN ".$zDatabaseGcap.".usercompte 
				  ON userCompte_compteId = compte_id 
				  where userCompte_userId = $_iUserId 
				  AND compte_id  = " . COMPTE_EVALUATEUR."
				  AND userCompte_actif =0";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	} 

	public function delete_AllCompte($_iUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$this->db->query('delete from '.$zDatabaseGcap.'.usercompte where userCompte_userId = '.$_iUserId);
	}

	public function getCompteAutorite($_zUserId){
		global $db;
		$zDatabaseGcap =  $db['gcap']['database'] ; 
		$zDatabaseOrigin =  $db['default']['database'] ;

		$toResult = array();
		if ($_zUserId != ""){
			$zSql= "select user_id,nom,prenom,sexe,email from ".$zDatabaseGcap.".usercompte 
			INNER JOIN ".$zDatabaseOrigin.".candidat ON userCompte_userId = user_id
			WHERE userCompte_compteId = ".COMPTE_AUTORITE."
			AND userCompte_userId IN (".$_zUserId.")
			AND userCompte_userId NOT IN (4430,43,617,9835,9976,9797,10080,10215,9523,871,620,9312)"; 

			$zQuery = $this->db->query($zSql);
			$toResult = $zQuery->result_array();
		}

		return $toResult;
	} 
}
?>
<?php
class Organigramme_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function getTree($zAgentMemeEvaluateur){
		/*global $db;
		$DB1			= $this->load->database('rohi', TRUE);		
		$zSql			= "SELECT * from candidat where user_id in ($zAgentMemeEvaluateur) ";
		$zQuery			= $DB1->query($zSql);
		$torecords		= $zQuery->result_array();
		$zQuery->free_result(); 
		return $torecords;*/

		$sql= " SELECT * from candidat where user_id in ($zAgentMemeEvaluateur) ";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	
}
?>
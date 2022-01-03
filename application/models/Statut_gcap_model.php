<?php
class Statut_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('statut', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
}
?>
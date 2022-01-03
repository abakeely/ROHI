<?php
class Reponse_model extends CI_Model {
	private $table = 'reponse';
	
	public function __construct(){
		$this->load->database();
	}
	
	public function insert($reponse){
		if($this->db->insert($this->table, $reponse)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
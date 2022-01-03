<?php
class Rapprochement_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
    public function get_sigle($structureId = FALSE){
		$sql= "SELECT mef.getSigle($structureId) as sigle";
		$query = $this->db->query($sql);
		$tzSigle =  $query->row_array();
		$tzSigle =  explode("/",$tzSigle["sigle"]);
		$tzSigle   = array_reverse($tzSigle);
		$zSigle    = implode("/",$tzSigle);

		return $zSigle;
	}
}
?>
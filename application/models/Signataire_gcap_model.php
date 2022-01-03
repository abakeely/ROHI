<?php
class Signataire_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('signataire', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_gcap($_iSignataireId = FALSE){
		if ($_iSignataireId === FALSE)
		{
			$zSql= "select * from signataire order by signataire_id";
                        $zQuery = $this->db->query($zSql);
                        $oRow = $zQuery->result_array();
                        $zQuery->free_result(); // The $zQuery result object will no longer be available
                        return $oRow;
		}

		$zQuery = $this->db->get_where('signataire', array('signataire_id' => $_iSignataireId));
		return $zQuery->row_array();
	}
	
	public function get_by_signataire_id($iSignataireId){
		$zSql= "select * from signataire where signataire_id = $iSignataireId ORDER BY signataire_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	public function get_abs_valid_by_signataire_id($iSignataireId){
		$zSql= "select * from signataire where signataire_id = $iSignataireId and etat = 1 ORDER BY signataire_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>
<?php
class ModulePage_gcap_model extends CI_Model {

	public function __construct(){
		$this->load->database('gcap');
	}
	
	public function insert($oData){
		if($this->db->insert('modulepage', $oData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_gcap($_iGcapId = FALSE){
		if ($_iGcapId === FALSE)
		{
			$zSql= "select * from modulepage order by modulepage_id";
                        $zQuery = $this->db->query($zSql);
                        $oRow = $zQuery->result_array();
                        $zQuery->free_result(); 
                        return $oRow;
		}

		$zQuery = $this->db->get_where('modulepage', array('modulepage_id' => $_iGcapId));
		return $zQuery->row_array();
	}
	
	public function get_by_modulepage_id($iGcapId){
		$zSql= "select * from modulepage where modulepage_id = $iModulePageId ORDER BY modulepage_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
	public function get_abs_valid_by_modulepage_id($iModulePageId){
		$zSql= "select * from modulepage where modulepage_id = $iModulePageId and etat = 1 ORDER BY modulepage_id";
		$zQuery = $this->db->query($zSql);
		return $zQuery->result_array();
	}
	
}
?>
<?php
class Carriere_engagementELD_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_engagementELD($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementELD";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by decisiondEngagementELD_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_engagementELDParElaborationProjet($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementELD";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ElaborationProjetId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($engagementELDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementELD";
		if($this->db->insert($zBase.".".$zTable, $engagementELDData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($engagementELDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementELD";
		$this->db->update($zBase.".".$zTable, $engagementELDData, $zTable."_id = '".$engagementELDData['decisiondEngagementELD_id']."'");
	}

	public function delete($engagementELDData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "decisiondEngagementELD";
		$this->db->delete($zBase.".".$zTable, $engagementELDData, $zTable."_id = '".$engagementELDData['decisiondEngagementELD_id']."'");
	}
}
?>
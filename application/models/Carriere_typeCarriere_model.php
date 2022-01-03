<?php
class Carriere_typeCarriere_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}

	public function get_typeCarriere($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "typeCarriere";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by typeCarriere_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}
	
	public function insert($oData){
        global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "typeCarriere";
		if($this->db->insert($zBase.".".$zTable, $toVerificationPiecesData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function get_by_TypeCarriere_zHashPageUrl($_zHashUrl){
		
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "typeCarriere";

		$zSql= "select typeCarriere_id from $zBase.$zTable where typeCarriere_zHashUrl = '$_zHashUrl' ORDER BY typeCarriere_id";
		$zQuery = $this->db->query($zSql);

		$oResult = $zQuery->result_array(); 
		//print_r($oResult);

		$iModuleId = 0 ; 
		if (sizeof($oResult)> 0)
		{
			$iModuleId = $oResult[0]['typeCarriere_id'] ; 
		}
		return $iModuleId;
	}
}
?>
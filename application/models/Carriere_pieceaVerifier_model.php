<?php
class Carriere_pieceaVerifier_model extends CI_Model {

	public function __construct(){
		$this->load->database("carriere");
	}
	
	public function get_pieceaVerifier($_sRecrutement,$_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "pieceaVerifier";
		if ($_iId === FALSE)
		{
			$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_typeRecrutement' => $_sRecrutement,$zTable.'_actif' => 1));
			$oRow = $oQuery->result_array();
			$oQuery->free_result(); // The $oQuery result object will no longer be available
			return $oRow;
		}

		$oQuery = $this->db->select("p.*, v.verificationPieces_projetValidation")
					->from($zBase.".".$zTable." as p")
					->where(array('v.verificationPieces_projetValidation like' => "%".$_iId."-%", 'p.'.$zTable.'_actif' => 1))
					->join($zBase.".verificationPieces as v","p.PIECEAVERIFIER_ID = v.verificationPieces_PieceaVerifierId")
					->get();
					//print_r($this->db->last_query());
		$oRow = $oQuery->result_array();
		$oQuery->free_result(); // The $oQuery result object will no longer be available
		return $oRow;
	}

	
}
?>
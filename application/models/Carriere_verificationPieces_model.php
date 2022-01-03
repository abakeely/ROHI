<?php
class Carriere_verificationPieces_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_verificationPieces($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "verificationPieces";
		if ($_iId === FALSE)
		{
			$sql= "select * from verificationPieces order by verificationPieces_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where('verificationPieces', array('verificationPieces_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_verificationPiecesByPieceaVerifier($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "verificationPieces";
		$oQuery = $this->db->get_where($zBase.".".$zTable, array('verificationPieces_PieceaVerifierId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($toVerificationPiecesData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "verificationPieces";
		if($this->db->insert($zBase.".".$zTable, $toVerificationPiecesData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($toVerificationPiecesData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "verificationPieces";
		$this->db->set("verificationPieces_projetValidation",$toVerificationPiecesData['verificationPieces_projetValidation'])
		->where("verificationPieces_id",$toVerificationPiecesData['verificationPieces_id'])
		->update($zBase.".".$zTable);
	}
}
?>
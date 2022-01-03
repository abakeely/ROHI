<?php
class Carriere_contratdeTravail_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_contratdeTravail($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "contratdeTravail";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by contratdeTravail_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
	}

	public function get_contratdeTravailParElaborationProjet($_iId){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "contratdeTravail";
		
		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_ElaborationProjetId' => $_iId));
		return $oQuery->row_array();
	}

	public function insert($contratdeTravailData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "contratdeTravail";
		if($this->db->insert($zBase.".".$zTable, $contratdeTravailData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($contratdeTravailData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "contratdeTravail";
		$this->db->update($zBase.".".$zTable, $contratdeTravailData, $zTable."_id = '".$contratdeTravailData['contratdeTravail_id']."'");
	}

	public function delete($contratdeTravailData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "contratdeTravail";
		$this->db->delete($zBase.".".$zTable, $contratdeTravailData, $zTable."_id = '".$contratdeTravailData['contratdeTravail_id']."'");
	}
}
?>
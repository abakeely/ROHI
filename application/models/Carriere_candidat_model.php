<?php
class Carriere_candidat_model extends CI_Model {

	public function __construct(){
		$this->load->database('carriere');
	}
	
	public function get_candidat($_iId = FALSE){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "candidat";
		if ($_iId === FALSE)
		{
			$sql= "select * from ".$zBase.".".$zTable." order by candidat_id";
                        $oQuery = $this->db->query($sql);
                        $oRow = $oQuery->result_array();
                        $oQuery->free_result(); // The $oQuery result object will no longer be available
                        return $oRow;
		}

		$oQuery = $this->db->get_where($zBase.".".$zTable, array($zTable.'_id' => $_iId));
		return $oQuery->row_array();
    }
    
    public function get_candidat_by_multicritere($param,$value){
		global $db;
		$zDatabaseOrigin =  $db['carriere']['database'] ;
		$sql= "select * from ".$zDatabaseOrigin.".candidat where ";
		$where = " 1=1 ";
		$cpt = 0;
		foreach($param as $par){
			$where .= " AND  $par = $value[$cpt] ";
			$cpt++;	
		}
		$sql .= $where;
		//var_dump($sql);
		$query = $this->db->query($sql);
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}

	public function get_all_list_candidat1($zTerm= "aa"){
		
		global $db;
		$zDatabaseOrigin =  $db['carriere']['database'] ;
		
		$zSql= "select * from $zDatabaseOrigin.candidat WHERE (candidat_nom LIKE '%$zTerm%' OR candidat_prenom LIKE '%$zTerm%')";

		$zQuery = $this->db->query($zSql);
		$oRow = $zQuery->result();
		$zQuery->free_result(); // The $query result object will no longer be available
		return $oRow;
	}


	public function insert($candidatData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "candidat";
		if($this->db->insert($zBase.".".$zTable, $candidatData)){
			return $this->db->insert_id();
		}else return false;
	}

	public function update($candidatData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "candidat";
		$this->db->update($zBase.".".$zTable, $candidatData, $zTable."_id = '".$candidatData['candidat_id']."'");
	}

	public function delete($candidatData){
		global $db;
		$zBase = $db['carriere']['database'] ;
		$zTable = "candidat";
		$this->db->delete($zBase.".".$zTable, $candidatData, $zTable."_id = '".$candidatData['candidat_id']."'");
	}
}
?>
<?php
class Referentiel_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function findAllMouvement(){
		$sql= " SELECT *
				  FROM sgrh.t_mouvement 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function findAllPiecesJointes(){
		$sql= " SELECT *
				  FROM sgrh.t_pieces_jointes 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function findAllCorps(){
		$sql= " SELECT *
				  FROM sgrh.t_corps 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function findAllSanction(){
		$sql= " SELECT *
				  FROM rohi.sanction 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function findAllDepartement(){
		$sql= " SELECT *
				  FROM rohi.departement 
			  ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
}
?>
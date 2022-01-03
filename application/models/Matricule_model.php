<?php
class Matricule_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_matricule($libele = FALSE,$nom = FALSE){
		if ($libele === FALSE && $nom === FALSE)
		{
			$query = $this->db->get('matricule');
			return $query->result_array();
		}
        else if ($libele != FALSE && $nom!= FALSE){
			$sql="SELECT * FROM matricule  WHERE libele='".$libele."' AND nom = '".$nom."'";
            $result = $this->db->query($sql)->result_array();	
			return $result;
		}
		else if ($libele != FALSE){
			$sql="SELECT * FROM matricule  WHERE libele='".$libele."'";
            $result = $this->db->query($sql)->result_array();	
			return $result;
		}
		else {
			$sql="SELECT * FROM matricule  WHERE  nom = '".$nom."'";
            $result = $this->db->query($sql)->result_array();	
			return $result;
		}
	}
        
    public function existe($matricule = FALSE){
		   $matric = $this->get_matricule($matricule);
           return sizeof($matric)>0;
	}
        
	public function verifier_mat_nom($matricule ,$nom){
		$sql="SELECT * FROM matricule  WHERE libele='".$matricule."' AND nom = '".$nom."'";
		$result = $this->db->query($sql)->result_array();	
		return sizeof($result)>0;
	}
	
	public function insert($matricule){
		if($this->db->insert("matricule", $matricule)){
			return $this->db->insert_id();
		}else return false;
	}
}
?>
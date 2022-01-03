<?php
class Departement_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_departement($id = FALSE){
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;
		if ($id === FALSE){
			$sql= 'SELECT * FROM departement WHERE affiche=1 ORDER BY ordre ASC';
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		$query = $this->db->get_where($zDatabaseOrigin.'.departement', array('id' => $id));
		return $query->row_array();
	}


	public function getDepartementByDirection($_iDirectionId){
		if(empty($_iDirectionId))
			return null;
		$sql= 'SELECT departement_id,direction_id FROM direction WHERE id = '.$_iDirectionId;
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	
	
	public function get_depart_by_district_id($dist_id){
		if(empty($dist_id))
			return null;
		$sql= " SELECT departement.* FROM departement where 1= 1 ";
		//where departement.id = dist.id_dep  and dist.id_dist = '.$dist_id;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function findAllDepartement($_dep,$_dir,$_serv,$_div){
		
		$sql= "SELECT * 
		         FROM rohi.departement 
				WHERE 1 = 1 ";
		if( isset($_dep) ){
			$sql = $sql . " AND departement_id ='".$_dep."' ";
		}
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>
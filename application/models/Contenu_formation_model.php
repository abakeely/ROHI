<?php
class Contenu_formation_model extends CI_Model { 

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($parcoursData){
		if($this->db->insert('contenu_formation', $parcoursData)){
			return $this->db->insert_id();
		}
		else return false;
	}
	
	public function get_contenu_formation($id=false){
            if ($id === FALSE)
            {
            	$sql= "select * from contenu_formation order by id";
            	$query = $this->db->query($sql);
            	$row = $query->result_array();
            	$query->free_result(); // The $query result object will no longer be available
            	return $row;
            }
            
            $query = $this->db->get_where('contenu_formation', array('id' => $id));
            return $query->row_array();
	 }
	 
	 public function get_contenu_by_module_id($module_id){
	 	$query = $this->db->get_where('contenu_formation', array('module_id' => $module_id));
	 	return $query->result_array();
	 }
}
?>
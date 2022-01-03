<?php
class Listeoffre_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_listeoffre($listeoffre_id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from listeoffre order by listeoffre_id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('listeoffre', array('listeoffre_id' => $listeoffre_id));
		return current($query->result());
	}
	
	public function get_listeoffre_by_critere($data){
		$where = $this->get_where($data);
		$sql = "select * from listeoffre where ".$where;
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	
	private function get_where($data){
		$where = "1=1 ";
		if(isset($data['themeoffre_id']))
			$where .= " and themeoffre_id = ".$data['themeoffre_id'];
		
		if(isset($data['listeoffre_titre']))
			$where .= " and listeoffre_titre like '%".$data['listeoffre_titre']."%'";
		
		return $where;
	}
}
?>
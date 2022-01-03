<?php
class Listeform_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_listeform($listeform_id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from listeform order by listeform_id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('listeform', array('listeform_id' => $listeform_id));
		return current($query->result());
	}
	
	public function get_listeform_by_critere($data){
		$where = $this->get_where($data);
		$sql = "select * from listeform where ".$where;
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	
	private function get_where($data){
		$where = "1=1 ";
		if(isset($data['themeform_id']))
			$where .= " and themeform_id = ".$data['themeform_id'];
		
		if(isset($data['formation_titre']))
			$where .= " and formation_titre like '%".$data['formation_titre']."%'";
		
		return $where;
	}
}
?>
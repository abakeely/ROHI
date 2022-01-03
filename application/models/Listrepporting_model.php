<?php
class Listrepporting_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_listrepporting($listrepporting_id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from listrepporting order by listrepporting_id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('listrepporting', array('listrepporting_id' => $listrepporting_id));
		return current($query->result());
	}
	
	public function get_listrepporting_by_critere($data){
		$where = $this->get_where($data);
		$sql = "select * from listrepporting where ".$where;
		$query = $this->db->query($sql);
		$result = $query->result();
		$query->free_result(); // The $query result object will no longer be available
		return $result;
	}
	
	
	private function get_where($data){
		$where = "1=1 ";
		if(isset($data['themerepporting_id']))
			$where .= " and themerepporting_id = ".$data['themerepporting_id'];
		
		if(isset($data['repporting_titre']))
			$where .= " and repporting_titre like '%".$data['repporting_titre']."%'";
		
		return $where;
	}
}
?>
<?php
class District_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_district($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from district order by libele";
                        $query = $this->db->query($sql);
                        $row = $query->result();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
                        //$query = $this->db->get('district');
                       // var_dump($row);
			//return $query->result_array();
		}

		$query = $this->db->get_where('district', array('id' => $id));
		return $query->row_array();
                
	}
        
        public function get_district_by_region_id($id = FALSE){
		if ($id === FALSE)
		{
			$query = $this->db->get('district');
			return $query->result_array();
		}

		$query = $this->db->get_where('district', array('region_id' => $id));
		return $query->result_array();
	}
        
        public function get_province_region_by_district($district){
            $sql= "select region.id as reg_id,region.libele as reg_lib,province.id as prov_id,province.libele as prov_lib from district,region,province where district.region_id = region.id and region.province_id = province.id and district.id = ".$district;
            $query = $this->db->query($sql);
            $row = $query->row();
            $query->free_result(); // The $query result object will no longer be available
            return $row;
        }
}
?>
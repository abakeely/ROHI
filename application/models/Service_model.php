<?php
class Service_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_service($id = FALSE){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		if ($id === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin. '.service');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin. '.service', array('id' => $id));
		return $query->row_array();
	 }
        
     public function get_by_direction($dir){

		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		$sql= 'select * from '.$zDatabaseOrigin.'.service where direction_id IN (0,'.$dir.') ORDER BY direction_id,id';
		$query = $this->db->query($sql);
		return $query->result_array();
     }
      
     public function get_soa_by_service_id($service_id){
		if(empty($service_id))
			return null;
     	$sql= 'SELECT soa.* FROM soa,service_has_soa as serv where soa.id = serv.soa_id  and serv.service_id = '.$service_id;
     	$query = $this->db->query($sql);
     	return $query->result_array();
     }
     
     public function get_service_by_district_id($direction_id,$dist_id){
     	if(empty($dist_id))
     		return null;
     	$sql= 'SELECT service.* FROM service,district_has_service as dist where service.id = dist.service_id  and dist.district_id = '.$dist_id .' and service.direction_id='.$direction_id;
     	$query = $this->db->query($sql);
     	return $query->result_array();
     }
        
}
?>
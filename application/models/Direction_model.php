<?php
class Direction_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_direction($id = FALSE){
		
		global $db;
		$zDatabaseOrigin =  $db['default']['database'] ;

		if ($id === FALSE)
		{
			$query = $this->db->get($zDatabaseOrigin . '.direction');
			return $query->result_array();
		}

		$query = $this->db->get_where($zDatabaseOrigin . '.direction', array('id' => $id));
		return $query->row_array();
	}
        
        public function get_by_departement($dep){

			global $db;
			$zDatabaseOrigin =  $db['default']['database'] ;

			$sql= 'select * from '.$zDatabaseOrigin.'.direction where departement_id IN (0,'.$dep.') ORDER BY departement_id,id';
			$query = $this->db->query($sql);
			return $query->result_array();
        }

		public function getDirectionByService($_iServiceId){
			if(empty($_iServiceId))
				return null;
			$sql= 'SELECT departement_id,direction_id,service_id FROM service WHERE id = '.$_iServiceId;

			echo $sql;
			$query = $this->db->query($sql);
			return $query->row_array();
		}
        
        public function get_direction_by_district_id($departement_id,$dist_id){
        	if(empty($dist_id))
        		return null;
        	$sql= 'SELECT direction.* FROM direction,district_has_direction as dist where direction.id = dist.direction_id  and dist.district_id = '.$dist_id .' and direction.departement_id='.$departement_id;
        	$query = $this->db->query($sql);
        	return $query->result_array();
        }
}
?>
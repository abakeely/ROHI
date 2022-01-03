<?php
class Permission_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($congeData){
		if($this->db->insert('permission', $congeData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_permission($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from permission order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('permission', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_by_user_id($user_id){
		$sql= "select * from permission where user_id = $user_id ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_perm_valid_by_user_id($user_id){
		$sql= "select * from permission where user_id = $user_id and etat = 1 ORDER BY id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function validate_permission($id){
		$data = array();
		$data['etat'] = 1;
		$this->db->update('permission', $data, "id = $id");
	}
	
	public function refuse_permission($id){
		$data = array();
		$data['etat'] = 2;
		$this->db->update('permission', $data, "id = $id");
	}
	
	public function get_nombre_jour_restant($user_id=false){
		$ret = 20;
		if($user_id){
			$list_perm = $this->get_perm_valid_by_user_id($user_id);
			$now = explode(date("y-m-d"),"-");
			$year = $now[0];
			foreach($list_perm as $perm){
				$date = explode($perm['date_debut'],"-");
				$year_per = $date[0];
				if($year == $year_per)
					$ret = $ret - $perm['nbr_jour'];
			}
		}
		return $ret;
	}
}
?>
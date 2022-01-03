<?php
class Repos_medicale_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function insert($repos_medicaleData){
		if($this->db->insert('repos_medicale', $repos_medicaleData)){
			return $this->db->insert_id();
		}else return false;
	}
	
	public function get_repos_medicale($id = FALSE){
		if ($id === FALSE)
		{
			$sql= "select * from repos_medicale order by id";
                        $query = $this->db->query($sql);
                        $row = $query->result_array();
                        $query->free_result(); // The $query result object will no longer be available
                        return $row;
		}

		$query = $this->db->get_where('repos_medicale', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_by_user_id($user_id){
		$sql= "select * from repos_medicale where user_id = $user_id ORDER BY id";
		//var_dump($sql);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function validate_repos_medicale($id){
		$repos_medicaleData = array();
		$repos_medicaleData['etat'] = 1;
		$this->db->update('repos_medicale', $repos_medicaleData, "id = $id");
	}
}
?>